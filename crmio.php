<?php
/*
Plugin Name: Crmio
Plugin URI: https://crm.io/
Author: 500apps
Author URI: https://500apps.com
Version: 0.1
Description: Let users should be able to move beyond the limitations of older systems by using an innovative cloud-based business PBX phone system. Reduce phone costs and increase call management regardless of business size..
 */

if ( ! defined( 'ABSPATH' ) ) exit;
define('CRMIOFILE_ROOT', __FILE__);
define('CRMIO_DIR', plugin_dir_path(__FILE__));

require __DIR__ . '/crmio_functions.php';
spl_autoload_register('crmio_class_loader');

/**
 * Parse configuration
 */
$settings_crmio = parse_ini_file(__DIR__ . '/crmio_settings.ini', true);
add_action('plugins_loaded', array(\crmioplugin\Crmio::$class, 'init'));

add_action('wp_enqueue_scripts', 'wpCrmioStylesheet');
add_action('admin_enqueue_scripts', 'wpCrmioStylesheet');
function wpCrmioStylesheet() 
{
    wp_enqueue_style( 'crmio_CSS', plugins_url( '/crmio.css', __FILE__ ) );
}

function wpCrmioScripts(){
    wp_register_script('crmio_script', plugins_url('/js/crmio_admin.js', CRMIOFILE_ROOT), array('jquery'),time(),true);
    wp_enqueue_script('crmio_script');
}    

add_action('wp_enqueue_scripts', 'wpCrmioScripts');
add_action('admin_enqueue_scripts', 'wpCrmioScripts');
add_action( 'wp_head', 'crmio_script' );

add_action('wp_ajax_crmio_addtoken', 'crmio_addtoken');
add_action('wp_ajax_crmio_save_website', 'crmio_save_website');