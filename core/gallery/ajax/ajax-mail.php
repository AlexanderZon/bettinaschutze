<?php

	require_once( "../../../../../../wp-config.php" );
	require( ABSPATH . WPINC . '/pluggable.php' );

	require_once( "../class.db.php" );

	global $wpdb;

	$data = $_POST;
	return var_dump($data['subject']);
	$headers = 'From: '.$data['name'].' <'.$data['email'].'>' . '\r\n';
	$mail = mail( 'alex_100aleman@hotmail.com' , $data['subject'] , $data['message'] );
	//$mail = wp_mail( 'alex_100aleman@hotmail.com', $data['subject'], $data['message'] , $headers );
	
	if($mail):
		$html = 'Your message has been sent';
	else:
		$html = 'We had an error sending your message, please retry again later';
	endif;

	echo $html;

?>

