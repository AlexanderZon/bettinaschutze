<?php

/**
 * Inserción de asignaciones.
 * @access public
 * @param array $asignacion
 * @return int
 */

function el_insert_asignacion( $asignaciondata ){

	global $EL_DB, $wpdb;
	
	extract( wp_unslash( $asignaciondata ), EXTR_SKIP );
	
	$bool = true;
	
	if ( ! isset($profesor_id) OR $profesor_id == '' )
		$bool = false;
	if ( ! isset($materia_id) OR $materia_id == '' )
		$bool = false;
	if ( ! isset($asignacion_date) OR $asignacion_date == '' )
		$bool = false;
	if ( ! isset($periodo_id) OR $periodo_id == '' )
		$bool = false;
	if ( ! isset($asignacion_status) OR $asignacion_status == '' )
		$asignacion_status = 'draft';
		
	if( $bool ):
	
		$data = compact('profesor_id','materia_id','asignacion_date','periodo_id','asignacion_status');
		$wpdb->insert( $EL_DB->asignaciones , $data);
		
		$id = (int) $wpdb->insert_id;
		
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

function el_get_asignaciones( $status = 'all' ){

	global $EL_DB, $wpdb;
	
	$band = true;
	
	if( $status != 'all' AND $status != 'untrash' AND $status != 'publish' AND $status != 'draft' AND $status != 'trash' )
		$band = false;
	if( $status == 'all' )
		$where = " WHERE 1;";
	else 
		if( $status == 'untrash' )
			$where = " WHERE `asignacion_status`!='trash'";
		else
			$where = " WHERE `asignacion_status`='" . $status . "';";

	if( $band ):
		
		$array = $wpdb->get_results( "SELECT * FROM " . $EL_DB->asignaciones .$where , ARRAY_A );
		
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

function el_get_asignacion( $id ){

	global $EL_DB, $wpdb;

	$row  = $wpdb->get_row( "SELECT * FROM $EL_DB->asignaciones WHERE `ID`='$id';", ARRAY_A );

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
	
function el_update_asignacion( $object ){

	global $EL_DB, $wpdb;

	if( !isset($object['ID']) OR empty($object['ID']) ):
		return 0;
	endif;

	$asignacion = el_get_asignacion( $object['ID'] );

	$asignacion = array_replace( $asignacion, $object );

	$update = $wpdb->update( $EL_DB->asignaciones, $asignacion, array( 'ID' => $asignacion['ID'] ) );

	return $update;

}

/**
 * Eliminación de asignacions.
 * @access public
 * @param integer $id
 * @return integer || false
 */
	
function el_delete_asignacion( $id ){

	global $EL_DB, $wpdb;

	$delete = $wpdb->delete( $EL_DB->asignaciones, array( 'ID' => $id ), array( '%d' ) );

	return $delete;

}

/**
 * Envío a papelera de asignaciones.
 * @access public
 * @param integer $id
 * @return intener || false
 */
	
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

function el_publish_asignacion( $id ){

	$asignacion = el_get_asignacion( $id );

	$asignacion['asignacion_status'] = 'publish';

	$publish = el_update_asignacion( $asignacion );

	return $publish;

}

?>