<!-- BEGIN .sohohotel_booking-field-wrapper -->
<div class="sohohotel_booking-field-wrapper clearfix">
	
	<div class="sohohotel_booking-one-third">
		<label><?php esc_html_e('Number of rooms of this type available','sohohotel_booking'); ?></label>	
	</div>	
	
	<div class="sohohotel_booking-one-third">
		<select name="_accommodation_meta[number_of_rooms_this_type]">	
		<?php for ($i = 1; $i <= 100; $i++) : ?>
			<?php if ($accommodation_meta['number_of_rooms_this_type'] == $i ) { ?>	
		        <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
				<?php } else { ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
		<?php endfor; ?>
		</select>
	</div>
	
	<div class="sohohotel_booking-one-third">
		<span class="description"></span>
	</div>
	
<!-- END .sohohotel_booking-field-wrapper -->	
</div>

<hr class="space1" />
	
<!-- BEGIN .sohohotel_booking-field-wrapper -->	
<div class="sohohotel_booking-field-wrapper clearfix">
	
	<div class="sohohotel_booking-one-third">
		<label><?php esc_html_e('Maximum Occupancy','sohohotel_booking'); ?></label>
	</div>
	
	<div class="sohohotel_booking-one-third">
		<select name="_accommodation_meta[maximum_occupancy]">	
		<?php for ($i = 1; $i <= 100; $i++) : ?>
			<?php if ($accommodation_meta['maximum_occupancy'] == $i ) { ?>	
		        <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
			<?php } else { ?>
				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php } ?>
		<?php endfor; ?>
		</select>
	</div>
	
	<div class="sohohotel_booking-one-third">
		<span class="description"><?php esc_html_e('The maximum number of guests this room can accommodate','sohohotel_booking'); ?></span>
	</div>
			
<!-- END .sohohotel_booking-field-wrapper -->	
</div>