<?php

function booking_form_2_shortcode( $atts, $content = null ) {
	
	// Get theme options
	global $sohohotel_data;
	
	// Set max values
	$sh_get_booking_max_rooms = sh_get_booking_max_rooms();
	$sh_get_booking_max_guests = sh_get_booking_max_guests();
	
	ob_start(); ?>
		
		<!-- BEGIN .vertical-booking-form-wrapper -->
		<div class="vertical-booking-form-wrapper">

			<!-- BEGIN .booking-form -->
			<form class="booking-form vertical-booking-form" action="<?php echo $sohohotel_data["booking_page_url"]; ?>" method="post" autocomplete="off">	
				
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

				<div class="booking-form-input-3 clearfix">

					<div class="qns-one-half">
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

					<div class="qns-one-half qns-last">
						<label for="book_room_children_1"><?php esc_html_e('Children','sohohotel_booking'); ?></label>
						<div class="select-wrapper">
							<i class="fa fa-angle-down"></i>
							<select id="book_room_children_1" name="book_room_children_1">
								<option value="none"><?php esc_html_e('Children','sohohotel_booking'); ?></option>
								<?php foreach (range(0, $sh_get_booking_max_guests) as $r) { ?>
									<option value="<?php echo $r; ?>"><?php echo $r; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

				</div>

				<div class="booking-form-input-5">
					<input type="hidden" id="external_form" name="external_form" value="true" />
					<input type="hidden" id="book_room" name="book_room" value="1" />
					<button type="submit" class="external_bookingbutton"><?php esc_html_e('Check Availability','sohohotel_booking'); ?> <i class="fa fa-calendar"></i></button>
				</div>

			<!-- END  .booking-form -->
			</form>
			
		<!-- END .vertical-booking-form-wrapper -->
		</div>
	
	<?php return ob_get_clean();
	
}

add_shortcode( 'booking_form_2', 'booking_form_2_shortcode' );

?>