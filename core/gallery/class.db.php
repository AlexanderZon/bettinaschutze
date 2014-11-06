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
		'videos' => 'video',
	);
	
	/**
	 * @var msg
	 * @access public
	 * @type array
	 */
	
	public $msg = array(
		'gallery_add' => 'La galería ha sido creada con éxito',	
		'gallery_add_err' => 'Hubo un error al crear la galería',
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

		'item_add' => 'El item ha sido creada con éxito',	
		'item_add_err' => 'Hubo un error al crear el item',
		'item_add_attach_err' => 'Hubo un error al crear la imagen de destaque del item',
		'item_oculted' => 'El item se ha puesto en modo no visible',	
		'item_oculted_err' => 'Hubo un error al ocultar el item',
		'item_visible' => 'El item se ha puesto en modo visible',
		'item_visible_err' => 'Hubo un error al mostrar el item',
		'item_update' => 'Item actualizada con éxito',
		'item_update_err' => 'Hubo un error al actualizar el item',
		'item_trash' => 'El item ha sido enviado a la papelera de reciclaje',
		'item_trash_err' => 'Hubo un error el enviar el item a la papelera de reciclaje',
		'item_untrash' => 'El item ha sido restaurado con éxito',
		'item_untrash_err' => 'Hubo un error al restaurar el item',
		'item_delete' => 'El item ha sido eliminada con éxito',
		'item_delete_err' => 'Hubo un error al eliminar el item permanentemente',
		'item_upped' => 'El item ha sido subido con éxito',
		'item_upped_err' => 'Hubo un error al subir el item',
		'item_downed' => 'El item ha sido bajado con éxito',
		'item_downed_err' => 'Hubo un error al bajar el item permanentemente',

		'video_add' => 'El video ha sido creada con éxito',	
		'video_add_err' => 'Hubo un error al crear el video',
		'video_add_attach_err' => 'Hubo un error al crear la imagen de destaque del video',
		'video_oculted' => 'El video se ha puesto en modo no visible',	
		'video_oculted_err' => 'Hubo un error al ocultar el video',
		'video_visible' => 'El video se ha puesto en modo visible',
		'video_visible_err' => 'Hubo un error al mostrar el video',
		'video_update' => 'Video actualizada con éxito',
		'video_update_err' => 'Hubo un error al actualizar el video',
		'video_trash' => 'El video ha sido enviado a la papelera de reciclaje',
		'video_trash_err' => 'Hubo un error el enviar el video a la papelera de reciclaje',
		'video_untrash' => 'El video ha sido restaurado con éxito',
		'video_untrash_err' => 'Hubo un error al restaurar el video',
		'video_delete' => 'El video ha sido eliminada con éxito',
		'video_delete_err' => 'Hubo un error al eliminar el video permanentemente',
		'video_upped' => 'El video ha sido subido con éxito',
		'video_upped_err' => 'Hubo un error al subir el video',
		'video_downed' => 'El video ha sido bajado con éxito',
		'video_downed_err' => 'Hubo un error al bajar el video permanentemente',

		'photo_add' => 'La foto ha sido creada con éxito',	
		'photo_add_err' => 'Hubo un error al crear la foto',
		'photo_add_attach_err' => 'Hubo un error al crear la imagen',
		'photo_oculted' => 'La foto se ha puesto en modo no visible',	
		'photo_oculted_err' => 'Hubo un error al ocultar la foto',
		'photo_visible' => 'La foto se ha puesto en modo visible',
		'photo_visible_err' => 'Hubo un error al mostrar la foto',
		'photo_update' => 'Foto actualizada con éxito',
		'photo_update_err' => 'Hubo un error al actualizar la foto',
		'photo_trash' => 'La foto ha sido enviada a la papelera de reciclaje',
		'photo_trash_err' => 'Hubo un error el enviar la foto a la papelera de reciclaje',
		'photo_untrash' => 'La foto ha sido restaurada con éxito',
		'photo_untrash_err' => 'Hubo un error al restaurar la foto',
		'photo_delete' => 'La Foto ha sido eliminada con éxito',
		'photo_delete_err' => 'Hubo un error al eliminar la foto permanentemente',
		'photo_upped' => 'La foto ha sido subido con éxito',
		'photo_upped_err' => 'Hubo un error al subir la foto',
		'photo_downed' => 'La foto ha sido bajado con éxito',
		'photo_downed_err' => 'Hubo un error al bajar la foto permanentemente',

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

	public function getItems( $parent, $status = 'all' ){
	 
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
			
			$array = $wpdb->get_results( "SELECT * FROM " . $this->table .$where . " ORDER BY `menu_order` ASC", ARRAY_A );
		
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

	public function getItem( $id ){

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
		
	public function updateItem( $object ){

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
		
	public function deleteItem( $id ){

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
		
	public function trashItem( $id ){

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
		
	public function untrashItem( $id ){

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

	public function publishItem( $id ){

		$item = $this->getItem( $id );

		$item['post_status'] = 'publish';

		$trash = $this->updateItem( $item );

		return $trash;

	}

	/**
	 * Subida de posicion de item.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */

	public function upItem( $id ){

		$item = $this->getItem( $id );

		if( $item['menu_order'] == 0 ):

			return false;

		else:
			echo "else";
			$parent = $item['post_parent'];
			$at = $item['menu_order'];

			echo "elements";
			$prev = $this->itemAt( $parent, $at-1 );

			echo "prev";
			$item['menu_order'] = $prev['menu_order'];
			$prev['menu_order'] = $at;

			echo "change";
			if($this->updateItem($item) AND $this->updateItem($prev)):
				echo "updated";
				return true;

			else:

				echo "non updated";
				return false;

			endif;

		endif;

	}

	/**
	 * Bajada de posicion de item.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */

	public function downItem( $id ){

		$item = $this->getItem( $id );

		echo ( count($gldb->getItems( $parent ) ) -1 );

		if( $item['menu_order'] == ( count($gldb->getItems( $parent ) ) -1 ) ):

			return false;

		else:

			echo "else";
			$parent = $item['post_parent'];
			$at = $item['menu_order'];

			echo "elements";
			$next = $this->itemAt( $parent, $at+1 );

			echo "next";
			$item['menu_order'] = $next['menu_order'];
			$next['menu_order'] = $at;

			echo "ganche";
			if( $this->updateItem($item) AND $this->updateItem($next) ):

				echo "updated";
				return true;

			else:

				echo "non updated";
				return false;

			endif;

		endif;

	}

	public function itemAt( $parent, $at ){

		global $wpdb;

		$row  = $wpdb->get_row( "SELECT * FROM $this->table WHERE `post_parent`='$parent' AND `menu_order`='$at';", ARRAY_A );

		if( $row == null ):
			return 0;
		else:
			return $row;
		endif;

	}


	/**
	 * Inserción de photo.
	 * @access public
	 * @param array $asignacion
	 * @return int
	 */

	public function addPhoto( $parent, $photo ){
		
		$bool = true;
		
		if ( ! isset($photo['post_type']) OR $photo['post_type'] == '' )
			$photo['post_type'] = $this->photos;
		if ( ! isset($photo['post_status']) OR $photo['post_status'] == '' )
			$photo['post_status'] = 'draft';

		$photo['post_parent'] = $parent;
		
		$id = wp_insert_post( $photo );
			
		if( is_int($id) ):
			
			return $id;
		
		else:
		
			return 0;	
		
		endif;

	}

	/**
	 * Consulta de photos.
	 * @access public
	 * @param string $status (Default:all)
	 * @return array || false
	 */

	public function getPhotos( $parent, $status = 'all' ){
	 
		global  $wpdb;
		
		$band = true;

		$where = " WHERE `post_type`='".$this->photos."' AND  `post_parent`='".$parent."'";
		
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
	 * Consulta de photo por ID.
	 * @access public
	 * @param string $id
	 * @return array || 0
	 */

	public function getPhoto( $id ){

		global $wpdb;

		$row  = $wpdb->get_row( "SELECT * FROM $this->table WHERE `ID`='$id';", ARRAY_A );

		if( $row == null ):
			return 0;
		else:
			return $row;
		endif;

	}

	/** 
	 * Actualización de photo.
	 * @access public
	 * @param array $object
	 * @return integer || false
	 */
		
	public function updatePhoto( $object ){

		global $wpdb;

		if( !isset($object['ID']) OR empty($object['ID']) ):
			return 0;
		endif;

		$photo = $this->getPhoto( $object['ID'] );

		$photo = array_replace( $photo, $object );

		$update = $wpdb->update( $this->table, $photo, array( 'ID' => $photo['ID'] ) );

		return $update;

	}

	/**
	 * Eliminación de photos.
	 * @access public
	 * @param integer $id
	 * @return integer || false
	 */
		
	public function deletePhoto( $id ){

		global $wpdb;

		$delete = $wpdb->delete( $this->table, array( 'ID' => $id ), array( '%d' ) );

		return $delete;

	}

	/**
	 * Envío a papelera de photos.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */
		
	public function trashPhoto( $id ){

		$photo = $this->getPhoto( $id );

		$photo['post_status'] = 'trash';

		$trash = $this->updatePhoto( $photo );

		return $trash;

	}

	/**
	 * Envío a papelera de photos.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */
		
	public function untrashPhoto( $id ){

		$photo = $this->getPhoto( $id );

		$photo['post_status'] = 'draft';

		$trash = $this->updatePhoto( $photo );

		return $trash;

	}

	/**
	 * Publicación de photos.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */

	public function publishPhoto( $id ){

		$photo = $this->getPhoto( $id );

		$photo['post_status'] = 'publish';

		$trash = $this->updatePhoto( $photo );

		return $trash;

	}

	/**
	 * Subida de posicion de photo.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */

	public function upPhoto( $id ){

		$photo = $this->getPhoto( $id );

		if( $photo['menu_order'] == 0 ):

			return false;

		else:

			$parent = $photo['post_parent'];
			$at = $photo['menu_order'];

			$prev = $this->photoAt( $parent, $at-1 );

			$photo['menu_order'] = $prev['menu_order'];
			$prev['menu_order'] = $at;

			if($this->updatePhoto($photo) AND $this->updatePhoto($prev)):

				return true;

			else:

				return false;

			endif;

		endif;

	}

	/**
	 * Bajada de posicion de photo.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */

	public function downPhoto( $id ){

		$photo = $this->getPhoto( $id );

		if( $photo['menu_order'] == 0 ):

			return false;

		else:

			$parent = $photo['post_parent'];
			$at = $photo['menu_order'];

			$next = $this->photoAt( $parent, $at+1 );

			$photo['menu_order'] = $next['menu_order'];
			$next['menu_order'] = $at;

			if( $this->updatePhoto($photo) AND $this->updatePhoto($next) ):

				return true;

			else:

				return false;

			endif;

		endif;

	}

	public function photoAt( $parent, $at ){

		global $wpdb;

		$row  = $wpdb->get_row( "SELECT * FROM $this->table WHERE `post_parent`='$parent' AND `menu_order`='$at';", ARRAY_A );

		if( $row == null ):
			return 0;
		else:
			return $row;
		endif;

	}

	/**
	 * Inserción de video.
	 * @access public
	 * @param array $asignacion
	 * @return int
	 */

	public function addVideo( $parent, $video ){
		
		$bool = true;
		
		if ( ! isset($video['post_type']) OR $video['post_type'] == '' )
			$video['post_type'] = $this->videos;
		if ( ! isset($video['post_status']) OR $video['post_status'] == '' )
			$video['post_status'] = 'draft';

		$video['post_parent'] = $parent;
		
		$id = wp_insert_post( $video );
			
		if( is_int($id) ):
			
			return $id;
		
		else:
		
			return 0;	
		
		endif;

	}

	/**
	 * Consulta de videos.
	 * @access public
	 * @param string $status (Default:all)
	 * @return array || false
	 */

	public function getVideos( $parent, $status = 'all' ){
	 
		global  $wpdb;
		
		$band = true;

		$where = " WHERE `post_type`='".$this->videos."' AND  `post_parent`='".$parent."'";
		
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
	 * Consulta de video por ID.
	 * @access public
	 * @param string $id
	 * @return array || 0
	 */

	public function getVideo( $id ){

		global $wpdb;

		$row  = $wpdb->get_row( "SELECT * FROM $this->table WHERE `ID`='$id';", ARRAY_A );

		if( $row == null ):
			return 0;
		else:
			return $row;
		endif;

	}

	/** 
	 * Actualización de Video.
	 * @access public
	 * @param array $object
	 * @return integer || false
	 */
		
	public function updateVideo( $object ){

		global $wpdb;

		if( !isset($object['ID']) OR empty($object['ID']) ):
			return 0;
		endif;

		$video = $this->getVideo( $object['ID'] );

		$video = array_replace( $video, $object );

		$update = $wpdb->update( $this->table, $video, array( 'ID' => $video['ID'] ) );

		return $update;

	}

	/**
	 * Eliminación de video.
	 * @access public
	 * @param integer $id
	 * @return integer || false
	 */
		
	public function deleteVideo( $id ){

		global $wpdb;

		$delete = $wpdb->delete( $this->table, array( 'ID' => $id ), array( '%d' ) );

		return $delete;

	}

	/**
	 * Envío a papelera de video.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */
		
	public function trashVideo( $id ){

		$video = $this->getVideo( $id );

		$video['post_status'] = 'trash';

		$trash = $this->updateVideo( $video );

		return $trash;

	}

	/**
	 * Envío a papelera de video.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */
		
	public function untrashVideo( $id ){

		$video = $this->getVideo( $id );

		$video['post_status'] = 'draft';

		$trash = $this->updateVideo( $video );

		return $trash;

	}

	/**
	 * Publicación de video.
	 * @access public
	 * @param integer $id
	 * @return intener || false
	 */

	public function publishVideo( $id ){

		$video = $this->getVideo( $id );

		$video['post_status'] = 'publish';

		$trash = $this->updateVideo( $video );

		return $trash;

	}
		
}
	
$GLOBALS['gldb'] = new GalleryLightboxDB();
/*
require('db/items.db.php');

require('db/photos.db.php');

require('db/galleries.db.php');
*/

?>