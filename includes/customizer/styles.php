<?php
/**
 * Implements styles set in the theme customizer
 *
 * @package Customizer Library WooCommerce Designer
 */
if ( !function_exists( 'connect_cf7_to_social_apps_style_build' ) && class_exists( 'connect_cf7_to_social_apps_library_Styles' ) ) {
    /**
     * Process user options to generate CSS needed to implement the choices.
     *
     * @since  1.0.0.
     *
     * @return void
     */
    function connect_cf7_to_social_apps_style_build()
    {
        $cf7cw_defaults = cf7cw_defaults();
        $cf7cw_options  = get_option('cf7cw_options');

        /** Customize Icon CSS */

        $customize_form_key = "customize_form";
        $greetings_key = "greetings";

        // Icon Size
        $cwis_key = "chat_widget_icon_size";

        if(isset($cf7cw_options[$customize_form_key][$cwis_key])) {
            $cwisc_key = "chat_widget_icon_size_custom";
            
            $icon_size = array( 
                "small" => 46, 
                "medium" => 56, 
                "large" => 66, 
                "custom" => (isset($cf7cw_options[$customize_form_key][$cwisc_key]) && !empty($cf7cw_options[$customize_form_key][$cwisc_key])) ? $cf7cw_options[$customize_form_key][$cwisc_key] : $cf7cw_defaults[$customize_form_key][$cwisc_key] 
            );
            $chat_widget_icon_size = $cf7cw_options[$customize_form_key][$cwis_key];

            if(isset($icon_size[$chat_widget_icon_size])) {
                connect_cf7_to_social_apps_library_Styles()->add( array(
                    'selectors'    => array( '.cf7cw-chat-widget-handle-btn-icon' ),
                    'declarations' => array( 'font-size' => intval($icon_size[$chat_widget_icon_size]) . 'px' ),
                ) );
            }
        }

        /** Call to action CSS */

        // Call to action style

        // Text Color
        $cwctc_key = "chat_widget_cta_text_color";
        
        if(isset($cf7cw_options[$customize_form_key][$cwctc_key])) {
            $cwctc_btn_txtcolor = cf7cw_sanitize_hex_color( $cf7cw_options[$customize_form_key][$cwctc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-handle-btn-text' ),
                'declarations' => array( 'color' => $cwctc_btn_txtcolor ),
            ) );
        }

        // Background Color
        $cwcbgc_key = "chat_widget_cta_text_background";

        if(isset($cf7cw_options[$customize_form_key][$cwcbgc_key])) {
            $cwcbgc_btn_txtcolor = cf7cw_sanitize_hex_color( $cf7cw_options[$customize_form_key][$cwcbgc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-handle-btn-text' ),
                'declarations' => array( 'background-color' => $cwcbgc_btn_txtcolor ),
            ) );
        }

        // Text Size
        $cwcts_key = "chat_widget_cta_text_size";

        if(isset($cf7cw_options[$customize_form_key][$cwcts_key])) {
            $cwctsc_key = "chat_widget_cta_text_size_custom";
            
            $text_size = array( 
                "small" => 14, 
                "medium" => 18, 
                "large" => 20, 
                "custom" => (isset($cf7cw_options[$customize_form_key][$cwctsc_key]) && !empty($cf7cw_options[$customize_form_key][$cwctsc_key])) ? $cf7cw_options[$customize_form_key][$cwctsc_key] : $cf7cw_defaults[$customize_form_key][$cwctsc_key] 
            );
            $chat_widget_cta_text_size = $cf7cw_options[$customize_form_key][$cwcts_key];

            if(isset($text_size[$chat_widget_cta_text_size])) {
                connect_cf7_to_social_apps_library_Styles()->add( array(
                    'selectors'    => array( '.cf7cw-chat-widget-handle-btn-text' ),
                    'declarations' => array( 'font-size' => intval($text_size[$chat_widget_cta_text_size]) . 'px' ),
                ) );
            }
        }

        // Customize Form

        // Form Style Text Color
        $cwfstc_key = "chat_widget_form_style_text_color";
        
        if(isset($cf7cw_options[$customize_form_key][$cwfstc_key])) {
            $cwfstc_btn_txtcolor = cf7cw_sanitize_hex_color( $cf7cw_options[$customize_form_key][$cwfstc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( ':root' ),
                'declarations' => array( '--cf7cw-form-text-color' => $cwfstc_btn_txtcolor ),
            ) );
        }

        // Form Style Background Color
        $cwfsbgc_key = "chat_widget_form_style_background";

        if(isset($cf7cw_options[$customize_form_key][$cwfsbgc_key])) {
            $cwfsbgc_btn_txtcolor = cf7cw_sanitize_hex_color( $cf7cw_options[$customize_form_key][$cwfsbgc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( ':root' ),
                'declarations' => array( '--cf7cw-form-bg-color' => $cwfsbgc_btn_txtcolor ),
            ) );
        }

        // Form Style Font Family
        $cwfff_key = "chat_widget_form_font_family";

        if(isset($cf7cw_options[$customize_form_key][$cwfff_key])) {
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-form' ),
                'declarations' => array( 'font-family' => $cf7cw_options[$customize_form_key][$cwfff_key] ),
            ) );
        }

        /** Greetings CSS */

        // Simple Customize Greetings Heading Text Size
        $sghs_key = "simple_greetings_heading_size";

        if(isset($cf7cw_options[$greetings_key][$sghs_key])) {
            $sghcs_key = "simple_greetings_heading_custom_size";
            
            $text_size = array( 
                "small" => 12, 
                "medium" => 14,
                "large" => 16, 
                "custom" => (isset($cf7cw_options[$greetings_key][$sghcs_key]) && !empty($cf7cw_options[$greetings_key][$sghcs_key])) ? $cf7cw_options[$greetings_key][$sghcs_key] : $cf7cw_defaults[$greetings_key][$sghcs_key] 
            );
            $chat_widget_cta_text_size = $cf7cw_options[$greetings_key][$sghs_key];

            if(isset($text_size[$chat_widget_cta_text_size])) {
                connect_cf7_to_social_apps_library_Styles()->add( array(
                    'selectors'    => array( '.cf7cw-chat-widget-greetings-simple-title' ),
                    'declarations' => array( 'font-size' => intval($text_size[$chat_widget_cta_text_size]) . 'px' ),
                ) );
            }
        }

        // Simple Customize Greetings Message Text Size
        $sgms_key = "simple_greetings_message_size";

        if(isset($cf7cw_options[$greetings_key][$sgms_key])) {
            $sgmcs_key = "simple_greetings_message_custom_size";
            
            $text_size = array( 
                "small" => 12, 
                "medium" => 14, 
                "large" => 16, 
                "custom" => (isset($cf7cw_options[$greetings_key][$sgmcs_key]) && !empty($cf7cw_options[$greetings_key][$sgmcs_key])) ? $cf7cw_options[$greetings_key][$sgmcs_key] : $cf7cw_defaults[$greetings_key][$sgmcs_key] 
            );
            $chat_widget_cta_text_size = $cf7cw_options[$greetings_key][$sgms_key];

            if(isset($text_size[$chat_widget_cta_text_size])) {
                connect_cf7_to_social_apps_library_Styles()->add( array(
                    'selectors'    => array( '.cf7cw-chat-widget-greetings-simple-text' ),
                    'declarations' => array( 'font-size' => intval($text_size[$chat_widget_cta_text_size]) . 'px' ),
                ) );
            }
        }

        /** Simple Greeting Template Colors */

        // Text Color
        $sgs1hc_key = "simple_greetings_style_1_heading_color";
        
        if(isset($cf7cw_options[$greetings_key][$sgs1hc_key])) {
            $sgs1hc_btn_txtcolor = cf7cw_sanitize_hex_color( $cf7cw_options[$greetings_key][$sgs1hc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-simple-title' ),
                'declarations' => array( 'color' => $sgs1hc_btn_txtcolor ),
            ) );
        }

        // Message Color
        $sgs1mc_key = "simple_greetings_style_1_message_color";

        if(isset($cf7cw_options[$greetings_key][$sgs1mc_key])) {
            $sgs1mc_btn_txtcolor = cf7cw_sanitize_hex_color( $cf7cw_options[$greetings_key][$sgs1mc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-simple-text' ),
                'declarations' => array( 'color' => $sgs1mc_btn_txtcolor ),
            ) );
        }

        // Background Color
        $sgs1bgc_key = "simple_greetings_style_1_background_color";

        if(isset($cf7cw_options[$greetings_key][$sgs1bgc_key])) {
            $sgs1bgc_bg_color = cf7cw_sanitize_hex_color( $cf7cw_options[$greetings_key][$sgs1bgc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-simple' ),
                'declarations' => array( 'background' => $sgs1bgc_bg_color ),
            ) );
        }

        // Font Family
        $sgs1ff_key = "simple_greetings_style_1_font_family";

        if(isset($cf7cw_options[$greetings_key][$sgs1ff_key])) {
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-simple' ),
                'declarations' => array( 'font-family' => $cf7cw_options[$greetings_key][$sgs1ff_key] ),
            ) );
        }


        // Wave Style 1 Greetings Heading Text Size
        $wgs1hsl_key = "wave_greetings_style_1_heading_size_large";

        if(isset($cf7cw_options[$greetings_key][$wgs1hsl_key])) {
            $wgs1hcs_key = "wave_greetings_style_1_heading_custom_size";
            
            $text_size = array( 
                "small" => 12, 
                "medium" => 14, 
                "large" => 16, 
                "custom" => (isset($cf7cw_options[$greetings_key][$wgs1hcs_key]) && !empty($cf7cw_options[$greetings_key][$wgs1hcs_key])) ? $cf7cw_options[$greetings_key][$wgs1hcs_key] : $cf7cw_defaults[$greetings_key][$wgs1hcs_key] 
            );
            $chat_widget_cta_text_size = $cf7cw_options[$greetings_key][$wgs1hsl_key];

            if(isset($text_size[$chat_widget_cta_text_size])) {
                connect_cf7_to_social_apps_library_Styles()->add( array(
                    'selectors'    => array( '.cf7cw-chat-widget-greetings-wave .cf7cw-chat-widget-greetings-wave-title' ),
                    'declarations' => array( 'font-size' => intval($text_size[$chat_widget_cta_text_size]) . 'px' ),
                ) );
            }
        }

        // Wave Style 1 Greetings Message Text Size
        $wgs1msl_key = "wave_greetings_style_1_message_size";

        if(isset($cf7cw_options[$greetings_key][$wgs1msl_key])) {
            $wgs1mcs_key = "wave_greetings_style_1_message_custom_size";
            
            $text_size = array( 
                "small" => 12, 
                "medium" => 14, 
                "large" => 16, 
                "custom" => (isset($cf7cw_options[$greetings_key][$wgs1mcs_key]) && !empty($cf7cw_options[$greetings_key][$wgs1mcs_key])) ? $cf7cw_options[$greetings_key][$wgs1mcs_key] : $cf7cw_defaults[$greetings_key][$wgs1mcs_key] 
            );
            $chat_widget_cta_text_size = $cf7cw_options[$greetings_key][$wgs1msl_key];

            if(isset($text_size[$chat_widget_cta_text_size])) {
                connect_cf7_to_social_apps_library_Styles()->add( array(
                    'selectors'    => array( '.cf7cw-chat-widget-greetings-wave .cf7cw-chat-widget-greetings-wave-text' ),
                    'declarations' => array( 'font-size' => intval($text_size[$chat_widget_cta_text_size]) . 'px' ),
                ) );
            }
        }

        // Wave Style 1 Greetings CTA Style
        // CTA Text Color
        $wgs1ctc_key = "wave_greetings_style_1_cta_text_color";
        
        if(isset($cf7cw_options[$greetings_key][$wgs1ctc_key])) {
            $wgs1ctc_btn_txtcolor = cf7cw_sanitize_hex_color( $cf7cw_options[$greetings_key][$wgs1ctc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-wave-cta' ),
                'declarations' => array( 'color' => $wgs1ctc_btn_txtcolor ),
            ) );
        }

        // CTA Background Color
        $wgs1cbg_key = "wave_greetings_style_1_cta_background";

        if(isset($cf7cw_options[$greetings_key][$wgs1cbg_key])) {
            $wgs1cbg_bg_color = cf7cw_sanitize_hex_color( $cf7cw_options[$greetings_key][$wgs1cbg_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-wave-cta' ),
                'declarations' => array( 'background' => $wgs1cbg_bg_color ),
            ) );
        }

        /** Simple Greeting Template Colors */

        // Text Color
        $wgs1hc_key = "wave_greetings_style_1_heading_color";
        
        if(isset($cf7cw_options[$greetings_key][$wgs1hc_key])) {
            $wgs1hc_btn_txtcolor = cf7cw_sanitize_hex_color( $cf7cw_options[$greetings_key][$wgs1hc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-wave .cf7cw-chat-widget-greetings-wave-title' ),
                'declarations' => array( 'color' => $wgs1hc_btn_txtcolor ),
            ) );
        }

        // Message Color
        $wgs1mc_key = "wave_greetings_style_1_message_color";

        if(isset($cf7cw_options[$greetings_key][$wgs1mc_key])) {
            $wgs1mc_btn_txtcolor = cf7cw_sanitize_hex_color( $cf7cw_options[$greetings_key][$wgs1mc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-wave .cf7cw-chat-widget-greetings-wave-text' ),
                'declarations' => array( 'color' => $wgs1mc_btn_txtcolor ),
            ) );
        }

        // Background Color
        $wgs1bgc_key = "wave_greetings_style_1_background_color";

        if(isset($cf7cw_options[$greetings_key][$wgs1bgc_key])) {
            $wgs1bgc_bg_color = cf7cw_sanitize_hex_color( $cf7cw_options[$greetings_key][$wgs1bgc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-wave' ),
                'declarations' => array( 'background' => $wgs1bgc_bg_color ),
            ) );
        }

        // Font Family
        $wgs1ff_key = "wave_greetings_style_1_font_family";

        if(isset($cf7cw_options[$greetings_key][$wgs1ff_key])) {
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-wave' ),
                'declarations' => array( 'font-family' => $cf7cw_options[$greetings_key][$wgs1ff_key] ),
            ) );
        }

        // Wave Style 2 Greetings CTA Heading Text Size
        $wgs2hs_key = "wave_greetings_style_2_heading_size";

        if(isset($cf7cw_options[$greetings_key][$wgs2hs_key])) {
            $wgs2chs_key = "wave_greetings_style_2_custom_heading_size";
            
            $text_size = array( 
                "small" => 12, 
                "medium" => 14, 
                "large" => 16, 
                "custom" => (isset($cf7cw_options[$greetings_key][$wgs2chs_key]) && !empty($cf7cw_options[$greetings_key][$wgs2chs_key])) ? $cf7cw_options[$greetings_key][$wgs2chs_key] : $cf7cw_defaults[$greetings_key][$wgs2chs_key] 
            );
            $chat_widget_cta_text_size = $cf7cw_options[$greetings_key][$wgs2hs_key];

            if(isset($text_size[$chat_widget_cta_text_size])) {
                connect_cf7_to_social_apps_library_Styles()->add( array(
                    'selectors'    => array( '.cf7cw-chat-widget-greetings-wave-2 .cf7cw-chat-widget-greetings-wave-title' ),
                    'declarations' => array( 'font-size' => intval($text_size[$chat_widget_cta_text_size]) . 'px' ),
                ) );
            }
        }

        // Wave Style 2 Greetings CTA Message Text Size
        $wgs2ms_key = "wave_greetings_style_2_message_size";

        if(isset($cf7cw_options[$greetings_key][$wgs2ms_key])) {
            $wgs2mcs_key = "wave_greetings_style_2_message_custom_size";
            
            $text_size = array( 
                "small" => 12, 
                "medium" => 14, 
                "large" => 16, 
                "custom" => (isset($cf7cw_options[$greetings_key][$wgs2mcs_key]) && !empty($cf7cw_options[$greetings_key][$wgs2mcs_key])) ? $cf7cw_options[$greetings_key][$wgs2mcs_key] : $cf7cw_defaults[$greetings_key][$wgs2mcs_key] 
            );
            $chat_widget_cta_text_size = $cf7cw_options[$greetings_key][$wgs2ms_key];

            if(isset($text_size[$chat_widget_cta_text_size])) {
                connect_cf7_to_social_apps_library_Styles()->add( array(
                    'selectors'    => array( '.cf7cw-chat-widget-greetings-wave-2 .cf7cw-chat-widget-greetings-wave-text' ),
                    'declarations' => array( 'font-size' => intval($text_size[$chat_widget_cta_text_size]) . 'px' ),
                ) );
            }
        }

        /** Wave Style 2 Greeting Template Colors */

        // Text Color
        $wgs2hc_key = "wave_greetings_style_2_heading_color";
        
        if(isset($cf7cw_options[$greetings_key][$wgs2hc_key])) {
            $wgs2hc_btn_txtcolor = cf7cw_sanitize_hex_color( $cf7cw_options[$greetings_key][$wgs2hc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-wave-2 .cf7cw-chat-widget-greetings-wave-title' ),
                'declarations' => array( 'color' => $wgs2hc_btn_txtcolor ),
            ) );
        }

        // Message Color
        $wgs2mc_key = "wave_greetings_style_2_message_color";

        if(isset($cf7cw_options[$greetings_key][$wgs2mc_key])) {
            $wgs2mc_btn_txtcolor = cf7cw_sanitize_hex_color( $cf7cw_options[$greetings_key][$wgs2mc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-wave-2 .cf7cw-chat-widget-greetings-wave-text' ),
                'declarations' => array( 'color' => $wgs2mc_btn_txtcolor ),
            ) );
        }

        // Background Color
        $wgs2bgc_key = "wave_greetings_style_2_background_color";

        if(isset($cf7cw_options[$greetings_key][$wgs2bgc_key])) {
            $wgs2bgc_bg_color = cf7cw_sanitize_hex_color( $cf7cw_options[$greetings_key][$wgs2bgc_key] );
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-wave-2' ),
                'declarations' => array( 'background' => $wgs2bgc_bg_color ),
            ) );
        }

        // Font Family
        $wgs2ff_key = "wave_greetings_style_1_font_family";

        if(isset($cf7cw_options[$greetings_key][$wgs2ff_key])) {
            connect_cf7_to_social_apps_library_Styles()->add( array(
                'selectors'    => array( '.cf7cw-chat-widget-greetings-wave-2' ),
                'declarations' => array( 'font-family' => $cf7cw_options[$greetings_key][$wgs2ff_key] ),
            ) );
        }
    }

}
add_action( 'customizer_library_styles', 'connect_cf7_to_social_apps_style_build' );
if ( !function_exists( 'woocustomizer_customizer_library_styles' ) ) {
    /**
     * Generates the style tag and CSS needed for the theme options.
     *
     * By using the "connect_cf7_to_social_apps_library_Styles" filter, different components can print CSS in the header.
     * It is organized this way to ensure there is only one "style" tag.
     *
     * @since  1.0.0.
     *
     * @return void
     */
    function woocustomizer_customizer_library_styles()
    {
        do_action( 'customizer_library_styles' );
        // Echo the rules
        $css = connect_cf7_to_social_apps_library_Styles()->build();
        
        if ( !empty($css) ) {
            wp_register_style( 'cf7cw-customizer-custom-css', false, array('cf7cw_style') );
            wp_enqueue_style( 'cf7cw-customizer-custom-css' );
            wp_add_inline_style( 'cf7cw-customizer-custom-css', $css );
        }
    
    }

}
add_action( 'wp_enqueue_scripts', 'woocustomizer_customizer_library_styles', 11 );

function cf7cw_getContrastColor( $hexColor )
{
    // hexColor RGB
    $R1 = hexdec( substr( $hexColor, 1, 2 ) );
    $G1 = hexdec( substr( $hexColor, 3, 2 ) );
    $B1 = hexdec( substr( $hexColor, 5, 2 ) );
    // Black RGB
    $blackColor = "#000000";
    $R2BlackColor = hexdec( substr( $blackColor, 1, 2 ) );
    $G2BlackColor = hexdec( substr( $blackColor, 3, 2 ) );
    $B2BlackColor = hexdec( substr( $blackColor, 5, 2 ) );
    // Calc contrast ratio
    $L1 = 0.2126 * pow( $R1 / 255, 2.2 ) + 0.7151999999999999 * pow( $G1 / 255, 2.2 ) + 0.0722 * pow( $B1 / 255, 2.2 );
    $L2 = 0.2126 * pow( $R2BlackColor / 255, 2.2 ) + 0.7151999999999999 * pow( $G2BlackColor / 255, 2.2 ) + 0.0722 * pow( $B2BlackColor / 255, 2.2 );
    $contrastRatio = 0;
    
    if ( $L1 > $L2 ) {
        $contrastRatio = (int) (($L1 + 0.05) / ($L2 + 0.05));
    } else {
        $contrastRatio = (int) (($L2 + 0.05) / ($L1 + 0.05));
    }
    
    // If contrast is more than 5, return black color
    
    if ( $contrastRatio > 5 ) {
        return '#000000';
    } else {
        // if not, return white color.
        return '#FFFFFF';
    }

}

function cf7cw_sanitize_hex_color( $color ) {
	if ( '' === $color ) {
		return '';
	}

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}

	return null;
}