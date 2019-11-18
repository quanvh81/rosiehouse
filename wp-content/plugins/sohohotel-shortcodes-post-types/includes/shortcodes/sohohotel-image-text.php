<?php

function sohohotel_image_text_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'type' => '',
		'image' => '',
		'title' => '',
		'button_text' => '',
		'button_url' => '',
		'button_target' => ''
	), $atts ) );
	
	if ( $button_target == '2' ) {
		$button_target_val = '';
	} else {
		$button_target_val = ' target="_blank"';
	}
	
	if ( $type == '2' ) {
		$type_val = '';
	} else {
		$type_val = 'sohohotel-about-us-block-wrapper-right-align-image';
	}
	
	$output = '<section class="sohohotel-about-us-block-wrapper sohohotel-clearfix ' . $type_val . '">';
	$output .= '<div class="sohohotel-image-wrapper" style="background:url(' . wp_get_attachment_image_url( $image, 'full-image') . ') no-repeat center top;">';
	$output .= '<img src="' . wp_get_attachment_image_url( $image, 'full-image') . '" alt="" />';
	$output .= '</div>';
	$output .= '<div class="sohohotel-about-us-block">';
	$output .= '<h3>' . $title . '</h3>';
	$output .= '<p>' . $content . '</p>';
	$output .= '<a' . $button_target_val . ' href="' . $button_url . '" class="sohohotel-about-us-block-button">' . $button_text . '<i class="fa fa-angle-right"></i></a>';
	$output .= '</div>';
	$output .= '</section>';
	return $output;
	
}

add_shortcode( 'sohohotel_image_text', 'sohohotel_image_text_shortcode' );

?>