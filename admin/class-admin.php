<?php
if (!class_exists('cf7cw_admin')) {
    class cf7cw_admin
    {
        public function __construct()
        {
            add_action('admin_enqueue_scripts', array($this, 'cf7cw_enqueue_admin_scripts'));
            add_action('wpcf7_editor_panels', array($this, 'connect_wh_add_tab'));
            add_action('wpcf7_after_save', array($this, 'cf7cw_save_settings_call'));
            add_action('admin_menu', array($this, 'cf7cw_submenu'));
        }

        public function cf7cw_submenu()
        {
            add_submenu_page(
                'wpcf7',
                __('Connect Contact Form 7 to Social App', 'connect-contact-form-7-to-social-app'),
                __('Connect CF7', 'connect-contact-form-7-to-social-app'),
                'manage_options',
                'connect-cf7cw',
                array($this, 'connect_cf7cw_callback')
            );
        }

        public function connect_cf7cw_callback()
        {
            ?>
            <div class="wrap">
                <div class="cf7cw-main-wrap">
                    <h1><?php esc_html_e('Connect Contact Form 7 to Social App', 'connect-contact-form-7-to-social-app'); ?></h1>
                    <?php include_once('class-options.php'); ?>
                </div>
            </div>
            <?php
        }

        public function cf7cw_enqueue_admin_scripts($hook)
        {
            if ($hook == 'contact_page_connect-cf7cw' || $hook == 'toplevel_page_wpcf7' || $hook == 'contact_page_wpcf7-new') {
                wp_enqueue_style('cf7cw-intlTelInput', plugins_url('assets/css/intlTelInput.css', __DIR__), array(), CF7CW_PLUGIN_VERSION);
                wp_enqueue_style('wp-color-picker');
                wp_enqueue_style('cf7cw-grid', plugins_url('assets/css/cf7cw-grid.min.css', __DIR__), array(), CF7CW_PLUGIN_VERSION);
                wp_enqueue_style('cf7cw-admin', plugins_url('assets/css/cf7cw-admin-style.css', __DIR__), array(), CF7CW_PLUGIN_VERSION);

                wp_enqueue_script('jquery');

                wp_enqueue_media();

                wp_enqueue_script('cf7cw-intlTelInput-script', plugins_url('assets/js/intlTelInput.min.js', __DIR__), array('jquery'), CF7CW_PLUGIN_VERSION);
                wp_enqueue_script('wp-color-picker');
                wp_enqueue_script('cf7cw-admin-script', plugins_url('assets/js/cf7cw-admin-scripts.js', __DIR__), array('jquery', 'wp-i18n'), CF7CW_PLUGIN_VERSION);
                wp_localize_script('cf7cw-admin-script', 'cf7cwObj', array('cf7cw_page' => $hook, 'telinput_util' => plugins_url('assets/js/cf7cw-admin-scripts.js', __DIR__)));
            }
        }

        static function connect_wh_add_tab($panels)
        {
            $panels['connect-whatsapp'] = array(
                'title'     => __('Whatsapp', 'connect-contact-form-7-to-social-app'),
                'callback'  => array('cf7cw_admin', 'connect_wh_settings_callback'),
            );
            return $panels;
        }

        static function connect_wh_settings_callback($post)
        {
            $cf7cw_nonce = wp_create_nonce('cf7cw_option_nonce');
            $form_id = $post->id();
            $option = get_option('cf7cw_connect_wh_' . $form_id, $default = array());
            $phone = isset($option['cf7cw_message_body']) ? $option['cf7cw_phone_number'] : '';
            $cf7cw_status = isset($option['cf7cw_status']) ? $option['cf7cw_status'] : "on";
            $cf7cw_open_new_tab = isset($option['cf7cw_open_new_tab']) ? $option['cf7cw_open_new_tab'] : "on";
            $cf7cw_message_body = isset($option['cf7cw_message_body']) ? $option['cf7cw_message_body'] : cf7cw_admin::connect_wh_message_body();

            $phone_err = false;
            if (isset($option['cf7cw_phone_number']) && empty($option['cf7cw_phone_number']) && $option['cf7cw_status'] == 'on') $phone_err = true;
            ?>
            <h2><?php esc_html_e('Whatsapp', 'connect-contact-form-7-to-social-app'); ?></h2>
            <legend>
                <?php esc_html_e('In the message body, you can use these tags:', 'connect-contact-form-7-to-social-app'); ?><br>
                <?php $post->suggest_mail_tags(); ?>
            </legend>
            <div class="cf7cw-sec">
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label><?php esc_html_e('Status', 'connect-contact-form-7-to-social-app'); ?></label>
                        </th>
                        <td>
                            <label class="cf7cw-switch">
                                <input type="checkbox" class="cf7cw-checkbox" name="cf7cw-plugin-status" value="on" <?php if (isset($cf7cw_status) && $cf7cw_status == 'on') esc_attr_e('checked', 'connect-contact-form-7-to-social-app'); ?>>
                                <span class="cf7cw-slider cf7cw-round"></span>
                            </label>
                            <p><?php esc_html_e('Enable to connect whatsapp for this contact form.', 'connect-contact-form-7-to-social-app'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php esc_html_e('Whatsapp Number', 'connect-contact-form-7-to-social-app'); ?></label>
                        </th>
                        <td>
                            <input type="number" id="cf7cw_phone_number" name="cf7cw-phone-number" class="large-text code" value="<?php esc_html_e($phone, 'connect-contact-form-7-to-social-app'); ?>" min="0">
                            <p><?php esc_html_e('Use: 1XXXXXXXXXX', 'connect-contact-form-7-to-social-app'); ?></p>
                            <p><?php esc_html_e('Do not use: +001-(XXX)XXXXXXX', 'connect-contact-form-7-to-social-app'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php esc_html_e('Message', 'connect-contact-form-7-to-social-app'); ?></label>
                        </th>
                        <td>
                            <textarea id="cf7cw_message_body" name="cf7cw-message-body" cols="100" rows="18" class="large-text code"><?php echo esc_html(wp_unslash($cf7cw_message_body)); ?></textarea>
                            <a target="_blank" style="text-decoration:underline" href="https://faq.whatsapp.com/general/chats/how-to-format-your-messages/?lang=en"><?php esc_html_e('Format your whatsapp message', 'connect-contact-form-7-to-social-app'); ?></a>
                            <p><?php esc_html_e('Note:', 'connect-contact-form-7-to-social-app'); ?> <i><?php esc_html_e('File Upload field will not support on WhatsApp message body.', 'connect-contact-form-7-to-social-app'); ?></i></p>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">
                            <label><?php esc_html_e('Open in new tab', 'connect-contact-form-7-to-social-app'); ?></label>
                        </th>
                        <td>
                            <label class="cf7cw-switch">
                                <input type="checkbox" class="cf7cw-checkbox" name="cf7cw-open-new-tab" value="on" <?php if (isset($cf7cw_open_new_tab) && $cf7cw_open_new_tab == 'on') esc_attr_e('checked', 'connect-contact-form-7-to-social-app'); ?>>
                                <span class="cf7cw-slider cf7cw-round"></span>
                            </label>
                            <p><?php esc_html_e('Enable to open whatsapp in new tab.', 'connect-contact-form-7-to-social-app'); ?></p>
                            <p><?php esc_html_e('Note:', 'connect-contact-form-7-to-social-app'); ?> <i><?php esc_html_e('This option is for only desktop devices, It will be useful for WhatsApp web on desktop devices.', 'connect-contact-form-7-to-social-app'); ?></i></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php esc_html_e('Alternative Numbers', 'connect-contact-form-7-to-social-app'); ?></label>
                        </th>
                        <td>
                            <div class="cf7cw-add-channel">
                                <span class="cf7cw-add-btn-wp">
                                    <a href="javascript:void(0);" class="cf7cw-add-btn">Add Channel</a>
                                    <a href="<?php echo CF7CW_PRO_PLUGIN_LINK; ?>" target="_blank" class="cf7cw-pro-btn" title="Upgrade to Pro">Pro</a>
                                </span>
                            </div>
                            <table class="cf7cw-alt-numbers-table">
                                <tr class="cf7cw-channel-row">
                                    <td><input type="text" name="cf7cw-alt-numbers[0][label]" placeholder="Add label" value="Geek Code Lab" disabled></td>
                                    <td><input type="text" name="cf7cw-alt-numbers[0][wh-number]" placeholder="Enter whatsapp number" value="1XXXXXXXXXX" disabled></td>
                                    <td><a href="javascript:void(0);" class="cf7cw-remove-channel">Remove</a></td>
                                </tr>
                            </table>
                            <?php
                            printf(
                                '<p><i>%1$s <strong>%2$s</strong> %3$s</i></p>',
                                esc_html__('You can use', 'connect-contact-form-7-to-social-app'),
                                esc_html__('[cf7cwp_channel field-name]', 'connect-contact-form-7-to-social-app'),
                                esc_html__('tag to allow guest/user select WA number to send.', 'connect-contact-form-7-to-social-app')
                            );
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php esc_html_e('Disable mail sending', 'connect-contact-form-7-to-social-app'); ?></label>
                        </th>
                        <td>
                            <label class="cf7cw-switch">
                                <input type="checkbox" class="cf7cw-checkbox" name="cf7cw-disable-mail-sending" value="on" disabled>
                                <span class="cf7cw-slider cf7cw-round cf7cw-disable-mail"></span>
                                <a href="<?php echo CF7CW_PRO_PLUGIN_LINK; ?>" target="_blank" class="cf7cw-pro-btn" title="Upgrade to Pro">Pro</a>
                            </label>
                            <p><?php esc_html_e('Enable to stop mail from this contact form.', 'connect-contact-form-7-to-social-app'); ?></p>
                        </td>
                    </tr>
                    <div class="cf7cw-hidden-input">
                        <input type="hidden" name="cf7cw-nonce" value="<?php esc_attr_e($cf7cw_nonce, 'connect-contact-form-7-to-social-app');  ?>">
                    </div>
                </table>
            </div>
            <?php
        }

        static function cf7cw_save_settings_call($contact_form)
        {
            $form_id = $contact_form->id();
            $form_title = $contact_form->title();
            $cf7cw_wpnonce = sanitize_text_field($_POST['cf7cw-nonce']);

            $cf7cw_status = $cf7cw_phone_number = $cf7cw_message_body = $cf7cw_open_new_tab = "";
            if (isset($_POST['cf7cw-plugin-status'])) $cf7cw_status      = sanitize_text_field($_POST['cf7cw-plugin-status']);
            if (isset($_POST['cf7cw-phone-number'])) $cf7cw_phone_number = sanitize_text_field($_POST['cf7cw-phone-number']);
            if (isset($_POST['cf7cw-message-body'])) $cf7cw_message_body = sanitize_textarea_field($_POST['cf7cw-message-body']);
            if (isset($_POST['cf7cw-open-new-tab'])) $cf7cw_open_new_tab = sanitize_text_field($_POST['cf7cw-open-new-tab']);
            $cf7cw['form_id'] = $form_id;
            $cf7cw['form_title'] = $form_title;
            $cf7cw['cf7cw_status'] = $cf7cw_status;
            $cf7cw['cf7cw_phone_number'] = $cf7cw_phone_number;
            $cf7cw['cf7cw_message_body'] = $cf7cw_message_body;
            $cf7cw['cf7cw_open_new_tab'] = $cf7cw_open_new_tab;

            if (wp_verify_nonce($cf7cw_wpnonce, 'cf7cw_option_nonce')) {
                update_option('cf7cw_connect_wh_' . $form_id, $cf7cw, $autoload = null);
            }
        }

        static function connect_wh_message_body()
        {
            return '*Form Title*: [form-title] ' . "\n" . '*Email*: [your-email]' . "\n" . '*Subject*: [your-subject]' . "\n" . '*Message*:' . "\n" . '[your-message]' . "\n" . '--' . "\n" . 'This message was sent from a contact form on *[_site_title]* ([_site_url])';
        }
    }
    new cf7cw_admin();
}
