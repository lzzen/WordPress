<?php
/**
 * Fallback template.
 *
 * @package Lzzen_Relay
 */

get_header();
?>
<div class="site-shell">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
			<?php
		endwhile;
		?>
	<?php else : ?>
		<p>暂无内容。</p>
	<?php endif; ?>
</div>
<?php
get_footer();
