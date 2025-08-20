<?php

/*
Plugin Name: Internal Links Manager
Description: Build internal links easily.
Version:     3.0.0
Author:      webraketen
Author URI:  https://www.webraketen.io
License:     GPLv2 or later
Text Domain: seo-automated-link-building
Domain Path: /lang
*/
if ( function_exists( 'ilm_fs' ) ) {
    ilm_fs()->set_basename( false, __FILE__ );
} else {
    if ( !function_exists( 'ilm_fs' ) ) {
        // Create a helper function for easy SDK access.
        function ilm_fs() {
            global $ilm_fs;
            if ( !isset( $ilm_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/vendor/freemius/start.php';
                $ilm_fs = fs_dynamic_init( array(
                    'id'             => '12495',
                    'slug'           => 'seo-automated-link-building',
                    'premium_slug'   => 'internal-links-manager',
                    'type'           => 'plugin',
                    'public_key'     => 'pk_5093aa5cd0d80ea48987b64e63c76',
                    'is_premium'     => false,
                    'premium_suffix' => 'Pro Plan',
                    'has_addons'     => false,
                    'has_paid_plans' => true,
                    'trial'          => array(
                        'days'               => 10,
                        'is_require_payment' => false,
                    ),
                    'menu'           => array(
                        'slug' => 'seo-automated-link-building-all-links',
                    ),
                    'is_live'        => true,
                ) );
            }
            return $ilm_fs;
        }

        // Init Freemius.
        ilm_fs();
        // Signal that SDK was initiated.
        do_action( 'ilm_fs_loaded' );
    }
    require_once __DIR__ . '/vendor/autoload.php';
    if ( is_admin() ) {
        $result = load_textdomain( 'seo-automated-link-building', plugin_dir_path( __FILE__ ) . 'lang/seo-automated-link-building-de_DE.mo', 'de_DE' );
    }
    $name = plugin_basename( __FILE__ );
    new \SeoAutomatedLinkBuilding\Plugin($name);
}