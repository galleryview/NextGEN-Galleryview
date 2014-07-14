<?php
/*!-----------------------------------------------------------------------------------
	
	Plugin Name: NextGEN GalleryView
	Plugin URI: http://www.nextgen-galleryview.com
	Description: Add the script files and template for the jQuery Plugin Galleryview integration from Jack Anderson (http://www.spaceforaname.com/galleryview/). Use the shortcode [nggallery id=x template="galleryview"] to show the new layout. Plugin originally created by Alex Rabe.
	Author: Brandon Hubbard, Alex Rabe
	Author URI: http://brandonhubbard.com/
	Version: 1.3.5
	Text Domain: NextGen-Galleryview
	Domain Path: /languages

-----------------------------------------------------------------------------------*/

if (!class_exists('nggGalleryview')) {
	class nggGalleryview {

		var $plugin_url = false;

		function nggGalleryview() {

			// Define Plugin URL
			$this->plugin_url = WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/';

			// Load Scripts, Styles, and Templates
			add_action('wp_print_styles', array(&$this, 'ngg_galleryview_styles') );
			add_action('wp_print_scripts', array(&$this, 'ngg_galleryview_scripts') );
			add_action('admin_menu', array(&$this,'ngg_galleryview_pages') );
			add_filter('ngg_render_template', array(&$this, 'add_template'), 10, 2);
		}

		// Add our Template
		function add_template( $path, $template_name = false) {
			if ( preg_match('/^gallery-galleryview(-.+)?$/', $template_name) ) {
			   // Check theme for template first
			   if ( file_exists ( get_stylesheet_directory() . "/nggallery/$template_name.php") ) {
				   $galleryviewtemplate = get_stylesheet_directory_uri() . "/nggallery/$template_name.php";
				}
				else  {
				   $galleryviewtemplate = WP_PLUGIN_DIR . '/' . plugin_basename( dirname(__FILE__) ) . '/templates/gallery-galleryview.php';
				}
			}
			return $galleryviewtemplate;
		}


		// GalleryView Styles
		function ngg_galleryview_styles() {

			if ( !is_admin() ) {

			   // Check theme for styles first
			   if ( file_exists  (get_stylesheet_directory() . "/nggallery/css/galleryview.css") ) {
					$galleryviewcss = get_stylesheet_directory_uri() . "/nggallery/css/galleryview.css";
				}

			   else {
					$galleryviewcss = $this->plugin_url . 'galleryview/css/galleryview.min.css';
			   }

				wp_register_style('galleryview-css', $galleryviewcss, false, null, 'all');
				wp_enqueue_style('galleryview-css');
			}
		}
		


		// NextGen-GalleryView Documentation
		function ngg_galleryview_pages(){
			add_submenu_page('nextgen-gallery', 'GalleryView', 'GalleryView', 'manage_options', 'nextgen-galleryview2/documentation.php' );
			}

		// GalleryView Scripts
		function ngg_galleryview_scripts() {

			if ( !is_admin() ) {

				// Load Jquery
				wp_enqueue_script('jquery');

				// jQuery Easing via CDN
				wp_register_script('jquery-easing', '//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', 'jquery', null, true);
				wp_enqueue_script('jquery-easing');

				// jQuery Timers
				wp_register_script('jquery-timers', $this->plugin_url . 'galleryview/js/jquery.timers.min.js', 'jquery', null, true);
				wp_enqueue_script('jquery-timers');

				// jQuery GalleryView
			    // Check theme for script first
			    if ( file_exists (get_stylesheet_directory() . "/nggallery/js/jquery.galleryview.js")) {
					$jspath = get_stylesheet_directory_uri() . "/nggallery/js/jquery.galleryview.js";
				}
				else  {
					$jspath = $this->plugin_url . 'galleryview/js/jquery.galleryview.min.js';
				}
				wp_register_script('jquery-galleryview', $jspath, array('jquery', 'jquery-timers', 'jquery-easing'), null, true);
				wp_enqueue_script('jquery-galleryview');
			}
		}
	}

	// Start this plugin once all other plugins are fully loaded
	add_action( 'plugins_loaded', create_function( '', 'global $nggGalleryview; $nggGalleryview = new nggGalleryview();' ) );

}
