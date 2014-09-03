<?php 

if(!class_exists('ClassAdminMenuParent')){
	include_once('class-admin-menu-parent.php');
	}

class ClassAdminMenuItems extends ClassAdminMenuParent{
	
	public function __construct(){
		
		add_menu_page( 'Items Lightbox' , 'Items Lightbox' , 'manage_options' , 'page_items_lightbox' , array( $this , 'page_items_lightbox' ) , '' );
		add_submenu_page( 'page_items_lightbox' , 'Agregar' , 'Agregar' , 'manage_options' , 'page_items_lightbox_add' , array( $this , 'page_items_lightbox_add' ) );
		add_submenu_page( 'page_items_lightbox' , 'Editar' , 'Editar' , 'manage_options' , 'page_items_lightbox_edit' , array( $this , 'page_items_lightbox_edit' ) );
		add_submenu_page( 'page_items_lightbox' , 'Borrar' , 'Borrar' , 'manage_options' , 'page_items_lightbox_delete' , array( $this , 'page_items_lightbox_delete' ) );
		
		}
		
	public function page_items_lightbox( $atts ){
		
		$this->autoload('view_admin_items_lightbox_main_page');
		
		}
		
	public function page_items_lightbox_add( $atts ){
		
		$this->autoload('view_admin_items_lightbox_add');
		
		}
		
	public function page_items_lightbox_edit( $atts ){
		
		$this->autoload('view_admin_items_lightbox_edit');
		
		}
				
	public function page_items_lightbox_delete( $atts ){
		
		$this->autoload('view_admin_items_lightbox_delete');
		
		}
	
	}
	