<?php
/**
 * Internal Links Manager
 * Copyright (C) 2021 webraketen GmbH
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You can read the GNU General Public License here: <https://www.gnu.org/licenses/>.
 * For questions related to this program contact post@webraketen-media.de
 */

$clickValues  = array_map( function ( $entry ) {
	return isset( $entry['y'] ) ? (int) $entry['y'] : 0;
}, is_array( $counts ) ? $counts : [] );
$totalClicks  = array_sum( $clickValues );
$bestDayCount = empty( $clickValues ) ? 0 : max( $clickValues );
?>
<div class="wrap ilm-admin">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'Statistic', 'seo-automated-link-building' ); ?></h1>
    <?php if ( $hasEntries ) : ?>
        <div class="ilm-metrics">
            <div class="ilm-metric">
                <div class="ilm-metric__value"><?php echo esc_html( number_format_i18n( $totalClicks ) ); ?></div>
                <div class="ilm-metric__label"><?php esc_html_e( 'Clicks (last 28 days)', 'seo-automated-link-building' ); ?></div>
            </div>
            <div class="ilm-metric">
                <div class="ilm-metric__value"><?php echo esc_html( number_format_i18n( $bestDayCount ) ); ?></div>
                <div class="ilm-metric__label"><?php esc_html_e( 'Best day', 'seo-automated-link-building' ); ?></div>
            </div>
        </div>

        <div class="ilm-seg" role="group" style="margin-bottom:14px">
            <a href="#" class="tab-link ilm-seg__btn">28 <?php esc_html_e( 'Days', 'seo-automated-link-building' ); ?></a>
            <a href="#" class="tab-link ilm-seg__btn"><?php esc_html_e( 'Overall', 'seo-automated-link-building' ); ?></a>
        </div>

        <div class="tab">
            <div class="ilm-card ilm-card--wide">
                <div class="ilm-chart-wrap">
                    <canvas id="daysChart"></canvas>
                </div>
            </div>
            <form method="post">
                <div class="ilm-tablecard">
                    <?php $list->display() ?>
                </div>
            </form>
        </div>

        <div class="tab">
            <div class="ilm-card ilm-card--wide">
                <div class="ilm-chart-wrap">
                    <canvas id="bestChart"></canvas>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>
