<?php 

if(!class_exists('ClassAdminMenuParent')){
	include_once('class-admin-menu-parent.php');
	}

class ClassAdminMenuVideos extends ClassAdminMenuParent{
	
	public function __construct(){
		
		add_menu_page( 'Videos Lightbox' , 'Videos Lightbox' , 'manage_options' , 'page_video_lightbox' , array( $this , 'page_video_lightbox' ) , '' );
		add_submenu_page( 'page_video_lightbox' , 'Agregar' , 'Agregar' , 'manage_options' , 'page_video_lightbox_add' , array( $this , 'page_video_lightbox_add' ) );
		add_submenu_page( 'page_video_lightbox' , 'Editar' , 'Editar' , 'manage_options' , 'page_video_lightbox_edit' , array( $this , 'page_video_lightbox_edit' ) );
		add_submenu_page( 'page_video_lightbox' , 'Borrar' , 'Borrar' , 'manage_options' , 'page_video_lightbox_delete' , array( $this , 'page_video_lightbox_delete' ) );
		
		}
		
	public function page_video_lightbox( $atts ){
		
		$this->autoload('view_admin_videos_lightbox_main_page');
		
		}
		
	public function page_video_lightbox_add( $atts ){

		if($_POST['verify_video'] == 'add'):

			global $gldb;
		
			$data = $_POST;

			$file = $_FILES['image'];

			$parent = $data['parent'];
				
			$video = array(
				'post_title' => $data['post_title'],
				'post_content' => $data['post_content'],
				'pinged' => $data['pinged']
				);
			
			$id = $gldb->addVideo( $parent, $video );

			if($id):

				$attachment = $this->insert_attachment( $file, $id );

				$video = $gldb->getItem($id);

				$video['post_excerpt'] = $attachment;

				$video = $gldb->updateItem($video);

				if($attachment):
					$msg = 'video_add';
				else:
					$msg = 'video_add_attach_err';
				endif;

			else:

				$msg = 'video_add_err';

			endif;

			wp_redirect( '?page=page_video_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;
			
		endif;
		
		$this->autoload('view_admin_videos_lightbox_add');
		
		}
		
	public function page_video_lightbox_edit( $atts ){

		global $gldb;

		if(isset($_GET['ID']) AND $_GET['ID'] != ''):

			$data = $_GET;

			if(isset($_GET['action']) AND $_GET['action'] == 'hide'):

				$id = $gldb->untrashVideo($data['ID']);

				if($id):
					$msg = 'video_oculted';
				else:
					$msg = 'video_oculted_err';
				endif;

				wp_redirect( '?page=page_video_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'show'):

				$id = $gldb->publishVideo($data['ID']);

				if($id):
					$msg = 'video_visible';
				else:
					$msg = 'video_visible_err';
				endif;

				wp_redirect( '?page=page_video_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'edit'):

				if($_POST['verify_video'] == 'edit'):
				
					$data = $_POST;

					$file = $_FILES['image'];

					return($file);

					$video = $gldb->getVideo($data['ID']);
						
					$video['post_title'] = $data['post_title'];
					$video['post_content'] = $data['post_content'];
					$video['pinged'] = $date['pinged'];

					if($file != null):

						$attachment = $this->insert_attachment( $file, $video['ID'] );
						$video['post_excerpt'] = $attachment;

					endif;

					$id = $gldb->updateVideo($video);
					
					if($id != 0):
						$msg = 'video_update';
					else:
						$msg = 'video_update_err';
					endif;

					wp_redirect( '?page=page_video_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;
					
				endif;
		
				$this->autoload('view_admin_videos_lightbox_edit');

			endif;

		else:

		wp_redirect( '?page=page_video_lightbox&parent='.$data['parent'].'' ); exit;

		endif;
		
		//$this->autoload('view_admin_videos_lightbox_edit');
		
		}
				
	public function page_video_lightbox_delete( $atts ){

		global $gldb;

		if(isset($_GET['ID']) AND $_GET['ID'] != ''):

			$data = $_GET;

			if(isset($_GET['action']) AND $_GET['action'] == 'delete'):

				$id = $gldb->deleteVideo($data['ID']);
					
				if($id != 0):
					$msg = 'video_delete';
				else:
					$msg = 'video_delete_err';
				endif;

				wp_redirect( '?page=page_video_lightbox_delete&parent='.$data['parent'].'&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'untrash'):

				$id = $gldb->untrashVideo($data['ID']);
					
				if($id != 0):
					$msg = 'video_untrash';
				else:
					$msg = 'video_untrash_err';
				endif;

				wp_redirect( '?page=page_video_lightbox_delete&parent='.$data['parent'].'&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'trash'):

				$id = $gldb->trashVideo($data['ID']);
					
				if($id != 0):
					$msg = 'video_trash';
				else:
					$msg = 'video_trash_err';
				endif;

				wp_redirect( '?page=page_video_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;

			elseif(!isset($_GET['action'])):
		
			$this->autoload('view_admin_videos_lightbox_delete');

			endif;

		else:

			$this->autoload('view_admin_videos_lightbox_delete');

		endif;
		
		//$this->autoload('view_admin_videos_lightbox_delete');
		
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
	