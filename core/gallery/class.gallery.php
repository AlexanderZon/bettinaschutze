<?php

if(!class_exists("GalleryLightbox")){

	class GalleryLightbox{

		public function __construct(){

			if(function_exists('__autoload')){
				spl_autoload_register('__autoload');
			}

			spl_autoload_register( array($this, 'autoload') );

			include_once( $this->plugin_path() . '/class.db.php' );

			$this->initializeAdmin();

			$this->initializeShortcodes();

			$this->initializeAjax();

		}

		public function autoload( $class ){

			$class = strtolower( $class );

			if( strpos( $class, 'class_' ) === 0 ){

				$path = $this->plugin_path().'/classes/';
				$file = str_replace( '_', '-', $class ) . '.php' ;
				if( is_readable( $path . $file ) ){
					include_once( $path . $file );
					return;
				}
				else{
					echo "IS NOT READABLE ".$path . $file;
				}

			}

		}

		public function plugin_path(){
			if( $this->plugin_path ) return $this->plugin_path;
			return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ));
		}

		public function initializeAdmin(){
			$this->autoload('class_admin_menu');
			$object = new ClassAdminMenu();
		}

		public function initializeShortcodes(){
			$this->autoload('class_shortcodes');
			$object = new ClassShortcodes();
		}

		public function initializeAjax(){
			$this->autoload('class_ajax');
			$object = new ClassAjax();
		}

	}

	$GLOBALS['gallery_lightbox'] = new GalleryLightbox();

}