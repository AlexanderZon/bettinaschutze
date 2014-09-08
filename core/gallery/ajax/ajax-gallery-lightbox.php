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

	for( $i = 0 ; $i < count($response['items']) ; $i++ ):
		$photos = $gldb->getPhotos($item['ID'], 'publish');
		$response['items'][$i]['photos'] = $photos;
	endfor;

	header('Content-Type: application/json');
	echo json_encode($response);

