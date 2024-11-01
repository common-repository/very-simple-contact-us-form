<?php
/**
 * The file that defines the shortcode plugin class
 *
 * @link       #
 * @since      1.0.0
 * @package    Very_Simple_Contact_Us_Form
 * @subpackage Very_Simple_Contact_Us_Form/includes
 */

/**
 * The Shortcode plugin class.
 *
 * @since      1.0.0
 * @package    Very_Simple_Contact_Us_Form
 * @subpackage Very_Simple_Contact_Us_Form/includes
 * @author     Akshat Saxena <saxena.akshat.akshat@gmail.com>
 */
class Very_Simple_Contact_Us_Form_Shortcode {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Very_Simple_Contact_Us_Form_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'VERY_SIMPLE_CONTACT_US_FORM_VERSION' ) ) {
			$this->version = VERY_SIMPLE_CONTACT_US_FORM_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'very-simple-contact-us-form';

	}
	/**
	 * Function to create content for displaying in the shortcode
	 */
	public function showform() {
		ob_start();
		include CONTACT_US_FORM_PATH . 'public/partials/very-simple-contact-us-form-public-display.php';
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/very-simple-contact-us-form-public.css', array(), $this->version, 'all' );
		wp_enqueue_script( 'jquery-validate', plugin_dir_url( __FILE__ ) . 'js/jquery-validation.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'very-simple-contact-us-form-public.js', plugin_dir_url( __FILE__ ) . 'js/very-simple-contact-us-form-public.js', array( 'jquery' ), $this->version, false );
		return ob_get_clean();
	}

}
