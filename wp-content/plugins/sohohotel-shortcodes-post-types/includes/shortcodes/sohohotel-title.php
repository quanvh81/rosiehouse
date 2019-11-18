<?php

function sohohotel_title_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
			'type' => '',
			'title1' => '',
			'title2' => '',
			'text_color' => ''
		), $atts ) );
	
	$output = '';
	
	if ($type == 'title2') {
		
		$output .= '<div class="sohohotel-title2 sohohotel-title-color' . $text_color . '">';
		$output .= '<h3>' . $title1 . '</h3>';
		$output .= '</div>';
		
	} elseif ($type == 'title3') {
		
		$output .= '<div class="sohohotel-title3 sohohotel-title-color' . $text_color . '">';
		$output .= '<h4>' . $title1 . '</h4>';
		$output .= '</div>';
		
	} else {
		
		$output .= '<div class="sohohotel-title1 sohohotel-title-color' . $text_color . '">';
		$output .= '<h1>' . $title1 . '</h1>';
		$output .= '<h3>' . $title2 . '</h3>';
		$output .= '</div>';
		
	}
	
	return $output;
	
}

add_shortcode( 'sohohotel_title', 'sohohotel_title_shortcode' );

?>