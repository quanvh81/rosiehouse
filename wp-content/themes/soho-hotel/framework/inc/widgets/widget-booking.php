<?php

// Widget Class
class sohohotel_booking_widget extends WP_Widget {


/* ----------------------------------------------------------------------------

   Widget setup

---------------------------------------------------------------------------- */

	function __construct() {
		
		parent::__construct(false, $name = esc_html__('Soho Hotel Booking Form','soho-hotel'), array(
			'description' => esc_html__('Display Booking Form','soho-hotel')
		));
	
	}


/* ----------------------------------------------------------------------------

   Display widget

---------------------------------------------------------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$position = apply_filters('widget_position', $instance['position'] );
		
		// Get theme options
		global $sohohotel_data;

		// Set max values
		$sh_get_booking_max_rooms = sh_get_booking_max_rooms();
		$sh_get_booking_max_guests = sh_get_booking_max_guests(); ?>
		
		<?php if ($position == 'footer') {
			
			global $sohohotel_allowed_html_array;
			echo wp_kses($before_widget,$sohohotel_allowed_html_array);
			if ( $title ) {
				echo wp_kses($before_title . $title . $after_title,$sohohotel_allowed_html_array);
			 }
			
		} ?>
		
		<!-- BEGIN .sidebar-booking-form -->
		<div class="sidebar-booking-form sohohotel-widget">

			<!-- BEGIN .booking-form -->
			<form class="booking-form" action="<?php echo $sohohotel_data["booking_page_url"]; ?>" method="post" autocomplete="off">	
				
				<input type="hidden" id="check_in_hidden" value="" />
				
				<?php if( $sohohotel_data["booking_form_hotel"] == '1') { ?>
					
					<div class="booking-form-input-0">
						<label for="category"><?php esc_html_e('Hotel','soho-hotel'); ?></label>
						<div class="select-wrapper">
							<i class="fa fa-angle-down"></i>
							<select id="accommodation_category" name="accommodation_category">
								<option value=""><?php esc_html_e('All','soho-hotel'); ?></option>
				
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
					<label><?php esc_html_e('Check In','soho-hotel'); ?></label>
					<div class="input-wrapper">
						<i class="fa fa-angle-down"></i>
						<input type="text" id="check_in" name="check_in_display" value="<?php esc_html_e('Check In','soho-hotel'); ?>" />
						<input type="hidden" id="check_in_alt" name="check_in" value="" />
					</div>
				</div>

				<div class="booking-form-input-2">
					<label><?php esc_html_e('Check Out','soho-hotel'); ?></label>
					<div class="input-wrapper">
						<i class="fa fa-angle-down"></i>
						<input type="text" id="check_out" name="check_out_display" value="<?php esc_html_e('Check Out','soho-hotel'); ?>" />
						<input type="hidden" id="check_out_alt" name="check_out" value="" />
					</div>
				</div>

				<div class="booking-form-input-3-alt clearfix">
					<label><?php esc_html_e('Rooms & Guests','soho-hotel'); ?></label>
					<div class="room-guest-selection">

						<div class="room-selection">
							<span class="room-value">1</span>
							<span class="room-title"><?php esc_html_e('Room(s)','soho-hotel'); ?></span>
							<i class="fa fa-angle-down"></i>
						</div>

						<div class="guest-selection">
							<span class="guest-value">1</span>
							<span class="guest-title"><?php esc_html_e('Guest(s)','soho-hotel'); ?></span>
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

										<p class="room-input-title"><?php esc_html_e('Room','soho-hotel'); ?> <span class="room-count">1</span><span class="remove-room-btn"><a href="#"><?php esc_html_e('Remove','soho-hotel'); ?><span>x</span></a></span></p>

										<div class="clearfix">

											<div class="adult-selection-wrapper">
												<label><?php esc_html_e('Adults','soho-hotel'); ?></label>
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
												<label><?php esc_html_e('Children','soho-hotel'); ?></label>
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

										<p class="room-input-title"><?php esc_html_e('Room','soho-hotel'); ?> <span class="room-count">1</span><span class="remove-room-btn"><a href="#"><?php esc_html_e('Remove','soho-hotel'); ?><span>x</span></a></span></p>

										<div class="clearfix">

											<div class="adult-selection-wrapper">
												<label><?php esc_html_e('Adults','soho-hotel'); ?></label>
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
												<label><?php esc_html_e('Children','soho-hotel'); ?></label>
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

							<a href="#" class="add-another-room-btn"><?php esc_html_e('+ Add another room','soho-hotel'); ?></a>
							<p class="booking-room-limit"><?php echo esc_html__('Bookings are limited to ','soho-hotel') . ' ' . sh_get_booking_max_rooms() . ' ' . esc_html__('rooms','soho-hotel'); ?></p>
							<a href="#" class="room-selection-done-btn"><?php esc_html_e('Done','soho-hotel'); ?></a>

						<!-- END .room-guest-selection-input-wrapper -->	
						</div>

					</div>
				</div>

				<div class="booking-form-input-5">
					<input type="hidden" id="external_form" name="external_form" value="true" />
					<input type="hidden" id="book_room" name="book_room" value="1" />
					<button type="submit" class="external_bookingbutton"><i class="fa fa-calendar"></i><?php esc_html_e('Check Availability','soho-hotel'); ?></button>
				</div>

			<!-- END  .booking-form -->
			</form>

		<!-- END .sidebar-booking-form -->
		</div>
		
		<?php
		
		if ($position == 'footer') {
			
			echo wp_kses($after_widget,$sohohotel_allowed_html_array);
			
		}
		
	}	
	
	
/* ----------------------------------------------------------------------------

   Update widget

---------------------------------------------------------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['position'] = strip_tags( $new_instance['position'] );
		return $instance;
	}
	
	
/* ----------------------------------------------------------------------------

   Widget input form

---------------------------------------------------------------------------- */

	function form( $instance ) {
		$defaults = array(
		'title' => 'Booking Form',
		'position' => 'sidebar'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'soho-hotel'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'position' )); ?>"><?php esc_html_e('Widget Position:', 'soho-hotel'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id( 'position' )); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name( 'position' )); ?>">
				<option value="sidebar" <?php if ( $instance['position'] == 'sidebar' ) {echo 'selected="selected"';} ?>><?php esc_html_e('Sidebar', 'soho-hotel'); ?></option>
				<option value="footer" <?php if ( $instance['position'] == 'footer' ) {echo 'selected="selected"';} ?>><?php esc_html_e('Footer', 'soho-hotel'); ?></option>
			</select>
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'sohohotel_booking_widget' );

// Register Widget
function sohohotel_booking_widget() {
	register_widget( 'sohohotel_booking_widget' );
}