<?php
/**
 * Template helpers.
 *
 * @package Lzzen_Relay
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @param int $post_id Post ID.
 * @return array<string, mixed>
 */
function lzzen_relay_get_record( $post_id ) {
	$record = array(
		'id'            => $post_id,
		'title'         => get_the_title( $post_id ),
		'slug'          => get_post_field( 'post_name', $post_id ),
		'url'           => (string) get_post_meta( $post_id, '_relay_url', true ),
		'protocols'     => (array) get_post_meta( $post_id, '_relay_protocols', true ),
		'featured'      => (bool) get_post_meta( $post_id, '_relay_featured', true ),
		'certified'     => (bool) get_post_meta( $post_id, '_relay_certified', true ),
		'last_check'    => (string) get_post_meta( $post_id, '_relay_last_check', true ),
		'total_checks'  => (int) get_post_meta( $post_id, '_relay_total_checks', true ),
		'window_checks' => (int) get_post_meta( $post_id, '_relay_window_checks', true ),
		'pass_count'    => (int) get_post_meta( $post_id, '_relay_pass_count', true ),
		'edge_count'    => (int) get_post_meta( $post_id, '_relay_edge_count', true ),
		'fail_count'    => (int) get_post_meta( $post_id, '_relay_fail_count', true ),
		'score'         => (int) get_post_meta( $post_id, '_relay_score', true ),
		'grade'         => (string) get_post_meta( $post_id, '_relay_grade', true ),
		'trend'         => (float) get_post_meta( $post_id, '_relay_trend', true ),
		'trend_dir'     => (string) get_post_meta( $post_id, '_relay_trend_dir', true ),
		'verdict'       => (string) get_post_meta( $post_id, '_relay_verdict', true ),
		'verdict_label' => (string) get_post_meta( $post_id, '_relay_verdict_label', true ),
		'consistency'   => (float) get_post_meta( $post_id, '_relay_consistency', true ),
		'critical'      => (int) get_post_meta( $post_id, '_relay_critical', true ),
		'recommendation'=> (string) get_post_meta( $post_id, '_relay_recommendation', true ),
		'warning'       => (string) get_post_meta( $post_id, '_relay_warning', true ),
		'scenarios'     => (array) get_post_meta( $post_id, '_relay_scenarios', true ),
		'check_items'   => (array) get_post_meta( $post_id, '_relay_check_items', true ),
		'protocol_scores' => (array) get_post_meta( $post_id, '_relay_protocol_scores', true ),
		'weak_points'   => (array) get_post_meta( $post_id, '_relay_weak_points', true ),
		'history'       => (array) get_post_meta( $post_id, '_relay_history', true ),
		'detail_url'    => get_permalink( $post_id ),
	);

	return $record;
}

/**
 * @param string $protocol Protocol slug.
 * @return string
 */
function lzzen_relay_protocol_label( $protocol ) {
	$labels = array(
		'openai' => 'OpenAI',
		'claude' => 'Claude',
		'gemini' => 'Gemini',
	);

	return $labels[ strtolower( $protocol ) ] ?? ucfirst( $protocol );
}

/**
 * @param string $iso ISO datetime.
 * @return string
 */
function lzzen_relay_relative_time( $iso ) {
	if ( ! $iso ) {
		return '未知';
	}

	$timestamp = strtotime( $iso );
	if ( ! $timestamp ) {
		return $iso;
	}

	$diff = time() - $timestamp;
	if ( $diff < 60 ) {
		return '刚刚';
	}
	if ( $diff < 3600 ) {
		return floor( $diff / 60 ) . ' 分钟前';
	}
	if ( $diff < 86400 ) {
		return floor( $diff / 3600 ) . ' 小时前';
	}

	return wp_date( 'Y-m-d H:i', $timestamp );
}

/**
 * @param string $verdict Verdict slug.
 * @return string
 */
function lzzen_relay_verdict_class( $verdict ) {
	if ( 'passed' === $verdict ) {
		return 'is-passed';
	}
	if ( 'failed' === $verdict ) {
		return 'is-failed';
	}

	return 'is-neutral';
}

/**
 * @param array<int, array<string, mixed>> $records Relay records.
 * @return array<int, array<string, mixed>>
 */
function lzzen_relay_sort_by_activity( $records ) {
	usort(
		$records,
		static function ( $a, $b ) {
			return strtotime( $b['last_check'] ) <=> strtotime( $a['last_check'] );
		}
	);

	return $records;
}

/**
 * @param WP_Post $post Post object.
 * @return array<string, mixed>
 */
function lzzen_relay_record_from_post( $post ) {
	return lzzen_relay_get_record( $post->ID );
}
