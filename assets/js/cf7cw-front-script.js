jQuery(document).ready(function() {
    var options = cf7cwObj;

    document.addEventListener('wpcf7mailsent', function (event) {
        
        var cf7cw_json = getCookie("cf7cw_options");
        var cf7cw_opt = JSON.parse(cf7cw_json);
        if (cf7cw_opt != '') {
            if (jQuery(window).width() > 991) {
                if (cf7cw_opt.cf7cw_new_tab == "on") {
                    window.open(cf7cw_opt.cf7cw_wh_url, '_blank');
                } else {
                    window.open(cf7cw_opt.cf7cw_wh_url, '_self');
                }
            }else{
                window.open(cf7cw_opt.cf7cw_wh_url, '_self');
            }
        }
        if(options.form_close_on_submit == "on") {
            if(jQuery('body').find('.cf7cw-chat-widgets').find('.cf7cw-chat-widget-begin').is(":visible")) {
                jQuery('body').find('.cf7cw-chat-widgets .cf7cw-chat-widget-close-btn').trigger('click');
            }
        }
        eraseCookie("cf7cw_options");
    }, false);

    jQuery('body').on('click','.cf7cw-chat-widget-greetings-simple, .cf7cw-chat-widget-handle-btn, .cf7cw-chat-widget-greeting-box', function() {

        if(!jQuery(this).hasClass('cf7cw-chat-widget-handle-btn') && options.on_click_greetings_action == "redirected_to_whatsapp_directly") {
            if(options.on_click_greetings_action == "redirected_to_whatsapp_directly") {
                window.open(options.redirect_wh_url, '_blank');
            }
        }else{            
            if(jQuery(this).hasClass('cf7cw-chat-widget-handle-btn') && jQuery(this).parents('.cf7cw-chat-widgets').find('.cf7cw-chat-widget-begin').is(":visible")) {
                
                jQuery(this).parents('.cf7cw-chat-widgets').find('.cf7cw-chat-widget-close-btn').trigger('click');
            }else{
                
                
                if(jQuery(this).parents('.cf7cw-chat-widgets').find('.cf7cw-chat-widget-greetings-simple').is(":visible")) {
                    jQuery(this).parents('.cf7cw-chat-widgets').find('.cf7cw-chat-widget-greetings-simple').hide();
                }
    
                if(jQuery(this).parents('.cf7cw-chat-widgets').find('.cf7cw-chat-widget-greetings-wave').is(":visible")) {
                    jQuery(this).parents('.cf7cw-chat-widgets').find('.cf7cw-chat-widget-greetings-wave').hide();
                }
    
                jQuery(this).parents('.cf7cw-chat-widgets').find('.cf7cw-chat-widget-begin').css("display","flex");
                
            }
        }
    });

    jQuery('body').on('click', '.cf7cw-chat-widget-greetings-close-btn', function(){
        jQuery(this).parents('.cf7cw-chat-widget-greetings').remove();
    });
    
    jQuery('body').on('click','.cf7cw-chat-widget-close-btn', function() {
        jQuery(this).parents('.cf7cw-chat-widget-begin').hide();
        jQuery(this).parents('.cf7cw-chat-widgets').find('.cf7cw-chat-widget-greeting-box').css("display","flex");
    });
});

jQuery(window).on('load', function() {
    var options = cf7cwObj;

    if(options.time_delay_status == "on") {
        if(options.triggers_form_after_second != "") {
            if(!jQuery('.cf7cw-chat-widgets').is('visible')) {
                setTimeout(() => {
                    jQuery('.cf7cw-chat-widgets').show();
                }, parseInt(options.triggers_form_after_second * 1000));
            }
        }
    }
});

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function eraseCookie(name) {
    setCookie(name, "", -1);
}