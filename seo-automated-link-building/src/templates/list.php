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
?>

<div class="wrap ilm-admin">
    <h1 class="wp-heading-inline"><?php echo esc_html( $linksHeadline ); ?></h1>
    <a href="admin.php?page=seo-automated-link-building-add-link" class="page-title-action"><?php echo esc_html( $addNewHeadline ); ?></a>
    <hr class="wp-header-end">
    <h2 class="screen-reader-text"><?php esc_html_e( 'Filter links list', 'seo-automated-link-building' ); ?></h2>
    <div class="ilm-filters">
        <a class="ilm-filter <?php echo ( $hasActiveFlag || $onlyAi ) ? '' : 'is-active'; ?>" href="?page=seo-automated-link-building-all-links"><?php echo esc_html( $allTitle ); ?> <span class="count">(<?php echo absint( $linksCount ); ?>)</span></a>
        <a class="ilm-filter <?php echo $onlyActive ? 'is-active' : ''; ?>" href="?page=seo-automated-link-building-all-links&amp;active=1"><?php echo esc_html( $activeTitle ); ?> <span class="count">(<?php echo absint( $activeLinksCount ); ?>)</span></a>
        <a class="ilm-filter <?php echo $onlyInactive ? 'is-active' : ''; ?>" href="?page=seo-automated-link-building-all-links&amp;active=0"><?php echo esc_html( $inactiveTitle ); ?> <span class="count">(<?php echo absint( $inactiveLinksCount ); ?>)</span></a>
        <?php if ( $aiLinksCount > 0 || $onlyAi ) : ?>
        <a class="ilm-filter <?php echo $onlyAi ? 'is-active' : ''; ?>" href="?page=seo-automated-link-building-all-links&amp;origin=ai"><?php echo esc_html( $aiTitle ); ?> <span class="count">(<?php echo absint( $aiLinksCount ); ?>)</span></a>
        <?php endif; ?>
    </div>
    <form method="post">
        <div class="ilm-tablecard">
            <?php $list->display() ?>
        </div>
    </form>
</div>
