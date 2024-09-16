<?php
if (!defined('ABSPATH')) exit;

$options = cf7cw_options();

if (isset($_POST['cf7cw_save_changes'])) {
    $updated_option = array();

    if (isset($_POST['_wpnonce']) && wp_verify_nonce(sanitize_text_field($_POST['_wpnonce']), 'cf7cw_wpnonce')) {

        $updated_option['whatsapp_info']['country_name']    = isset($_POST['country_name']) ? sanitize_text_field($_POST['country_name']) : '';
        $updated_option['whatsapp_info']['country_code']    = isset($_POST['country_code']) ? sanitize_text_field($_POST['country_code']) : '';
        $updated_option['whatsapp_info']['wh_number']       = isset($_POST['wh_number']) ? sanitize_text_field($_POST['wh_number']) : '';

        $updated_option['customize_form']['chat_widget_icon_size']    = isset($_POST['chat_widget_icon_size']) ? sanitize_text_field($_POST['chat_widget_icon_size']) : '';
        $updated_option['customize_form']['chat_widget_icon_size_custom']  = isset($_POST['chat_widget_icon_size_custom']) ? sanitize_text_field($_POST['chat_widget_icon_size_custom']) : '';
        $updated_option['customize_form']['chat_widget_icon_position']  = isset($_POST['chat_widget_icon_position']) ? sanitize_text_field($_POST['chat_widget_icon_position']) : '';

        $updated_option['customize_form']['chat_widget_cta_switch']  = isset($_POST['chat_widget_cta_switch']) ? sanitize_text_field($_POST['chat_widget_cta_switch']) : '';
        $updated_option['customize_form']['chat_widget_cta_text']  = isset($_POST['chat_widget_cta_text']) ? sanitize_text_field($_POST['chat_widget_cta_text']) : '';
        $updated_option['customize_form']['chat_widget_cta_text_size']  = isset($_POST['chat_widget_cta_text_size']) ? sanitize_text_field($_POST['chat_widget_cta_text_size']) : '';
        $updated_option['customize_form']['chat_widget_cta_text_size_custom']  = isset($_POST['chat_widget_cta_text_size_custom']) ? sanitize_text_field($_POST['chat_widget_cta_text_size_custom']) : '';

        $updated_option['customize_form']['chat_widget_contact_form_7']  = isset($_POST['chat_widget_contact_form_7']) ? sanitize_text_field($_POST['chat_widget_contact_form_7']) : '';
        $updated_option['customize_form']['chat_widget_form_title']  = isset($_POST['chat_widget_form_title']) ? sanitize_text_field($_POST['chat_widget_form_title']) : '';
        $updated_option['customize_form']['chat_widget_header_text']  = isset($_POST['chat_widget_header_text']) ? sanitize_text_field($_POST['chat_widget_header_text']) : '';
        $updated_option['customize_form']['chat_widget_footer_text']  = isset($_POST['chat_widget_footer_text']) ? sanitize_text_field($_POST['chat_widget_footer_text']) : '';
        $updated_option['customize_form']['chat_widget_form_font_family']  = isset($_POST['chat_widget_form_font_family']) ? sanitize_text_field($_POST['chat_widget_form_font_family']) : '';

        $updated_option['customize_form']['chat_widget_form_behaviour_open_by_default']  = isset($_POST['chat_widget_form_behaviour_open_by_default']) ? sanitize_text_field($_POST['chat_widget_form_behaviour_open_by_default']) : '';
        $updated_option['customize_form']['chat_widget_form_behaviour_close_on_submit']  = isset($_POST['chat_widget_form_behaviour_close_on_submit']) ? sanitize_text_field($_POST['chat_widget_form_behaviour_close_on_submit']) : '';


        $updated_option['greetings']['display_greeting_popup']  = isset($_POST['display_greeting_popup']) ? sanitize_text_field($_POST['display_greeting_popup']) : '';
        $updated_option['greetings']['choose_greetings_template']  = isset($_POST['choose_greetings_template']) ? sanitize_text_field($_POST['choose_greetings_template']) : '';
        $updated_option['greetings']['choose_simple_greetings_template_type']  = isset($_POST['choose_simple_greetings_template_type']) ? sanitize_text_field($_POST['choose_simple_greetings_template_type']) : '';
        $updated_option['greetings']['choose_wave_greetings_template_type']  = isset($_POST['choose_wave_greetings_template_type']) ? sanitize_text_field($_POST['choose_wave_greetings_template_type']) : '';

        $updated_option['greetings']['simple_greetings_heading']  = isset($_POST['simple_greetings_heading']) ? sanitize_text_field($_POST['simple_greetings_heading']) : '';
        $updated_option['greetings']['simple_greetings_heading_size']  = isset($_POST['simple_greetings_heading_size']) ? sanitize_text_field($_POST['simple_greetings_heading_size']) : '';
        $updated_option['greetings']['simple_greetings_heading_custom_size']  = isset($_POST['simple_greetings_heading_custom_size']) ? sanitize_text_field($_POST['simple_greetings_heading_custom_size']) : '';
        $updated_option['greetings']['simple_greetings_message']  = isset($_POST['simple_greetings_message']) ? sanitize_text_field($_POST['simple_greetings_message']) : '';
        $updated_option['greetings']['simple_greetings_message_size']  = isset($_POST['simple_greetings_message_size']) ? sanitize_text_field($_POST['simple_greetings_message_size']) : '';
        $updated_option['greetings']['simple_greetings_message_custom_size']  = isset($_POST['simple_greetings_message_custom_size']) ? sanitize_text_field($_POST['simple_greetings_message_custom_size']) : '';
        $updated_option['greetings']['simple_greetings_style_1_font_family']  = isset($_POST['simple_greetings_style_1_font_family']) ? sanitize_text_field($_POST['simple_greetings_style_1_font_family']) : '';

        $updated_option['greetings']['wave_greetings_show_main_content']  = isset($_POST['wave_greetings_show_main_content']) ? sanitize_text_field($_POST['wave_greetings_show_main_content']) : '';
        $updated_option['greetings']['wave_greetings_style_1_custom_icon']  = isset($_POST['wave_greetings_style_1_custom_icon']) ? sanitize_text_field($_POST['wave_greetings_style_1_custom_icon']) : '';
        $updated_option['greetings']['wave_greetings_style_1_icon_position']  = isset($_POST['wave_greetings_style_1_icon_position']) ? sanitize_text_field($_POST['wave_greetings_style_1_icon_position']) : '';
        $updated_option['greetings']['wave_greetings_style_1_greeting_heading']  = isset($_POST['wave_greetings_style_1_greeting_heading']) ? sanitize_text_field($_POST['wave_greetings_style_1_greeting_heading']) : '';
        $updated_option['greetings']['wave_greetings_style_1_heading_size']  = isset($_POST['wave_greetings_style_1_heading_size']) ? sanitize_text_field($_POST['wave_greetings_style_1_heading_size']) : '';
        $updated_option['greetings']['wave_greetings_style_1_heading_custom_size']  = isset($_POST['wave_greetings_style_1_heading_custom_size']) ? sanitize_text_field($_POST['wave_greetings_style_1_heading_custom_size']) : '';
        $updated_option['greetings']['wave_greetings_style_1_message']  = isset($_POST['wave_greetings_style_1_message']) ? sanitize_text_field($_POST['wave_greetings_style_1_message']) : '';
        $updated_option['greetings']['wave_greetings_style_1_message_size']  = isset($_POST['wave_greetings_style_1_message_size']) ? sanitize_text_field($_POST['wave_greetings_style_1_message_size']) : '';
        $updated_option['greetings']['wave_greetings_style_1_message_custom_size']  = isset($_POST['wave_greetings_style_1_message_custom_size']) ? sanitize_text_field($_POST['wave_greetings_style_1_message_custom_size']) : '';

        $updated_option['greetings']['wave_greetings_style_1_show_greeting_cta']  = isset($_POST['wave_greetings_style_1_show_greeting_cta']) ? sanitize_text_field($_POST['wave_greetings_style_1_show_greeting_cta']) : '';
        $updated_option['greetings']['wave_greetings_style_1_greeting_cta_text']  = isset($_POST['wave_greetings_style_1_greeting_cta_text']) ? sanitize_text_field($_POST['wave_greetings_style_1_greeting_cta_text']) : '';
        $updated_option['greetings']['wave_greetings_style_1_font_family']  = isset($_POST['wave_greetings_style_1_font_family']) ? sanitize_text_field($_POST['wave_greetings_style_1_font_family']) : '';

        $updated_option['greetings']['greeting_behavior_on_click_action']  = isset($_POST['greeting_behavior_on_click_action']) ? sanitize_text_field($_POST['greeting_behavior_on_click_action']) : '';

        $updated_option['triggers-targeting']['triggers_activate_cf7_form_chat_widget']  = isset($_POST['triggers_activate_cf7_form_chat_widget']) ? sanitize_text_field($_POST['triggers_activate_cf7_form_chat_widget']) : '';
        $updated_option['triggers-targeting']['triggers_time_delay']  = isset($_POST['triggers_time_delay']) ? sanitize_text_field($_POST['triggers_time_delay']) : '';
        $updated_option['triggers-targeting']['triggers_show_form_after_second']  = isset($_POST['triggers_show_form_after_second']) ? sanitize_text_field($_POST['triggers_show_form_after_second']) : '';
        $updated_option['triggers-targeting']['targeting_exclude_pages']  = isset($_POST['targeting_exclude_pages']) ? array_map('sanitize_text_field', $_POST['targeting_exclude_pages']) : array();
        $updated_option['triggers-targeting']['targeting_exclude_all_except_switch']  = isset($_POST['targeting_exclude_all_except_switch']) ? sanitize_text_field($_POST['targeting_exclude_all_except_switch']) : '';
        $updated_option['triggers-targeting']['targeting_exclude_all_except_pages']  = isset($_POST['targeting_exclude_all_except_pages']) ? array_map('sanitize_text_field', $_POST['targeting_exclude_all_except_pages']) : array();
    }

    if (sizeof($updated_option) > 0) {
        update_option('cf7cw_options', $updated_option);
        wp_safe_redirect(admin_url('admin.php?page=connect-cf7cw#step=1'));
    }
}
?>
<div class="cf7cw-main-wrapper">
    <?php
    if (isset($_GET['settings'])) {
        $query_settings = sanitize_text_field($_GET['settings']);
        if ($query_settings == 'save') {
            ?>
            <div class="notice notice-success wdgk-success-msg is-dismissible">
                <p><?php esc_html_e('Settings Saved!', 'connect-contact-form-7-to-social-app'); ?></p>
            </div>
            <?php
        }
    }
    ?>
    <div class="cf7cw-nav-tab-wrapper">
        <nav class="cf7cw-nav-tab">
            <ul>
                <li class="cf7cw-nav-tab-active">
                    <div class="cf7cw-nav-tab-progress-bar"></div>
                    <button class="cf7cw-nav-tab-btn" data-step="1">
                        <span class="cf7cw-nav-tab-btn-num">1</span>
                        <span class="cf7cw-nav-tab-btn-text"><?php esc_html_e('WhatsApp Info', 'connect-contact-form-7-to-social-app'); ?></span>
                    </button>
                </li>
                <li>
                    <div class="cf7cw-nav-tab-progress-bar"></div>
                    <button class="cf7cw-nav-tab-btn" data-step="2">
                        <span class="cf7cw-nav-tab-btn-num">2</span>
                        <span class="cf7cw-nav-tab-btn-text"><?php esc_html_e('Customize Form', 'connect-contact-form-7-to-social-app'); ?></span>
                    </button>
                </li>
                <li>
                    <div class="cf7cw-nav-tab-progress-bar"></div>
                    <button class="cf7cw-nav-tab-btn" data-step="3">
                        <span class="cf7cw-nav-tab-btn-num">3</span>
                        <span class="cf7cw-nav-tab-btn-text"><?php esc_html_e('Greetings', 'connect-contact-form-7-to-social-app'); ?></span>
                    </button>
                </li>
                <li>
                    <div class="cf7cw-nav-tab-progress-bar"></div>
                    <button class="cf7cw-nav-tab-btn" data-step="4">
                        <span class="cf7cw-nav-tab-btn-num">4</span>
                        <span class="cf7cw-nav-tab-btn-text"><?php esc_html_e('Triggers & Targeting', 'connect-contact-form-7-to-social-app'); ?></span>
                    </button>
                </li>
            </ul>
        </nav>
    </div>

    <div class="cf7cw_wrap">
        <div class="cf7cw_inner cf7cw_option_section">
            <form method="post" id="cf7cw_option_form">
                <?php wp_nonce_field('cf7cw_wpnonce'); ?>
                <div class="cf7cw-step-panel">
                    <div class="cf7cw-step-panel-inr">

                        <div class="cf7cw-step-panel-header">
                            <h2 class="cf7cw-step-label" data-step="1"><?php esc_html_e('Step 1: WhatsApp Info', 'connect-contact-form-7-to-social-app'); ?></h2>
                            <h2 class="cf7cw-step-label" data-step="2" style="display:none;"><?php esc_html_e('Step 2: Customize Form', 'connect-contact-form-7-to-social-app'); ?></h2>
                            <h2 class="cf7cw-step-label" data-step="3" style="display:none;"><?php esc_html_e('Step 3: Greetings', 'connect-contact-form-7-to-social-app'); ?></h2>
                            <h2 class="cf7cw-step-label" data-step="4" style="display:none;"><?php esc_html_e('Step 4: Triggers & Targeting', 'connect-contact-form-7-to-social-app'); ?></h2>
                            <div class="cf7cw-step-panel-pagination">
                                <button type="button" class="cf7cw-sec-btn cf7cw-prev-btn"><?php esc_html_e('Back', 'connect-contact-form-7-to-social-app'); ?></button>
                                <button type="button" class="cf7cw-sec-btn cf7cw-next-btn"><?php esc_html_e('Next', 'connect-contact-form-7-to-social-app'); ?></button>
                                <input class="cf7cw-sec-btn cf7cw-submit-btn" type="submit" name="cf7cw_save_changes" id="cf7cw_save_changes" style="display:none;" value="<?php esc_attr_e('Save Changes', 'connect-contact-form-7-to-social-app'); ?>" />
                            </div>
                        </div>

                        <div class="cf7cw-step-panel-body">
                            <div class="cf7cw-step" data-step="1">
                                <div class="cf7cw-row">
                                    <div class="cf7cw-col-lg-5">
                                        <div class="cf7cw-step-box">
                                            <div class="cf7cw-block-box">
                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('WhatsApp Number', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <input type="hidden" id="country_name_input" name="country_name" value="<?php esc_attr_e($options['whatsapp_info']['country_name']); ?>">
                                                    <input type="hidden" id="country_code_input" name="country_code" value="<?php esc_attr_e($options['whatsapp_info']['country_code']); ?>">
                                                    <input id="cf7cw_wh_number" name="wh_number" type="text" class="cf7cw-field cf7cw-input cf7cw-required" placeholder="WhatsApp Number" value="<?php esc_attr_e($options['whatsapp_info']['wh_number']); ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                </div>                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cf7cw-step" data-step="2">
                                <div class="cf7cw-row">
                                    <div class="cf7cw-col-lg-5">
                                        <div class="cf7cw-step-box">
                                            <div class="cf7cw-block-box">
                                                <h3><?php esc_html_e('Customize Icon', 'connect-contact-form-7-to-social-app'); ?></h3>

                                                <?php
                                                // Get the URL of the image using the attachment ID
                                                $cwci_file_url = plugin_dir_url(__DIR__) . 'assets/images/whatsapp.svg';
                                                ?>
                                                <div class="cf7cw-form-table cf7cw-form-pro-field">
                                                    <h4>
                                                        <?php esc_html_e('Custom Icon', 'connect-contact-form-7-to-social-app'); ?>
                                                        <a target="_blank" class="cf7cw-pro-label" href="https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6z"/></svg>Pro</a>
                                                    </h4>
                                                    <div class="cf7cw-file-upload">
                                                        <input type="text" id="cf7cw_customize_icon_url" name="chat_widget_custom_icon" value="" readonly />
                                                        <button type="button" id="cf7cw_customize_icon_upload" class="cf7cw-upload-button">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                                                            </svg>
                                                        </button>
                                                        <?php if ($cwci_file_url) : ?>
                                                            <div class="cf7cw-file-preview">
                                                                <img src="<?php echo esc_url($cwci_file_url); ?>" alt="Selected File" />
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="cf7cw_note">
                                                        <div class="cf7cw_note_icon">
                                                            <span class="mask_icon"></span>
                                                        </div>
                                                        <div class="cf7cw_note_content"><?php esc_html_e('Recommended size for custom icon : 64x64'); ?></div>
                                                    </div>
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Icon Size', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <div class="cf7cw-field-group-wp">
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="chat_widget_icon_size_small" name="chat_widget_icon_size" value="small" <?php checked($options['customize_form']['chat_widget_icon_size'], "small"); ?>>
                                                            <label for="chat_widget_icon_size_small"><?php esc_html_e('Small', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="chat_widget_icon_size_medium" name="chat_widget_icon_size" value="medium" <?php checked($options['customize_form']['chat_widget_icon_size'], "medium"); ?>>
                                                            <label for="chat_widget_icon_size_medium"><?php esc_html_e('Medium', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="chat_widget_icon_size_large" name="chat_widget_icon_size" value="large" <?php checked($options['customize_form']['chat_widget_icon_size'], "large"); ?>>
                                                            <label for="chat_widget_icon_size_large"><?php esc_html_e('Large', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="chat_widget_icon_size_custom" name="chat_widget_icon_size" value="custom" data-group="chat_widget_icon_size_group" <?php checked($options['customize_form']['chat_widget_icon_size'], "custom"); ?>>
                                                            <label for="chat_widget_icon_size_custom"><?php esc_html_e('Custom', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="cf7cw-form-table chat_widget_icon_size_group <?php esc_attr_e($options['customize_form']['chat_widget_icon_size'] != "custom" ? 'cf7cw-hidden' : ''); ?>">
                                                        <h4><?php esc_html_e('Custom Icon Size', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                        <div class="cf7cw-input-range-wp">
                                                            <input type="range" class="cf7cw-input-range" id="chat_widget_icon_size_custom" name="chat_widget_icon_size_custom" min="10" max="300" value="<?php esc_attr_e($options['customize_form']['chat_widget_icon_size_custom']); ?>">
                                                            <span class="cf7cw-range-px"><?php esc_attr_e($options['customize_form']['chat_widget_icon_size_custom']); ?>px</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Icon Position', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <div class="cf7cw-field-group-wp">
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="chat_widget_icon_position_left" name="chat_widget_icon_position" value="left" <?php checked($options['customize_form']['chat_widget_icon_position'], "left"); ?>>
                                                            <label for="chat_widget_icon_position_left"><?php esc_html_e('Left', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="chat_widget_icon_position_right" name="chat_widget_icon_position" value="right" <?php checked($options['customize_form']['chat_widget_icon_position'], "right"); ?>>
                                                            <label for="chat_widget_icon_position_right"><?php esc_html_e('Right', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="cf7cw-block-box">
                                                <h3><?php esc_html_e('Call to action', 'connect-contact-form-7-to-social-app'); ?></h3>
                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Enable Call to action', 'connect-contact-form-7-to-social-app'); ?>
                                                    </h4>
                                                    <label class="cf7cw-switch">
                                                        <input type="checkbox" class="cf7cw-switch-checkbox" name="chat_widget_cta_switch" value="on" data-group="chat_widget_cta_switch_group" <?php checked($options['customize_form']['chat_widget_cta_switch'], "on"); ?>>
                                                        <span class="cf7cw-switch-slider"></span>
                                                    </label>
                                                    <div class="cf7cw_note">
                                                        <div class="cf7cw_note_icon">
                                                            <span class="mask_icon"></span>
                                                        </div>
                                                        <div class="cf7cw_note_content">
                                                            <?php esc_html_e('This will enable Call to action on Chat Widget', 'connect-contact-form-7-to-social-app'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="cf7cw-form-table chat_widget_cta_switch_group <?php esc_attr_e($options['customize_form']['chat_widget_cta_switch'] != "on" ? 'cf7cw-hidden' : ''); ?>">
                                                    <h4><?php esc_html_e('Call to action text', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <input type="text" name="chat_widget_cta_text" class="cf7cw-field cf7cw-input" value="<?php esc_attr_e($options['customize_form']['chat_widget_cta_text']); ?>">
                                                    <div class="cf7cw_note">
                                                        <div class="cf7cw_note_icon">
                                                            <span class="mask_icon"></span>
                                                        </div>
                                                        <div class="cf7cw_note_content">
                                                            <?php esc_html_e('Leave blank to hide call to action text', 'connect-contact-form-7-to-social-app'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="cf7cw-form-table cf7cw-form-pro-field chat_widget_cta_switch_group <?php esc_attr_e($options['customize_form']['chat_widget_cta_switch'] != "on" ? 'cf7cw-hidden' : ''); ?>">
                                                    <h4>
                                                        <?php esc_html_e('Call to action style', 'connect-contact-form-7-to-social-app'); ?>
                                                        <a target="_blank" class="cf7cw-pro-label" href="https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6z"/></svg>Pro</a>
                                                    </h4>
                                                    <div class="cf7cw-custom-color">
                                                        <div class="cf7cw-custom-color-box">
                                                            <label for="chat_widget_cta_text_background_text"><?php esc_html_e('Text Color', 'connect-contact-form-7-to-social-app'); ?></label>
                                                            <input id="chat_widget_cta_text_background_text" type="text" name="chat_widget_cta_text_color" class="cf7cw_colorpicker" value="#555555">
                                                        </div>

                                                        <div class="cf7cw-custom-color-box">
                                                            <label for="chat_widget_cta_text_background_bg"><?php esc_html_e('Background Color', 'connect-contact-form-7-to-social-app'); ?></label>
                                                            <input id="chat_widget_cta_text_background_bg" type="text" name="chat_widget_cta_text_background" class="cf7cw_colorpicker" value="#FFFFFF">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="cf7cw-form-table chat_widget_cta_switch_group <?php esc_attr_e($options['customize_form']['chat_widget_cta_switch'] != "on" ? 'cf7cw-hidden' : ''); ?>">
                                                    <h4><?php esc_html_e('Text size', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <div class="cf7cw-field-group-wp">
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="chat_widget_cta_text_size_small" name="chat_widget_cta_text_size" value="small" <?php checked($options['customize_form']['chat_widget_cta_text_size'], "small"); ?>>
                                                            <label for="chat_widget_cta_text_size_small"><?php esc_html_e('Small', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="chat_widget_cta_text_size_medium" name="chat_widget_cta_text_size" value="medium" <?php checked($options['customize_form']['chat_widget_cta_text_size'], "medium"); ?>>
                                                            <label for="chat_widget_cta_text_size_medium"><?php esc_html_e('Medium', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="chat_widget_cta_text_size_large" name="chat_widget_cta_text_size" value="large" <?php checked($options['customize_form']['chat_widget_cta_text_size'], "large"); ?>>
                                                            <label for="chat_widget_cta_text_size_large"><?php esc_html_e('Large', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="chat_widget_cta_text_size_custom" name="chat_widget_cta_text_size" value="custom" data-group="chat_widget_cta_text_size_group" <?php checked($options['customize_form']['chat_widget_cta_text_size'], "custom"); ?>>
                                                            <label for="chat_widget_cta_text_size_custom"><?php esc_html_e('Custom', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="cf7cw-form-table chat_widget_cta_switch_group chat_widget_cta_text_size_group <?php esc_attr_e(($options['customize_form']['chat_widget_cta_switch'] != "on" || ($options['customize_form']['chat_widget_cta_switch'] == "on" && $options['customize_form']['chat_widget_cta_text_size'] != "custom")) ? 'cf7cw-hidden' : ''); ?>">
                                                        <h4><?php esc_html_e('Custom Text Size', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                        <div class="cf7cw-input-range-wp">
                                                            <input type="range" id="form_size_custom" name="chat_widget_cta_text_size_custom" min="8" max="72" class="cf7cw-input-range" value="<?php esc_attr_e($options['customize_form']['chat_widget_cta_text_size_custom']); ?>">
                                                            <span class="cf7cw-range-px"><?php esc_attr_e($options['customize_form']['chat_widget_cta_text_size_custom']); ?>px</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="cf7cw-block-box">
                                                <h3><?php esc_html_e('Customize Form', 'connect-contact-form-7-to-social-app'); ?></h3>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Select Contact Form 7', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <select name="chat_widget_contact_form_7" id="chat_widget_contact_form_7" class="cf7cw-field cf7cw-select">
                                                        <?php
                                                        $cf7_posts = get_posts(array(
                                                            'post_type'     => 'wpcf7_contact_form',
                                                            'numberposts'   => -1
                                                        ));
                                                        foreach ($cf7_posts as $p) {
                                                            echo '<option value="' . $p->ID . '" ' . selected($options['customize_form']['chat_widget_contact_form_7'], $p->ID, false) . '>' . $p->post_title . ' (' . $p->ID . ')</option>';
                                                        } ?>
                                                    </select>
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Form Title', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <input type="text" name="chat_widget_form_title" class="cf7cw-field cf7cw-input" value="<?php esc_attr_e($options['customize_form']['chat_widget_form_title']); ?>">
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Header Text', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <textarea name="chat_widget_header_text" rows="4" cols="100" placeholder="Header Text" class="cf7cw-field cf7cw-textarea"><?php echo esc_textarea($options['customize_form']['chat_widget_header_text']); ?></textarea>
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Footer Text', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <textarea name="chat_widget_footer_text" rows="4" cols="100" placeholder="Footer Text" class="cf7cw-field cf7cw-textarea"><?php echo esc_textarea($options['customize_form']['chat_widget_footer_text']); ?></textarea>
                                                </div>

                                                <div class="cf7cw-form-table cf7cw-form-pro-field">
                                                    <h4>
                                                        <?php esc_html_e('Form Style', 'connect-contact-form-7-to-social-app'); ?>
                                                        <a target="_blank" class="cf7cw-pro-label" href="https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6z"/></svg>Pro</a>
                                                    </h4>
                                                    <div class="cf7cw-custom-color">
                                                        <div class="cf7cw-custom-color-box">
                                                            <label><?php esc_html_e('Text Color', 'connect-contact-form-7-to-social-app'); ?></label>
                                                            <input type="text" name="chat_widget_form_style_text_color" class="cf7cw_colorpicker" value="#FFFFFF">
                                                        </div>

                                                        <div class="cf7cw-custom-color-box">
                                                            <label><?php esc_html_e('Background Color', 'connect-contact-form-7-to-social-app'); ?></label>
                                                            <input type="text" name="chat_widget_form_style_background" class="cf7cw_colorpicker" value="#09816D">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Font Family', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <select name="chat_widget_form_font_family" id="chat_widget_form_font_family" class="cf7cw-field cf7cw-select">
                                                        <?php
                                                        $font_families = array(
                                                            'Rubik' => 'Default',
                                                            'Playfair Display' => 'Playfair Display',
                                                            'Poppins' => 'Poppins'
                                                        );
                                                        foreach ($font_families as $key => $font) {
                                                            echo '<option value="' . $key . '" ' . selected($options['customize_form']['chat_widget_form_font_family'], $key, false) . '>' . $font . '</option>';
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="cf7cw-block-box">
                                                <h3><?php esc_html_e('Form Behavior', 'connect-contact-form-7-to-social-app'); ?></h3>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Open by default', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <label class="cf7cw-switch">
                                                        <input type="checkbox" class="cf7cw-switch-checkbox" name="chat_widget_form_behaviour_open_by_default" value="on" <?php checked($options['customize_form']['chat_widget_form_behaviour_open_by_default'], "on"); ?>>
                                                        <span class="cf7cw-switch-slider"></span>
                                                    </label>
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Close on Submit', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <label class="cf7cw-switch">
                                                        <input type="checkbox" class="cf7cw-switch-checkbox" name="chat_widget_form_behaviour_close_on_submit" value="on" <?php checked($options['customize_form']['chat_widget_form_behaviour_close_on_submit'], "on"); ?>>
                                                        <span class="cf7cw-switch-slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cf7cw-step" data-step="3">
                                <div class="cf7cw-row">
                                    <div class="cf7cw-col-lg-5">
                                        <div class="cf7cw-step-box">

                                            <div class="cf7cw-block-box">
                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Display Greeting Popup', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <label class="cf7cw-switch">
                                                        <input type="checkbox" class="cf7cw-switch-checkbox" name="display_greeting_popup" value="on" data-group="display_greeting_popup_group" <?php checked($options['greetings']['display_greeting_popup'], "on"); ?>>
                                                        <span class="cf7cw-switch-slider"></span>
                                                    </label>
                                                </div>

                                                <div class="cf7cw-form-table display_greeting_popup_group <?php esc_attr_e($options['greetings']['display_greeting_popup'] != "on" ? 'cf7cw-hidden' : ''); ?>">
                                                    <h4><?php esc_html_e('Choose Greetings Template', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <div class="cf7cw-field-group-wp">
                                                        <div class="cf7cw-field-group">
                                                            <label for="choose_greetings_template_simple" class="cf7cw-image-radio cf7cw-image-radio-lg">
                                                                <input type="radio" id="choose_greetings_template_simple" name="choose_greetings_template" data-group="choose_greetings_template_simple_group" value="simple" <?php checked($options['greetings']['choose_greetings_template'], "simple"); ?>>
                                                                <span class="cf7cw-image-radio-inr">
                                                                    <span class="cf7cw-image-radio-image">
                                                                        <img height="50" width="50" src="<?php echo esc_url(plugins_url('assets/images/greeting-template-simple.png', __DIR__)); ?>" alt="Greeting Template Simple">
                                                                    </span>
                                                                    <span><?php esc_html_e('Simple', 'connect-contact-form-7-to-social-app'); ?></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <label for="choose_greetings_template_wave" class="cf7cw-image-radio cf7cw-image-radio-lg">
                                                                <input type="radio" id="choose_greetings_template_wave" name="choose_greetings_template" data-group="choose_greetings_template_wave_group" value="wave" <?php checked($options['greetings']['choose_greetings_template'], "wave"); ?>>
                                                                <span class="cf7cw-image-radio-inr">
                                                                    <span class="cf7cw-image-radio-image">
                                                                        <img height="50" width="50" src="<?php echo esc_url(plugins_url('assets/images/greeting-template-wave.png', __DIR__)); ?>" alt="Greeting Template Simple">
                                                                    </span>
                                                                    <span><?php esc_html_e('Wave', 'connect-contact-form-7-to-social-app'); ?></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="cf7cw-form-table display_greeting_popup_group choose_greetings_template_simple_group <?php esc_attr_e($options['greetings']['choose_greetings_template'] != "simple" ? 'cf7cw-hidden' : ''); ?>">
                                                    <h4><?php esc_html_e('Select Template Style', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <div class="cf7cw-field-group-wp">
                                                        <div class="cf7cw-field-group">
                                                            <label for="choose_simple_greetings_template_type_style_1" class="cf7cw-image-radio">
                                                                <input type="radio" id="choose_simple_greetings_template_type_style_1" name="choose_simple_greetings_template_type" value="choose_simple_greetings_template_type_style_1" <?php checked($options['greetings']['choose_simple_greetings_template_type'], "choose_simple_greetings_template_type_style_1"); ?>>
                                                                <span class="cf7cw-image-radio-inr">
                                                                    <span class="cf7cw-image-radio-image">
                                                                        <img height="50" width="50" src="<?php echo esc_url(plugins_url('assets/images/greeting-template-simple.png', __DIR__)); ?>" alt="Greeting Template Simple"></span>
                                                                    <span><?php esc_html_e('Style 1', 'connect-contact-form-7-to-social-app'); ?></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <label for="choose_simple_greetings_template_type_style_2" class="cf7cw-image-radio cf7cw-form-pro-field">
                                                                <input height="50" width="50" type="radio" id="choose_simple_greetings_template_type_style_2" name="choose_simple_greetings_template_type" value="choose_simple_greetings_template_type_style_2" <?php checked($options['greetings']['choose_simple_greetings_template_type'], "choose_simple_greetings_template_type_style_2"); ?>>
                                                                <span class="cf7cw-image-radio-inr">
                                                                    <span class="cf7cw-image-radio-image">
                                                                        <img height="50" width="50" src="<?php echo esc_url(plugins_url('assets/images/greeting-template-simple-2.png', __DIR__)); ?>" alt="Greeting Template Simple">
                                                                        <a target="_blank" class="cf7cw-pro-label" href="https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6z"/></svg>Pro</a>
                                                                    </span>
                                                                    <span><?php esc_html_e('Style 2', 'connect-contact-form-7-to-social-app'); ?></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="cf7cw-form-table display_greeting_popup_group choose_greetings_template_wave_group <?php esc_attr_e($options['greetings']['choose_greetings_template'] != "wave" ? 'cf7cw-hidden' : ''); ?>">
                                                    <h4><?php esc_html_e('Select Template Style', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <div class="cf7cw-field-group-wp">
                                                        <div class="cf7cw-field-group">
                                                            <label for="choose_wave_greetings_template_type_style_1" class="cf7cw-image-radio">
                                                                <input type="radio" id="choose_wave_greetings_template_type_style_1" name="choose_wave_greetings_template_type" data-group="choose_wave_greetings_template_type_style_1_group" value="choose_wave_greetings_template_type_style_1" <?php checked($options['greetings']['choose_wave_greetings_template_type'], "choose_wave_greetings_template_type_style_1"); ?>>
                                                                <span class="cf7cw-image-radio-inr">
                                                                    <span class="cf7cw-image-radio-image">
                                                                        <img height="50" width="50" src="<?php echo esc_url(plugins_url('assets/images/greeting-template-wave.png', __DIR__)); ?>" alt="Greeting Template Wave">
                                                                    </span>
                                                                    <span><?php esc_html_e('Style 1', 'connect-contact-form-7-to-social-app'); ?></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <label for="choose_wave_greetings_template_type_style_2" class="cf7cw-image-radio cf7cw-form-pro-field">
                                                                <input type="radio" id="choose_wave_greetings_template_type_style_2" name="choose_wave_greetings_template_type" data-group="choose_wave_greetings_template_type_style_2_group" value="choose_wave_greetings_template_type_style_2" <?php checked($options['greetings']['choose_wave_greetings_template_type'], "choose_wave_greetings_template_type_style_2"); ?>>
                                                                <span class="cf7cw-image-radio-inr">
                                                                    <span class="cf7cw-image-radio-image">
                                                                        <img height="50" width="50" src="<?php echo esc_url(plugins_url('assets/images/greeting-template-wave-2.png', __DIR__)); ?>" alt="Greeting Template Wave 2">
                                                                        <a target="_blank" class="cf7cw-pro-label" href="https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6z"/></svg>Pro</a>
                                                                    </span>
                                                                    <span><?php esc_html_e('Style 2', 'connect-contact-form-7-to-social-app'); ?></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h3 class="display_greeting_popup_group <?php esc_attr_e($options['greetings']['display_greeting_popup'] != "on" ? 'cf7cw-hidden' : ''); ?>"><?php esc_html_e('Customize Greetings', 'connect-contact-form-7-to-social-app'); ?></h3>

                                            <div class="cf7cw-block-box display_greeting_popup_group choose_greetings_template_simple_group <?php esc_attr_e($options['greetings']['choose_greetings_template'] != "simple" ? 'cf7cw-hidden' : ''); ?>">
                                                <!-- Simple Greeting -> Style 1 / 2 -> Customize Greetings  -->
                                                <div class="cf7cw-form-table <?php esc_attr_e($options['greetings']['choose_greetings_template'] != "simple" ? 'cf7cw-hidden' : ''); ?>">
                                                    <h4><?php esc_html_e('Greeting Heading', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <input type="text" name="simple_greetings_heading" value="<?php esc_attr_e($options['greetings']['simple_greetings_heading']); ?>" class="cf7cw-field cf7cw-input">
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Heading Size', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <div class="cf7cw-field-group-wp">
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="simple_greetings_heading_size_small" name="simple_greetings_heading_size" value="small" <?php checked($options['greetings']['simple_greetings_heading_size'], "small"); ?>>
                                                            <label for="simple_greetings_heading_size_small"><?php esc_html_e('Small', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="simple_greetings_heading_size_medium" name="simple_greetings_heading_size" value="medium" <?php checked($options['greetings']['simple_greetings_heading_size'], "medium"); ?>>
                                                            <label for="simple_greetings_heading_size_medium"><?php esc_html_e('Medium', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="simple_greetings_heading_size_large" name="simple_greetings_heading_size" value="large" <?php checked($options['greetings']['simple_greetings_heading_size'], "large"); ?>>
                                                            <label for="simple_greetings_heading_size_large"><?php esc_html_e('Large', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="simple_greetings_heading_size_custom" name="simple_greetings_heading_size" data-group="simple_greetings_heading_size_group" value="custom" <?php checked($options['greetings']['simple_greetings_heading_size'], "custom"); ?>>
                                                            <label for="simple_greetings_heading_size_custom"><?php esc_html_e('Custom', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="cf7cw-form-table simple_greetings_heading_size_group <?php esc_attr_e($options['greetings']['simple_greetings_heading_size'] != "custom" ? 'cf7cw-hidden' : ''); ?>">
                                                        <h4><?php esc_html_e('Custom Heading Size', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                        <div class="cf7cw-input-range-wp">
                                                            <input type="range" id="simple_greetings_heading_custom_size" name="simple_greetings_heading_custom_size" min="6" max="150" class="cf7cw-input-range" value="<?php esc_attr_e($options['greetings']['simple_greetings_heading_custom_size']); ?>">
                                                            <span class="cf7cw-range-px"><?php esc_attr_e($options['greetings']['simple_greetings_heading_custom_size']); ?>px</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="cf7cw-block-box display_greeting_popup_group choose_greetings_template_simple_group <?php esc_attr_e($options['greetings']['choose_greetings_template'] != "simple" ? 'cf7cw-hidden' : ''); ?>">
                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Greeting Message', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <textarea name="simple_greetings_message" class="cf7cw-field cf7cw-textarea" rows="4" cols="100" placeholder="Hi! Have any queries?"><?php echo esc_textarea($options['greetings']['simple_greetings_message']); ?></textarea>
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Message Size', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <div class="cf7cw-field-group-wp">
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="simple_greetings_message_size_small" name="simple_greetings_message_size" value="small" <?php checked($options['greetings']['simple_greetings_message_size'], "small"); ?>>
                                                            <label for="simple_greetings_message_size_small"><?php esc_html_e('Small', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="simple_greetings_message_size_medium" name="simple_greetings_message_size" value="medium" <?php checked($options['greetings']['simple_greetings_message_size'], "medium"); ?>>
                                                            <label for="simple_greetings_message_size_medium"><?php esc_html_e('Medium', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="simple_greetings_message_size_large" name="simple_greetings_message_size" value="large" <?php checked($options['greetings']['simple_greetings_message_size'], "large"); ?>>
                                                            <label for="simple_greetings_message_size_large"><?php esc_html_e('Large', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="simple_greetings_message_size_custom" name="simple_greetings_message_size" data-group="simple_greetings_message_size_group" value="custom" data-group="simple_greetings_message_size_group" <?php checked($options['greetings']['simple_greetings_message_size'], "custom"); ?>>
                                                            <label for="simple_greetings_message_size_custom"><?php esc_html_e('Custom', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="cf7cw-form-table simple_greetings_message_size_group <?php esc_attr_e($options['greetings']['simple_greetings_message_size'] != "custom" ? 'cf7cw-hidden' : ''); ?>">
                                                        <h4><?php esc_html_e('Custom Message Size', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                        <div class="cf7cw-input-range-wp">
                                                            <input type="range" id="simple_greetings_message_custom_size" name="simple_greetings_message_custom_size" min="6" max="150" class="cf7cw-input-range" value="<?php esc_attr_e($options['greetings']['simple_greetings_message_custom_size']); ?>">
                                                            <span class="cf7cw-range-px"><?php esc_attr_e($options['greetings']['simple_greetings_message_custom_size']); ?>px</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END Simple Greeting -> Style 1 / 2 -> Customize Greetings -->


                                            <!-- Wave Greeting -> Style 1 / 2 -> Customize Greetings  -->
                                            <div class="cf7cw-block-box display_greeting_popup_group choose_greetings_template_wave_group <?php esc_attr_e($options['greetings']['choose_greetings_template'] != "wave" ? 'cf7cw-hidden' : ''); ?>">
                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Show Main Content', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <label class="cf7cw-switch">
                                                        <input type="checkbox" class="cf7cw-switch-checkbox" name="wave_greetings_show_main_content" data-group="wave_greetings_show_main_content" value="on" <?php checked($options['greetings']['wave_greetings_show_main_content'], "on"); ?>>
                                                        <span class="cf7cw-switch-slider"></span>
                                                    </label>
                                                </div>

                                                <?php
                                                // Get the existing attachment ID (if any)
                                                $wgs1ci_attachment_id = (isset($options['greetings']['wave_greetings_style_1_custom_icon']) && !empty($options['greetings']['wave_greetings_style_1_custom_icon'])) ? $options['greetings']['wave_greetings_style_1_custom_icon'] : '';

                                                // Get the URL of the image using the attachment ID
                                                $wgs1ci_file_url = !empty($wgs1ci_attachment_id) ? wp_get_attachment_url($wgs1ci_attachment_id) : plugin_dir_url(__DIR__) . 'assets/images/hand-wave.svg';
                                                ?>

                                                <div class="cf7cw-form-table cf7cw-form-pro-field wave_greetings_show_main_content <?php esc_attr_e($options['greetings']['wave_greetings_show_main_content'] != "on" ? 'cf7cw-hidden' : ''); ?>">
                                                    <h4>
                                                        <?php esc_html_e('Custom Wave Icon', 'connect-contact-form-7-to-social-app'); ?>
                                                        <a target="_blank" class="cf7cw-pro-label" href="https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6z"/></svg>Pro</a>
                                                    </h4>
                                                    <div class="cf7cw-file-upload">
                                                        <input type="text" id="cf7cw_customize_icon_url" name="wave_greetings_style_1_custom_icon" value="<?php esc_attr_e($wgs1ci_attachment_id); ?>" readonly />
                                                        <button type="button" class="cf7cw-upload-button" id="cf7cw_customize_icon_upload">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                                                            </svg>
                                                        </button>
                                                        <?php if ($wgs1ci_file_url) : ?>
                                                            <div class="cf7cw-file-preview">
                                                                <img src="<?php echo esc_url($wgs1ci_file_url); ?>" alt="Selected File" />
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="cf7cw_note">
                                                        <div class="cf7cw_note_icon">
                                                            <span class="mask_icon"></span>
                                                        </div>
                                                        <div class="cf7cw_note_content">
                                                            <?php esc_html_e('Recommended size for custom icon : 64x64'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="cf7cw-form-table wave_greetings_show_main_content choose_wave_greetings_template_type_style_1_group <?php esc_attr_e($options['greetings']['choose_wave_greetings_template_type'] != "choose_wave_greetings_template_type_style_1" || $options['greetings']['wave_greetings_show_main_content'] != "on" ? 'cf7cw-hidden' : ''); ?>">
                                                    <h4><?php esc_html_e('Position', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <div class="cf7cw-field-group-wp">
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="before_heading" name="wave_greetings_style_1_icon_position" value="before_heading" <?php checked($options['greetings']['wave_greetings_style_1_icon_position'], "before_heading"); ?>>
                                                            <label for="before_heading"><?php esc_html_e('Before Heading', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="after_heading" name="wave_greetings_style_1_icon_position" value="after_heading" <?php checked($options['greetings']['wave_greetings_style_1_icon_position'], "after_heading"); ?>>
                                                            <label for="after_heading"><?php esc_html_e('After Heading', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="after_message" name="wave_greetings_style_1_icon_position" value="after_message" <?php checked($options['greetings']['wave_greetings_style_1_icon_position'], "after_message"); ?>>
                                                            <label for="after_message"><?php esc_html_e('After Message', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="cf7cw-block-box display_greeting_popup_group choose_greetings_template_wave_group choose_wave_greetings_template_type_style_1_group <?php esc_attr_e($options['greetings']['choose_greetings_template'] != "wave" ? 'cf7cw-hidden' : ''); ?>">
                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Greeting Heading', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <input type="text" name="wave_greetings_style_1_greeting_heading" value="<?php esc_attr_e($options['greetings']['wave_greetings_style_1_greeting_heading']); ?>" class="cf7cw-field cf7cw-input">
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Heading Size', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <div class="cf7cw-field-group-wp">
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="wave_greetings_style_1_heading_size_small" name="wave_greetings_style_1_heading_size" value="small" <?php checked($options['greetings']['wave_greetings_style_1_heading_size'], "small"); ?>>
                                                            <label for="wave_greetings_style_1_heading_size_small"><?php esc_html_e('Small', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="wave_greetings_style_1_heading_size_medium" name="wave_greetings_style_1_heading_size" value="medium" <?php checked($options['greetings']['wave_greetings_style_1_heading_size'], "medium"); ?>>
                                                            <label for="wave_greetings_style_1_heading_size_medium"><?php esc_html_e('Medium', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="wave_greetings_style_1_heading_size_large" name="wave_greetings_style_1_heading_size" value="large" <?php checked($options['greetings']['wave_greetings_style_1_heading_size'], "large"); ?>>
                                                            <label for="wave_greetings_style_1_heading_size_large"><?php esc_html_e('Large', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="wave_greetings_style_1_heading_size_custom" name="wave_greetings_style_1_heading_size" data-group="wave_greetings_style_1_heading_size_group" value="custom" <?php checked($options['greetings']['wave_greetings_style_1_heading_size'], "custom"); ?>>
                                                            <label for="wave_greetings_style_1_heading_size_custom"><?php esc_html_e('Custom', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="cf7cw-form-table wave_greetings_style_1_heading_size_group <?php esc_attr_e($options['greetings']['wave_greetings_style_1_heading_size'] != "custom" ? 'cf7cw-hidden' : ''); ?>">
                                                        <h4><?php esc_html_e('Custom Heading Size', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                        <div class="cf7cw-input-range-wp">
                                                            <input type="range" id="wave_greetings_style_1_heading_custom_size" name="wave_greetings_style_1_heading_custom_size" min="10" max="150" class="cf7cw-input-range" value="<?php esc_attr_e($options['greetings']['wave_greetings_style_1_heading_custom_size']); ?>">
                                                            <span class="cf7cw-range-px"><?php esc_attr_e($options['greetings']['wave_greetings_style_1_heading_custom_size']); ?>px</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="cf7cw-block-box display_greeting_popup_group choose_greetings_template_wave_group choose_wave_greetings_template_type_style_1_group <?php esc_attr_e($options['greetings']['choose_greetings_template'] != "wave" ? 'cf7cw-hidden' : ''); ?>">
                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Greeting Message', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <textarea name="wave_greetings_style_1_message" rows="4" cols="100" placeholder="Hi! Have any queries?" class="cf7cw-field cf7cw-textarea"><?php echo esc_textarea($options['greetings']['wave_greetings_style_1_message']); ?></textarea>
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Message Size', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <div class="cf7cw-field-group-wp">
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="wave_greetings_style_1_message_size_small" name="wave_greetings_style_1_message_size" value="small" <?php checked($options['greetings']['wave_greetings_style_1_message_size'], "small"); ?>>
                                                            <label for="wave_greetings_style_1_message_size_small"><?php esc_html_e('Small', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="wave_greetings_style_1_message_size_medium" name="wave_greetings_style_1_message_size" value="medium" <?php checked($options['greetings']['wave_greetings_style_1_message_size'], "medium"); ?>>
                                                            <label for="wave_greetings_style_1_message_size_medium"><?php esc_html_e('Medium', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="wave_greetings_style_1_message_size_large" name="wave_greetings_style_1_message_size" value="large" <?php checked($options['greetings']['wave_greetings_style_1_message_size'], "large"); ?>>
                                                            <label for="wave_greetings_style_1_message_size_large"><?php esc_html_e('Large', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="wave_greetings_style_1_message_size_custom" name="wave_greetings_style_1_message_size" data-group="wave_greetings_style_1_message_size_group" value="custom" <?php checked($options['greetings']['wave_greetings_style_1_message_size'], "custom"); ?>>
                                                            <label for="wave_greetings_style_1_message_size_custom"><?php esc_html_e('custom', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="cf7cw-form-table wave_greetings_style_1_message_size_group <?php esc_attr_e($options['greetings']['wave_greetings_style_1_message_size'] != "custom" ? 'cf7cw-hidden' : ''); ?>">
                                                        <h4><?php esc_html_e('Custom Message Size', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                        <div class="cf7cw-input-range-wp">
                                                            <input type="range" id="wave_greetings_style_1_message_custom_size" name="wave_greetings_style_1_message_custom_size" min="6" max="150" class="cf7cw-input-range" value="<?php esc_attr_e($options['greetings']['wave_greetings_style_1_message_custom_size']); ?>">
                                                            <span class="cf7cw-range-px"><?php esc_attr_e($options['greetings']['wave_greetings_style_1_message_custom_size']); ?>px</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="cf7cw-block-box cf7cw-form-pro-field display_greeting_popup_group choose_greetings_template_simple_group <?php esc_attr_e($options['greetings']['choose_greetings_template'] != "simple" ? 'cf7cw-hidden' : ''); ?>">
                                                <div class="cf7cw-form-table">
                                                    <h4>
                                                        <?php esc_html_e('Greeting Colors', 'connect-contact-form-7-to-social-app'); ?>
                                                        <a target="_blank" class="cf7cw-pro-label" href="https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6z"/></svg>Pro</a>
                                                    </h4>
                                                    <div class="cf7cw-custom-color">
                                                        <div class="cf7cw-custom-color-box">
                                                            <label><?php esc_html_e('Heading Color', 'connect-contact-form-7-to-social-app'); ?></label>
                                                            <input type="text" name="simple_greetings_style_1_heading_color" class="cf7cw_colorpicker" value="#828282">
                                                        </div>

                                                        <div class="cf7cw-custom-color-box">
                                                            <label><?php esc_html_e('Message Color', 'connect-contact-form-7-to-social-app'); ?></label>
                                                            <input type="text" name="simple_greetings_style_1_message_color" class="cf7cw_colorpicker" value="#4F4F4F">
                                                        </div>

                                                        <div class="cf7cw-custom-color-box">
                                                            <label><?php esc_html_e('Background Color', 'connect-contact-form-7-to-social-app'); ?></label>
                                                            <input type="text" name="simple_greetings_style_1_background_color" class="cf7cw_colorpicker" value="#FFFFFF">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Greeting Font Family', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <select name="simple_greetings_style_1_font_family" class="cf7cw-field cf7cw-select">
                                                        <?php
                                                        $font_families = array(
                                                            'Rubik' => 'Default',
                                                            'Playfair Display' => 'Playfair Display',
                                                            'Poppins' => 'Poppins'
                                                        );
                                                        foreach ($font_families as $key => $font) {
                                                            echo '<option value="' . $key . '" ' . selected($options['greetings']['simple_greetings_style_1_font_family'], $key, false) . '>' . $font . '</option>';
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="cf7cw-block-box display_greeting_popup_group choose_greetings_template_wave_group choose_wave_greetings_template_type_style_1_group <?php esc_attr_e(($options['greetings']['choose_greetings_template'] != "wave" || ($options['greetings']['choose_greetings_template'] == "wave" && $options['greetings']['choose_wave_greetings_template_type'] != "choose_wave_greetings_template_type_style_1")) ? 'cf7cw-hidden' : ''); ?>">
                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Show Greetings CTA', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <label class="cf7cw-switch">
                                                        <input type="checkbox" class="cf7cw-switch-checkbox" name="wave_greetings_style_1_show_greeting_cta" data-group="wave_greetings_style_1_show_greeting_cta" value="on" <?php checked($options['greetings']['wave_greetings_style_1_show_greeting_cta'], "on"); ?>>
                                                        <span class="cf7cw-switch-slider"></span>
                                                    </label>
                                                </div>

                                                <div class="cf7cw-form-table wave_greetings_style_1_show_greeting_cta <?php esc_attr_e($options['greetings']['wave_greetings_style_1_show_greeting_cta'] != "on" ? 'cf7cw-hidden' : ''); ?>">
                                                    <h4><?php esc_html_e('Greeting CTA Text', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <textarea name="wave_greetings_style_1_greeting_cta_text" class="cf7cw-field cf7cw-textarea" rows="4" placeholder="Message Format"><?php echo esc_textarea($options['greetings']['wave_greetings_style_1_greeting_cta_text']); ?></textarea>
                                                </div>

                                                <?php
                                                // Get the URL of the image using the attachment ID
                                                $wgs1ci_file_url = plugin_dir_url(__DIR__) . 'assets/images/greeting-cta-chat-icon.svg';
                                                ?>
                                                <div class="cf7cw-form-table cf7cw-form-pro-field wave_greetings_style_1_show_greeting_cta <?php esc_attr_e($options['greetings']['wave_greetings_style_1_show_greeting_cta'] != "on" ? 'cf7cw-hidden' : ''); ?>">
                                                    <h4>
                                                        <?php esc_html_e('Custom Icon', 'connect-contact-form-7-to-social-app'); ?>
                                                        <a target="_blank" class="cf7cw-pro-label" href="https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6z"/></svg>Pro</a>
                                                    </h4>
                                                    <div class="cf7cw-file-upload">
                                                        <input type="text" id="cf7cw_customize_icon_url" name="wave_greetings_style_1_cta_icon" value="" readonly />
                                                        <button type="button" id="cf7cw_customize_icon_upload" class="cf7cw-upload-button">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                                                            </svg>
                                                        </button>
                                                        <?php if ($wgs1ci_file_url) : ?>
                                                            <div class="cf7cw-file-preview">
                                                                <img src="<?php echo esc_url($wgs1ci_file_url); ?>" alt="Selected File" />
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="cf7cw_note">
                                                        <div class="cf7cw_note_icon">
                                                            <span class="mask_icon"></span>
                                                        </div>
                                                        <div class="cf7cw_note_content"><?php esc_html_e('Recommended size for custom icon : 64x64', 'connect-contact-form-7-to-social-app'); ?></div>
                                                    </div>
                                                </div>

                                                <div class="cf7cw-form-table cf7cw-form-pro-field wave_greetings_style_1_show_greeting_cta <?php esc_attr_e($options['greetings']['wave_greetings_style_1_show_greeting_cta'] != "on" ? 'cf7cw-hidden' : ''); ?>">
                                                    <h4>
                                                        <?php esc_html_e('CTA Style', 'connect-contact-form-7-to-social-app'); ?>
                                                        <a target="_blank" class="cf7cw-pro-label" href="https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6z"/></svg>Pro</a>
                                                    </h4>
                                                    <div class="cf7cw-custom-color">
                                                        <div class="cf7cw-custom-color-box">
                                                            <label><?php esc_html_e('Text Color', 'connect-contact-form-7-to-social-app'); ?></label>
                                                            <input type="text" name="wave_greetings_style_1_cta_text_color" class="cf7cw_colorpicker" value="#6952b0">
                                                        </div>

                                                        <div class="cf7cw-custom-color-box">
                                                            <label><?php esc_html_e('Background Color', 'connect-contact-form-7-to-social-app'); ?></label>
                                                            <input type="text" name="wave_greetings_style_1_cta_background" class="cf7cw_colorpicker" value="#F5F7F8">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="cf7cw-block-box cf7cw-form-pro-field display_greeting_popup_group choose_greetings_template_wave_group choose_wave_greetings_template_type_style_1_group <?php esc_attr_e(($options['greetings']['choose_greetings_template'] != "wave" || ($options['greetings']['choose_greetings_template'] == "wave" && $options['greetings']['choose_wave_greetings_template_type'] != "choose_wave_greetings_template_type_style_1")) ? 'cf7cw-hidden' : ''); ?>">
                                                <div class="cf7cw-form-table">
                                                    <h4>
                                                        <?php esc_html_e('Greeting Colors', 'connect-contact-form-7-to-social-app'); ?>
                                                        <a target="_blank" class="cf7cw-pro-label" href="https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6z"/></svg>Pro</a>
                                                    </h4>
                                                    <div class="cf7cw-custom-color">
                                                        <div class="cf7cw-custom-color-box">
                                                            <label><?php esc_html_e('Heading Color', 'connect-contact-form-7-to-social-app'); ?></label>
                                                            <input type="text" name="wave_greetings_style_1_heading_color" class="cf7cw_colorpicker" value="#828282">
                                                        </div>

                                                        <div class="cf7cw-custom-color-box">
                                                            <label><?php esc_html_e('Message Color', 'connect-contact-form-7-to-social-app'); ?></label>
                                                            <input type="text" name="wave_greetings_style_1_message_color" class="cf7cw_colorpicker" value="#828282">
                                                        </div>

                                                        <div class="cf7cw-custom-color-box">
                                                            <label><?php esc_html_e('Background Color', 'connect-contact-form-7-to-social-app'); ?></label>
                                                            <input type="text" name="wave_greetings_style_1_background_color" class="cf7cw_colorpicker" value="#ffffff">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Greeting Font Family', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <select name="wave_greetings_style_1_font_family" class="cf7cw-field cf7cw-select">
                                                        <?php
                                                        $font_families = array(
                                                            'Rubik' => 'Default',
                                                            'Playfair Display' => 'Playfair Display',
                                                            'Poppins' => 'Poppins'
                                                        );
                                                        foreach ($font_families as $key => $font) {
                                                            echo '<option value="' . $key . '" ' . selected($options['greetings']['wave_greetings_style_1_font_family'], $key, false) . '>' . $font . '</option>';
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <h3 class="display_greeting_popup_group <?php esc_attr_e($options['greetings']['display_greeting_popup'] != "on" ? 'cf7cw-hidden' : ''); ?>"><?php esc_html_e('Greeting Behavior', 'connect-contact-form-7-to-social-app'); ?></h3>

                                            <div class="cf7cw-block-box display_greeting_popup_group <?php esc_attr_e($options['greetings']['display_greeting_popup'] != "on" ? 'cf7cw-hidden' : ''); ?>">
                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('On Click Action', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <div class="cf7cw-field-group-wp">
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="load_the_selected_form" name="greeting_behavior_on_click_action" value="load_the_selected_form" <?php checked($options['greetings']['greeting_behavior_on_click_action'], "load_the_selected_form"); ?>>
                                                            <label for="load_the_selected_form"><?php esc_html_e('Load the Selected Form', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                        <div class="cf7cw-field-group">
                                                            <input type="radio" id="redirected_to_whatsapp_directly" name="greeting_behavior_on_click_action" value="redirected_to_whatsapp_directly" <?php checked($options['greetings']['greeting_behavior_on_click_action'], "redirected_to_whatsapp_directly"); ?>>
                                                            <label for="redirected_to_whatsapp_directly"><?php esc_html_e('Redirected to WhatsApp directly', 'connect-contact-form-7-to-social-app'); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cf7cw-step" data-step="4">
                                <div class="cf7cw-row">
                                    <div class="cf7cw-col-lg-5">
                                        <div class="cf7cw-step-box">
                                            <div class="cf7cw-block-box">
                                                <h3><?php esc_html_e('Triggers', 'connect-contact-form-7-to-social-app'); ?></h3>
                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Activate Contact Form Chat Widget', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <label class="cf7cw-switch">
                                                        <input type="checkbox" class="cf7cw-switch-checkbox" name="triggers_activate_cf7_form_chat_widget" value="on" <?php checked($options['triggers-targeting']['triggers_activate_cf7_form_chat_widget'], "on"); ?>>
                                                        <span class="cf7cw-switch-slider"></span>
                                                    </label>
                                                </div>

                                                <div class="cf7cw-form-table">
                                                    <h4><?php esc_html_e('Time delay', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <label class="cf7cw-switch">
                                                        <input type="checkbox" class="cf7cw-switch-checkbox" name="triggers_time_delay" data-group="triggers_time_delay_group" value="on" <?php checked($options['triggers-targeting']['triggers_time_delay'], "on"); ?>>
                                                        <span class="cf7cw-switch-slider"></span>
                                                    </label>

                                                    <div class="cf7cw-form-table triggers_time_delay_group <?php esc_attr_e($options['triggers-targeting']['triggers_time_delay'] != "on" ? 'cf7cw-hidden' : ''); ?>">
                                                        <div class="cf7cw-input-center-box">
                                                            <label for="form_delay" class="cf7cw-text-small">Show form after</label>
                                                            <input id="form_delay" name="triggers_show_form_after_second" type="number" min="0" step="1" class="cf7cw-field cf7cw-input cf7cw-field-auto" placeholder="0" value="<?php esc_attr_e($options['triggers-targeting']['triggers_show_form_after_second']); ?>">
                                                            <span class="cf7cw-text-small">seconds when page is loaded</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="cf7cw-block-box cf7cw-targets">
                                                <h3>
                                                    <?php esc_html_e('Targets', 'connect-contact-form-7-to-social-app'); ?>
                                                    <a target="_blank" class="cf7cw-pro-label" href="https://geekcodelab.com/wordpress-plugins/connect-contact-form-7-to-social-app-pro/"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6z"/></svg>Pro</a>
                                                </h3>

                                                <div class="cf7cw-form-table cf7cw-exclude-pages cf7cw-form-pro-field">
                                                    <h4><?php esc_html_e('Exclude pages', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <select name="targeting_exclude_pages[]" id="targeting_exclude_pages" class="cf7cw-field cf7cw-select" multiple>
                                                        <?php
                                                        $pages = get_pages();
                                                        foreach ($pages as $p) {
                                                            echo '<option value="' . $p->ID . '" ' . selected(in_array($p->ID, $options['triggers-targeting']['targeting_exclude_pages']), true, false) . '>' . $p->post_title . ' (' . $p->ID . ')</option>';
                                                        } ?>
                                                    </select>
                                                </div>

                                                <div class="cf7cw-form-table cf7cw-form-pro-field">
                                                    <h4><?php esc_html_e('Exclude all except', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <label class="cf7cw-switch">
                                                        <input type="checkbox" class="cf7cw-switch-checkbox" name="targeting_exclude_all_except_switch" id="targeting_exclude_all_except_switch" value="on" <?php checked($options['triggers-targeting']['targeting_exclude_all_except_switch'], "on"); ?>>
                                                        <span class="cf7cw-switch-slider"></span>
                                                    </label>
                                                </div>

                                                <div class="cf7cw-form-table cf7cw-exclude-all-except cf7cw-form-pro-field">
                                                    <h4><?php esc_html_e('Exclude all except selected', 'connect-contact-form-7-to-social-app'); ?></h4>
                                                    <select name="targeting_exclude_all_except_pages[]" id="targeting_exclude_all_except_pages" class="cf7cw-field cf7cw-select" multiple>
                                                        <?php
                                                        $except_pages = get_pages();
                                                        foreach ($except_pages as $p) {
                                                            echo '<option value="' . $p->ID . '" ' . selected(in_array($p->ID, $options['triggers-targeting']['targeting_exclude_all_except_pages']), true, false) . '>' . $p->post_title . ' (' . $p->ID . ')</option>';
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cf7cw-step-panel-footer" style="display:none;">
                            <input class="cf7cw-sec-btn cf7cw_submit" type="submit" name="cf7cw_save_changes" id="cf7cw_save_changes" value="<?php esc_attr_e('Save Changes', 'connect-contact-form-7-to-social-app'); ?>" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>