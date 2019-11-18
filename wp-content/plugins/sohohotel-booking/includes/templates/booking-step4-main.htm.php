<?php

global $sohohotel_data; 

//echo '<pre>',print_r($_SESSION['sh_booking_data']),'</pre>';

$booking_id = sh_store_booking_db($_POST,$_SESSION['sh_booking_data'],'');

$payment_method = $_POST["payment_method"];

if ($payment_method == 'cash') {
	sh_send_booking_emails($booking_id);
}

$amount_due = $_SESSION['sh_booking_data']["total_booking_deposit_price"];
$paypal_email = $sohohotel_data["paypal-address"];
$product_name = get_bloginfo( 'name' );
$paypal_currency = $sohohotel_data["paypal-currency"];

// PayPal
if ( $payment_method == 'paypal' ) {
	
	$data = array(
		'merchant_email' => $paypal_email,
		'product_name' => $product_name,
		'item_number'=> $booking_id,
		'amount'=> $amount_due,
		'currency_code' => $paypal_currency,
		'thanks_page' => $sohohotel_data['booking_page_url'].'?paypal=thanks',
		'notify_url' => $sohohotel_data['booking_page_url'].'?paypal=notify',
		'cancel_url' => $sohohotel_data['booking_page_url'].'?paypal=cancel',
		'paypal_mode' => true
	);

	echo sh_payment_form($data);
	echo '<div class="paypal-loader">' . esc_html__( 'PayPal is loading, please wait...', 'sohohotel_booking' ) . '</div>';

// Stripe
} elseif ( $payment_method == 'stripe' ) { ?>
	
	<form name="stripe_form" action="<?php echo $sohohotel_data["booking_page_url"]; ?>" method="post" autocomplete="off">
		<input type="hidden" name="stripe_payment" value="true" />
		
		<?php
		
		// Price decimal places
			$stripe_price = $_SESSION['sh_booking_data']['total_booking_deposit_price'];
		?>
		
		<input type="hidden" name="price" value="<?php echo $stripe_price; ?>" />
		<input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>" />	
	</form>
	
	<script>setTimeout("document.stripe_form.submit()", 0);</script>

	<div class="stripe-loader"><?php esc_html_e( 'Payment is loading, please wait...', 'sohohotel_booking' ); ?></div>
	
<?php // Cash
} else { ?>

	<?php if ( !empty($sohohotel_data["booking_success_message"]) ) { ?>
		<h4><?php esc_html_e('Reservation Complete', 'sohohotel_booking'); ?></h4>
		<div class="title-block-3"></div>
		<p><?php echo $sohohotel_data["booking_success_message"]; ?></p>
	<?php } ?>

	<?php if ( !empty($sohohotel_data["booking-email"]) OR !empty($sohohotel_data["booking-phone"]) OR !empty($sohohotel_data["booking-address"]) ) { ?>
		<h4><?php esc_html_e('Contact Details', 'sohohotel_booking'); ?></h4>
		<div class="title-block-3"></div>
		<ul class="contact-details-list">

			<?php if ( !empty($sohohotel_data["booking-address"]) ) { ?>
				<li class="cdw-address clearfix"><?php echo $sohohotel_data["booking-address"]; ?></li>
			<?php } ?>

			<?php if ( !empty($sohohotel_data["booking-phone"]) ) { ?>
				<li class="cdw-phone clearfix"><?php echo $sohohotel_data["booking-phone"]; ?></li>
			<?php } ?>

			<?php if ( !empty($sohohotel_data["booking-email"]) ) { ?>
				<li class="cdw-email clearfix"><?php echo $sohohotel_data["booking-email"]; ?></li>
			<?php } ?>

		</ul>
	<?php } ?>
	
	<?php if( sohohotel_footer_social_icons_check() != 'false' ) { ?>
	
		<h4><?php esc_html_e('Social Media', 'sohohotel_booking'); ?></h4>
		<div class="title-block-3"></div>

		<ul class="social-links clearfix">

			<?php if( !empty($sohohotel_data['facebook-icon']) ) { ?>
				<li><a href="<?php echo $sohohotel_data['facebook-icon']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
			<?php } ?>

			<?php if( !empty($sohohotel_data['flickr-icon']) ) { ?>
				<li><a href="<?php echo $sohohotel_data['flickr-icon']; ?>" target="_blank"><i class="fa fa-flickr"></i></a></li>
			<?php } ?>

			<?php if( !empty($sohohotel_data['googleplus-icon']) ) { ?>
				<li><a href="<?php echo $sohohotel_data['googleplus-icon']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			<?php } ?>

			<?php if( !empty($sohohotel_data['instagram-icon']) ) { ?>
				<li><a href="<?php echo $sohohotel_data['instagram-icon']; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
			<?php } ?>

			<?php if( !empty($sohohotel_data['pinterest-icon']) ) { ?>
				<li><a href="<?php echo $sohohotel_data['pinterest-icon']; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
			<?php } ?>

			<?php if( !empty($sohohotel_data['skype-icon']) ) { ?>
				<li><a href="<?php echo $sohohotel_data['skype-icon']; ?>" target="_blank"><i class="fa fa-skype"></i></a></li>
			<?php } ?>

			<?php if( !empty($sohohotel_data['soundcloud-icon']) ) { ?>
				<li><a href="<?php echo $sohohotel_data['soundcloud-icon']; ?>" target="_blank"><i class="fa fa-soundcloud"></i></a></li>
			<?php } ?>

			<?php if( !empty($sohohotel_data['tumblr-icon']) ) { ?>
				<li><a href="<?php echo $sohohotel_data['tumblr-icon']; ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
			<?php } ?>

			<?php if( !empty($sohohotel_data['twitter-icon']) ) { ?>
				<li><a href="<?php echo $sohohotel_data['twitter-icon']; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
			<?php } ?>

			<?php if( !empty($sohohotel_data['vimeo-icon']) ) { ?>
				<li><a href="<?php echo $sohohotel_data['vimeo-icon']; ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
			<?php } ?>

			<?php if( !empty($sohohotel_data['vine-icon']) ) { ?>
				<li><a href="<?php echo $sohohotel_data['vine-icon']; ?>" target="_blank"><i class="fa fa-vine"></i></a></li>
			<?php } ?>

			<?php if( !empty($sohohotel_data['yelp-icon']) ) { ?>
				<li><a href="<?php echo $sohohotel_data['yelp-icon']; ?>" target="_blank"><i class="fa fa-yelp"></i></a></li>
			<?php } ?>

			<?php if( !empty($sohohotel_data['youtube-icon']) ) { ?>
				<li><a href="<?php echo $sohohotel_data['youtube-icon']; ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
			<?php } ?>

		</ul>
	
	<?php } ?>
	
<?php } ?>