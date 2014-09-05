<?php 

if(!class_exists('ClassAdminMenuParent')){
	include_once('class-admin-menu-parent.php');
	}

class ClassAdminMenuPhotos extends ClassAdminMenuParent{
	
	public function __construct(){
		
		add_menu_page( 'Photos Lightbox' , 'Photos Lightbox' , 'manage_options' , 'page_photo_lightbox' , array( $this , 'page_photo_lightbox' ) , '' );
		add_submenu_page( 'page_photo_lightbox' , 'Agregar' , 'Agregar' , 'manage_options' , 'page_photo_lightbox_add' , array( $this , 'page_photo_lightbox_add' ) );
		add_submenu_page( 'page_photo_lightbox' , 'Editar' , 'Editar' , 'manage_options' , 'page_photo_lightbox_edit' , array( $this , 'page_photo_lightbox_edit' ) );
		add_submenu_page( 'page_photo_lightbox' , 'Borrar' , 'Borrar' , 'manage_options' , 'page_photo_lightbox_delete' , array( $this , 'page_photo_lightbox_delete' ) );
		
		}
		
	public function page_photo_lightbox( $atts ){
		
		$this->autoload('view_admin_photos_lightbox_main_page');
		
		}
		
	public function page_photo_lightbox_add( $atts ){

		if($_POST['verify_photo'] == 'add'):

			global $gldb;
		
			$data = $_POST;

			$file = $_FILES['image'];

			$parent = $data['parent'];
				
			$photo = array(
				'post_title' => $data['post_title'],
				'post_content' => $data['post_content']
				);
			
			$id = $gldb->addPhoto( $parent, $photo );

			if($id):

				$attachment = $this->insert_attachment( $file, $id );

				$photo = $gldb->getPhoto($id);

				$photo['post_excerpt'] = $attachment;

				$photo = $gldb->updatePhoto($photo);

				if($attachment):
					$msg = 'photo_add';
				else:
					$msg = 'photo_add_attach_err';
				endif;

			else:

				$msg = 'photo_add_err';

			endif;

			wp_redirect( '?page=page_photo_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;
			
		endif;
		
		$this->autoload('view_admin_photos_lightbox_add');
		
		}
		
	public function page_photo_lightbox_edit( $atts ){

		global $gldb;

		if(isset($_GET['ID']) AND $_GET['ID'] != ''):

			$data = $_GET;

			if(isset($_GET['action']) AND $_GET['action'] == 'hide'):

				$id = $gldb->untrashPhoto($data['ID']);

				if($id):
					$msg = 'photo_oculted';
				else:
					$msg = 'photo_oculted_err';
				endif;

				wp_redirect( '?page=page_photo_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'show'):

				$id = $gldb->publishPhoto($data['ID']);

				if($id):
					$msg = 'photo_visible';
				else:
					$msg = 'photo_visible_err';
				endif;

				wp_redirect( '?page=page_photo_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'edit'):

				if($_POST['verify_item'] == 'edit'):
				
					$data = $_POST;

					$photo = $gldb->getPhoto($data['ID']);
						
					$photo['post_title'] = $data['post_title'];
					$photo['post_content'] = $data['post_content'];

					$id = $gldb->updatePhoto($photo);
					
					if($id != 0):
						$msg = 'photo_update';
					else:
						$msg = 'photo_update_err';
					endif;

					wp_redirect( '?page=page_photo_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;
					
				endif;
		
				$this->autoload('view_admin_items_lightbox_edit');

			endif;

		else:

		wp_redirect( '?page=page_photo_lightbox&parent='.$data['parent'].'' ); exit;

		endif;
		
		//$this->autoload('view_admin_photos_lightbox_edit');
		
		}
				
	public function page_photo_lightbox_delete( $atts ){
		
		$this->autoload('view_admin_photos_lightbox_delete');
		
		}

	public function insert_attachment( $file, $parent ){

		$filedata = $this->upload_image_from_form( $file );

		$attachment = array(
			'guid'           => $filedata['url'], 
			'post_mime_type' => $filedata['type'],
			'post_title'     => '',
			'post_content'   => '',
			'post_status'    => 'inherit'
		);

		$attach_id = wp_insert_attachment( $attachment, $filedata['file'], $parent );

		require_once( ABSPATH . 'wp-admin/includes/image.php' );

		$attach_data = wp_generate_attachment_metadata( $attach_id, $filedata['file'] );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		return $attach_id;

	}

	public function upload_image_from_form( $file ){

		if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
			$uploadedfile = $file;
			$upload_overrides = array( 'test_form' => false );
			$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
			if ( !isset($movefile['error']) ):
			    return $movefile;
			else:
			    return false;
			endif;

		}
	
	}
	