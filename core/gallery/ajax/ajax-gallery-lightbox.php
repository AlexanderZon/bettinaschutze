<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb, $gldb;

	$data = $_POST;

	$response = null;

	//$gallery = $gldb->getGallery($data['id']);

	$gallery = $gldb->getGallery(312);

	$items = $gldb->getItems($gallery['ID'], 'publish');

	$response = $gallery;

	$response['items'] = $items;

	foreach($response['items'] as $item):
		$photos = $gldb->getPhotos($item['ID'], 'publish');
		$response['items'][$item]['photos'] = $photos;
	endforeach;

	header('Content-Type: application/json');
	echo json_encode($response);

