<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<div class="site-shell">
		<p class="site-brand">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">中转站排行榜</a>
		</p>
		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary', 'lzzen-relay' ); ?>">
			<a href="<?php echo esc_url( home_url( '/relays/' ) ); ?>">全部中转站</a>
		</nav>
	</div>
</header>
<main class="site-main">
