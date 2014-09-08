<?php

	require_once( "../../../../../../wp-config.php" );

	echo "Require";

	global $wpdb;

	echo "Global";

	$fivesdrafts = $wpdb->get_results( 
		"
		SELECT ID, post_title 
		FROM $wpdb->posts
		WHERE post_status = 'draft' 
		"
	);

	echo "Results";

	foreach ( $fivesdrafts as $fivesdraft ) 
	{
		echo $fivesdraft->post_title;
	}

	echo "Foreach";