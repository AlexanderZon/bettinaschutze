<?php

	require_once( "../../../../../../wp-config.php" );

	global $wpdb;

	$fivesdrafts = $wpdb->get_results( 
		"
		SELECT ID, post_title 
		FROM $wpdb->posts
		WHERE post_status = 'draft' 
			AND post_author = 5
		"
	);

	foreach ( $fivesdrafts as $fivesdraft ) 
	{
		echo $fivesdraft->post_title;
	}