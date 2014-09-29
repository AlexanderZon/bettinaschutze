<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb;

	$logo = get_theme_option("logo");

	$html = '<img src="'.$logo.'" ><br>
			<div style="width:500px;text-align:justify;">
				<form>
					<label>Name</label><input type="text" name="name"/>
					<label>Email</label><input type="email" name="email" />
					<label>Subject</label><input type="text" name="subject" />
					<label>Message</label><textarea name="message"></textarea> 
					<input type="submit" value="Submit">
				</form>
			</div>
	';
	echo $html;

?>

