<?php

if (!defined('ABSPATH')) exit;

/**
 * License manager module
 */
function cf7cw_updater_utility() {
    $prefix = 'CF7CW_';
    $settings = [
        'prefix' => $prefix,
        'get_base' => CF7CW_PLUGIN_BASENAME,
        'get_slug' => CF7CW_PLUGIN_DIR,
        'get_version' => CF7CW_BUILD,
        'get_api' => 'https://download.geekcodelab.com/',
        'license_update_class' => $prefix . 'Update_Checker'
    ];

    return $settings;
}

function cf7cw_updater_activate() {

    // Refresh transients
    delete_site_transient('update_plugins');
    delete_transient('cf7cw_plugin_updates');
    delete_transient('cf7cw_plugin_auto_updates');
}

require_once(CF7CW_PLUGIN_DIR_PATH . 'updater/class-update-checker.php');
