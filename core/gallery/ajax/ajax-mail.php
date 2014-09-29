<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb;

	$logo = get_theme_option("logo");

	$html = '<img src="'.$logo.'" ><br>
			<div style="width:500px;text-align:justify;">
				<form id="contact-form" action="" method="post">
				<table>
					<tr><td><label>Name</label></td><td><input type="text" name="name"/></td></tr>
					<tr><td><label>Email</label></td><td><input type="email" name="email" /></td></tr>
					<tr><td><label>Subject</label></td><td><input type="text" name="subject" /></td></tr>
					<tr><td><label>Message</label></td><td><textarea name="message"></textarea> </td></tr>
					<tr><td colspan="2"><input type="submit" value="Submit"></td></tr>
				</form>
				<script>
					$("#contact-form").on("submit", function(e){
						e.preventDefault();
						
					});
				</script>
			</div>
	';
	echo $html;

?>

