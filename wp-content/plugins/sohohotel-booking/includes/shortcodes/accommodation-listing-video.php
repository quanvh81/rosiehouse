<?php

function accommodation_listing_video_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'hotel_category' => '',
		'order' => '',
		'video_thumbnail' => '',
		'video_url' => ''
	), $atts ) );
	
	global $post;
	global $wp_query;
	
	ob_start();
	
	// Set Rooms Displayed Per Page
	$rooms_per_page = '4';
	
	// Set Rooms Display Order
	if ( $order == 'newest' ) {
		$rooms_order = 'DESC';
	} elseif ( $order == 'oldest' ) {
		$rooms_order = 'ASC';
	} else {
		$rooms_order = 'DESC';
	}
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
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
			'posts_per_page' => $rooms_per_page,
			'paged' => $paged,
			'order' => $rooms_order
		);
		
	} else {
		
		$args = array(
			'post_type' => 'accommodation',
			'posts_per_page' => $rooms_per_page,
			'paged' => $paged,
			'order' => $rooms_order
		);
		
	}
	
	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) : ?>
		
		<!-- BEGIN .accommodation-video-section -->
		<div class="accommodation-video-section">
		
		<!-- BEGIN .accommodation-block-wrapper -->
		<div class="accommodation-block-wrapper">
		
		<?php while($wp_query->have_posts()) :
			
			$wp_query->the_post(); 
			
				global $count;
				global $sohohotel_booking_data;
				$count++; 
				
				$accommodation_meta = json_decode( get_post_meta($post->ID,'_accommodation_meta',TRUE), true );
				$accommodation_meta_room_excerpt = get_post_meta($post->ID,'_accommodation_room_excerpt_meta',TRUE);
			?>
			
			<div class="accommodation-block">
										
				<?php if( has_post_thumbnail() ) { ?>
					<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="accommodation-block-image-link">
						<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sohohotel-image-style4' ); ?>
						<?php echo '<img src="' . $src[0] . '" alt="' . get_the_title() . '" />'; ?>
					</a>
				<?php } ?>
				
				<div class="accommodation-info">
					<h4><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><span><i><?php esc_html_e('From','sohohotel_booking'); ?></i> <?php echo sh_get_price($accommodation_meta['price_adult_weekdays']); ?></span></h4>
				</div>
					
			</div>
			
		<?php endwhile; ?>
	
		<!-- END .accommodation-block-wrapper -->
		</div>
		
		<div class="accommodation-video-block">
			<img src="<?php echo wp_get_attachment_image_url( $video_thumbnail, 'full-image'); ?>" alt="" />
			<div class="video-play">
				<a href="<?php echo $video_url; ?>" data-gal="prettyPhoto"><i class="fa fa-play"></i></a>
			</div>
		</div>
		
		<!-- END .accommodation-video-section -->
		</div>
		
		<?php else : ?>
			<p><?php esc_html_e('No rooms have been added yet','sohohotel_booking'); ?></p>
		<?php endif; ?>

		<?php

		wp_reset_query();
		
		return ob_get_clean();

}

add_shortcode( 'accommodation_listing_video', 'accommodation_listing_video_shortcode' );

?>