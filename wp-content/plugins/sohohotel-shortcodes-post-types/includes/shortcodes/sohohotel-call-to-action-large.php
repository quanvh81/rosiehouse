<?php

function sohohotel_call_to_action_large_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'background_url' => '',
		'title' => '',
		'text' => '',
		'button_text' => '',
		'button_url' => ''
	), $atts ) );
	
	$output = '<section class="sohohotel-clearfix sohohotel-call-to-action-2-section" style="background:url(' . wp_get_attachment_image_url( $background_url, 'full-image') . ') no-repeat center top;">

		<div class="sohohotel-call-to-action-2-section-inner">

			<h3>' . $title . '</h3>
			<p>' . $text . '</p>
			<a href="' . $button_url . '" class="sohohotel-button0">' . $button_text . '<i class="fa fa-angle-right"></i></a>

		</div>
		
	</section>';

	return $output;
	
}

add_shortcode( 'sohohotel_call_to_action_large', 'sohohotel_call_to_action_large_shortcode' );

?>