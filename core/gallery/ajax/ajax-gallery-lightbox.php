<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb, $gldb;

	$data = $_POST;

	$gallery = $gldb->getGallery($data['id']);

	echo $gallery->post_title;

	echo $gallery['post_title'];

	var_dump($gallery);