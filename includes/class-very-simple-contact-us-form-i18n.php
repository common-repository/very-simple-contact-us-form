<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Very_Simple_Contact_Us_Form
 * @subpackage Very_Simple_Contact_Us_Form/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Very_Simple_Contact_Us_Form
 * @subpackage Very_Simple_Contact_Us_Form/includes
 * @author     Akshat Saxena <saxena.akshat.akshat@gmail.com>
 */
class Very_Simple_Contact_Us_Form_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'very-simple-contact-us-form',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
