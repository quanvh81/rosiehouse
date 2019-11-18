<?php global $sohohotel_data; ?>

<!-- BEGIN .sohohotel_booking-field-wrapper -->
<div class="sohohotel_booking-field-wrapper clearfix">
	
	<div class="sohohotel_booking-one-third">
		<?php esc_html_e('Room','sohohotel_booking'); ?>
	</div>
	
	<div class="sohohotel_booking-two-thirds">
		<select name="_blocked_dates_meta[room_type]">

			<?php global $post;

			$args = array(
			'post_type' => 'accommodation',
			'posts_per_page' => '9999',
			);

			$wp_query = new WP_Query( $args );
			if ($wp_query->have_posts()) :
				while($wp_query->have_posts()) :	
					$wp_query->the_post(); ?>
					
					<option value="<?php the_ID(); ?>" <?php if( !empty($blocked_dates_meta) ) { if( $blocked_dates_meta['room_type'] == get_the_ID() ) {echo 'selected';} } ?>><?php echo the_title(); ?></option>

				<?php endwhile;
			else :
				esc_html_e('No bookings','sohohotel_booking');
			endif;

			wp_reset_query(); ?>

		</select>
	</div>

<!-- END .sohohotel_booking-field-wrapper -->
</div>

<hr class="space1" />

<!-- BEGIN .sohohotel_booking-field-wrapper -->
<div class="sohohotel_booking-field-wrapper clearfix">
	
	<div class="sohohotel_booking-one-third">
		<?php esc_html_e('Dates','sohohotel_booking'); ?>
	</div>
	
	<div class="sohohotel_booking-two-thirds">
		
		<label for="blocked_dates_discount_type_flat"><?php esc_html_e('From','sohohotel_booking'); ?></label>
		<input class="sh-required-field datepicker blocked_check_in check_in" type="text" value="<?php if(!empty($blocked_dates_meta['from'])) echo sh_display_formatted_date($blocked_dates_meta['from']); ?>" />
		<input class="check_in_alt" type="text" name="_blocked_dates_meta[from]" value="<?php if(!empty($blocked_dates_meta['from'])) echo $blocked_dates_meta['from']; ?>" />
		
		<hr class="space3" />
		
		<label for="blocked_dates_discount_type_flat"><?php esc_html_e('To','sohohotel_booking'); ?></label>
		<input class="sh-required-field datepicker blocked_check_out check_out" type="text" value="<?php if(!empty($blocked_dates_meta['to'])) echo sh_display_formatted_date($blocked_dates_meta['to']); ?>" />
		<input class="check_out_alt" type="text" name="_blocked_dates_meta[to]" value="<?php if(!empty($blocked_dates_meta['to'])) echo $blocked_dates_meta['to']; ?>" />
		
	</div>

<!-- END .sohohotel_booking-field-wrapper -->
</div>

<hr class="space1" />

<!-- BEGIN .sohohotel_booking-field-wrapper -->
<div class="sohohotel_booking-field-wrapper clearfix">
	
	<!-- BEGIN #blocked_dates_discount_type_flat_fields -->
	<div id="blocked_dates_discount_type_flat_fields">
	
		<div class="sohohotel_booking-one-third">
			<?php esc_html_e('Days of the week to be blocked within the above specified date range','sohohotel_booking'); ?>
		</div>

		<div class="sohohotel_booking-two-thirds">
			
			<a href="#" id="sh_checkall"><?php esc_html_e('Check All','sohohotel_booking'); ?></a>
			
			<!-- BEGIN .weekday_checkboxes -->
			<div class="weekday_checkboxes">
				
				<div class="clearfix">
					<input type="checkbox" class="sh-blocked-day" name="_blocked_dates_meta[weekday_mon]" value="1" <?php if(!empty($blocked_dates_meta['weekday_mon'])) echo 'checked'; ?>>
					<label for="blocked_dates_weekdays"><?php esc_html_e('Mon','sohohotel_booking'); ?></label>
				</div>
				
				<div class="clearfix">
					<input type="checkbox" class="sh-blocked-day" name="_blocked_dates_meta[weekday_tue]" value="1" <?php if(!empty($blocked_dates_meta['weekday_tue'])) echo 'checked'; ?>>
					<label for="blocked_dates_weekdays"><?php esc_html_e('Tue','sohohotel_booking'); ?></label>
				</div>
				
				<div class="clearfix">
					<input type="checkbox" class="sh-blocked-day" name="_blocked_dates_meta[weekday_wed]" value="1" <?php if(!empty($blocked_dates_meta['weekday_wed'])) echo 'checked'; ?>>
					<label for="blocked_dates_weekdays"><?php esc_html_e('Wed','sohohotel_booking'); ?></label>
				</div>
				
				<div class="clearfix">
					<input type="checkbox" class="sh-blocked-day" name="_blocked_dates_meta[weekday_thu]" value="1" <?php if(!empty($blocked_dates_meta['weekday_thu'])) echo 'checked'; ?>>
					<label for="blocked_dates_weekdays"><?php esc_html_e('Thu','sohohotel_booking'); ?></label>
				</div>
				
				<div class="clearfix">
					<input type="checkbox" class="sh-blocked-day" name="_blocked_dates_meta[weekday_fri]" value="1" <?php if(!empty($blocked_dates_meta['weekday_fri'])) echo 'checked'; ?>>
					<label for="blocked_dates_weekdays"><?php esc_html_e('Fri','sohohotel_booking'); ?></label>
				</div>
				
				<div class="clearfix">
					<input type="checkbox" class="sh-blocked-day" name="_blocked_dates_meta[weekday_sat]" value="1" <?php if(!empty($blocked_dates_meta['weekday_sat'])) echo 'checked'; ?>>
					<label for="blocked_dates_weekdays"><?php esc_html_e('Sat','sohohotel_booking'); ?></label>
				</div>
				
				<div class="clearfix">
					<input type="checkbox" class="sh-blocked-day" name="_blocked_dates_meta[weekday_sun]" value="1" <?php if(!empty($blocked_dates_meta['weekday_sun'])) echo 'checked'; ?>>
					<label for="blocked_dates_weekdays"><?php esc_html_e('Sun','sohohotel_booking'); ?></label>
				</div>
				
			<!-- END .weekday_checkboxes -->
			</div>
			
		</div>
	
	<!-- END #blocked_dates_discount_type_flat_fields -->
	</div>

<!-- END .sohohotel_booking-field-wrapper -->
</div>