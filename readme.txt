=== Easy Google Analytics Tracking ===

Contributors: Lewis Self
Donate Link: http://www.selfdesigns.co.uk
Tags: Google, Analytics, website data, tracking, simple, information
Requires at least: 4.0
Tested up to: 4.9
Stable tag: Trunk
License: GPLv2
Version: 1.2.2

== Description ==

This plugin works with Google Analytics. Simply enter your tracking ID in the specified field and check "enable Google Analytics". This will enter the script in the footer or the header of your website. This plugin also includes the option to add a Google Verification code.

== Installation ==

1. Extract "easy-google-analytics-tracking.zip"
2. Upload the "easy-google-analytics-tracking" Folder to the Plugin Directory
3. Activate the plugin through the WordPress admin "Plugins" menu
4. Edit the settings and enter the Google information

== Frequently Asked Questions ==

= I have activated the plugin, where do I find the settings? =

You can find the settings for the plugin either under the wp-admin settings drop down or as a link on the plugin in the WordPress admin "plugins" menu. Once you check the tickboxes you will see the input to let you enter the tracking Id.

= How can I check the plugin is outputting the Google Analytics Code? =

When on the front end of your website, right click and view source. Then press ctrl + F to search for "GoogleAnalyticsObject". If you can find this, then the code is being outputted to the website. You should be able to see your Analytics code in the "ga()" function.

= How can I check the plugin is outputting the Google Verification Tag? =
The process for this is the same as the Google Analytics code but instead of searching for the "GoogleAnalyticsObject" change this to "google-site-verification".

== Screenshots ==

1. The plugin settings page. Check the tick boxes to get the drop down and fill in the Google Analytics code. You can also use the Google Verification code if are using Google Webmaster Tools.
2. The code Google Analytics will give you should look like this, the red highlighted area is what you need to input for the Google Analytics Tracking ID field.
3. When using Google Webmaster Tools, you will need to verify your website. To do this, click on the Alternate Methods tab when adding a property. Choose the HTML tag and you should get a screen like this one. I have highlighted the red area that you need to input to the Google Site Verification Code field.

== Upgrade Notice ==

== Changelog ==

= 1.2.2
* Fixed script and styling files not loading correctly.
* Added comments to improve readability
* Code cleanup

= 1.2.1 =
* Bug fix with google verification checkbox on admin
* Added JavaScript to admin settings page
* Styled admin settings page
* Moved JavaScript and CSS into assets folder
* textfield & Checkbox bug fix

= 1.2.0 =
* Functionality to add tracking code to top or bottom of website source code
* Google site verification added
* Option to choose where google analytics code is outputted on website

= 1.1.0 =
* Changed admin settings from inline style to external Style Sheet
* Responsive admin settings

= 1.0.0 =
* Initial release
