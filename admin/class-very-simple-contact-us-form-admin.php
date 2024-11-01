<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Very_Simple_Contact_Us_Form
 * @subpackage Very_Simple_Contact_Us_Form/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Very_Simple_Contact_Us_Form
 * @subpackage Very_Simple_Contact_Us_Form/admin
 * @author     Akshat Saxena <saxena.akshat.akshat@gmail.com>
 */
class Very_Simple_Contact_Us_Form_Admin {

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
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		add_action( 'wp_ajax_simple_contact_us_form_process', array( $this, 'simple_contact_us_form_process' ) );
		add_action( 'wp_ajax_nopriv_simple_contact_us_form_process', array( $this, 'simple_contact_us_form_process' ) );
		add_action( 'wp_ajax_simple_contact_us_form_edit', array( $this, 'simple_contact_us_form_edit' ) );
		add_action( 'wp_ajax_simple_contact_us_form_delete', array( $this, 'simple_contact_us_form_delete' ) );
		add_action( 'wp_ajax_simple_contact_us_form_update', array( $this, 'simple_contact_us_form_update' ) );
		add_action( 'wp_ajax_simple_contact_us_form_sendcsv', array( $this, 'simple_contact_us_form_sendcsv' ) );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/very-simple-contact-us-form-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/very-simple-contact-us-form-admin.js', array( 'jquery' ), $this->version, true );
		wp_localize_script(
			$this->plugin_name,
			'plugin_data_admin',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'my-nonce' ),
			),
		);
		wp_enqueue_script( 'sweet-alert', plugin_dir_url( __FILE__ ) . 'js/sweet-alert.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'jquery-validation', plugin_dir_url( __FILE__ ) . 'js/jquery-validation.min.js', array( 'jquery' ), $this->version, true );
	}
	/**
	 * Add Admin Page to Admin Menu
	 *
	 * @since    1.0.0
	 */
	public function add_admin_menu() {

		/**
		 * This function is used to add menu page
		 */

		add_menu_page(
			__( 'Contact Form Entries', 'very-simple-contact-us-form' ),
			__( 'Contact Form Entries', 'very-simple-contact-us-form' ),
			'manage_options',
			'contact-form-entries',
			array( $this, 'showlist' ),
			'dashicons-buddicons-pm',
			3
		);
	}
	/**
	 * This function is used to process the data fron the form
	 */
	public function simple_contact_us_form_process() {

		check_ajax_referer( 'my-nonce', 'nonce' );
		if ( isset( $_POST['name'] ) && ( ! empty( $_POST['name'] ) ) ) {
			$name = sanitize_text_field( wp_unslash( $_POST['name'] ) );
		}
		if ( isset( $_POST['email'] ) && ( ! empty( $_POST['email'] ) ) ) {
			$email = sanitize_email( wp_unslash( $_POST['email'] ) );
		}
		if ( isset( $_POST['subject'] ) && ( ! empty( $_POST['subject'] ) ) ) {
			$message = sanitize_textarea_field( wp_unslash( $_POST['subject'] ) );
		}
		global $wpdb;
		$wpdb->insert(
			'wp_contact_us_form_entries',
			array(
				'name'    => $name,
				'email'   => $email,
				'message' => $message,
			),
		);

		$headers      = 'From: ' . $name . '.' . $email . ' <test@test.com>' . "\r\n";
		$sent_message = wp_mail(
			get_option( 'admin_email' ),
			'Contact Us From Response',
			$message,
			$headers,
			'',
		);
		wp_send_json_success();
		wp_die();
	}


	/**
	 * This function is used to display the list of the data
	 */
	public function showlist() {

		include 'partials/very-simple-contact-us-form-admin-display.php';

	}
	/**
	 * This function is used to edit the data
	 */
	public function simple_contact_us_form_edit() {
		check_ajax_referer( 'my-nonce', 'nonce' );
		ob_start();
		include 'partials/very-simple-contact-us-form-admin-edit.php';
		wp_send_json_success( ob_get_clean() );
		wp_die();

	}
	/**
	 * This function is used to delete the data
	 */
	public function simple_contact_us_form_delete() {
		check_ajax_referer( 'my-nonce', 'nonce' );
		ob_start();
		include 'partials/very-simple-contact-us-form-admin-delete.php';
		wp_send_json_success( ob_get_clean() );
		wp_die();
	}
	/**
	 * This function is used to update the data
	 */
	public function simple_contact_us_form_update() {
		check_ajax_referer( 'my-nonce', 'nonce' );
		if ( isset( $_POST['name'] ) && ( ! empty( $_POST['name'] ) ) ) {
			$name = sanitize_text_field( wp_unslash( $_POST['name'] ) );
		}
		if ( isset( $_POST['email'] ) && ( ! empty( $_POST['email'] ) ) ) {
			$email = sanitize_email( wp_unslash( $_POST['email'] ) );
		}
		if ( isset( $_POST['subject'] ) && ( ! empty( $_POST['subject'] ) ) ) {
			$message = sanitize_textarea_field( wp_unslash( $_POST['subject'] ) );
		}
		if ( isset( $_POST['id'] ) && ( ! empty( $_POST['id'] ) ) ) {
			$uid = sanitize_textarea_field( wp_unslash( $_POST['id'] ) );
		}

		global $wpdb;
		$wpdb->update(
			'wp_contact_us_form_entries',
			array(
				'name'    => $name,
				'email'   => $email,
				'message' => $message,
			),
			array( 'id' => $uid ),
		);
		wp_send_json_success();
		wp_die();

	}
		/**
		 * This function is used to generate csv
		 */
	public function simple_contact_us_form_sendcsv() {
		if ( ! current_user_can( 'manage_options' ) ) {

			return false;
		}
		if ( ! is_admin() ) {
			return false;
		}
		$nonce = isset( $_GET['_wpnonce'] ) ? $_GET['_wpnonce'] : '';
		if ( ! wp_verify_nonce( $nonce, 'download_csv' ) ) {
			wp_die( 'Security check error' );
		}
		ob_start();
		$filename   = 'contact-us-form-details-'. time() . '.csv';
		$header_row = array(
			'Name',
			'Email',
			'Message',
		);
		$data_rows  = array();
		global $wpdb;
		$rows  = 'SELECT * FROM wp_contact_us_form_entries';
		$users = $wpdb->get_results( $rows, 'ARRAY_A' );
		foreach ( $users as $user ) {
			$row         = array(
				$user['name'],
				$user['email'],
				$user['message'],
			);
			$data_rows[] = $row;
		}
		ob_end_clean();
		$fh = @fopen( 'php://output', 'w' ); 
		fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );
		header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
		header( 'Content-Description: File Transfer' );
		header( 'Content-type: text/csv' );
		header( "Content-Disposition: attachment; filename={$filename}" );
		header( 'Expires: 0' );
		header( 'Pragma: public' );
		fputcsv( $fh, $header_row );
		foreach ( $data_rows as $data_row ) {
			fputcsv( $fh, $data_row );
		}
		fclose( $fh ); 
		ob_end_flush();
		die();
	}

}
