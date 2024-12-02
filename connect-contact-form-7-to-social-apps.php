<?php
/*
Plugin Name: Connect Contact Form 7 to Social App
Description: Send a message directly to your WhatsApp account through Contact Form 7 forms.
Author: Geek Code Lab
Version: 2.1.2
Author URI: https://geekcodelab.com/
Text Domain : connect-contact-form-7-to-social-app
Requires Plugins: contact-form-7
*/

if (!defined('ABSPATH')) exit;

define('CF7CW_BUILD', '2.1.2' );
define('CF7CW_PRO_PLUGIN_LINK', 'https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/');

if (!defined("CF7CW_PLUGIN_BASENAME"))
	define("CF7CW_PLUGIN_BASENAME", plugin_basename(__FILE__));

if (!defined("CF7CW_PLUGIN_DIR"))
	define("CF7CW_PLUGIN_DIR", plugin_basename(__DIR__));

if (!defined('CF7CW_PLUGIN_DIR_PATH'))
	define('CF7CW_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

if (!defined('CF7CW_PLUGIN_URL'))
	define('CF7CW_PLUGIN_URL', plugins_url() . '/' . basename(dirname(__FILE__)));


require (CF7CW_PLUGIN_DIR_PATH .'updater/updater.php');

register_activation_hook(__FILE__, 'cf7cw_plugin_active_notice');
function cf7cw_plugin_active_notice()
{
	cf7cw_updater_activate();
	if (is_plugin_active('connect-contact-form-7-to-social-app-pro/connect-contact-form-7-to-social-app-pro.php')) {
		deactivate_plugins('connect-contact-form-7-to-social-app-pro/connect-contact-form-7-to-social-app-pro.php');
	}
}
add_action('upgrader_process_complete', 'cf7cw_updater_activate'); // remove transient on plugin update

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'cf7cw_add_plugin_settings_link');
function cf7cw_add_plugin_settings_link($links)
{
	if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
		$support_link = '<a href="https://geekcodelab.com/contact/" target="_blank" >' . __('Support', 'connect-contact-form-7-to-social-app') . '</a>';
		array_unshift($links, $support_link);

		$pro_link = '<a href="' . CF7CW_PRO_PLUGIN_LINK . '" target="_blank" style="color:#46b450;font-weight: 600;">' . __('Premium Upgrade', 'connect-contact-form-7-to-social-app') . '</a>';
		array_unshift($links, $pro_link);

		$setting_link = '<a href="' . admin_url('admin.php?page=connect-cf7cw') . '">' . __('Settings', 'connect-contact-form-7-to-social-app') . '</a>';
		array_unshift($links, $setting_link);
	}
	return $links;
}

require_once(CF7CW_PLUGIN_DIR_PATH . 'includes/functions.php');
require_once(CF7CW_PLUGIN_DIR_PATH . 'public/class-public.php');
require_once(CF7CW_PLUGIN_DIR_PATH . 'admin/class-admin.php');
require_once(CF7CW_PLUGIN_DIR_PATH . 'includes/customizer/customizer-library/customizer-library.php');
require_once(CF7CW_PLUGIN_DIR_PATH . 'includes/customizer/styles.php');