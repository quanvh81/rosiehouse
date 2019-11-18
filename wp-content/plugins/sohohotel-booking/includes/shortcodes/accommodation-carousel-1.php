<?php

function accommodation_carousel_1_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'hotel_category' => '',
		'order' => '',
		'rooms_per_page' => ''
	), $atts ) );
	
	global $post;
	global $wp_query;
	
	ob_start();
	
	// Set Rooms Display Order
	if ( $order == 'newest' ) {
		$rooms_order = 'DESC';
	} elseif ( $order == 'oldest' ) {
		$rooms_order = 'ASC';
	} else {
		$rooms_order = 'DESC';
	}
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	if ( isset($rooms_per_page) ) {
		$set_rooms_per_page = $rooms_per_page;
	} else {
		$set_rooms_per_page = '9999';
	}
	
	// Display From Category
	if ( $hotel_category != '' ) {
		
		$args = array(
			'post_type' => 'accommodation',
			'tax_query' => array(
					array(
						'taxonomy' => 'accommodation-categories',
						'field'    => 'slug',
						'terms'    => $hotel_category,
					),
				),
			'posts_per_page' => $set_rooms_per_page,
			'paged' => $paged,
			'order' => $rooms_order
		);
		
	} else {
		
		$args = array(
			'post_type' => 'accommodation',
			'posts_per_page' => $set_rooms_per_page,
			'paged' => $paged,
			'order' => $rooms_order
		);
		
	}
	
	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) : ?>
		
		<!-- BEGIN .accommodation-carousel -->
		<div class="accommodation-carousel sohohotel-owl-carousel-3">
		
				<?php while($wp_query->have_posts()) :

					$wp_query->the_post(); 

						global $count;
						global $sohohotel_booking_data;
						$count++;
						
					    $accommodation_meta = json_decode( get_post_meta($post->ID,'_accommodation_meta',TRUE), true );
						$accommodation_meta_room_excerpt = get_post_meta($post->ID,'_accommodation_room_excerpt_meta',TRUE);
						
					 ?>
					
						<!-- BEGIN .accommodation-block -->
						<div class="accommodation-block">

							<div class="accommodation-block-image">
								<?php if( has_post_thumbnail() ) { ?>
									<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sohohotel-image-style2' ); ?>
										<?php echo '<img src="' . $src[0] . '" alt="' . get_the_title() . '" />'; ?>
									</a>
								<?php } ?>
							</div>

							<div class="accommodation-block-content">
								<h4><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

								<?php if ( !empty( $accommodation_meta_room_excerpt ) ) {
									$room_excerpt = $accommodation_meta_room_excerpt;
								} else {
									$room_excerpt = '';
								} ?>
			
								<?php echo $room_excerpt; ?>
	
								<div class="clearfix">
									<a href="<?php esc_url(the_permalink()); ?>" class="price-button"><?php esc_html_e('from','sohohotel_booking'); ?> <?php echo sh_get_price($accommodation_meta['price_adult_weekdays']); ?> <?php esc_html_e('per night','sohohotel_booking'); ?></a>
									<a href="<?php esc_url(the_permalink()); ?>" class="view-details-button"><?php esc_html_e('View Details','sohohotel_booking'); ?> <i class="fa fa-angle-right"></i></a>
								</div>
	
							</div>

						<!-- END .accommodation-block -->
						</div>
					
				<?php endwhile; ?>
		
			<!-- END .accommodation-carousel -->
			</div>
		
	<?php else : ?>
		<p><?php esc_html_e('No rooms have been added yet','sohohotel_booking'); ?></p>
	<?php endif;

	 wp_reset_query();
		
	return ob_get_clean();

}

add_shortcode( 'accommodation_carousel_1', 'accommodation_carousel_1_shortcode' );

?>