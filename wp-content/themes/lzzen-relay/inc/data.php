<?php
/**
 * Sample relay stations seeded when the theme has no posts yet.
 *
 * @package Lzzen_Relay
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @return array<int, array<string, mixed>>
 */
function lzzen_relay_sample_records() {
	return array(
		array(
			'slug'          => 'vip-j3gb-com',
			'title'         => 'vip.j3gb.com',
			'url'           => 'https://vip.j3gb.com',
			'protocols'     => array( 'openai' ),
			'featured'      => true,
			'certified'     => false,
			'last_check'    => '2026-06-29T10:00:00+08:00',
			'total_checks'  => 8,
			'window_checks' => 7,
			'pass_count'    => 6,
			'edge_count'    => 0,
			'fail_count'    => 2,
			'score'         => 82,
			'grade'         => 'B',
			'trend'         => 12.5,
			'trend_dir'     => 'up',
			'verdict'       => 'passed',
			'verdict_label' => '通过',
			'consistency'   => 100,
			'critical'      => 0,
			'recommendation'=> '日常开发',
			'scenarios'     => array(
				array(
					'type'  => 'good',
					'title' => 'ChatGPT 套壳 / 聊天应用',
					'detail'=> '基础请求 100% + 流式一致性 100%',
				),
				array(
					'type'  => 'warn',
					'title' => 'Function Calling / Agent',
					'detail'=> 'function_calling 通过率仅 33%',
				),
			),
			'check_items'   => array(
				array( 'id' => 'openai/basic_request', 'rate' => 100, 'passed' => 6, 'total' => 6 ),
				array( 'id' => 'openai/model_consistency', 'rate' => 100, 'passed' => 6, 'total' => 6 ),
				array( 'id' => 'openai/function_calling', 'rate' => 33.3, 'passed' => 2, 'total' => 6 ),
				array( 'id' => 'openai/protocol', 'rate' => 100, 'passed' => 6, 'total' => 6 ),
				array( 'id' => 'openai/token_billing', 'rate' => 50, 'passed' => 3, 'total' => 6 ),
				array( 'id' => 'openai/structured_output', 'rate' => 100, 'passed' => 6, 'total' => 6 ),
				array( 'id' => 'openai/integrity', 'rate' => 100, 'passed' => 6, 'total' => 6 ),
			),
			'protocol_scores' => array(
				array( 'protocol' => 'openai', 'score' => 93, 'verdict' => 'passed', 'count' => 6 ),
			),
			'weak_points'   => array(
				array( 'id' => 'token_billing', 'failures' => 3 ),
				array( 'id' => 'long_context', 'failures' => 2 ),
			),
			'history'       => array(
				array( 'date' => '2026-06-29', 'protocol' => 'OpenAI', 'model' => 'gpt-5.4', 'score' => 93, 'verdict' => 'passed', 'deductions' => 1 ),
				array( 'date' => '2026-06-29', 'protocol' => 'OpenAI', 'model' => 'gpt-5.5', 'score' => 92, 'verdict' => 'passed', 'deductions' => 1 ),
				array( 'date' => '2026-06-29', 'protocol' => 'OpenAI', 'model' => 'gpt-5.5', 'score' => 83, 'verdict' => 'passed', 'deductions' => 1 ),
				array( 'date' => '2026-06-24', 'protocol' => 'OpenAI', 'model' => 'gpt-5.5', 'score' => 80, 'verdict' => 'passed', 'deductions' => 1 ),
				array( 'date' => '2026-06-23', 'protocol' => 'OpenAI', 'model' => 'gpt-5.5', 'score' => 80, 'verdict' => 'passed', 'deductions' => 1 ),
				array( 'date' => '2026-06-23', 'protocol' => 'OpenAI', 'model' => 'gpt-5.5', 'score' => 81, 'verdict' => 'passed', 'deductions' => 0 ),
			),
		),
		array(
			'slug'          => 'tokenpro-work',
			'title'         => 'tokenpro.work',
			'url'           => 'https://tokenpro.work',
			'protocols'     => array( 'claude', 'openai' ),
			'featured'      => false,
			'certified'     => false,
			'last_check'    => '2026-06-29T09:58:00+08:00',
			'total_checks'  => 2,
			'window_checks' => 2,
			'pass_count'    => 2,
			'edge_count'    => 0,
			'fail_count'    => 0,
			'score'         => 88,
			'grade'         => 'B',
			'trend'         => 4.2,
			'trend_dir'     => 'up',
			'verdict'       => 'passed',
			'verdict_label' => '通过',
			'consistency'   => 100,
			'critical'      => 0,
			'recommendation'=> '日常开发',
			'scenarios'     => array(),
			'check_items'   => array(),
			'protocol_scores' => array(
				array( 'protocol' => 'openai', 'score' => 90, 'verdict' => 'passed', 'count' => 1 ),
				array( 'protocol' => 'claude', 'score' => 86, 'verdict' => 'passed', 'count' => 1 ),
			),
			'weak_points'   => array(),
			'history'       => array(
				array( 'date' => '2026-06-29', 'protocol' => 'OpenAI', 'model' => 'gpt-5.5', 'score' => 90, 'verdict' => 'passed', 'deductions' => 0 ),
				array( 'date' => '2026-06-29', 'protocol' => 'Claude', 'model' => 'claude-opus-4-6', 'score' => 86, 'verdict' => 'passed', 'deductions' => 1 ),
			),
		),
		array(
			'slug'          => 'api-ikuncode-cc',
			'title'         => 'api.ikuncode.cc',
			'url'           => 'https://api.ikuncode.cc',
			'protocols'     => array( 'claude', 'openai', 'gemini' ),
			'featured'      => false,
			'certified'     => false,
			'last_check'    => '2026-06-29T09:38:00+08:00',
			'total_checks'  => 53,
			'window_checks' => 17,
			'pass_count'    => 15,
			'edge_count'    => 37,
			'fail_count'    => 1,
			'score'         => 71,
			'grade'         => 'C',
			'trend'         => -2.1,
			'trend_dir'     => 'down',
			'verdict'       => 'passed',
			'verdict_label' => '通过',
			'consistency'   => 85,
			'critical'      => 0,
			'recommendation'=> '谨慎使用',
			'scenarios'     => array(),
			'check_items'   => array(),
			'protocol_scores' => array(
				array( 'protocol' => 'openai', 'score' => 74, 'verdict' => 'passed', 'count' => 20 ),
			),
			'weak_points'   => array(
				array( 'id' => 'function_calling', 'failures' => 4 ),
			),
			'history'       => array(
				array( 'date' => '2026-06-29', 'protocol' => 'OpenAI', 'model' => 'gpt-5.5', 'score' => 74, 'verdict' => 'passed', 'deductions' => 2 ),
			),
		),
		array(
			'slug'          => 'claude-tokenscode-com',
			'title'         => 'claude.tokenscode.com',
			'url'           => 'https://claude.tokenscode.com',
			'protocols'     => array( 'claude' ),
			'featured'      => false,
			'certified'     => false,
			'last_check'    => '2026-06-29T09:06:00+08:00',
			'total_checks'  => 3,
			'window_checks' => 2,
			'pass_count'    => 1,
			'edge_count'    => 0,
			'fail_count'    => 2,
			'score'         => 45,
			'grade'         => 'F',
			'trend'         => -18,
			'trend_dir'     => 'down',
			'verdict'       => 'failed',
			'verdict_label' => '失败',
			'consistency'   => 33,
			'critical'      => 2,
			'recommendation'=> '不推荐',
			'scenarios'     => array(),
			'check_items'   => array(),
			'protocol_scores' => array(
				array( 'protocol' => 'claude', 'score' => 45, 'verdict' => 'failed', 'count' => 3 ),
			),
			'weak_points'   => array(
				array( 'id' => 'basic_request', 'failures' => 2 ),
			),
			'history'       => array(
				array( 'date' => '2026-06-29', 'protocol' => 'Claude', 'model' => 'claude-opus-4-6', 'score' => 45, 'verdict' => 'failed', 'deductions' => 3 ),
			),
			'warning'       => '多次失败',
		),
		array(
			'slug'          => 'api-koozhan-com',
			'title'         => 'api.koozhan.com',
			'url'           => 'https://api.koozhan.com',
			'protocols'     => array( 'claude', 'openai' ),
			'featured'      => true,
			'certified'     => true,
			'last_check'    => '2026-06-29T08:00:00+08:00',
			'total_checks'  => 24,
			'window_checks' => 12,
			'pass_count'    => 22,
			'edge_count'    => 1,
			'fail_count'    => 1,
			'score'         => 91,
			'grade'         => 'A',
			'trend'         => 3.5,
			'trend_dir'     => 'up',
			'verdict'       => 'passed',
			'verdict_label' => '通过',
			'consistency'   => 96,
			'critical'      => 0,
			'recommendation'=> '日常开发',
			'scenarios'     => array(),
			'check_items'   => array(),
			'protocol_scores' => array(
				array( 'protocol' => 'openai', 'score' => 92, 'verdict' => 'passed', 'count' => 12 ),
				array( 'protocol' => 'claude', 'score' => 89, 'verdict' => 'passed', 'count' => 12 ),
			),
			'weak_points'   => array(),
			'history'       => array(
				array( 'date' => '2026-06-29', 'protocol' => 'OpenAI', 'model' => 'gpt-5.5', 'score' => 92, 'verdict' => 'passed', 'deductions' => 0 ),
			),
		),
	);
}

/**
 * Seed sample relay posts.
 */
function lzzen_relay_seed_sample_data() {
	if ( get_option( 'lzzen_relay_seeded' ) ) {
		return;
	}

	foreach ( lzzen_relay_sample_records() as $record ) {
		$existing = get_posts(
			array(
				'post_type'      => 'relay',
				'name'           => $record['slug'],
				'posts_per_page' => 1,
				'post_status'    => 'any',
				'fields'         => 'ids',
			)
		);

		if ( ! empty( $existing ) ) {
			continue;
		}

		$post_id = wp_insert_post(
			array(
				'post_type'   => 'relay',
				'post_title'  => $record['title'],
				'post_name'   => $record['slug'],
				'post_status' => 'publish',
			),
			true
		);

		if ( is_wp_error( $post_id ) ) {
			continue;
		}

		lzzen_relay_update_meta( $post_id, $record );
	}

	update_option( 'lzzen_relay_seeded', 1, false );
}

/**
 * @param int                  $post_id Post ID.
 * @param array<string, mixed> $record Relay record.
 */
function lzzen_relay_update_meta( $post_id, $record ) {
	$scalar_keys = array(
		'url',
		'featured',
		'certified',
		'last_check',
		'total_checks',
		'window_checks',
		'pass_count',
		'edge_count',
		'fail_count',
		'score',
		'grade',
		'trend',
		'trend_dir',
		'verdict',
		'verdict_label',
		'consistency',
		'critical',
		'recommendation',
		'warning',
	);

	foreach ( $scalar_keys as $key ) {
		if ( array_key_exists( $key, $record ) ) {
			update_post_meta( $post_id, '_relay_' . $key, $record[ $key ] );
		}
	}

	update_post_meta( $post_id, '_relay_protocols', $record['protocols'] ?? array() );
	update_post_meta( $post_id, '_relay_scenarios', $record['scenarios'] ?? array() );
	update_post_meta( $post_id, '_relay_check_items', $record['check_items'] ?? array() );
	update_post_meta( $post_id, '_relay_protocol_scores', $record['protocol_scores'] ?? array() );
	update_post_meta( $post_id, '_relay_weak_points', $record['weak_points'] ?? array() );
	update_post_meta( $post_id, '_relay_history', $record['history'] ?? array() );
}
