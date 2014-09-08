<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb, $gldb;

	$fivesdrafts = $wpdb->get_results( 
		"
		SELECT ID, post_title 
		FROM $wpdb->posts
		WHERE post_status = 'draft' 
		"
	);

	foreach ( $fivesdrafts as $fivesdraft ) 
	{
		echo $fivesdraft->post_title;
	}