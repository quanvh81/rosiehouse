<?php

function hotel_listing_2_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'columns' => '',
		'hotel_name_1' => '',
		'hotel_link_1' => '',
		'hotel_image_1' => '',
		'hotel_name_2' => '',
		'hotel_link_2' => '',
		'hotel_image_2' => '',
		'hotel_name_3' => '',
		'hotel_link_3' => '',
		'hotel_image_3' => '',
		'hotel_name_4' => '',
		'hotel_link_4' => '',
		'hotel_image_4' => ''
	), $atts ) );
	
	ob_start();
	
	if ( $columns != '' ) {
		$hotel_columns = $columns;
	} else {
		$hotel_columns = '2';
	}
	
	echo '<div class="hotel-image-wrapper hotel-image-wrapper-' . $hotel_columns . '-col clearfix">';
	
	if ( $hotel_name_1 ) {
		echo '<div class="hotel-image">';
		echo '<a class="hotel-image-link" href="' . $hotel_link_1 . '"><img src="' . wp_get_attachment_image_url( $hotel_image_1, 'full-image') . '" alt="' . $hotel_name_1 . '" /></a>';
		echo '<div class="hotel-title">';
		echo '<h4><a href="' . $hotel_link_1 . '">' . $hotel_name_1 . '</a></h4>';
		echo '<div class="title-block-3"></div>';
		echo '</div>';
		echo '</div>';
	}
	
	if ( $hotel_name_2 ) {
		echo '<div class="hotel-image">';
		echo '<a class="hotel-image-link" href="' . $hotel_link_2 . '"><img src="' . wp_get_attachment_image_url( $hotel_image_2, 'full-image') . '" alt="' . $hotel_name_2 . '" /></a>';
		echo '<div class="hotel-title">';
		echo '<h4><a href="' . $hotel_link_2 . '">' . $hotel_name_2 . '</a></h4>';
		echo '<div class="title-block-3"></div>';
		echo '</div>';
		echo '</div>';
	}
	
	if ( $hotel_name_3 ) {
		echo '<div class="hotel-image">';
		echo '<a class="hotel-image-link" href="' . $hotel_link_3 . '"><img src="' . wp_get_attachment_image_url( $hotel_image_3, 'full-image') . '" alt="' . $hotel_name_3 . '" /></a>';
		echo '<div class="hotel-title">';
		echo '<h4><a href="' . $hotel_link_3 . '">' . $hotel_name_3 . '</a></h4>';
		echo '<div class="title-block-3"></div>';
		echo '</div>';
		echo '</div>';
	}
	
	if ( $hotel_name_4 ) {
		echo '<div class="hotel-image">';
		echo '<a class="hotel-image-link" href="' . $hotel_link_4 . '"><img src="' . wp_get_attachment_image_url( $hotel_image_4, 'full-image') . '" alt="' . $hotel_name_4 . '" /></a>';
		echo '<div class="hotel-title">';
		echo '<h4><a href="' . $hotel_link_4 . '">' . $hotel_name_4 . '</a></h4>';
		echo '<div class="title-block-3"></div>';
		echo '</div>';
		echo '</div>';
	}
	
	echo '</div>';
	
	return ob_get_clean();

}

add_shortcode( 'hotel_listing_2', 'hotel_listing_2_shortcode' );

?>