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
	<h2>Form Details</h2>
	<a class="button" href="<?php echo esc_html( admin_url( 'admin.php?page=contact-form-entries' ) ); ?>&action=download_csv&_wpnonce=<?php echo esc_html( wp_create_nonce( 'download_csv' ) ); ?>" class="page-title-action"><?php esc_html_e( 'Export to CSV', 'very-simple-contact-us-form' ); ?></a>
</div>
<?php
global $wpdb;
$rows = $wpdb->get_results( 'SELECT * FROM wp_contact_us_form_entries' );
if ( $wpdb->last_error ) {
	echo 'Error: ' . esc_html( $wpdb->last_error );
}
if ( $rows ) :
	?>
<table class='wp-list-table widefat fixed posts'>
<thead>
<tr>
<th class="manage-column">Name</th>
<th class="manage-column">Email</th>
<th class="manage-column">Message</th>
<th class="manage-column">Actions</th>
</tr>
</thead>
<tbody>
	<?php
	foreach ( $rows as $row ) {
		$uid = ( $row->id );
		?>
	<tr>
	<td> <?php echo esc_html( $row->name ); ?>	</td>
	<td> <?php echo esc_html( $row->email ); ?>	</td>
	<td> <?php echo esc_html( $row->message ); ?>	</td>
	<td>  <button id="edit" data-id="<?php echo esc_html( $uid ); ?>">Edit</button> <button id="delete" data-id="<?php echo esc_html( $uid ); ?>">Delete</button> </td>
</tr>
<?php } ?>
</tbody>
</table>
	<?php
else :
	echo 'nothing found';
endif;



