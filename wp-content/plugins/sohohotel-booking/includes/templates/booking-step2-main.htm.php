<form name="bookroom" class="booking-form-data">

	<?php global $post;
	global $wp_query;
	
	$occupancy_hide = false;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	// Get IDs of fully booked rooms (from database and temp session)
	$fully_booked_rooms_db = sh_get_all_booked_room_ids($_SESSION['sh_booking_data']['check_in'],$_SESSION['sh_booking_data']['check_out'],true,false);
	
	// Get IDs of all bookings for remaining room check
	$booked_ids_array = sh_get_booked_room_ids_db($_SESSION['sh_booking_data']['check_in'],$_SESSION['sh_booking_data']['check_out'],false);
		
	if ( !empty($_POST['accommodation_category']) ) {
		
		$args = array(
		'post_type' => 'accommodation',
		'posts_per_page' => '9999',
		'paged' => $paged,
		'post__not_in' => $fully_booked_rooms_db,
		'tax_query' => array(
				array(
					'taxonomy' => 'accommodation-categories',
					'field'    => 'slug',
					'terms'    => sanitize_title_for_query($_POST['accommodation_category']),
				),
			)
		);
		
	} else {
		
		
		if ( !empty( $_POST['accommodation_single_id'] ) ) {
			
			$args = array(
			'post_type' => 'accommodation',
			'posts_per_page' => '9999',
			'paged' => $paged,
			'post__not_in' => $fully_booked_rooms_db,
			'p' => sanitize_title_for_query($_POST['accommodation_single_id'])
			);
			
		} else {
			
			$args = array(
			'post_type' => 'accommodation',
			'posts_per_page' => '9999',
			'paged' => $paged,
			'post__not_in' => $fully_booked_rooms_db
			);
			
		}
		
	}
	
	$total_guests = $_SESSION['sh_booking_data']['room_' . sh_get_current_room()]["adults"] + $_SESSION['sh_booking_data']['room_' . sh_get_current_room()]["children"];
	
	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) : ?>
		
		<?php while($wp_query->have_posts()) :
			
			$wp_query->the_post(); 
			
				// Get accommodation data
				$accommodation_meta = json_decode( get_post_meta($post->ID,'_accommodation_meta',TRUE), true );
				$accommodation_meta_room_excerpt = get_post_meta($post->ID,'_accommodation_room_excerpt_meta',TRUE);
				
				// Remaining rooms
				$remaining_rooms = sh_get_remaining_rooms($_SESSION['sh_booking_data']['check_in'],$_SESSION['sh_booking_data']['check_out'],sh_get_original_wpml_id($post->ID,'accommodation'),sh_get_original_wpml_ids($booked_ids_array,'accommodation')); 

					if ( $remaining_rooms != '' ) {

						echo '<p class="remaining-rooms">' . esc_html__('Hurry up, there are only', 'sohohotel_booking') . ' ' . $remaining_rooms . ' ' . esc_html__('rooms of this type remaining!', 'sohohotel_booking') . '</p>';

					} 

					// Check max occupancy
					if ( $total_guests > $accommodation_meta['maximum_occupancy'] ) {

						echo '<p class="occupancy-exceeded">' . esc_html__('This room is available but has a maximum occupancy of', 'sohohotel_booking') . ' ' . $accommodation_meta['maximum_occupancy'] . ' ' . esc_html__('guest(s)', 'sohohotel_booking') . '</p>';

						$occupancy_hide = true;

					} else {

						$occupancy_hide = false;

					} 
	
					?>

					<!-- BEGIN .booking-room-wrapper -->
					<div class="booking-room-wrapper clearfix <?php if ($occupancy_hide == true) {echo 'occupancy-hide';} ?>">
				
						<?php if( has_post_thumbnail() ) { ?>

							<a target="_blank" href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sohohotel-image-style1' ); ?>
								<?php echo '<img src="' . $src[0] . '" alt="' . get_the_title() . '" class="booking-room-image" />'; ?>
							</a>

						<?php } ?>
	
						<div class="booking-room-info-wrapper">
			
							<h3><a target="_blank" href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="clearfix"><?php the_title(); ?></a></h3>
			
							<?php if ( !empty( $accommodation_meta_room_excerpt ) ) {
								$room_excerpt = $accommodation_meta_room_excerpt;
							} else {
								$room_excerpt = '';
							} ?>
							<?php echo $room_excerpt; ?>
			
							<?php $sh_booking_data = $_SESSION['sh_booking_data'];
							$room_price_breakdown = sh_get_price_breakdown_room($sh_booking_data["check_in"],$sh_booking_data["check_out"],$sh_booking_data["room_" . sh_get_current_room() ]["adults"],$sh_booking_data["room_" . sh_get_current_room() ]["children"],get_the_ID()); ?>
			
							<div class="booking-room-price-wrapper">
								<p class="room-price"><?php esc_html_e('Price', 'sohohotel_booking'); ?> <span><?php echo sh_get_price($room_price_breakdown["Total"]); ?></span></p><div class="clearboth"></div>
								<p class="room-price-breakdown"><a href="#price_break_hotel_room_<?php the_ID(); ?>" data-gal="prettyPhoto"><?php esc_html_e('View Price Breakdown', 'sohohotel_booking'); ?></a></p>

								<!-- BEGIN #price_break_hotel_room_<?php the_ID(); ?> -->
								<div id="price_break_hotel_room_<?php the_ID(); ?>" class="hide">

									<!-- BEGIN .lightbox-title -->
									<div class="lightbox-title">
										<h4 class="title-style4"><?php esc_html_e('Price Breakdown', 'sohohotel_booking'); ?><span class="title-block"></span></h4>
									<!-- END .lightbox-title -->
									</div>

									<!-- BEGIN .main-content -->
									<div class="main-content main-content-lightbox content-wrapper">
						
										<table>
											<tbody>
								
												<?php $adult_price = array();
												$child_price = array(); ?>
								
												<?php foreach( $room_price_breakdown as $key => $val ) { ?>
									
													<?php if ( $key == 'Total' ) { ?>
												
														<tr>
															<td data-title="Date"><?php echo esc_html__('Total', 'sohohotel_booking'); ?></td>
															<td data-title="Price"><?php echo sh_get_price($val); ?></td>
														</tr>
												
													<?php } else { ?>
												
														<tr>
															<td data-title="Date"><?php echo sh_display_formatted_date($key); ?></td>
															<td data-title="Price">
												
																<?php foreach( $val as $key2 => $val2 ) {

																	if ( "adult_" == substr($key2,0,6) ) {
																		$adult_price[] = $val2;
																	}

																	if ( "child_" == substr($key2,0,6) ) {
																		$child_price[] = $val2;
																	}

																}
														
																if ( $sh_booking_data["room_" . sh_get_current_room() ]["adults"] >= '1' ) {
																	echo  sh_get_price(array_sum($adult_price)) . ' (' . esc_html__('Adult', 'sohohotel_booking') . ' x' . $sh_booking_data["room_" . sh_get_current_room() ]["adults"] . ')<br />';
																}
														
																if ( $sh_booking_data["room_" . sh_get_current_room() ]["children"] >= '1' ) {
																	echo sh_get_price(array_sum($child_price)) . ' (' . esc_html__('Children', 'sohohotel_booking') . ' x' . $sh_booking_data["room_" . sh_get_current_room() ]["children"] . ')<br />';
																} ?>
														
																<?php $adult_price = array(); $child_price = array(); ?>
														
															</td>
														</tr>
												
													<?php } ?>
										
												<?php } ?>
						
											</tbody>
										</table>
						
									<!-- END .page-content -->
									</div>

								<!-- END #price_break_hotel_room_1 -->
								</div>

							<!-- END .booking-room-price-wrapper -->
							</div>
			
							<?php $accommodation_categories = wp_get_object_terms( $post->ID,  'accommodation-categories' );
							if ( ! empty( $accommodation_categories ) ) {
								if ( ! is_wp_error( $accommodation_categories ) ) {
									foreach( $accommodation_categories as $category ) {
										echo '<input type="hidden" name="room_category" value="' . esc_html( $category->name ) . '" />';
									}
								}
							} else {
								echo '<input type="hidden" name="room_category" value="" />';
							} ?>
			
							<button class="select-room-button" value="<?php echo $post->ID; ?>||<?php the_title(); ?>" type="submit" <?php if ($occupancy_hide == true) {echo 'disabled';} ?>><?php esc_html_e('Select Room','sohohotel_booking'); ?></button>
			
						<!-- END .booking-room-info-wrapper -->
						</div>

					<!-- END .booking-room-wrapper -->
					</div>
			
		<?php endwhile; ?>
		
		<?php else : ?>
			<p><?php esc_html_e('No rooms are available','sohohotel_booking'); ?></p>
		<?php endif;

		wp_reset_query(); ?>
	
	<div class="clearboth"></div>
	
	<input type="hidden" name="action" value="sh_booking_process_frontend_action_callback" />
	<?php echo wp_nonce_field('sh_booking_process_frontend', '_acf_nonce', true, false); ?>
	
	<input type="hidden" name="room_<?php echo sh_get_current_room(); ?>_selection" class="selected-room" value="" />
	<input type="hidden" name="current_room" value="<?php echo sh_get_current_room(); ?>" />
	<input type="hidden" name="edit_room_data" class="edit-room-field" value="" />
	<input type="hidden" name="edit_step_2" class="edit-step-2" value="" />

</form>