<?php
	
	// Display Header
	get_header();
	
	global $sohohotel_data;
	global $page_layout;
	
	// Get Room Data
	$accommodation_meta = json_decode( get_post_meta($post->ID,'_accommodation_meta',TRUE), true );
	
	// Set max values
	$quitenicebooking_max_rooms = sh_get_booking_max_rooms();
	$quitenicebooking_max_persons_in_form = sh_get_booking_max_guests();
	
	// Reset Query
	wp_reset_postdata();

?>

<?php get_template_part( 'sohohotel', 'pageheader1' ); ?>

<!-- BEGIN .sohohotel-content-wrapper -->
<div class="sohohotel-content-wrapper sohohotel-clearfix sohohotel-content-wrapper-<?php echo $page_layout['sohohotel-content-wrapper']; ?>">

	<!-- BEGIN .sohohotel-main-content -->
	<div class="sohohotel-main-content sohohotel-main-content-<?php echo $page_layout['sohohotel-main-content']; ?>">
		
		<?php if ( post_password_required() ) {
			echo sohohotel_password_form();
		} else { ?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>		
			<?php endwhile; endif; ?>

		<?php } ?>
	
	<!-- END .sohohotel-main-content -->
	</div>
	
	<?php if( $page_layout['sohohotel-sidebar-content'] == 'left-sidebar' OR $page_layout['sohohotel-sidebar-content'] == 'right-sidebar' ) { ?>
	
		<!-- BEGIN .sohohotel-sidebar-content -->
		<div class="sohohotel-sidebar-content sohohotel-sidebar-content-<?php echo $page_layout['sohohotel-sidebar-content']; ?>">
		
			<!-- BEGIN .sidebar-booking-form -->
			<div class="sidebar-booking-form">

				<!-- BEGIN .booking-form -->
				<form class="booking-form" action="<?php echo $sohohotel_data['booking_page_url']; ?>" method="post" autocomplete="off">	
				
					<input type="hidden" id="check_in_hidden" value="" />
				
					<div class="room-price-widget">
						<p class="from"><?php esc_html_e('Room From', 'sohohotel_booking'); ?></p>
						<h3 class="price"><?php echo sh_get_price($accommodation_meta['price_adult_weekdays']); ?></h3>
						<p class="price-detail"><?php esc_html_e('Per Night', 'sohohotel_booking'); ?></p> 
					</div>

					<div class="booking-form-input-1">
						<label for="check_in"><?php esc_html_e('Check In', 'sohohotel_booking'); ?></label>
						<div class="input-wrapper">
							<i class="fa fa-angle-down"></i>
							<input type="text" id="check_in" name="check_in_display" value="<?php esc_html_e('Check In', 'sohohotel_booking'); ?>" />
							<input type="hidden" id="check_in_alt" name="check_in" value="" />
						</div>
					</div>

					<div class="booking-form-input-2">
						<label for="check_out"><?php esc_html_e('Check Out', 'sohohotel_booking'); ?></label>
						<div class="input-wrapper">
							<i class="fa fa-angle-down"></i>
							<input type="text" id="check_out" name="check_out_display" value="<?php esc_html_e('Check Out', 'sohohotel_booking'); ?>" />
							<input type="hidden" id="check_out_alt" name="check_out" value="" />
						</div>
					</div>

					<div class="booking-form-input-3 clearfix">

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half">

							<label for="book_room_adults_1"><?php esc_html_e('Adults', 'sohohotel_booking'); ?></label>
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
								<select id="book_room_adults_1" name="book_room_adults_1">
									<option value="none"><?php esc_html_e('Adults', 'sohohotel_booking'); ?></option>
								
									<?php foreach (range(1, $quitenicebooking_max_persons_in_form) as $r) {
										echo '<option value="' . $r . '">' . $r . '</option>';
									} ?>
			
								</select>
							</div>

						<!-- END .qns-one-half -->
						</div>

						<!-- BEGIN .qns-one-half -->
						<div class="qns-one-half qns-last">

							<label for="book_room_children_1"><?php esc_html_e('Children', 'sohohotel_booking'); ?></label>
							<div class="select-wrapper">
								<i class="fa fa-angle-down"></i>
								<select id="book_room_children_1" name="book_room_children_1">
									<option value="none"><?php esc_html_e('Children', 'sohohotel_booking'); ?></option>
								
									<?php foreach (range(0, $quitenicebooking_max_persons_in_form) as $r) {
										echo '<option value="' . $r . '">' . $r . '</option>';
									} ?>
								
								</select>
							</div>

						<!-- END .qns-one-half -->
						</div>

					</div>

					<div class="booking-form-input-5">
						<input type="hidden" id="external_form" name="external_form" value="true" />
						<input type="hidden" id="book_room" name="book_room" value="1" />
						<input type="hidden" name="accommodation_single_id" value="<?php the_ID(); ?>" />
						<button type="submit" class="external_bookingbutton"><i class="fa fa-calendar"></i><?php esc_html_e('Check Availability', 'sohohotel_booking'); ?></button>
					</div>

				<!-- END  .booking-form -->
				</form>

			<!-- END .sidebar-booking-form -->
			</div>
		
		<!-- END .sohohotel-sidebar-content -->
		</div>
	
	<?php } ?>
	
<!-- END .sh-content-wrapper -->
</div>

<?php get_footer(); ?>