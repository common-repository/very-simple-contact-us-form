<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Very_Simple_Contact_Us_Form
 * @subpackage Very_Simple_Contact_Us_Form/admin/partials
 */

check_ajax_referer( 'my-nonce', 'nonce' );
if ( isset( $_POST['id'] ) && ( ! empty( $_POST['id'] ) ) ) {
	$uid = sanitize_text_field( wp_unslash( $_POST['id'] ) );
}
global $wpdb;
$row = $wpdb->delete( 'wp_contact_us_form_entries', array( 'id' => $uid ) );
if ( $wpdb->last_error ) {
	echo 'Error: ' . esc_html( $wpdb->last_error );
}

