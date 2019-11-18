<?php

function sohohotel_display_admin_booking_add() { ?>
	
	<?php 
	
	// Check booking ID exists
	if( !empty($_GET["booking"]) ) {
		
		if ( FALSE !== get_post_status( $_GET["booking"] ) ) {
			$post_id = $_GET["booking"];
			
			$booking_meta = get_post_meta($post_id,'_booking_meta',TRUE);	
			
		}
	
	} else {
		
		$booking_meta = array();
		
	}
	
	// Set form URL
	$add_booking_url = sohohotel_booking_PLUGIN_URL . 'includes/functions/post-new.php';
	
	// Set booking status
	if ( !empty($booking_meta['booking_status']) ) {
		if ( $booking_meta['booking_status'] == 1 ) {
			$booking_status = esc_html__('Pending', 'sohohotel_booking');
		} elseif ( $booking_meta['booking_status'] == 2 ) {
			$booking_status = esc_html__('Confirmed', 'sohohotel_booking');
		} else {
			$booking_status = esc_html__('Cancelled', 'sohohotel_booking');
		}
	} else {
		$booking_status = esc_html__('Pending', 'sohohotel_booking');
	}
	
	?>
	
	<!-- BEGIN .wrap -->
	<div class="wrap">
		
		<?php if( !empty($_GET["booking"]) ) { ?>
			<h1 class="wp-heading-inline"><?php esc_html_e('Edit Booking', 'sohohotel_booking'); ?></h1>
			<a href="<?php echo get_admin_url() . 'admin.php?page=booking_add'; ?>" class="page-title-action"><?php esc_html_e('Add New', 'sohohotel_booking'); ?></a>
		<?php } else { ?>
			<h1 class="wp-heading-inline"><?php esc_html_e('Add New Booking', 'sohohotel_booking'); ?></h1>
		<?php } ?>
		
		<hr class="wp-header-end" />
	
		<!-- BEGIN #post -->
		<form name="post" action="<?php echo $add_booking_url; ?>" method="post" id="post">
			
			<!-- BEGIN #poststuff -->
			<div id="poststuff">
				
				<!-- BEGIN #post-body -->
				<div id="post-body" class="metabox-holder columns-2">
					
					<input name="booking_id" value="<?php if( !empty($post_id) ) {echo $post_id;} ?>" type="hidden" />
					<input name="post_title" size="30" value="<?php the_title(); ?>" id="title" type="hidden" />
					
					<!-- BEGIN #postbox-container-1 -->
					<div id="postbox-container-1" class="postbox-container">

						<!-- BEGIN #side-sortables -->
						<div id="side-sortables" class="meta-box-sortables">

							<!-- BEGIN #submitdiv -->
							<div id="submitdiv" class="postbox ">

								<h2 class='hndle'><span><?php esc_html_e('Book Now', 'sohohotel_booking'); ?></span></h2>

								<!-- BEGIN .inside -->
								<div class="inside">

									<!-- BEGIN .submitbox -->
									<div class="submitbox" id="submitpost">

										<!-- BEGIN #minor-publishing -->
										<div id="minor-publishing">

											<!-- BEGIN #misc-publishing-actions -->
											<div id="misc-publishing-actions">

												<!-- BEGIN .misc-pub-section -->
												<div class="misc-pub-section misc-pub-post-status">

													<?php esc_html_e('Booking Status', 'sohohotel_booking'); ?>: <span id="post-status-display"><?php echo $booking_status; ?></span>

												<!-- END .misc-pub-section -->
												</div>

											<!-- END #misc-publishing-actions -->
											</div>

											<div class="clear"></div>

										<!-- END #minor-publishing -->	
										</div>

										<!-- BEGIN #major-publishing-actions -->
										<div id="major-publishing-actions">

											<!-- BEGIN #delete-action -->
											<div id="delete-action">
												
												<?php if( !empty($_GET["booking"]) ) { ?>
												
												<a class="submitdelete deletion" href="<?php echo $add_booking_url . '?action=trash&booking_id=' . $post_id; ?>"><?php esc_html_e('Move to Trash', 'sohohotel_booking'); ?></a>
												<?php } ?>

											<!-- END #delete-action -->
											</div>

											<!-- BEGIN #publishing-action -->
											<div id="publishing-action">
												
												<?php if( !empty($_GET["booking"]) ) {
													$booking_button_title = esc_html__('Update', 'sohohotel_booking');
												} else {
													$booking_button_title = esc_html__('Book Now', 'sohohotel_booking');
												} ?>
												
												<span class="spinner"></span>
												
												<?php if(empty($booking_meta['ical_data'])) { ?>
													<input type="submit" name="publish" id="publish" class="button button-primary button-large add-booking-button" value="<?php echo $booking_button_title; ?>"  />
												<?php } ?>
												
											<!-- END #publishing-action -->
											</div>

											<div class="clear"></div>

										<!-- END #major-publishing-actions -->
										</div>

									<!-- END .submitbox -->
									</div>

								<!-- END .inside -->
								</div>

							<!-- END #submitdiv -->
							</div>

						<!-- END #side-sortables -->
						</div>

					<!-- END #postbox-container-1 -->
					</div>
					
					<!-- BEGIN #postbox-container-2 -->
					<div id="postbox-container-2" class="postbox-container">
					
						<!-- BEGIN .booking_guest_information_section -->
						<div class="postbox booking_guest_information_section">
							
							<h2 class="hndle"><span><?php esc_html_e('Guest Information', 'sohohotel_booking'); ?></span></h2>
							<div class="inside">
								
								<?php global $sohohotel_data;
								echo '<div class="clearfix">';
								echo verifyInputs($sohohotel_data['custom_booking_form'], $booking_meta);
								echo '</div>'; ?>
								
							</div>
							
						<!-- END .booking_guest_information_section -->
						</div>
						
						<!-- BEGIN .booking_payment_status_section -->
						<div class="postbox booking_payment_status_section">
							
							<h2 class="hndle"><span><?php esc_html_e('Booking &amp; Payment Status', 'sohohotel_booking'); ?></span></h2>
							<div class="inside">
								
								<!-- BEGIN .sohohotel_booking-field-wrapper -->	
								<div class="sohohotel_booking-field-wrapper clearfix">

									<div class="sohohotel_booking-one-third">
										<label><?php esc_html_e('Booking Status', 'sohohotel_booking'); ?></label>
									</div>

									<div class="sohohotel_booking-one-third">

										<select name="_booking_meta[booking_status]">
											<option value="1" <?php if(!empty($booking_meta['booking_status'])) {if ($booking_meta['booking_status'] == '1') {echo 'selected';}} ?>><?php esc_html_e('Pending', 'sohohotel_booking'); ?></option>
											<option value="2" <?php if(!empty($booking_meta['booking_status'])) {if ($booking_meta['booking_status'] == '2') {echo 'selected';}} else {echo 'selected';} ?>><?php esc_html_e('Confirmed', 'sohohotel_booking'); ?></option>
											<option value="3" <?php if(!empty($booking_meta['booking_status'])) {if ($booking_meta['booking_status'] == '3') {echo 'selected';}} ?>><?php esc_html_e('Cancelled', 'sohohotel_booking'); ?></option>
										</select>

									</div>

									<div class="sohohotel_booking-one-third"></div>

								<!-- END .sohohotel_booking-field-wrapper -->	
								</div>

								<hr class="space1" />

								<!-- BEGIN .sohohotel_booking-field-wrapper -->	
								<div class="sohohotel_booking-field-wrapper clearfix">

									<div class="sohohotel_booking-one-third">
										<label><?php esc_html_e('Payment Method', 'sohohotel_booking'); ?></label>
									</div>

									<div class="sohohotel_booking-one-third">
										<input type="text" value="<?php if(!empty($booking_meta['payment_method'])) echo $booking_meta['payment_method']; ?>" name="_booking_meta[payment_method]" />
									</div>

									<div class="sohohotel_booking-one-third">
										<span class="description"><?php esc_html_e('The payment method used at the checkout','sohohotel_booking'); ?></span>
									</div>

								<!-- END .sohohotel_booking-field-wrapper -->	
								</div>

								<hr class="space1" />

								<!-- BEGIN .sohohotel_booking-field-wrapper -->	
								<div class="sohohotel_booking-field-wrapper clearfix">

									<div class="sohohotel_booking-one-third">
										<label><?php esc_html_e('Amount Paid', 'sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</label>
									</div>

									<div class="sohohotel_booking-one-third">
										<input type="text" value="<?php if(!empty($booking_meta['amount_paid'])) echo $booking_meta['amount_paid']; ?>" name="_booking_meta[amount_paid]" />
									</div>

									<div class="sohohotel_booking-one-third">
										<span class="description"><?php esc_html_e('The amount already paid by the guest via online payment','sohohotel_booking'); ?></span>
									</div>

								<!-- END .sohohotel_booking-field-wrapper -->	
								</div>

								<hr class="space1" />

								<!-- BEGIN .sohohotel_booking-field-wrapper -->	
								<div class="sohohotel_booking-field-wrapper clearfix">

									<div class="sohohotel_booking-one-third">
										<label><?php esc_html_e('Amount Due', 'sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</label>
									</div>

									<div class="sohohotel_booking-one-third">
										
										<?php if ( !empty($sohohotel_data['price_decimal_places']) ) {
											$number_decimals = $sohohotel_data['price_decimal_places'];
										} else {
											$number_decimals = '2';
										} ?>
										
										<input type="text" value="<?php if(!empty($booking_meta['outstanding_amount'])) echo $booking_meta['outstanding_amount']; ?>" name="_booking_meta[outstanding_amount]" />
									</div>

									<div class="sohohotel_booking-one-third">
										<span class="description"><?php esc_html_e('The outstanding amount owed by the guest to be paid upon arrival','sohohotel_booking'); ?></span>
									</div>

								<!-- END .sohohotel_booking-field-wrapper -->	
								</div>
								
							</div>
							
						<!-- END .booking_payment_status_section -->
						</div>
						
						<!-- BEGIN .booking_dates_section -->
						<div class="postbox booking_dates_section">
							
							<h2 class="hndle"><span><?php esc_html_e('Booking Dates', 'sohohotel_booking'); ?></span></h2>
							<div class="inside">
								
								<!-- BEGIN .sohohotel_booking-field-wrapper -->	
								<div class="sohohotel_booking-field-wrapper clearfix">

									<div class="sohohotel_booking-one-third">
										<label><?php esc_html_e('Check In', 'sohohotel_booking'); ?></label>
									</div>

									<div class="sohohotel_booking-one-third">
										<input class="datepicker booking_check_in" type="text" value="<?php if(!empty($booking_meta['check_in'])) echo sh_display_formatted_date($booking_meta['check_in']); ?>" />
										<input class="booking_check_in_alt" type="text" value="<?php if(!empty($booking_meta['check_in'])) echo $booking_meta['check_in']; ?>" name="_booking_meta[check_in]" />
									</div>

									<div class="sohohotel_booking-one-third"></div>

								<!-- END .sohohotel_booking-field-wrapper -->	
								</div>

								<hr class="space1" />

								<!-- BEGIN .sohohotel_booking-field-wrapper -->	
								<div class="sohohotel_booking-field-wrapper clearfix">

									<div class="sohohotel_booking-one-third">
										<label><?php esc_html_e('Check Out', 'sohohotel_booking'); ?></label>
									</div>

									<div class="sohohotel_booking-one-third">
										<input class="datepicker booking_check_out" type="text" value="<?php if(!empty($booking_meta['check_out'])) echo sh_display_formatted_date($booking_meta['check_out']); ?>" />
										<input class="booking_check_out_alt" type="text" value="<?php if(!empty($booking_meta['check_out'])) echo $booking_meta['check_out']; ?>" name="_booking_meta[check_out]" />
									</div>

									<div class="sohohotel_booking-one-third"></div>

								<!-- END .sohohotel_booking-field-wrapper -->	
								</div>
								
							</div>
							
						<!-- END .booking_dates_section -->
						</div>
						
						<!-- BEGIN .booking_rooms_section -->
						<div class="postbox booking_rooms_section">
							<h2 class="hndle"><span><?php esc_html_e('Rooms', 'sohohotel_booking'); ?></span></h2>
							<div class="inside">
								
								<?php global $sohohotel_data;
								if ( !empty($sohohotel_data['booking_form_max_person']) ) {
									$booking_form_max_person = $sohohotel_data['booking_form_max_person'];
								} else {
									$booking_form_max_person = '30';
								} 

								// Wipe existing temp booking data
								$_SESSION['sh_booking_data_backend'] = '';
								?>

								<!-- BEGIN .booking-rooms-wrapper-outer -->
								<div class="booking-rooms-wrapper-outer">

								<?php unset($_SESSION["temp_bookings"]);

								if( !empty($booking_meta['save_rooms']) ) {
									$json_data = $booking_meta['save_rooms'];
									$data = json_decode($json_data, true); ?>

									    <?php foreach($data as $key => $val) { ?>

										<!-- BEGIN .booking-rooms-wrapper-inner -->
									    <div class="booking-rooms-wrapper-inner">

											<h3><?php echo $key; ?></h3>

											<!-- BEGIN .booking-wrapper -->
											<div class="booking-wrapper">

												<input type="hidden" name="room_number" value="<?php echo $key; ?>">
												<input type="hidden" name="check_in" class="datepicker room_check_in" value="<?php echo $val['check_in']; ?>">
												<input type="hidden" name="check_out" class="datepicker room_check_out" value="<?php echo $val['check_out']; ?>">
												
												<label><?php esc_html_e( 'Room', 'sohohotel_booking' ); ?></label> 
												<select name="room_type">

													<?php global $post;

													$args = array(
													'post_type' => 'accommodation',
													'posts_per_page' => '9999',
													);

													$wp_query = new WP_Query( $args );
													if ($wp_query->have_posts()) :
														while($wp_query->have_posts()) :	
															$wp_query->the_post(); ?>

															<option value="<?php the_ID(); ?>" <?php if( $val['room_type'] == get_the_ID() ) {echo 'selected';} ?>><?php echo the_title(); ?></option>

														<?php endwhile;
													else :
														esc_html_e('No bookings','sohohotel_booking');
													endif;

													wp_reset_query(); ?>

												</select>

												<!-- BEGIN .clearfix -->
												<div class="clearfix">

													<div class="input-field-one-half">
														<label><?php esc_html_e( 'Adults', 'sohohotel_booking' ); ?></label> 
														<select name="adults">
															<?php for ($i = 0; $i <= $booking_form_max_person; $i++) : ?>
																<?php if ($val['adults'] == $i ) { ?>	
															        <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
																<?php } else { ?>
																	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
																<?php } ?>
															<?php endfor; ?>
														</select>
													</div>

													<div class="input-field-one-half last-col">
														<label><?php esc_html_e( 'Children', 'sohohotel_booking' ); ?></label>
														<select name="children">
															<?php for ($i = 0; $i <= $booking_form_max_person; $i++) : ?>
																<?php if ($val['children'] == $i ) { ?>	
															        <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
																<?php } else { ?>
																	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
																<?php } ?>
															<?php endfor; ?>
														</select>
													</div>

												<!-- END .clearfix -->
												</div>

												<button class="remove_room button" type="button"><?php esc_html_e( 'Remove Room', 'sohohotel_booking' ); ?></button>

												<div class="ajax_message"></div>

											<!-- END .booking-wrapper -->
											</div>

										<!-- BEGIN .booking-rooms-wrapper-inner -->
									    </div>

									    <?php } ?>

								<?php } ?>

								<!-- END .booking-rooms-wrapper-outer -->
								</div>

								<!-- BEGIN .booking-rooms-wrapper -->
								<div class="booking-rooms-wrapper">

									<h3><?php esc_html_e( 'Room XX', 'sohohotel_booking' ); ?></h3>

									<!-- BEGIN .booking-wrapper -->
									<div class="booking-wrapper">

										<input type="hidden" name="room_number">
										<input type="hidden" name="check_in" value="" class="datepicker room_check_in" />
										<input type="hidden" name="check_out" value="" class="datepicker room_check_out" />

										<label><?php esc_html_e( 'Room', 'sohohotel_booking' ); ?></label>
										<select name="room_type">

											<?php global $post;

											$args = array(
											'post_type' => 'accommodation',
											'posts_per_page' => '9999',
											);

											$wp_query = new WP_Query( $args );
											if ($wp_query->have_posts()) :
												while($wp_query->have_posts()) :	
													$wp_query->the_post(); ?>

													<option value="<?php the_ID(); ?>"><?php echo the_title(); ?></option>

												<?php endwhile;
											else :
												esc_html_e('No bookings','sohohotel_booking');
											endif;

											wp_reset_query(); ?>

										</select>

										<!-- BEGIN .clearfix -->
										<div class="clearfix">

											<div class="input-field-one-half">
												<label><?php esc_html_e( 'Adults', 'sohohotel_booking' ); ?></label>
												<select name="adults">
													<?php for ($i = 0; $i <= $booking_form_max_person; $i++) : ?>
														<?php if ($accommodation_meta['maximum_occupancy'] == $i ) { ?>	
													        <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
														<?php } else { ?>
															<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
														<?php } ?>
													<?php endfor; ?>
												</select>
											</div>

											<div class="input-field-one-half last-col">
												<label><?php esc_html_e( 'Children', 'sohohotel_booking' ); ?></label>
												<select name="children">
													<?php for ($i = 0; $i <= $booking_form_max_person; $i++) : ?>
														<?php if ($accommodation_meta['maximum_occupancy'] == $i ) { ?>	
													        <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
														<?php } else { ?>
															<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
														<?php } ?>
													<?php endfor; ?>
												</select>
											</div>

										<!-- END .clearfix -->
										</div>
										<button class="remove_room button" type="button"><?php esc_html_e( 'Remove Room', 'sohohotel_booking' ); ?></button>

										<div class="ajax_message"></div>

									<!-- END .booking-wrapper -->
									</div>

								<!-- END .booking-rooms-wrapper -->
								</div>

								<button id="add_room" class="button-primary" type="button"><?php esc_html_e( 'Add Room', 'sohohotel_booking' ); ?></button>

								<textarea class="save_rooms" name="_booking_meta[save_rooms]"><?php if(!empty($booking_meta['save_rooms'])) echo $booking_meta['save_rooms']; ?></textarea>
								
							</div>
						
						<!-- END .booking_rooms_section -->
						</div>
						
						<!-- BEGIN .booking_services_section -->
						<div class="postbox booking_services_section">
							<h2 class="hndle"><span><?php esc_html_e('Services', 'sohohotel_booking'); ?></span></h2>
							<div class="inside">
								
								<?php

								$args = array(
								'post_type' => 'service',
								'posts_per_page' => '9999'
								);

								$wp_query = new WP_Query( $args );
								if ($wp_query->have_posts()) : ?>

									<?php while($wp_query->have_posts()) :

										$wp_query->the_post(); ?>

										<?php
											// Get service data
											$service_meta = get_post_meta(get_the_ID(),'_service_meta',TRUE);
										?>

										<!-- BEGIN .clearfix -->
										<div class="clearfix">

											<div class="service-input-wrapper">
												<input type="checkbox" name="_booking_meta[service_<?php echo the_ID(); ?>]" value="true" <?php if( !empty($booking_meta['service_' . get_the_ID()]) ) { echo 'checked'; } ?>>
											</div>

											<div class="service-label-wrapper">
												<label for="_booking_meta[service_<?php echo the_ID(); ?>]"><?php echo get_the_title() . ' (' . sh_get_price($service_meta['price']) . ' / ' . sh_get_service_name($service_meta['price_scheme_1']) . ' / ' . sh_get_service_name($service_meta['price_scheme_2']) . ')'; ?></label>
											</div>

										<!-- END .clearfix -->
										</div>

									<?php endwhile; ?>

									<?php else : ?>
										<p><?php esc_html_e('There are no services available','sohohotel_booking'); ?></p>
									<?php endif;

								wp_reset_query();

								?>
								
							</div>
							
						<!-- END .booking_services_section -->
						</div>
						
						<!-- BEGIN .booking_guest_information_section -->
						<div class="postbox booking_guest_information_section">
							
							<h2 class="hndle"><span><?php esc_html_e('iCal Data', 'sohohotel_booking'); ?></span></h2>
							<div class="inside">

								<?php if(!empty($booking_meta['ical_data'])) {

									foreach ($booking_meta['ical_data'] as $key => $val) {
										echo $key . ': ' . $val . '<br />';
									}
									
									echo esc_html__('Feed URL', 'sohohotel_booking') . ': ' . $booking_meta['feed_url'] . '<br />';

								} else { ?>
									
									<p><?php esc_html_e('If the booking is imported from an iCal feed details will display here', 'sohohotel_booking'); ?></p>
									
								<?php }; ?>
								
							</div>
							
						<!-- END .booking_guest_information_section -->
						</div>
						
					<!-- END #postbox-container-2 -->
					</div>
					
				<!-- END .post-body -->
				</div>
			
				<br class="clear" />
			
			<!-- END #poststuff -->
			</div>
		
		<!-- END #post -->
		</form>
	
	<!-- END .wrap -->
	</div>

<?php }

?>