<?php
/**
 * Created by PhpStorm.
 * User: friedolin
 * Date: 27.01.19
 * Time: 14:52
 */

namespace SeoAutomatedLinkBuilding;


class Settings
{
	protected static $domain = 'seo-automated-link-building';

	protected static $defaults = [
        'blacklist' => '',
        'whitelist' => '',
        'posttypes' => '',
        'exclude' => '',
        'disableAdminTracking' => false,
        'disableStatistics' => false,
    ];

	public static function getDefaults(): array {
		return self::$defaults;
	}

	public static function setDefaults( array $defaults ): void {
		self::$defaults = $defaults;
	}

    public static function init()
    {
        $domain = static::$domain;
        add_option( "{$domain}_settings", json_encode(static::$defaults, JSON_UNESCAPED_UNICODE));
    }


    public static function save(array $values)
    {
        $domain = static::$domain;
	    $current = json_decode(get_option( "{$domain}_settings"), true, 512, JSON_UNESCAPED_UNICODE);
	    $current = is_array($current) ? $current : [];
	    $changed = update_option( "{$domain}_settings", json_encode(array_merge($current, $values), JSON_UNESCAPED_UNICODE));

	    if($changed) {
		    update_option('ilm_admin_message', [
				'message' => esc_html__('Einstellungen gespeichert', Plugin::$domain),
			    'type' => 'success',
		    ]);
	    }

		do_action( "seo_automated_link_settings_saved", $values );
    }

	/**
	 * @return array
	 */
    public static function getRaw()
    {
        $domain = static::$domain;
		$defaults = static::$defaults;
		$result = array_replace_recursive($defaults, json_decode(get_option( "{$domain}_settings"), true, 512, JSON_UNESCAPED_UNICODE));
        return $result;
    }

	/**
	 * @return array
	 */
	public static function getFormValues()
    {
	    $settings = static::getRaw();

		return [
			'whitelist' => esc_html($settings['whitelist']),
			'blacklist' => esc_html($settings['blacklist']),
			'postTypes' => esc_html($settings['posttypes']),
			'exclude' => esc_html($settings['exclude']),
			'disableAdminTracking' => (bool) ($settings['disableAdminTracking'] ?? false),
			'disableStatistics' => (bool) ($settings['disableStatistics'] ?? false),
			'availablePostTypes' => array_keys(get_post_types(['public' => true])),
		];
    }

    protected static function getLines($str)
    {
        $lines = explode("\n", $str);
        $trimmedLines = array_map(function($line) {
            return trim($line);
        }, $lines);
        $validUrls = array_filter($trimmedLines, function($line) {
            return !empty($line);
        });
        return array_values($validUrls);
    }

    public static function get()
    {
        $settings = static::getRaw();
        $settings['blacklist'] = static::getLines($settings['blacklist']);
        $settings['whitelist'] = static::getLines($settings['whitelist']);
        $settings['posttypes'] = static::getLines($settings['posttypes']);
        $settings['exclude'] = static::getLines($settings['exclude']);
        return $settings;
    }
}
