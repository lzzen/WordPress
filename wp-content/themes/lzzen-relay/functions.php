<?php
/**
 * Theme bootstrap.
 *
 * @package Lzzen_Relay
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require get_template_directory() . '/inc/data.php';
require get_template_directory() . '/inc/helpers.php';

/**
 * Theme setup.
 */
function lzzen_relay_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'lzzen-relay' ),
		)
	);
}
add_action( 'after_setup_theme', 'lzzen_relay_setup' );

/**
 * Register relay custom post type.
 */
function lzzen_relay_register_post_type() {
	register_post_type(
		'relay',
		array(
			'labels'       => array(
				'name'          => __( 'Relay Stations', 'lzzen-relay' ),
				'singular_name' => __( 'Relay Station', 'lzzen-relay' ),
			),
			'public'       => true,
			'has_archive'  => false,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-chart-bar',
			'supports'     => array( 'title' ),
			'rewrite'      => array(
				'slug'       => 'leaderboard',
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'lzzen_relay_register_post_type' );

/**
 * Add /relays listing rewrite.
 */
function lzzen_relay_add_rewrites() {
	add_rewrite_rule( '^relays/?$', 'index.php?lzzen_relay_list=1', 'top' );
}
add_action( 'init', 'lzzen_relay_add_rewrites' );

/**
 * @param array<string> $vars Query vars.
 * @return array<string>
 */
function lzzen_relay_query_vars( $vars ) {
	$vars[] = 'lzzen_relay_list';

	return $vars;
}
add_filter( 'query_vars', 'lzzen_relay_query_vars' );

/**
 * Route /relays to listing template.
 *
 * @param string $template Template path.
 * @return string
 */
function lzzen_relay_template_include( $template ) {
	if ( get_query_var( 'lzzen_relay_list' ) ) {
		$listing = get_template_directory() . '/page-relays.php';
		if ( file_exists( $listing ) ) {
			return $listing;
		}
	}

	return $template;
}
add_filter( 'template_include', 'lzzen_relay_template_include' );

/**
 * Seed demo data once.
 */
function lzzen_relay_bootstrap_data() {
	lzzen_relay_seed_sample_data();
}
add_action( 'init', 'lzzen_relay_bootstrap_data', 20 );

/**
 * Flush rewrite rules on theme switch.
 */
function lzzen_relay_activate() {
	lzzen_relay_register_post_type();
	lzzen_relay_add_rewrites();
	flush_rewrite_rules();
	lzzen_relay_seed_sample_data();
}
add_action( 'after_switch_theme', 'lzzen_relay_activate' );

/**
 * Enqueue assets.
 */
function lzzen_relay_enqueue_assets() {
	wp_enqueue_style(
		'lzzen-relay-theme',
		get_template_directory_uri() . '/assets/theme.css',
		array(),
		'1.0.0'
	);

	wp_enqueue_script(
		'lzzen-relay-theme',
		get_template_directory_uri() . '/assets/theme.js',
		array(),
		'1.0.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'lzzen_relay_enqueue_assets' );

/**
 * Body class marker for tests and styling.
 *
 * @param array<int, string> $classes Body classes.
 * @return array<int, string>
 */
function lzzen_relay_body_class( $classes ) {
	$classes[] = 'lzzen-relay';

	return $classes;
}
add_filter( 'body_class', 'lzzen_relay_body_class' );

/**
 * Fetch all relay records for listing.
 *
 * @return array<int, array<string, mixed>>
 */
function lzzen_relay_get_all_records() {
	$posts = get_posts(
		array(
			'post_type'      => 'relay',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'title',
			'order'          => 'ASC',
		)
	);

	$records = array_map( 'lzzen_relay_record_from_post', $posts );

	return lzzen_relay_sort_by_activity( $records );
}

/**
 * Document title for listing page.
 *
 * @param array<string, string> $title Title parts.
 * @return array<string, string>
 */
function lzzen_relay_document_title( $title ) {
	if ( get_query_var( 'lzzen_relay_list' ) ) {
		$title['title'] = '中转站排行榜';
	}

	return $title;
}
add_filter( 'document_title_parts', 'lzzen_relay_document_title' );
