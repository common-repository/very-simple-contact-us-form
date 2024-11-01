<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Very_Simple_Contact_Us_Form
 *
 * @wordpress-plugin
 * Plugin Name:       Very Simple Contact Us Form
 * Plugin URI:        #
 * Description:       This plugin displays a simple contact us form in the frontend with a shortcode <code>[contactus]</code>, You also get an database storing functionality along with the export feature
 * Version:           1.0.0
 * Author:            Akshat Saxena
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       very-simple-contact-us-form
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'VERY_SIMPLE_CONTACT_US_FORM_VERSION', '1.0.0' );

/**
 * Define the variable for storing the path, used for including the files
 */
define( 'CONTACT_US_FORM_PATH', plugin_dir_path( __FILE__ ) );
/**
 * Define the variable for storing the url of our plugin
 */
define( 'CONTACT_US_FORM_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-very-simple-contact-us-form-activator.php
 */
function activate_very_simple_contact_us_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-very-simple-contact-us-form-activator.php';
	Very_Simple_Contact_Us_Form_Activator::activate();
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-very-simple-contact-us-form-deactivator.php
 */
function deactivate_very_simple_contact_us_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-very-simple-contact-us-form-deactivator.php';
	Very_Simple_Contact_Us_Form_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_very_simple_contact_us_form' );
register_deactivation_hook( __FILE__, 'deactivate_very_simple_contact_us_form' );
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-very-simple-contact-us-form.php';
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_very_simple_contact_us_form() {

	$plugin = new Very_Simple_Contact_Us_Form();
	$plugin->run();

}
run_very_simple_contact_us_form();
