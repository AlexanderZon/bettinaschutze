<?php

/**
 * Inserción de asignaciones.
 * @access public
 * @param array $asignacion
 * @return int
 */

function gl_insert_gallery( $gallery ){

	global $GalleryLightboxDB;
	
	$bool = true;
	
	if ( ! isset($gallery['post_type']) OR $gallery['post_type'] == '' )
		$gallery['post_type'] = $GalleryLightboxDB->gallery;
	if ( ! isset($gallery['post_status']) OR $gallery['post_status'] == '' )
		$gallery['post_status'] = 'draft';

	$id = wp_insert_post( $gallery );
		
	if( is_int($id) ):
		
		return $id;
	
	else:
	
		return 0;	
	
	endif;
	
	}

/**
 * Consulta de asignaciones.
 * @access public
 * @param string $status (Default:all)
 * @return array || false
 */

function gl_get_galleries( $status = 'all' ){

	global $GalleryLightboxDB;
	
	$band = true;

	switch($status){
		case 'all':
			$args = array(
				'post_type' => $GalleryLightboxDB->gallery
				);
			break;
		case 'public':
		case 'draft':
		case 'trash':
			$args = array(
				'post_status' => $status,
				'post_type' => $GalleryLightboxDB->gallery
				);
			break;
		default:
			$args = array(
				'post_status' => 'any',
				'post_type' => $GalleryLightboxDB->gallery
				);
			break;
	}	

	if( $band ):
		
		$array = get_posts( array( 'post_status' => $status ) );
		
		return $array;
		
	else:
	
		return false;				
			
	endif;

	}

/**
 * Consulta de asignaciones por ID.
 * @access public
 * @param string $id
 * @return array || 0
 */

function gl_get_gallery( $id ){

	global $GalleryLightboxDB, $wpdb;

	$row  = get_post( $id );

	if( $row == null ):
		return 0;
	else:
		return $row;
	endif;

	}

/**
 * Actualización de asignaciones.
 * @access public
 * @param array $object
 * @return integer || false
 */
	
/*
function el_update_asignacion( $object ){

	global $GalleryLightboxDB, $wpdb;

	if( !isset($object['ID']) OR empty($object['ID']) ):
		return 0;
	endif;

	$asignacion = el_get_asignacion( $object['ID'] );

	$asignacion = array_replace( $asignacion, $object );

	$update = $wpdb->update( $GalleryLightboxDB->asignaciones, $asignacion, array( 'ID' => $asignacion['ID'] ) );

	return $update;

}

/**
 * Eliminación de asignacions.
 * @access public
 * @param integer $id
 * @return integer || false
 */

/*
	
function el_delete_asignacion( $id ){

	global $GalleryLightboxDB, $wpdb;

	$delete = $wpdb->delete( $GalleryLightboxDB->asignaciones, array( 'ID' => $id ), array( '%d' ) );

	return $delete;

}

/**
 * Envío a papelera de asignaciones.
 * @access public
 * @param integer $id
 * @return intener || false
 */

/*
	
function el_trash_asignacion( $id ){

	$asignacion = el_get_asignacion( $id );

	$asignacion['asignacion_status'] = 'trash';

	$trash = el_update_asignacion( $asignacion );

	return $trash;

}

/**
 * Publicación de asignaiconess.
 * @access public
 * @param integer $id
 * @return intener || false
 */

/*

function el_publish_asignacion( $id ){

	$asignacion = el_get_asignacion( $id );

	$asignacion['asignacion_status'] = 'publish';

	$publish = el_update_asignacion( $asignacion );

	return $publish;

}

?>