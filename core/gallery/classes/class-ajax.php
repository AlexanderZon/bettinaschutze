<?php 

/**
 * ELearning admin menu
 *
 * @class 		ClassShortCodes
 * @version		1.0.0
 * @package		ELearning/Classes
 * @category		Class
 * @author 		Alexis Montenegro
 */

class ClassAjax{
	
	/**
	 * ELearning ClassShortcodes Constructor.
	 * @access public
	 * @return void
	 */
	
	public function __construct(){
		
		if ( function_exists( "__autoload" ) ) {
			spl_autoload_register( "__autoload" );
			}
		spl_autoload_register( array( $this, 'autoload' ) );
		
		add_action( 'wp_ajax_gallery_lightbox' , array( $this , 'gallery_lightbox' ) );
		
		}
		
	public function gallery_lightbox( $atts ){

		?>
		
		<h1>Hola Mundo</h1>

		<?php

		die("Listo");
		
		}
		
	public function shortcoder_electivas( $atts ){
		
		$this->autoload('shortcode_electivas');
		
		}
		
	public function shortcoder_inscripciones( $atts ){
		
		$this->autoload('shortcode_inscripciones');
		
		}
		
	public function shortcoder_nuevo_ingreso( $atts ){
		
		$this->autoload('shortcode_nuevo_ingreso');
		
		}

	public $path_template = '/classes/ajax/';
		
	/**
	 * select the template default folder
	 * @access public
	 * @param string $class
 	 * @return string
	 */
		
	public function select_default_folder( ){
		
		global $elearning;
		return $elearning->plugin_path().$this->path_template;
		
		}
		
	/**
	 * autoload the templates files to render 
	 * @access public
	 * @param string $class
 	 * @return void
	 */
	
	public function autoload( $class ){
		
		$class = strtolower( $class );
		if( strpos( $class, 'ajax_' ) === 0 ) {
			$file = str_replace( '_', '-', $class ) . '.php';
			#echo $this->select_default_folder($class).$file.'<br>';
			if ( is_readable( $this->select_default_folder() . $file ) ) {
				#echo $this->select_default_folder($class).$file;
				require( $this->select_default_folder() . $file );
				return;
				}
			else{
				echo "IS NOT READABLE<BR>";
				}
			} 
		
		}
		
	/**
	 * select the template default folder
	 * @access public
	 * @param string $class
 	 * @return void
	 */
	
	public function template_path(){
		
		return plugins_url().$this->path_template;
		
		}
	
	}