<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb;

	$data = $_POST;

	$headers = 'From: '.$data['name'].' <'.$data['email'].'>' . '\r\n';
	$mail = wp_mail( 'theguitarplayer.am@gmail.com', $data['subject'], $data['message'] , $headers );

	if($mail):
		$html = 'Your message has been sent';
	else:
		$html = 'We had an error sending your message, please retry again later';
	endif;
	
	echo $html;

?>

