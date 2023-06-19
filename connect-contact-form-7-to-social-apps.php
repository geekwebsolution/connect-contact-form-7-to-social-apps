<?php
/*
Plugin Name: Connect Contact Form 7 to Social App
Description: Send a message directly to your WhatsApp account through Contact Form 7 forms.
Author: Geek Code Lab
Version: 1.9
Author URI: https://geekcodelab.com/
Text Domain : connect-contact-form-7-to-social-app
*/

if (!defined('ABSPATH')) exit;

define('CF7CW_PLUGIN_VERSION', 1.9);
define('CF7CW_PRO_PLUGIN_LINK', 'https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/');

if (!defined('CF7CW_PLUGIN_DIR_PATH'))
	define('CF7CW_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

if (!defined('CF7CW_PLUGIN_URL'))
	define('CF7CW_PLUGIN_URL', plugins_url() . '/' . basename(dirname(__FILE__)));

register_activation_hook(__FILE__, 'cf7cw_plugin_active_notice');
function cf7cw_plugin_active_notice()
{
	if (!(is_plugin_active('contact-form-7/wp-contact-form-7.php'))) {
		die('Connect Contact Form 7 to Social App plugin is deactivated because it require Contact Form 7 plugin installed and activated.');
	}

	if (is_plugin_active('connect-contact-form-7-to-social-app-pro/connect-contact-form-7-to-social-app-pro.php')) {
		deactivate_plugins('connect-contact-form-7-to-social-app-pro/connect-contact-form-7-to-social-app-pro.php');
	}
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'cf7cw_add_plugin_settings_link');
function cf7cw_add_plugin_settings_link($links)
{
	$support_link = '<a href="https://geekcodelab.com/contact/" target="_blank" >' . __('Support', 'connect-contact-form-7-to-social-app') . '</a>';
	array_unshift($links, $support_link);

	$pro_link = '<a href="' . CF7CW_PRO_PLUGIN_LINK . '" target="_blank" style="color:#46b450;font-weight: 600;">' . __('Premium Upgrade') . '</a>';
	array_unshift($links, $pro_link);

	$setting_link = '<a href="' . admin_url('admin.php?page=wpcf7') . '">' . __('Settings', 'connect-contact-form-7-to-social-app') . '</a>';
	array_unshift($links, $setting_link);

	return $links;
}


require_once(CF7CW_PLUGIN_DIR_PATH . 'functions.php');
require_once(CF7CW_PLUGIN_DIR_PATH . 'class-admin.php');
