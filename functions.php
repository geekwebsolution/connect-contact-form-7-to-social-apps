<?php
if(!class_exists('cf7cw_functions')){
    class cf7cw_functions
    {
        public function __construct() {
            if (is_admin()) {
                add_action('admin_enqueue_scripts', array( $this, 'cf7cw_enqueue_admin_scripts'));
            }else{
                add_action('wp_enqueue_scripts',  array( $this, 'cf7cw_enqueue_scripts'), 999, 1);
            }            
            add_action('flamingo_inbound', [$this, 'get_serial_number']);
            add_action( 'wpcf7_mail_sent', array( 'cf7cw_functions', 'cf7cw_after_mail_sent_call' ) );
        }

        public function cf7cw_enqueue_admin_scripts() {
            wp_enqueue_style('cf7cw-admin-css', plugins_url('assets/css/cf7cw-admin-style.css', __FILE__), array(), CF7CW_PLUGIN_VERSION);
            wp_enqueue_script('cf7cw-admin-script-js', plugins_url('assets/js/cf7cw-admin-scripts.js', __FILE__), array('jquery'), CF7CW_PLUGIN_VERSION);
        }

        public function cf7cw_enqueue_scripts() {
            wp_register_script( "cf7cw_script",  plugins_url('/assets/js/cf7cw-front-script.js', __FILE__), array('jquery'), CF7CW_PLUGIN_VERSION, true);
            wp_enqueue_script("cf7cw_script");
            wp_localize_script('cf7cw_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
        }

        static function rep_shortcode($form_id, $inputs){
            
            $cf7cw_option = get_option( 'cf7cw_connect_wh_' . $form_id , $default = false );
            $string = wp_unslash($cf7cw_option['cf7cw_message_body']);

            $ContactForm = WPCF7_ContactForm::get_instance($form_id);
            $form_fields = $ContactForm->scan_form_tags();
            
            if(isset($inputs) && !empty($inputs)){
                foreach ($inputs as $key => $value) {
                    
                    if(is_array($value)) $value = implode(", ",$value);
                    if(strpos($string,"_format_".$key)){
                        if(strpos($string,$key)){
                            $new_fields['['.$key.']'] = $value;
                        }
                        $start_pos_no   = strpos($string,"[_format_".$key);
                        $end_pos_no     = strpos($string, "]",strpos($string,"[_format_".$key));
                        $cut_str_lenth  = $end_pos_no - $start_pos_no;
                        $newString      = substr($string, $start_pos_no,$cut_str_lenth);
                        $rep_arry       = array('[_format_'.$key.' "','"');
                        $new_val        = array('','');
	                    $format         = str_replace($rep_arry,"",$newString);
                        $timestamp      = strtotime($value); 
                        $date           = date($format,$timestamp);
                        $new_fields['[_format_'.$key.' "'.$format.'"]'] = ($date != false) ? $date : '';

                    }elseif (strpos($string,"_raw_".$key)) {
                        if(strpos($string,$key)){
                            $new_fields['['.$key.']'] = $value;
                        }
                        if(isset($form_fields) && $form_fields){
                            foreach ($form_fields as $form_field_key => $form_field_value) {
            
                                if(isset($form_field_value->basetype) || $form_field_value->basetype == 'select'){
                                    $raw_index = 0;
                                    foreach ($form_field_value->raw_values as $raw_key => $raw_value) {
                                        if(strpos($raw_value,$value)){
                                            $new_raw_index = $raw_index;
                                            $new_fields['[_raw_'.$key.']'] = $form_field_value->values[$new_raw_index];
                                        }
                                        $raw_index++;
                                    }
                                }
                            }
                        }
                    }else{
                        $new_fields['['.$key.']'] = $value;
                    }
                }
            }
            return str_replace(array_keys($new_fields), array_values($new_fields), $string);
        }

        static function cf7cw_after_mail_sent_call($contactform) {
            $form_id = $contactform->id();
            $cf7cw_option = get_option( 'cf7cw_connect_wh_' . $form_id , $default = false );
            $form_title = $contactform->title();
            
            if(isset($cf7cw_option['cf7cw_status']) && !empty($cf7cw_option['cf7cw_status']) && isset($cf7cw_option['cf7cw_phone_number']) && !empty($cf7cw_option['cf7cw_phone_number'])){
                $inputs = array();
                $submission = WPCF7_Submission::get_instance();                                
                $inputs = $submission->get_posted_data();                     

                $remote_ip = $submission->get_meta( 'remote_ip' ) ? $submission->get_meta( 'remote_ip' ) : '';
                $user_agent = $submission->get_meta( 'user_agent' ) ? $submission->get_meta( 'user_agent' ) : '';
                $url = $submission->get_meta( 'url' ) ? $submission->get_meta( 'url' ) : '';
                
                if ( $timestamp = $submission->get_meta( 'timestamp' ) ) {
                    $date = wp_date( get_option( 'date_format' ), $timestamp );
                    $time = wp_date( get_option( 'time_format' ), $timestamp );
                }

                $invalid_fields = count( $submission->get_invalid_fields() );

                if ( class_exists( 'Flamingo_Inbound_Message' ) ) {
                
                    $post_meta = get_post_meta( $form_id, '_flamingo', true );

                    if($post_meta) {   
                        $channel_id = isset( $post_meta['channel'] ) ? (int) $post_meta['channel'] : wpcf7_flamingo_add_channel( $contact_form->name(), $contact_form->title() );
                        
                        if ( $channel_id ) {
                            $srnum = 1 + (int) Flamingo_Inbound_Message::count(array( 'channel_id' => $channel_id ) );
                            $inputs['_serial_number'] = $srnum;
                        }
                    }

                }

                $inputs['form-id'] = $form_id;                
                $inputs['form-title'] = $form_title;
                $inputs['_remote_ip'] = $remote_ip;
                $inputs['_user_agent'] = $user_agent;
                $inputs['_url'] = $url;
                $inputs['_date'] = $date;
                $inputs['_time'] = $time;
                $inputs['_invalid_fields'] = $invalid_fields;
                $inputs['_site_title'] = get_bloginfo( 'name' );
                $inputs['_site_description'] = get_bloginfo( 'description' );
                $inputs['_site_url'] = get_bloginfo('url');
                $inputs['_site_admin_email'] = get_bloginfo('admin_email');

                $new_msg = cf7cw_functions::rep_shortcode($form_id, $inputs);
                $wh_url = "https://wa.me/" . $cf7cw_option['cf7cw_phone_number'] . "/?text=" . urlencode(html_entity_decode($new_msg));
    
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