<?php global $sohohotel_data; ?>

<!-- BEGIN .sohohotel_booking-field-wrapper -->
<div class="sohohotel_booking-field-wrapper clearfix">
	
	<div class="sohohotel_booking-one-third">
		<?php esc_html_e('Coupon Code','sohohotel_booking'); ?>
	</div>
	
	<div class="sohohotel_booking-two-thirds">
		<input class="sh-required-field" type="text" name="_coupon_meta[coupon_code]" value="<?php if(!empty($coupon_meta['coupon_code'])) echo $coupon_meta['coupon_code']; ?>"/>
	</div>

<!-- END .sohohotel_booking-field-wrapper -->
</div>

<hr class="space1" />

<!-- BEGIN .sohohotel_booking-field-wrapper -->
<div class="sohohotel_booking-field-wrapper clearfix">
	
	<div class="sohohotel_booking-one-third">
		<?php esc_html_e('Discount Type','sohohotel_booking'); ?>
	</div>
	
	<div class="sohohotel_booking-two-thirds">
		
		<input class="sh_coupon_type" type="radio" name="_coupon_meta[coupon_discount_type]" value="flat" id="coupon_discount_type_flat" <?php if ( !empty($coupon_meta['coupon_discount_type']) ) { if ($coupon_meta['coupon_discount_type'] == 'flat' ) { echo 'checked'; } } ?> /><label for="coupon_discount_type_flat"><?php esc_html_e('Flat discount','sohohotel_booking'); ?></label>
		
		<hr class="space3" />
		
		<input class="sh_coupon_type" type="radio" name="_coupon_meta[coupon_discount_type]" value="percentage" id="coupon_discount_type_percentage" <?php if ( !empty($coupon_meta['coupon_discount_type']) ) { if ($coupon_meta['coupon_discount_type'] == 'percentage' ) { echo 'checked'; } } ?> /><label for="coupon_discount_type_percentage"><?php esc_html_e('Percentage','sohohotel_booking'); ?></label>
		
	</div>

<!-- END .sohohotel_booking-field-wrapper -->
</div>

<hr class="space1" />

<!-- BEGIN .sohohotel_booking-field-wrapper -->
<div class="sohohotel_booking-field-wrapper clearfix">
	
	<!-- BEGIN #coupon_discount_type_flat_fields -->
	<div id="coupon_discount_type_flat_fields" class="clearfix">
	
		<div class="sohohotel_booking-one-third">
			<label><?php echo esc_html__('Discount Amount','sohohotel_booking') . ' (' . $sohohotel_data['currency_unit'] . ')'; ?></label>
		</div>

		<div class="sohohotel_booking-two-thirds">
			<input class="sh-required-field sh-is-numeric" type="text" name="_coupon_meta[amount_flat]" value="<?php if( $coupon_meta ) {echo $coupon_meta['amount_flat'];} ?>" />
		</div>
	
	<!-- END #coupon_discount_type_flat_fields -->
	</div>
	
	<!-- BEGIN #coupon_discount_type_percentage_fields -->
	<div id="coupon_discount_type_percentage_fields" class="clearfix">
	
		<div class="sohohotel_booking-one-third">
			<label><?php echo esc_html__('Discount Amount','sohohotel_booking') . ' (%)'; ?></label>
		</div>

		<div class="sohohotel_booking-two-thirds">
			<input class="sh-required-field sh-is-numeric" type="text" name="_coupon_meta[amount_percentage]" value="<?php if( $coupon_meta ) {echo $coupon_meta['amount_percentage'];} ?>" />
		</div>
	
	<!-- END #coupon_discount_type_percentage_fields -->
	</div>

<!-- END .sohohotel_booking-field-wrapper -->
</div>