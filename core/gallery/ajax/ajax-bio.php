<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb;

	$data = $_GET;

	$bio = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID = ".$data['id'], ARRAY_A);

	$html = '<img src="'.the_theme_option("logo").'" ><br>
			<p style="width:50%">'.$bio['post_content'].'</p>
	';
	echo $html;

