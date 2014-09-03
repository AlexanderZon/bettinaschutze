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
	
	public $tables = array(
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
		
		foreach( $this->tables as $value => $key):
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
		
		$band = true;

		$args = array();

		switch($status){
			case 'all':
				$args = array(
					'post_status' => 'any',
					'post_type' => $this->galleries
					);
				break;
			case 'public':
			case 'draft':
			case 'trash':
				$args = array(
					'post_status' => $status,
					'post_type' => $this->galleries
					);
				break;
			default:
				$args = array(
					'post_status' => 'any',
					'post_type' => $this->galleries
					);
				break;
		}	

		if( $band ):
			
			$array = get_posts( $args );
			
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

		$row  = get_post( $id );

		if( $row == null ):
			return 0;
		else:
			return $row;
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