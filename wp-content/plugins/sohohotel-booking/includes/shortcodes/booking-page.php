<?php

function booking_page_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'hotel_category' => ''
	), $atts ) );
	
	// Set max values
	$sh_get_booking_max_rooms = sh_get_booking_max_rooms();
	$sh_get_booking_max_guests = sh_get_booking_max_guests();
	
	// Display template
	include(sohohotel_booking_BASE_DIR . '/includes/templates/booking-step1.htm.php');
	
}

add_shortcode( 'booking_page', 'booking_page_shortcode' );

?>