<?php

/* --------------------------------------------------------------------------------

   Get Price: Used to display the price in the correct user selected format

-------------------------------------------------------------------------------- */
function sh_get_price($price) {
	
	global $sohohotel_data;
	
	// Price currency position
	if ( $sohohotel_data['currency_position'] == '1' ) {
		// Display currency symbol after price
		$currency_position = '2';
	} else {
		// Display currency symbol before price
		$currency_position = '1';
	}
	
	// Price thousand separator
	if ( !empty($sohohotel_data['price_thousand_separator']) ) {
		$thousand_separator = $sohohotel_data['price_thousand_separator'];
	} else {
		$thousand_separator = ',';
	}
	
	// Price decimal separator
	if ( !empty($sohohotel_data['price_decimal_separator']) ) {
		$decimal_separator = $sohohotel_data['price_decimal_separator'];
	} else {
		$decimal_separator = '.';
	}
	
	// Price decimal separator
	if ( !empty($sohohotel_data['price_decimal_places']) ) {
		
		if ($sohohotel_data['price_decimal_places'] == 'zero') {
			$number_decimals = 0;
		} else {
			$number_decimals = $sohohotel_data['price_decimal_places'];
		}
		
	} else {
		$number_decimals = '2';
	}
	
	$price = number_format($price,$number_decimals);
	
	$price_format_pre = str_replace(
	    array(",","."),
	    array("#!#", "^!^"),
	    $price
	);
	
	$price_format = str_replace(
	    array("#!#","^!^"),
	    array($thousand_separator, $decimal_separator),
	    $price_format_pre
	);
	
	if ( $sohohotel_data['currency_unit'] == '' ) {
		$sohohotel_booking_currency_unit = '$';
	} else {
		$sohohotel_booking_currency_unit = $sohohotel_data['currency_unit'];
	}
	
	if ( $currency_position == '1' ) {
		return $sohohotel_booking_currency_unit.$price_format;
	} else {
		return $price_format.$sohohotel_data['currency_unit'];
	}
	
}



/* --------------------------------------------------------------------------------

   Get Price: Used to display the price in the correct user selected format

-------------------------------------------------------------------------------- */
function sh_get_price_no_format($price) {

	global $sohohotel_data;
	
	// Price currency position
	if ( $sohohotel_data['currency_position'] == '1' ) {
		// Display currency symbol after price
		$currency_position = '2';
	} else {
		// Display currency symbol before price
		$currency_position = '1';
	}
	
	if ( $sohohotel_data['currency_unit'] == '' ) {
		$sohohotel_booking_currency_unit = '$';
	} else {
		$sohohotel_booking_currency_unit = $sohohotel_data['currency_unit'];
	}
	
	if ( $currency_position == '1' ) {
		return $sohohotel_booking_currency_unit.$price;
	} else {
		return $price.$sohohotel_data['currency_unit'];
	}

}



/* --------------------------------------------------------------------------------

   Get Service Name: Used to display the service name

-------------------------------------------------------------------------------- */
function sh_get_service_name($name) {

	if( $name == 'flatfee' ) {
		return esc_html__( 'Flat Fee', 'sohohotel_booking' );
	} elseif( $name == 'perroom' ) {
		return esc_html__( 'Per Room', 'sohohotel_booking' );
	} elseif( $name == 'perperson' ) {
		return esc_html__( 'Per Person', 'sohohotel_booking' );
	} elseif( $name == 'pernight' ) {
		return esc_html__( 'Per Night', 'sohohotel_booking' );
	} elseif( $name == 'perbooking' ) {
		return esc_html__( 'Per Booking', 'sohohotel_booking' );
	} else {
		return $name;
	}
	
}



/* --------------------------------------------------------------------------------

   Get Booked Room IDs DB: Get the number of booked room IDs for the selected dates

-------------------------------------------------------------------------------- */
function sh_get_booked_room_ids_db($check_in,$check_out,$check_calendar) {
	
	global $post;
	
	$booked_ids = array();
	$booking_data_array = array();
	
	$args = array(
	'post_type' => 'booking',
	'posts_per_page' => '9999',
	);
	
	// Query bookings
	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) :
		while($wp_query->have_posts()) :	
			$wp_query->the_post();
	
			// Get booking data
			$booking_meta = get_post_meta($post->ID,'_booking_meta',TRUE);
			$room_booking_data = $booking_meta['save_rooms'];
			
			// Decode room booking data
			$room_booking_data_decoded = json_decode($room_booking_data, true);
			
			// Only check availability for bookings with a status of "confirmed"
			if ($booking_meta["booking_status"] == '2') {
				
				// Loop room booking data
				foreach($room_booking_data_decoded as $key => $val) {
					
					if ($check_calendar == true) {
						$check_in_db = $booking_meta['check_in'];
						$check_out_db = $booking_meta['check_out'];
					} else {
						$check_in_db = date('Y-m-d', strtotime($booking_meta['check_in'] . ' +1 day'));
						$check_out_db = date('Y-m-d', strtotime($booking_meta['check_out'] . ' -1 day'));
					}
					
					// If dates overlap add ID to array
					if ( sh_get_date_range_overlap($check_in,$check_out,$check_in_db,$check_out_db) == true ) {
						
						$booking_data_array[] = array('check_in'=>$booking_meta['check_in'],'check_out'=>$booking_meta['check_out'],'room_type'=>$val['room_type']);
				
					}

				}
				
			} 
			
		endwhile;
	else :
	endif;
	
	wp_reset_query();
	
	$sh_get_date_range_array = sh_get_date_range_array($check_in,$check_out);
	$date_room_array = array();
	
	foreach($sh_get_date_range_array as $key => $val) {
		
		$inner_room_id_array = array();
		
		foreach($booking_data_array as $key2 => $val2) {
			
			if ( sh_get_date_range_overlap($val,$val,$val2['check_in'],date('Y-m-d', strtotime($val2['check_out'] . ' -1 day'))) == true ) {
				$inner_room_id_array[] = $val2['room_type'];
			} 
			
			$date_room_array[$val] = $inner_room_id_array;
			
		}
		
	}

	$x=array();
	foreach($date_room_array as $value){
	    $x=sh_merge_if_greater_than($x,array_count_values($value));
	}
	
	$result=array();
	foreach($x as $k=>$v){
	    for($i=$v;$i>0;$i--){
	        $result[]=$k;
	    }
	}
	
	return $result;
	
}



/* --------------------------------------------------------------------------------

   Get Booked Room IDs DB: Get the number of booked room IDs for the selected dates

-------------------------------------------------------------------------------- */
function sh_merge_if_greater_than($x,$y){
	
    if(!is_array($x)&&!is_array($y)) return false;
    foreach($x as $k=>$v){
        if(isset($y[$k])){
            if($y[$k]>$v)
                $x[$k]=$y[$k];
            unset($y[$k]);
        }

    }
	
    if(!empty($y))
    foreach($y as $k=>$v){
        $x[$k]=$v;
    }
	
    return $x;
	
}



/* --------------------------------------------------------------------------------

   Get Booked Room IDs DB: Get the fully booked room IDs (should be used with 
   sh_get_booked_room_ids_db function)

-------------------------------------------------------------------------------- */
function sh_get_fully_booked_room_ids($booked_ids) {
	
	$booked_ids_full = array();
	
	// If number of bookings exceeds limit the room is fully booked
	$frequencies = array_count_values(sh_get_original_wpml_ids($booked_ids,'accommodation'));
	foreach ($frequencies as $key => $val) {

		if ($val >= sh_get_number_rooms_of_type($key)) {
			$booked_ids_full[] = $key; 
	    }
	}
	
	return $booked_ids_full;
	
}



/* --------------------------------------------------------------------------------

   Get Booked Room IDs SESSION: Get the number of booked room IDs for the selected 
   dates from the temporarily booked rooms stored in the SESSION

-------------------------------------------------------------------------------- */
function sh_get_booked_room_ids_session($check_in,$check_out) {
	
	// Check backend booking session
	if( !empty($_SESSION['sh_booking_data_backend']) ) {
		
		// Loop through the array and check 
		foreach($_SESSION['sh_booking_data_backend'] as $key => $val) {
			
			$check_in_session = $val[0][1];
			$check_out_session = date('Y-m-d', strtotime($val[0][2] . ' -1 day'));
			
			// If dates overlap add ID to array
			if ( sh_get_date_range_overlap($check_in,$check_out,$check_in_session,$check_out_session) == true ) {
				
				// Store IDs which overlap with the booking date
				$booked_ids[] = sh_get_original_wpml_id($val[0][0],'accommodation'); 

			}

		}

	}
	
	// Check frontend booking session
	if( !empty($_SESSION['sh_booking_data']) ) {

		foreach (range(1, $_SESSION['sh_booking_data']["book_room"]) as $r) {
			$booked_ids[] = sh_get_original_wpml_id($_SESSION['sh_booking_data']["room_" . $r]["room_id"],'accommodation');
		}

	}
	
	if( !empty($booked_ids) ) {
		return $booked_ids;
	} else {
		return false;
	}
	
}



/* --------------------------------------------------------------------------------

   Get Number Of Rooms Of Type: Get the number of bookable rooms for a specific room type

-------------------------------------------------------------------------------- */
function sh_get_number_rooms_of_type($room_id) {
	
	global $post;
	
	$args = array(
	'post_type' => 'accommodation',
	'posts_per_page' => '10',
	'page_id' => $room_id
	);
	
	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) :
		while($wp_query->have_posts()) :	
			$wp_query->the_post();
	
			// Get accommodation data
			$accommodation_meta = json_decode( get_post_meta($post->ID,'_accommodation_meta',TRUE), true );
			
			// Get room booking data
			return $accommodation_meta['number_of_rooms_this_type'];
			
		endwhile;
	else :
		return esc_html__('No room found','sohohotel_booking');
	endif;

	wp_reset_query();
	
}



/* --------------------------------------------------------------------------------

   Get Current Room: Get the current room number being booked

-------------------------------------------------------------------------------- */
function sh_get_current_room() {
	
	$sohohotel_booking_data = $_SESSION['sh_booking_data'];
	for ($i = 1; $i <= $sohohotel_booking_data['book_room']; $i++) {

		if ( $sohohotel_booking_data['room_'.$i]['room_name'] == '' ) {
			$empty_room_id .= $i.', ';
		}

	}

	if ( empty($empty_room_id) ) {
		$current_room = $sohohotel_booking_data['book_room'] + 1;
	} else {
		$empty_room_id_trim = rtrim($empty_room_id, ", ");
		$empty_room_id_array = explode(", ",$empty_room_id_trim);
		$current_room = min($empty_room_id_array);
	}
	
	return $current_room;

}



/* --------------------------------------------------------------------------------

   Get Current Room: Get the current room number being booked

-------------------------------------------------------------------------------- */
function sh_store_backend_booking_data_temp($room_details) {
	
	// Get existing array from session
	if( !empty($_SESSION['sh_booking_data_backend']) ) {
		$sh_booking_data_backend = $_SESSION['sh_booking_data_backend'];
	} else {
		$sh_booking_data_backend = array ();	
	}
	
	// Add new booking to array
	$insert_data = array (
		array($room_details["room_type"],$room_details["check_in"],$room_details["check_out"])
	);
	array_push($sh_booking_data_backend, $insert_data);
	
	// Save array in session
	$_SESSION['sh_booking_data_backend'] = $sh_booking_data_backend;
	
}



/* --------------------------------------------------------------------------------

   Get Date Range Overlap: Checks if two date ranges overlap

-------------------------------------------------------------------------------- */
function sh_get_date_range_overlap($from1,$to1,$from2,$to2) {
	
	/* Checks if two date ranges overlap, date must be in format YYYY-MM-DD e.g. 2017-11-01 */
	
	if ( $from1 <= $to2 && $to1 >= $from2 ) {
		return true;
	} else {
		return false;
	}
	
}



/* ------------------------------------------------

   Get Maximum Rooms: Used in the booking forms

------------------------------------------------ */
function sh_get_booking_max_rooms() {
	
	global $sohohotel_data;
	
	if ( $sohohotel_data['booking_form_max_rooms'] ) {
		return $sohohotel_data['booking_form_max_rooms'];
	} else {
		return '9';
	}
	
}



/* ------------------------------------------------

   Get Maximum Guests: Used in the booking forms

------------------------------------------------ */
function sh_get_booking_max_guests() {
	
	global $sohohotel_data;
	
	if ( $sohohotel_data['booking_form_max_person'] ) {
		return $sohohotel_data['booking_form_max_person'];
	} else {
		return '9';
	}
	
}



/* --------------------------------------------------------------------------------

   Display Booking Steps: Used on the booking page

-------------------------------------------------------------------------------- */
function sh_display_booking_steps($current_step) {

	ob_start();
	include(sohohotel_booking_BASE_DIR . '/includes/templates/booking-steps.htm.php');
	return ob_get_clean();
	
}



/* --------------------------------------------------------------------------------

   Display Booking Step 1 Main Content

-------------------------------------------------------------------------------- */
function sh_display_bs1_main() {

	ob_start();
	include(sohohotel_booking_BASE_DIR . '/includes/templates/booking-step1-main.htm.php');
	return ob_get_clean();
	
}



/* --------------------------------------------------------------------------------

   Display Booking Step 1 Sidebar

-------------------------------------------------------------------------------- */
function sh_display_bs1_sidebar() {

	ob_start();
	include(sohohotel_booking_BASE_DIR . '/includes/templates/booking-step1-sidebar.htm.php');
	return ob_get_clean();
	
}



/* --------------------------------------------------------------------------------

   Display Booking Step 2 Sidebar

-------------------------------------------------------------------------------- */
function sh_display_bs2_sidebar() {

	ob_start();
	include(sohohotel_booking_BASE_DIR . '/includes/templates/booking-step2-sidebar.htm.php');
	return ob_get_clean();
	
}



/* --------------------------------------------------------------------------------

   Display Booking Step 2 Main Content

-------------------------------------------------------------------------------- */
function sh_display_bs2_main() {

	ob_start();
	include(sohohotel_booking_BASE_DIR . '/includes/templates/booking-step2-main.htm.php');
	return ob_get_clean();
	
}



/* --------------------------------------------------------------------------------

   Display Booking Step 2 Main Content

-------------------------------------------------------------------------------- */
function sh_display_bs2_main_services() {

	ob_start();
	include(sohohotel_booking_BASE_DIR . '/includes/templates/booking-step2-main-services.htm.php');
	return ob_get_clean();
	
}



/* --------------------------------------------------------------------------------

   Store Booking Step 1 Data In A Session

-------------------------------------------------------------------------------- */
function sh_store_bs1_data_temp($data) {
	
	if( !empty($_SESSION['sh_booking_data']) ) {
		$sh_booking_data = $_SESSION['sh_booking_data'];
	}
	
	// Store room data in array;
	$sh_booking_data["check_in"] = $data["check_in"];
	$sh_booking_data["check_out"] = $data["check_out"];
	$sh_booking_data["book_room"] = $data["book_room"];
	
	foreach (range(1, $data["book_room"]) as $r) {
		$sh_booking_data["room_" . $r]["adults"] = $data["book_room_adults_" . $r];
		$sh_booking_data["room_" . $r]["children"] = $data["book_room_children_" . $r];		
	}
	
	$_SESSION['sh_booking_data'] = $sh_booking_data;

}



/* --------------------------------------------------------------------------------

   Store Booking Step 2 Data In A Session

-------------------------------------------------------------------------------- */
function sh_store_bs2_data_temp($room_data,$current_room) {
	
	if( !empty($_SESSION['sh_booking_data']) ) {
		$sh_booking_data = $_SESSION['sh_booking_data'];
	}
	
	$bits = explode("||",$room_data);	
	
	$sh_booking_data["room_" . $current_room]["room_id"] = $bits[0];
	$sh_booking_data["room_" . $current_room]["room_name"] = $bits[1];
	
	$_SESSION['sh_booking_data'] = $sh_booking_data;
	
}



/* --------------------------------------------------------------------------------

   Get all bookings for a specific date range (from database and temp data)

-------------------------------------------------------------------------------- */
function sh_get_all_booked_room_ids($check_in,$check_out,$check_session,$check_calendar) {

	if ($check_calendar == true) {
		
		// Get booked room IDs from the database
		$db_booked_ids = sh_get_booked_room_ids_db($check_in,$check_out,true);
		
	} else {
		
		// Get booked room IDs from the database
		$db_booked_ids = sh_get_booked_room_ids_db($check_in,$check_out,false);
		
	}

	// Get booked room IDs from the temporary session
	$session_booked_ids = sh_get_booked_room_ids_session($check_in,$check_out);
	
	// Get booked room IDs from blocked dates database
	$db_blocked_date_booked_ids = sh_get_blocked_date_ids($check_in,$check_out);
	
	// Check if there are any temp session bookings
	if ($session_booked_ids != '') {
		
		// Do not check availability in temp session bookings if false (used to avoid conflict on availability calendar)
		if($check_session == true) {
			$merge_array_1 = $session_booked_ids;
		} else {
			$merge_array_1 = array();
		}
	
	} else {
		$merge_array_1 = array();
	}
	
	// Check if there are any database bookings
	if ($db_booked_ids != '') {
		$merge_array_2 = $db_booked_ids;
	} else {
		$merge_array_2 = array();
	}
	
	// Check if there are any database blocked dates
	if ($db_blocked_date_booked_ids != '') {
		$merge_array_3 = $db_blocked_date_booked_ids;
	} else {
		$merge_array_3 = array();
	}
	
	// Merge database and session room IDs into a single array
	$all_booked_ids = array_merge($merge_array_1,$merge_array_2);
	
	// Convert all IDs to int 
	$all_booked_ids_int = array();
	foreach($all_booked_ids as $key => $val) {	
		$all_booked_ids_int[] = (int)$val;
	}

	// Check which rooms are fully booked
	$fully_booked_rooms_db = sh_get_fully_booked_room_ids( $all_booked_ids_int );
	
	if ( !empty(sh_get_fully_booked_room_ids( $all_booked_ids_int )) ) {
		$fully_booked_rooms_db = sh_get_fully_booked_room_ids( $all_booked_ids_int );
	} else {
		$fully_booked_rooms_db = array();
	}
	
	// Blocked rooms in $merge_array_3 do not need to be checked against sh_get_fully_booked_room_ids
	$all_booked_ids_complete = array_merge($fully_booked_rooms_db,$merge_array_3);
	
	return sh_get_translated_wpml_ids($all_booked_ids_complete,'accommodation');
	
}



/* --------------------------------------------------------------------------------

   Display price breakdown of a room for a specific date range  

-------------------------------------------------------------------------------- */
function sh_get_price_breakdown_room($check_in,$check_out,$adults,$children,$room_id) {
	
	// Set check out date to 1 day earlier because we are booking by the night, not by the day
	$check_out = date('Y-m-d', strtotime($check_out . ' -1 day'));
	
	global $sohohotel_data; 
	
	if ( !empty($sohohotel_data["weekly_booking_nights"]) ) {
		$weekly_price_limit = $sohohotel_data["weekly_booking_nights"];
	} else {
		$weekly_price_limit = '6';
	}
	
	if ( !empty($sohohotel_data["monthly_booking_nights"]) ) {
		$monthly_price_limit = $sohohotel_data["monthly_booking_nights"];
	} else {
		$monthly_price_limit = '28';
	}
	
	if ( !empty($sohohotel_data["weekend_nights"]) ) {
		
		if ( $sohohotel_data["weekend_nights"] == '1' ) {
			$weekend_day = array('5','6');
		} elseif ( $sohohotel_data["weekend_nights"] == '2' ) {
			$weekend_day = array('6','0');
		} elseif ( $sohohotel_data["weekend_nights"] == '3' ) {
			$weekend_day = array('4','5','6');
		} else {
			$weekend_day = array('5','6','0');
		}
		
	} else {
		$weekend_day = array('5','6');
	}

	$number_of_nights = sh_get_booking_nights($check_in,$check_out);
	
	$merge_price_arrays = array();
	
	global $post;
	global $wp_query_2;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$room_id = array($room_id);
	
	$args_2 = array(
	'post_type' => 'accommodation',
	'posts_per_page' => '1',
	'post__in' => $room_id
	);
	
	$wp_query_2 = new WP_Query( $args_2 );
	if ($wp_query_2->have_posts()) : ?>
		
		<?php while($wp_query_2->have_posts()) :
			
			$wp_query_2->the_post(); 
			
				// Get accommodation data
				$accommodation_meta = json_decode( get_post_meta($post->ID,'_accommodation_meta',TRUE), true ); ?>
				
					<?php 
					
					// Use nightly pricing
					// + 1 to nights because we -1 above so the last check out day isn't charged
					if ( ($number_of_nights + 1) < $weekly_price_limit ) {
		
						$price_scheme = 'nightly';
						$additional_price_rules = json_decode($accommodation_meta["general_price_rules_1"], true);
						$seasonal_price_rules = json_decode($accommodation_meta["general_price_rules_2"], true);
						
					// Use weekly pricing
					} elseif ( ($number_of_nights + 1) >= $weekly_price_limit && ($number_of_nights + 1) < $monthly_price_limit ) {
						
						$price_scheme = 'weekly';
						$additional_price_rules = json_decode($accommodation_meta["general_price_rules_3"], true);
						$seasonal_price_rules = json_decode($accommodation_meta["general_price_rules_4"], true);
						
					// Use monthly pricing
					} elseif ( ($number_of_nights + 1) >= $monthly_price_limit ) {
						
						$price_scheme = 'monthly';
						$additional_price_rules = json_decode($accommodation_meta["general_price_rules_5"], true);
						$seasonal_price_rules = json_decode($accommodation_meta["general_price_rules_6"], true);
						
					}
					
					// Create loop for each date within booking
					foreach( sh_get_date_range_array($check_in,$check_out) as $date_key => $date) {
						
						$use_seasonal = false;
						
						// Loop through seasonal price rules and check for overlaps with booking date
						foreach($seasonal_price_rules as $key => $val) {
							
							if ( sh_get_date_range_overlap($val["date_range_from"],$val["date_range_to"],$date,$date) == true ) {	
								$use_seasonal = true;
								$seasonal_key = $key;
								$use_seasonal_val = $val;
							}
						
						}
						
						// If date range overlaps with seasonal price use seasonal price
						if ( $use_seasonal == true ) {
							
							// Seasonal adult pricing
							$merge_price_arrays[] = sh_get_standard_pricing($adults,'adult',$use_seasonal_val,$date,$weekend_day,true,$price_scheme);
							
							// Seasonal additional adult price rules
							$merge_price_arrays[] = sh_get_additional_pricing($adults,'adult',$seasonal_price_rules,$date,$weekend_day,true,$seasonal_key);
							
							// Seasonal child pricing
							$merge_price_arrays[] = sh_get_standard_pricing($children,'child',$use_seasonal_val,$date,$weekend_day,true,$price_scheme);
							
							// seasonal additional child price rules
							$merge_price_arrays[] = sh_get_additional_pricing($children,'child',$seasonal_price_rules,$date,$weekend_day,true,$seasonal_key);

						// Else use standard pricing
						} else {
							
							// Standard adult pricing
							$merge_price_arrays[] = sh_get_standard_pricing($adults,'adult',$accommodation_meta,$date,$weekend_day,false,$price_scheme);
							
							// Additional adult price rules
							$merge_price_arrays[] = sh_get_additional_pricing($adults,'adult',$additional_price_rules,$date,$weekend_day,false,false);
							
							// Standard child pricing
							$merge_price_arrays[] = sh_get_standard_pricing($children,'child',$accommodation_meta,$date,$weekend_day,false,$price_scheme);
							
							// Additional child price rules
							$merge_price_arrays[] = sh_get_additional_pricing($children,'child',$additional_price_rules,$date,$weekend_day,false,false);
							
						}
						
					} ?>
			
		<?php endwhile; ?>
		
		<?php else :
			// No Rooms Available
		endif;

		//wp_reset_query();
		
		// Merge the arrays into one
		$merged_array = call_user_func_array('array_merge_recursive', $merge_price_arrays);
	
		// Calculate total
		$total_price = 0;
		foreach($merged_array as $key => $val) {	
			foreach($val as $val2) {	
				$total_price += $val2;	
			}
		}

		// Add total to array
		$merged_array["Total"] = $total_price;
		
	return $merged_array;

}



/* --------------------------------------------------------------------------------

   Display Seasonal Price Rule Form

-------------------------------------------------------------------------------- */
function seasonal_price_rules_form($id,$type,$data) {
	
	ob_start();
	
	$data_decoded = json_decode($data, true);
	
	if ($type == 'pricerule') {
		echo '<div class="price-rule-wrapper-outer">'; 
			if(!empty($data_decoded)) {
				foreach ($data_decoded as $key => $season) {
					include (sohohotel_booking_BASE_DIR . "/includes/templates/admin/price_rule.htm.php");
				}
			}
			echo '</div>
			<button class="add-price-rule button-primary" type="button">Add Price Rule</button>
			<textarea class="qns-hidden-data  price_filter_data_' . $id . '" name="_accommodation_meta[general_price_rules_' . $id . ']">' . $data . '</textarea>';
	}
	
	/*if ($type == 'seasonal') {
		
		print_r($data);
		
		if(!empty($data_decoded)) {
			foreach ($data_decoded as $key => $season) {
				
				echo 'Date From: ' . $season["date_range_from"] . '<br />';
				echo 'Date To: ' . $season["date_range_to"] . '<br />';
				echo 'Adult Weekday: ' . $season["season_adult_weekdays"] . '<br />';
				echo 'Adult Weekend: ' . $season["season_adult_weekends"] . '<br />';
				echo 'Child Weekday: ' . $season["season_child_weekdays"] . '<br />';
				echo 'Child Weekend: ' . $season["season_child_weekends"] . '<br />';
				

				
				if (!empty($season["price"][1])) {
			        foreach ($season["price"] as $keyPrice => $seasonPrice) {
			            
						echo 'Adult Weekday Price Rule: ' . $seasonPrice["price_adult_weekdays"] . '<br />';
						echo 'Adult Weekend Price Rule: ' . $seasonPrice["price_adult_weekends"] . '<br />';
						echo 'Child Weekday Price Rule: ' . $seasonPrice["price_child_weekdays"] . '<br />';
						echo 'Child Weekend Price Rule: ' . $seasonPrice["price_child_weekends"] . '<br />';
			
			        }
			    }
				
				
				
			}
		}*/
		
		if ($type == 'seasonal') {
			echo '<div class="seasonal-filter-wrapper-outer">';

				if(!empty($data_decoded)) {
					foreach ($data_decoded as $key => $season) {
						include (sohohotel_booking_BASE_DIR . "/includes/templates/admin/seasonal_price_filter.htm.php");
					}
				}

				echo '</div>
				<button class="add-seasonal-filter button-primary" type="button">Add Seasonal Price Filter</button>
				<textarea class="qns-hidden-data price_filter_data_' . $id . '" name="_accommodation_meta[general_price_rules_' . $id . ']">' . $data . '</textarea>';
		}
		
	return ob_get_clean();
	
}



/* --------------------------------------------------------------------------------

   Calculate number of nights in a booking

-------------------------------------------------------------------------------- */
function sh_get_booking_nights($check_in,$check_out) {
	
	$check_in = strtotime($check_in);
	$check_out = strtotime($check_out);
	$num_nights = $check_out - $check_in;
	return floor($num_nights/(60*60*24));
	
}



/* --------------------------------------------------------------------------------

   Get date range array

-------------------------------------------------------------------------------- */
function sh_get_date_range_array($date_from,$date_to) {
	
	// Dates must be formatted YYYY-MM-DD
	
	$aryRange=array();
	
	$idate_from=mktime(1,0,0,substr($date_from,5,2),     substr($date_from,8,2),substr($date_from,0,4));
	$idate_to=mktime(1,0,0,substr($date_to,5,2),     substr($date_to,8,2),substr($date_to,0,4));
	
	if ($idate_to>=$idate_from) {
		array_push($aryRange,date('Y-m-d',$idate_from)); // first entry
		while ($idate_from<$idate_to) {
			$idate_from+=86400; // add 24 hours
			array_push($aryRange,date('Y-m-d',$idate_from));
		}
	}

	return $aryRange;

}



/* --------------------------------------------------------------------------------

   Get day of week based on date

-------------------------------------------------------------------------------- */
function sh_get_weekday($date) {
    return date('w', strtotime($date));
}



/* --------------------------------------------------------------------------------

   Edit room

-------------------------------------------------------------------------------- */
function sh_edit_room($room_data) {
	
	$sh_booking_data = $_SESSION['sh_booking_data'];
	$sh_booking_data["room_" . $room_data["edit_room_data"]]["room_name"] = '';
	$sh_booking_data["room_" . $room_data["edit_room_data"]]["room_id"] = '';
	$_SESSION['sh_booking_data'] = $sh_booking_data;

}



/* --------------------------------------------------------------------------------

   Get standard pricing

-------------------------------------------------------------------------------- */
function sh_get_standard_pricing($guest_num,$guest_type,$price_data,$date,$weekend_day,$seasonal,$price_scheme) {
	
	$output = '';
	$price_output = array();
	
	// Set text used in input fields
	if ( $seasonal == true ) {
		$key_title = 'season';
		$text_title = 'Seasonal';
	} else {
		$key_title = 'price';
		$text_title = 'standard';
	}
	
	// Check price scheme
	if ( $seasonal == true ) {
		$set_price_scheme = '';
		$set_price_scheme_num = '1';
	} else {
		if ( $price_scheme == 'nightly' ) {
			$set_price_scheme = '';
			$set_price_scheme_num = '1';
		} elseif ( $price_scheme == 'weekly' ) {
			$set_price_scheme = '_weekly';
			$set_price_scheme_num = '3';
		} elseif ( $price_scheme == 'monthly' ) {
			$set_price_scheme = '_monthly';
			$set_price_scheme_num = '5';
		} else {
			$set_price_scheme = '';
			$set_price_scheme_num = '1';
		}
	}
	
	// Check if seasonal pricing
	if ( $seasonal == true ) {
		
		if ( strlen($price_data["price"]["1"]["price_adult_weekdays"]) == 0 ) {
			$use_additional_price = false;
		} else {
			$use_additional_price = true;
		}
		
	} else {
		
		if ( $price_data["general_price_rules_".$set_price_scheme_num] == '{}' ) {
			$use_additional_price = false;
		} else {
			$use_additional_price = true;
		}
		
	}
	
	if ( $use_additional_price == true ) {
		
		// Check if it's a weekend night
		if ( in_array(sh_get_weekday($date), $weekend_day) ) {

			if ( $guest_num > 0 ) {
				$price_output[$date][$guest_type . '_1'] = $price_data[$key_title . "_" . $guest_type . "_weekends" . $set_price_scheme];
			}

		} else {

			if ( $guest_num > 0 ) {
				$price_output[$date][$guest_type . '_1'] = $price_data[$key_title . "_" . $guest_type . "_weekdays" . $set_price_scheme];
			}

		}
		
	} else {
		
		if ($guest_num >= 1 ) {
			foreach (range(1, $guest_num) as $r) {
				
				// Check if it's a weekend night
				if ( in_array(sh_get_weekday($date), $weekend_day) ) {

					if ( $guest_num > 0 ) {	
						$price_output[$date][$guest_type . '_' . $r] = $price_data[$key_title . "_" . $guest_type . "_weekends" . $set_price_scheme];	
					}

				} else {

					if ( $guest_num > 0 ) {
						$price_output[$date][$guest_type . '_' . $r] = $price_data[$key_title . "_" . $guest_type . "_weekdays" . $set_price_scheme];
					}

				}
				
			}	
		}
		
	}

	return $price_output;
	
}



/* --------------------------------------------------------------------------------

   Get additional pricing

-------------------------------------------------------------------------------- */
function sh_get_additional_pricing($guest_num,$guest_type,$price_data,$date,$weekend_day,$seasonal,$seasonal_key) {
	
	// $guest_type must be lowercase "adult" or "child"
	
	$output = '';
	
	$price_output = array();
	
	if ( $seasonal == true ) {
		$key_title = 'season';
		$text_title = 'Seasonal additional';
	} else {
		$key_title = 'price';
		$text_title = 'Standard additional';
	}
	
	if ( $seasonal == true ) {
		
		// Seasonal Additional Pricing
		if ($guest_num > 1 ) {
			foreach (range(1, $guest_num - 1) as $r) {
				
				if( strlen($price_data[$seasonal_key]["price"][$r]["price_" . $guest_type . "_weekdays"]) != 0 ) {
					
					// Check if it's a weekend night
					if ( in_array(sh_get_weekday($date), $weekend_day) ) {
						
						$price_output[$date][$guest_type . '_' . ($r+1)] = $price_data[$seasonal_key]["price"][$r]["price_" . $guest_type . "_weekends"];
						
					} else {
						
						$price_output[$date][$guest_type . '_' . ($r+1)] = $price_data[$seasonal_key]["price"][$r]["price_" . $guest_type . "_weekdays"];
						
					}

				} else {
					
					if( $price_data[$seasonal_key]["price"] ) {
						
						$price_data_last = $price_data[$seasonal_key]["price"];

						$last = end($price_data_last);

						// Check if it's a weekend night
						if ( in_array(sh_get_weekday($date), $weekend_day) ) {
							
							$price_output[$date][$guest_type . '_' . ($r+1)] = $last["price_" . $guest_type . "_weekends"];
							
						} else {
							
							$price_output[$date][$guest_type . '_' . ($r+1)] = $last["price_" . $guest_type . "_weekdays"];
							
						}
						
					}

				}
			}
		}
		
	} 
	
	else {
		
		// Standard Additional Pricing
		if ($guest_num > 1 ) {
			foreach (range(1, $guest_num - 1) as $r) {
				
				if( strlen($price_data[$r]["price_" . $guest_type . "_weekdays"]) != 0 ) {

					// Check if it's a weekend night
					if ( in_array(sh_get_weekday($date), $weekend_day) ) {
						
						$price_output[$date][$guest_type . '_' . ($r+1)] = $price_data[$r]["price_" . $guest_type . "_weekends"];
							
					} else {
						
						$price_output[$date][$guest_type . '_' . ($r+1)] = $price_data[$r]["price_" . $guest_type . "_weekdays"];
							
					}

				} else {

					$last = end($price_data);

					// Check if it's a weekend night
					if ( in_array(sh_get_weekday($date), $weekend_day) ) {
						
						if( strlen($last["price_" . $guest_type . "_weekends"]) != 0 ) {
							
							$price_output[$date][$guest_type . '_' . ($r+1)] = $last["price_" . $guest_type . "_weekends"];
							
						}
						
					} else {
						
						if( strlen($last["price_" . $guest_type . "_weekdays"]) != 0 ) {
							
							$price_output[$date][$guest_type . '_' . ($r+1)] = $last["price_" . $guest_type . "_weekdays"];
							
						}
			
					}

				}
			}
		}
		
	}
	
	return $price_output;
	
}



/* --------------------------------------------------------------------------------

   Display booking step 3 main content

-------------------------------------------------------------------------------- */
function sh_display_bs3_main($data) {
	
	ob_start();
	include(sohohotel_booking_BASE_DIR . '/includes/templates/booking-step3-main.htm.php');
	return ob_get_clean();
	
}



/* --------------------------------------------------------------------------------

   Display booking step 3 sidebar content

-------------------------------------------------------------------------------- */
function sh_display_bs3_sidebar($data) {
	
	ob_start();
	include(sohohotel_booking_BASE_DIR . '/includes/templates/booking-step3-sidebar.htm.php');
	return ob_get_clean();
	
}



/* --------------------------------------------------------------------------------

   Display booking step 4 main content

-------------------------------------------------------------------------------- */
function sh_display_bs4_main($data) {
	
	ob_start();
	include(sohohotel_booking_BASE_DIR . '/includes/templates/booking-step4-main.htm.php');
	return ob_get_clean();
	
}



/* --------------------------------------------------------------------------------

   Display booking step 4 sidebar content

-------------------------------------------------------------------------------- */
function sh_display_bs4_sidebar($data) {
	
	ob_start();
	include(sohohotel_booking_BASE_DIR . '/includes/templates/booking-step4-sidebar.htm.php');
	return ob_get_clean();
	
}



/* --------------------------------------------------------------------------------

   Store selected services in session

-------------------------------------------------------------------------------- */
function sh_store_services_data_temp($data) {
	
	ob_start();
	
	/*
	services
		service_1
			id
			name
			price
	*/
	
	$count = 0;
	
	$sh_booking_data = $_SESSION['sh_booking_data'];
	
	global $post;
	global $wp_query;

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
	'post_type' => 'service',
	'posts_per_page' => '9999',
	'paged' => $paged
	);
	
	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) :
		while($wp_query->have_posts()) :
			$wp_query->the_post();

				// Get service data
				$service_meta = get_post_meta($post->ID,'_service_meta',TRUE); ?>
				
				<?php if ( !empty($data["service_" . get_the_ID()]) ) {
					//$service_array[] = 'ID: ' . get_the_ID();	
					
					$count++;
					
					// id
					$sh_booking_data["services"]["service_" . $count]["service_id"] = get_the_ID();
					
					// name
					$sh_booking_data["services"]["service_" . $count]["service_name"] = get_the_title();
					
					// price
					$sh_booking_data["services"]["service_" . $count]["service_price"] = sh_get_service_price( get_the_ID() );
					
				} ?>

		<?php endwhile;
		endif;
	wp_reset_query();
	
	$_SESSION['sh_booking_data'] = $sh_booking_data;
	
	return ob_get_clean();
	
}



/* --------------------------------------------------------------------------------

   Get service price

-------------------------------------------------------------------------------- */
function sh_get_service_price($id) {
	
	global $post;
	global $wp_query;
	
	/*
	
	$service_meta['price_scheme_1']
	
	flatfee
	perroom
	perperson
	
	$service_meta['price_scheme_2']
	
	pernight
	perbooking
	
	*/
	
	$sh_booking_data = $_SESSION['sh_booking_data'];
	
	$count_guests = array();

	// Get service data
	$service_meta = get_post_meta($id,'_service_meta',TRUE);
	
	// Calculate price scheme 1
	
	// Price per room
	if ( $service_meta['price_scheme_1'] == 'perroom' ) {
		
		$price_1 = $service_meta['price'] * $sh_booking_data["book_room"];
	
	// Price per person
	} elseif ( $service_meta['price_scheme_1'] == 'perperson' ) {
	
		foreach (range(1, $sh_booking_data["book_room"]) as $r) {
			$count_guests[] = $sh_booking_data["room_" . $r ]["adults"];
			$count_guests[] = $sh_booking_data["room_" . $r ]["children"];
		}
		
		$price_1 = $service_meta['price'] * array_sum($count_guests);
	
	// Flat fee
	} else {
		
		$price_1 = $service_meta['price'];
		
	}
	
	// Calculate price scheme 2
	
	// Price per night
	if ( $service_meta['price_scheme_2'] == 'pernight' ) {
		
		$price_2 = $price_1 * sh_get_booking_nights($sh_booking_data["check_in"],$sh_booking_data["check_out"]);
		
	// Price per booking
	} else {
		
		$price_2 = $price_1;
		
	}
	
	return $price_2;
	
}



/* --------------------------------------------------------------------------------

   Store room prices in a session

-------------------------------------------------------------------------------- */
function sh_store_room_prices_temp() {
	
	global $sohohotel_data;

	$sh_booking_data = $_SESSION['sh_booking_data'];

	$total_price_array = array();

	foreach (range(1, $sh_booking_data["book_room"]) as $r) {

		if ( $sh_booking_data["room_" . $r] != '' or $r == '1' && sh_get_current_room() == '1') {

			if( $sh_booking_data["room_" . $r ]["room_id"] != '' ) {

				$total_price_array["room_" . $r] = sh_get_price_breakdown_room($sh_booking_data["check_in"],$sh_booking_data["check_out"],$sh_booking_data["room_" . $r ]["adults"],$sh_booking_data["room_" . $r ]["children"],$sh_booking_data["room_" . $r ]["room_id"]);
				
				$sh_booking_data["room_" . $r]["room_price"] = $total_price_array["room_" . $r]["Total"];

			}

		}

	}
	
	$_SESSION['sh_booking_data'] = $sh_booking_data;
	
}



/* --------------------------------------------------------------------------------

   Store selected coupons in session

-------------------------------------------------------------------------------- */
function sh_store_coupon_temp($coupon_code) {
	
	$sh_booking_data = $_SESSION['sh_booking_data'];
	
	$discount_array = array();
	
	global $post;
	global $wp_query;

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
	'post_type' => 'coupon',
	'posts_per_page' => '9999',
	'paged' => $paged
	);
	
	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) :
		while($wp_query->have_posts()) :
			$wp_query->the_post();

				// Get coupon data
				$coupon_meta = get_post_meta($post->ID,'_coupon_meta',TRUE);
				
				// If coupon code entered matches coupon code in the system
				if ( $coupon_code == $coupon_meta["coupon_code"] ) {
					
					$discount_array["coupon_code"] = $coupon_code;
					$discount_array["type"] = $coupon_meta["coupon_discount_type"];
					$discount_array["amount_flat"] = $coupon_meta["amount_flat"];
					$discount_array["amount_percentage"] = $coupon_meta["amount_percentage"];
					$discount_array["amount_duration_1"] = $coupon_meta["amount_duration_1"];
					$discount_array["amount_duration_2"] = $coupon_meta["amount_duration_2"];
					
				} ?>

		<?php endwhile;
		endif;
	wp_reset_query();
	
	return $discount_array;
	
}



/* --------------------------------------------------------------------------------

   Store booking in database

-------------------------------------------------------------------------------- */
function sh_store_booking_db($data_post,$data_session,$data_ical) {
	
	global $sohohotel_data;
	
	if ( $data_post["payment_method"] == 'cash' ) {
		$payment_method = __('Pay on Arrival','sohohotel_booking');
	} elseif ( $data_post["payment_method"] == 'paypal' ) {
		$payment_method = __('PayPal','sohohotel_booking');
	} elseif ( $data_post["payment_method"] == 'stripe' ) {
		$payment_method = __('Credit Card','sohohotel_booking');
	} else {
		$payment_method = '';
	}
	
	$amount_paid = '0.00';
	$outstanding_amount = $data_session["total_booking_price"];
	
	// Create JSON object for room data
	$json_output = '';
	$json_output .= '{';
	foreach (range(1, $data_session["book_room"]) as $r) {
		if ( $r != $data_session["book_room"] ) {
			$json_output .= '"Room ' . $r . '":{"check_in":"' . $data_session["check_in"] . '","check_out":"' . $data_session["check_out"] . '","room_type":"' . $data_session["room_" . $r]["room_id"] . '","adults":"' . $data_session["room_" . $r]["adults"] . '","children":"' . $data_session["room_" . $r]["children"] . '"},';
		} else {	
			$json_output .= '"Room ' . $r . '":{"check_in":"' . $data_session["check_in"] . '","check_out":"' . $data_session["check_out"] . '","room_type":"' . $data_session["room_" . $r]["room_id"] . '","adults":"' . $data_session["room_" . $r]["adults"] . '","children":"' . $data_session["room_" . $r]["children"] . '"}';	
		}
	}
	$json_output .= '}';
	
	// Create array
	$booking_meta = array();
	
	// Save check in and check out dates
	$booking_meta["check_in"] = $data_session["check_in"];
	$booking_meta["check_out"] = $data_session["check_out"];
	
	// Save services
	if ( $data_session["services"] ) {
		foreach ( $data_session["services"] as $key => $val ) {		
			$booking_meta["service_" . $val["service_id"]] = 'true';	
		}
	}
	
	// Save custom form fields
	foreach ( $data_post["_booking_meta"] as $key => $val ) {		
		$booking_meta[$key] = $val;	
	}
	
	$booking_meta["payment_method"] = $payment_method;
	$booking_meta["amount_paid"] = $amount_paid;
	
	// If booking is imported from iCal
	if($data_ical) {
		
		$booking_meta["ical_data"] = $data_ical;
		$booking_meta["feed_url"] = $data_session["feed_url"];
		
		if ( !empty($data_session["ical_unavailable"]) ) {
			$booking_title = esc_html__('[iCal][Booking Conflict][' . sh_display_formatted_date($data_session["check_in"]) . ' - ' . sh_display_formatted_date($data_session["check_out"]) . ']', 'sohohotel_booking');
		} else {
			$booking_title = esc_html__('[iCal][' . sh_display_formatted_date($data_session["check_in"]) . ' - ' . sh_display_formatted_date($data_session["check_out"]) . ']', 'sohohotel_booking');
		}
		
		$booking_meta["booking_status"] = '2';
	
	// Else regular booking
	} else {
		$booking_title = esc_html__($booking_meta["first_name"] . ' ' . $booking_meta["last_name"] . ' [' . sh_display_formatted_date($data_session["check_in"]) . ' - ' . sh_display_formatted_date($data_session["check_out"]) . ']', 'sohohotel_booking');
		
		// Save other form fields
		if ( $data_post["payment_method"] == 'cash' ) {
			
			if ( $sohohotel_data["manually_confirm_bookings"] == '1' ) {
				$booking_meta["booking_status"] = '1';
			} else {
				$booking_meta["booking_status"] = '2';
			}
			
		} else {
			$booking_meta["booking_status"] = '1';
		}
		
	}
	
	$booking_meta["outstanding_amount"] = $outstanding_amount;
	$booking_meta["save_rooms"] = $json_output;
	
	// Add new post
	$post_id = wp_insert_post(array (
	   'post_type' => 'booking',
	   'post_title' => $booking_title,
	   'post_content' => '',
	   'post_status' => 'publish',
	   'comment_status' => 'closed',
	   'ping_status' => 'closed',
	));

	// Save custom fields
	if ($post_id) {
	   add_post_meta($post_id, '_booking_meta', $booking_meta, true);
	}

	return $post_id;
	
}



/* --------------------------------------------------------------------------------

   Send booking emails

-------------------------------------------------------------------------------- */
function sh_send_booking_emails($booking_id) {
	
	global $sohohotel_data;
	
	// Query bookings
	$args_booking = array('post_type' => 'booking','posts_per_page' => '99999','p' => $booking_id);
	$wp_query_booking = new WP_Query( $args_booking );
	if ($wp_query_booking->have_posts()) : while($wp_query_booking->have_posts()) :
		$wp_query_booking->the_post(); 
		
		$booking_meta = get_post_meta( get_the_ID(), '_booking_meta', true );
		
		// Booking Details
		$email_content .= '<h3>' . esc_html__('Booking Details', 'sohohotel_booking') . '</h3>';
		$email_content .= '<ul>';
		$email_content .= '<li>' . esc_html__('Booking ID', 'sohohotel_booking') . ': #' . $booking_id . '</li>';
		$email_content .= '<li>' . esc_html__('Check In', 'sohohotel_booking') . ': ' . sh_display_formatted_date($booking_meta["check_in"]) . '</li>';
		$email_content .= '<li>' . esc_html__('Check Out', 'sohohotel_booking') . ': ' . sh_display_formatted_date($booking_meta["check_out"]) . '</li>';
		$email_content .= '</ul>';
		
		// Room Details
		if( !empty($booking_meta['save_rooms']) ) {
			
			$json_data = $booking_meta['save_rooms'];
			$data = json_decode($json_data, true);
			
			$i = 0;
			
			foreach($data as $key => $val) {
				
				$i++;
				
				$email_content .= '<h3>' . esc_html__('Room', 'sohohotel_booking') . ' ' . $i . '</h3>';
				$email_content .= '<ul>';
				$email_content .= '<li>' . esc_html__('Room Name', 'sohohotel_booking') . ': ' . get_the_title($val["room_type"]) . '</li>';
				$email_content .= '<li>' . esc_html__('Adults', 'sohohotel_booking') . ': ' . $val["adults"] . '</li>';

				if ( $val["children"] > 0 ) {
					$email_content .= '<li>' . esc_html__('Children', 'sohohotel_booking') . ': ' . $val["children"] . '</li>';
				}

				$email_content .= '</ul>';
			
			}
			
		}
		
		// Service Details
		$args_service = array(
		'post_type' => 'service',
		'posts_per_page' => '9999'
		);

		$wp_query_service = new WP_Query( $args_service );
		if ($wp_query_service->have_posts()) :
			$email_content .= '<h3>' . esc_html__('Services', 'sohohotel_booking') . '</h3>';	
			$email_content .= '<ul>';
			while($wp_query_service->have_posts()) :
				$wp_query_service->the_post();
					$service_meta = get_post_meta(get_the_ID(),'_service_meta',TRUE);
			 		if( !empty($booking_meta['service_' . get_the_ID()]) ) {
						$email_content .= '<li>' . get_the_title() . '</li>';
					}
			endwhile;
			$email_content .= '</ul>';
		endif;
		wp_reset_query();
		
		// Guest Details
		$email_content .= '<h3>' . esc_html__('Guest Details', 'sohohotel_booking') . '</h3>';
		$email_content .= '<ul>';		
		$email_content .=  sh_get_guest_info($sohohotel_data['custom_booking_form'],$booking_meta);
		$email_content .= '</ul>';
		
		// Payment Details
		$email_content .= '<h3>' . esc_html__('Payment Details', 'sohohotel_booking') . '</h3>';
		$email_content .= '<ul>';		
		$email_content .= '<li>' . esc_html__('Payment Method', 'sohohotel_booking') . ': ' . $booking_meta['payment_method'] . '</li>';
		$email_content .= '<li>' . esc_html__('Amount Paid', 'sohohotel_booking') . ': ' . sh_get_price_no_format($booking_meta["amount_paid"]) . '</li>';
		$email_content .= '<li>' . esc_html__('Amount Due', 'sohohotel_booking') . ': ' . sh_get_price_no_format($booking_meta["outstanding_amount"]) . '</li>';
		$email_content .= '</ul>';

	endwhile;endif;
	wp_reset_query();
	
	// Guest Email
	$guest_recipient_email = $booking_meta["email_address"];
	$guest_email_subject = $sohohotel_data["booking_email_subject_guest"] . ' - ' . $booking_meta["first_name"] . ' ' . $booking_meta["last_name"] . ' (#' . $booking_id . ')';
	$guest_email_body = $sohohotel_data["booking_email_content_guest"];
	$guest_email_body .= $email_content;
	
	// Admin Email
	$admin_recipient_email = $sohohotel_data["booking-email"];
	$admin_email_subject = $sohohotel_data["booking_email_subject_admin"] . ' - ' . $booking_meta["first_name"] . ' ' . $booking_meta["last_name"] . ' (#' . $booking_id . ')';
	$admin_email_body = $sohohotel_data["booking_email_content_admin"];
	$admin_email_body .= $email_content;
	
	// Admin Email Headers
	$admin_email_headers = "MIME-Version: 1.0\r\n";
	$admin_email_headers .= "Content-type: text/html; charset=UTF-8\r\n";
	$admin_email_headers .= "From: " . esc_attr($sohohotel_data["email-sender-name"]) . " <" . esc_attr($sohohotel_data["booking-email"]) . ">" . "\r\n" . "Reply-To: " . esc_attr($sohohotel_data["email-sender-name"]);
	
	// Guest Email Headers
	$guest_email_headers = "MIME-Version: 1.0\r\n";
	$guest_email_headers .= "Content-type: text/html; charset=UTF-8\r\n";
	$guest_email_headers .= "From: " . esc_attr($sohohotel_data["email-sender-name"]) . " <" . esc_attr($sohohotel_data["booking-email"]) . ">" . "\r\n" . "Reply-To: " . esc_attr($sohohotel_data["booking-email"]);
	
	// Set booking status to confirmed
	global $post;
	global $wp_query;
	$booking_update_data = get_post_meta($booking_id, '_booking_meta',TRUE);
	
	if ( $sohohotel_data["manually_confirm_bookings"] == '1' ) {
		$booking_update_data["booking_status"] = '1';
	} else {
		$booking_update_data["booking_status"] = '2';
	}

	update_post_meta($booking_id, '_booking_meta', $booking_update_data);

	// Admin Send Email
	wp_mail($admin_recipient_email,$admin_email_subject,$admin_email_body,$admin_email_headers);
	
	// Guest Send Email
	wp_mail($guest_recipient_email,$guest_email_subject,$guest_email_body,$guest_email_headers);
	
}



/* --------------------------------------------------------------------------------

   PayPal payment form

-------------------------------------------------------------------------------- */
function sh_payment_form($data) {

	global $sohohotel_data;
	
	if ($sohohotel_data['paypal-sandbox'] == 'true') {
		define('SSL_P_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
		define('SSL_SAND_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
	} else {
		define('SSL_P_URL', 'https://www.paypal.com/cgi-bin/webscr');
		define('SSL_SAND_URL', 'https://www.paypal.com/cgi-bin/webscr');
	}
	
	$action = '';
	// Is this a test transaction? 
	$action = ($data['paypal_mode']) ? SSL_SAND_URL : SSL_URL;
	
	$paypal_amount = str_replace( ',', '', $data['amount'] );
	
	$form = '';
	$form .= '<form name="frm_payment_method" action="' . $action . '" method="post">';
	$form .= '<input type="hidden" name="business" value="' . $data['merchant_email'] . '" />';
	// Instant Payment Notification & Return Page Details /
	$form .= '<input type="hidden" name="notify_url" value="' . $data['notify_url'] . '" />';
	$form .= '<input type="hidden" name="cancel_return" value="' . $data['cancel_url'] . '" />';
	$form .= '<input type="hidden" name="return" value="' . $data['thanks_page'] . '" />';
	$form .= '<input type="hidden" name="rm" value="2" />';
	// Configures Basic Checkout Fields -->
	$form .= '<input type="hidden" name="lc" value="" />';
	$form .= '<input type="hidden" name="no_shipping" value="1" />';
	$form .= '<input type="hidden" name="no_note" value="1" />';
	// <input type="hidden" name="custom" value="localhost" />-->
	$form .= '<input type="hidden" name="currency_code" value="' . $data['currency_code'] . '" />';
	$form .= '<input type="hidden" name="page_style" value="paypal" />';
	$form .= '<input type="hidden" name="charset" value="utf-8" />';
	$form .= '<input type="hidden" name="item_name" value="' . $data['product_name'] . '" />';
	$form .= '<input type="hidden" name="item_number" value="' . $data['item_number'] . '" />';
	$form .= '<input type="hidden" value="_xclick" name="cmd"/>';
	$form .= '<input type="hidden" name="amount" value="' . $paypal_amount . '" />';
			
	$form .= '</form>';
	$form .= '<script>';
	$form .= 'setTimeout("document.frm_payment_method.submit()", 0);';
	$form .= '</script>';
	return $form;
	
}



/* ----------------------------------------------------------------------------

   PayPal IPN

---------------------------------------------------------------------------- */
class PayPal_IPN{
	
	function payment_ipn($im_debut_ipn) {
		
		global $sohohotel_data;
		
		if ($sohohotel_data['paypal-sandbox'] == 'true') {
			define('SSL_P_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
			define('SSL_SAND_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
		} else {
			define('SSL_P_URL', 'https://www.paypal.com/cgi-bin/webscr');
			define('SSL_SAND_URL', 'https://www.paypal.com/cgi-bin/webscr');
		}
		
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		if (!preg_match('/paypal\.com$/', $hostname)) {
			
			$ipn_status = 'Validation post isn\'t from PayPal';
			if ($im_debut_ipn == true) {
				// mail test
			}
			return false;
		
		}
		
		// parse the paypal URL
		$paypal_url = ($_REQUEST['test_ipn'] == 1) ? SSL_SAND_URL : SSL_P_URL;
		$url_parsed = parse_url($paypal_url);
		
		$post_string = '';
		foreach ($_REQUEST as $field => $value) {
			$post_string .= $field . '=' . urlencode(stripslashes($value)) . '&';
		}
		$post_string.="cmd=_notify-validate"; // append ipn command
		// get the correct paypal url to post request to
		$paypal_mode_status = $im_debut_ipn; //get_option('im_sabdbox_mode');
		if ($sohohotel_data['paypal-sandbox'] == 'true')
			$fp = fsockopen('ssl://www.sandbox.paypal.com', "443", $err_num, $err_str, 60);
		else
			$fp = fsockopen('ssl://www.paypal.com', "443", $err_num, $err_str, 60);
		
		$ipn_response = '';
		
		if (!$fp) {
			// could not open the connection.  If loggin is on, the error message
			// will be in the log.
			$ipn_status = "fsockopen error no. $err_num: $err_str";
			if ($im_debut_ipn == true) {
				echo 'fsockopen fail';
			}
			return false;
		} else {
			// Post the data back to paypal
			fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n");
			fputs($fp, "Host: $url_parsed[host]\r\n");
			fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
			fputs($fp, "Content-length: " . strlen($post_string) . "\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
			fputs($fp, $post_string . "\r\n\r\n");

			// loop through the response from the server and append to variable
			while (!feof($fp)) {
				$ipn_response .= fgets($fp, 1024);
			}
			fclose($fp); // close connection
		}
		
		// Invalid IPN transaction.  Check the $ipn_status and log for details.
		if (!preg_match("/VERIFIED/s", $ipn_response)) {
			$ipn_status = 'IPN Validation Failed';
			if ($im_debut_ipn == true) {
				echo 'Validation fail';
				print_r($_REQUEST);
			}
			return false;
		} else {
			$ipn_status = "IPN VERIFIED";
			if ($im_debut_ipn == true) {
				echo 'SUCCESS';
			}
			return true;
		}
		
	}
	
	function ipn_response($request) {
		
		$im_debut_ipn=true;
		if ($this->payment_ipn($im_debut_ipn)) {
			
			// if paypal sends a response code back let's handle it        
			if ($im_debut_ipn == true) {
				$sub = 'PayPal IPN Debug Email Main';
				$msg = print_r($request, true);
				$aname = 'Soho Hotel';
				//mail send
			}
			
			$this->insert_data($request);
		}
	}
	
	function issetCheck($post,$key) {
		
		if(isset($post[$key])){
			$return=$post[$key];
		} else {
			$return='';
		}
		return $return;
	
	}
	
	function insert_data($request) {
		
		global $sohohotel_data;
		
		$post=$request;
		$item_name=$this->issetCheck($post,'item_name');
		$item_number=$this->issetCheck($post,'item_number');
		$amount=$this->issetCheck($post,'mc_gross');
		$currency=$this->issetCheck($post,'mc_currency');
		$payer_email=$this->issetCheck($post,'payer_email');
		$first_name=$this->issetCheck($post,'first_name');
		$last_name=$this->issetCheck($post,'last_name');
		$country=$this->issetCheck($post,'residence_country');
		$txn_id=$this->issetCheck($post,'txn_id');
		$txn_type=$this->issetCheck($post,'txn_type');
		$payment_status=$this->issetCheck($post,'payment_status');
		$payment_type=$this->issetCheck($post,'payment_type');
		$payer_id=$this->issetCheck($post,'payer_id');
		$create_date=date('Y-m-d H:i:s');
		$payment_date=date('Y-m-d H:i:s');
		
		$email_content = '';
		$email_content .= $sohohotel_data["payment_success_message"];
		$email_content .= '<h3>' . esc_html__('Payment Details', 'sohohotel_booking') . '</h3>';
		$email_content .= '<ul>';
		$email_content .= '<li>' . esc_html__('Amount Paid', 'sohohotel_booking') . ': ' . $amount . ' (' . $currency . ')</li>';
		$email_content .= '<li>' . esc_html__('Payment Date', 'sohohotel_booking') . ': ' . $payment_date . '</li>';
		$email_content .= '</ul>';

		$admin_email_headers = "MIME-Version: 1.0\r\n";
		$admin_email_headers .= "Content-type: text/html; charset=UTF-8\r\n";
		$admin_email_headers .= "From: " . $sohohotel_data['booking-email'] . " <" . $sohohotel_data['booking-email'] . ">" . "\r\n" . "Reply-To: " . $sohohotel_data['booking-email'];
		
		//wp_mail($payer_email,esc_html__('PayPal Payment Details', 'sohohotel_booking'),$email_content,$admin_email_headers);
		
		global $post;
		global $wp_query;

		$update_data = get_post_meta($item_number, '_booking_meta',TRUE);
		$amount_due = $update_data["outstanding_amount"];

		$update_data["amount_paid"] = $amount;
		$update_data["outstanding_amount"] = $amount_due - $amount;

		update_post_meta($item_number, '_booking_meta', $update_data);
		update_post_meta($item_number, '_booking_meta', $update_data);
		
		// Send Booking Email
		sh_send_booking_emails($item_number);
		
	}

}



/* ----------------------------------------------------------------------------

   Display the date in the correct format

---------------------------------------------------------------------------- */
function sh_display_formatted_date($date) {
	
	global $sohohotel_data;
	
	if ( $sohohotel_data["date_format"] == 'dd/mm/yy' ) {
		$formatted_date = date('d/m/Y', strtotime($date));
	} elseif ( $sohohotel_data["date_format"] == 'mm/dd/yy' ) {
		$formatted_date = date('m/d/Y', strtotime($date));
	} elseif ( $sohohotel_data["date_format"] == 'yy/mm/dd' ) {
		$formatted_date = date('Y/m/d', strtotime($date));
	} elseif ( $sohohotel_data["date_format"] == 'dd.mm.yy' ) {
		$formatted_date = date('d.m.Y', strtotime($date));
	} elseif ( $sohohotel_data["date_format"] == 'mm.dd.yy' ) {
		$formatted_date = date('m.d.Y', strtotime($date));
	} elseif ( $sohohotel_data["date_format"] == 'yy.mm.dd' ) {
		$formatted_date = date('Y.m.d', strtotime($date));
	} else {
		$formatted_date = date('d/m/Y', strtotime($date));
	}
	
	return $formatted_date;
}



/* ----------------------------------------------------------------------------

   Calculates Difference Between Days

---------------------------------------------------------------------------- */
function sohohotel_diff_days($start_input,$end_input) {
	
	$start = strtotime( $start_input );
	$end = strtotime( $end_input );
	$days_between = ceil(abs($end - $start) / 86400);
	
	return $days_between;
	
}



/* ----------------------------------------------------------------------------

   Stripe Payment

---------------------------------------------------------------------------- */
function sohohotel_stripe_payment($data) {
	
	global $sohohotel_data;
	
	// Begin price security check
	if ( !empty($sohohotel_data['price_decimal_places']) ) {
		$number_decimals = $sohohotel_data['price_decimal_places'];
	} else {
		$number_decimals = '2';
	}
	
	if ($number_decimals == 'zero') {
		$stripe_price = $_SESSION['sh_booking_data']['total_booking_deposit_price'];
		$price_check_1 = str_replace(",","",$stripe_price);
		$price_check_2 = str_replace(",","",$data["price"]);
	} else {
		$stripe_price = $_SESSION['sh_booking_data']['total_booking_deposit_price'];	
		$price_check_1 = str_replace(",","",$stripe_price);
		$price_check_2 = str_replace(",","",$data["price"]);
	}
	
	if ( !empty($price_check_2) && $price_check_2 != $price_check_1 ) {
		exit();
	}
	// End price security check
	
	if ( !empty($sohohotel_data["stripe-currency"]) ) {
		$stripe_currency = $sohohotel_data["stripe-currency"];
	} else {
		$stripe_currency = 'USD';
	}
	
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
	}

	if(isset($_POST['stripeToken']))
	{
		
		if ( $stripe_currency == 'JPY' ) {
			$amount_cents = $data["price"];
		} else {
			$amount_cents = ($data["price"] * 100);
		}
		
		$amount_cents = str_replace(".","",$amount_cents);  // Chargeble amount
		$invoiceid = $data["booking_id"];                  // Invoice ID
		$description = esc_html__('Invoice', 'sohohotel_booking') . ' #' . $invoiceid;
		
		try {

			$charge = Stripe_Charge::create(array(		 
				  "amount" => $amount_cents,
				  "currency" => $stripe_currency,
				  "source" => $_POST['stripeToken'],
				  "description" => $description)			  
			);

			if ($charge->card->address_zip_check == "fail") {
				throw new Exception("zip_check_invalid");
			} else if ($charge->card->address_line1_check == "fail") {
				throw new Exception("address_check_invalid");
			} else if ($charge->card->cvc_check == "fail") {
				throw new Exception("cvc_check_invalid");
			}
			// Payment has succeeded, no exceptions were thrown or otherwise caught				

			$result = "success";

		} catch(Stripe_CardError $e) {			

		$error = $e->getMessage();
			$result = "declined";

		} catch (Stripe_InvalidRequestError $e) {
			$result = "declined";		  
		} catch (Stripe_AuthenticationError $e) {
			$result = "declined";
		} catch (Stripe_ApiConnectionError $e) {
			$result = "declined";
		} catch (Stripe_Error $e) {
			$result = "declined";
		} catch (Exception $e) {

			if ($e->getMessage() == "zip_check_invalid") {
				$result = "declined";
			} else if ($e->getMessage() == "address_check_invalid") {
				$result = "declined";
			} else if ($e->getMessage() == "cvc_check_invalid") {
				$result = "declined";
			} else {
				$result = "declined";
			}		  
		}
		
		// If payment is successful add details in database
		if ( $result == 'success' ) {
			
			$data_array = array();
			$data_array["booking_id"] = $data["booking_id"];
			$data_array["payment_status"] = $result;
			
			// Update booking data
			global $post;
			global $wp_query;
			
			$update_data = get_post_meta($data["booking_id"], '_booking_meta',TRUE);
			$amount_due = $update_data["outstanding_amount"];
			
			// Convert price back to dollar amount from cents by dividing by 100
			$update_data["amount_paid"] = $data["price"];
			$update_data["outstanding_amount"] = $amount_due - $data["price"];
			$update_data["payment_method"] = esc_html__('Credit Card', 'sohohotel_booking');
			
			update_post_meta($data["booking_id"], '_booking_meta', $update_data);
			update_post_meta($data["booking_id"], '_booking_meta', $update_data);
			
			// Send Booking Email
			sh_send_booking_emails($data_array["booking_id"]);
			
			return $data_array;
			
		} else {
			
			return $result;
			
		}
		
	}
	
}



/* ----------------------------------------------------------------------------

   Get blocked date IDs

---------------------------------------------------------------------------- */
function sh_get_blocked_date_ids($from,$to) {
	
	global $post;
	global $wp_query;
	
	$dates_blocked = false;
	$booked_room_ids = array();
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
	'post_type' => 'blocked_dates',
	'posts_per_page' => '9999',
	'paged' => $paged
	);
	
	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) :
		while($wp_query->have_posts()) :
			$wp_query->the_post();

				// Get blocked dates data
				$blocked_dates_meta = get_post_meta($post->ID,'_blocked_dates_meta',TRUE);
				
				if(!empty($blocked_dates_meta["weekday_mon"])) {
					$blocked_mon = '1';
				} else {
					$blocked_mon = '0';
				}
				
				if(!empty($blocked_dates_meta["weekday_tue"])) {
					$blocked_tue = '1';
				} else {
					$blocked_tue = '0';
				}
				
				if(!empty($blocked_dates_meta["weekday_wed"])) {
					$blocked_wed = '1';
				} else {
					$blocked_wed = '0';
				}
				
				if(!empty($blocked_dates_meta["weekday_thu"])) {
					$blocked_thu = '1';
				} else {
					$blocked_thu = '0';
				}
				
				if(!empty($blocked_dates_meta["weekday_fri"])) {
					$blocked_fri = '1';
				} else {
					$blocked_fri = '0';
				}
				
				if(!empty($blocked_dates_meta["weekday_sat"])) {
					$blocked_sat = '1';
				} else {
					$blocked_sat = '0';
				}
				
				if(!empty($blocked_dates_meta["weekday_sun"])) {
					$blocked_sun = '1';
				} else {
					$blocked_sun = '0';
				}
				
				// Dates within blocked date range
				if ( sh_get_date_range_overlap($from,date('Y-m-d', strtotime($to . ' -1 day')),$blocked_dates_meta["from"],date('Y-m-d', strtotime($blocked_dates_meta["to"] . ' -1 day'))) == true ) {
					
					// Check if blocked day occurs in requested booking dates
					foreach( sh_get_date_range_array($from,date('Y-m-d', strtotime($to . ' -1 day'))) as $date_key => $date) {
						
						if (sh_get_weekday($date) == '1' && $blocked_mon == '1') {
							$dates_blocked = true;
						}
						
						if (sh_get_weekday($date) == '2' && $blocked_tue == '1') {
							$dates_blocked = true;
						}
						
						if (sh_get_weekday($date) == '3' && $blocked_wed == '1') {
							$dates_blocked = true;
						}
						
						if (sh_get_weekday($date) == '4' && $blocked_thu == '1') {
							$dates_blocked = true;
						}
						
						if (sh_get_weekday($date) == '5' && $blocked_fri == '1') {
							$dates_blocked = true;
						}
						
						if (sh_get_weekday($date) == '6' && $blocked_sat == '1') {
							$dates_blocked = true;
						}
						
						if (sh_get_weekday($date) == '0' && $blocked_sun == '1') {
							$dates_blocked = true;
						}
						
					}
					
					if ($dates_blocked == true) {
						$booked_room_ids[] = $blocked_dates_meta["room_type"];
					}
					
					$dates_blocked == false;
					
				} ?>

		<?php endwhile;
		endif;
	wp_reset_query();
	
	return $booked_room_ids;
	
}



/* ----------------------------------------------------------------------------

   Get all room IDs

---------------------------------------------------------------------------- */
function sh_get_all_room_ids() {
	
	$room_id_array = array();
	
	$args = array(
		'post_type' => 'accommodation',
		'posts_per_page' => '9999'
	);

	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) :
		while($wp_query->have_posts()) :
			$wp_query->the_post(); 

			$room_id_array[] = get_the_ID();
	 	
		endwhile;
	endif;
	wp_reset_query();
	
	return $room_id_array;
	
}



/* ----------------------------------------------------------------------------

   Check if two arrays match

---------------------------------------------------------------------------- */
function sh_array_match($a1,$a2) {
	
	$result=array_diff($a1,$a2);
	
	if ( empty($result) ) {
		// arrays match
		return true;
	} else {
		// arrays do not match
		return false;
	}
	
}



/* ----------------------------------------------------------------------------

   Frontend availability calendar

---------------------------------------------------------------------------- */
function sh_frontend_availability_calendar($room_id,$m,$y) {
	
	ob_start();
	
	if ( empty($room_id) ) {
		$check_room = 'all';
	} elseif ( $room_id == 'all' ) {
		$check_room = 'all';
	} else {
		$check_room = $room_id;
	}
	
	// Get all room ids
	$sh_get_all_room_ids = sh_get_all_room_ids();

	// Get month
	if( isset($m) ) {
		
		if ( (1 <= $m) && ($m <= 12) ) {
			$month = $m;
		} else {
			$month = date('m');
		}
		
	} else {
		$month = date('m');
	}
	
	// Get year
	if( isset($y) ) {
		
		if ( (1970 <= $y) && ($y <= 3000) ) {
			$year = $y;
		} else {
			$year = date('Y');
		}
		
	} else {
		$year = date('Y');
	}
	
	// Set month title
	if ($month == 1) {
		$month_title = esc_html__( 'Jan', 'sohohotel_booking' );
	} elseif ($month == 2) {
		$month_title = esc_html__( 'Feb', 'sohohotel_booking' );
	} elseif ($month == 3) {
		$month_title = esc_html__( 'Mar', 'sohohotel_booking' );
	} elseif ($month == 4) {
		$month_title = esc_html__( 'Apr', 'sohohotel_booking' );
	} elseif ($month == 5) {
		$month_title = esc_html__( 'May', 'sohohotel_booking' );
	} elseif ($month == 6) {
		$month_title = esc_html__( 'Jun', 'sohohotel_booking' );
	} elseif ($month == 7) {
		$month_title = esc_html__( 'Jul', 'sohohotel_booking' );
	} elseif ($month == 8) {
		$month_title = esc_html__( 'Aug', 'sohohotel_booking' );
	} elseif ($month == 9) {
		$month_title = esc_html__( 'Sep', 'sohohotel_booking' );
	} elseif ($month == 10) {
		$month_title = esc_html__( 'Oct', 'sohohotel_booking' );
	} elseif ($month == 11) {
		$month_title = esc_html__( 'Nov', 'sohohotel_booking' );
	} elseif ($month == 12) {
		$month_title = esc_html__( 'Dec', 'sohohotel_booking' );
	}
	
	// Create array for dates
	$list = array();
	
	// Store dates for current month in array
	for($d=1; $d<=31; $d++) {
	    $time=mktime(12, 0, 0, $month, $d, $year);          
	    if (date('m', $time) == $month) {
			$list[] = $time;
		}
	}

	// Find total number of days in month
	$counter1 = 0;
	foreach ($list as $item) {
	    $counter1++;
	}

	// Counter for table tag formatting
	$counter2 = 0;
	
	echo '<div class="sh-availability-calendar-wrapper">';
	
	// Calendar title
	
	if ( $check_room == 'all' ) {
		echo '<h1>' . $month_title . ' ' . $year . ' <span>(' . esc_html__( 'All Rooms', 'sohohotel_booking' ) . ')</span></h1>';
	} else {
		echo '<h1>' . $month_title . ' ' . $year . ' <span>(' . get_the_title( $check_room ) . ')</span></h1>';
	}
	
	// Select month form
	echo '<form class="availability_checker_form">';
	
	echo '<button type="button" class="calendar_button_prev">&lt; ' . esc_html__( 'Prev', 'sohohotel_booking' ) . '</button>';
	echo '<button type="button" class="calendar_button_current">' . esc_html__( 'Current Month', 'sohohotel_booking' ) . '</button>';
	echo '<button type="button" class="calendar_button_next">' . esc_html__( 'Next', 'sohohotel_booking' ) . ' &gt;</button>';
	
	echo '<input type="hidden" name="month" value="' . $month . '" />';
	echo '<input type="hidden" name="year" value="' . $year . '" />';
	echo '<input type="hidden" class="sh_calendar_navigation" name="sh_calendar_navigation" value="" />';
	
	echo '<input type="hidden" class="sh_room_id" name="sh_room_id" value="' . $check_room . '" />';
	
	echo '<div class="clearfix sh_custom_dates_wrapper">';
	echo '<div class="select-wrapper"><i class="fa fa-angle-down"></i><select name="m">';
		foreach (range(1, 12) as $r) {
			if ($month == $r) {$selected = 'selected';} else {$selected = '';}
			echo '<option value="' . $r . '" ' . $selected . '>' . $r . '</option>';	
		}
	echo '</select></div>';
	echo '<div class="select-wrapper"><i class="fa fa-angle-down"></i><select name="y">';
		foreach (range( (date('Y') - 1), (date('Y') + 9) ) as $r) {
			if ($year == $r) {$selected = 'selected';} else {$selected = '';}
			echo '<option value="' . $r . '" ' . $selected . '>' . $r . '</option>';	
		}
	echo '</select></div>';
	echo '<button type="button" class="calendar_button_custom">' . esc_html__( 'Check Availability', 'sohohotel_booking' ) . '</button>';
	echo '</div>';
	
	echo '<input type="hidden" name="action" value="sh_availability_calendar_action" />';
	echo wp_nonce_field('ajax_sh_availability_calendar', '_acf_nonce', true, false);
	
	echo '</form>';
	
	// Display calendar
	echo '<table class="sh_availability_calendar" style="width:100%" border="1">';
	
	$days_of_week = array_slice($list, 0, 7);

	foreach( $days_of_week as $key => $val) {
		echo '<th>' . date_i18n('D', $val) . '</th>';
	}

	foreach( $list as $key => $val) {

		$counter2++;

		if ($counter2 == 1) {echo '<tr>';}
		
		// Check availability of all rooms
		if ( $check_room == 'all' ) {
			
			if ( sh_array_match($sh_get_all_room_ids,sh_get_all_booked_room_ids(date('Y-m-d', $val),date('Y-m-d', $val),false,true)) == true ) {
				$availability_class = 'sh_cal_unavailable';
			} else {
				$availability_class = 'sh_cal_available';
			}

		// Check availability of a specific room
		} else {
			
			if (in_array($check_room, sh_get_all_booked_room_ids(date('Y-m-d', $val),date('Y-m-d', $val),false,true) )) {
			  $availability_class = 'sh_cal_unavailable';
			} else {
				$availability_class = 'sh_cal_available';
			}
			
		}

		echo '<td class="' . $availability_class . '">' . date('d', $val) . '</td>';

		if ($counter2 == $counter1) {
			echo '</tr>';
		} elseif ($counter2 % 7 == 0) {
		   echo '</tr><tr>';
		}

	}
	
	echo '</table>';
	
	echo '<div class="sh_availability_labels"><span class="sh_available_label">' . esc_html__( 'Available', 'sohohotel_booking' ) . '</span><span class="sh_unavailable_label">' . esc_html__( 'Unavailable', 'sohohotel_booking' ) . '</span></div>';
	
	echo '</div>';
	
	return ob_get_clean();
	
}



/* ----------------------------------------------------------------------------

   Frontend availability calendar AJAX callback

---------------------------------------------------------------------------- */
function ajax_sh_availability_calendar_action_callback() {
	
	$content = '';
	
	// Next and prev links
	if($month == 12) {
		$next_month = 1;
		$next_year = $year + 1;
	} else {
		$next_month = $month + 1;
		$next_year = $year;
	}
	
	if($month == 1) {
		$prev_month = 12;
		$prev_year = $year - 1;
		
	} else {
		$prev_month = $month - 1;
		$prev_year = $year;
	}
	
	if ( $_POST['sh_calendar_navigation'] == 'next' ) {
		
		if( $_POST['month'] == 12 ) {
			$month = 1;
			$year = $_POST['year'] + 1;
		} else {
			$month = $_POST['month'] + 1;
			$year = $_POST['year'];
		}
		
	} elseif ( $_POST['sh_calendar_navigation'] == 'prev' ) {
		
		if( $_POST['month'] == 1 ) {
			$month = 12;
			$year = $_POST['year'] - 1;
		} else {
			$month = $_POST['month'] - 1;
			$year = $_POST['year'];
		}
		
	} elseif ( $_POST['sh_calendar_navigation'] == 'current' ) {

		$month = date('m');
		$year = date('Y');

	} elseif ( $_POST['sh_calendar_navigation'] == 'custom' ) {
		
		$month = $_POST['m'];
		$year = $_POST['y'];
		
	} else {
			
		$month = date('m');
		$year = date('Y');
			
	}
	
	$content .= sh_frontend_availability_calendar($_POST['sh_room_id'],$month,$year);
	
	$resp = array('content' => $content);
	header( "Content-Type: application/json" );
	echo json_encode($resp);
	die();
}
add_action( 'wp_ajax_sh_availability_calendar_action', 'ajax_sh_availability_calendar_action_callback' );
add_action( 'wp_ajax_nopriv_sh_availability_calendar_action', 'ajax_sh_availability_calendar_action_callback' );



/* ----------------------------------------------------------------------------

   Get translated WPML IDs

---------------------------------------------------------------------------- */
function sh_get_translated_wpml_ids($ids,$posttype) {
	
	// If WPML is running get translated IDs
	if (class_exists('SitePress')) {

		$sh_wpml_translated_ids = array();
		foreach($ids as $key => $val) {	
			$sh_wpml_translated_ids[] = apply_filters( 'wpml_object_id', $val, $posttype );
		}
		return $sh_wpml_translated_ids;

	// If WPML is not running just return the input IDs and do nothing
	} else {
		return $ids;
	}
	
}



/* ----------------------------------------------------------------------------

   Get original WPML IDs (array)

---------------------------------------------------------------------------- */
function sh_get_original_wpml_ids($ids,$posttype) {
	
	// If WPML is running get translated IDs
	if (class_exists('SitePress')) {
		
		global $sitepress;
		
		$sh_wpml_translated_ids = array();
		foreach($ids as $key => $val) {	
			$sh_wpml_translated_ids[] = apply_filters( 'wpml_object_id', $val, $posttype, true, $sitepress->get_default_language() );
		}
		return $sh_wpml_translated_ids;

	// If WPML is not running just return the input IDs and do nothing
	} else {
		return $ids;
	}
	
}



/* ----------------------------------------------------------------------------

   Get original WPML ID (string)

---------------------------------------------------------------------------- */
function sh_get_original_wpml_id($id,$posttype) {
	
	// If WPML is running get translated IDs
	if (class_exists('SitePress')) {
		
		global $sitepress;
		return apply_filters( 'wpml_object_id', $id, $posttype, true, $sitepress->get_default_language() );

	// If WPML is not running just return the input IDs and do nothing
	} else {
		return $id;
	}
	
}



/* ----------------------------------------------------------------------------

   Get booking data in iCal file

---------------------------------------------------------------------------- */
function sh_get_ical() {
	
	if ($_GET['room_id']) {
		$room_id = $_GET['room_id'];
	} else {
		$room_id = '0';
	}
	
	header("Content-Type: text/Calendar");
	header("Content-Disposition: inline; filename=calendar.ics");
	
	echo "BEGIN:VCALENDAR\r\n";
	echo "PRODID;X-RICAL-TZSOURCE=TZINFO:-//Quite Nice Booking//Calendar//EN\r\n";
	echo "CALSCALE:GREGORIAN\r\n";
	echo "VERSION:2.0\r\n";
	
	// Begin Getting Bookings
	global $post;
	
	$args = array(
		'post_type' => 'booking',
		'posts_per_page' => '9999',
	);
	
	// Query bookings
	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) :
		while($wp_query->have_posts()) :	
			$wp_query->the_post();
	
			// Get booking data
			$booking_meta = get_post_meta($post->ID,'_booking_meta',TRUE);
			$room_booking_data = $booking_meta['save_rooms'];

			// Decode room booking data
			$room_booking_data_decoded = json_decode($room_booking_data, true);
			
			// Only export non iCal bookings
			if ( empty($booking_meta['ical_data']) && $booking_meta['booking_status'] == '2' ) {
				
				// Loop room booking data
				foreach($room_booking_data_decoded as $key => $val) {
				
					if($val['room_type'] == $room_id) {
						echo "BEGIN:VEVENT\r\n";
						echo "DTSTART;VALUE=DATE:".str_replace("-","",$val['check_in'])."\r\n";
						echo "DTEND;VALUE=DATE:".str_replace("-","",$val['check_out'])."\r\n";
						echo "UID:".str_replace("-","",$val['check_in'])."-".str_replace("-","",$val['check_out'])."-".$val['room_type']."-".$key."\r\n";
						echo 'DESCRIPTION:Check In: '.$val['check_in'].'\nCheck Out: '.$val['check_out'].'\nPhone:'.$booking_meta['telephone'].'\nEmail: '.$booking_meta['email_address'].'\nRoom: '.get_the_title($val['room_type']).'\nBooking ID: '.get_the_ID()."\r\n";
						echo "SUMMARY:".$booking_meta['first_name'] . " " . $booking_meta['last_name']." - ".get_the_title($val['room_type'])."\r\n";
						echo "LOCATION:".get_the_title($val['room_type'])."\r\n";
						echo "END:VEVENT\r\n";
					}
				
				}
				
			}
			
		endwhile;
	else :
	endif;
	
	wp_reset_query();
	// End Getting Bookings
	
	// Begin Getting Blocked Dates
	global $post;
	
	$args = array(
		'post_type' => 'blocked_dates',
		'posts_per_page' => '9999',
	);
	
	// Query bookings
	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) :
		while($wp_query->have_posts()) :	
			$wp_query->the_post();
	
			// Get booking data
			$blocked_dates_meta = get_post_meta($post->ID,'_blocked_dates_meta',TRUE);
			
			if($blocked_dates_meta['room_type'] == $room_id) {
				
				if ( $blocked_dates_meta['weekday_mon'] == '1' && $blocked_dates_meta['weekday_tue'] == '1' && $blocked_dates_meta['weekday_wed'] == '1' && $blocked_dates_meta['weekday_thu'] == '1' && $blocked_dates_meta['weekday_fri'] == '1' && $blocked_dates_meta['weekday_sat'] == '1' && $blocked_dates_meta['weekday_sun'] == '1') {

					echo "BEGIN:VEVENT\r\n";
					echo "DTSTART;VALUE=DATE:".str_replace("-","",$blocked_dates_meta['from'])."\r\n";
					echo "DTEND;VALUE=DATE:".str_replace("-","",$blocked_dates_meta['to'])."\r\n";
					echo "UID:".str_replace("-","",$blocked_dates_meta['from'])."-".str_replace("-","",$blocked_dates_meta['to'])."\r\n";
					echo "SUMMARY:".esc_html__('Not available', 'sohohotel_booking')."\r\n";
					echo "END:VEVENT\r\n";

				} else {

					foreach(sh_get_date_range_array($blocked_dates_meta['from'],$blocked_dates_meta['to']) as $key => $val) {

						if (sh_get_weekday($val) == '1' && $blocked_dates_meta['weekday_mon'] == '1') {
							echo "BEGIN:VEVENT\r\n";
							echo "DTSTART;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "DTEND;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "UID:".str_replace("-","",$val)."\r\n";
							echo "SUMMARY:".esc_html__('Not available', 'sohohotel_booking')."\r\n";
							echo "END:VEVENT\r\n";
						}

						if (sh_get_weekday($val) == '2' && $blocked_dates_meta['weekday_tue'] == '1') {
							echo "BEGIN:VEVENT\r\n";
							echo "DTSTART;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "DTEND;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "UID:".str_replace("-","",$val)."\r\n";
							echo "SUMMARY:".esc_html__('Not available', 'sohohotel_booking')."\r\n";
							echo "END:VEVENT\r\n";
						}

						if (sh_get_weekday($val) == '3' && $blocked_dates_meta['weekday_wed'] == '1') {
							echo "BEGIN:VEVENT\r\n";
							echo "DTSTART;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "DTEND;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "UID:".str_replace("-","",$val)."\r\n";
							echo "SUMMARY:".esc_html__('Not available', 'sohohotel_booking')."\r\n";
							echo "END:VEVENT\r\n";
						}

						if (sh_get_weekday($val) == '4' && $blocked_dates_meta['weekday_thu'] == '1') {
							echo "BEGIN:VEVENT\r\n";
							echo "DTSTART;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "DTEND;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "UID:".str_replace("-","",$val)."\r\n";
							echo "SUMMARY:".esc_html__('Not available', 'sohohotel_booking')."\r\n";
							echo "END:VEVENT\r\n";
						}

						if (sh_get_weekday($val) == '5' && $blocked_dates_meta['weekday_fri'] == '1') {
							echo "BEGIN:VEVENT\r\n";
							echo "DTSTART;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "DTEND;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "UID:".str_replace("-","",$val)."\r\n";
							echo "SUMMARY:".esc_html__('Not available', 'sohohotel_booking')."\r\n";
							echo "END:VEVENT\r\n";
						}

						if (sh_get_weekday($val) == '6' && $blocked_dates_meta['weekday_sat'] == '1') {
							echo "BEGIN:VEVENT\r\n";
							echo "DTSTART;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "DTEND;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "UID:".str_replace("-","",$val)."\r\n";
							echo "SUMMARY:".esc_html__('Not available', 'sohohotel_booking')."\r\n";
							echo "END:VEVENT\r\n";
						}

						if (sh_get_weekday($val) == '0' && $blocked_dates_meta['weekday_sun'] == '1') {
							echo "BEGIN:VEVENT\r\n";
							echo "DTSTART;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "DTEND;VALUE=DATE:".str_replace("-","",$val)."\r\n";
							echo "UID:".str_replace("-","",$val)."\r\n";
							echo "SUMMARY:".esc_html__('Not available', 'sohohotel_booking')."\r\n";
							echo "END:VEVENT\r\n";
						}

					}
				
				}
				
			}
			
		endwhile;
	else :
	endif;
	
	wp_reset_query();
	// End Getting Blocked Dates
	
	echo "END:VCALENDAR";
	
	exit;
	   
}

if ( !empty($_GET['sh_ical']) ) {
	if ( $_GET['sh_ical'] == 'export' ) {
		add_action( 'wp', 'sh_get_ical' );
	}
}

/* ----------------------------------------------------------------------------

   Import booking data from external iCal file

---------------------------------------------------------------------------- */
function sh_get_converted_date($date) {
	$new_date = substr($date, 0, 8);
	$d = DateTime::createFromFormat("Ymd", $new_date);
	return $d->format("Y-m-d");
}

function sh_get_import_ical() {
	
	// Get the room the booking iCal feed is for
	if ($_GET['room_id']) {
		
		if( is_numeric($_GET['room_id']) ) {
			$room_id = (int)$_GET['room_id'];
		}
	
	} else {
		$room_id = '0';
	}
	
	// Get all room IDs
	$sh_get_all_room_ids = sh_get_all_room_ids();
	
	// Check if room ID entered exists, if yes continue importing
	if ( in_array($room_id,$sh_get_all_room_ids,true) ) {
		
		$booking_uids = array();
		$booking_summaries = array();
		
		// Begin Getting Bookings
		global $post;

		$args = array(
			'post_type' => 'booking',
			'posts_per_page' => '9999',
		);

		// Query bookings
		$wp_query = new WP_Query( $args );
		if ($wp_query->have_posts()) :
			while($wp_query->have_posts()) :	
				$wp_query->the_post();

				// Get booking data
				$booking_meta = get_post_meta($post->ID,'_booking_meta',TRUE);
				
				// Get booking UID
				$booking_uids[] = $booking_meta['ical_data']["UID"];
				$booking_uids[$booking_meta['ical_data']["UID"]] = get_the_ID();
				
				// Get booking summary (used for AirBNB)
				$booking_summaries[] = str_replace('\\', '', $booking_meta['ical_data']["SUMMARY"]);
				
			endwhile;
		else :
		endif;

		wp_reset_query();
		// End Getting Bookings

		include(sohohotel_booking_BASE_DIR . '/includes/functions/ical-reader.php');

		$ical   = new ICal($_GET['feed_url']);
		$events = $ical->events();
		
		foreach ($events as $event) {
			
			$booking_post = array();
			$booking_post["payment_method"] = '';
			$booking_post["_booking_meta"]["first_name"] = '';

			$booking_session = array();
			$booking_session["check_in"] = sh_get_converted_date($event['DTSTART']);
			$booking_session["check_out"] = sh_get_converted_date($event['DTEND']);
			$booking_session["book_room"] = '1';
			$booking_session["room_1"]["room_id"] = $room_id;
			$booking_session["room_1"]["adults"] = '0';
			$booking_session["room_1"]["children"] = '0';
			$booking_session["room_1"]["room_price"] = '0';
			$booking_session["total_booking_price"] = '0';
			$booking_session["services"] = '';
			$booking_session["feed_url"] = $_GET['feed_url'];
			
			// Check availability
				
			// Room is unavailable
			if (in_array($booking_session["room_1"]["room_id"], sh_get_all_booked_room_ids($booking_session["check_in"],$booking_session["check_out"],true,false))) {
				
				// Is room is unavailable take booking anyway but indicate that there is a booking conflict
				$booking_session["ical_unavailable"] = true;
				sh_store_booking_db($booking_post,$booking_session,$event);
				
			// Room is available
			} else {
				sh_store_booking_db($booking_post,$booking_session,$event);
			}
	
		}
		
		esc_html_e('iCal sync successful','sohohotel_booking');
		exit;
		
	} else {
		esc_html_e('Ical sync failed, room ID does not exist','sohohotel_booking');
		exit;
	}

}

if ( !empty($_GET['sh_ical']) ) {
	if ( $_GET['sh_ical'] == 'import' ) {
		add_action( 'wp', 'sh_get_import_ical' );
	}
}



/* ----------------------------------------------------------------------------

   Sync all iCal feeds

---------------------------------------------------------------------------- */
function sh_get_ical_sync_all() {
	
	global $post;
	global $wp_query;
	
	// Delete all iCal bookings
	$args = array(
		'post_type' => 'booking',
		'posts_per_page' => '9999',
	);

	// Query bookings
	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) :
		while($wp_query->have_posts()) :	
			$wp_query->the_post();

			// Get booking data
			$booking_meta = get_post_meta($post->ID,'_booking_meta',TRUE);
			
			if ( !empty($booking_meta['ical_data']) ) {
				wp_delete_post( get_the_ID() );
			}
			
		endwhile;
	else :
	endif;

	wp_reset_query();
	// End Delete Bookings
	
	// Sync new iCal bookings
	$args = array(
		'post_type' => 'accommodation',
		'posts_per_page' => '9999'
	);

	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) :
		
		while($wp_query->have_posts()) :
			
			$wp_query->the_post(); 
			
			// Get accommodation data
			$accommodation_meta = json_decode( get_post_meta($post->ID,'_accommodation_meta',TRUE), true );
			
			// If room has iCal feeds added
			if(!empty($accommodation_meta["ical_feed"])) {
				
				// Explode iCal URLs separated by a comma into individual URLs
				$ical_array = explode(',', $accommodation_meta["ical_feed"]);

				// Loop through array of iCal URLs
				foreach($ical_array as $key => $val) {
					
					$ical_url = get_home_url() . '/?sh_ical=import&room_id=' . get_the_ID() . '&feed_url=' . $val;
					$curl = curl_init($ical_url);
					
					curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
					curl_setopt($curl, CURLOPT_FAILONERROR, true);
					curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					
					curl_exec($curl);

				}
				
			}
			
		endwhile;
	
	endif;
	
	exit();
	
}

if ( !empty($_GET['sh_ical']) ) {
	if ( $_GET['sh_ical'] == 'sync_all' ) {
		add_action( 'wp', 'sh_get_ical_sync_all' );
	}
}


/* ----------------------------------------------------------------------------

   Get number of remaining rooms

---------------------------------------------------------------------------- */
function sh_get_remaining_rooms($check_in,$check_out,$room_id,$booked_ids) {
	
	ob_start();
	
	global $sohohotel_data;
	
	$accommodation_meta = json_decode( get_post_meta($room_id,'_accommodation_meta',TRUE), true );
	$accommodation_meta['number_of_rooms_this_type'];
	$sh_bookings_array = $booked_ids; 
	$sh_booking_ids = array_count_values($sh_bookings_array);
	$sh_count_bookings = $sh_booking_ids[$room_id];
	$sh_remaining_rooms = $accommodation_meta['number_of_rooms_this_type'] - $sh_count_bookings;
	
	if ( $sohohotel_data["booking_show_remaining_rooms"] != 'never' ) {

		if ( $sh_remaining_rooms <= $sohohotel_data["booking_show_remaining_rooms"] ) {

			$session_booked_ids = sh_get_booked_room_ids_session($check_in,$check_out);
			
			$tmp = array_count_values($session_booked_ids);
			$count_session_booking_id = $tmp[$room_id];
			
			if ($count_session_booking_id > 0) {
				echo $sh_remaining_rooms - $count_session_booking_id;
			} else {
				echo $sh_remaining_rooms;
			}
			
		} else {
			
			echo '';
			
		}
		
	} else {
		
		echo '';
		
	}
	
	return ob_get_clean();
	wp_reset_query();
	
}



/* ----------------------------------------------------------------------------

   Admin Pagination

---------------------------------------------------------------------------- */
function sh_admin_pagination($current_page,$found_posts,$pagination_page_base,$posts_per_page,$position) {

$total_pages = ceil($found_posts / $posts_per_page);

if ($current_page) {
	$current_page = $_GET['paged'];
} else {
	$current_page = 1;
}

// Get orderby from URL
if ( !empty($_GET['orderby']) ) {
	$orderby = '&orderby=' . $_GET['orderby'];
} else {
	$orderby = '';
}

// Get order from URL
if ( !empty($_GET['order']) ) {
	$order = '&order=' . $_GET['order'];
} else {
	$order = '';
}

// Get booking status from URL
if ( !empty($_GET['booking_status']) ) {
	$booking_status = '&booking_status=' . $_GET['booking_status'];
} else {
	$booking_status = '';
}

// Get room from URL
if ( !empty($_GET['room']) ) {
	$get_room = '&room=' . $_GET['room'];
} else {
	$get_room = '';
}

// Get from date
if ( !empty($_GET['from_date']) ) {
	$get_from_date = '&from_date=' . $_GET['from_date'];
} else {
	$get_from_date = '';
}

// Get to date
if ( !empty($_GET['to_date']) ) {
	$get_to_date = '&to_date=' . $_GET['to_date'];
} else {
	$get_to_date = '';
}

$first_page_link = get_admin_url() . $pagination_page_base . '&paged=1' . $orderby . $order . $booking_status . $get_room . $get_from_date . $get_to_date;
$prev_page_link = get_admin_url() . $pagination_page_base . '&paged=' . ($current_page - 1) . $orderby . $order . $booking_status . $get_room . $get_from_date . $get_to_date;
$next_page_link = get_admin_url() . $pagination_page_base . '&paged=' . ($current_page + 1) . $orderby . $order . $booking_status . $get_room . $get_from_date . $get_to_date;
$last_page_link = get_admin_url() . $pagination_page_base . '&paged=' . $total_pages . $orderby . $order . $booking_status . $get_room . $get_from_date . $get_to_date; 

$page_input_size = strlen((string)$found_posts);

if ($position == 'top') {
	
	$pagination_position = "<span class='paging-input'>
		<input class='current-page' id='current-page-selector' type='text' name='paged' value='" . $current_page . "' size='" . $page_input_size . "' aria-describedby='table-paging' />
		<span class='tablenav-paging-text'>" . esc_html__('of', 'sohohotel_booking') . " <span class='total-pages'>" . $total_pages . "</span>
	</span>";
	
	$pagination_position_no_input = "<span class='paging-input'>
		<input class='current-page' id='current-page-selector' type='text' value='" . $current_page . "' size='" . $page_input_size . "' aria-describedby='table-paging' />
		<span class='tablenav-paging-text'>" . esc_html__('of', 'sohohotel_booking') . " <span class='total-pages'>" . $total_pages . "</span>
	</span>";
	
} else {
	
	$pagination_position = "<span id='table-paging' class='paging-input'>
	<span class='tablenav-paging-text'>" . $current_page . ' ' . esc_html__('of', 'sohohotel_booking') . " <span class='total-pages'>" . $total_pages . "</span></span>
	</span>";
	
	$pagination_position_no_input = '';
	
}

?>

<div class='tablenav-pages'>
	
	<span class="displaying-num"><?php echo $found_posts . ' ' . esc_html__('items', 'sohohotel_booking'); ?></span>
	
	<span class='pagination-links'>
		
		<?php if ($current_page == 1 && $total_pages == 1) {
			
			// .
			
			echo "<span class='tablenav-pages-navspan' aria-hidden='true'>&laquo;</span>
			<span class='tablenav-pages-navspan' aria-hidden='true'>&lsaquo;</span>
			
			" . $pagination_position_no_input . "

			<span class='tablenav-pages-navspan' aria-hidden='true'>&rsaquo;</span>
			<span class='tablenav-pages-navspan' aria-hidden='true'>&raquo;</span>";
			
		} elseif ($current_page == 1 && $total_pages > 2) {
			
			// > . >>
			
			echo "<span class='tablenav-pages-navspan' aria-hidden='true'>&laquo;</span>
			<span class='tablenav-pages-navspan' aria-hidden='true'>&lsaquo;</span>
			
			" . $pagination_position . "
			
			<a class='next-page' href='" . $next_page_link . "'><span aria-hidden='true'>&rsaquo;</span></a>
			<a class='last-page' href='" . $last_page_link . "'><span aria-hidden='true'>&raquo;</span></a>";
			
		} elseif ($current_page == 1 && $total_pages > 1) {
			
			// >
			
			echo "<span class='tablenav-pages-navspan' aria-hidden='true'>&laquo;</span>
			<span class='tablenav-pages-navspan' aria-hidden='true'>&lsaquo;</span>
			
			" . $pagination_position . "
			
			<a class='next-page' href='" . $next_page_link . "'><span aria-hidden='true'>&rsaquo;</span></a>
			<span class='tablenav-pages-navspan' aria-hidden='true'>&raquo;</span>";
			
		} elseif ( ($current_page - 1) > 1 && ($total_pages - $current_page) > 1 ) {
			
			// << . < . > . >>
			
			echo "<a class='first-page' href='" . $first_page_link . "'><span aria-hidden='true'>&laquo;</span></a>
			<a class='prev-page' href='" . $prev_page_link . "'><span aria-hidden='true'>&lsaquo;</span></a>
			
			" . $pagination_position . "
			
			<a class='next-page' href='" . $next_page_link . "'><span aria-hidden='true'>&rsaquo;</span></a>
			<a class='last-page' href='" . $last_page_link . "'><span aria-hidden='true'>&raquo;</span></a>";
			
		} elseif ( ($total_pages - $current_page) > 1) {
			
			// < . > . >>
			
			echo "<span class='tablenav-pages-navspan' aria-hidden='true'>&laquo;</span>
			<a class='prev-page' href='" . $prev_page_link . "'><span aria-hidden='true'>&lsaquo;</span></a>
			
			" . $pagination_position . "
			
			<a class='next-page' href='" . $next_page_link . "'><span aria-hidden='true'>&rsaquo;</span></a>
			<a class='last-page' href='" . $last_page_link . "'><span aria-hidden='true'>&raquo;</span></a>";
		
		} elseif ( ($total_pages - $current_page) == 1 && $total_pages == 3 ) {
			
			// < . >
			
			echo "<span class='tablenav-pages-navspan' aria-hidden='true'>&laquo;</span>
			<a class='prev-page' href='" . $prev_page_link . "'><span aria-hidden='true'>&lsaquo;</span></a>

			" . $pagination_position . "

			<a class='next-page' href='" . $next_page_link . "'><span aria-hidden='true'>&rsaquo;</span></a>
			<span class='tablenav-pages-navspan' aria-hidden='true'>&raquo;</span>";
					
		} elseif ( ($total_pages - $current_page) == 1 ) {
			
			// << . < . >
			
			echo "<a class='first-page' href='" . $first_page_link . "'><span aria-hidden='true'>&laquo;</span></a>
			<a class='prev-page' href='" . $prev_page_link . "'><span aria-hidden='true'>&lsaquo;</span></a>

			" . $pagination_position . "

			<a class='next-page' href='" . $next_page_link . "'><span aria-hidden='true'>&rsaquo;</span></a>
			<span class='tablenav-pages-navspan' aria-hidden='true'>&raquo;</span>";
			
		} elseif ( $total_pages == $current_page && $total_pages < 3 ) {
			
			// < 
			
			echo "<span class='tablenav-pages-navspan' aria-hidden='true'>&laquo;</span>
			<a class='prev-page' href='" . $prev_page_link . "'><span aria-hidden='true'>&lsaquo;</span></a>

			" . $pagination_position . "

			<span class='tablenav-pages-navspan' aria-hidden='true'>&rsaquo;</span>
			<span class='tablenav-pages-navspan' aria-hidden='true'>&raquo;</span>";
			
		} elseif ( $total_pages == $current_page && $total_pages > 2 ) {
			
			// << . <
			
			echo "<a class='first-page' href='" . $first_page_link . "'><span aria-hidden='true'>&laquo;</span></a>
			<a class='prev-page' href='" . $prev_page_link . "'><span aria-hidden='true'>&lsaquo;</span></a>

			" . $pagination_position . "

			<span class='tablenav-pages-navspan' aria-hidden='true'>&rsaquo;</span>
			<span class='tablenav-pages-navspan' aria-hidden='true'>&raquo;</span>";
			
		} ?>
	
	</span>
	
</div>

<br class="clear" />

<?php }



/* ----------------------------------------------------------------------------

   Get time elapsed

---------------------------------------------------------------------------- */
function sh_get_time_elapsed($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}



/* ----------------------------------------------------------------------------

   Untrash Post

---------------------------------------------------------------------------- */
function sh_untrash_post( $post_id ) {

    if( !$post_id || !is_numeric( $post_id ) ) {
        return false;
    }

    $_wpnonce = wp_create_nonce( 'untrash-post_' . $post_id );
    $url = admin_url( 'post.php?post=' . $post_id . '&action=untrash&_wpnonce=' . $_wpnonce );
    return $url; 

}



/* ----------------------------------------------------------------------------

   Trash Post

---------------------------------------------------------------------------- */
function sh_trash_post( $post_id ) {

    if( !$post_id || !is_numeric( $post_id ) ) {
        return false;
    }

    $_wpnonce = wp_create_nonce( 'trash-post_' . $post_id );
    $url = admin_url( 'post.php?post=' . $post_id . '&action=trash&_wpnonce=' . $_wpnonce );
    return $url; 

}



/* ----------------------------------------------------------------------------

   Delete Post

---------------------------------------------------------------------------- */
function sh_delete_post( $post_id ) {

    if( !$post_id || !is_numeric( $post_id ) ) {
        return false;
    }

    $_wpnonce = wp_create_nonce( 'delete-post_' . $post_id );
    $url = admin_url( 'post.php?post=' . $post_id . '&action=delete&_wpnonce=' . $_wpnonce );
    return $url; 

}



/* ----------------------------------------------------------------------------

   Check date is valid

---------------------------------------------------------------------------- */
function sh_date_check($date) {
	
	if (DateTime::createFromFormat('Y-m-d', $date) !== FALSE) {
		// Valid date  
		return true;
	} else {
		// Not valid date
		return false;
	}
	
}



/* ----------------------------------------------------------------------------

   Check if there are any services

---------------------------------------------------------------------------- */
function sh_services_exist() {

	// Query services
	$args_service_check = array('post_type' => 'service');
	$wp_query_service_check = new WP_Query( $args_service_check );
	$count_service_check = $wp_query_service_check->found_posts;
	wp_reset_query();
	
	return $count_service_check;
	
}



/* ----------------------------------------------------------------------------

   Check if there are any coupons

---------------------------------------------------------------------------- */
function sh_coupons_exist() {

	// Query coupons
	$args_coupon_check = array('post_type' => 'coupon');
	$wp_query_coupon_check = new WP_Query( $args_coupon_check );
	$count_coupon_check = $wp_query_coupon_check->found_posts;
	wp_reset_query();
	
	return $count_coupon_check;
	
}



/* ----------------------------------------------------------------------------

   Get guest info for emails

---------------------------------------------------------------------------- */
function sh_get_guest_info($str, $data){
	
	// If text
	if(preg_match_all('/\[text /', $str, $matches)){
		$c=0;
		foreach($matches[0] as $texts){
			$e = explode('[text ', $str);
			$c++;
			$param = explode(']', $e[1]);
			$param = $param[0];
			$label = sh_get_label_field($param);
			$id = getIdField($param);
			$value = '';
			$class = getClassField($param);
			if(!empty($data[$id])){
				$value = $data[$id];
			}
			$str = str_replace('[text '.$param.']', '<li>' . $label.$value . '</li>', $str);
		}	
	}
	
	// If Select
	if(preg_match_all('/\[select /', $str, $matches)){
		$c=0;
		foreach($matches[0] as $texts){
			$e = explode('[select ', $str);
			$c++;
			$param = explode(']', $e[1]);
			$param = $param[0];
			$label = sh_get_label_field($param);
			$id = getIdField($param);
			$value = '';
			$class = getClassField($param);
			if(!empty($data[$id])){
				$value = $data[$id];
			}
			$input = '<select name="_booking_meta['.$id.']" id="'.$id.'" '.$class.'>
			<option value="">Choose a option</option>';
			
			$e = explode('choices="', $param);
			$choices = explode('"', $e[1]);
			if(@substr_count($choices[0], ',')){
				$eC = explode(',', $choices[0]);
				foreach($eC as $choice){
					$selected = '';
					if($value == $choice){ $selected = 'selected';}
					$input .= '<option value="'.$choice.'" '.$selected.'>'.$choice.'</option>';
				}
			}else{
				$input .= '<option value="'.$choice.'" '.$selected.'>'.$choice.'</option>';
			}
			
			$input .= '</select>';
			$str = str_replace('[select '.$param.']', $label.$input, $str);
		}	
	}
	
	// If Radio
	if(preg_match_all('/\[radio /', $str, $matches)){
		$c=0;
		foreach($matches[0] as $texts){
			$e = explode('[radio ', $str);
			$c++;
			$param = explode(']', $e[1]);
			$param = $param[0];
			$label = sh_get_label_field($param);
			$id = getIdField($param);
			$value = '';
			$class = getClassField($param);
			if(!empty($data[$id])){
				$value = $data[$id];
			}
			$input = '';
			
			$e = explode('choices="', $param);
			$choices = explode('"', $e[1]);
			$txtChoices = '';
			if(@substr_count($choices[0], ',')){
				$eC = explode(',', $choices[0]);
				foreach($eC as $choice){
					$selected = '';
					if($value == $choice){ $selected = 'checked';}
					$input .= '<input type="radio" name="_booking_meta['.$id.']" value="'.$choice.'" '.$class.' '.$selected.'> ' . $choice;
				}
			}else{
				if($value == $choice){ $selected = 'checked';}
				$input = '<input type="radio" name="_booking_meta['.$id.']" value="'.$choice.'" '.$class.' '.$selected.'> ' . $choice;
			}
			$str = str_replace('[radio '.$param.']', $label.$input, $str);
		}	
	}	
	
	// If Checkbox
	if(preg_match_all('/\[checkbox /', $str, $matches)){
		$c=0;
		foreach($matches[0] as $texts){
			$e = explode('[checkbox ', $str);
			$c++;
			$param = explode(']', $e[1]);
			$param = $param[0];
			$label = sh_get_label_field($param);
			$id = getIdField($param);
			$value = '';
			$class = getClassField($param);
			if(!empty($data[$id])){
				$value = $data[$id];
			}
			$input = '';
			
			$e = explode('choices="', $param);
			$choices = explode('"', $e[1]);
			$txtChoices = '';
			if(@substr_count($choices[0], ',')){
				$eC = explode(',', $choices[0]);
				foreach($eC as $choice){
					$selected = '';
					if($value == $choice){ $selected = 'checked';}
					$input .= '<input type="checkbox" name="_booking_meta['.$id.']" value="'.$choice.'" '.$class.' '.$selected.'> ' . $choice;
				}
			}else{
				if($value == $choice){ $selected = 'checked';}
				$input = '<input type="checkbox" name="_booking_meta['.$id.']" value="'.$choice.'" '.$class.' '.$selected.'> ' . $choice;
			}
			$str = str_replace('[checkbox '.$param.']', $label.$input, $str);
		}	
	}
	
	// If text
	if(preg_match_all('/\[textarea /', $str, $matches)){
		$c=0;
		foreach($matches[0] as $texts){
			$e = explode('[textarea ', $str);
			$c++;
			$param = explode(']', $e[1]);
			$param = $param[0];
			$label = sh_get_label_field($param);
			$id = getIdField($param);
			$value = '';
			$class = getClassField($param);
			if(!empty($data[$id])){
				$value = $data[$id];
			}
			$str = str_replace('[textarea '.$param.']', '<li>' . $label.$value . '</li>', $str);
		}	
	}			
	
	return $str;
	
}

function sh_get_label_field($str){
	if(preg_match('/label="/', $str, $matches)){
		$e = explode('label="', $str);
		$param = explode('"', $e[1]);
		$param = $param[0];	
		$txtRequired = '';
		return '<label for="'.strtolower(str_replace(' ', '_', $param)).'">'.$param.$txtRequired.': </label>';
	}else{
		return '';
	}
}



/* ----------------------------------------------------------------------------

   Get booked dates for live availability checker

---------------------------------------------------------------------------- */
function sh_get_booking_dates($room_id) {
	
	$sh_get_blocked_dates_data = sh_get_blocked_dates_data('');
	
	// Booking query
	$booking_array = array();
	$args_booking = array('post_type' => 'booking','posts_per_page' => '99999');
	$wp_query_booking = new WP_Query( $args_booking );
	if ($wp_query_booking->have_posts()) : while($wp_query_booking->have_posts()) :
		$wp_query_booking->the_post(); 
		
		$booking_meta = get_post_meta( get_the_ID(), '_booking_meta', true );
		$json_data = $booking_meta['save_rooms'];
		$data = json_decode($json_data, true);
		$booking_array_inner = array();
		
		if ( $booking_meta['booking_status'] == '2' ) {
			
			foreach($data as $key => $val) {			
				$booking_array_inner["dates"] = sh_get_date_range_array($booking_meta["check_in"],date('Y-m-d', strtotime($booking_meta['check_out'] . ' -1 day')));
				$booking_array_inner["room_id"] = sh_get_original_wpml_id($val['room_type'],'accommodation');
				$booking_array[] = $booking_array_inner;
			}
			
		}
		
	endwhile;endif;
	wp_reset_query();
	
	if ( !empty($booking_array) ) {
		
		// Accommodation query
		$accommodation_array = array();
		$args_accommodation = array('post_type' => 'accommodation','posts_per_page' => '99999');
		$wp_query_accommodation = new WP_Query( $args_accommodation );
		if ($wp_query_accommodation->have_posts()) : while($wp_query_accommodation->have_posts()) :
			$wp_query_accommodation->the_post(); 

			$accommodation_meta = json_decode( get_post_meta(get_the_ID(),'_accommodation_meta',true), true );
			$accommodation_array_inner = array();
			$accommodation_array_inner["room_id"] = sh_get_original_wpml_id(get_the_ID(),'accommodation');
			$accommodation_array_inner["room_amount"] = $accommodation_meta['number_of_rooms_this_type'];
			$accommodation_array[] = $accommodation_array_inner; 

		endwhile;endif;
		wp_reset_query();

		// Return bookings
		$all_rooms_booked_dates_array = array();

		// Return fully booked dates for all rooms
		if ( empty($room_id) ) {

			// Get all room ids
			$sh_get_all_room_ids = sh_get_original_wpml_ids(sh_get_all_room_ids(),'accommodation');

			// Check bookings for all rooms
			foreach( $sh_get_all_room_ids as $key => $val) {	
				$all_rooms_booked_dates_array[] = sh_get_booking_dates_array(sh_get_original_wpml_id($val,'accommodation'),$booking_array,$accommodation_array,$sh_get_blocked_dates_data);
			}

			$all_rooms_booked_dates_array_2 = array_shift($all_rooms_booked_dates_array);

			foreach($all_rooms_booked_dates_array as $key=>$date) {
			  $all_rooms_booked_dates_array_2 = array_intersect($all_rooms_booked_dates_array_2, $date);  
			}
			
			return $all_rooms_booked_dates_array_2;

		// Return fully booked dates for a specific room
		} else {
			return sh_get_booking_dates_array(sh_get_original_wpml_id($room_id,'accommodation'),$booking_array,$accommodation_array,$sh_get_blocked_dates_data);
		}
		
	} else {
		return sh_get_booking_dates_array(sh_get_original_wpml_id($room_id,'accommodation'),$booking_array,$accommodation_array,$sh_get_blocked_dates_data);
	}
	
	
	
}



/* ----------------------------------------------------------------------------

   Get booked dates for live availability checker

---------------------------------------------------------------------------- */
function sh_get_booking_dates_array($room_id,$booking_array,$accommodation_array,$sh_get_blocked_dates_data) {
	
	// Get booked dates for a specific room
	$booking_room_date_array = array();
	foreach( $booking_array as $key => $val) {
		if ( $val["room_id"] == $room_id ) {
			$booking_room_date_array[] = $val["dates"];
		}
	}
	
	// Merge all dates
	if ( !empty($booking_room_date_array) ) {
		$booking_room_date_array_merged = call_user_func_array('array_merge', $booking_room_date_array);
	} else {
		$booking_room_date_array_merged = array();
	}
	
	// Check if dates are booked more times than the room is available (e.g. fully booked)
	$duplicate_dates_array = array();
	$booked_dates_array = array();
	foreach ($booking_room_date_array_merged as $val) {
		if (++$duplicate_dates_array[$val] >= sh_get_number_rooms_of_type_from_array($accommodation_array,$room_id)) {
			$booked_dates_array[] = $val;
		}
	}
	
	$blocked_dates_array = array();
	
	// Check blocked dates data
	foreach ($sh_get_blocked_dates_data as $val) {
		
		if ( $val["room_type"] == $room_id ) {

			$sh_get_blocked_dates_data_date_range = sh_get_date_range_array($val["from"],date('Y-m-d', strtotime($val["to"] . ' -1 day')));
			
			foreach(sh_get_date_range_array($val["from"],date('Y-m-d', strtotime($val["to"] . ' -1 day'))) as $key => $val2) {
				
				if ( sh_get_weekday($val2) == '1' && $val["weekday_mon"] == '1' ) {
					$blocked_dates_array[] = $val2;
				}
				
				if ( sh_get_weekday($val2) == '2' && $val["weekday_tue"] == '1' ) {
					$blocked_dates_array[] = $val2;
				}
				
				if ( sh_get_weekday($val2) == '3' && $val["weekday_wed"] == '1' ) {
					$blocked_dates_array[] = $val2;
				}
				
				if ( sh_get_weekday($val2) == '4' && $val["weekday_thu"] == '1' ) {
					$blocked_dates_array[] = $val2;
				}
				
				if ( sh_get_weekday($val2) == '5' && $val["weekday_fri"] == '1' ) {
					$blocked_dates_array[] = $val2;
				}
				
				if ( sh_get_weekday($val2) == '6' && $val["weekday_sat"] == '1' ) {
					$blocked_dates_array[] = $val2;
				}
				
				if ( sh_get_weekday($val2) == '0' && $val["weekday_sun"] == '1' ) {
					$blocked_dates_array[] = $val2;
				}
				
			}
			
		}
		
	}
	
	// Merged bookings and blocked dates
	$all_blocked_dates = array_merge($blocked_dates_array,$booked_dates_array);

	// Remove duplicate dates
	$booked_dates_array_removed_duplicates = array_unique($all_blocked_dates, SORT_REGULAR);

	// Reset array keys
	$booked_dates_array_reset_keys = array_values($booked_dates_array_removed_duplicates);
	
	// Return unavailable dates
	return $booked_dates_array_reset_keys;
	
}



/* ----------------------------------------------------------------------------

   Get number of room for room type for live availability checker

---------------------------------------------------------------------------- */
function sh_get_number_rooms_of_type_from_array($accommodation_array,$room_id) {
	
	foreach( $accommodation_array as $key => $val) {
		if ( $val["room_id"] == $room_id ) {
			return $val["room_amount"];
		}
	}
	
}



/* ----------------------------------------------------------------------------

   Get unavailable dates for live availability checker

---------------------------------------------------------------------------- */
function sh_get_all_unavailable_dates($booked_dates,$blocked_dates) {
	
	$merged_arrays = array_merge($booked_dates,$blocked_dates);
	
	// Remove duplicate dates
	$removed_duplicates = array_unique($merged_arrays , SORT_REGULAR);
	
	// Reset array keys
	$reset_keys = array_values($removed_duplicates);
	
	// Return unavailable dates
	return $reset_keys;
	
}



/* ----------------------------------------------------------------------------

   Get blocked dates for live availability checker

---------------------------------------------------------------------------- */
function sh_get_blocked_dates_data($room_id) {
	
	// Blocked dates query
	$blocked_dates_data = array();
	$args_blocked_dates = array('post_type' => 'blocked_dates','posts_per_page' => '99999');
	$wp_query_blocked_dates = new WP_Query( $args_blocked_dates );
	if ($wp_query_blocked_dates->have_posts()) : while($wp_query_blocked_dates->have_posts()) :
		$wp_query_blocked_dates->the_post(); 
		
		$blocked_dates_meta = get_post_meta( get_the_ID(), '_blocked_dates_meta', true );
		
		$blocked_dates_data_inner = array();
		
		if ( !empty($room_id) ) {
			
			if ( $blocked_dates_meta["room_type"] == $room_id ) {
				
				$blocked_dates_data["from"] = $blocked_dates_meta["from"];
				$blocked_dates_data["to"] = $blocked_dates_meta["to"];
				$blocked_dates_data["weekday_mon"] = $blocked_dates_meta["weekday_mon"];
				$blocked_dates_data["weekday_tue"] = $blocked_dates_meta["weekday_tue"];
				$blocked_dates_data["weekday_wed"] = $blocked_dates_meta["weekday_wed"];
				$blocked_dates_data["weekday_thu"] = $blocked_dates_meta["weekday_thu"];
				$blocked_dates_data["weekday_fri"] = $blocked_dates_meta["weekday_fri"];
				$blocked_dates_data["weekday_sat"] = $blocked_dates_meta["weekday_sat"];
				$blocked_dates_data["weekday_sun"] = $blocked_dates_meta["weekday_sun"];
				
			}
			
		} else {
			
			$blocked_dates_data_inner["room_type"] = $blocked_dates_meta["room_type"];
			$blocked_dates_data_inner["from"] = $blocked_dates_meta["from"];
			$blocked_dates_data_inner["to"] = $blocked_dates_meta["to"];
			$blocked_dates_data_inner["weekday_mon"] = $blocked_dates_meta["weekday_mon"];
			$blocked_dates_data_inner["weekday_tue"] = $blocked_dates_meta["weekday_tue"];
			$blocked_dates_data_inner["weekday_wed"] = $blocked_dates_meta["weekday_wed"];
			$blocked_dates_data_inner["weekday_thu"] = $blocked_dates_meta["weekday_thu"];
			$blocked_dates_data_inner["weekday_fri"] = $blocked_dates_meta["weekday_fri"];
			$blocked_dates_data_inner["weekday_sat"] = $blocked_dates_meta["weekday_sat"];
			$blocked_dates_data_inner["weekday_sun"] = $blocked_dates_meta["weekday_sun"];
			$blocked_dates_data[] = $blocked_dates_data_inner;
			
		}

	endwhile;endif;
	wp_reset_query();

	return $blocked_dates_data;
	
}



/* ----------------------------------------------------------------------------

   Add single post to iCal post type, if the post type has no posts the archive page will not work

---------------------------------------------------------------------------- */
function sh_add_ical_post() {
	
	$query = new WP_Query(array(
	    'post_type' => 'ical'
	));
	
	if( $query->have_posts() ){
	    
		// Do nothing
		
	} else {
	    
		// Add post
		$post_id = wp_insert_post(array (
		   'post_type' => 'ical',
		   'post_title' => 'ical',
		   'post_content' => '',
		   'post_status' => 'publish',
		   'comment_status' => 'closed',
		   'ping_status' => 'closed',
		));
		
	}
	
}



/* ----------------------------------------------------------------------------

   Social Icons Check

---------------------------------------------------------------------------- */
function sohohotel_footer_social_icons_check() {
	
	global $sohohotel_data;
	
	if ( $sohohotel_data['facebook-icon'] == '' && $sohohotel_data['flickr-icon'] == '' && $sohohotel_data['googleplus-icon'] == '' && $sohohotel_data['instagram-icon'] == '' && $sohohotel_data['pinterest-icon'] == '' && $sohohotel_data['skype-icon'] == '' && $sohohotel_data['soundcloud-icon'] == '' && $sohohotel_data['tumblr-icon'] == '' && $sohohotel_data['twitter-icon'] == '' && $sohohotel_data['vimeo-icon'] == '' && $sohohotel_data['vine-icon'] == '' && $sohohotel_data['yelp-icon'] == '' && $sohohotel_data['youtube-icon'] == '' && $sohohotel_data['tripadvisor-icon'] == '' ) {
		return 'false';
	}
	
}