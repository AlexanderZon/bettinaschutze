<?php 

if(!class_exists('ClassAdminMenuParent')){
	include_once('class-admin-menu-parent.php');
	}

class ClassAdminMenuBio extends ClassAdminMenuParent{
	
	public function __construct(){
		
		add_menu_page( 'Bio' , 'Bio' , 'manage_options' , 'page_bio' , array( $this , 'page_bio' ) , '' );
		
		}
		
	public function page_bio( $atts ){
		
		$this->autoload('view_admin_bio_main_page');
		
		}
	
	}
	