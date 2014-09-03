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
	function getGalleries( $status = 'all' ){
	 
		global  $wpdb;
		
		$band = true;

		$where = " WHERE `post_type`='".$this->galleries."'";
		
		if( $status != 'all' AND $status != 'untrash' AND $status != 'publish' AND $status != 'draft' AND $status != 'trash' )
			$band = false;
		else 
			if( $status == 'all' )
				$where .= " ";
			elseif( $status == 'untrash' )
				$where .= " `post_status`!='trash'";
			else
				$where .= " `post_status`='" . $status . "'";

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

	function getGallery( $id ){

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
		
	function updateGallery( $object ){

		global $wpdb;

		if( !isset($object['ID']) OR empty($object['ID']) ):
			return 0;
		endif;

		$gallery = $this->getGallery( $object['ID'] );

		var_dump($gallery);

		echo "<br>gallery<br>";

		var_dump($object);

		echo "<br>object<br>";

		var_dump(array_replace( $gallery, $object ));
		echo "SAY SOMETHING";
		$gallery = array_replace( $gallery, $object );

		var_dump($gallery);

		$update = $wpdb->update( $this->table, $gallery, array( 'ID' => $gallery['ID'] ) );

		return $update;

		}
		
	}
	
$GLOBALS['gldb'] = new GalleryLightboxDB();
/*
require('db/items.db.php');

require('db/photos.db.php');

require('db/galleries.db.php');
*/

?>