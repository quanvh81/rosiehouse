<?php 

$rooms_total_array = array();
$services_total_array = array();
global $sohohotel_data;
$sh_booking_data = $_SESSION['sh_booking_data'];

?>

<!-- BEGIN .room-sidebar-wrapper -->
<div class="room-sidebar-wrapper">

	<h4><?php echo esc_html__('Booking Details', 'sohohotel_booking'); ?></h4>
	<div class="title-block-3"></div>
	<ul>
		<li><span><?php esc_html_e('Check In', 'sohohotel_booking'); ?>:</span> <?php echo sh_display_formatted_date($sh_booking_data["check_in"]); ?></li>
		<li><span><?php esc_html_e('Check Out', 'sohohotel_booking'); ?>:</span> <?php echo sh_display_formatted_date($sh_booking_data["check_out"]); ?></li>
	</ul>

	<div class="clearboth"></div>

<!-- END .room-sidebar-wrapper -->
</div>

<?php foreach (range(1, $sh_booking_data["book_room"]) as $r) { ?>
	
	<?php $rooms_total_array[] = $sh_booking_data["room_" . $r ]["room_price"]; ?>
	
	<!-- BEGIN .room-sidebar-wrapper -->
	<div class="room-sidebar-wrapper">

		<h4><?php echo esc_html__('Room', 'sohohotel_booking') . ' ' . $r; ?></h4>
		<div class="title-block-3"></div>
		<ul>
			<li><span><?php esc_html_e('Room', 'sohohotel_booking'); ?>:</span> <?php echo $sh_booking_data["room_" . $r ]["room_name"]; ?></li>
			<li><span><?php esc_html_e('Guests', 'sohohotel_booking'); ?>:</span> <?php echo $sh_booking_data["room_" . $r ]["adults"]; ?> <?php esc_html_e('Adult(s)', 'sohohotel_booking'); ?><?php if( $sh_booking_data["room_" . $r ]["children"] > 0 ) {
				echo ', ' . $sh_booking_data["room_" . $r ]["children"] . ' ' . esc_html__('Children', 'sohohotel_booking');
			} ?></li>
			<li><span><?php esc_html_e('Price', 'sohohotel_booking'); ?>:</span> <?php echo sh_get_price($sh_booking_data["room_" . $r ]["room_price"]); ?></li>
		</ul>

		<div class="clearboth"></div>

	<!-- END .room-sidebar-wrapper -->
	</div>

<?php } ?>

<?php if ( !empty( $_SESSION['sh_booking_data']["services"]["service_1"]["service_name"] ) ) { ?>

	<h4><?php esc_html_e('Services', 'sohohotel_booking'); ?></h4>
	<div class="title-block-3"></div>

	<div class="room-sidebar-wrapper">
		<ul>
			<?php foreach ($_SESSION['sh_booking_data']["services"] as $key => $value) { ?>

				<?php $services_total_array[] = $value["service_price"]; ?>

				<li><span><?php echo $value["service_name"]; ?>:</span> <?php echo sh_get_price($value["service_price"]); ?></li>
			<?php } ?>
		</ul>
	</div>

<?php } ?>

<?php 

if( $sohohotel_data['tax-rate'] != 'none' && is_numeric($sohohotel_data['tax-rate']) ) {
	
	// Calculate Total Price Pre Tax
	$total_booking_price_pre_tax = array_sum( $rooms_total_array ) + array_sum( $services_total_array );
	
	// Calculate Tax
	$total_booking_tax = ($sohohotel_data['tax-rate'] / 100) * $total_booking_price_pre_tax;
	
	// Calculate Total Price
	$total_booking_price = $total_booking_tax + $total_booking_price_pre_tax;
	
} else {
	
	// Calculate Total Price
	$total_booking_price = array_sum( $rooms_total_array ) + array_sum( $services_total_array );
	
}

// Apply Coupon
if ($data["apply_coupon_hidden"]) {
	
	$coupon_data = sh_store_coupon_temp($data["apply_coupon"]);
	
	if ( $coupon_data["coupon_code"] != '' ) {
		
		if ( $coupon_data["type"] == 'flat' ) {
			$total_booking_price_2 = $total_booking_price - $coupon_data["amount_flat"];
		} elseif ( $coupon_data["type"] == 'percentage' ) {
			$total_booking_price_2 = $total_booking_price - ( ($coupon_data["amount_percentage"] / 100) * $total_booking_price );
		}
		
	} else {
		$total_booking_price_2 = $total_booking_price;
	}
	
} else {
	$total_booking_price_2 = $total_booking_price;
}

// Calculate Deposit Price
if ( $sohohotel_data['deposit_type'] == '1' ) {
	$deposit_price = ($sohohotel_data['deposit_percentage'] / 100) * $total_booking_price_2;
} elseif ( $sohohotel_data['deposit_type'] == '2' ) {
	$deposit_price = $sohohotel_data['deposit_flat_rate'];
} else {
	$deposit_price = 0;
} ?>

<!-- BEGIN .price-details -->
<div class="price-details <?php if ( $sohohotel_data['deposit_percentage'] == '100' || $deposit_price == 0 ) {echo 'no-deposit';} ?>">
	
	<?php if ( $sohohotel_data['deposit_percentage'] != '100' && $sohohotel_data['deposit_type'] == '1' ) { ?>
		
		<p class="deposit"><?php echo $sohohotel_data['deposit_percentage'] . '% ' . esc_html__('Deposit Due Now', 'sohohotel_booking'); ?></p>
		<h3 class="price"><?php echo sh_get_price($deposit_price); ?></h3>
		<hr class="total-line" />
		
	<?php } elseif ( !empty($sohohotel_data['deposit_flat_rate']) && $sohohotel_data['deposit_type'] == '2' ) { ?>
		
		<p class="deposit"><?php echo esc_html__('Deposit Due Now', 'sohohotel_booking'); ?></p>
		<h3 class="price"><?php echo sh_get_price($deposit_price); ?></h3>
		<hr class="total-line" />
		
	<?php } ?>
	
	<p class="total"><?php esc_html_e('Total Price', 'sohohotel_booking'); ?></p>
	<h3 class="total-price"><?php echo sh_get_price($total_booking_price_2); ?></h3>
	
	<?php if( $sohohotel_data['tax-rate'] != 'none' && $sohohotel_data['tax-rate'] != 0 && is_numeric($sohohotel_data['tax-rate']) ) { ?>
		<p class="tax-rate-msg"><?php echo esc_html__('Includes', 'sohohotel_booking') . ' ' . $sohohotel_data['tax-rate'] . '% ' . esc_html__('tax', 'sohohotel_booking'); ?></p>
	<?php } ?>
	
<!-- END .price-details -->
</div>

<?php $sh_booking_data = $_SESSION['sh_booking_data'];

// Price decimal places
if ( !empty($sohohotel_data['price_decimal_places']) ) {
	$number_decimals = $sohohotel_data['price_decimal_places'];
} else {
	$number_decimals = '2';
}

// Calculate Total Price
if ($number_decimals == 'zero') {
	$stripe_price = $_SESSION['sh_booking_data']['total_booking_deposit_price'];
	$sh_booking_data["total_booking_price"] = number_format($total_booking_price_2,0);
	$sh_booking_data["total_booking_deposit_price"] = number_format($deposit_price,0);
} else {
	$sh_booking_data["total_booking_price"] = number_format($total_booking_price_2,$number_decimals);
	$sh_booking_data["total_booking_deposit_price"] = number_format($deposit_price,$number_decimals);
}

$_SESSION['sh_booking_data'] = $sh_booking_data;

?>

<?php //echo '<pre>',print_r($_SESSION['sh_booking_data']),'</pre>'; ?>

<button class="edit-booking-button" name="edit_booking_button" type="submit" value="edit_booking_button"><?php esc_html_e('Edit Booking','sohohotel_booking'); ?></button>