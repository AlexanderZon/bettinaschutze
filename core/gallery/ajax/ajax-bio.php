<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb;

	$data = $_GET;

	$bio = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID = ".$data['id'], ARRAY_A);

	$logo = get_theme_option("logo");

	$html = '<img src="'.$logo.'" style="width:100%; max-width:360px"><br>
			<div style="width:100%;text-align:justify;">'.$bio['post_content'].'</div>
	';
	echo $html;

