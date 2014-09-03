<?php 

if(!class_exists('ClassAdminMenuParent')){
	include_once('class-admin-menu-parent.php');
	}

class ClassAdminMenuPhotos extends ClassAdminMenuParent{
	
	public function __construct(){
		
		add_menu_page( 'Photos Lightbox' , 'Photos Lightbox' , 'manage_options' , 'page_photos_lightbox' , array( $this , 'page_photos_lightbox' ) , '' );
		add_submenu_page( 'page_photos_lightbox' , 'Agregar' , 'Agregar' , 'manage_options' , 'page_photos_lightbox_add' , array( $this , 'page_photos_lightbox_add' ) );
		add_submenu_page( 'page_photos_lightbox' , 'Editar' , 'Editar' , 'manage_options' , 'page_photos_lightbox_edit' , array( $this , 'page_photos_lightbox_edit' ) );
		add_submenu_page( 'page_photos_lightbox' , 'Borrar' , 'Borrar' , 'manage_options' , 'page_photos_lightbox_delete' , array( $this , 'page_photos_lightbox_delete' ) );
		
		}
		
	public function page_photos_lightbox( $atts ){
		
		$this->autoload('view_admin_photos_lightbox_main_page');
		
		}
		
	public function page_photos_lightbox_add( $atts ){
		
		$this->autoload('view_admin_photos_lightbox_add');
		
		}
		
	public function page_photos_lightbox_edit( $atts ){
		
		$this->autoload('view_admin_photos_lightbox_edit');
		
		}
				
	public function page_photos_lightbox_delete( $atts ){
		
		$this->autoload('view_admin_photos_lightbox_delete');
		
		}
	
	}
	