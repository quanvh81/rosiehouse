<form name="bookroom" class="booking-form-data">

<?php global $sohohotel_data; 
echo verifyInputs($sohohotel_data['custom_booking_form'], $_POST["_booking_meta"]); ?>

<?php if ( sh_coupons_exist() > 0 ) { ?>

	<hr class="space8"/>

	<h4><?php esc_html_e('Apply Coupon', 'sohohotel_booking'); ?></h4>
	<div class="title-block-3"></div>

	<?php

	if ($data["apply_coupon_hidden"]) {

		$coupon_data = sh_store_coupon_temp($data["apply_coupon"]);

		if ( $coupon_data["coupon_code"] == '' ) {
			echo '<p>' . esc_html__('Sorry the coupon code you entered is not valid', 'sohohotel_booking') . '</p>';
		} else {
			echo '<p>' . esc_html__('You applied the coupon code', 'sohohotel_booking') . ' "' . $coupon_data["coupon_code"] . '"</p>';
		}
		
		// Save coupon in session data
		$sh_booking_data = $_SESSION['sh_booking_data'];
		$sh_booking_data["coupon"] = $data["apply_coupon"];
		$_SESSION['sh_booking_data'] = $sh_booking_data;

	}

	?>

	<div class="booking-coupon-wrapper clearfix">
		<input id="apply_coupon" type="text" name="apply_coupon" />
		<input type="hidden" name="apply_coupon_hidden" class="apply_coupon_hidden" value="" />
		<button class="apply-coupon-button" name="apply_coupon_button" type="submit"><?php esc_html_e('Apply Coupon', 'sohohotel_booking'); ?></button>
	</div>

<?php } ?>

<?php if ( $sohohotel_data['disable_stripe'] == '1' && $sohohotel_data['disable_paypal'] == '1' && $sohohotel_data['disable_cash'] == '1' ) { ?>

	<input type="hidden" name="payment_method" value="cash" id="payment_method_cash" />

<?php } else { ?>
	
	<hr class="space8"/>
	
	<h4><?php esc_html_e('Payment', 'sohohotel_booking'); ?></h4>
	<div class="title-block-3"></div>
	
<?php } ?>

<!-- BEGIN .payment_method -->
<div class="payment_method">
	
	<?php if ( $sohohotel_data['disable_stripe'] != '1' ) { ?>
		
		<h3 class="clearfix"><input type="radio" name="payment_method" value="stripe" id="payment_method_stripe" checked="checked" /><label for="payment_method_stripe"><?php esc_html_e('Credit Card', 'sohohotel_booking'); ?><img src="<?php echo plugins_url('../../assets/images/stripe.png', __FILE__); ?>" /></label></h3>
		<div><p><?php esc_html_e('Pay via Credit Card. All major credit and debit cards accepted', 'sohohotel_booking'); ?></p></div>
		
	<?php } ?>
	
	<?php if ( $sohohotel_data['disable_paypal'] != '1' ) { ?>
	
		<h3 class="clearfix"><input type="radio" name="payment_method" value="paypal" id="payment_method_paypal" checked="checked" /><label for="payment_method_paypal"><?php esc_html_e('Paypal', 'sohohotel_booking'); ?><img src="<?php echo plugins_url('../../assets/images/paypal.png', __FILE__); ?>" /></label></h3>
		<div><p><?php esc_html_e('Pay via Paypal. Accepts all major credit and debit cards', 'sohohotel_booking'); ?></p></div>
	
	<?php } ?>

	<?php if ( $sohohotel_data['disable_cash'] != '1' ) { ?>
	
		<h3 class="clearfix"><input type="radio" name="payment_method" value="cash" id="payment_method_cash" /><label for="payment_method_cash"><?php esc_html_e('Pay On Arrival', 'sohohotel_booking'); ?></label></h3>
		<div><p><?php esc_html_e('Pay on arrival. Pay by credit card or cash when you arrive.', 'sohohotel_booking'); ?></p></div>
	
	<?php } ?>

<!-- END .payment_method -->
</div>

<?php if ( !empty($sohohotel_data["terms_conditions"]) ) { ?>
	<div class="booking-terms-wrapper">	
		<input type="checkbox" id="terms_and_conditions" name="terms_and_conditions" value="1" class="fl terms_and_conditions">
		<label for="terms_and_conditions" class="fl"><?php esc_html_e('I have read and accept the', 'sohohotel_booking'); ?> <a href="#terms-conditions" data-gal="prettyPhoto"><?php esc_html_e('terms &amp; conditions', 'sohohotel_booking'); ?></a>.</label>
	</div>
<?php } ?>

<!-- BEGIN #terms-conditions -->
<div id="terms-conditions" class="hide">

	<!-- BEGIN .lightbox-title -->
	<div class="lightbox-title">
		<h4 class="title-style4"><?php esc_html_e('Terms &amp; Conditions', 'sohohotel_booking'); ?><span class="title-block"></span></h4>
	<!-- END .lightbox-title -->
	</div>

	<!-- BEGIN .main-content -->
	<div class="main-content main-content-lightbox">

		<?php echo $sohohotel_data["terms_conditions"]; ?>

	<!-- END .page-content -->
	</div>

<!-- END #terms-conditions -->
</div>

<div class="clearboth"></div>

<?php if ( $sohohotel_data['disable_stripe'] == '1' && $sohohotel_data['disable_paypal'] == '1' && $sohohotel_data['disable_cash'] == '1' ) { ?>
	<button class="booking_payment" type="submit"><?php esc_html_e('Book Now', 'sohohotel_booking'); ?></button>
<?php } else { ?>
	<button class="booking_payment" type="submit"><?php esc_html_e('Proceed To Payment', 'sohohotel_booking'); ?></button>
<?php } ?>

<?php sh_store_room_prices_temp(); ?>

<input type="hidden" class="booking-payment-data" name="booking_payment_hidden" value="" />
<input type="hidden" name="edit_booking_data" class="edit-booking-field" value="" />
<input type="hidden" name="action" value="sh_booking_process_frontend_action_callback" />
<?php echo wp_nonce_field('sh_booking_process_frontend', '_acf_nonce', true, false); ?>

<?php //echo '<pre>',print_r($_SESSION['sh_booking_data']),'</pre>'; ?>

</form>