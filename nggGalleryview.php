<?php
/*
Plugin Name: NextGEN Galleryview
Plugin URI: http://bhubbard.github.com/NextGEN-Galleryview/
Description: Add the script files and template for the jQuery Plugin Galleryview integration from Jack Anderson (http://www.spaceforaname.com/galleryview/). Use the shortcode [nggallery id=x template="galleryview"] to show the new layout. Plugin originally created by Alex Rabe.
Author: Alex Rabe, Brandon Hubbard
Author URI: http://brandonhubbard.com/
Version: 1.1.1
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
			// Check theme for template first
			if ( file_exists (TEMPLATEPATH . "/nggallery/gallery-galleryview.php")) {
				$template_name == 'gallery-galleryview';
				$path = TEMPLATEPATH . "/nggallery/gallery-galleryview.php";
				}
			else  {
				$template_name == 'gallery-galleryview';
				$path = WP_PLUGIN_DIR . '/' . plugin_basename( dirname(__FILE__) ) . '/view/gallery-galleryview.php';
				}
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

				// Load Jquery
				wp_enqueue_script('jquery');

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

// ######################
// PressTrends Plugin API
// ######################

	function presstrends_NextGEN_Galleryview_plugin() {

		// PressTrends Account API Key
		$api_key = 'l325qf6uap6dnjrrutams299ajr5zsts8wgr';
		$auth    = 'x4c8n8lypba98pee90wdct12lnnyja238';

		// Start of Metrics
		global $wpdb;
		$data = get_transient( 'presstrends_cache_data' );
		if ( !$data || $data == '' ) {
			$api_base = 'http://api.presstrends.io/index.php/api/pluginsites/update/auth/';
			$url      = $api_base . $auth . '/api/' . $api_key . '/';

			$count_posts    = wp_count_posts();
			$count_pages    = wp_count_posts( 'page' );
			$comments_count = wp_count_comments();

			// wp_get_theme was introduced in 3.4, for compatibility with older versions, let's do a workaround for now.
			if ( function_exists( 'wp_get_theme' ) ) {
				$theme_data = wp_get_theme();
				$theme_name = urlencode( $theme_data->Name );
			} else {
				$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
				$theme_name = $theme_data['Name'];
			}

			$plugin_name = '&';
			foreach ( get_plugins() as $plugin_info ) {
				$plugin_name .= $plugin_info['Name'] . '&';
			}
			// CHANGE __FILE__ PATH IF LOCATED OUTSIDE MAIN PLUGIN FILE
			$plugin_data         = get_plugin_data( __FILE__ );
			$posts_with_comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='post' AND comment_count > 0" );
			$data                = array(
				'url'             => stripslashes( str_replace( array( 'http://', '/', ':' ), '', site_url() ) ),
				'posts'           => $count_posts->publish,
				'pages'           => $count_pages->publish,
				'comments'        => $comments_count->total_comments,
				'approved'        => $comments_count->approved,
				'spam'            => $comments_count->spam,
				'pingbacks'       => $wpdb->get_var( "SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_type = 'pingback'" ),
				'post_conversion' => ( $count_posts->publish > 0 && $posts_with_comments > 0 ) ? number_format( ( $posts_with_comments / $count_posts->publish ) * 100, 0, '.', '' ) : 0,
				'theme_version'   => $plugin_data['Version'],
				'theme_name'      => $theme_name,
				'site_name'       => str_replace( ' ', '', get_bloginfo( 'name' ) ),
				'plugins'         => count( get_option( 'active_plugins' ) ),
				'plugin'          => urlencode( $plugin_name ),
				'wpversion'       => get_bloginfo( 'version' ),
			);

			foreach ( $data as $k => $v ) {
				$url .= $k . '/' . $v . '/';
			}
			wp_remote_get( $url );
			set_transient( 'presstrends_cache_data', $data, 60 * 60 * 24 );
		}
	}

// PressTrends WordPress Action
add_action('admin_init', 'presstrends_NextGEN-Galleryview_plugin');
		