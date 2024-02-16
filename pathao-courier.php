<?php

/**
 * Plugin Name: Pathao Courier
 * Description: Pathao Courier
 * Version: 1.0.4
 * Author: Pathao
 * Text Domain: pathao-courier
 * Requires at least: 6.0
 * Tested up to: 6.4
 * Requires PHP: 7.3
 * Stable tag: 3.18.3
 * Beta tag: 3.18.0-beta4
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
 */

defined( 'ABSPATH' ) || exit;

defined( 'PTC_PLUGIN_URL' ) || define( 'PTC_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
defined( 'PTC_PLUGIN_DIR' ) || define( 'PTC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
defined( 'PTC_PLUGIN_FILE' ) || define( 'PTC_PLUGIN_FILE', plugin_basename( __FILE__ ) );
defined( 'PTC_PLUGIN_PREFIX' ) || define( 'PTC_PLUGIN_PREFIX', 'ptc' );


require_once PTC_PLUGIN_DIR.'/settings-page.php';
require_once PTC_PLUGIN_DIR.'/pathao-bridge.php';
require_once PTC_PLUGIN_DIR.'/plugin-api.php';
require_once PTC_PLUGIN_DIR.'/wc-order-list.php';

// Enqueue styles and scripts
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_script');
function enqueue_custom_admin_script() {

    wp_enqueue_style(
        'ptc-admin-css', 
        plugin_dir_url(__FILE__) . 'css/ptc-admin-style.css',
        null,
        filemtime(plugin_dir_path( __FILE__ ) . '/css/ptc-admin-style.css'),
        'all'
    );

    wp_enqueue_script(
        'ptc-admin-js',
        plugin_dir_url(__FILE__) . 'js/ptc-admin-script.js',
        ['jquery'],
        filemtime(plugin_dir_path( __FILE__ ) . '/js/ptc-admin-script.js'),
        true
    );

    wp_localize_script( 'ptc-admin-js', 'ptcSettings', [
        'nonce' => wp_create_nonce( 'wp_rest' )
    ]);
}
