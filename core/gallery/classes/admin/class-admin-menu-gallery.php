<?php 

if(!class_exists('ClassAdminMenuParent')){
	include_once('class-admin-menu-parent.php');
	}

class ClassAdminMenuGallery extends ClassAdminMenuParent{
	
	public function __construct(){
		
		add_menu_page( 'Gallery Lightbox' , 'Gallery Lightbox' , 'manage_options' , 'page_gallery_lightbox' , array( $this , 'page_gallery_lightbox' ) , '' );
		add_submenu_page( 'page_gallery_lightbox' , 'Agregar' , 'Agregar' , 'manage_options' , 'page_gallery_lightbox_add' , array( $this , 'page_gallery_lightbox_add' ) );
		add_submenu_page( 'page_gallery_lightbox' , 'Editar' , 'Editar' , 'manage_options' , 'page_gallery_lightbox_edit' , array( $this , 'page_gallery_lightbox_edit' ) );
		add_submenu_page( 'page_gallery_lightbox' , 'Borrar' , 'Borrar' , 'manage_options' , 'page_gallery_lightbox_delete' , array( $this , 'page_gallery_lightbox_delete' ) );
		
		}
		
	public function page_gallery_lightbox( $atts ){
		
		$this->autoload('view_admin_gallery_lightbox_main_page');
		
		}
		
	public function page_gallery_lightbox_add( $atts ){
		
		$this->autoload('view_admin_gallery_lightbox_add');
		
		}
		
	public function page_gallery_lightbox_edit( $atts ){

				echo "EDIT";

		if(isset($_GET['ID']) AND $_GET['ID'] != ''):

				echo "ID";

			$data = $_GET;

			if(isset($_GET['action']) AND $_GET['action'] == 'hide'):

				echo "HIDE";

				global $gldb;

				$gallery = $gldb->getGallery($data['ID']);
				$gallery['post_status'] = 'draft';
				$gallery = $gldb->updateGallery($gallery);
		
				$this->autoload('view_admin_gallery_lightbox_main_page');

			elseif(isset($_GET['action']) AND $_GET['action'] == 'show'):

				echo "SHOW";

				global $gldb;

				$gallery = $gldb->getGallery($data['ID']);

				echo "cachted";
				
				$gallery['post_status'] = 'publish';

				echo "published";
				
				$gallery = $gldb->updateGallery($gallery);

				echo "updated";
		
				$this->autoload('view_admin_gallery_lightbox_main_page');

			elseif(!isset($_GET['action'])):
		
				$this->autoload('view_admin_gallery_lightbox_edit');

			endif;

		else:
		
			$this->autoload('view_admin_gallery_lightbox_main_page');

		endif;
		
		}
				
	public function page_gallery_lightbox_delete( $atts ){
		
		$this->autoload('view_admin_gallery_lightbox_delete');
		
		}
	
	}
	