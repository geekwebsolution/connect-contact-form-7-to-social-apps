jQuery(document).ready(function() {
    /**
     * Whatsapp number field flag and country code JS
     */
    const countryCodeInput = document.querySelector("#country_code_input");
    const countryNameInput = document.querySelector("#country_name_input");
    
    const cf7cw_wh_number  = document.querySelector("#cf7cw_wh_number");

    const itiConfig = {
        utilsScript: cf7cwObj.telinput_util,
    };

    if (countryNameInput.value) {
        itiConfig.initialCountry = countryNameInput.value;
    } else {
        itiConfig.initialCountry = "auto";
        itiConfig.geoIpLookup = callback => {
            fetch("https://ipapi.co/json")
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("us"));
        };
    }

    const iti = window.intlTelInput(cf7cw_wh_number, itiConfig);

    cf7cw_wh_number.addEventListener('countrychange', () => {
        const selectedCountryData = iti.getSelectedCountryData();
        
        const countryCode = selectedCountryData.dialCode;
        const countryName = selectedCountryData.iso2;

        // Assuming you have an input to store the country code
        countryCodeInput.value = countryCode; 
        countryNameInput.value = countryName;
    });
});

jQuery(window).on('load', function () {
    if (jQuery("#connect-whatsapp").find(".cf7cw-input-error").length != 0) {
        jQuery("#connect-whatsapp-tab").addClass("cf7cw-config");
    }

    /**
     * Add color picker to fields
     */
    jQuery('.cf7cw_colorpicker').wpColorPicker();
    
    const elem = jQuery('input[type="range"]');
    elem.on('input', function() {
        const newValue = jQuery(this).val();
        const target = jQuery(this).parent().find('.cf7cw-range-px');
        target.html(newValue + 'px');
    });

    /**
     * Multi step admin JS
     */
    function updateURLHash(step) {
        window.location.hash = 'step=' + step;
    }

    function getStepFromHash() {
        const hash = window.location.hash.substring(1); // Remove the '#'
        const params = new URLSearchParams(hash);
        return params.get('step') || '1'; // Default to step 1 if no step is found
    }

    /** On whatsapp number change JS */
    jQuery('#cf7cw_wh_number').change(function() {
        var dInput = jQuery(this).val();
        if(dInput.length >= 7 && dInput != '') {
            jQuery(this).removeClass('cf7cw-input-error');
        }else{
            jQuery(this).addClass('cf7cw-input-error');
        }
    });

    /** Dependecies field JS Start */

    /**  Step 2: Customize Form JS  */

    // Icon Size Change JS
    jQuery('body').on('change','input[name=chat_widget_icon_size]',function(){
        const dep_group_cls = jQuery(this).filter(":checked").val();
        if (dep_group_cls == "custom") {
            jQuery(this).parents('.cf7cw-block-box').find('.chat_widget_icon_size_group').removeClass('cf7cw-hidden');
        }else{
            jQuery(this).parents('.cf7cw-block-box').find('.chat_widget_icon_size_group').addClass('cf7cw-hidden');
        }
    });

    // Enable Call to action Change JS
    jQuery('body').on('change','input[name=chat_widget_cta_switch]',function(){
        if (jQuery(this).is(":checked")) {
            jQuery(this).parents('.cf7cw-block-box').find('.chat_widget_cta_switch_group').removeClass('cf7cw-hidden');
            jQuery('input[name=chat_widget_cta_text_size]:checked').trigger("change");
        }else{
            jQuery(this).parents('.cf7cw-block-box').find('.chat_widget_cta_switch_group').addClass('cf7cw-hidden');
        }
    });

    // Call to action Text Size Change JS
    jQuery('input[name=chat_widget_cta_text_size]').change(function(){
        const dep_group_cls = jQuery(this).filter(":checked").val();
        if (dep_group_cls != "custom") {
            jQuery(this).parents('.cf7cw-block-box').find('.chat_widget_cta_text_size_group').addClass('cf7cw-hidden');
        }else{
            jQuery(this).parents('.cf7cw-block-box').find('.chat_widget_cta_text_size_group').removeClass('cf7cw-hidden');
        }
    });

    /**  Step 3: Greetings JS  */

    jQuery('input[name=display_greeting_popup]').change(function(){
        if (jQuery(this).is(":checked")) {
            jQuery(this).parents('.cf7cw-step-box').find('.display_greeting_popup_group').removeClass('cf7cw-hidden');
        }else{
            jQuery(this).parents('.cf7cw-step-box').find('.display_greeting_popup_group').addClass('cf7cw-hidden');
        }
    });

    jQuery('input[name=wave_greetings_style_1_show_greeting_cta]').change(function() {
        if (jQuery(this).is(":checked")) {
            jQuery(this).parents('.cf7cw-step-box').find('.wave_greetings_style_1_show_greeting_cta').removeClass('cf7cw-hidden');
        }else{
            jQuery(this).parents('.cf7cw-step-box').find('.wave_greetings_style_1_show_greeting_cta').addClass('cf7cw-hidden');
        }
    });

    jQuery('input[name=choose_greetings_template]').change(function(){
        const dep_group_cls = jQuery(this).filter(":checked").val();
        if (dep_group_cls == "wave") {
            jQuery(this).parents('.cf7cw-step-box').find('.display_greeting_popup_group.choose_greetings_template_wave_group').removeClass('cf7cw-hidden');
            jQuery(this).parents('.cf7cw-step-box').find('.display_greeting_popup_group.choose_greetings_template_simple_group').addClass('cf7cw-hidden');
            jQuery('input[name=choose_wave_greetings_template_type]:checked').trigger("change");
            jQuery('input[name=wave_greetings_show_main_content]:checked').trigger("change");
        }else{
            jQuery(this).parents('.cf7cw-step-box').find('.display_greeting_popup_group.choose_greetings_template_simple_group').removeClass('cf7cw-hidden');
            jQuery(this).parents('.cf7cw-step-box').find('.display_greeting_popup_group.choose_greetings_template_wave_group').addClass('cf7cw-hidden');
        }
    });

    jQuery('input[name=choose_wave_greetings_template_type]').change(function(){
        const dep_group_cls = jQuery(this).filter(":checked").val();
        if(dep_group_cls == "choose_wave_greetings_template_type_style_2") {
            jQuery(this).parents('.cf7cw-step-box').find('.choose_wave_greetings_template_type_style_2_group').removeClass('cf7cw-hidden');
            jQuery(this).parents('.cf7cw-step-box').find('.choose_wave_greetings_template_type_style_1_group').addClass('cf7cw-hidden');
        }else{
            jQuery(this).parents('.cf7cw-step-box').find('.choose_wave_greetings_template_type_style_1_group').removeClass('cf7cw-hidden');
            jQuery(this).parents('.cf7cw-step-box').find('.choose_wave_greetings_template_type_style_2_group').addClass('cf7cw-hidden');
        }
    });

    jQuery('input[name=wave_greetings_show_main_content]').change(function() {
        const wave_template_type = jQuery(this).parents('.cf7cw-step-box').find('input[name=choose_wave_greetings_template_type]:checked').val();
        if (jQuery(this).is(":checked")) {
            jQuery(this).parents('.cf7cw-step-box').find('.wave_greetings_show_main_content').removeClass('cf7cw-hidden');
            if(wave_template_type != "choose_wave_greetings_template_type_style_1") {
                jQuery(this).parents('.cf7cw-block-box').find('.choose_wave_greetings_template_type_style_1_group').addClass('cf7cw-hidden');
            }else{
                jQuery(this).parents('.cf7cw-block-box').find('.choose_wave_greetings_template_type_style_2_group').addClass('cf7cw-hidden');
            }
        }else{
            jQuery(this).parents('.cf7cw-step-box').find('.wave_greetings_show_main_content').addClass('cf7cw-hidden');
        }
    });

    jQuery('input[name=wave_greetings_style_2_show_greeting_cta]').change(function() {
        if (jQuery(this).is(":checked")) {
            jQuery(this).parents('.cf7cw-step-box').find('.wave_greetings_style_2_show_greeting_cta').removeClass('cf7cw-hidden');
        }else{
            jQuery(this).parents('.cf7cw-step-box').find('.wave_greetings_style_2_show_greeting_cta').addClass('cf7cw-hidden');
        }
    });

    jQuery('input[name=simple_greetings_heading_size]').change(function(){
        const dep_group_cls = jQuery(this).filter(":checked").val();
        if (dep_group_cls == "custom") {
            jQuery(this).parents('.cf7cw-block-box').find('.simple_greetings_heading_size_group').removeClass('cf7cw-hidden');
        }else{
            jQuery(this).parents('.cf7cw-block-box').find('.simple_greetings_heading_size_group').addClass('cf7cw-hidden');
        }
    });

    jQuery('body').on('change','input[name=simple_greetings_message_size]',function(){
        const dep_group_cls = jQuery(this).filter(":checked").val();
        if (dep_group_cls == "custom") {
            jQuery(this).parents('.cf7cw-block-box').find('.simple_greetings_message_size_group').removeClass('cf7cw-hidden');
        }else{
            jQuery(this).parents('.cf7cw-block-box').find('.simple_greetings_message_size_group').addClass('cf7cw-hidden');
        }
    });

    jQuery('body').on('change','input[name=wave_greetings_style_1_heading_size]',function(){
        const dep_group_cls = jQuery(this).filter(":checked").val();
        if (dep_group_cls == "custom") {
            jQuery(this).parents('.cf7cw-block-box').find('.wave_greetings_style_1_heading_size_group').removeClass('cf7cw-hidden');
        }else{
            jQuery(this).parents('.cf7cw-block-box').find('.wave_greetings_style_1_heading_size_group').addClass('cf7cw-hidden');
        }
    });

    jQuery('body').on('change','input[name=wave_greetings_style_1_message_size]',function(){
        const dep_group_cls = jQuery(this).filter(":checked").val();
        if (dep_group_cls == "custom") {
            jQuery(this).parents('.cf7cw-block-box').find('.wave_greetings_style_1_message_size_group').removeClass('cf7cw-hidden');
        }else{
            jQuery(this).parents('.cf7cw-block-box').find('.wave_greetings_style_1_message_size_group').addClass('cf7cw-hidden');
        }
    });

    jQuery('body').on('change','input[name=wave_greetings_style_2_heading_size]',function(){
        const dep_group_cls = jQuery(this).filter(":checked").val();
        if (dep_group_cls == "custom") {
            jQuery(this).parents('.cf7cw-block-box').find('.wave_greetings_style_2_heading_size_group').removeClass('cf7cw-hidden');
        }else{
            jQuery(this).parents('.cf7cw-block-box').find('.wave_greetings_style_2_heading_size_group').addClass('cf7cw-hidden');
        }
    });

    jQuery('body').on('change','input[name=wave_greetings_style_2_message_size]',function(){
        const dep_group_cls = jQuery(this).filter(":checked").val();
        if (dep_group_cls == "custom") {
            jQuery(this).parents('.cf7cw-block-box').find('.wave_greetings_style_2_message_size_group').removeClass('cf7cw-hidden');
        }else{
            jQuery(this).parents('.cf7cw-block-box').find('.wave_greetings_style_2_message_size_group').addClass('cf7cw-hidden');
        }
    });

    jQuery('body').on('change','input[name=triggers_time_delay]',function(){
        if (jQuery(this).is(":checked")) {
            jQuery(this).parents('.cf7cw-block-box').find('.triggers_time_delay_group').removeClass('cf7cw-hidden');
        }else{
            jQuery(this).parents('.cf7cw-block-box').find('.triggers_time_delay_group').addClass('cf7cw-hidden');
        }
    });

    // Triggers & Greeting JS
    jQuery('body').on('change','input[name=targeting_exclude_all_except_switch]',function(){
        if (jQuery(this).is(":checked")) {
            jQuery(this).parents(".cf7cw-block-box").find(".cf7cw-exclude-all-except").removeClass("cf7cw-form-pro-field");
            jQuery(this).parents(".cf7cw-block-box").find(".cf7cw-exclude-pages").addClass("cf7cw-form-pro-field");
        }else{
            jQuery(this).parents(".cf7cw-block-box").find(".cf7cw-exclude-pages").removeClass("cf7cw-form-pro-field");
            jQuery(this).parents(".cf7cw-block-box").find(".cf7cw-exclude-all-except").addClass("cf7cw-form-pro-field");
        }
    });

    /** Dependecies field JS End */

    function showStep(step) {
        jQuery('.cf7cw-step').hide();
        jQuery('.cf7cw-step[data-step="' + step + '"]').show();
        
        jQuery('.cf7cw-step-label').hide();
        jQuery('.cf7cw-step-label[data-step="' + step + '"]').show();

        updateURLHash(step); // Update URL hash when changing steps

        // Show or hide buttons based on the current step
        const totalSteps = jQuery('.cf7cw-step').last().data('step');
        if (step >= totalSteps) {
            jQuery('.cf7cw-next-btn').hide();
            jQuery('.cf7cw-submit-btn').show();
        } else {
            jQuery('.cf7cw-next-btn').show();
            jQuery('.cf7cw-submit-btn').hide();
        }

        jQuery('.cf7cw-nav-tab ul li').each(function() {
            const btnStep = jQuery(this).find('.cf7cw-nav-tab-btn').data('step');
            if (btnStep <= step) {
                jQuery(this).addClass('cf7cw-nav-tab-active');
            } else {
                jQuery(this).removeClass('cf7cw-nav-tab-active');
            }
        });
    }

    /** Validate fields in the active step */
    function validateStep(step) {
        let isValid = true;
        jQuery('.cf7cw-step[data-step="' + step + '"] input.cf7cw-required').each(function() {
            jQuery(this).removeClass('cf7cw-input-error');
            if(jQuery(this).is(':checkbox') && jQuery(this).prop('checked')==true) {
                isValid = false;
                jQuery(this).addClass('cf7cw-input-error');
            }else if(jQuery(this).is('input:text')) {
                if(jQuery(this).attr("name") == "wh_number") {
                    var dInput = jQuery(this).val();
                    
                    if(dInput.length >= 7 && dInput != '') {
                        jQuery(this).removeClass('cf7cw-input-error');
                    }else{
                        isValid = false;
                        jQuery(this).addClass('cf7cw-input-error');
                    }
                }else{
                    isValid = false;
                    jQuery(this).addClass('cf7cw-input-error');
                }
            }
        });
        return isValid;
    }

    // Initialize the step based on URL hash or default to step 1
    let currentStep = getStepFromHash();

    // Check if the step exists
    const totalSteps = jQuery('.cf7cw-step').last().data('step') || 1;
    currentStep = (currentStep > totalSteps || currentStep < 1) ? '1' : currentStep;
    

    showStep(currentStep);

    // Next Button Click
    jQuery('.cf7cw-next-btn').click(function () {
        if (validateStep(currentStep)) {
            if (currentStep < totalSteps) { // Adjust based on the total number of steps
                currentStep++;
                showStep(currentStep);
            }
        }else{
            // alert('Please fill out all required fields.');
        }
    });

    // Back Button Click
    jQuery('.cf7cw-prev-btn').click(function () {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    // Navigation Tabs Click
    jQuery('.cf7cw-nav-tab-btn').click(function () {
        const targetStep = jQuery(this).data('step');
        if (targetStep <= currentStep || validateStep(currentStep)) {
            currentStep = targetStep;
            showStep(currentStep);
        } else {
            // alert('Please fill out all required fields before proceeding.');
        }
    });

    /**
     * Select file from media library field JS
     */
    var cf7cw_file_frame;

    jQuery('.cf7cw-upload-button').on('click', function (e) {
        e.preventDefault();
        var $this = jQuery(this);

        // Create the media frame.
        cf7cw_file_frame = wp.media.frames.cf7cw_file_frame = wp.media({
            title: 'Select a file',
            button: {
                text: 'Use this file',
            },
            multiple: false // Set to true to allow multiple files to be selected
        });

        // When a file is selected, run a callback.
        cf7cw_file_frame.on('select', function () {
            var attachment = cf7cw_file_frame.state().get('selection').first().toJSON();
            $this.parents('.cf7cw-file-upload').find('#cf7cw_customize_icon_url').val(attachment.id);
            $this.parents('.cf7cw-file-upload').find('.cf7cw-file-preview').remove();
            $this.parents('.cf7cw-file-upload').find('.cf7cw-upload-button').after('<div class="cf7cw-file-preview"><img src="' + attachment.url + '"" /></div>');
        });

        // Finally, open the modal
        cf7cw_file_frame.open();
    });
});