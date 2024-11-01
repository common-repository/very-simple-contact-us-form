<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Very_Simple_Contact_Us_Form
 * @subpackage Very_Simple_Contact_Us_Form/public/partials
 */

?>

<div class="container">
<form id='contact-us' method="post">
<label for="name">Name</label>
<input type="text" id="name" name="name" placeholder="Your name..">
<label for="email">Email</label>
<input type="text" id="email" name="email" placeholder="Your email.">
<label for="subject">Subject</label>
<textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
<input type="submit" id="submit" value="Send">
</form>
</div>
