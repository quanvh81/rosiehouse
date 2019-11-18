<?php
function sohohotel_get_month_name($month) {
	
	// Set month title
	if ($month == 1) {
		$month_title = esc_html__( 'January', 'sohohotel_booking' );
	} elseif ($month == 2) {
		$month_title = esc_html__( 'February', 'sohohotel_booking' );
	} elseif ($month == 3) {
		$month_title = esc_html__( 'March', 'sohohotel_booking' );
	} elseif ($month == 4) {
		$month_title = esc_html__( 'April', 'sohohotel_booking' );
	} elseif ($month == 5) {
		$month_title = esc_html__( 'May', 'sohohotel_booking' );
	} elseif ($month == 6) {
		$month_title = esc_html__( 'June', 'sohohotel_booking' );
	} elseif ($month == 7) {
		$month_title = esc_html__( 'July', 'sohohotel_booking' );
	} elseif ($month == 8) {
		$month_title = esc_html__( 'August', 'sohohotel_booking' );
	} elseif ($month == 9) {
		$month_title = esc_html__( 'September', 'sohohotel_booking' );
	} elseif ($month == 10) {
		$month_title = esc_html__( 'October', 'sohohotel_booking' );
	} elseif ($month == 11) {
		$month_title = esc_html__( 'November', 'sohohotel_booking' );
	} elseif ($month == 12) {
		$month_title = esc_html__( 'December', 'sohohotel_booking' );
	}
	
	return $month_title;
	
}

function sohohotel_get_month_array($month,$year) {
	
	// Create array for dates
	$list = array();
	
	// Store dates for selected month in array
	for($d=1; $d<=31; $d++) {
	    $time=mktime(12, 0, 0, $month, $d, $year);          
	    if (date('m', $time) == $month) {
			$list[] = $time;
		}
	}
	
	return $list;
	
}

function sohohotel_get_month_day_count($list) {
	
	// Find total number of days in month
	$counter1 = 0;
	foreach ($list as $item) {
	    $counter1++;
	}
	
	return $counter1;
	
}

function sohohotel_display_admin_booking_calendar() { 
    
	echo '<div class="wrap">';
	echo '<h1 class="wp-heading-inline">' . esc_html__('Booking Calendar', 'sohohotel_booking') . '</h1>';
	echo '<a href="' . get_admin_url() . 'admin.php?page=booking_add" class="page-title-action">' . esc_html__('Add Booking', 'sohohotel_booking') . '</a>';
	echo '<div class="clearboth"></div>';

	// Get room from URL
	if ( !empty($_GET['room']) ) {
		
		if ( $_GET['room'] != '0') {
			$room_id = $_GET['room'];
			$room_id_url = '&room=' . $room_id;
		} else {
			$room_id = 0;
			$room_id_url = '';
		}
	
	} else {
		
		$room_id_url = '';

	}
	
	// Set month
	if ( !empty( $_GET["m"] ) ) {
		$m = $_GET["m"];
	}
	
	// Set year
	if ( !empty( $_GET["y"] ) ) {
		$y = $_GET["y"];
	}

	// Get month
	if( isset($m) ) {
		
		if ( (1 <= $m) && ($m <= 12) ) {
			$month = $m;
		} else {
			$month = date('n');
		}
		
	} else {
		$month = date('n');
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
	
	// Get next month and year
	if( $month == 12 ) {
		$month_2 = 1;
		$year_2 = $year + 1;
	} else {
		$month_2 = $month + 1;
		$year_2 = $year;
	}

	// Set month titles
	$month_title_1 = sohohotel_get_month_name($month) . ' ' . $year;
	$month_title_2 = sohohotel_get_month_name($month_2) . ' ' . $year_2;
	
	// Set month 1 array
	$month_1_array = sohohotel_get_month_array($month,$year);
	$month_1_day_count = sohohotel_get_month_day_count($month_1_array);
	
	// Set month 2 array
	$month_2_array = sohohotel_get_month_array($month_2,$year_2);
	$month_2_day_count = sohohotel_get_month_day_count($month_2_array);
	
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
	
	// Set navigation URLs
	$next_link = get_admin_url() . 'admin.php?page=booking_calendar&m=' . $next_month . '&y=' . $next_year . $room_id_url;
	$prev_link = get_admin_url() . 'admin.php?page=booking_calendar&m=' . $prev_month . '&y=' . $prev_year . $room_id_url;
	$current_link = get_admin_url() . 'admin.php?page=booking_calendar&m=' . date('n') . '&y=' . date('Y') . $room_id_url; 
	
	echo '<form action="' . get_admin_url() . 'admin.php?page=booking_calendar" method="get">';
	echo '<input type="hidden" name="page" value="booking_calendar" />';
	echo '<div class="tablenav top clearfix">';
	echo '<p class="sh_admin_booking_calendar_nav"><a href="' . $prev_link . '">&lt; ' . esc_html__( 'Prev', 'sohohotel_booking' ) . '</a> | <a href="' . $current_link . '">' . esc_html__( 'Current Month', 'sohohotel_booking' ) . '</a> | <a href="' . $next_link . '">' . esc_html__( 'Next', 'sohohotel_booking' ) . ' &gt;</a></p>';
	echo '<div class="sh_admin_booking_calendar_filter">';
	echo '<select name="m">';
		foreach (range(1, 12) as $r) {
			if ($month == $r) {$selected = 'selected';} else {$selected = '';}
			echo '<option value="' . $r . '" ' . $selected . '>' . sohohotel_get_month_name($r) . '</option>';	
		}
	echo '</select>';
	echo '<select name="y">';
		foreach (range( (date('Y') - 1), (date('Y') + 9) ) as $r) {
			if ($year == $r) {$selected = 'selected';} else {$selected = '';}
			echo '<option value="' . $r . '" ' . $selected . '>' . $r . '</option>';	
		}
	echo '</select>';
	echo '<select name="room" id="room" class="postform">';
	echo '<option value="0">' . esc_html__('All rooms', 'sohohotel_booking') . '</option>';
	
	$args_accommodation = array('post_type' => 'accommodation','posts_per_page' => '9999');
	$wp_query_accommodation = new WP_Query( $args_accommodation );
	if ($wp_query_accommodation->have_posts()) :
		while($wp_query_accommodation->have_posts()) :
			$wp_query_accommodation->the_post();
			echo '<option value="' . get_the_ID() . '"';
			if ( !empty($room_id) ) {if ( $room_id != 0 ) {if ( $room_id == get_the_ID() ) {echo 'selected';}}}
			echo '>';
			echo get_the_title() . '</option>';
		endwhile;
	endif;

	echo '</select>';
	
	echo '<input type="submit" class="calendar_button_custom button" value="' . esc_html__( 'Filter', 'sohohotel_booking' ) . '" />';
	
	echo '</form>';
	echo '</div>';
	echo '</div>';
	echo '<div class="clearboth"></div>';
	
	echo '<div class="sh_admin_booking_calendar_wrapper">';
	echo '<table class="sh_admin_booking_calendar">';
	
		echo '<tr class="sh_month_labels">';
			echo '<td rowspan="3">&nbsp;</td>';
			echo '<td colspan="' . $month_1_day_count . '">' . $month_title_1 . '</td>';
			//echo '<td colspan="' . $month_2_day_count . '">' . $month_title_2 . '</td>';
		echo '</tr>';
		
		echo '<tr>';	
			foreach( $month_1_array as $key => $val) {echo '<td>' . substr(date('D', $val),0,1) . '</td>';}
			//foreach( $month_2_array as $key => $val) {echo '<td>' . substr(date('D', $val),0,1) . '</td>';}
	  	echo '</tr>';
		
		echo '<tr>';	
			foreach( $month_1_array as $key => $val) {echo '<td>' . date('d', $val) . '</td>';}
			//foreach( $month_2_array as $key => $val) {echo '<td>' . date('d', $val) . '</td>';}
	  	echo '</tr>';
	
		$selected_date_from = $year . '-' . sprintf("%02d", $month) . '-01';
		//$selected_date_to = $year_2 . '-' . sprintf("%02d", $month_2) . '-' . $month_2_day_count;
		$selected_date_to = $year . '-' . sprintf("%02d", $month) . '-' . $month_1_day_count;

		$booked_ids = array();
		$args_booking = array('post_type' => 'booking','posts_per_page' => '99999');
		$wp_query_booking = new WP_Query( $args_booking );
		$found_posts_booking = $wp_query_booking->found_posts; 
		if ($wp_query_booking->have_posts()) :
			while($wp_query_booking->have_posts()) :
				
				$wp_query_booking->the_post();
				$booking_meta = get_post_meta( get_the_ID(), '_booking_meta', true );
				
				// If dates overlap add ID to array
				if ( sh_get_date_range_overlap($selected_date_from,$selected_date_to,$booking_meta["check_in"],$booking_meta["check_out"]) == true ) {
					
					// If room filter is selected only store IDs which have that particular room
					if ( !empty($_GET["room"]) ) {
						
						if ( $_GET["room"] != 0 ) {
							
							$room_filter_booking_data_decoded = json_decode($booking_meta["save_rooms"], true);

							foreach($room_filter_booking_data_decoded as $key => $val) {
								$room_type = $val['room_type'];	
								if ( $_GET["room"] == $room_type ) {
									$booked_ids[] = get_the_ID();
								}
							}
							
						} else {
							
							// Store IDs which overlap with months currently being displayed in calendar
							$booked_ids[] = get_the_ID();
							
						}
						
						
					} else {
						
						// Store IDs which overlap with months currently being displayed in calendar
						$booked_ids[] = get_the_ID(); 
						
					}
					
				}
				
			endwhile;
		endif;
		
		$month_1_array_full_date = array();
		foreach( $month_1_array as $key => $val) {
			$month_1_array_full_date[] = date('Y', $val) . '-' . date('m', $val) . '-' . date('d', $val);
		}
		
		$month_2_array_full_date = array();
		foreach( $month_2_array as $key => $val) {
			$month_2_array_full_date[] = date('Y', $val) . '-' . date('m', $val) . '-' . date('d', $val);
		}
		
		//$month_1_2_array = array_merge($month_1_array_full_date,$month_2_array_full_date);
		$month_1_2_array = array_merge($month_1_array_full_date);
		
		if ( !empty($booked_ids) ) {
			
			foreach( $booked_ids as $key => $val) {

				echo '<tr class="sh_booking_data">';

					$booking_meta = get_post_meta( $val, '_booking_meta', true );

					echo '<td><a href="' . get_admin_url() . 'admin.php?page=booking_add&booking=' . $val . '">#' . $val . ' ' . $booking_meta["first_name"] . ' ' . $booking_meta["last_name"] . '</a></td>';

					foreach( $month_1_2_array as $key => $val) {
						
						if ( !empty($booking_meta["booking_status"]) ) {	
							if ( $booking_meta["booking_status"] == 1 ) {		
								$booking_status_class = 'pending';	
							} elseif ( $booking_meta["booking_status"] == 2 ) {
								$booking_status_class = 'confirmed';
							} elseif ( $booking_meta["booking_status"] == 3 ) {
								$booking_status_class = 'cancelled';
							} else {	
								$booking_status_class = 'unknown';	
							}
						} else {
							$booking_status_class = 'unknown';
						}
						
						if( $booking_meta["check_in"] == $val ) {
							echo '<td class="sh_first_day_' . $booking_status_class . '">&nbsp;</td>';
						} elseif( $booking_meta["check_out"] == $val ) {
							echo '<td class="sh_last_day_' . $booking_status_class . '">&nbsp;</td>';
						} elseif ( sh_get_date_range_overlap($val,$val,$booking_meta["check_in"],$booking_meta["check_out"]) == true ) {
							echo '<td class="sh_booking_' . $booking_status_class . '">&nbsp;</td>';
						} else {
							echo '<td>&nbsp;</td>';
						}

					}

			  echo '</tr>';

			}
			
		} else {
			
			echo '<tr class="sh_booking_data">';

				echo '<td>' . esc_html__( 'No bookings found', 'sohohotel_booking' ) . '</td>';
				echo '<td colspan="' . $month_1_day_count . '">' . esc_html__( 'No bookings found', 'sohohotel_booking' ) . '</td>';

		  echo '</tr>';
			
		}
		
	echo '</table>';
		
	echo '<ul class="booking_calendar_label_key">';
	echo '<li class="pending_label_key">' . esc_html__( 'Pending', 'sohohotel_booking' ) . '</li>';
	echo '<li class="confirmed_label_key">' . esc_html__( 'Confirmed', 'sohohotel_booking' ) . '</li>';
	echo '<li class="cancelled_label_key">' . esc_html__( 'Cancelled', 'sohohotel_booking' ) . '</li>';
	echo '</ul>';
	
	echo '</div>';
	
}