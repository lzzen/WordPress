<?php
/**
 * Relay listing page (/relays and front page).
 *
 * @package Lzzen_Relay
 */

get_header();

$records    = lzzen_relay_get_all_records();
$certified  = array_values( array_filter( $records, static fn( $item ) => ! empty( $item['certified'] ) ) );
$all_count  = count( $records );
?>
<div class="site-shell relay-list-page" data-testid="relay-list-page">
	<header class="page-header">
		<h1>AI API 中转站导航</h1>
		<p class="page-lead">全部 <?php echo esc_html( (string) $all_count ); ?> 家中转站按活跃度排序</p>
	</header>

	<?php if ( ! empty( $certified ) ) : ?>
		<section class="relay-section" data-testid="relay-featured-section">
			<h2>认证收录中转站</h2>
			<p class="section-note">运营方认证收录 · 检测数据真实可查</p>
			<div class="relay-grid">
				<?php foreach ( $certified as $record ) : ?>
					<?php get_template_part( 'template-parts/relay-card', null, array( 'record' => $record ) ); ?>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>

	<section class="relay-section" data-testid="relay-all-section">
		<h2>全部中转站 · 按活跃度排序</h2>
		<div class="relay-grid">
			<?php foreach ( $records as $record ) : ?>
				<?php get_template_part( 'template-parts/relay-card', null, array( 'record' => $record ) ); ?>
			<?php endforeach; ?>
		</div>
	</section>
</div>
<?php
get_footer();
