<?php

// Get theme options
global $sohohotel_data;

// Set max values
$sh_get_booking_max_rooms = sh_get_booking_max_rooms();
$sh_get_booking_max_guests = sh_get_booking_max_guests();

// Set date and room values
if ( !empty( $_POST["edit_step_2"] ) ) {
	
	$sh_booking_data = $_SESSION['sh_booking_data'];
	$check_in_display = sh_display_formatted_date($sh_booking_data["check_in"]);
	$check_in_alt = $sh_booking_data["check_in"];
	$check_out_display = sh_display_formatted_date($sh_booking_data["check_out"]);
	$check_out_alt = $sh_booking_data["check_out"];
	$book_room_value = $sh_booking_data["book_room"];
	
} else {
	
	if ( !empty($_POST['check_in_display']) ) {
		
		$check_in_display = $_POST['check_in_display'];
		$check_in_alt = $_POST['check_in'];
		$check_out_display = $_POST['check_out_display'];
		$check_out_alt = $_POST['check_out'];
		$book_room_value = $_POST['book_room'];
		
	} else {
		
		$check_in_display = '';
		$check_in_alt = '';
		$check_out_display = '';
		$check_out_alt = '';
		$book_room_value = '';
		
	}
	
} ?>

<h4><?php esc_html_e('Your Reservation', 'sohohotel_booking'); ?></h4>
<div class="title-block-3"></div>

<form name="bookroom" class="booking-form-data">
	
	<?php if( $sohohotel_data["booking_form_hotel"] == '1') { ?>
		
		<label for="category"><?php esc_html_e('Hotel','sohohotel_booking'); ?></label>
		<div class="select-wrapper">
			<i class="fa fa-angle-down"></i>
			<select id="accommodation_category" name="accommodation_category">
				<option value=""><?php esc_html_e('All','sohohotel_booking'); ?></option>
				
				<?php $taxonomy = 'accommodation-categories';
				$terms = get_terms($taxonomy);

				if ( $terms && !is_wp_error( $terms ) ) :
					
				foreach ( $terms as $term ) { ?>
					<option value="<?php echo $term->slug; ?>" <?php if ( $_POST['accommodation_category'] == $term->slug ) { echo 'selected'; } ?>><?php echo $term->name; ?></option>
				        <?php } 
				endif;?>
				
			</select>
		</div>
	
	<?php } ?>
	
	<label for="open_date_from"><?php esc_html_e('Check In', 'sohohotel_booking'); ?></label>
	<div class="input-wrapper">
		<i class="fa fa-angle-down"></i>
		<input type="text" id="open_date_from" size="10" value="<?php echo $check_in_display; ?>" />
		<input type="hidden" id="check_in_alt" name="check_in" value="<?php echo $check_in_alt; ?>" />
	</div>

	<label for="open_date_to"><?php esc_html_e('Check Out', 'sohohotel_booking'); ?></label>
	<div class="input-wrapper">
		<i class="fa fa-angle-down"></i>
		<input type="text" id="open_date_to" size="10" value="<?php echo $check_out_display; ?>" />
		<input type="hidden" id="check_out_alt" name="check_out" value="<?php echo $check_out_alt; ?>" />
	</div>

	<label for="book_room"><?php esc_html_e('Rooms', 'sohohotel_booking'); ?></label>
	<div class="select-wrapper">
		<i class="fa fa-angle-down"></i>
		<select name="book_room" id="book_room">
			<?php foreach (range(1, $sh_get_booking_max_rooms) as $r) { ?>
				<option value="<?php echo $r; ?>" <?php if ( $book_room_value == $r ) { echo 'selected'; } ?>><?php echo $r; ?></option>
			<?php } ?>
		</select>
	</div>
	
	<!-- BEGIN .rooms-wrapper -->
	<div class="rooms-wrapper">

		<?php foreach (range(1, $sh_get_booking_max_rooms) as $i) { ?>

			<!-- BEGIN .room-<?php echo $i; ?> -->
			<div class="room-<?php echo $i; ?> clearfix">

				<p class="label"><?php esc_html_e('Room', 'sohohotel_booking'); ?> <?php echo $i; ?></p>

				<!-- BEGIN .adult-child-wrapper -->
				<div class="adult-child-wrapper clearfix">

					<div class="one-half">
						<label for="book_room_adults_<?php echo $i; ?>"><?php esc_html_e('Adults', 'sohohotel_booking'); ?></label>
						<div class="select-wrapper">
							<i class="fa fa-angle-down"></i>
							<select name="book_room_adults_<?php echo $i; ?>" id="book_room_adults_<?php echo $i; ?>">
								<?php foreach (range(1, $sh_get_booking_max_guests) as $r) { ?>
									<option value="<?php echo $r; ?>" <?php if ( !empty( $_POST["edit_step_2"] ) ) { 
										
										if ( !empty($sh_booking_data["room_" . $i ]["adults"]) ) { if ( $sh_booking_data["room_" . $i ]["adults"] == $r ) { echo 'selected'; }}
										
									} else {
										
										if ( !empty($_POST["book_room_adults_" . $i]) ) { if ( $_POST["book_room_adults_" . $i] == $r ) { echo 'selected'; }}
										
									} ?>><?php echo $r; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="one-half last-col">
						<label for="book_room_children_<?php echo $i; ?>"><?php esc_html_e('Children', 'sohohotel_booking'); ?></label>
						<div class="select-wrapper">
							<i class="fa fa-angle-down"></i>
							<select name="book_room_children_<?php echo $i; ?>" id="book_room_children_<?php echo $i; ?>">
								<?php foreach (range(0, $sh_get_booking_max_guests) as $r) { ?>
									<option value="<?php echo $r; ?>" <?php if ( !empty( $_POST["edit_step_2"] ) ) { 
										
										if ( !empty($sh_booking_data["room_" . $i ]["children"]) ) { if ( $sh_booking_data["room_" . $i ]["children"] == $r ) { echo 'selected'; }}
										
									} else {
										
										if ( !empty($_POST["book_room_children_" . $i]) ) { if ( $_POST["book_room_children_" . $i] == $r ) { echo 'selected'; }}
										
									} ?>><?php echo $r; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

				<!-- END .adult-child-wrapper -->
				</div>

			<!-- BEGIN .room-<?php echo $i; ?> -->
			</div>

		<?php } ?>

	<!-- BEGIN .rooms-wrapper -->
	</div>
	
	<input type="hidden" name="accommodation_single_id" value="<?php if ( !empty( $_POST['accommodation_single_id'] ) ) {echo $_POST['accommodation_single_id'];} ?>" />
	
	<input type="hidden" name="action" value="sh_booking_process_frontend_action_callback" />
	<?php echo wp_nonce_field('sh_booking_process_frontend', '_acf_nonce', true, false); ?>
	<button type="button" class="bookingbutton"><?php esc_html_e('Check Availability', 'sohohotel_booking'); ?> <i class="fa fa-calendar"></i></button>

</form>