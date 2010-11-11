<?php
/*
Plugin Name: Video Embed Widget
Plugin URI: http://www.danielbachhuber.com/projects/video-embed-widget/
Description: Embed videos in your sidebar using widgets. Powered by Embed.ly!
Author: Daniel Bachhuber
Version: 0.1
Author URI: http://www.danielbachhuber.com/
*/

define( 'VIDEO_EMBED_WIDGET_FILE_PATH', __FILE__ );
define( 'VIDEO_EMBED_WIDGET_URL', plugins_url(plugin_basename(dirname(__FILE__)) .'/') );
define( 'VIDEO_EMBED_WIDGET_VERSION', '0.1' );

if ( !class_exists( 'Video_Embed_Widget' ) ) {

/**
 * Establish our widget class
 */
class Video_Embed_Widget extends WP_Widget {

	/**
	 * Register the widget class with WordPress
	 */
	function Video_Embed_Widget() {
		
		$widget_options = array(
							'classname' => 'video_embed_widget',
							'description' => 'Automagically embed videos in your sidebar',
						);
						
		$control_options = array(
							'width' => 300,
							'height' => 350,
							'id_base' => 'video_embed_widget',
						);
		
		// Instantiate the widget				
		$this->WP_Widget( 'Video_Embed_Widget', 'Video Embed Widget', $widget_options, $control_options );
		
	}
	
	/**
	 * Settings form for each widget
	 */
	function form( $instance ) {
		
		extract( $instance );
		
		$title = ( isset( $title ) ) ? $title : '';
		$url = ( isset( $url ) ) ? $url : '';		
		$max_height = ( isset( $max_height ) ) ? $max_height : '';
		$max_width = ( isset( $max_width ) ) ? $max_width : '';
		
		// Title
		echo '<p><label for="' . $this->get_field_name( 'title' ) . '">Title:</label><br />'
				. '<input type="text" class="widefat" id="' . $this->get_field_id( 'title' )
				. '" name="' . $this->get_field_name( 'title' ) . '" value="' . $title . '" /></p>';
				
		// URL
		echo '<p><label for="' . $this->get_field_name( 'url' ) . '">URL:</label><br />'
				. '<input type="text" class="widefat" id="' . $this->get_field_id( 'url' )
				. '" name="' . $this->get_field_name( 'url' ) . '" value="' . $url . '" />'
				. '<span class="description">Paste your oEmbed-enabled video URL (@todo Link to providers)</span>'
				. '</p>';
				
		// Max height and width
		echo '<p><label for="' . $this->get_field_name( 'max_height' ) . '">Max height:</label> '
				. '<input type="text" size="3" maxlength="3" id="' . $this->get_field_id( 'max_height' )
				. '" name="' . $this->get_field_name( 'max_height' ) . '" value="' . $max_height . '" />&nbsp;&nbsp;'
				. '<label for="' . $this->get_field_name( 'max_width' ) . '">Max width:</label> '
				. '<input type="text" size="3" maxlength="3" id="' . $this->get_field_id( 'max_width' )
						. '" name="' . $this->get_field_name( 'max_width' ) . '" value="' . $max_width . '" /></p>';
		
	}
	
	/**
	 * Handle POST requests with new settings
	 */
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['url'] = strip_tags( $new_instance['url'] );
		$instance['max_height'] = (int) $new_instance['max_height'];
		$instance['max_width'] = (int) $new_instance['max_width'];		
		
		return $instance;
		
	}
	
	/**
	 * Prepare the public-facing widget
	 */
	function widget( $args, $instance ) {
		
		extract( $args );
		extract( $instance );
		
		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;	
		}
		
		// @todo display the embed code
		
		echo $after_widget;
		
	}

	
} // END: class Video_Embed_Widget

} // END: !class_exists('Video_Embed_Widget')

/**
 * Register our widget when widgets are loaded
 */
function video_embed_widget_load() {
	register_widget( 'Video_Embed_Widget' );
}
add_action( 'widgets_init', 'video_embed_widget_load' );

global $video_embed_widget;
$video_embed_widget = new video_embed_widget();

?>