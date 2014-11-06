<?php 

if(!class_exists('ClassAdminMenuParent')){
	include_once('class-admin-menu-parent.php');
	}

class ClassAdminMenuItems extends ClassAdminMenuParent{
	
	public function __construct(){
		
		add_menu_page( 'Items Lightbox' , 'Items Lightbox' , 'manage_options' , 'page_item_lightbox' , array( $this , 'page_item_lightbox' ) , '' );
		add_submenu_page( 'page_item_lightbox' , 'Agregar' , 'Agregar' , 'manage_options' , 'page_item_lightbox_add' , array( $this , 'page_item_lightbox_add' ) );
		add_submenu_page( 'page_item_lightbox' , 'Editar' , 'Editar' , 'manage_options' , 'page_item_lightbox_edit' , array( $this , 'page_item_lightbox_edit' ) );
		add_submenu_page( 'page_item_lightbox' , 'Borrar' , 'Borrar' , 'manage_options' , 'page_item_lightbox_delete' , array( $this , 'page_item_lightbox_delete' ) );
		
		}
		
	public function page_item_lightbox( $atts ){
		
		$this->autoload('view_admin_items_lightbox_main_page');
		
		}
		
	public function page_item_lightbox_add( $atts ){

		if($_POST['verify_item'] == 'add'):

			global $gldb;
		
			$data = $_POST;

			$file = $_FILES['image'];

			$parent = $data['parent'];
				
			$item = array(
				'post_title' => $data['post_title'],
				'post_content' => $data['post_content']
				);
			
			$id = $gldb->addItem( $parent, $item );

			if($id):

				$attachment = $this->insert_attachment( $file, $id );

				$item = $gldb->getItem($id);

				$item['post_excerpt'] = $attachment;

				$item = $gldb->updateItem($item);

				if($attachment):
					$msg = 'item_add';
				else:
					$msg = 'item_add_attach_err';
				endif;

			else:

				$msg = 'item_add_err';

			endif;

			wp_redirect( '?page=page_item_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;
			
		endif;
		
		$this->autoload('view_admin_items_lightbox_add');
		
		}
		
	public function page_item_lightbox_edit( $atts ){

		global $gldb;

		if(isset($_GET['ID']) AND $_GET['ID'] != ''):

			$data = $_GET;

			if(isset($_GET['action']) AND $_GET['action'] == 'hide'):

				$id = $gldb->untrashItem($data['ID']);

				if($id):
					$msg = 'item_oculted';
				else:
					$msg = 'item_oculted_err';
				endif;

				wp_redirect( '?page=page_item_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'show'):

				$id = $gldb->publishItem($data['ID']);

				if($id):
					$msg = 'item_visible';
				else:
					$msg = 'item_visible_err';
				endif;

				wp_redirect( '?page=page_item_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'up'):

				$id = $gldb->upItem($data['ID']);

				if($id):
					$msg = 'item_upped';
				else:
					$msg = 'item_upped_err';
				endif;

				wp_redirect( '?page=page_item_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'down'):

				$id = $gldb->downItem($data['ID']);
				
				if($id):
					$msg = 'item_downed';
				else:
					$msg = 'item_downed_err';
				endif;

				wp_redirect( '?page=page_item_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;


			elseif(isset($_GET['action']) AND $_GET['action'] == 'edit'):

				if($_POST['verify_item'] == 'edit'):
				
					$data = $_POST;

					$item = $gldb->getItem($data['ID']);
						
					$item['post_title'] = $data['post_title'];
					$item['post_content'] = $data['post_content'];

					$id = $gldb->updateItem($item);
					
					if($id != 0):
						$msg = 'item_update';
					else:
						$msg = 'item_update_err';
					endif;

					wp_redirect( '?page=page_item_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;
					
				endif;
		
				$this->autoload('view_admin_items_lightbox_edit');

			endif;

		else:

		wp_redirect( '?page=page_item_lightbox&parent='.$data['parent'].'' ); exit;

		endif;
		
		//$this->autoload('view_admin_items_lightbox_edit');
		
		}
				
	public function page_item_lightbox_delete( $atts ){

		global $gldb;

		if(isset($_GET['ID']) AND $_GET['ID'] != ''):

			$data = $_GET;

			if(isset($_GET['action']) AND $_GET['action'] == 'delete'):

				$id = $gldb->deleteItem($data['ID']);
					
				if($id != 0):
					$msg = 'item_delete';
				else:
					$msg = 'item_delete_err';
				endif;

				wp_redirect( '?page=page_item_lightbox_delete&parent='.$data['parent'].'&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'untrash'):

				$id = $gldb->untrashItem($data['ID']);
					
				if($id != 0):
					$msg = 'item_untrash';
				else:
					$msg = 'item_untrash_err';
				endif;

				wp_redirect( '?page=page_item_lightbox_delete&parent='.$data['parent'].'&msg='.$msg ); exit;

			elseif(isset($_GET['action']) AND $_GET['action'] == 'trash'):

				$id = $gldb->trashItem($data['ID']);
					
				if($id != 0):
					$msg = 'item_trash';
				else:
					$msg = 'item_trash_err';
				endif;

				wp_redirect( '?page=page_item_lightbox&parent='.$data['parent'].'&msg='.$msg ); exit;

			elseif(!isset($_GET['action'])):
		
			$this->autoload('view_admin_items_lightbox_delete');

			endif;

		else:

			$this->autoload('view_admin_items_lightbox_delete');

		endif;
		
		//$this->autoload('view_admin_items_lightbox_delete');
		
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
	