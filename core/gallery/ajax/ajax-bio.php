<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb;

	$data = $_GET;

	$bio = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID = ".$data['id'], ARRAY_A);

	$logo = get_theme_option("logo");

	$html = '<img src="'.$logo.'" ><br>
			<div style="width:500px;text-align:justify;">'.$bio['post_content'].'</div>
	';
	echo $html;

