<?php

global $sohohotel_allowed_html_array_header;

// Stripe library
require sohohotel_booking_BASE_DIR .'/includes/stripe/Stripe.php';

$stripe_result = sohohotel_stripe_payment($_POST);

if ( !empty($stripe_result) ) {
	
	global $sohohotel_data;
	
	if ( $stripe_result["payment_status"] == 'success' ) {
		$stripe_result_message = esc_html__('Your payment has been processed successfully, please check your email for details.', 'sohohotel_booking');
	} else {
		$stripe_result_message = esc_html__('Your payment failed, you may have entered incorrect bank card details, or there may be a problem with your bank card in which case we recommend you contact your bank.', 'sohohotel_booking');
	}
	
	echo get_template_part( 'sohohotel', 'pageheader1' );
	
	echo '<div class="content-wrapper-max-width content-wrapper clearfix booking-response-page">';
	echo '<div class="main-content main-content-full">';
	echo '<p>' . $stripe_result_message . '</p>';
	echo '</div>';
	echo '</div>';
	
} elseif ( !empty($_GET["paypal"]) ) {
	
	$get_paypal = $_GET["paypal"];
	
	if ( $get_paypal == 'thanks' ) {
		
		echo get_template_part( 'sohohotel', 'pageheader1' );
		
		echo '<div class="content-wrapper-max-width content-wrapper clearfix booking-response-page">';
		echo '<div class="main-content main-content-full">';
		echo '<p>' . esc_html__('Your PayPal payment has been processed successfully, please check your email for details.', 'sohohotel_booking') . '</p>';
		echo '</div>';
		echo '</div>';
	
	} elseif ( $get_paypal == 'notify' ) {
		
		// PayPal IPN
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		if (preg_match('/paypal\.com$/', $hostname)) {	
			$obj = New PayPal_IPN();
			$obj->ipn_response($_REQUEST);		
		}
		
	} elseif ( $get_paypal == 'cancel' ) {
		
		echo get_template_part( 'sohohotel', 'pageheader1' );
		
		echo '<div class="content-wrapper-max-width content-wrapper clearfix booking-response-page">';
		echo '<div class="main-content main-content-full">';
		echo '<p>' . esc_html__('Your PayPal payment has been cancelled.', 'sohohotel_booking') . '</p>';
		echo '</div>';
		echo '</div>';
		
	}
	
} elseif ( isset($_POST["stripe_payment"]) ) {
	
	global $sohohotel_data;
	
	$params = array(
		"testmode"   => $sohohotel_data['stripe-testmode'],
		"private_live_key" => $sohohotel_data['stripe-live-secret-key'],
		"public_live_key"  => $sohohotel_data['stripe-live-publishable-key'],
		"private_test_key" => $sohohotel_data['stripe-test-secret-key'],
		"public_test_key"  => $sohohotel_data['stripe-test-publishable-key']
	);
	
	if ($params['testmode'] == "on") {
		Stripe::setApiKey($params['private_test_key']);
		$pubkey = $params['public_test_key'];
	} else {
		Stripe::setApiKey($params['private_live_key']);
		$pubkey = $params['public_live_key'];
	} ?>
	
<!-- BEGIN .booking-page-wrapper -->
<div class="booking-page-wrapper">

	<!-- BEGIN .booking-page -->
	<div class="booking-page clearfix">

		<div class="booking-step-wrapper clearfix">
		<?php echo sh_display_booking_steps('3'); ?>
		</div>

		<!-- BEGIN .booking-main-wrapper -->
		<div class="booking-main-wrapper">

			<!-- BEGIN .booking-main -->
			<div class="booking-main">

				<form action="" method="POST" id="payment-form">

					<span class="payment-errors"></span>

					<label><?php esc_html_e( 'Card Holder Name', 'sohohotel_booking' ); ?></label>
					<input size="20" data-stripe="name" type="text" />

					<label><?php esc_html_e( 'Card Number', 'sohohotel_booking' ); ?></label>
					<input type="text" size="20" data-stripe="number" />

					<div class="clearfix">

						<div class="qns-one-half">
							<label><?php esc_html_e( 'Expiration (MM)', 'sohohotel_booking' ); ?></label>
							<input type="text" size="2" data-stripe="exp_month" />
						</div>

						<div class="qns-one-half last-col">
							<label><?php esc_html_e( 'Expiration (YY)', 'sohohotel_booking' ); ?></label>
							<input type="text" size="2" data-stripe="exp_year" />
						</div>

					</div>

					<label><?php esc_html_e( 'CVC', 'sohohotel_booking' ); ?></label>
					<input type="text" size="4" data-stripe="cvc" />

					<input type="hidden" name="pay_now" value="true" />
					<input type="hidden" name="payment-method" value="stripe" />
					
					<?php
					
					// Calculate Total Price
					$stripe_price = str_replace(",","",$_POST["price"]);
					
					?>
					
					<input type="hidden" name="price" value="<?php echo $stripe_price; ?>" />
					<input type="hidden" name="booking_id" value="<?php echo $_POST["booking_id"]; ?>" />
					
					<button type="submit" class="stripe-pay-now">
						<?php esc_html_e( 'Confirm & Pay', 'sohohotel_booking' ); ?>
						<i class="fa fa-angle-right"></i>
					</button>

				</form>

				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
				<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
				<!-- TO DO : Place below JS code in js file and include that JS file -->
				<script type="text/javascript">
					Stripe.setPublishableKey('<?php echo $pubkey; ?>');

					$(function() {
					  var $form = $('#payment-form');
					  $form.submit(function(event) {
						// Disable the submit button to prevent repeated clicks:
						$form.find('.submit').prop('disabled', true);

						// Request a token from Stripe:
						Stripe.card.createToken($form, stripeResponseHandler);

						// Prevent the form from being submitted:
						return false;
					  });
					});

					function stripeResponseHandler(status, response) {
					  // Grab the form:
					  var $form = $('#payment-form');

					  if (response.error) { // Problem!
						 
						// Show the errors on the form:
						$form.find('.payment-errors').css( "display", "block" );
						//$form.find('.payment-errors').text(response.error.message);
						$form.find('.payment-errors').text( errorMessages[response.error.code] );
						$form.find('.submit').prop('disabled', false); // Re-enable submission

					  } else { // Token was created!

						// Get the token ID:
						var token = response.id;

						// Insert the token ID into the form so it gets submitted to the server:
						$form.append($('<input type="hidden" name="stripeToken">').val(token));

						// Submit the form:
						$form.get(0).submit();
					  }
					};
				</script>
				
			<!-- END .booking-main -->
			</div>

		<!-- END .booking-main-wrapper -->
		</div>

		<!-- BEGIN .booking-side-wrapper -->
		<div class="booking-side-wrapper">

			<!-- BEGIN .booking-side -->
			<div class="booking-side">

				<?php include(sohohotel_booking_BASE_DIR . '/includes/templates/booking-step4-sidebar.htm.php'); ?>

			<!-- END .booking-side -->
			</div>

		<!-- END .booking-side-wrapper -->	
		</div>

	<!-- END .booking-page -->
	</div>

<!-- END .booking-page-wrapper -->
</div>

<?php } else {
	
	// Reset temp booking data
	//$_SESSION['sh_booking_data'] = '';

	?>
	
	<?php if ( !empty($_POST['external_form']) ) {
		
		echo '<script>
		jQuery(document).ready(function($) {	
			$(".bookingbutton").click();
		});	
		</script>';
		
	} ?>
	
	<!-- BEGIN .booking-page-wrapper -->
	<div class="booking-page-wrapper">

	<!-- BEGIN .booking-page -->
	<div class="booking-page clearfix">
		
		<div class="booking-step-wrapper clearfix">
		<?php echo sh_display_booking_steps('1'); ?>
		</div>

		<!-- BEGIN .booking-main-wrapper -->
		<div class="booking-main-wrapper">

			<!-- BEGIN .booking-main -->
			<div class="booking-main">
				
				<?php if ( !empty( $_POST["edit_step_2"] ) ) {
					$sh_booking_data = $_SESSION['sh_booking_data'];
					$hidden_dates = $sh_booking_data["check_in"] . ' - ' . $sh_booking_data["check_out"];		
				} else {
					if ( !empty($_POST['check_in']) ) {
						$hidden_dates = $_POST['check_in'] . ' - ' . $_POST['check_out'];	
					} else {
						$hidden_dates = '';
					}
				} ?>
				
				<input type="hidden" id="check_in_open_hidden" value="<?php echo $hidden_dates; ?>" />
				<div class="clearboth"></div>

			<!-- END .booking-main -->
			</div>

		<!-- END .booking-main-wrapper -->
		</div>

		<!-- BEGIN .booking-side-wrapper -->
		<div class="booking-side-wrapper">

			<!-- BEGIN .booking-side -->
			<div class="booking-side">

			<?php include(sohohotel_booking_BASE_DIR . '/includes/templates/booking-step1-sidebar.htm.php'); ?>

			<!-- END .booking-side -->
			</div>

		<!-- END .booking-side-wrapper -->	
		</div>

	<!-- END .booking-page -->
	</div>

	<!-- END .booking-page-wrapper -->
	</div>
	
<?php }