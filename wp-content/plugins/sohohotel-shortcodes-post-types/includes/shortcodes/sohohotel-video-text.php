<?php

function sohohotel_video_text_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'title' => '',
		'text' => '',
		'image' => '',
		'button_text' => '',
		'button_url' => '',
		'button_target' => '',
		'video_url' => ''
	), $atts ) );
	
	if ( $button_target == '2' ) {
		$button_target_val = '';
	} else {
		$button_target_val = 'target="_blank"';
	}
	
	$output = '<section class="sohohotel-about-us-video-wrapper sohohotel-clearfix">
		<div class="sohohotel-about-us-block">
	<h3>' . $title . '</h3><p>' . $text . '</p><a ' . $button_target_val . ' href="' . $button_url . '" class="sohohotel-about-us-block-button">' . $button_text . '<i class="fa fa-angle-right"></i></a>
	</div>
	<div class="sohohotel-image-wrapper" style="background:url(' . wp_get_attachment_image_url( $image, 'full-image') . ') no-repeat center top;">
	<img src="' . wp_get_attachment_image_url( $image, 'full-image') . '" alt="" />
	<div class="sohohotel-video-play">
	<a href="' . $video_url . '" data-gal="prettyPhoto"><i class="fa fa-play"></i></a>
	</div>
	</div>
	</section>';
		
	return $output;
	
}

add_shortcode( 'sohohotel_video_text', 'sohohotel_video_text_shortcode' );

?>