<?php

function sohohotel_contact_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
			'type' => '',
			'address' => '',
			'phone' => '',
			'email' => ''
		), $atts ) );
	
	if ( $type == '2' ) {
		$output = '<ul class="sohohotel-contact-details-list sohohotel-contact-details-list-2">';
	} else {
		$output = '<ul class="sohohotel-contact-details-list">';
	}
	
	if( isset($atts['address']) ) {
		$output .= '<li class="sohohotel-address clearfix">' . $atts['address'] . '</li>';
	}
	
	if( isset($atts['phone']) ) {
		$output .= '<li class="sohohotel-phone clearfix">' . $atts['phone'] . '</li>';
	}
	
	if( isset($atts['email']) ) {
		$output .= '<li class="sohohotel-email clearfix"><a href="mailto:' . $atts['email'] . '">' . $atts['email'] . '</a></li>';
	}
	
	$output .= '</ul>';
	
	return $output;

}

add_shortcode( 'sohohotel_contact_details', 'sohohotel_contact_shortcode' );

?>