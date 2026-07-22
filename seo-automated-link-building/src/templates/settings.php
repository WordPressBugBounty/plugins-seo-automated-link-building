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

<?php
$default_tab = null;
$tab = isset($_GET['tab']) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : $default_tab; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
$save_disabled = false;
$action = '';
?>

<div class="wrap ilm-settings">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'Settings', 'seo-automated-link-building' ); ?></h1>

    <form id="save-settings" method="post" action="<?php echo esc_url( $adminPostUrl ); ?>">

        <nav class="nav-tab-wrapper">
            <a href="?page=seo-automated-link-building-settings" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>"><?php esc_html_e( 'General settings', 'seo-automated-link-building' ); ?></a>
            <a href="?page=seo-automated-link-building-settings&tab=content" class="nav-tab <?php if($tab==='content'):?>nav-tab-active<?php endif; ?>"><?php esc_html_e( 'Content', 'seo-automated-link-building' ); ?></a>
            <a href="?page=seo-automated-link-building-settings&tab=caching" class="nav-tab <?php if($tab==='caching'):?>nav-tab-active<?php endif; ?>"><?php esc_html_e( 'Caching', 'seo-automated-link-building' ); ?></a>
            <a href="?page=seo-automated-link-building-settings&tab=plugins" class="nav-tab <?php if($tab==='plugins'):?>nav-tab-active<?php endif; ?>"><?php esc_html_e( '3rd party plugins', 'seo-automated-link-building' ); ?></a>
        </nav>

        <div class="tab-content">

			<?php switch($tab) :
				case 'caching':
					$save_disabled = true;
					include __DIR__ . '/partials/cache-settings.php';
					break;
				case 'content':
					$action = 'seo_automated_link_building_settings';
					include __DIR__ . '/partials/content-settings.php';
					break;
				case 'plugins':
					$save_disabled = true;
					include __DIR__ . '/partials/plugins-settings.php';
					break;
				default:
					$action = 'seo_automated_link_building_settings';
					include __DIR__ . '/partials/general-settings.php';
					break;
			endswitch; ?>
        </div>

        <input type="hidden" name="action" value="<?php echo esc_attr( $action ); ?>" />
		<?php wp_nonce_field( $action, 'nonce' ); ?>
		<?php if ($save_disabled === true) {
			?> <input type="submit" disabled="disabled" class="button button-primary" value="<?php esc_html_e( 'Save', 'seo-automated-link-building' ); ?>"> <?php
		} else {
			?> <input type="submit" class="button button-primary" value="<?php esc_html_e( 'Save', 'seo-automated-link-building' ); ?>"> <?php
		}
		?>
    </form>
</div>
