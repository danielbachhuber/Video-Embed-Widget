<?php
/*
Plugin Name: Video Embed Widget
Plugin URI: http://www.danielbachhuber.com/projects/video-embed-widget/
Description: Embed videos in your sidebar using widgets
Author: Daniel Bachhuber
Version: 0.1
Author URI: http://www.danielbachhuber.com/
*/

define( 'VIDEO_EMBED_WIDGET_FILE_PATH', __FILE__ );
define( 'VIDEO_EMBED_WIDGET_URL', plugins_url(plugin_basename(dirname(__FILE__)) .'/') );
define( 'VIDEO_EMBED_WIDGET_VERSION', '0.1' );

if ( !class_exists('video_embed_widget') ) {

class video_embed_widget {
	
	
	function __construct() {

	}
	
	/**
	 * What we do when WordPress is initialized
	 */ 
	function init() {

		
	}
	
	/**
	 * What we do when the admin is initialized
	 */
	function admin_init() {
		
	}
	
} // END: class video_embed_widget

}

global $video_embed_widget;
$video_embed_widget = new video_embed_widget();

// Core hooks to initialize the plugin
add_action( 'init', array( &$video_embed_widget, 'init' ) );
add_action( 'admin_init', array( &$video_embed_widget, 'admin_init' ) );

?>