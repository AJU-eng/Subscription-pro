<?php
/**
 * Plugin Name:       subscription pro
 * Description:       A test platform.
 * Requires at least: 6.6
 * Requires PHP:      6.6
 * Version:           1.0.0
 * Author:            Ajay kumar
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       subscription-pro
 */




add_action('admin_menu', 'subscription_init_menu');
add_action('plugins_loaded', 'subscription_pro_init', 20);


function subscription_pro_init() {
    // Check if WooCommerce is active
    if (!class_exists('WooCommerce')) {
        add_action('admin_notices', 'subscription_pro_missing_wc_notice');
        return;
    }

    // Your plugin code
    add_action('admin_menu', 'subscription_init_menu');

    require_once plugin_dir_path(__FILE__) . 'includes/acws-api.php';
    require_once plugin_dir_path(__FILE__) . 'includes/acws-callbacks.php';
    require_once plugin_dir_path(__FILE__) . 'includes/acws-hooks.php';

    $callbacks = new Acws_callbacks();
    $api  = new Acws_api($callbacks);
    new Acws_hooks();
}






/**
 * Init Admin Menu.
 *
 * @return void
 */
function subscription_init_menu()
{
    add_menu_page(__('subscription', 'subscription-pro'), __('subscription', 'subscription-pro'), 'manage_options', 'subscription-pro', 'subscription_admin_page', 'dashicons-admin-post', '2.1');
}

/**
 * Init Admin Page.
 *
 * @return void
 */
function subscription_admin_page()
{
    require_once plugin_dir_path(__FILE__) . 'templates/app.php';
}

add_action('admin_enqueue_scripts', 'subscription_admin_enqueue_scripts');



/**
 * Enqueue scripts and styles.
 *
 * @return void
 */



function subscription_admin_enqueue_scripts()
{
    wp_enqueue_script(
        'subscription-script',
        plugin_dir_url(__FILE__) . 'build/index.js',
        array('wp-element'),
        '1.0.0',
        true
    );
    wp_enqueue_script(
        'backend-script',
        plugin_dir_url(__FILE__) . 'js/backend.js',
        array('wp-element'),
        '1.0.0',
        true
    );
    wp_localize_script('subscription-script', 'subscriptionPluginData', array(
        'apiUrl' => rest_url('acws/v1/')
    ));

    wp_enqueue_style(
        'subscription-style',
        plugin_dir_url(__FILE__) . 'build/index.css',
        array(), // Dependencies, if any
        '1.0.0' // Version number
    );
    wp_enqueue_style(
        'backend-style',
        plugin_dir_url(__FILE__) . 'backend.scss',
        array(), // Dependencies, if any
        '1.0.0' // Version number
    );
    
}

// $callbacks = new Acws_callbacks();

// $api  = new Acws_api($callbacks);

// new Acws_hooks();


