<?php

	/*
		Plugin Name: Easy Google Analytics Tracking
		Plugin URI:  www.selfdesigns.co.uk
		Description: Add google analytics script without theme modification
		License:     GPL
		Version:     1.2.2
		Author:      Lewis Self
		Author URI:  www.selfdesigns.co.uk
	*/

	if(!defined('ABSPATH'))
	{
		exit;
	}

	/**
	 * Create an array for all options used by the plugin
	 */
	function egat_settings()
	{
		$options = array('google_analytics_tracking_id',
										 'google_analytics_enabled',
										 'google_analytics_placement',
										 'google_site_verification_enabled',
										 'google_site_verification_id'
									);

		return $options;
	}

	if(get_option('google_analytics_enabled') && get_option('google_analytics_tracking_id'))
	{
		/**
		 * Add Google Analytics code to theme header or footer depending on the option
		 */
		function egat_add_google_analytics_script()
		{
			?>

			<script>
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				ga('create', '<?php echo esc_attr(get_option('google_analytics_tracking_id')); ?>', 'auto');
				ga('send', 'pageview');
			</script>

			<?php
		}

		// If footer option is ticked force script to footer. If it is not, place it in the header
		if(get_option('google_analytics_placement') == '2')
		{
			add_action('wp_footer', 'egat_add_google_analytics_script');
		}
		else
		{
			add_action('wp_head', 'egat_add_google_analytics_script');
		}
	}

	/**
	 * Adds Google Site Verification to website if enabled
	 */
	function egat_add_google_site_verification()
	{
		if(get_option('google_site_verification_enabled') && get_option('google_site_verification_id'))
		{
			?>

				<meta name="google-site-verification" content="<?php echo esc_attr(get_option('google_site_verification_id')); ?>" />

			<?php
		}
	}
	add_action('wp_head', 'egat_add_google_site_verification');

	if(is_admin())
	{
		/**
		 * Creates settings link for plugin page
		 */
		function egat_add_setting_link($links)
		{
			$mylinks = array('<a href="' . admin_url('options-general.php?page=easy-google-analytics-tracking') . '">Settings</a>');

			return array_merge($links, $mylinks);
		}
		add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'egat_add_setting_link');

		/**
		 * Register plugin settings
		 */
		function egat_register_plugin_settings()
		{
			foreach(egat_settings() as $egat_setting)
			{
				register_setting('google-analytics-script-settings', $egat_setting);
			}
		}
		add_action('admin_init', 'egat_register_plugin_settings');

		/**
		 * Creates settings page, only admins can access this page
		 */
		function egat_google_analytics_script_menu()
		{
			add_options_page('Google Analytics', 'Google Analytics', 'administrator', 'easy-google-analytics-tracking', 'egat_settings_page');
		}
		add_action('admin_menu', 'egat_google_analytics_script_menu');

		if(isset($_GET['page']))
		{
			// Check if on admin page
			if($_GET['page'] == 'easy-google-analytics-tracking')
			{
				/**
				 * Add CSS files
				 */
				function egat_enqueue_css()
				{
					wp_enqueue_style('egat-admin-css', plugins_url('assets/css/admin.css', __FILE__));
				}
				add_action('admin_print_styles', 'egat_enqueue_css');

				/**
				 * Add JS files
				 */
				function egat_enqueue_js()
				{
					wp_enqueue_script('egat-admin-js', plugins_url('assets/js/admin.js', __FILE__), array('jquery'));
				}
				add_action('admin_enqueue_scripts', 'egat_enqueue_js');
			}
		}

		/**
		 * HTML output for the settings page
		 */
		function egat_settings_page()
		{
			?>

			<div class="wrap" id="main-content">
				<h2>Google Analytics Script</h2>
				<form method="post" action="options.php">
					<?php settings_fields('google-analytics-script-settings'); ?>
					<?php do_settings_sections('google-analytics-script-settings'); ?>
					<div>
						<p>Use your tracking Id and site verification code to enable google analytics to track traffic on your site.</p>
					</div>
					<label class="checkbox-options setting">
						<span class="title">Enable Google Analytics:</span>
						<input id="google_analytics_enabled" type="checkbox" name="google_analytics_enabled" value="1" <?php checked(1, get_option('google_analytics_enabled'), true); ?> />
					</label>
					<div id="google_analytics_enabled_content">
						<label class="google-ids setting">
							<span class="title text-field-titles">Google Analytics Tracking ID:</span>
							<input id="google_analytics_tracking_id" name="google_analytics_tracking_id" value="<?php echo esc_attr(get_option('google_analytics_tracking_id')); ?>" />
						</label>
						<div class="script-placement setting last-item">
							<span class="title">JavaScript placement:</span>
							<div class="radio-button-options">
								<label class="script-placement-head">
									<input type="radio" name="google_analytics_placement" value="1" <?php checked(1, get_option('google_analytics_placement'), true); ?> />
									<b>Header</b>
								</label>
								<label class="script-placement-foot">
									<input type="radio" name="google_analytics_placement" value="2" <?php checked(2, get_option('google_analytics_placement'), true); ?> />
									<b>Footer</b>
								</label>
							</div>
						</div>
					</div>
					<label class="checkbox-options setting">
						<span class="title">Enable Google Site Verification:</span>
						<input id="google_site_verification_enabled" type="checkbox" name="google_site_verification_enabled" value="1" <?php checked(1, get_option('google_site_verification_enabled'), true); ?> />
					</label>
					<div id="google_site_verification_enabled_content">
						<label class="google-ids setting last-item">
							<span class="title text-field-titles">Google Site Verification Code:</span>
							<input id="google_analytics_verification_id" name="google_site_verification_id" value="<?php echo esc_attr(get_option('google_site_verification_id')); ?>" />
						</label>
					</div>
					<?php submit_button(); ?>
				</form>
			</div>

			<?php
		}

		/**
		 * Clean database, clean mind.
		 */
		function egat_uninstall()
		{
			foreach(egat_settings() as $egat_setting)
			{
				delete_option($egat_setting);
			}
		}
		register_uninstall_hook(__FILE__, 'egat_uninstall');
	}

?>
