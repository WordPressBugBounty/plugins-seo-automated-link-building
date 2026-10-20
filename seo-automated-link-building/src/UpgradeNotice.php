<?php

namespace SeoAutomatedLinkBuilding;

class UpgradeNotice
{
	/**
	 * Merker, dass die Prüfung auf den KI-Hinweis (Update auf 3.2.0) gelaufen ist
	 */
	const OPTION_AI_NOTICE_CHECKED = 'ilm_ai_notice_checked';

	const OPTION_AI_NOTICE = 'ilm_show_ai_notice';

	public static function init(): void
	{
		self::detectAiUpdate();

	    add_action('upgrader_process_complete', [self::class, 'onPluginUpdate'], 10, 2);
		add_action('admin_notices', [self::class, 'renderNotice']);
		add_action('admin_notices', [self::class, 'renderAiNotice']);
		add_action('admin_enqueue_scripts', [self::class, 'enqueueScripts']);
		add_action('wp_ajax_ilm_dismiss_update_notice', [self::class, 'dismissNotice']);
		add_action('wp_ajax_ilm_dismiss_ai_notice', [self::class, 'dismissAiNotice']);
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

	/**
	 * Einmaliger Hinweis auf den KI-Modus nach dem Update auf 3.2.0.
	 *
	 * Nicht über upgrader_process_complete: der Hook läuft noch mit dem Code der
	 * alten Version und gar nicht bei Updates per ZIP-Upload oder FTP. Stattdessen
	 * einmalig beim Laden prüfen, ob es eine bestehende Installation ist.
	 */
	public static function detectAiUpdate(): void
	{
		if (get_option(self::OPTION_AI_NOTICE_CHECKED) !== false) {
			return;
		}

		// Tabelle schon angelegt => Update einer älteren Version, sonst Neuinstallation
		if (get_option(Plugin::$domain . '_db_version') !== false) {
			update_option(self::OPTION_AI_NOTICE, '1');
			// ersetzt bei diesem Update den Umfrage-Hinweis, damit nicht zwei Hinweise erscheinen
			delete_option('ilm_show_update_notice');
		}

		update_option(self::OPTION_AI_NOTICE_CHECKED, '1');
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

	public static function renderAiNotice(): void
	{
		if (get_option(self::OPTION_AI_NOTICE) !== '1' || !current_user_can('manage_options')) {
			return;
		}

		// wer den KI-Modus geöffnet hat, braucht den Hinweis nicht mehr
		$page = isset($_GET['page']) ? sanitize_key(wp_unslash($_GET['page'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ($page === 'seo-automated-link-building-ai') {
			delete_option(self::OPTION_AI_NOTICE);
			return;
		}

		// Pro-Klassen fehlen im Free-Build
		$isPro = class_exists(Pro\License::class) && Pro\License::canUsePro();
		$url = admin_url('admin.php?page=seo-automated-link-building-ai');

		echo '<div class="notice notice-info is-dismissible ilm-ai-notice">';
		echo '<p><strong>' . esc_html__('New in Internal Links Manager 3.2: AI mode', 'seo-automated-link-building') . '</strong></p>';
		echo '<p>' . esc_html__('Let AI analyze your website: it suggests your most important target pages and matching keywords, and you publish the reviewed links with one click. Works with Google Gemini, OpenAI or Anthropic Claude using your own API key.', 'seo-automated-link-building') . '</p>';
		if (!$isPro) {
			echo '<p>' . esc_html__('The AI mode is part of the Pro version.', 'seo-automated-link-building') . '</p>';
		}
		echo '<p><a class="button button-primary" href="' . esc_url($url) . '">' . esc_html($isPro ? __('Try AI mode', 'seo-automated-link-building') : __('Learn more', 'seo-automated-link-building')) . '</a></p>';
		echo '</div>';
	}

	public static function enqueueScripts(): void
	{
		$notices = [];
		if (get_option('ilm_show_update_notice') === '1') {
			$notices['ilm-update-notice'] = 'ilm_dismiss_update_notice';
		}
		if (get_option(self::OPTION_AI_NOTICE) === '1') {
			$notices['ilm-ai-notice'] = 'ilm_dismiss_ai_notice';
		}

		foreach ($notices as $class => $action) {
			wp_add_inline_script('jquery-core', "
            jQuery(document).on('click', '." . esc_js($class) . " .notice-dismiss', function () {
                jQuery.post(ajaxurl, {
                    action: '" . esc_js($action) . "',
                    nonce: '" . esc_js(wp_create_nonce($action)) . "'
                });
            });
        ");
		}
	}

	public static function dismissNotice(): void
	{
		check_ajax_referer('ilm_dismiss_update_notice', 'nonce');

		delete_option('ilm_show_update_notice');

		wp_send_json_success();
	}

	public static function dismissAiNotice(): void
	{
		check_ajax_referer('ilm_dismiss_ai_notice', 'nonce');

		delete_option(self::OPTION_AI_NOTICE);

		wp_send_json_success();
	}
}