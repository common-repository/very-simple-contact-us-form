<?php
/**
 * Fired during plugin activation
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Very_Simple_Contact_Us_Form
 * @subpackage Very_Simple_Contact_Us_Form/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Very_Simple_Contact_Us_Form
 * @subpackage Very_Simple_Contact_Us_Form/includes
 * @author     Akshat Saxena <saxena.akshat.akshat@gmail.com>
 */
class Very_Simple_Contact_Us_Form_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'contact_us_form_entries';
		$charset_collate = $wpdb->get_charset_collate();
		
		$sql ="CREATE TABLE `$table_name` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(25) NOT NULL,
			`email` varchar(25) NOT NULL,
			`message` tinytext NOT NULL,
			PRIMARY KEY (`id`) 
		)$charset_collate";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

}
