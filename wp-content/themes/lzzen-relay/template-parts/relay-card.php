<?php
/**
 * Relay card partial.
 *
 * @package Lzzen_Relay
 *
 * @var array<string, mixed> $record Relay record.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$record = $args['record'] ?? array();
?>
<article class="relay-card" data-testid="relay-card" data-relay-slug="<?php echo esc_attr( $record['slug'] ?? '' ); ?>">
	<div class="relay-card__main">
		<h3 class="relay-card__title">
			<a href="<?php echo esc_url( $record['detail_url'] ?? '#' ); ?>">
				<?php echo esc_html( $record['title'] ?? '' ); ?>
			</a>
			<?php if ( ! empty( $record['warning'] ) ) : ?>
				<span class="relay-badge relay-badge--warn"><?php echo esc_html( $record['warning'] ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $record['certified'] ) ) : ?>
				<span class="relay-badge relay-badge--cert">认证</span>
			<?php endif; ?>
		</h3>

		<div class="relay-card__protocols">
			<?php foreach ( (array) ( $record['protocols'] ?? array() ) as $protocol ) : ?>
				<span class="protocol-tag protocol-tag--<?php echo esc_attr( strtolower( $protocol ) ); ?>">
					<?php echo esc_html( lzzen_relay_protocol_label( $protocol ) ); ?>
				</span>
			<?php endforeach; ?>
		</div>

		<p class="relay-card__meta">
			最近检测 <?php echo esc_html( lzzen_relay_relative_time( $record['last_check'] ?? '' ) ); ?>
			· 累计 <?php echo esc_html( (string) ( $record['total_checks'] ?? 0 ) ); ?> 次
			· 窗口内 <?php echo esc_html( (string) ( $record['window_checks'] ?? 0 ) ); ?> 次
		</p>

		<p class="relay-card__stats">
			<span class="stat stat--pass"><?php echo esc_html( (string) ( $record['pass_count'] ?? 0 ) ); ?> 通过</span>
			<span class="stat stat--edge"><?php echo esc_html( (string) ( $record['edge_count'] ?? 0 ) ); ?> 边缘</span>
			<span class="stat stat--fail"><?php echo esc_html( (string) ( $record['fail_count'] ?? 0 ) ); ?> 失败</span>
		</p>
	</div>

	<div class="relay-card__actions">
		<a class="relay-link" href="<?php echo esc_url( $record['detail_url'] ?? '#' ); ?>">测评</a>
		<?php if ( ! empty( $record['url'] ) ) : ?>
			<a class="relay-link relay-link--primary" href="<?php echo esc_url( $record['url'] ); ?>" target="_blank" rel="noopener noreferrer">前往 →</a>
		<?php endif; ?>
	</div>
</article>
