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

class ClassShortcodes extends ClassParent{
	
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
		
		add_shortcode( 'elearning_estudiante_profile' , array( $this , 'shortcoder_estudiante_profile' ) );
		add_shortcode( 'elearning_estudiante_record' , array( $this , 'shortcoder_estudiante_record' ) );
		add_shortcode( 'elearning_login' , array( $this , 'shortcoder_login' ) );
		add_shortcode( 'elearning_descargas' , array( $this , 'shortcoder_descargas' ) );
		add_shortcode( 'elearning_solicitudes' , array( $this , 'shortcoder_solicitudes' ) );
		add_shortcode( 'elearning_electivas' , array( $this , 'shortcoder_electivas' ) );
		add_shortcode( 'elearning_muro' , array( $this , 'shortcoder_muro' ) );
		add_shortcode( 'elearning_inscripciones' , array( $this , 'shortcoder_inscripciones' ) );
		add_shortcode( 'elearning_nuevo_ingreso' , array( $this , 'shortcoder_nuevo_ingreso' ) );
		
		}
		
	public function shortcoder_estudiante_profile( $atts ){
		
		$this->autoload('shortcode_estudiante_profile');
		
		} 
		
	public function shortcoder_estudiante_record( $atts ){
		
		echo "Hola Mundo %ESTUDIANTE_RECORD%";
		
		}
		
	public function shortcoder_login( $atts ){
		
		echo "Hola Mundo %LOGIN%";
		
		}
		
	public function shortcoder_descargas( $atts ){
		
		echo "Hola Mundo %DESCARGAS%";
		
		}
		
	public function shortcoder_solicitudes( $atts ){
		
		echo "Hola Mundo %SOLICITUDES%";
		
		}
		
	public function shortcoder_muro( $atts ){
		
		echo "Hola Mundo %MURO%";
		
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

	public $path_template = '/classes/shortcodes/';
		
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
		if( strpos( $class, 'shortcode_' ) === 0 ) {
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