<?php
/*
Plugin Name: Connect Contact Form 7 to Social App
Description: Send a message directly to your WhatsApp account through Contact Form 7 forms.
Author: Geek Code Lab
Version: 2.1
Author URI: https://geekcodelab.com/
Text Domain : connect-contact-form-7-to-social-app
*/

if (!defined('ABSPATH')) exit;

define('CF7CW_PLUGIN_VERSION', 2.1);
define('CF7CW_PRO_PLUGIN_LINK', 'https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/');

if (!defined('CF7CW_PLUGIN_DIR_PATH'))
	define('CF7CW_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

if (!defined('CF7CW_PLUGIN_URL'))
	define('CF7CW_PLUGIN_URL', plugins_url() . '/' . basename(dirname(__FILE__)));

/**
 * Admin notice when Contact form 7 is not active
 */
add_action( 'admin_init', 'cf7cw_plugin_load' );
function cf7cw_plugin_load(){
	if ( ! ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) ) {
		add_action( 'admin_notices', 'cf7cw_install_contact_form_7_admin_notice' );
		deactivate_plugins("connect-contact-form-7-to-social-apps/connect-contact-form-7-to-social-apps.php");
		return;
	}
}

function cf7cw_install_contact_form_7_admin_notice(){ ?>
	<div class="error">
		<p>
			<?php
			// translators: %s is the plugin name.
			echo esc_html( sprintf( __( '%s is enabled but not effective. It requires Contact Form 7 in order to work.', 'connect-contact-form-7-to-social-app' ), 'Connect Contact Form 7 to Social App' ) );
			?>
		</p>
	</div>
	<?php
}

register_activation_hook(__FILE__, 'cf7cw_plugin_active_notice');
function cf7cw_plugin_active_notice()
{
	if (is_plugin_active('connect-contact-form-7-to-social-app-pro/connect-contact-form-7-to-social-app-pro.php')) {
		deactivate_plugins('connect-contact-form-7-to-social-app-pro/connect-contact-form-7-to-social-app-pro.php');
	}
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'cf7cw_add_plugin_settings_link');
function cf7cw_add_plugin_settings_link($links)
{
	if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
		$support_link = '<a href="https://geekcodelab.com/contact/" target="_blank" >' . __('Support', 'connect-contact-form-7-to-social-app') . '</a>';
		array_unshift($links, $support_link);

		$pro_link = '<a href="' . CF7CW_PRO_PLUGIN_LINK . '" target="_blank" style="color:#46b450;font-weight: 600;">' . __('Premium Upgrade') . '</a>';
		array_unshift($links, $pro_link);

		$setting_link = '<a href="' . admin_url('admin.php?page=wpcf7') . '">' . __('Settings', 'connect-contact-form-7-to-social-app') . '</a>';
		array_unshift($links, $setting_link);
	}
	return $links;
}


require_once(CF7CW_PLUGIN_DIR_PATH . 'functions.php');
require_once(CF7CW_PLUGIN_DIR_PATH . 'class-admin.php');
