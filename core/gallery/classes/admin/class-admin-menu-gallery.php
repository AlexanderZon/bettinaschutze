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

		global $gldb;

		if(isset($_GET['ID']) AND $_GET['ID'] != ''):

			$data = $_GET;

			if(isset($_GET['action']) AND $_GET['action'] == 'hide'):

				$gallery = $gldb->untrashGallery($data['ID']);

				if($gallery):
					$msg = $gldb->msg['gallery_oculted'];
				else:
					$msg = $gldb->msg['gallery_oculted_err'];
				endif;

				wp_redirect( '?page=page_gallery_lightbox&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'show'):

				$gallery = $gldb->publishGallery($data['ID']);

				if($gallery):
					$msg = $gldb->msg['gallery_visible'];
				else:
					$msg = $gldb->msg['gallery_visible_err'];
				endif;

				wp_redirect( '?page=page_gallery_lightbox&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'edit'):

				if($_POST['verify_gallery'] == 'edit'):
				
					$data = $_POST;

					$gallery = $gldb->getGallery($data['ID']);
						
					$gallery['post_title'] = $data['post_title'];

					$id = $gldb->updateGallery($gallery);
					
					if($id != 0):
						$msg = $gldb->msg['gallery_update'];
					else:
						$msg = $gldb->msg['gallery_update_err'];
					endif;

					wp_redirect( '?page=page_gallery_lightbox&msg='.$msg ); exit;
					
				endif;
		
				$this->autoload('view_admin_gallery_lightbox_edit');

			endif;

		else:

			wp_redirect( '?page=page_gallery_lightbox' ); exit;
		
			//$this->autoload('view_admin_gallery_lightbox_main_page');

		endif;
		
		}
				
	public function page_gallery_lightbox_delete( $atts ){

		if(isset($_GET['ID']) AND $_GET['ID'] != ''):

			$data = $_GET;

			if(isset($_GET['action']) AND $_GET['action'] == 'delete'):

				global $gldb;

				$gallery = $gldb->deleteGallery($data['ID']);
		
				$this->autoload('view_admin_gallery_lightbox_main_page');

			elseif(isset($_GET['action']) AND $_GET['action'] == 'untrash'):

				global $gldb;

				$gallery = $gldb->untrashGallery($data['ID']);
		
				$this->autoload('view_admin_gallery_lightbox_main_page');

			elseif(!isset($_GET['action'])):
		
			$this->autoload('view_admin_gallery_lightbox_delete');

			endif;

		else:

			wp_redirect( '?page=page_gallery_lightbox' ); exit;
		
			//$this->autoload('view_admin_gallery_lightbox_main_page');

		endif;
		
		}
	
	}
	