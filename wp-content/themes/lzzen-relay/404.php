<?php
/**
 * 404 template.
 *
 * @package Lzzen_Relay
 */

get_header();
?>
<div class="site-shell">
	<h1>页面未找到</h1>
	<p><a href="<?php echo esc_url( home_url( '/relays/' ) ); ?>">返回中转站排行榜</a></p>
</div>
<?php
get_footer();
