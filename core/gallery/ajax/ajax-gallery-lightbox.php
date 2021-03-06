<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb, $gldb;

	$data = $_POST;

	$response = null;

	$gallery = $gldb->getGallery($data['id']);

	//$gallery = $gldb->getGallery(383);

	$items = $gldb->getItems($gallery['ID'], 'publish');

	$videos = $gldb->getVideos($gallery['ID'], 'publish');

	$response = $gallery;

	$response['items'] = $items;

	$response['videos'] = $videos;

	for( $i = 0 ; $i < count($response['items']) ; $i++ ):
		$src = wp_get_attachment_url($response['items'][$i]['post_excerpt']);
		$thumb = wp_get_attachment_thumb_url($response['items'][$i]['post_excerpt']);
		$response['items'][$i]['src'] = $src;
		$response['items'][$i]['thumb'] = $thumb;
		$photos = $gldb->getPhotos($response['items'][$i]['ID'], 'publish');
		for( $j = 0 ; $j < count($photos) ; $j++ ):
			$photos[$j]['src'] = wp_get_attachment_url($photos[$j]['post_excerpt']);
		endfor;
		$response['items'][$i]['photos'] = $photos;
	endfor;

	for( $i = 0 ; $i < count($response['videos']) ; $i++ ):
		$src = wp_get_attachment_url($response['videos'][$i]['post_excerpt']);
		$thumb = wp_get_attachment_thumb_url($response['videos'][$i]['post_excerpt']);
		$response['videos'][$i]['src'] = $src;
		$response['videos'][$i]['thumb'] = $thumb;
	endfor;

	header('Content-Type: application/json');
	echo json_encode($response);

