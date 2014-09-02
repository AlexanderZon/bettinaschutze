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
		
	}
	
$GLOBALS['GalleryLightboxDB'] = new GalleryLightboxDB();

/*
require('db/items.db.php');

require('db/photos.db.php');

require('db/galleries.db.php');
*/
?>