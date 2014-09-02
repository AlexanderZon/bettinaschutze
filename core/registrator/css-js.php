<?php

#Frontend
if (!function_exists('css_js_register')) {
	function css_js_register()
	{
        #CSS
    	wp_enqueue_style('default_style', get_bloginfo('stylesheet_url'));
        wp_enqueue_style('core_css', get_template_directory_uri() . '/css/core/core.css');
    	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
		wp_enqueue_style('bootstrap_responsive', get_template_directory_uri() . '/css/bootstrap-responsive.css');
		wp_enqueue_style('plugins', get_template_directory_uri() . '/css/plugins.css');
		wp_enqueue_style('theme', get_template_directory_uri() . '/css/theme.css');
		wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css');
        if (get_theme_option("theme_layout") == "light") {
            wp_enqueue_style('skin', get_template_directory_uri() . '/css/skin_light.css');
        } else {
            wp_enqueue_style('skin', get_template_directory_uri() . '/css/skin_dark.css');
        }
		wp_enqueue_style('fs_gllaery', get_template_directory_uri() . '/css/fs_gllaery.css');
		wp_enqueue_style('core_php', get_template_directory_uri() . '/css/core/core.php');

		#JS
		wp_enqueue_script("jquery");
        wp_enqueue_script(array("jquery-ui-core"));
        wp_enqueue_script('run', get_template_directory_uri() . '/js/run.js');
        wp_enqueue_script('fs_gllaery', get_template_directory_uri() . '/js/fs_gllaery.js');
        wp_enqueue_script('theme', get_template_directory_uri() . '/js/theme.js', array(), false, true);
		wp_enqueue_script('core', get_template_directory_uri() . '/js/core/core.php', array(), false, true);
	}
}
add_action('wp_enqueue_scripts', 'css_js_register');


#Admin
add_action('admin_init', 'admin_init');
function admin_init()
{
	#CSS (MAIN)
	wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/core/admin/css/jquery-ui.css');
	wp_enqueue_style('colorpicker_css', get_template_directory_uri() . '/core/admin/css/colorpicker.css');
	wp_enqueue_style('gallery_css', get_template_directory_uri() . '/core/admin/css/gallery.css');
	wp_enqueue_style('colorbox_css', get_template_directory_uri() . '/core/admin/css/colorbox.css');
	wp_enqueue_style('selectBox_css', get_template_directory_uri() . '/core/admin/css/jquery.selectBox.css');
    wp_enqueue_style('admin_css', get_template_directory_uri() . '/core/admin/css/admin.css');
    #CSS OTHER

	#JS (MAIN)
	wp_enqueue_script('admin_js', get_template_directory_uri() . '/core/admin/js/admin.js');
	wp_enqueue_script('ajaxupload_js', get_template_directory_uri() . '/core/admin/js/ajaxupload.js');
	wp_enqueue_script('colorpicker_js', get_template_directory_uri() . '/core/admin/js/colorpicker.js');
	wp_enqueue_script('gallery_js', get_template_directory_uri() . '/core/admin/js/gallery.js');
	wp_enqueue_script('colorbox_js', get_template_directory_uri() . '/core/admin/js/jquery.colorbox-min.js');
	wp_enqueue_script('selectBox_js', get_template_directory_uri() . '/core/admin/js/jquery.selectBox.js');
	wp_enqueue_script('backgroundPosition_js', get_template_directory_uri() . '/core/admin/js/jquery.backgroundPosition.js');
	wp_enqueue_script(array("jquery-ui-core", "jquery-ui-dialog", "jquery-ui-sortable"));
    #JS OTHER

}

?>