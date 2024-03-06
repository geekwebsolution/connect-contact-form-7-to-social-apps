<?php
if(!class_exists('cf7cw_tel_functions')) {
    class cf7cw_tel_functions
    {
        private $cmd = 'cf7cw_start';
        private $bot_token;
        static $instance;
        public $domain = 'cf7-telegram';
        public $api_url = 'https://api.telegram.org/bot%s/';
        public $chats = array();

        /**
         * Constructor
         */
        function __construct(){
            $this->load_bot_token();
            $this->load_chats();
            
            add_action( 'current_screen', array( $this, 'current_screen' ), 999 );
            add_action( 'cf7cw_telegram_settings', array( $this, 'check_updates' ), 999 );
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 999, 1 );
            add_action( 'wpcf7_before_send_mail', array( $this, 'send' ), 99999, 3 );
            add_action( 'wp_ajax_cf7cw_telegram', array( $this, 'ajax' ) );
        }

        /**
         * After current screen loaded
         */
        public function current_screen(){
            $screen = get_current_screen();
            if ( false === strpos( $screen->id, 'cf7cw_telegram' ) ) return;
            do_action( 'cf7cw_telegram_settings' );
        }

        /**
         * Admin enqueue scripts
         */
        public function admin_enqueue_scripts($hook) {
            $localize_params = array(
                'ajax'		=> admin_url('admin-ajax.php'),
                'nonce'		=> wp_create_nonce( 'cf7cw_telegram_nonce' ),
                'l10n'		=> array(
                    'confirm_approve'	=> __( 'Do you really want to approve?', CF7CW_TEXT_DOMAIN ),
                    'confirm_refuse'	=> __( 'Do you really want to refuse?', CF7CW_TEXT_DOMAIN ),
                    'confirm_pause'		=> __( 'Do you really want to pause?', CF7CW_TEXT_DOMAIN ),
                    'approved'	=> __( 'Successfully approved', CF7CW_TEXT_DOMAIN ),
                    'refused'	=> __( 'Request refused', CF7CW_TEXT_DOMAIN ),
                ),
            );
            
            if($hook == 'toplevel_page_wpcf7' || $hook == 'contact_page_cf7cw_telegram') {
                wp_enqueue_style( 'cf7cwtelegram-admin-styles', CF7CW_PLUGIN_URL . '/telegram/assets/css/admin.css', array(), CF7CW_PLUGIN_VERSION );
                wp_enqueue_script( 'cf7cwtelegram-admin', CF7CW_PLUGIN_URL . '/telegram/assets/js/admin.js', array('jquery'), CF7CW_PLUGIN_VERSION );
                wp_localize_script( 'cf7cwtelegram-admin', 'wpData', $localize_params );
            }
        }

        /** Get bot token */
        private function load_bot_token(){
            $token = get_option( 'cf7cw_telegram_tkn' );
            $this->bot_token = empty( $token ) ? '' : $token;
            return $this;
        }

        /** Set bot token */
        private function set_bot_token( $token ){
            $this->bot_token = $token;
            update_option( 'cf7cw_telegram_tkn', $token, false );
            return $this;
        }

        /** On submit of bot token */
        private function save_bot_token() {            
            $token = $_REQUEST['cf7cw_telegram_tkn'];
            $this->set_bot_token( $token );
            return $this;
        }

        /** Save chats */
        private function save_chats( $chats ){
            update_option( 'cf7cw_telegram_chats', $chats, false );
            return $this;
        }

        /** Load connected chats */
        public function load_chats(){
            $chats = get_option( 'cf7cw_telegram_chats' );
            
            if ( ! empty( $chats ) && is_string( $chats ) ) :
                $list = explode( ',', $chats );
                $chats = array();
                
                foreach( $list as $item )
                $chats[ $item ] = array( 'id' => $item, 'status' => 'active', 'first_name' => '', 'last_name' => '' );
                
                $this->save_chats( $chats );
            endif;
            $this->chats = empty( $chats ) ? array() : ( array ) $chats;
            return $this;
        }

        /** Get bot token */
        public function get_bot_token(){
            return $this->bot_token;
        }

        private function get_api_url(){
            $token = $this->get_bot_token();
            return sprintf( $this->api_url, $token );
        }
        
        /**
         * Send telegram message if configuration matches
         */
        public function send( $cf, & $abort, $instance ){
            $list = $this->get_chats();
            if ( empty( $list ) ) return;
            if ( $abort ) return;
            if ( apply_filters( 'cf7cw_skip_tg', false, $cf, $instance ) ) return;
            
            $form_id = $cf->id();
            $form_title = $cf->title();
            $cf7cw_tel_option = get_option( 'cf7cw_connect_tel_' . $form_id , $default = array() );

            if(isset($cf7cw_tel_option['cf7cw_status']) && !empty($cf7cw_tel_option['cf7cw_status']) && isset($cf7cw_tel_option['cf7cw_message_body']) && !empty($cf7cw_tel_option['cf7cw_message_body'])) {
                $telegram_msg_body = wp_unslash( $cf7cw_tel_option['cf7cw_message_body'] );
                $data = $instance->get_posted_data();
        
                $output = wpcf7_mail_replace_tags( @ $telegram_msg_body );
                $mode = 'HTML';

                $output = str_replace( "[form-title]", $form_title , $output );

                $output = wp_kses( $output, array(
                    'a'	=> array( 'href' => true ),
                    'b' => array(), 'strong' => array(), 'i' => array(), 'em' => array(), 'u' => array(), 'ins' => array(), 's' => array(), 'strike' => array(), 'del' => array(), 'code' => array(), 'pre' => array(),
                ) );	
                
                foreach( $list as $id => $chat ) :
                    $chat_id = is_numeric( $id ) ? $id : $chat['id'];
                    if ( ! is_numeric( $chat_id ) ) continue;			
                    $msg_data = array(
                        'chat_id'					=> $chat_id,
                        'text'						=> $output,
                        'parse_mode'				=> $mode,
                        'disable_web_page_preview'	=> true
                    );
                    $this->api_request( 'sendMessage', apply_filters( 'cf7cw_sendMessage', $msg_data, $chat_id, $mode ) );
                    do_action( 'cf7cw_message_sent', $msg_data, $instance );
                endforeach;
                
                do_action( 'cf7cw_messages_sent', $list, $output, $mode, $instance );
            }
        }

        /** Check entered bot */
        public function check_bot() {
            $check = $this->api_request( 'getMe' );
            
            if ( false === $check ) 
            return new WP_Error( 'check_bot_error', __( 'An error has occured. See php error log.', CF7CW_TEXT_DOMAIN ) );
    
            return $check;		
        }

        /** Check entered bot status */
        public function bot_status(){
            if ( ! $this->has_token() ) return;
            $check_bot = $this->check_bot();
            $status_format = 
                '<div class="cf7cw_check_bot %s">
                    <strong class="status">%s</strong>
                    <div>'. __( 'Bot username', CF7CW_TEXT_DOMAIN ) . ': <code class="bot_username">%s</code></div>
                </div>';
            
            if ( ! is_wp_error( $check_bot ) ) :
                echo ( true === @ $check_bot->ok ) ? 
                    sprintf( $status_format, 'online', __( 'Bot is online', CF7CW_TEXT_DOMAIN ), '@' . $check_bot->result->username ) :
                    sprintf( $status_format, 'failed', __( 'Bot is broken', CF7CW_TEXT_DOMAIN ), __( 'unknown', CF7CW_TEXT_DOMAIN ) );
            else :
                echo $check_bot->get_error_message();
            endif;
        }

        private function get_listitem_data( $chat, $status = 'pending' ){
            $first_name = isset($chat['first_name']) ? $chat['first_name'] : '';
            $last_name = isset($chat['last_name']) ? $chat['last_name'] : '';
            $fullname = (!empty($first_name) && !empty($last_name)) ? $first_name .' '. $last_name : $first_name . $last_name;
            return array( 
                $status,
                $chat['id'],
                $chat['id'] > 0 ? 'admin-users' : 'groups',
                empty( $str = trim( $chat['id'] > 0 ?
                    $fullname :
                    $chat['title'] ) ) ? "[{$chat['id']}]" : $str,
                empty( $chat['username'] ) ? '' : '@'. $chat['username'],
                isset( $chat['date'] ) ? wp_date( 'j F Y H:i:s', $chat['date'] ) : '',
            );
        }

        private function get_chats( $status = 'active' ){
            $result = array();
            foreach ( $this->chats as $id => $chat ) :
                if ( $status == $chat['status'] )
                $result[ $id ] = $chat;
            endforeach;
            
            return $result;
        }

        public function check_updates() {
            $update_id = get_option( 'cf7cw_telegram_last_update_id' );
            $param = array(
                'allowed_updates'	=> array( 'message' ),
                'offset'			=> $update_id,
            );
            $updates = $this->api_request( 'getUpdates', $param );
            if ( empty( $updates->result ) ) return;		
            
            $update_ids = array();		
            $upd = array();
            
            foreach( $updates->result as $one ) :
                $update_ids []= $one->update_id;
                
                if ( is_array( @ $one->message->entities ) )
                foreach( $one->message->entities as $ent ) :
                    $cmd = substr( $one->message->text, $ent->offset, $ent->length );
                    if ( 'bot_command' == $ent->type && '/' . $this->cmd === $cmd && empty( $this->chats[ $one->message->chat->id ] ) ) :
                        $upd[ $one->message->chat->id ] = ( array ) $one->message->chat;
                        $upd[ $one->message->chat->id ]['date'] = $one->message->date;
                        $upd[ $one->message->chat->id ]['status'] = 'pending';
                    endif;
                endforeach;
            
                if ( false === strpos( $one->message->text, 'cf7_start' ) ) continue;
    
            endforeach;
            
            $this->chats += $upd;
            $this->save_chats( $this->chats );
    
            sort( $update_ids, SORT_NUMERIC );
            $next_update = array_pop( $update_ids );
            update_option( 'cf7cw_telegram_last_update_id', ( int ) $next_update + 1 );
        }

        private function action_approve( $chat_id, & $new_status ){
            $new_status = 'active';
            if ( empty( $this->chats[ $chat_id ] ) ) return false;
            $this->chats[ $chat_id ]['status'] = $new_status;
            $this->save_chats( $this->chats );
            
            $this->api_request( 'sendMessage', array(
                'chat_id'					=> $chat_id,
                'text'						=> __( 'Subscribed for Contact Form 7 notifications from', CF7CW_TEXT_DOMAIN ) . ' ' . home_url(),
                'disable_web_page_preview'	=> true,
            ) );
            
            return true;
        }

        private function action_pause( $id, & $new_status ){
            $new_status = 'pending';
            if ( empty( $this->chats[ $id ] ) ) return false;
            $this->chats[ $id ]['status'] = $new_status;
            $this->save_chats( $this->chats );
            
            return true;
        }
        
        private function action_refuse( $id, & $new_status ){
            $new_status = 'deleted';
            unset( $this->chats[ $id ] );
            $this->save_chats( $this->chats );
            
            return true;
        }

        public function api_request( $method, $parameters = null, $headers = null ) {
            if ( ! is_string( $method ) ) :
                error_log( "[TELEGRAM] Method name must be a string\n" );
                return false;
            endif;
    
            if ( is_null( $parameters ) ):
                $parameters = array();
            endif;
    
            $url = $this->get_api_url() . $method;
            $args = array(
                'timeout'		=> 5,
                'redirection'	=> 5,
                'blocking'		=> true,
                'method'		=> 'POST',
                'body'			=> $parameters,
            );
            
            if ( ! empty( $headers ) )
            $args['headers'] = $headers;
            
            return $this->request( $url, $args );
        }

        private function request( $url, $args ) {
            $response = wp_remote_post( $url, $args );
            if ( is_wp_error( $response ) ) :
                error_log( "wp_remote_post returned error : ". $response->get_error_code() . ': ' . $response->get_error_message() . ' : ' . $response->get_error_data() ."\n");
                return false;
            endif;

            $http_code = intval( $response['response']['code'] );
            if ( $http_code >= 500 ) :
                error_log( "[TELEGRAM] Server return status {$http_code}" ."\n" );
                sleep( 3 );
                return false;

            elseif ( $http_code == 401 ) :
                error_log( "[TELEGRAM] Wrong token \n" );
                return json_decode( $response['body'] );

            elseif ( $http_code != 200 ) :
                error_log( "[TELEGRAM] Request has failed with error {$response['response']['code']}: {$response['response']['message']}\n" );
                return false;

            elseif ( empty( $response['body'] ) ) :
                error_log( "[TELEGRAM] Server return empty body" );
                return false;

            else :
                return json_decode( $response['body'] );
            endif;
        }
        
        private function has_token(){
            return $this->get_bot_token();
        }

        public function ajax(){
            check_ajax_referer( 'cf7cw_telegram_nonce' );
            $chat_id = @ $_POST['chat'];
            if ( empty( $chat_id ) ) wp_die( json_encode( new \WP_Error( 'empty_chat_id', 'There is no chat_id in request', array( 'status' => 400 ) ) ) );
            
            $action = 'action_' . @ $_POST['do_action'];
            if ( ! method_exists( $this, $action ) ) wp_die( json_encode( new \WP_Error( 'wrong_action', 'There is no correct action in request', array( 'status' => 400 ) ) ) );
            
            $new_status = '';
            echo json_encode( array( 'result' => $this->$action( $chat_id, $new_status ), 'chat' => $chat_id, 'new_status' => $new_status ) );
            wp_die();
        }

    }
    new cf7cw_tel_functions();
}