<?php

function booking_form_5_shortcode( $atts, $content = null ) {
	
	// Get theme options
	global $sohohotel_data;
	
	// Set max values
	$sh_get_booking_max_rooms = sh_get_booking_max_rooms();
	$sh_get_booking_max_guests = sh_get_booking_max_guests();
	
	ob_start(); ?>
	
	<!-- BEGIN .sh-single-booking-form-wrapper -->
	<div class="sh-single-booking-form-wrapper">
	
		<!-- BEGIN .sh-single-booking-form -->
		<div class="sh-single-booking-form">
		
			<form class="booking-form" action="<?php echo $sohohotel_data["booking_page_url"]; ?>" method="post" autocomplete="off">	
		
				<!-- BEGIN .sh-datepicker-wrapper -->
				<div class="sh-datepicker-wrapper">
			
					<input type="hidden" id="check_in_open_single_hidden" value="" />
					<input type="hidden" id="open_single_date_from" name="check_in_display" value="<?php esc_html_e('Check In','sohohotel_booking'); ?>" />
					<input type="hidden" id="check_single_in_alt" name="check_in" value="" />
					<input type="hidden" id="open_single_date_to" name="check_out_display" value="<?php esc_html_e('Check Out','sohohotel_booking'); ?>" />
					<input type="hidden" id="check_single_out_alt" name="check_out" value="" />
				
				<!-- END .sh-datepicker-wrapper -->
				</div>
		
				<a href="#" class="sh-select-dates"><i class="fa fa-calendar"></i><?php esc_html_e('Book Now','sohohotel_booking'); ?></a>
		
				<!-- BEGIN .sh-guestpicker-wrapper -->
				<div class="sh-guestpicker-wrapper clearfix">
					
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
					
					<div class="sh-adult-wrapper">
						<label for="book_room_adults_1"><?php esc_html_e('Adults','sohohotel_booking'); ?></label>
						<div class="select-wrapper">
							<i class="fa fa-angle-down"></i>
							<select id="book_room_adults_1" name="book_room_adults_1">
								<option value="none"><?php esc_html_e('Adults','sohohotel_booking'); ?></option>
								<?php foreach (range(1, $sh_get_booking_max_guests) as $r) { ?>
									<option value="<?php echo $r; ?>"><?php echo $r; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<div class="sh-child-wrapper">
						<label for="book_room_children_1"><?php esc_html_e('Children','sohohotel_booking'); ?></label>
						<div class="select-wrapper select-wrapper-last">
							<i class="fa fa-angle-down"></i>
							<select id="book_room_children_1" name="book_room_children_1">
								<option value="none"><?php esc_html_e('Children','sohohotel_booking'); ?></option>
								<?php foreach (range(0, $sh_get_booking_max_guests) as $r) { ?>
									<option value="<?php echo $r; ?>"><?php echo $r; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
			
					<a href="#" class="sh-change-dates"><i class="fa fa-angle-left"></i><?php esc_html_e('Change Dates','sohohotel_booking'); ?></a>
			
					<input type="hidden" id="external_form" name="external_form" value="true" />
					<input type="hidden" id="book_room" name="book_room" value="1" />
					<button type="submit" class="external_bookingbutton2"><i class="fa fa-calendar"></i><?php esc_html_e('Book Now','sohohotel_booking'); ?></button>
			
				<!-- END .sh-guestpicker-wrapper -->
				</div>
		
			</form>
		
		<!-- END .sh-single-booking-form -->
		</div>
	
	<!-- END .sh-single-booking-form-wrapper -->
	</div>
	
	<?php return ob_get_clean();
	
}

add_shortcode( 'booking_form_5', 'booking_form_5_shortcode' );

?>