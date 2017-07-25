jQuery(document).ready(function () {

	/* If there are required actions, add an icon with the number of required actions in the About regina page -> Actions required tab */
	var regina_nr_actions_required = reginaWelcomeScreenObject.nr_actions_required;

	if ( (typeof regina_nr_actions_required !== 'undefined') && (regina_nr_actions_required != '0') ) {
		jQuery('li.regina-w-red-tab a').append('<span class="regina-actions-count">' + regina_nr_actions_required + '</span>');
	}

	/* Dismiss required actions */
	jQuery(".regina-required-action-button").click(function () {

		var id = jQuery(this).attr('id'),
				action = jQuery(this).attr('data-action');
		jQuery.ajax({
			type      : "GET",
			data      : { action: 'regina_dismiss_required_action', id: id, todo: action },
			dataType  : "html",
			url       : reginaWelcomeScreenObject.ajaxurl,
			beforeSend: function (data, settings) {
				jQuery('.regina-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + reginaWelcomeScreenObject.template_directory + '/inc/libraries/welcome-screen/assets/img/ajax-loader.gif" /></div>');
			},
			success   : function (data) {
				location.reload();
				jQuery("#temp_load").remove();
				/* Remove loading gif */
			},
			error     : function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			}
		});
	});

	/* Dismiss recommended plugins */
    jQuery(".regina-recommended-plugin-button").click(function () {

        var id = jQuery(this).attr('id'),
            action = jQuery(this).attr('data-action');
        jQuery.ajax({
            type      : "GET",
            data      : { action: 'regina_dismiss_recommended_plugins', id: id, todo: action },
            dataType  : "html",
            url       : reginaWelcomeScreenObject.ajaxurl,
            beforeSend: function (data, settings) {
                jQuery('.regina-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + reginaWelcomeScreenObject.template_directory + '/inc/admin/welcome-screen/img/ajax-loader.gif" /></div>');
            },
            success   : function (data) {
                location.reload();
                jQuery("#temp_load").remove();
                /* Remove loading gif */
            },
            error     : function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });
	
});
