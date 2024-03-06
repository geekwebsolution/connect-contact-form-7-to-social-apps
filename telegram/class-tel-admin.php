<?php
if (!class_exists('cf7cw_connect_tel_settings')) {
    class cf7cw_connect_tel_settings
    {
        private $tel_fns;
        private $cmd = 'cf7cw_start';

        public function __construct()
        {
            $this->tel_fns = new cf7cw_tel_functions();
            add_action( 'admin_menu', array( $this, 'menu_page' ) );
            add_action( 'admin_init', array( $this, 'save_form' ), 50 );
            add_action( 'admin_init', array( $this, 'settings_section' ), 999 );
            add_action( 'wpcf7_editor_panels', array( $this, 'connect_tel_add_tab' ));
            add_action( 'wpcf7_after_save', array( $this, 'cf7cw_save_tel_settings_call' ));
        }

        /**
         * Admin menu page for Telegram configration
         */
        public function menu_page(){
            add_submenu_page( 'wpcf7', 'CF7 Telegram', 'CF7 Telegram', 'wpcf7_read_contact_forms', 'cf7cw_telegram', array( $this, 'plugin_menu_cbf' ) );
        }

        public function plugin_menu_cbf() { ?>	
            <div class="wrap">
                <h1><?php echo __( 'Telegram notification settings', CF7CW_TEXT_DOMAIN ); ?></h1>
                <?php 
                    $this->tel_fns->bot_status();
                    $this->view_full_list();
                    settings_errors(); 
                ?>
                <form method="post" action="admin.php?page=cf7cw_telegram"> 
                    <?php settings_fields( 'cf7cw_settings_page' ); ?>	
                    <?php do_settings_sections( 'cf7cw_settings_page' ); ?> 
                    <input type="hidden" name="cf7cw_settings_form_action" value="save" />
                    <p><?php echo __( 'To activate telegram notifications go to <code>Contact forms -> Edit form -> Telegram</code>. After that configure given settings to get telegram notification for that form.', CF7CW_TEXT_DOMAIN ); ?></p>
                    <?php submit_button(); ?>
                </form>
            </div> 
            <?php
        }

        /**
         * Telegram setting fields
         */
        function settings_section() {
            add_settings_section(
                'cf7cw_sections_main', 
                __( 'Bot-settings', CF7CW_TEXT_DOMAIN ),
                array(),
                'cf7cw_settings_page'
            );
            
            add_settings_field( 
                'bot_token', 
                __( 'Bot Token<br/><small>You need to create your own Telegram-Bot.<br/><a target="_blanc" href="https://core.telegram.org/bots#3-how-do-i-create-a-bot">How to create</a></small>', CF7CW_TEXT_DOMAIN ), 
                array( $this, 'settings_clb' ), 
                'cf7cw_settings_page', 
                'cf7cw_sections_main', 
                array(
                    'type'		=> 'password',
                    'name'		=> 'cf7cw_telegram_tkn',
                    'value'		=> $this->tel_fns->get_bot_token(),
                    'ph'		=> __( 'or define by CF7CW_BOT_TOKEN constant', CF7CW_TEXT_DOMAIN ),
                )
            );
        }

        function settings_clb( $data ){
            switch ( $data['type'] ){
                case 'text' :;
                case 'password' :
                    $disabled = !empty( $data['disabled'] ) ? ' disabled="disabled" ' : '';
                    $placeholder = ' placeholder="'. esc_attr( @$data['ph'] ) . '"';
                    echo 
                    '<input type="'. esc_attr( $data['type'] ) .'" ' .
                        'name="'. esc_attr( $data['name'] ) .'" ' .
                        'value="'. esc_attr( $data['value'] ) .'"' .
                        'class="large-text" ' .
                        $disabled .
                        $placeholder .
                    '/>'; break;
            }
        }

        /**
         * Admin telegram settings form submission
         */
        public function save_form() {
            if ( $this->current_action() !== 'update' ) return;
            if ( ! wp_verify_nonce( @ $_POST['_wpnonce'], 'cf7cw_settings_page-options' ) ) return;
            
            $this->tel_fns->save_bot_token();
        }

        public function current_action(){
            return isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';
        }
        
        public function connect_tel_add_tab($panels)
        {
            $panels['connect-telegram'] = array(
                'title'     => __('Telegram', CF7CW_TEXT_DOMAIN),
                'callback'  => array( $this, 'connect_tel_settings_callback' ),
            );
            return $panels;
        }

        /**
         * Telegram settings HTML for Contact form edit screen
         */
        public function connect_tel_settings_callback($post)
        {
            $cf7cw_tel_option_nonce = wp_create_nonce('cf7cw_tel_option_nonce');
            $form_id = $post->id();
            $option = get_option('cf7cw_connect_tel_' . $form_id, $default = array());
            $cf7cw_message_body = isset($option['cf7cw_message_body']) ? $option['cf7cw_message_body']: cf7cw_connect_tel_settings::connect_tel_message_body(); ?>
            
            <h2><?php esc_html_e('Telegram', CF7CW_TEXT_DOMAIN); ?></h2>
            <legend>
                <?php esc_html_e('In the message body, you can use these tags:', CF7CW_TEXT_DOMAIN); ?><br>
                <?php $post->suggest_mail_tags(); ?>
            </legend>
            <div class="cf7cw-sec">
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label><?php esc_html_e('Status', CF7CW_TEXT_DOMAIN); ?></label>
                        </th>
                        <td>
                            <label class="cf7cw-switch">
                                <input type="checkbox" class="cf7cw-checkbox" name="cf7cw-tel-status" value="on" <?php if (isset($option['cf7cw_status']) && $option['cf7cw_status'] == 'on') esc_attr_e('checked'); ?>>
                                <span class="cf7cw-slider cf7cw-round"></span>
                            </label>
                            <p><?php esc_html_e('Enable to connect telegram for this contact form.', CF7CW_TEXT_DOMAIN); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php esc_html_e('Message', CF7CW_TEXT_DOMAIN); ?></label>
                        </th>
                        <td>
                            <textarea id="cf7cw_message_body" name="cf7cw-tel-message-body" cols="100" rows="18" class="large-text code"><?php echo esc_html(wp_unslash($cf7cw_message_body)); ?></textarea>
                            <p><?php esc_html_e('Note:', CF7CW_TEXT_DOMAIN); ?> <i><?php esc_html_e('You can customize above telegram message body.', CF7CW_TEXT_DOMAIN); ?></i></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php esc_html_e('Disable mail sending', CF7CW_TEXT_DOMAIN); ?></label>
                        </th>
                        <td>
                            <label class="cf7cw-switch">
                                <input type="checkbox" class="cf7cw-checkbox" name="cf7cw-disable-mail-sending" value="on" disabled>
                                <span class="cf7cw-slider cf7cw-round cf7cw-disable-mail"></span>
                                <a href="<?php echo CF7CW_PRO_PLUGIN_LINK; ?>" target="_blank" class="cf7cw-pro-btn" title="Upgrade to Pro">Pro</a>
                            </label>
                            <p><?php esc_html_e('Enable to stop mail from this contact form.', CF7CW_TEXT_DOMAIN); ?></p>
                        </td>
                    </tr>
                    <div class="cf7cw-hidden-input">
                        <input type="hidden" name="cf7cw-tel-nonce" value="<?php esc_attr_e($cf7cw_tel_option_nonce, CF7CW_TEXT_DOMAIN);  ?>">
                    </div>
                </table>
            </div>
            <?php
        }

        public function cf7cw_save_tel_settings_call($contact_form)
        {
            $form_id = $contact_form->id();
            $form_title = $contact_form->title();
            $cf7cw_tel_wpnonce = sanitize_text_field($_POST['cf7cw-tel-nonce']);

            $cf7cw_status = $cf7cw_message_body = "";
            if (isset($_POST['cf7cw-tel-status']))  $cf7cw_status = sanitize_text_field($_POST['cf7cw-tel-status']);
            if (isset($_POST['cf7cw-tel-message-body'])) $cf7cw_message_body = sanitize_textarea_field($_POST['cf7cw-tel-message-body']);
            $cf7cw['form_id'] = $form_id;
            $cf7cw['form_title'] = $form_title;
            $cf7cw['cf7cw_status'] = $cf7cw_status;
            $cf7cw['cf7cw_message_body'] = $cf7cw_message_body;

            if (wp_verify_nonce($cf7cw_tel_wpnonce, 'cf7cw_tel_option_nonce')) {
                update_option('cf7cw_connect_tel_' . $form_id, $cf7cw, $autoload = null);
            }
        }

        static function connect_tel_message_body()
        {
            return '<strong>Form Title</strong>: [form-title] ' . "\n" . '<strong>Email</strong>: [your-email]' . "\n" . '<strong>Subject</strong>: [your-subject]' . "\n" . '<strong>Message</strong>:' . "\n" . '[your-message]' . "\n" . '--' . "\n" . 'This message was sent from a contact form on <strong>[_site_title]</strong> ([_site_url])';
        }

        /** View full list section */
        public function view_full_list(){
            echo '<h2>'. __( 'Subscribers list', CF7CW_TEXT_DOMAIN ) .'</h2>';
            
            $req = $this->pending_html_list();
            $app = $this->approved_html_list();
            
            if ( ! $req && ! $app ) _e( 'List is empty', CF7CW_TEXT_DOMAIN );
            
            echo '<p>', sprintf( __( 'Add user: send the <code>%s</code> comand to your bot', CF7CW_TEXT_DOMAIN ), '/'. $this->cmd ), '</p>';
            echo '<p>', sprintf( __( 'Add group: add your bot to the group and send the <code>%s</code> comand to your group', CF7CW_TEXT_DOMAIN ), '/'. $this->cmd ), '</p>';
        }

        private function approved_html_list(){
            $list = $this->tel_fns->get_chats();
            if ( empty( $list) ) return array();
            
            foreach( $list as $id => $chat )				
            echo vsprintf( $this->get_template( 'f_item' ), $this->tel_fns->get_listitem_data( $chat, 'active' ) );
    
            return true;
        }
        
        private function pending_html_list() {
            $data = $this->tel_fns->get_chats( 'pending' );
            if ( empty( $data ) ) return false;
            
            foreach( $data as $id => $item ) :
                echo vsprintf( $this->get_template( 'f_item' ), $this->tel_fns->get_listitem_data( $item ) );
            endforeach;
            
            return true;
        }

        private function get_template( $name ){
            $t['f_item'] =
            '<div class="cf7cw_notice notice-%1$s is-dismissible" data-chat="%2$d" status="%1$s" >
                <div class="info dashicons-before dashicons-%3$s">
                    <span class="username">
                        %4$s
                    </span>
                    <span class="nickname">
                        %5$s
                    </span>
                    %6$s
                </div>
                <div class="buttons">
                    <a class="approve" data-action="approve" ><span class="screen-reader-text">'. __( 'Approve', CF7CW_TEXT_DOMAIN ) . '</span>'. __( 'Approve', CF7CW_TEXT_DOMAIN ) . '</a>
                    <a class="pause" data-action="pause" ><span class="screen-reader-text">'. __( 'Pause', CF7CW_TEXT_DOMAIN ) . '</span>'. __( 'Pause', CF7CW_TEXT_DOMAIN ) . '</a>
                    <a class="refuse" data-action="refuse" ><span class="screen-reader-text">'. __( 'Delete', CF7CW_TEXT_DOMAIN ) . '</span>'. __( 'Delete', CF7CW_TEXT_DOMAIN ) . '</a>
                </div>
            </div>';
            
            return $t[ $name ];
        }
    }
    new cf7cw_connect_tel_settings();
}
