<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Very_Simple_Contact_Us_Form
 * @subpackage Very_Simple_Contact_Us_Form/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Very_Simple_Contact_Us_Form
 * @subpackage Very_Simple_Contact_Us_Form/public
 * @author     Akshat Saxena <saxena.akshat.akshat@gmail.com>
 */
class Very_Simple_Contact_Us_Form_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string   $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * Registering the css to only load when shortcode is loaded
		*/
		wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/very-simple-contact-us-form-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 *  Used to enqueue scripts
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_script( 'jquery-validate', plugin_dir_url( __FILE__ ) . 'js/jquery-validation.min.js', array( 'jquery' ), $this->version, false );
		wp_register_script( 'very-simple-contact-us-form-public.js', plugin_dir_url( __FILE__ ) . 'js/very-simple-contact-us-form-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script(
			'very-simple-contact-us-form-public.js',
			'plugin_data',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'my-nonce' ),
			),
		);

	}

}
