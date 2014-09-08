<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	echo "Test<br>";

	global $wpdb, $gldb;

	var_dump($_REQUEST);

	echo "Test<br>";

	echo "Test<br>";

	$data = $_POST;

	echo "Test<br>";

	$gallery = $gldb->getGallery($data['id']);

	echo "Test<br>";
	
	echo $gallery->post_title;

	var_dump($gldb);

	var_dump($gallery);

	echo "Test<br>";