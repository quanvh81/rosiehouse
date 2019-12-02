<?php

/*
  Plugin Name: Soho Hotel Booking
  Plugin URI: http://quitenicestuff.com
  Description: Accommodation Booking System
  Version: 3.0.3
  Author: Quite Nice Stuff
  Author URI: http://quitenicestuff.com
*/



/* ----------------------------------------------------------------------------

   Register Session

---------------------------------------------------------------------------- */
function sohohotel_booking_register_session(){
	if( !session_id())
		session_start();
}

add_action('init','sohohotel_booking_register_session');



/* ----------------------------------------------------------------------------

   Load Language Files

---------------------------------------------------------------------------- */
function sohohotel_booking_init() {
	load_plugin_textdomain( 'sohohotel_booking', false, dirname(plugin_basename( __FILE__ ))  . '/languages/' ); 
}
add_action('init', 'sohohotel_booking_init');



/* ----------------------------------------------------------------------------

   Load Files

---------------------------------------------------------------------------- */
if ( ! defined( 'sohohotel_booking_BASE_FILE' ) )
    define( 'sohohotel_booking_BASE_FILE', __FILE__ );

if ( ! defined( 'sohohotel_booking_BASE_DIR' ) )
    define( 'sohohotel_booking_BASE_DIR', dirname( sohohotel_booking_BASE_FILE ) );

if ( ! defined( 'sohohotel_booking_PLUGIN_URL' ) )
    define( 'sohohotel_booking_PLUGIN_URL', plugin_dir_url( __FILE__ ) );



/* ----------------------------------------------------------------------------

   Plugin Activation

---------------------------------------------------------------------------- */
function sohohotel_booking_shortcodes_activation() {}
register_activation_hook(__FILE__, 'sohohotel_booking_shortcodes_activation');

function sohohotel_booking_shortcodes_deactivation() {}
register_deactivation_hook(__FILE__, 'sohohotel_booking_shortcodes_deactivation');



/* ----------------------------------------------------------------------------

   Load Frontend Inline CSS

---------------------------------------------------------------------------- */
function sohohotel_booking_inline_css() {
	
	global $sohohotel_data;
	
	$output = '';
	
	$hide_children_hide_hotel .= '.wide-booking-form .booking-form-input-4 {display: none;}	
	.wide-booking-form .booking-form-input-0, .wide-booking-form .booking-form-input-1, .wide-booking-form .booking-form-input-2, .wide-booking-form .booking-form-input-3, .wide-booking-form .booking-form-input-5 {width: calc(25% - 8px);}
	@media only screen and (max-width: 1050px) {.wide-booking-form .booking-form .booking-form-input-3 {margin: 0;}}
	.vertical-booking-form .booking-form-input-3 .qns-last {display: none;}
	.vertical-booking-form .booking-form-input-3 .qns-one-half {width: 100%;}
	.booking-form-3 .booking-form-input-3-alt .room-input-wrapper-outer .child-selection-wrapper, .sidebar-booking-form .booking-form-input-3-alt .room-input-wrapper-outer .child-selection-wrapper {display: none;}
	.booking-form-3 .booking-form-input-3-alt .room-input-wrapper-outer .adult-selection-wrapper, .sidebar-booking-form .booking-form-input-3-alt .room-input-wrapper-outer .adult-selection-wrapper {width: 100%;}
	.sh-single-booking-form .sh-guestpicker-wrapper .sh-child-wrapper,
	.rooms-wrapper div .adult-child-wrapper .last-col {display: none;}
	.rooms-wrapper div .adult-child-wrapper .one-half {
	width: 100%;
	margin: 0;
	}
	.adult-child-wrapper {
	float: right;
	width: calc(100% - 100px);
	}
	.sidebar-booking-form .booking-form .booking-form-input-3 .qns-last {
	display: none;
	}
	.sidebar-booking-form .booking-form .booking-form-input-3 .qns-one-half {
	width: 100%;
	}
	';
	
	$show_children_show_hotel .= '.wide-booking-form .booking-form-input-0, .wide-booking-form .booking-form-input-1, .wide-booking-form .booking-form-input-2, .wide-booking-form .booking-form-input-3, .wide-booking-form .booking-form-input-4 {width: calc(16% - 8px);}
	.wide-booking-form .booking-form-input-5 {width: calc(20% - 10px);}
	@media only screen and (max-width: 1050px) {
	.wide-booking-form .booking-form-input-0 {width: 100%;margin: 0 0 20px 0;}
	}
	.vertical-booking-form .booking-form-input-0 {margin: 0 0 20px 0;}
	.wide-booking-form .booking-form-3 .booking-form-input-0,
	.wide-booking-form .booking-form-3 .booking-form-input-1,
	.wide-booking-form .booking-form-3 .booking-form-input-2 {
		width: calc(16% - 8px);
	}
	.wide-booking-form .booking-form-3 .booking-form-input-3-alt {
		width: calc(32% - 8px);
	}
	.wide-booking-form .booking-form-3 .booking-form-input-5 {
		width: calc(20% - 8px);
	}
	@media only screen and (max-width: 1050px) {
		.wide-booking-form .booking-form-3 .booking-form-input-0,
		.wide-booking-form .booking-form-3 .booking-form-input-1,
		.wide-booking-form .booking-form-3 .booking-form-input-2,
		.wide-booking-form .booking-form-3 .booking-form-input-3-alt,
		.wide-booking-form .booking-form-3 .booking-form-input-5 {
			width: 100%;
		}
	}
	.wide-booking-form-2 .booking-form-input-0 {
		margin: 0 10px 0 0;
		padding: 30px 0 0 0;
		float: left;
		position: relative;
	}
	.wide-booking-form-2 .booking-form-input-0 select {
		padding: 11px 15px 12px 15px;
	}
	.wide-booking-form-2 {
		max-width: 900px;
	}
	.wide-booking-form-2 .booking-form-input-0,
	.wide-booking-form-2 .booking-form-input-1,
	.wide-booking-form-2 .booking-form-input-2 {
		width: calc(15.3% - 10px);
	}
	.wide-booking-form-2 .booking-form-input-3-alt {
	    width: calc(36.5% - 30px);
	}
	@media only screen and (max-width: 1050px) {
		.wide-booking-form-2 {
			padding: 30px 15px;
		}
		.wide-booking-form-2 .booking-form-input-0,
		.wide-booking-form-2 .booking-form-input-1,
		.wide-booking-form-2 .booking-form-input-2,
		.wide-booking-form-2 .booking-form-input-3-alt {
			width: 100%;
		}
		.wide-booking-form-2 .booking-form-input-0, 
		.wide-booking-form-2 .booking-form-input-1, 
		.wide-booking-form-2 .booking-form-input-2,
		.wide-booking-form-2 .booking-form-input-3-alt {
			padding: 0;
			margin: 0 0 20px 0;
		}
		.wide-booking-form-2 .booking-form-input-3-alt {
			margin: 0;
		}
		.wide-booking-form-2 .booking-form-input-5 {
			float: none;
			width: 100%;
		}
		.wide-booking-form-2 button {
		    width: 100%;
		    padding: 0px 15px 0 15px;
		    height: 45px;
		    margin: 24px 0 0 0;
		}
		.wide-booking-form-2 button i {
		    display: inline;
		    margin: 0 7px 0 0;
		}
	}';
	
	$hide_children_show_hotel .= '.wide-booking-form .booking-form-input-4 {display: none;}	
	.wide-booking-form .booking-form-input-0, .wide-booking-form .booking-form-input-1, .wide-booking-form .booking-form-input-2, .wide-booking-form .booking-form-input-3, .wide-booking-form .booking-form-input-5 {width: calc(20% - 8px);}
	@media only screen and (max-width: 1050px) {.wide-booking-form .booking-form .booking-form-input-3 {margin: 0;}}
	.vertical-booking-form .booking-form-input-3 .qns-last {display: none;}
	.vertical-booking-form .booking-form-input-3 .qns-one-half {width: 100%;}
	.booking-form-3 .booking-form-input-3-alt .room-input-wrapper-outer .child-selection-wrapper, .sidebar-booking-form .booking-form-input-3-alt .room-input-wrapper-outer .child-selection-wrapper {display: none;}
	.booking-form-3 .booking-form-input-3-alt .room-input-wrapper-outer .adult-selection-wrapper, .sidebar-booking-form .booking-form-input-3-alt .room-input-wrapper-outer .adult-selection-wrapper {width: 100%;}
	.sh-single-booking-form .sh-guestpicker-wrapper .sh-child-wrapper,
	.rooms-wrapper div .adult-child-wrapper .last-col {display: none;}
	@media only screen and (max-width: 1050px) {
	.wide-booking-form .booking-form-input-0 {width: 100%;margin: 0 0 20px 0;}
	}
	.vertical-booking-form .booking-form-input-0 {margin: 0 0 20px 0;}
	.wide-booking-form .booking-form-3 .booking-form-input-0, .wide-booking-form .booking-form-3 .booking-form-input-1, .wide-booking-form .booking-form-3 .booking-form-input-2, .wide-booking-form .booking-form-3 .booking-form-input-3, .wide-booking-form .booking-form-3 .booking-form-input-4, .wide-booking-form .booking-form-3 .booking-form-input-5 {
	    width: calc(16.8% - 10px);
	}
	@media only screen and (max-width: 1050px) {
		.wide-booking-form .booking-form-3 .booking-form-input-0,
		.wide-booking-form .booking-form-3 .booking-form-input-1,
		.wide-booking-form .booking-form-3 .booking-form-input-2,
		.wide-booking-form .booking-form-3 .booking-form-input-3-alt,
		.wide-booking-form .booking-form-3 .booking-form-input-5 {
			width: 100%;
		}
		.wide-booking-form .booking-form .booking-form-input-0 {
			float: none;
			margin: 0 0 20px 0;
		}
	}
	.wide-booking-form-2 .booking-form-input-0 {
		margin: 0 10px 0 0;
		padding: 30px 0 0 0;
		float: left;
		position: relative;
	}
	.wide-booking-form-2 .booking-form-input-0 select {
		padding: 11px 15px 12px 15px;
	}
	.wide-booking-form-2 {
		max-width: 900px;
	}
	.wide-booking-form-2 .booking-form-input-0,
	.wide-booking-form-2 .booking-form-input-1,
	.wide-booking-form-2 .booking-form-input-2 {
		width: calc(15.3% - 10px);
	}
	.wide-booking-form-2 .booking-form-input-3-alt {
	    width: calc(36.5% - 30px);
	}
	@media only screen and (max-width: 1050px) {	
		.wide-booking-form-2 {
			padding: 30px 15px;
		}
		.wide-booking-form-2 .booking-form-input-0,
		.wide-booking-form-2 .booking-form-input-1,
		.wide-booking-form-2 .booking-form-input-2,
		.wide-booking-form-2 .booking-form-input-3-alt {
			width: 100%;
		}
		.wide-booking-form-2 .booking-form-input-0, 
		.wide-booking-form-2 .booking-form-input-1, 
		.wide-booking-form-2 .booking-form-input-2,
		.wide-booking-form-2 .booking-form-input-3-alt {
			padding: 0;
			margin: 0 0 20px 0;
		}
		.wide-booking-form-2 .booking-form-input-3-alt {
			margin: 0;
		}
		.wide-booking-form-2 .booking-form-input-5 {
			float: none;
			width: 100%;
		}
		.wide-booking-form-2 button {
		    width: 100%;
		    padding: 0px 15px 0 15px;
		    height: 45px;
		    margin: 24px 0 0 0;
		}
		.wide-booking-form-2 button i {
		    display: inline;
		    margin: 0 7px 0 0;
		}
	}
	.rooms-wrapper div .adult-child-wrapper .one-half {
	width: 100%;
	margin: 0;
	}
	.adult-child-wrapper {
	float: right;
	width: calc(100% - 100px);
	}
	.sidebar-booking-form .booking-form .booking-form-input-3 .qns-last {
	display: none;
	}
	.sidebar-booking-form .booking-form .booking-form-input-3 .qns-one-half {
	width: 100%;
	}';

	if($sohohotel_data["remove_children_booking_form"] == 1 && $sohohotel_data["booking_form_hotel"] == 1) {
		$output .= $hide_children_show_hotel;
	} elseif ($sohohotel_data["remove_children_booking_form"] == 1 && $sohohotel_data["booking_form_hotel"] == 0) {
		$output .= $hide_children_hide_hotel;
	} elseif ($sohohotel_data["remove_children_booking_form"] == 0 && $sohohotel_data["booking_form_hotel"] == 1) {
		$output .= $show_children_show_hotel;
	}
	
	return $output;
	
}



/* ----------------------------------------------------------------------------

   Load Frontend CSS & JS

---------------------------------------------------------------------------- */
add_action('wp_enqueue_scripts', 'front_js_css');
function front_js_css() {
	
	global $sohohotel_data;
	
	// Frontend CSS
	wp_enqueue_style('sohohotel_booking_plugin_css', sohohotel_booking_PLUGIN_URL . 'assets/css/style.css');
	wp_add_inline_style( 'sohohotel_booking_plugin_css', sohohotel_booking_inline_css() );
	
	// Frontend JS
	wp_enqueue_script('jquery');
	
	wp_register_script( 'sohohotel_mutationobserver_js', sohohotel_booking_PLUGIN_URL . 'assets/js/mutationobserver.js' );
	wp_enqueue_script( 'sohohotel_mutationobserver_js' );
	
	wp_register_script( 'sohohotel_fecha_js', sohohotel_booking_PLUGIN_URL . 'assets/js/fecha.min.js' );
	wp_enqueue_script( 'sohohotel_fecha_js' );
	
	wp_register_script( 'sohohotel_hotel_datepicker_js', sohohotel_booking_PLUGIN_URL . 'assets/js/hotel-datepicker.js' );
	wp_enqueue_script( 'sohohotel_hotel_datepicker_js' );
	
	wp_register_script( 'sohohotel_booking_js', sohohotel_booking_PLUGIN_URL . 'assets/js/scripts.js' );
	wp_enqueue_script( 'sohohotel_booking_js' );
	
	// Get Date Format
	if ( !empty($sohohotel_data["date_format"]) ) {
		$datepickerDateFormat = $sohohotel_data["date_format"];
	} else {
		$datepickerDateFormat = 'dd/mm/yy';
	}

	// Get Minimum Stay
	if ( $sohohotel_data['minimum_stay'] ) {
		$sohohotel_bookingMinBookPeriod = $sohohotel_data['minimum_stay'];	
	} else {
		$sohohotel_bookingMinBookPeriod = '1';
	}
	
	if ( $sohohotel_data['terms_conditions'] ) {
		$terms_and_conditions = 'true';
	} else {
		$terms_and_conditions = 'false';
	}
	
	if ( $sohohotel_data['datepicker_days'] ) {
		
		$regex = "/^[\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*]$/";
		if (preg_match($regex, $sohohotel_data['datepicker_days'])) {
		    $datepicker_days = $sohohotel_data['datepicker_days'];
		} else {
		    $datepicker_days = "['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa']";
		}

	} else {
		$datepicker_days = "['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa']";
	}

	if ( $sohohotel_data['datepicker_months'] ) {
		
		$regex = "/^[\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*]$/";
		if (preg_match($regex, $sohohotel_data['datepicker_months'])) {
		    $datepicker_months = $sohohotel_data['datepicker_months'];
		} else {
		    $datepicker_months = "['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']";
		}
		
	} else {
		$datepicker_months = "['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']";
	}

	if ( get_post_type() == 'accommodation' && is_single() ) {
		$blocked_dates = "['" . implode("','", sh_get_booking_dates(get_the_ID()) ) . "']";
	} else {
		$blocked_dates = "['" . implode("','", sh_get_booking_dates('') ) . "']";
	}
	
	// Frontend Custom JS Variables
	wp_add_inline_script( 'sohohotel_booking_js', "
	var sohohotel_booking_AJAX_URL = '" . sohohotel_booking_AJAX_URL . "';
	var sohohotel_bookingLoadingImage = '" . sohohotel_booking_PLUGIN_URL . "assets/images/loading.gif';
	var datepickerDateFormat = '" . $datepickerDateFormat . "';
	var sohohotel_bookingMinBookPeriod = '" . $sohohotel_bookingMinBookPeriod . "';
	var sohohotel_booking_length_error_msg = '" . esc_html__('The minimum booking period is', 'sohohotel_booking') . ' ' . $sohohotel_bookingMinBookPeriod . ' ' . esc_html__('night(s)', 'sohohotel_booking') . "';
	var sohohotel_date_msg = '" . esc_html__('Please select a check in and check out date', 'sohohotel_booking') . "';
	var sohohotel_terms_msg = '" . esc_html__('You must accept the terms & conditions before placing your booking', 'sohohotel_booking') . "';
	var sohohotel_required_msg = '" . esc_html__('Please fill out all the required fields marked with a *', 'sohohotel_booking') . "';
	var sohohotel_invalid_email_msg = '" . esc_html__('Please enter a valid email address', 'sohohotel_booking') . "';
	var sohohotel_invalid_phone_msg = '" . esc_html__('Phone number should only contain numbers', 'sohohotel_booking') . "';
	var sohohotel_check_in_txt = '" . esc_html__('Check In', 'sohohotel_booking') . "';
	var sohohotel_max_rooms = '" . sh_get_booking_max_rooms() . "';
	var sohohotel_check_out_txt = '" . esc_html__('Check Out', 'sohohotel_booking') . "';
	var sohohotel_datepicker_days = " . $datepicker_days . ";
	var sohohotel_datepicker_months = " . $datepicker_months . ";
	var sohohotel_dp_selected = '" . esc_html__('Your stay:', 'sohohotel_booking') . "';
	var sohohotel_dp_night = '" . esc_html__('Night', 'sohohotel_booking') . "';
	var sohohotel_dp_nights = '" . esc_html__('Nights', 'sohohotel_booking') . "';
	var sohohotel_dp_button = '" . esc_html__('Close', 'sohohotel_booking') . "';
	var sohohotel_dp_checkin_disabled = '" . esc_html__('Check-in disabled', 'sohohotel_booking') . "';
	var sohohotel_dp_checkout_disabled = '" . esc_html__('Check-out disabled', 'sohohotel_booking') . "';
	var sohohotel_dp_error_more = '" . esc_html__('Date range should not be more than 1 night', 'sohohotel_booking') . "';
	var sohohotel_dp_error_more_plural = '" . esc_html__('Date range should not be more than %d nights', 'sohohotel_booking') . "';
	var sohohotel_dp_error_less = '" . esc_html__('Date range should not be less than 1 night', 'sohohotel_booking') . "';
	var sohohotel_dp_error_less_plural = '" . esc_html__('Date range should not be less than %d nights', 'sohohotel_booking') . "';
	var sohohotel_dp_info_more = '" . esc_html__('Please select a date range of at least 1 night', 'sohohotel_booking') . "';
	var sohohotel_dp_info_more_plural = '" . esc_html__('Please select a date range of at least %d nights', 'sohohotel_booking') . "';
	var sohohotel_dp_info_range = '" . esc_html__('Please select a date range between %d and %d nights', 'sohohotel_booking') . "';
	var sohohotel_dp_info_default = '" . esc_html__('Please select a date range', 'sohohotel_booking') . "';
    var errorMessages = {
      incorrect_number: '" . esc_html__('The card number is incorrect', 'sohohotel_booking') . "',
      invalid_number: '" . esc_html__('The card number is not a valid credit card number', 'sohohotel_booking') . "',
      invalid_expiry_month: '" . esc_html__('The card\'s expiration month is invalid', 'sohohotel_booking') . "',
      invalid_expiry_year: '" . esc_html__('The card\'s expiration year is invalid', 'sohohotel_booking') . "',
      invalid_cvc: '" . esc_html__('The card\'s security code is invalid', 'sohohotel_booking') . "',
      expired_card: '" . esc_html__('The card has expired', 'sohohotel_booking') . "',
      incorrect_cvc: '" . esc_html__('The card\'s security code is incorrect', 'sohohotel_booking') . "',
      incorrect_zip: '" . esc_html__('The card\'s zip code failed validation', 'sohohotel_booking') . "',
      card_declined: '" . esc_html__('The card was declined', 'sohohotel_booking') . "',
      missing: '" . esc_html__('There is no card on a customer that is being charged', 'sohohotel_booking') . "',
      processing_error: '" . esc_html__('An error occurred while processing the card', 'sohohotel_booking') . "',
      rate_limit: '" . esc_html__('An error occurred due to requests hitting the API too quickly. Please let us know if you\'re consistently running into this error', 'sohohotel_booking') . "',
  	missing_payment_information: '" . esc_html__('Missing payment information', 'sohohotel_booking') . "'
    };
	var sohohotel_blocked_dates_all = " . $blocked_dates . ";
	var sohohotel_terms_set = '" . $terms_and_conditions . "';");
}



/* ----------------------------------------------------------------------------

   Load Admin CSS & JS

---------------------------------------------------------------------------- */
add_action('admin_enqueue_scripts', 'admin_js_css');
function admin_js_css() {
	
	global $sohohotel_data;
	
	// Admin CSS
	wp_enqueue_style('sohohotel_booking_css', sohohotel_booking_PLUGIN_URL . 'assets/css/admin/style.css');
	wp_enqueue_style('sohohotel_booking_fontawesome', sohohotel_booking_PLUGIN_URL .'assets/css/admin/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('sohohotel_booking_fontawesome-brands', sohohotel_booking_PLUGIN_URL .'assets/css/admin/font-awesome/css/brands.min.css');
    wp_enqueue_style('sohohotel_booking_fontawesome-solid', sohohotel_booking_PLUGIN_URL .'assets/css/admin/font-awesome/css/solid.min.css');
	
	// Admin JS
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_script( 'jquery-ui-accordion' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_register_script( 'sohohotel_booking_js', sohohotel_booking_PLUGIN_URL . 'assets/js/admin/scripts.js' );
	wp_enqueue_script( 'sohohotel_booking_js' );
	
	// Get Date Format
	if ( !empty($sohohotel_data["date_format"]) ) {
		$datepickerDateFormat = $sohohotel_data["date_format"];
	} else {
		$datepickerDateFormat = 'dd/mm/yy';
	}
	
	// Get Minimum Stay
	if ( $sohohotel_data['minimum_stay'] ) {
		$sohohotel_bookingMinBookPeriod = $sohohotel_data['minimum_stay'];	
	} else {
		$sohohotel_bookingMinBookPeriod = '1';
	}
	
	if ( $sohohotel_data['datepicker_days'] ) {
		
		$regex = "/^[\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*]$/";
		if (preg_match($regex, $sohohotel_data['datepicker_days'])) {
		    $datepicker_days = $sohohotel_data['datepicker_days'];
		} else {
		    $datepicker_days = "['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa']";
		}

	} else {
		$datepicker_days = "['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa']";
	}

	if ( $sohohotel_data['datepicker_months'] ) {
		
		$regex = "/^[\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*,\s*'\s*[\s\S]{1,20}\s*'\s*]$/";
		if (preg_match($regex, $sohohotel_data['datepicker_months'])) {
		    $datepicker_months = $sohohotel_data['datepicker_months'];
		} else {
		    $datepicker_months = "['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']";
		}
		
	} else {
		$datepicker_months = "['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']";
	}
	
	// Admin Custom JS Variables
	wp_add_inline_script( 'sohohotel_booking_js', "
	var sohohotel_booking_AJAX_URL = '" . sohohotel_booking_AJAX_URL . "';
	var sohohotel_bookingLoadingImage = '" . sohohotel_booking_PLUGIN_URL . "assets/images/loading.gif';
	var datepickerDateFormat = '" . $datepickerDateFormat . "';
	var sohohotel_bookingMinBookPeriod = '" . $sohohotel_bookingMinBookPeriod . "';
	var sohohotel_required_msg = '" . esc_html__('Please fill out all the fields', 'sohohotel_booking') . "';
	var sohohotel_blocked_day_msg = '" . esc_html__('Please select at least 1 day of the week to be blocked in the specified date range', 'sohohotel_booking') . "';
	var sohohotel_coupon_type_msg = '" . esc_html__('Please select a discount type', 'sohohotel_booking') . "';
	var sohohotel_coupon_amounts_msg = '" . esc_html__('Please only enter numbers for the discount amount field', 'sohohotel_booking') . "';
	var sohohotel_price_numeric_msg = '" . esc_html__('Please only enter numbers in the price fields', 'sohohotel_booking') . "';
	var sohohotel_select_check_in_check_out_msg = '" . esc_html__('Please select check in and check out dates', 'sohohotel_booking') . "';
	var sohohotel_select_room_msg = '" . esc_html__('Please select at least 1 room', 'sohohotel_booking') . "';
	var sohohotel_datepicker_days = " . $datepicker_days . ";
	var sohohotel_datepicker_months = " . $datepicker_months . ";
	var sohohotel_date_msg = '" . esc_html__('The from date must be before the to date', 'sohohotel_booking') . "';" );
	
	if ( 'coupon' == get_post_type() ) {
		wp_register_script( 'sohohotel_booking_coupon_js', sohohotel_booking_PLUGIN_URL . 'assets/js/admin/coupon_scripts.js' );
		wp_enqueue_script( 'sohohotel_booking_coupon_js' );
	}
	
	if ( 'service' == get_post_type() ) {
		wp_register_script( 'sohohotel_booking_service_js', sohohotel_booking_PLUGIN_URL . 'assets/js/admin/service_scripts.js' );
		wp_enqueue_script( 'sohohotel_booking_service_js' );
	}
	
	if ( 'blocked_dates' == get_post_type() ) {
		wp_register_script( 'sohohotel_booking_blocked_dates_js', sohohotel_booking_PLUGIN_URL . 'assets/js/admin/blocked_dates_scripts.js' );
		wp_enqueue_script( 'sohohotel_booking_blocked_dates_js' );
	}

}



/* ----------------------------------------------------------------------------

   WPML

---------------------------------------------------------------------------- */
global $sitepress;
if ( !empty($sitepress) ){
	define('sohohotel_booking_AJAX_URL', admin_url('admin-ajax.php?lang=' . $sitepress->get_current_language()));
} else {
	define('sohohotel_booking_AJAX_URL', admin_url('admin-ajax.php'));
}



/* ----------------------------------------------------------------------------

   Load Shortcodes

---------------------------------------------------------------------------- */
include 'includes/shortcodes/accommodation-listing-1.php';
include 'includes/shortcodes/accommodation-listing-2.php';
include 'includes/shortcodes/accommodation-listing-3.php';
include 'includes/shortcodes/accommodation-listing-video.php';
include 'includes/shortcodes/accommodation-carousel-1.php';
include 'includes/shortcodes/accommodation-carousel-2.php';
include 'includes/shortcodes/booking-page.php';
include 'includes/shortcodes/booking-form-1.php';
include 'includes/shortcodes/booking-form-2.php';
include 'includes/shortcodes/booking-form-3.php';
include 'includes/shortcodes/booking-form-4.php';
include 'includes/shortcodes/booking-form-5.php';
include 'includes/shortcodes/hotel-listing-1.php';
include 'includes/shortcodes/hotel-listing-2.php';



/* ----------------------------------------------------------------------------

   Load Post Types

---------------------------------------------------------------------------- */
include 'includes/post-types/accommodation.php';
include 'includes/post-types/booking.php';
include 'includes/post-types/blocked_dates.php';
include 'includes/post-types/coupons.php';
include 'includes/post-types/services.php';
include 'includes/post-types/ical.php';



/* ----------------------------------------------------------------------------

   Load Functions

---------------------------------------------------------------------------- */
include 'includes/functions/core-functions.php';
include 'includes/functions/custom-booking-form.php';
include 'includes/functions/booking-process-frontend.php';
include 'includes/functions/booking-calendar.php';
include 'includes/functions/booking-listing.php';
include 'includes/functions/booking-add.php';



/* ----------------------------------------------------------------------------

   Load Functions

---------------------------------------------------------------------------- */
include 'includes/pagebuilder/pagebuilder_booking.php';



/* ----------------------------------------------------------------------------

   Load Template Chooser

---------------------------------------------------------------------------- */
add_filter( 'template_include', 'sohohotel_booking_template_chooser');
function sohohotel_booking_template_chooser( $template ) {

    $post_id = get_the_ID();
	
	if ( get_post_type( $post_id ) == 'ical' ) {
		return sohohotel_booking_get_template_hierarchy( 'ical' );
	}
	
	if ( get_post_type( $post_id ) == 'blocked_dates' && is_single() ) {
		return false;
	}
	
	if ( get_post_type( $post_id ) == 'blocked_dates' ) {
		return false;
	}
	
	if ( get_post_type( $post_id ) == 'coupon' && is_single() ) {
		return false;
	}
	
	if ( get_post_type( $post_id ) == 'coupon' ) {
		return false;
	}
	
	if ( get_post_type( $post_id ) == 'booking' && is_single() ) {
		return false;
	}
	
	if ( get_post_type( $post_id ) == 'booking' ) {
		return false;
	}
	
    if ( get_post_type( $post_id ) == 'accommodation' && !is_single() ) {
        return sohohotel_booking_get_template_hierarchy( 'accommodation' );
    }
	
    if ( get_post_type( $post_id ) != 'accommodation' ) {
        return $template;
    }

    if ( is_single() ) {
        return sohohotel_booking_get_template_hierarchy( 'single-accommodation' );
    }
 
}



/* ----------------------------------------------------------------------------

   Select Template

---------------------------------------------------------------------------- */
add_filter( 'template_include', 'sohohotel_booking_template_chooser' );
function sohohotel_booking_get_template_hierarchy( $template ) {
 
    $template_slug = rtrim( $template, '.htm.php' );
    $template = $template_slug . '.htm.php';
 
    if ( $theme_file = locate_template( array( 'includes/templates/' . $template ) ) ) {
        $file = $theme_file;
    }
    else {
        $file = sohohotel_booking_BASE_DIR . '/includes/templates/' . $template;
    }
 
    return apply_filters( 'sohohotel_booking_template_' . $template, $file );
}



/* ----------------------------------------------------------------------------

   Select Taxonomy Template

---------------------------------------------------------------------------- */
add_filter('template_include', 'sohohotel_booking_taxonomy_template');
function sohohotel_booking_taxonomy_template( $template ){

	if( is_tax('accommodation-categories')){
  		$template = sohohotel_booking_BASE_DIR .'/includes/templates/taxonomy-accommodation-categories.htm.php';
 	}  
  	
	return $template;

}