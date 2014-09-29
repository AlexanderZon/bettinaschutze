<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb;

	$data = $_GET;

	$bio = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID = ".$data['id'], ARRAY_A);

	$logo = get_theme_option("logo");

	$html = '<img src="'.$logo.'" ><br>
			<form>
				<label>Name</label><input type="text" name="name"/>
				<label>Email</label><input type="email" name="email" />
				<label>Subject</label><input type="text" name="subject" />
				<label>Message</label><textarea name="message"></textarea> 
				<input type="submit" value="Submit">
			</form>
	';
	echo $html;

?>

