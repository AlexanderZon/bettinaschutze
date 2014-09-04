<?php 

if(!class_exists('ClassAdminMenuParent')){
	include_once('class-admin-menu-parent.php');
	}

class ClassAdminMenuGallery extends ClassAdminMenuParent{
	
	public function __construct(){
		
		add_menu_page( 'Gallery Lightbox' , 'Gallery Lightbox' , 'manage_options' , 'page_gallery_lightbox' , array( $this , 'page_gallery_lightbox' ) , '' );
		add_submenu_page( 'page_gallery_lightbox' , 'Agregar' , 'Agregar' , 'manage_options' , 'page_gallery_lightbox_add' , array( $this , 'page_gallery_lightbox_add' ) );
		add_submenu_page( 'page_gallery_lightbox' , 'Editar' , 'Editar' , 'manage_options' , 'page_gallery_lightbox_edit' , array( $this , 'page_gallery_lightbox_edit' ) );
		add_submenu_page( 'page_gallery_lightbox' , 'Papelera' , 'Papelera' , 'manage_options' , 'page_gallery_lightbox_delete' , array( $this , 'page_gallery_lightbox_delete' ) );
		
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
					$msg = 'gallery_oculted';
				else:
					$msg = 'gallery_oculted_err';
				endif;

				wp_redirect( '?page=page_gallery_lightbox&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'show'):

				$gallery = $gldb->publishGallery($data['ID']);

				if($gallery):
					$msg = 'gallery_visible';
				else:
					$msg = 'gallery_visible_err';
				endif;

				wp_redirect( '?page=page_gallery_lightbox&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'edit'):

				if($_POST['verify_gallery'] == 'edit'):
				
					$data = $_POST;

					$gallery = $gldb->getGallery($data['ID']);
						
					$gallery['post_title'] = $data['post_title'];

					$id = $gldb->updateGallery($gallery);
					
					if($id != 0):
						$msg = 'gallery_update';
					else:
						$msg = 'gallery_update_err';
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

		global $gldb;

		if(isset($_GET['ID']) AND $_GET['ID'] != ''):

			$data = $_GET;

			if(isset($_GET['action']) AND $_GET['action'] == 'delete'):

				$id = $gldb->deleteGallery($data['ID']);
					
				if($id != 0):
					$msg = 'gallery_delete';
				else:
					$msg = 'gallery_delete_err';
				endif;

				wp_redirect( '?page=page_gallery_lightbox_delete&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'untrash'):

				$id = $gldb->untrashGallery($data['ID']);
					
				if($id != 0):
					$msg = 'gallery_untrash';
				else:
					$msg = 'gallery_untrash_err';
				endif;

				wp_redirect( '?page=page_gallery_lightbox_delete&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'trash'):

				$id = $gldb->trashGallery($data['ID']);
					
				if($id != 0):
					$msg = 'gallery_trash';
				else:
					$msg = 'gallery_trash_err';
				endif;

				wp_redirect( '?page=page_gallery_lightbox&msg='.$msg ); exit;

			elseif(!isset($_GET['action'])):
		
			$this->autoload('view_admin_gallery_lightbox_delete');

			endif;

		else:

			$this->autoload('view_admin_gallery_lightbox_delete');

		endif;
		
		}
	
	}
	