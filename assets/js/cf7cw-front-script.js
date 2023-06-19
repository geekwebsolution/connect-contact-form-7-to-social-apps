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
    eraseCookie("cf7cw_options");
}, false);

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