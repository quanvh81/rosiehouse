<?php

function accommodation_listing_3_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'rooms_per_page' => '10',
		'hotel_category' => '',
		'columns' => '1',
		'order' => '',
		'style' => '',
		'hide_pagination' => ''
	), $atts ) );
	
	global $post;
	global $wp_query;
	
	ob_start();
	
	// Set Rooms Displayed Per Page
	if ( $rooms_per_page != '' ) {
		$rooms_per_page = $rooms_per_page;
	} else {
		$rooms_per_page = '10';
	}
	
	// Set Rooms Display Order
	if ( $order == 'newest' ) {
		$rooms_order = 'DESC';
	} elseif ( $order == 'oldest' ) {
		$rooms_order = 'ASC';
	} else {
		$rooms_order = 'DESC';
	}
	
	// Set Columns
	if ( $columns != '' ) {
		$accommodation_columns = $columns;
	} else {
		$accommodation_columns = '1';
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
		
		
		
		
		<?php if($columns == '1') { ?>
			
			<!-- BEGIN .accommodation-block-wrapper-2 -->
			<div class="accommodation-block-wrapper-2 accommodation-1-cols clearfix">
		
		<?php } elseif($columns == '2') { ?>
			
			<!-- BEGIN .accommodation-block-wrapper-2 -->
			<div class="accommodation-block-wrapper-2 accommodation-2-cols clearfix">
			
		<?php } elseif($columns == '3') { ?>
			
			<!-- BEGIN .accommodation-block-wrapper-2 -->
			<div class="accommodation-block-wrapper-2 accommodation-3-cols clearfix">
			
		<?php } elseif($columns == '4') { ?>
			
			<!-- BEGIN .accommodation-block-wrapper-2 -->
			<div class="accommodation-block-wrapper-2 accommodation-4-cols clearfix">
			
		<?php } elseif($columns == '5') { ?>
			
			<!-- BEGIN .accommodation-block-wrapper-2 -->
			<div class="accommodation-block-wrapper-2 accommodation-5-cols clearfix">
			
		<?php } else { ?>
			
			<!-- BEGIN .accommodation-block-wrapper-2 -->
			<div class="accommodation-block-wrapper-2 accommodation-3-cols clearfix">
			
		<?php } ?>
		
		<?php while($wp_query->have_posts()) :
			
			$wp_query->the_post(); 
			
				global $count;
				global $sohohotel_booking_data;
				$count++; 
				
				$accommodation_meta = json_decode( get_post_meta($post->ID,'_accommodation_meta',TRUE), true );
				$accommodation_meta_room_excerpt = get_post_meta($post->ID,'_accommodation_room_excerpt_meta',TRUE);
			?>
			
			<!-- BEGIN .accommodation-block -->
									<div class="accommodation-block clearfix">

										<div class="accommodation-block-image">
											<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
												<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sohohotel-image-style2' ); ?>
												<?php echo '<img src="' . $src[0] . '" alt="' . get_the_title() . '" />'; ?>
											</a>
											<div class="accommodation-block-price"><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html_e('From','sohohotel_booking'); ?> <?php echo sh_get_price($accommodation_meta['price_adult_weekdays']); ?></a></div>
										</div>
							
										<h4 class="clearfix"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><span><?php the_title(); ?></span><i class="fa fa-angle-right"></i></a></h4>
							
									<!-- END .accommodation-block -->
									</div>
			
		<?php endwhile; ?>
		
		<!-- END .accommodation-grid -->
		</div>
		
		<?php else : ?>
			<p><?php esc_html_e('No rooms have been added yet','sohohotel_booking'); ?></p>
		<?php endif; ?>

		
		<?php if ( $hide_pagination == '' ) { ?>

			<?php global $the_query; ?>

			<?php if ( $the_query ) { ?>
	
				<?php if ( $the_query->max_num_pages > 1 ) : ?>

					<div class="sohohotel-clearboth"></div>

					<?php if(is_plugin_active('wp-pagenavi/wp-pagenavi.php')) {
						echo '<div class="sohohotel-page-pagination sohohotel-page-pagination-3 sohohotel-clearfix">';
						wp_pagenavi( array( 'query' => $the_query ) );
						echo '</div>';
						echo '<div class="sohohotel-clearboth"></div>';
					} else { ?>

					<div class="sohohotel-page-pagination sohohotel-page-pagination-3 sohohotel-clearfix">
						<p class="sohohotel-clearfix">
							<span class="sohohotel-prev-pagination"><?php next_posts_link( esc_html__( '&larr; Older posts', 'soho-hotel' ), $the_query->max_num_pages ); ?></span>
							<span class="sohohotel-next-pagination"><?php previous_posts_link( esc_html__( 'Newer posts &rarr;', 'soho-hotel' ), $the_query->max_num_pages ); ?></span>	
						</p>
					</div>

					<?php } ?>

				<?php endif; ?>
	
			<?php } else {
	
				if ( $wp_query->max_num_pages > 1 ) : ?>

					<div class="sohohotel-clearboth"></div>

					<?php if(is_plugin_active('wp-pagenavi/wp-pagenavi.php')) {
						echo '<div class="sohohotel-page-pagination sohohotel-page-pagination-3 sohohotel-clearfix">';
						wp_pagenavi();
						echo '</div>';
						echo '<div class="sohohotel-clearboth"></div>';
					} else { ?>

					<div class="sohohotel-page-pagination sohohotel-page-pagination-3 sohohotel-clearfix">
						<p class="clearfix">
							<span class="sohohotel-prev-pagination"><?php next_posts_link( esc_html__( '&larr; Older posts', 'soho-hotel' ) ); ?></span>
							<span class="sohohotel-next-pagination"><?php previous_posts_link( esc_html__( 'Newer posts &rarr;', 'soho-hotel' ) ); ?></span>	
						</p>
					</div>

					<?php } ?>

				<?php endif; ?>
	
			<?php }
		
		}
		
		wp_reset_query();
		
		return ob_get_clean();

}

add_shortcode( 'accommodation_listing_3', 'accommodation_listing_3_shortcode' );

?>