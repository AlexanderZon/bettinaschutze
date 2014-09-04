<?php

class eLError{

    var $errors = array();

    var $error_data = array();
	
    function __construct($code = '', $message = '', $data = '') {
        if ( empty($code) )
            return;
	
        $this->errors[$code][] = $message;
        if ( ! empty($data) )
            $this->error_data[$code] = $data;
        }

} 

/**
 * Main GalleryLightboxDB Class
 * @description Contiene las definiciones de las tablas que almacenan los datos del sistema
 * @class GalleryLightboxDB
 * @version 1.0.0
 * @since 1.0
 * @package eLearning
 * @author Alexis Montenegro
 */
	 
class GalleryLightboxDB{
	
	/**
	 * @var table
	 * @access public
	 * @type string
	 */
	
	public $table;
	
	/**
	 * @var galleries
	 * @access public
	 * @type string
	 */
	
	public $galleries;
	
	/**
	 * @var items
	 * @access public
	 * @type string
	 */
	
	public $items;
	
	/**
	 * @var photos
	 * @access public
	 * @type string
	 */
	
	public $photos;
	
	/**
	 * @var types
	 * @access public
	 * @type array
	 */
	
	public $types = array(
		'galleries' => 'gallery',	
		'items' => 'item',	
		'photos' => 'photo',
	);
	
	/**
	 * @var msg
	 * @access public
	 * @type array
	 */
	
	public $msg = array(
		'gallery_oculted' => 'La galería se ha puesto en modo no visible',	
		'gallery_oculted_err' => 'Hubo un error al ocultar la galería',
		'gallery_visible' => 'La galería se ha puesto en modo visible',
		'gallery_visible_err' => 'Hubo un error al mostrar la galería',
		'gallery_update' => 'Galería actualizada con éxito',
		'gallery_update_err' => 'Hubo un error al actualizar la galería',
		'gallery_trash' => 'La galería ha sido enviada a la papelera de reciclaje',
		'gallery_trash_err' => 'Hubo un error el enviar la galería a la papelera de reciclaje',
		'gallery_untrash' => 'La galería ha sido restaurada con éxito',
		'gallery_untrash_err' => 'Hubo un error al restaurar la galería',
		'gallery_delete' => 'La Galería ha sido eliminada con éxito',
		'gallery_delete_err' => 'Hubo un error al eliminar la galería permanentemente',
/*
		'items_oculted' => 'La galería se ha puesto en modo no visible',	
		'items_oculted_err' => 'Hubo un error al ocultar la galería',
		'items_visible' => 'La galería se ha puesto en modo visible',
		'items_visible_err' => 'Hubo un error al mostrar la galería',
		'items_update' => 'Galería actualizada con éxito',
		'items_update_err' => 'Hubo un error al actualizar la galería',
		'items_trash' => 'La galería ha sido enviada a la papelera de reciclaje',
		'items_trash_err' => 'Hubo un error el enviar la galería a la papelera de reciclaje',
		'items_untrash' => 'La galería ha sido restaurada con éxito',
		'items_untrash_err' => 'Hubo un error al restaurar la galería',
		'items_delete' => 'La Galería ha sido eliminada con éxito',
		'items_delete_err' => 'Hubo un error al eliminar la galería permanentemente',

		'photos_oculted' => 'La galería se ha puesto en modo no visible',	
		'photos_oculted_err' => 'Hubo un error al ocultar la galería',
		'photos_visible' => 'La galería se ha puesto en modo visible',
		'photos_visible_err' => 'Hubo un error al mostrar la galería',
		'photos_update' => 'Galería actualizada con éxito',
		'photos_update_err' => 'Hubo un error al actualizar la galería',
		'photos_trash' => 'La galería ha sido enviada a la papelera de reciclaje',
		'photos_trash_err' => 'Hubo un error el enviar la galería a la papelera de reciclaje',
		'photos_untrash' => 'La galería ha sido restaurada con éxito',
		'photos_untrash_err' => 'Hubo un error al restaurar la galería',
		'photos_delete' => 'La Galería ha sido eliminada con éxito',
		'photos_delete_err' => 'Hubo un error al eliminar la galería permanentemente',
*/
	);
		
	/**
	 * @var prefix
	 * @access public
	 * @type string
	 */
		
	public $prefix = 'gl_';
	
	/**
	 * GalleryLightboxDB Constructor.
	 * @access public
	 * @return void
	 */
	
	public function __construct(){
		
		$this->table = 'wp_posts';

		foreach( $this->types as $value => $key):
			$this->__set( $value , $key );
		endforeach;
		
	}
		
	/**
	 * GalleryLightboxDB Destructor.
	 * @access public
	 * @return void
	 */
		
	public function __destruct() {
		
		return true;
		
	}
	
	/**
	 * GalleryLightboxDB Setter.
	 * @access public
	 * @return void
	 */
		
	public function __set( $name , $value ){
		
		$this->$name = $this->prefix.$value;
		
	}

	/**
	 * Inserción de asignaciones.
	 * @access public
	 * @param array $asignacion
	 * @return int
	 */

	public function addGallery( $gallery ){
		
		$bool = true;
		
		if ( ! isset($gallery['post_type']) OR $gallery['post_type'] == '' )
			$gallery['post_type'] = $this->galleries;
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

	public function getGalleries( $status = 'all' ){
	 
		global  $wpdb;
		
		$band = true;

		$where = " WHERE `post_type`='".$this->galleries."'";
		
		if( $status != 'all' AND $status != 'untrash' AND $status != 'publish' AND $status != 'draft' AND $status != 'trash' )
			$band = false;
		else 
			if( $status == 'all' )
				$where .= " ";
			elseif( $status == 'untrash' )
				$where .= " AND `post_status`!='trash'";
			else
				$where .= " AND `post_status`='" . $status . "'";

		if( $band ):
			
			$array = $wpdb->get_results( "SELECT * FROM " . $this->table .$where , ARRAY_A );

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

	public function getGallery( $id ){

		global $wpdb;

		$row  = $wpdb->get_row( "SELECT * FROM $this->table WHERE `ID`='$id';", ARRAY_A );

		if( $row == null ):
			return 0;
		else:
			return $row;
		endif;

	}

	/** 
	 * Actualización de Galerias.
	 * @access public
	 * @param array $object
	 * @return integer || false
	 */
		
	public function updateGallery( $object ){

		global $wpdb;

		if( !isset($object['ID']) OR empty($object['ID']) ):
			return 0;
		endif;

		$gallery = $this->getGallery( $object['ID'] );

		$gallery = array_replace( $gallery, $object );

		$update = $wpdb->update( $this->table, $gallery, array( 'ID' => $gallery['ID'] ) );

		return $update;

	}

	/**
	 * Eliminación de materias.
	 * @access public
	 * @param integer $id
	 * @return integer || false
	 */
		
	public function deleteGallery( $id ){

		global $wpdb;

		$delete = $wpdb->delete( $this->table, array( 'ID' => $id ), array( '%d' ) );

		return $delete;

	}

	/**
	 * Envío a papelera de materias.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */
		
	public function trashGallery( $id ){

		$gallery = $this->getGallery( $id );

		$gallery['post_status'] = 'trash';

		$trash = $this->updateGallery( $gallery );

		return $trash;

	}

	/**
	 * Envío a papelera de materias.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */
		
	public function untrashGallery( $id ){

		$gallery = $this->getGallery( $id );

		$gallery['post_status'] = 'draft';

		$trash = $this->updateGallery( $gallery );

		return $trash;

	}

	/**
	 * Publicación de materias.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */

	public function publishGallery( $id ){

		$gallery = $this->getGallery( $id );

		$gallery['post_status'] = 'publish';

		$trash = $this->updateGallery( $gallery );

		return $trash;

	}

	/**
	 * Inserción de item.
	 * @access public
	 * @param array $asignacion
	 * @return int
	 */

	public function addItem( $parent, $item ){
		
		$bool = true;
		
		if ( ! isset($item['post_type']) OR $item['post_type'] == '' )
			$item['post_type'] = $this->items;
		if ( ! isset($item['post_status']) OR $item['post_status'] == '' )
			$item['post_status'] = 'draft';

		$item['post_parent'] = $parent;
		
		$id = wp_insert_post( $item );
			
		if( is_int($id) ):
			
			return $id;
		
		else:
		
			return 0;	
		
		endif;

	}

	/**
	 * Consulta de items.
	 * @access public
	 * @param string $status (Default:all)
	 * @return array || false
	 */

	function getItems( $parent, $status = 'all' ){
	 
		global  $wpdb;
		
		$band = true;

		$where = " WHERE `post_type`='".$this->items."' AND  `post_parent`='".$parent."'";
		
		if( $status != 'all' AND $status != 'untrash' AND $status != 'publish' AND $status != 'draft' AND $status != 'trash' )
			$band = false;
		else 
			if( $status == 'all' )
				$where .= " ";
			elseif( $status == 'untrash' )
				$where .= " AND `post_status`!='trash'";
			else
				$where .= " AND `post_status`='" . $status . "'";

		if( $band ):
			
			$array = $wpdb->get_results( "SELECT * FROM " . $this->table .$where , ARRAY_A );
		
			return $array;
			
		else:
		
			return false;				
				
		endif;

	}

	/**
	 * Consulta de item por ID.
	 * @access public
	 * @param string $id
	 * @return array || 0
	 */

	function getItem( $id ){

		global $wpdb;

		$row  = $wpdb->get_row( "SELECT * FROM $this->table WHERE `ID`='$id';", ARRAY_A );

		if( $row == null ):
			return 0;
		else:
			return $row;
		endif;

	}

	/** 
	 * Actualización de Item.
	 * @access public
	 * @param array $object
	 * @return integer || false
	 */
		
	function updateItem( $object ){

		global $wpdb;

		if( !isset($object['ID']) OR empty($object['ID']) ):
			return 0;
		endif;

		$item = $this->getItem( $object['ID'] );

		$item = array_replace( $item, $object );

		$update = $wpdb->update( $this->table, $item, array( 'ID' => $item['ID'] ) );

		return $update;

	}

	/**
	 * Eliminación de item.
	 * @access public
	 * @param integer $id
	 * @return integer || false
	 */
		
	function deleteItem( $id ){

		global $wpdb;

		$delete = $wpdb->delete( $this->table, array( 'ID' => $id ), array( '%d' ) );

		return $delete;

	}

	/**
	 * Envío a papelera de item.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */
		
	function trashItem( $id ){

		$item = $this->getItem( $id );

		$item['post_status'] = 'trash';

		$trash = $this->updateItem( $item );

		return $trash;

	}

	/**
	 * Envío a papelera de item.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */
		
	function untrashItem( $id ){

		$item = $this->getItem( $id );

		$item['post_status'] = 'draft';

		$trash = $this->updateItem( $item );

		return $trash;

	}

	/**
	 * Publicación de item.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */

	function publishItem( $id ){

		$item = $this->getItem( $id );

		$item['post_status'] = 'publish';

		$trash = $this->updateItem( $item );

		return $trash;

	}	public function addItem( $parent, $item ){
		
		$bool = true;
		
		if ( ! isset($item['post_type']) OR $item['post_type'] == '' )
			$item['post_type'] = $this->items;
		if ( ! isset($item['post_status']) OR $item['post_status'] == '' )
			$item['post_status'] = 'draft';

		$item['post_parent'] = $parent;
		
		$id = wp_insert_post( $item );
			
		if( is_int($id) ):
			
			return $id;
		
		else:
		
			return 0;	
		
		endif;

	}
		
}
	
$GLOBALS['gldb'] = new GalleryLightboxDB();
/*
require('db/items.db.php');

require('db/photos.db.php');

require('db/galleries.db.php');
*/

?>