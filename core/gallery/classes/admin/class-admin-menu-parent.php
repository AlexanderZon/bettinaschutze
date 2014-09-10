<?php 

/**
 * ELearning admin menu parent
 *
 * @class 		ClassAdminMenuParent
 * @version		1.0.0
 * @package		ELearning/Classes/Admin
 * @category		Class
 * @author 		Alexis Montenegro
 */


class ClassAdminMenuParent{
	
	/**
	 * @access public
	 * @string
	 */
	
	public $path_template = '/templates/admin/';
	
	/**
	 * @access public
	 * @array
	 */
	 
	public $default_folders = array(
		'gallery',
		'items',
		'videos',
		'photos'
	);
	
	/**
	 * Elearning ClassAdminMenuParent Constructor.
	 * @access public
	 * @return void
	 */
	
	public function __construct(){
		
		if ( function_exists( "__autoload" ) ) {
			spl_autoload_register( "__autoload" );
			}
		spl_autoload_register( array( $this, 'autoload' ) );
		
		}
		
	/**
	 * select the template default folder
	 * @access public
	 * @param string $class
 	 * @return string
	 */
		
	public function select_default_folder( $class ){
		
		global $gallery_lightbox;
		$returned = null;
		foreach($this->default_folders as $value){
			if(is_string(strstr($class,$value))){
				$returned = $value;
				}
			}
		return $gallery_lightbox->plugin_path().$this->path_template.$returned.'/';
		
		}
		
	/**
	 * autoload the templates files to render 
	 * @access public
	 * @param string $class
 	 * @return void
	 */
	
	public function autoload( $class ){
		
		$class = strtolower( $class );
		if( strpos( $class, 'view_admin_' ) === 0 ) {
			$file = str_replace( '_', '-', $class ) . '.php';
			#echo $file;
			#echo $this->select_default_folder($class).$file.'<br>';
			if ( is_readable( $this->select_default_folder($class) . $file ) ) {
				#echo $this->select_default_folder($class).$file;
				require( $this->select_default_folder($class) . $file );
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
		
		return get_template_directory_uri().$this->path_template;
		
		}
	
	}