<?php

/**
 * ELearning admin menu
 *
 * @class 		AdminMenu
 * @version		1.0.0
 * @package		ELearning/Classes
 * @category	Class
 * @author 		Alexis Montenegro
 */
 
if(!class_exists('ClassParent')){
	include_once('class-parent.php');
	}
 
class ClassAdminMenu extends ClassParent{
	
	/**
	 * ELearning AdminMEnu Constructor.
	 * @access public
	 * @return void
	 */
	 
	public function __construct(){
		 
		add_action( 'admin_menu' , array( $this , 'menu_gallery' ) );
		 
		add_action( 'admin_menu' , array( $this , 'menu_items' ) );
		 
		add_action( 'admin_menu' , array( $this , 'menu_photos' ) );		
		 
		}
	
	public function menu_gallery(){
		
		$this->autoload( 'class_admin_menu_gallery' );
		
		$object = new ClassAdminMenuGallery();
		
		}	
	
	public function menu_items(){
		
		$this->autoload( 'class_admin_menu_items' );
		
		$object = new ClassAdminMenuItems();
		
		}	
	
	public function menu_photos(){
		
		$this->autoload( 'class_admin_menu_photos' );
		
		$object = new ClassAdminMenuPhotos();
		
		}	
	 
	 }