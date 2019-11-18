<?php

function hotel_listing_1_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'columns' => '',
		'hotel_name_1' => '',
		'hotel_link_1' => '',
		'hotel_name_2' => '',
		'hotel_link_2' => '',
		'hotel_name_3' => '',
		'hotel_link_3' => '',
		'hotel_name_4' => '',
		'hotel_link_4' => ''
	), $atts ) );
	
	ob_start();
	
	if ( $columns != '' ) {
		$hotel_columns = $columns;
	} else {
		$hotel_columns = '2';
	}
	
	echo '<div class="our-hotels-section block-link-wrapper-' . $hotel_columns . ' clearfix">';
	
	if ( $hotel_name_1 ) {
		echo '<a class="block-link" href="' . $hotel_link_1 . '">' . $hotel_name_1 . ' <i class="fa fa-angle-right"></i></a>';
	}
	
	if ( $hotel_name_2 ) {
		echo '<a class="block-link" href="' . $hotel_link_2 . '">' . $hotel_name_2 . ' <i class="fa fa-angle-right"></i></a>';
	}
	
	if ( $hotel_name_3 ) {
		echo '<a class="block-link" href="' . $hotel_link_3 . '">' . $hotel_name_3 . ' <i class="fa fa-angle-right"></i></a>';
	}
	
	if ( $hotel_name_4 ) {
		echo '<a class="block-link" href="' . $hotel_link_4 . '">' . $hotel_name_4 . ' <i class="fa fa-angle-right"></i></a>';
	}
	
	echo '</div>';
	
	return ob_get_clean();

}

add_shortcode( 'hotel_listing_1', 'hotel_listing_1_shortcode' );

?>