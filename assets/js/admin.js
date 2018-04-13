jQuery(document).ready(function($) {

		if($("#google_analytics_enabled").is(":checked")) {
			$("#google_analytics_enabled_content").show();
		} else {
			$("#google_analytics_enabled_content").hide();
		}

		if($("#google_site_verification_enabled").is(":checked")) {
			$("#google_site_verification_enabled_content").show();
		} else {
			$("#google_site_verification_enabled_content").hide();
		}

		$("#google_analytics_enabled").click(function() {
				$("#google_analytics_enabled_content").toggle();
		});

		$("#google_site_verification_enabled").click(function() {
				$("#google_site_verification_enabled_content").toggle();
		});
});
