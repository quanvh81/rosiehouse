<?php global $sohohotel_data; ?>

<!-- BEGIN .sohohotel_booking-field-wrapper -->
<div class="sohohotel_booking-field-wrapper clearfix">
	
	<div class="sohohotel_booking-one-third">
		<?php echo esc_html__('Price','sohohotel_booking') . ' (' . $sohohotel_data['currency_unit'] . ')'; ?>
	</div>
	
	<div class="sohohotel_booking-one-third">
		<input class="sh-required-field sh-is-numeric" type="text" name="_service_meta[price]" value="<?php if ($service_meta) {if( strlen($service_meta['price']) != 0 ) {echo $service_meta['price'];}} ?>"/>
	</div>

<!-- END .sohohotel_booking-field-wrapper -->
</div>

<hr class="space1" />

<!-- BEGIN .sohohotel_booking-field-wrapper -->
<div class="sohohotel_booking-field-wrapper clearfix">
	
	<div class="sohohotel_booking-one-third">
		<?php esc_html_e('Price Type','sohohotel_booking'); ?>
	</div>
	
	<div class="sohohotel_booking-one-third">
		<label><?php esc_html_e('Charge','sohohotel_booking'); ?></label>
		<select name="_service_meta[price_scheme_1]">
			<option value="flatfee" <?php if ( !empty($service_meta['price_scheme_1']) ) { if ($service_meta['price_scheme_1'] == 'flatfee' ) { echo 'selected'; } } ?>><?php esc_html_e('Flat Fee','sohohotel_booking'); ?></option>
			<option value="perroom" <?php if ( !empty($service_meta['price_scheme_1']) ) { if ($service_meta['price_scheme_1'] == 'perroom' ) { echo 'selected'; } } ?>><?php esc_html_e('Per Room','sohohotel_booking'); ?></option>
			<option value="perperson" <?php if ( !empty($service_meta['price_scheme_1']) ) { if ($service_meta['price_scheme_1'] == 'perperson' ) { echo 'selected'; } } ?>><?php esc_html_e('Per Person','sohohotel_booking'); ?></option>
		</select>
		
		<hr class="sohohotel_booking-space2" />
		
		<label><?php esc_html_e('Per','sohohotel_booking'); ?></label>
		<select name="_service_meta[price_scheme_2]">	
			<option value="pernight" <?php if ( !empty($service_meta['price_scheme_2']) ) { if ($service_meta['price_scheme_2'] == 'pernight' ) { echo 'selected'; } } ?>><?php esc_html_e('Night','sohohotel_booking'); ?></option>
			<option value="perbooking" <?php if ( !empty($service_meta['price_scheme_2']) ) { if ($service_meta['price_scheme_2'] == 'perbooking' ) { echo 'selected'; } } ?>><?php esc_html_e('Booking','sohohotel_booking'); ?></option>
		</select>
	</div>

<!-- END .sohohotel_booking-field-wrapper -->
</div>

<hr class="space1" />

<!-- BEGIN .sohohotel_booking-field-wrapper -->
<div class="sohohotel_booking-field-wrapper clearfix">
	
	<div class="sohohotel_booking-one-third">
		<?php esc_html_e('Optional or Mandatory','sohohotel_booking'); ?>
	</div>
	
	<div class="sohohotel_booking-one-third">
		<select name="_service_meta[optional_mandatory]">
			<option value="optional" <?php if ( !empty($service_meta['optional_mandatory']) ) { if ($service_meta['optional_mandatory'] == 'optional' ) { echo 'selected'; } } ?>><?php esc_html_e('Optional','sohohotel_booking'); ?></option>
			<option value="mandatory" <?php if ( !empty($service_meta['optional_mandatory']) ) { if ($service_meta['optional_mandatory'] == 'mandatory' ) { echo 'selected'; } } ?>><?php esc_html_e('Mandatory','sohohotel_booking'); ?></option>
		</select>
	</div>
	
	<div class="sohohotel_booking-one-third">
		<span class="description"><?php esc_html_e('If you select "Mandatory" the service/charge will be automatically added for all bookings','sohohotel_booking'); ?></span>
	</div>

<!-- END .sohohotel_booking-field-wrapper -->
</div>