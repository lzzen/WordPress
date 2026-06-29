<?php
/**
 * Single relay review page.
 *
 * @package Lzzen_Relay
 */

get_header();

while ( have_posts() ) :
	the_post();
	$record = lzzen_relay_get_record( get_the_ID() );
	$trend_symbol = 'up' === ( $record['trend_dir'] ?? '' ) ? '↗' : ( 'down' === ( $record['trend_dir'] ?? '' ) ? '↘' : '→' );
	?>
<div class="site-shell relay-detail-page" data-testid="relay-detail-page" data-relay-slug="<?php echo esc_attr( $record['slug'] ); ?>">
	<header class="detail-header">
		<p class="detail-back"><a href="<?php echo esc_url( home_url( '/relays/' ) ); ?>">← 返回排行榜</a></p>
		<h1><?php echo esc_html( $record['title'] ); ?> 中转站测评</h1>
		<p class="detail-summary">
			累计 <?php echo esc_html( (string) $record['total_checks'] ); ?> 次独立检测，
			中位分 <?php echo esc_html( (string) $record['score'] ); ?>/100，
			判定「<?php echo esc_html( $record['verdict_label'] ); ?>」。
			覆盖协议：
			<?php
			echo esc_html(
				implode(
					'、',
					array_map( 'lzzen_relay_protocol_label', (array) $record['protocols'] )
				)
			);
			?>。
			最近一次检测：<?php echo esc_html( wp_date( 'Y-m-d', strtotime( $record['last_check'] ) ) ); ?>。
		</p>
		<?php if ( ! empty( $record['url'] ) ) : ?>
			<p><a class="relay-link relay-link--primary" href="<?php echo esc_url( $record['url'] ); ?>" target="_blank" rel="noopener noreferrer">前往 <?php echo esc_html( $record['title'] ); ?> →</a></p>
		<?php endif; ?>
	</header>

	<section class="score-panel" data-testid="relay-score-panel">
		<div class="score-panel__grade"><?php echo esc_html( $record['grade'] ); ?></div>
		<div class="score-panel__body">
			<p class="score-panel__label">综合可信度</p>
			<p class="score-panel__score"><strong><?php echo esc_html( (string) $record['score'] ); ?></strong> / 100</p>
			<p class="score-panel__meta">中位分 · verdict 一致性 <?php echo esc_html( (string) $record['consistency'] ); ?>%</p>
			<p class="score-panel__trend"><?php echo esc_html( $trend_symbol ); ?> 趋势 (Δ <?php echo esc_html( (string) abs( $record['trend'] ) ); ?>)</p>
			<p class="score-panel__recommend">总体推荐 <?php echo esc_html( $record['recommendation'] ); ?></p>
		</div>
	</section>

	<?php if ( ! empty( $record['scenarios'] ) ) : ?>
		<section class="detail-section">
			<h2>适合的使用场景</h2>
			<ul class="scenario-list">
				<?php foreach ( $record['scenarios'] as $scenario ) : ?>
					<li class="scenario-item scenario-item--<?php echo esc_attr( $scenario['type'] ?? 'good' ); ?>">
						<strong><?php echo esc_html( $scenario['title'] ?? '' ); ?></strong>
						<span><?php echo esc_html( $scenario['detail'] ?? '' ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</section>
	<?php endif; ?>

	<?php if ( ! empty( $record['check_items'] ) ) : ?>
		<section class="detail-section">
			<h2>关键检测项通过率</h2>
			<button type="button" class="toggle-button" data-toggle-target="check-items">展开 <?php echo esc_html( (string) count( $record['check_items'] ) ); ?> 个关键检测项</button>
			<ul id="check-items" class="check-item-list is-collapsed">
				<?php foreach ( $record['check_items'] as $item ) : ?>
					<li>
						<code><?php echo esc_html( $item['id'] ?? '' ); ?></code>:
						<?php echo esc_html( (string) ( $item['rate'] ?? 0 ) ); ?>%
						(<?php echo esc_html( (string) ( $item['passed'] ?? 0 ) ); ?>/<?php echo esc_html( (string) ( $item['total'] ?? 0 ) ); ?>)
					</li>
				<?php endforeach; ?>
			</ul>
		</section>
	<?php endif; ?>

	<?php if ( ! empty( $record['protocol_scores'] ) ) : ?>
		<section class="detail-section" data-testid="relay-protocol-section">
			<h2><?php echo esc_html( $record['title'] ); ?> · 各协议表现</h2>
			<div class="protocol-score-grid">
				<?php foreach ( $record['protocol_scores'] as $item ) : ?>
					<div class="protocol-score <?php echo esc_attr( lzzen_relay_verdict_class( $item['verdict'] ?? '' ) ); ?>">
						<span class="protocol-score__name"><?php echo esc_html( lzzen_relay_protocol_label( $item['protocol'] ?? '' ) ); ?></span>
						<span class="protocol-score__value"><?php echo esc_html( (string) ( $item['score'] ?? 0 ) ); ?></span>
						<span class="protocol-score__meta"><?php echo esc_html( $item['verdict'] === 'passed' ? '通过' : '失败' ); ?> ×<?php echo esc_html( (string) ( $item['count'] ?? 0 ) ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( ! empty( $record['weak_points'] ) ) : ?>
		<section class="detail-section" data-testid="relay-weak-points">
			<h2><?php echo esc_html( $record['title'] ); ?> 最常出问题的检测项</h2>
			<ul class="weak-point-list">
				<?php foreach ( $record['weak_points'] as $point ) : ?>
					<li><code><?php echo esc_html( $point['id'] ?? '' ); ?></code> <?php echo esc_html( (string) ( $point['failures'] ?? 0 ) ); ?> 次失败</li>
				<?php endforeach; ?>
			</ul>
		</section>
	<?php endif; ?>

	<?php if ( ! empty( $record['history'] ) ) : ?>
		<section class="detail-section" data-testid="relay-history-section">
			<h2><?php echo esc_html( $record['title'] ); ?> 全部检测历史 · <?php echo esc_html( (string) count( $record['history'] ) ); ?> 份报告</h2>
			<div class="history-table-wrap">
				<table class="history-table">
					<thead>
						<tr>
							<th>日期</th>
							<th>协议</th>
							<th>测试模型</th>
							<th>分数</th>
							<th>判定</th>
							<th>扣分项</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $record['history'] as $row ) : ?>
							<tr>
								<td><?php echo esc_html( $row['date'] ?? '' ); ?></td>
								<td><?php echo esc_html( $row['protocol'] ?? '' ); ?></td>
								<td><code><?php echo esc_html( $row['model'] ?? '' ); ?></code></td>
								<td><?php echo esc_html( isset( $row['score'] ) ? (string) $row['score'] : '—' ); ?></td>
								<td class="<?php echo esc_attr( lzzen_relay_verdict_class( $row['verdict'] ?? '' ) ); ?>">
									<?php echo esc_html( 'passed' === ( $row['verdict'] ?? '' ) ? '通过' : ( 'failed' === ( $row['verdict'] ?? '' ) ? '失败' : '检测无效' ) ); ?>
								</td>
								<td><?php echo esc_html( isset( $row['deductions'] ) ? (string) $row['deductions'] : '—' ); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</section>
	<?php endif; ?>
</div>
	<?php
endwhile;

get_footer();
