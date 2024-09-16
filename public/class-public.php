<?php
if (!class_exists('cf7cw_public')) {
    class cf7cw_public
    {
        public function __construct()
        {
            add_action('wp_enqueue_scripts',  array($this, 'cf7cw_enqueue_scripts'), PHP_INT_MAX);
            add_action('wpcf7_mail_sent', array('cf7cw_public', 'cf7cw_after_mail_sent_call'));
            add_action('wp_footer', array('cf7cw_public', 'cf7cw_footer_chat_widget'));
        }

        public function cf7cw_enqueue_scripts()
        {
            wp_register_style("cf7cw_style", plugins_url('/assets/css/cf7cw-front-style.css', __DIR__), array(), CF7CW_PLUGIN_VERSION);
            wp_enqueue_style("cf7cw_style");

            wp_register_script("cf7cw_script",  plugins_url('/assets/js/cf7cw-front-script.js', __DIR__), array('jquery'), CF7CW_PLUGIN_VERSION, true);
            wp_enqueue_script("cf7cw_script");

            $cf7cw_options = cf7cw_options();

            $time_delay_status  = $cf7cw_options['triggers-targeting']['triggers_time_delay'];
            $triggers_form_after_second  = $cf7cw_options['triggers-targeting']['triggers_show_form_after_second'];
            $form_close_on_submit = $cf7cw_options['customize_form']['chat_widget_form_behaviour_close_on_submit'];
            $on_click_greetings_action = $cf7cw_options['greetings']['greeting_behavior_on_click_action'];
            
            $country_code = $cf7cw_options['whatsapp_info']['country_code'];
            $wh_number = $cf7cw_options['whatsapp_info']['wh_number'];

            $redirect_url = "https://wa.me/" . $country_code . $wh_number . "/?text=";
            
            wp_localize_script( 'cf7cw_script', 'cf7cwObj',
                array(
                    'time_delay_status' => $time_delay_status,
                    'triggers_form_after_second' => $triggers_form_after_second,
                    'form_close_on_submit' => $form_close_on_submit,
                    'on_click_greetings_action' => $on_click_greetings_action,
                    'redirect_wh_url' => $redirect_url
                )
            );
        }

        static function cf7cw_after_mail_sent_call($contactform)
        {
            $form_id = $contactform->id();
            
            $cf7cw_option = get_option('cf7cw_connect_wh_' . $form_id, $default = array());
            $form_title = $contactform->title();

            $form_meta_status = (isset($cf7cw_option['cf7cw_status'])) ? $cf7cw_option['cf7cw_status'] : 'on';
            $form_meta_phone_number = (isset($cf7cw_option['cf7cw_phone_number']) && !empty($cf7cw_option['cf7cw_phone_number'])) ? $cf7cw_option['cf7cw_phone_number'] : "";

            $admin_option = cf7cw_options();

            $chat_widget_status = (isset($admin_option['triggers-targeting']['triggers_activate_cf7_form_chat_widget'])) ? $admin_option['triggers-targeting']['triggers_activate_cf7_form_chat_widget'] : "";
            $chat_widget_phone_number = (isset($admin_option['whatsapp_info']['country_code']) && isset($admin_option['whatsapp_info']['wh_number']) && !empty($admin_option['whatsapp_info']['wh_number'])) ? $admin_option['whatsapp_info']['country_code'] . $admin_option['whatsapp_info']['wh_number'] : "";
            $chat_widget_cf7 = (isset($admin_option['customize_form']['chat_widget_contact_form_7']) && !empty($admin_option['customize_form']['chat_widget_contact_form_7'])) ? $admin_option['customize_form']['chat_widget_contact_form_7'] : "";

            // Final
            // $cf7cw_status = (!empty($chat_widget_phone_number) && !empty($chat_widget_cf7)) ? $chat_widget_status : $form_meta_status;
            $cf7cw_phone_number = (!empty($form_meta_status) && !empty($chat_widget_phone_number) && !empty($chat_widget_cf7) && $form_id == $chat_widget_cf7) ? $chat_widget_phone_number : $form_meta_phone_number;

            if( ($chat_widget_status == "on" && !empty($form_meta_status) && !empty($chat_widget_phone_number) && !empty($chat_widget_cf7) && $form_id == $chat_widget_cf7) || (!empty($form_meta_status) && !empty($form_meta_phone_number)) ) {
                $wh_message_body = (isset($cf7cw_option['cf7cw_message_body'])) ? wp_unslash($cf7cw_option['cf7cw_message_body']) : cf7cw_public::connect_wh_message_body();
                $wh_message_body = wpcf7_mail_replace_tags(@$wh_message_body);

                $wh_message_body = str_replace("[form-title]", $form_title, $wh_message_body);

                $wh_url = "https://wa.me/" . $cf7cw_phone_number . "/?text=" . urlencode(html_entity_decode($wh_message_body));

                $cf7cw_new_opt = array();
                $cf7cw_new_opt['cf7cw_wh_url'] = $wh_url;
                $cf7cw_new_opt['cf7cw_new_tab'] = (isset($cf7cw_option['cf7cw_open_new_tab'])) ? $cf7cw_option['cf7cw_open_new_tab'] : "on";
            }else{
                $cf7cw_new_opt = array();
            }

            $cookie_name = "cf7cw_options";
            setcookie($cookie_name, json_encode($cf7cw_new_opt), time() + (86400 * 30), "/");
        }

        /**
         * Chat Widgets
         */
        static function cf7cw_footer_chat_widget()
        {
            $cf7cw_options = cf7cw_options();

            $chat_widget_status  = isset($cf7cw_options['triggers-targeting']['triggers_activate_cf7_form_chat_widget']) ? $cf7cw_options['triggers-targeting']['triggers_activate_cf7_form_chat_widget'] : "";

            if(isset($chat_widget_status) && $chat_widget_status == "on") {
                // Include Chat Widget
                include_once('templates/chat-widget.php');
            }
        }

        static function connect_wh_message_body()
        {
            return '*Form Title*: [form-title] ' . "\n" . '*Email*: [your-email]' . "\n" . '*Subject*: [your-subject]' . "\n" . '*Message*:' . "\n" . '[your-message]' . "\n" . '--' . "\n" . 'This message was sent from a contact form on *[_site_title]* ([_site_url])';
        }
    }
    new cf7cw_public();
}