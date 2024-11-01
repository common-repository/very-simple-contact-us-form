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

?>
<div class="header-display" style="display: flex;align-items: center;flex-flow: wrap;justify-content:space-between;">
	<h2>Form Entries</h2>
</div>
<?php
check_ajax_referer( 'my-nonce', 'nonce' );
if ( isset( $_POST['id'] ) && ( ! empty( $_POST['id'] ) ) ) {
	$uid = sanitize_text_field( wp_unslash( $_POST['id'] ) );
}
global $wpdb;
$row = $wpdb->get_row( $wpdb->prepare( "SELECT name, email, message FROM wp_contact_us_form_entries WHERE ID =' $uid '" ), ARRAY_A );
if ( $wpdb->last_error ) {
	echo 'Error: ' . esc_html( $wpdb->last_error );
}
if ( $row ) :
	echo '<div class="container">
<form id="update-form" method="post">
<label for="name">Name</label>
<input type="text" id="name" name="name" placeholder="Visitor name.." value="' . esc_attr( $row['name'] ) . '">
<label for="email">Email</label>
<input type="text" id="email" name="email" placeholder="Visitor email." value="' . esc_attr( $row['email'] ) . '">
<label for="subject">Subject</label>
<textarea id="message" name="subject" placeholder="Visitor Message" style="height:200px">' . esc_attr( $row['message'] ) . '</textarea>
<button id="update">Update</button>
</form>
</div>';
else :
	echo esc_attr__( 'nothing found', 'very-simple-contact-us-form' );
endif;
?>
<script>

jQuery("#update-form").validate({
	rules: {
		name: {
			required: true,
			minlength: 3,
		},
		email: {
			required: true,
			email: true,
		},
		message: {
			required: true,
		},
		},
		messages: {
		name: "Please enter Visitor name",
		email: "Please enter a valid email address",
		subject: "Message field Cannot be empty",
		},
		submitHandler: function () {
			jQuery.ajax({
			type: "post",
			dataType: "json",
			url: plugin_data_admin.ajax_url,
			data: {
				action: "simple_contact_us_form_update",
				id:<?php echo esc_html( $uid ); ?>,
				name: jQuery("#name").val(),
				email: jQuery("#email").val(),
				subject: jQuery("#message").val(),
				nonce: plugin_data_admin.nonce,
			},
			success: function (response) {
				Swal.fire({
				icon: 'success',
				text: 'Your data is updated successfully you will be redirected shortly!!',
				showConfirmButton: false,
				timer: 2000
				});
				setTimeout(() => {
					location.reload();
				}, 2500);
			},
		});
	},
});
</script>



