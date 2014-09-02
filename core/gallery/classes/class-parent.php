<?php 

class ClassParent{
	
	/**
	 * @access public
	 * @string
	 */
	
	public $admin_class_path;
	
	/**
	 * ELearning AdminMEnu Constructor.
	 * @access public
	 * @return void
	 */
	 
	public function __construct(){
		
		global $elearning;
		
		if ( function_exists( "__autoload" ) ) {
			spl_autoload_register( "__autoload" );
			}
		spl_autoload_register( array( $this, 'autoload' ) );
		 
		}
	
	/**
	 * Auto-load ELearning admin classes on demand to reduce memory consumption.
	 * @access public
	 * @param mixed $class
	 * @return void
	 */
	
	public function autoload( $class ){
		
		$class = strtolower( $class );
		if( strpos( $class, 'class_admin_' ) === 0 ) {
			$this->admin_class_path = $this->plugin_path().'/admin/';
			$file = str_replace( '_', '-', $class ) . '.php';
			if ( is_readable( $this->admin_class_path . $file ) ) {
				include_once( $this->admin_class_path . $file );
				return;
				}
			}
		
		if( strpos( $class, 'class_shortcode_' ) === 0 ) {
			$this->admin_class_path = $this->plugin_path().'/shortcodes/';
			$file = str_replace( '_', '-', $class ) . '.php';
			if ( is_readable( $this->admin_class_path . $file ) ) {
				include_once( $this->admin_class_path . $file );
				return;
				}
			}

		}
		
	/**
	 * Get the plugin admin path.
	 * @access public
	 * @param void
	 * @return string
	 */
		
	public function plugin_path() {
			if ( $this->plugin_path ) return $this->plugin_path;
			return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
		}
	
	}