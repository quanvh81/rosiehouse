<?php

function sohohotel_message_shortcode( $atts, $content = null ) {
	
	// type: default / notice / success / fail	
	extract( shortcode_atts( array(
			'type' => '',
		), $atts ) );
	
	if( !isset($atts['type']) ) {
		$class = "default";
	}
	
	else {
		$class = $atts['type'];
	}
	
	return '<div class="sohohotel-msg sohohotel-' . esc_attr($class) . ' clearfix"><p>' . do_shortcode($content) . '</p></div>';

}

add_shortcode( 'sohohotel_msg', 'sohohotel_message_shortcode' );

?>