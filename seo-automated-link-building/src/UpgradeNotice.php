<?php

namespace SeoAutomatedLinkBuilding;

class UpgradeNotice
{
	public static function init(): void
	{
	    add_action('upgrader_process_complete', [self::class, 'onPluginUpdate'], 10, 2);
		add_action('admin_notices', [self::class, 'renderNotice']);
		add_action('admin_enqueue_scripts', [self::class, 'enqueueScripts']);
		add_action('wp_ajax_ilm_dismiss_update_notice', [self::class, 'dismissNotice']);
	}

	public static function onPluginUpdate($upgrader, array $hookExtra): void
	{
		if (($hookExtra['type'] ?? '') !== 'plugin') {
			return;
		}

		$isPluginUpdate = (
			($hookExtra['action'] ?? '') === 'update'
			&& isset($upgrader->new_plugin_data['Name'])
			&& $upgrader->new_plugin_data['Name'] === 'Internal Links Manager'
		);

		$isPluginInstallOrReplace = (
			($hookExtra['action'] ?? '') === 'install'
			&& isset($upgrader->new_plugin_data['Name'])
			&& $upgrader->new_plugin_data['Name'] === 'Internal Links Manager'
		);

		if ($isPluginUpdate || $isPluginInstallOrReplace) {
			update_option('ilm_show_update_notice', '1');
		}
	}

	public static function renderNotice(): void
	{
		if (get_option('ilm_show_update_notice') !== '1') {
			return;
		}

		echo '<div class="notice notice-success is-dismissible ilm-update-notice">';
		echo '<p><strong>' . esc_html( __('Got 60 Seconds?', 'seo-automated-link-building') ) . '</strong></p>';
		echo '<p>' . wp_kses_post( __('Help us make the Internal Links Manager even better for your workflow. Share your feedback in our quick <a href="https://forms.gle/bVNDBcVbf5s3mTDe8" target="_blank">user survey</a>!', 'seo-automated-link-building') ) . '</p>';
		echo '<p><a class="button button-primary" href="https://forms.gle/bVNDBcVbf5s3mTDe8" target="_blank">' . esc_html( __('Get involved now', 'seo-automated-link-building') ) . '</a></p>';
		echo '</div>';
	}

	public static function enqueueScripts(): void
	{
		if (get_option('ilm_show_update_notice') !== '1') {
			return;
		}

		wp_add_inline_script('jquery-core', "
            jQuery(document).on('click', '.ilm-update-notice .notice-dismiss', function () {
                jQuery.post(ajaxurl, {
                    action: 'ilm_dismiss_update_notice',
                    nonce: '" . esc_js(wp_create_nonce('ilm_dismiss_update_notice')) . "'
                });
            });
        ");
	}

	public static function dismissNotice(): void
	{
		check_ajax_referer('ilm_dismiss_update_notice', 'nonce');

		delete_option('ilm_show_update_notice');

		wp_send_json_success();
	}
}