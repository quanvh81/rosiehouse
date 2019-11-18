<?php

function sh_booking_process_frontend_action_callback() {
	
	global $post;
	
	// Set variables
	$booking_step_wrapper = '';	
	$booking_main = '';	
	$booking_side = '';
	
	// Edit button on booking step 2 is clicked
	if ( !empty($_POST["edit_step_2"]) ) {
		
		$booking_step_wrapper .= sh_display_booking_steps('1');
		$booking_main .= sh_display_bs1_main($_POST);
		$booking_side .= sh_display_bs1_sidebar($_POST);
		
	} else {
		
		// Store booking step 1 data
		if ( !empty($_POST["book_room"]) ) {

			// Reset temp booking data
			$_SESSION['sh_booking_data'] = '';

			$room_data = $_POST;
			sh_store_bs1_data_temp($room_data);

		}

		// Store booking step 2 data
		if ( !empty($_POST["room_" . sh_get_current_room() . "_selection"]) ) {
			sh_store_bs2_data_temp($_POST["room_" . sh_get_current_room() . "_selection"],sh_get_current_room());
		}

		if ( $_POST["booking_payment_hidden"] ) {

			if ( $_POST["payment_method"] == 'stripe' ) {
				$booking_step_wrapper .= sh_display_booking_steps('3');
			} else {
				$booking_step_wrapper .= sh_display_booking_steps('4');
			}

			$booking_main .= sh_display_bs4_main($_POST);
			$booking_side .= sh_display_bs4_sidebar($_POST);

		} else {

			if ( $_POST["apply_coupon_hidden"] ) {

				$booking_main .= sh_store_services_data_temp($_POST);
				$booking_step_wrapper .= sh_display_booking_steps('3');
				$booking_main .= sh_display_bs3_main($_POST);
				$booking_side .= sh_display_bs3_sidebar($_POST);

			} else {

				// Edit room
				if ( $_POST["edit_room_data"] ) {

					sh_edit_room($_POST["edit_room_data"]);
					$booking_step_wrapper .= sh_display_booking_steps('2');
					$booking_main .= sh_display_bs2_main();
					$booking_side .= sh_display_bs2_sidebar();

				} else {

					// Display booking step 3
					if ( $_POST["select_services"] ) {
						$booking_main .= sh_store_services_data_temp($_POST);
						$booking_step_wrapper .= sh_display_booking_steps('3');
						$booking_main .= sh_display_bs3_main($_POST);
						$booking_side .= sh_display_bs3_sidebar($_POST);

					} else {

						// Display booking step 2 services
						if ( sh_get_current_room() > $_SESSION['sh_booking_data']['book_room'] ) {

							// If services exist display services
							if ( sh_services_exist() > 0 ) {

								$booking_step_wrapper .= sh_display_booking_steps('2');
								$booking_main .= sh_display_bs2_main_services();
								$booking_side .= sh_display_bs2_sidebar();

							// If user clicks "Edit Booking" on booking step 3
							} elseif ( $_POST["edit_booking_data"] ) {

								$booking_step_wrapper .= sh_display_booking_steps('2');
								$booking_main .= sh_display_bs2_main_services();
								$booking_side .= sh_display_bs2_sidebar();

							// Display booking step 3
							} else {

								$booking_main .= sh_store_services_data_temp($_POST);
								$booking_step_wrapper .= sh_display_booking_steps('3');
								$booking_main .= sh_display_bs3_main($_POST);
								$booking_side .= sh_display_bs3_sidebar($_POST);

							}

						// Display booking step 2 rooms
						} else {
							$booking_step_wrapper .= sh_display_booking_steps('2');
							$booking_main .= sh_display_bs2_main();
							$booking_side .= sh_display_bs2_sidebar();

						}

					}

				}

			}

		}
		
	}
	
	// AJAX response
	$resp = array('booking_step_wrapper' => $booking_step_wrapper, 'booking_main' => $booking_main, 'booking_side' => $booking_side);
	header( "Content-Type: application/json" );
	echo json_encode($resp);
	die();

}

add_action( 'wp_ajax_sh_booking_process_frontend_action_callback', 'sh_booking_process_frontend_action_callback' );
add_action( 'wp_ajax_nopriv_sh_booking_process_frontend_action_callback', 'sh_booking_process_frontend_action_callback' );

?>