<?php
if(!class_exists('cf7cw_functions')){
    class cf7cw_functions
    {
        public function __construct() {
            if (is_admin()) {
                add_action('admin_enqueue_scripts', array( $this, 'cf7cw_enqueue_admin_scripts'));
            }else{
                add_action('wp_enqueue_scripts',  array( $this, 'cf7cw_enqueue_scripts'), PHP_INT_MAX, 1);
            }            
            add_action('flamingo_inbound', [$this, 'get_serial_number']);
            add_action( 'wpcf7_mail_sent', array( 'cf7cw_functions', 'cf7cw_after_mail_sent_call' ) );
        }

        public function cf7cw_enqueue_admin_scripts( $hook ) {
            if($hook == 'toplevel_page_wpcf7' || $hook == 'contact_page_wpcf7-new') {
                wp_enqueue_style('cf7cw-admin-css', plugins_url('assets/css/cf7cw-admin-style.css', __FILE__), array(), CF7CW_PLUGIN_VERSION);
                wp_enqueue_script('cf7cw-admin-script-js', plugins_url('assets/js/cf7cw-admin-scripts.js', __FILE__), array('jquery'), CF7CW_PLUGIN_VERSION);
            }
        }

        public function cf7cw_enqueue_scripts() {
            wp_register_script( "cf7cw_script",  plugins_url('/assets/js/cf7cw-front-script.js', __FILE__), array('jquery'), CF7CW_PLUGIN_VERSION, true);
            wp_enqueue_script("cf7cw_script");
            wp_localize_script('cf7cw_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
        }

        static function cf7cw_after_mail_sent_call($contactform) {
            $form_id = $contactform->id();
            $cf7cw_option = get_option( 'cf7cw_connect_wh_' . $form_id , $default = array() );
            $form_title = $contactform->title();
            
            if(isset($cf7cw_option['cf7cw_status']) && !empty($cf7cw_option['cf7cw_status']) && isset($cf7cw_option['cf7cw_phone_number']) && !empty($cf7cw_option['cf7cw_phone_number'])) {
                
                $wh_message_body = (isset($cf7cw_option['cf7cw_message_body'])) ? wp_unslash($cf7cw_option['cf7cw_message_body']) : '';
                $wh_message_body = wpcf7_mail_replace_tags( @ $wh_message_body );

                $wh_message_body = str_replace( "[form-title]", $form_title , $wh_message_body );

                $wh_url = "https://wa.me/" . $cf7cw_option['cf7cw_phone_number'] . "/?text=" . urlencode(html_entity_decode($wh_message_body));
    
                $cf7cw_new_opt = array();
                $cf7cw_new_opt['cf7cw_wh_url'] = $wh_url;
                $cf7cw_new_opt['cf7cw_new_tab'] = $cf7cw_option['cf7cw_open_new_tab'];
            }else{
                $cf7cw_new_opt = array();
            }
            $cookie_name = "cf7cw_options";
            setcookie($cookie_name, json_encode($cf7cw_new_opt), time() + (86400 * 30), "/");
        }        

    }
    new cf7cw_functions();
}