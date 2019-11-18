<?php

function sohohotel_icon_text_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'type' => '',
		'icon1' => '',
		'title1' => '',
		'content1' => '',
		'icon2' => '',
		'title2' => '',
		'content2' => '',
		'icon3' => '',
		'title3' => '',
		'content3' => '',
		'icon4' => '',
		'title4' => '',
		'content4' => '',
	), $atts ) );
	
	if ( $type == '2' ) {
		$type = '2';
	} else {
		$type = '1';
	}
	
	$output = '<section class="sohohotel-icon-text-wrapper-' . $type . ' sohohotel-clearfix">';
	
	if ( $icon1 ) {
		$output .= '<div class="sohohotel-icon-text-block sohohotel-clearfix">
		<div class="sohohotel-icon"><i class="fa ' . $icon1 . '"></i></div>
		<div class="sohohotel-text">
			<h4>' . $title1 . '</h4>
			<p>' . $content1 . '</p>
		</div>
		</div>';
	}
	
	if ( $icon2 ) {
		$output .= '<div class="sohohotel-icon-text-block sohohotel-clearfix">
		<div class="sohohotel-icon"><i class="fa ' . $icon2 . '"></i></div>
		<div class="sohohotel-text">
			<h4>' . $title2 . '</h4>
			<p>' . $content2 . '</p>
		</div>
		</div>';
	}

	if ( $icon3 ) {
		$output .= '<div class="sohohotel-icon-text-block sohohotel-clearfix">
		<div class="sohohotel-icon"><i class="fa ' . $icon3 . '"></i></div>
		<div class="sohohotel-text">
			<h4>' . $title3 . '</h4>
			<p>' . $content3 . '</p>
		</div>
		</div>';
	}

	if ( $icon4 ) {
		$output .= '<div class="sohohotel-icon-text-block sohohotel-clearfix">
		<div class="sohohotel-icon"><i class="fa ' . $icon4 . '"></i></div>
		<div class="sohohotel-text">
			<h4>' . $title4 . '</h4>
			<p>' . $content4 . '</p>
		</div>
		</div>';
	}

	$output .= '</section>';
	
	return $output;
	
}

add_shortcode( 'sohohotel_icon_text', 'sohohotel_icon_text_shortcode' );

?>