<?php

function booking_form_4_shortcode( $atts, $content = null ) {
	
	// Get theme options
	global $sohohotel_data;
	
	// Set max values
	$sh_get_booking_max_rooms = sh_get_booking_max_rooms();
	$sh_get_booking_max_guests = sh_get_booking_max_guests();
	
	ob_start(); ?>
	
	<!-- BEGIN .wide-booking-form-2 -->
	<div class="wide-booking-form-2 clearfix">

		<!-- BEGIN .booking-form -->
		<form class="booking-form booking-form-3" action="<?php echo $sohohotel_data["booking_page_url"]; ?>" method="post" autocomplete="off">	

			<input type="hidden" id="check_in_hidden" value="" />	
			
			<?php if( $sohohotel_data["booking_form_hotel"] == '1') { ?>
				
				<div class="booking-form-input-0">
					<label for="category"><?php esc_html_e('Hotel','sohohotel_booking'); ?></label>
					<div class="select-wrapper">
						<i class="fa fa-angle-down"></i>
						<select id="accommodation_category" name="accommodation_category">
							<option value=""><?php esc_html_e('All','sohohotel_booking'); ?></option>
			
							<?php $taxonomy = 'accommodation-categories';
							$terms = get_terms($taxonomy);

							if ( $terms && !is_wp_error( $terms ) ) :
				
							foreach ( $terms as $term ) { ?>
								<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
							        <?php } 
							endif;?>
			
						</select>
					</div>
				</div>

			<?php } ?>
			
			<div class="booking-form-input-1">
				<label for="check_in"><?php esc_html_e('Check In','sohohotel_booking'); ?></label>
				<div class="input-wrapper">
					<i class="fa fa-angle-down"></i>
					<input type="text" id="check_in" name="check_in_display" value="<?php esc_html_e('Check In','sohohotel_booking'); ?>" />
					<input type="hidden" id="check_in_alt" name="check_in" value="" />
				</div>
			</div>

			<div class="booking-form-input-2">
				<label for="check_out"><?php esc_html_e('Check Out','sohohotel_booking'); ?></label>
				<div class="input-wrapper">
					<i class="fa fa-angle-down"></i>
					<input type="text" id="check_out" name="check_out_display" value="<?php esc_html_e('Check Out','sohohotel_booking'); ?>" />
					<input type="hidden" id="check_out_alt" name="check_out" value="" />
				</div>
			</div>

			<div class="booking-form-input-3-alt clearfix">
				<label><?php esc_html_e('Rooms & Guests','sohohotel_booking'); ?></label>
				<div class="room-guest-selection">
					
					<div class="room-selection">
						<span class="room-value">1</span>
						<span class="room-title"><?php esc_html_e('Room(s)','sohohotel_booking'); ?></span>
						<i class="fa fa-angle-down"></i>
					</div>
					
					<div class="guest-selection">
						<span class="guest-value">1</span>
						<span class="guest-title"><?php esc_html_e('Guest(s)','sohohotel_booking'); ?></span>
						<i class="fa fa-angle-down"></i>
					</div>
					
					<!-- BEGIN .room-guest-selection-input-wrapper -->
					<div class="room-guest-selection-input-wrapper">
						
						<!-- BEGIN .room-guest-selection-input -->
						<div class="room-guest-selection-input">
						
							<!-- BEGIN .room-input-wrapper-outer -->
							<div class="room-input-wrapper-outer">

								<!-- BEGIN .room-input-wrapper -->
								<div class="room-input-wrapper">

									<p class="room-input-title"><?php esc_html_e('Room','sohohotel_booking'); ?> <span class="room-count">1</span><span class="remove-room-btn"><a href="#"><?php esc_html_e('Remove','sohohotel_booking'); ?><span>x</span></a></span></p>

									<div class="clearfix">

										<div class="adult-selection-wrapper">
											<label><?php esc_html_e('Adults','sohohotel_booking'); ?></label>
											<div class="select-wrapper">
												<i class="fa fa-angle-down"></i>
												<select class="book_room_adults" name="book_room_adults_1">
													<?php foreach (range(1, $sh_get_booking_max_guests) as $r) { ?>
														<option value="<?php echo $r; ?>"><?php echo $r; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>

										<div class="child-selection-wrapper">
											<label><?php esc_html_e('Children','sohohotel_booking'); ?></label>
											<div class="select-wrapper">
												<i class="fa fa-angle-down"></i>
												<select class="book_room_children" name="book_room_children_1">
													<?php foreach (range(0, $sh_get_booking_max_guests) as $r) { ?>
														<option value="<?php echo $r; ?>"><?php echo $r; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>

									</div>

								<!-- END .room-input-wrapper -->	
								</div>

							<!-- END .room-input-wrapper-outer -->
							</div>
						
							<!-- BEGIN .room-input-wrapper-hidden -->
							<div class="room-input-wrapper-hidden">

								<!-- BEGIN .room-input-wrapper -->
								<div class="room-input-wrapper">

									<p class="room-input-title"><?php esc_html_e('Room','sohohotel_booking'); ?> <span class="room-count">1</span><span class="remove-room-btn"><a href="#"><?php esc_html_e('Remove','sohohotel_booking'); ?><span>x</span></a></span></p>

									<div class="clearfix">

										<div class="adult-selection-wrapper">
											<label><?php esc_html_e('Adults','sohohotel_booking'); ?></label>
											<div class="select-wrapper">
												<i class="fa fa-angle-down"></i>
												<select class="book_room_adults" name="book_room_adults">
													<?php foreach (range(1, $sh_get_booking_max_guests) as $r) { ?>
														<option value="<?php echo $r; ?>"><?php echo $r; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>

										<div class="child-selection-wrapper">
											<label><?php esc_html_e('Children','sohohotel_booking'); ?></label>
											<div class="select-wrapper">
												<i class="fa fa-angle-down"></i>
												<select class="book_room_children" name="book_room_children">
													<?php foreach (range(0, $sh_get_booking_max_guests) as $r) { ?>
														<option value="<?php echo $r; ?>"><?php echo $r; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>

									</div>

								<!-- END .room-input-wrapper -->	
								</div>

							<!-- END .room-input-wrapper-hidden -->	
							</div>
							
						<!-- END .room-guest-selection-input -->	
						</div>
						
						<a href="#" class="add-another-room-btn"><?php esc_html_e('+ Add another room','sohohotel_booking'); ?></a>
						<p class="booking-room-limit"><?php echo esc_html__('Bookings are limited to ','sohohotel_booking') . ' ' . sh_get_booking_max_rooms() . ' ' . esc_html__('rooms','sohohotel_booking'); ?></p>
						<a href="#" class="room-selection-done-btn"><?php esc_html_e('Done','sohohotel_booking'); ?></a>
					
					<!-- END .room-guest-selection-input-wrapper -->	
					</div>
					
				</div>
			</div>

			<div class="booking-form-input-5">
				<input type="hidden" id="external_form" name="external_form" value="true" />
				<input type="hidden" id="book_room" name="book_room" value="1" />
				<button type="submit" class="external_bookingbutton"><i class="fa fa-calendar"></i><?php esc_html_e('Check Availability','sohohotel_booking'); ?></button>
			</div>

		<!-- END  .booking-form -->
		</form>

	<!-- END .wide-booking-form-2 -->
	</div>
	
	<?php return ob_get_clean();
	
}

add_shortcode( 'booking_form_4', 'booking_form_4_shortcode' );

?>