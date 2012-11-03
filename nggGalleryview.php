<?php
/*
Plugin Name: NextGEN Galleryview
Plugin URI: https://github.com/bhubbard/NextGEN-Galleryview
Description: Add the script files and template for the jQuery Plugin Galleryview integration from Jack Anderson (http://www.spaceforaname.com/galleryview/). Use the shortcode [nggallery id=x template="galleryview"] to show the new layout.
Author: Alex Rabe, Brandon Hubbard
Author URI: http://brandonhubbard.com/
Version: 1.1
*/

if (!class_exists('nggGalleryview')) {
	class nggGalleryview {

		var $plugin_url = false;

		function nggGalleryview() {

			// Define Plugin URL
			$this->plugin_url = WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/';

			// Load Scripts, Styles, and Templates
			add_action('wp_print_scripts', array(&$this, 'ngg_galleryview_scripts') );
			add_action('wp_print_styles', array(&$this, 'ngg_galleryview_styles') );
			add_filter('ngg_render_template', array(&$this, 'add_template'), 10, 2);
		}

		// Add our Template
		function add_template( $path, $template_name = false) {
			if ($template_name == 'gallery-galleryview')
				$path = WP_PLUGIN_DIR . '/' . plugin_basename( dirname(__FILE__) ) . '/view/gallery-galleryview.php';
			return $path;
		}

		// GalleryView Styles
		function ngg_galleryview_styles() {
			if ( !is_admin() ) { // we do not want our styles to load in the dashboard
				wp_enqueue_style('galleryview', $this->plugin_url . '/galleryview/css/galleryview.css', false, null, 'all');
			}
		}

		// GalleryView Scripts
		function ngg_galleryview_scripts() {

			if ( !is_admin() ) { // we do not want our scripts to load in the dashboard

				// jQuery Easing via CDN
				wp_register_script('jquery-easing', 'http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', 'jquery', null, false);
				wp_enqueue_script('jquery-easing');

				// jQuery Timers
				wp_register_script('jquery-timers', $this->plugin_url . '/galleryview/js/jquery.timers.js', 'jquery', null, false);
				wp_enqueue_script('jquery-timers');

				// jQuery GalleryView
				wp_register_script('jquery-galleryview', $this->plugin_url . '/galleryview/js/jquery.galleryview.js', array('jquery', 'jquery-timers', 'jquery-easing'), null, false);
				wp_enqueue_script('jquery-galleryview');
			}
		}
	}

	// Start this plugin once all other plugins are fully loaded
	add_action( 'plugins_loaded', create_function( '', 'global $nggGalleryview; $nggGalleryview = new nggGalleryview();' ) );

}