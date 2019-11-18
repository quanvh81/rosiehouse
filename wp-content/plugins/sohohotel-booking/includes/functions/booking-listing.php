<?php

add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( esc_html__('Bookings', 'sohohotel_booking'), esc_html__('Bookings', 'sohohotel_booking'), 'manage_options', 'booking_listing', 'sohohotel_admin_booking_listing', 'dashicons-calendar', 6  );
	add_submenu_page('booking_listing', esc_html__('Booking List View', 'sohohotel_booking'), esc_html__('List View', 'sohohotel_booking'), 'manage_options', 'booking_listing', 'sohohotel_admin_booking_listing');
	add_submenu_page('booking_listing', esc_html__('Booking Calendar View', 'sohohotel_booking'), esc_html__('Calendar View', 'sohohotel_booking'), 'manage_options', 'booking_calendar', 'sohohotel_display_admin_booking_calendar');
	add_submenu_page('booking_listing', esc_html__('Add Booking', 'sohohotel_booking'), esc_html__('Add Booking', 'sohohotel_booking'), 'manage_options', 'booking_add', 'sohohotel_display_admin_booking_add');
}

function sohohotel_admin_booking_listing(){ 
	
	// Get paged from URL
	if ( !empty($_GET['post']) ) {
		
		if ( ($_GET['action'] != '-1') OR ($_GET['action'] != '-1' && $_GET['action2'] != '-1') ) {
			
			// Trash booking
			if ($_GET['action'] == 'trash') {
				foreach($_GET['post'] as $key => $val) {
					wp_trash_post( $val );
				}
			}
			
			// Restore booking
			if ($_GET['action'] == 'untrash') {
				foreach($_GET['post'] as $key => $val) {
					wp_untrash_post( $val );
				}
			}
			
			// Delete booking
			if ($_GET['action'] == 'delete') {
				foreach($_GET['post'] as $key => $val) {
					wp_delete_post( $val );
				}
			}
			
		} elseif ( $_GET['action2'] != '-1' && $_GET['action'] == '-1' ) {
			
			// Trash booking
			if ($_GET['action2'] == 'trash') {
				foreach($_GET['post'] as $key => $val) {
					wp_trash_post( $val );
				}
			}
			
			// Restore booking
			if ($_GET['action2'] == 'untrash') {
				foreach($_GET['post'] as $key => $val) {
					wp_untrash_post( $val );
				}
			}
			
			// Delete booking
			if ($_GET['action2'] == 'delete') {
				foreach($_GET['post'] as $key => $val) {
					wp_delete_post( $val );
				}
			}
			
		}
	
	} 
	
	// Get room from URL
	if ( !empty($_GET['room']) ) {
		
		if ( $_GET['room'] != '0') {
			$room_id = $_GET['room'];
		} else {
			$room_id = 0;
		}
	
	} else {
		
		$room_id = 0;
		
	}
	
	// Get paged from URL
	if ( !empty($_GET['paged']) ) {
		$get_paged = '&paged=' . $_GET['paged'];
	} else {
		$get_paged = '';
	}
	
	// Get orderby from URL
	if ( !empty($_GET['orderby']) ) {
		$get_orderby = '&' . $_GET['orderby'];
	} else {
		$get_orderby = '';
	}
	
	// Get order from URL
	if ( !empty($_GET['order']) ) {	
		$get_order = '&' . $_GET['order'];	
		if ( $_GET['order'] == 'asc' ) {
			$received_order = 'ASC';
		} else {
			$received_order = 'DESC';
		}	
	} else {		
		$get_order = '';
		$received_order = 'DESC';		
	}
	
	// Get booking status from URL
	if ( !empty($_GET['booking_status']) ) {
		$get_booking_status = '&booking_status=' . $_GET['booking_status'];
		$booking_status_url_val = $_GET['booking_status'];
	} else {
		$get_booking_status = '';
		$booking_status_url_val = '';
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
	
	// Set order links
	$order_asc_link = get_admin_url() . 'admin.php?page=booking_listing' . $get_paged . '&orderby=received&order=asc' . $get_booking_status . $get_room . $get_from_date . $get_to_date;
	$order_desc_link = get_admin_url() . 'admin.php?page=booking_listing' . $get_paged . '&orderby=received&order=desc' . $get_booking_status . $get_room . $get_from_date . $get_to_date;
	 
	// Set variables
	global $wp_query;
	$posts_per_page = 20;
	
	if ( !empty($_GET['paged']) ) {
		$paged = ( $_GET['paged'] ) ? $_GET['paged'] : 1;	
	} else {
		$paged = '';
	}
	
	// Query Booking Status
	$count_pending = 0;
	$count_confirmed = 0;
	$count_cancelled = 0;
	$count_ical = 0;
	
	// Set status ID arrays
	$pending_id_array = array();
	$confirmed_id_array = array();
	$cancelled_id_array = array();
	$ical_id_array = array();
	
	// Query bookings to count number of bookings for each status
	$args_status = array('post_type' => 'booking','posts_per_page' => '99999');
	$wp_query_status = new WP_Query( $args_status );
	if ($wp_query_status->have_posts()) : while($wp_query_status->have_posts()) :
		$wp_query_status->the_post(); 
		
		$status_meta = get_post_meta( get_the_ID(), '_booking_meta', true );
		
		// Pending
		if ( !empty($status_meta["booking_status"]) && $status_meta["booking_status"] == '1' && empty($status_meta['ical_data'])  ) {
			$count_pending++;
			$pending_id_array[] = get_the_ID();
		// Confirmed
		} elseif ( !empty($status_meta["booking_status"]) && $status_meta["booking_status"] == '2' && empty($status_meta['ical_data']) ) {
			$count_confirmed++;
			$confirmed_id_array[] = get_the_ID();
		// Cancelled
		} elseif ( !empty($status_meta["booking_status"]) && $status_meta["booking_status"] == '3' && empty($status_meta['ical_data'])) {
			$count_cancelled++;
			$cancelled_id_array[] = get_the_ID();
		} 
		// iCal
		if ( !empty($status_meta['ical_data']) ) {
			$count_ical++;
			$ical_id_array[] = get_the_ID();
		}

	endwhile;endif;
	wp_reset_query();
	
	// Query Trash Bookings
	$args_trash = array('post_type' => 'booking','post_status' => array('trash'));
	$wp_query_trash = new WP_Query( $args_trash );
	$count_trash = $wp_query_trash->found_posts;
	wp_reset_query();
	
	// Count All Bookings
	$count_all = ($count_pending + $count_confirmed + $count_cancelled + $count_ical);
	
	// Set booking status tab links
	$all_bookings_link = get_admin_url() . 'admin.php?page=booking_listing';
	$pending_bookings_link = get_admin_url() . 'admin.php?page=booking_listing&booking_status=pending';
	$confirmed_bookings_link = get_admin_url() . 'admin.php?page=booking_listing&booking_status=confirmed';
	$cancelled_bookings_link = get_admin_url() . 'admin.php?page=booking_listing&booking_status=cancelled';
	$ical_bookings_link = get_admin_url() . 'admin.php?page=booking_listing&booking_status=ical';
	$trash_bookings_link = get_admin_url() . 'admin.php?page=booking_listing&booking_status=trash';
	
	// Query Standard Booking Options
	if ( !empty($_GET["booking_status"]) ) {
		if ( $_GET["booking_status"] == 'trash' ) {
			$post_status_arg = array('trash');
			$post_in_array = array();
		} else {
			$post_status_arg = array('publish');
			if ($_GET["booking_status"] == 'pending') {
				$post_in_array = $pending_id_array;
			} elseif ($_GET["booking_status"] == 'confirmed') {
				$post_in_array = $confirmed_id_array;
			} elseif ($_GET["booking_status"] == 'cancelled') {
				$post_in_array = $cancelled_id_array;
			} elseif ($_GET["booking_status"] == 'ical') {
				$post_in_array = $ical_id_array;
			} else {
				$post_in_array = array();
			}
		}
	} else {
		$post_status_arg = array('publish');
		$post_in_array = array();
	}
	
	// Filter by room if set
	if ( !empty($room_id) ) {
		
		if ( $room_id != 0 ) {

			$args_room_filter = array('post_type' => 'booking','posts_per_page' => '9999', 'post__in' => $post_in_array);
			$post_in_array = array();
			$wp_query_room_filter = new WP_Query( $args_room_filter );
			if ($wp_query_room_filter->have_posts()) :
				while($wp_query_room_filter->have_posts()) :
					$wp_query_room_filter->the_post();

						$room_filter_meta = get_post_meta( get_the_ID(), '_booking_meta', true );
						$room_filter_booking_data_decoded = json_decode($room_filter_meta["save_rooms"], true);

						foreach($room_filter_booking_data_decoded as $key => $val) {
							$room_type = $val['room_type'];	
							if ( $room_id == $room_type ) {
								$post_in_array[] = get_the_ID();
							}
						}

				endwhile;
			endif;

			if (empty($post_in_array)) {
				$post_in_array = array('1' => 'none');
			}

		}
		
	}
	
	// Check both dates
	if ( !empty($_GET["from_date"]) && !empty($_GET["to_date"]) ) {
		
		if ( sh_date_check($_GET["from_date"]) == true && sh_date_check($_GET["to_date"]) == true ) {

			$args_date_filter = array('post_type' => 'booking','posts_per_page' => '9999', 'post__in' => $post_in_array);
			$post_in_array = array();
			$wp_query_date_filter = new WP_Query( $args_date_filter );
			if ($wp_query_date_filter->have_posts()) :
				while($wp_query_date_filter->have_posts()) :
					$wp_query_date_filter->the_post();

						$date_filter_meta = get_post_meta( get_the_ID(), '_booking_meta', true );

						if ( $date_filter_meta["check_in"] <= $_GET["to_date"] && $date_filter_meta["check_out"] >= $_GET["from_date"] ) {
							$post_in_array[] = get_the_ID();	
						}

				endwhile;
			endif;

			if (empty($post_in_array)) {
				$post_in_array = array('1' => 'none');
			}

		}
		
		// Check from date only
		elseif ( sh_date_check($_GET["from_date"]) == true && sh_date_check($_GET["to_date"]) == false ) {

			$args_date_filter = array('post_type' => 'booking','posts_per_page' => '9999', 'post__in' => $post_in_array);
			$post_in_array = array();
			$wp_query_date_filter = new WP_Query( $args_date_filter );
			if ($wp_query_date_filter->have_posts()) :
				while($wp_query_date_filter->have_posts()) :
					$wp_query_date_filter->the_post();

						$date_filter_meta = get_post_meta( get_the_ID(), '_booking_meta', true );

						if ( $date_filter_meta["check_in"] > $_GET["from_date"] ) {
							$post_in_array[] = get_the_ID();	
						}

				endwhile;
			endif;

			if (empty($post_in_array)) {
				$post_in_array = array('1' => 'none');
			}

		}

		// Check to date only
		elseif ( sh_date_check($_GET["from_date"]) == false && sh_date_check($_GET["to_date"]) == true ) {

			$args_date_filter = array('post_type' => 'booking','posts_per_page' => '9999', 'post__in' => $post_in_array);
			$post_in_array = array();
			$wp_query_date_filter = new WP_Query( $args_date_filter );
			if ($wp_query_date_filter->have_posts()) :
				while($wp_query_date_filter->have_posts()) :
					$wp_query_date_filter->the_post();

						$date_filter_meta = get_post_meta( get_the_ID(), '_booking_meta', true );

						if ( $date_filter_meta["check_out"] < $_GET["to_date"] ) {
							$post_in_array[] = get_the_ID();	
						}

				endwhile;
			endif;

			if (empty($post_in_array)) {
				$post_in_array = array('1' => 'none');
			}

		}
	
	}
	
	// Set search term
	if ( !empty($_GET["s"]) ) {
		$search_term = sanitize_title_for_query($_GET["s"]);
	} else {
		$search_term = '';
	}
	
	// Query Standard Bookings
	$args = array(
		'post_type' => 'booking',
		'posts_per_page' => $posts_per_page,
		'paged' => $paged,
		'order' => $received_order,
		'orderby' => 'date',
		'post_status' => $post_status_arg,
		'post__in' => $post_in_array,
		's' => $search_term
	);

	$wp_query = new WP_Query( $args );
	
	if ( !empty($_GET["booking_status"]) ) {
		if ($_GET["booking_status"] == 'pending') {
			
			if ($post_in_array[1] == 'none') {
				$found_posts = 0;
			} elseif (!empty($post_in_array)) {
				$found_posts = sizeof($post_in_array);
			} else {
				$found_posts = $count_pending; 
			}
			
			$booking_status = '1';
			
		} elseif ($_GET["booking_status"] == 'confirmed') {
			
			if ($post_in_array[1] == 'none') {
				$found_posts = 0;
			} elseif (!empty($post_in_array)) {
				$found_posts = sizeof($post_in_array);
			} else {
				$found_posts = $count_confirmed; 
			}
			
			$booking_status = '2';
			
		} elseif ($_GET["booking_status"] == 'cancelled') {
			
			if ($post_in_array[1] == 'none') {
				$found_posts = 0;
			} elseif (!empty($post_in_array)) {
				$found_posts = sizeof($post_in_array);
			} else {
				$found_posts = $count_cancelled; 
			}
			
			$booking_status = '3';
			
		} elseif ($_GET["booking_status"] == 'ical') {
			
			if ($post_in_array[1] == 'none') {
				$found_posts = 0;
			} elseif (!empty($post_in_array)) {
				$found_posts = sizeof($post_in_array);
			} else {
				$found_posts = $count_ical; 
			}
			
			$booking_status = '3';
			
		} else {
			$booking_status = 'all';
			$found_posts = $wp_query->found_posts; 
		}
	} else {
		$booking_status = 'all';
		$found_posts = $wp_query->found_posts; 
	} ?>
	
	<?php include(sohohotel_booking_BASE_DIR . '/includes/functions/booking-updater.php'); ?>
	
	<!-- BEGIN .wrap -->
	<div class="wrap">
		
		<h1 class="wp-heading-inline"><?php esc_html_e('Bookings', 'sohohotel_booking'); ?></h1>
		<a href="<?php echo get_admin_url() . 'admin.php?page=booking_add'; ?>" class="page-title-action"><?php esc_html_e('Add Booking', 'sohohotel_booking'); ?></a>
		
		<?php if ( !empty($_GET["s"]) ) {echo '<span class="subtitle">' . esc_html__('Search results for', 'sohohotel_booking') . ' &#8220;' . $_GET["s"] . '&#8221;</span>';} ?>
		
		<hr class="wp-header-end" />
		
		<!-- BEGIN .subsubsub -->
		<ul class='subsubsub'>
			
			<li class='all'>
				<?php if($count_all > 0) { ?>
					<a href="<?php echo $all_bookings_link; ?>" <?php if ($booking_status_url_val == 'all' OR empty($_GET["booking_status"]) ) {echo 'class="current"';} ?> aria-current="page"><?php esc_html_e('All', 'sohohotel_booking'); ?> <span class="count">(<?php echo $count_all; ?>)</span></a> |
				<?php } else { ?>
					<?php esc_html_e('All', 'sohohotel_booking'); ?> <span class="count">(<?php echo $count_all; ?>)</span> |
				<?php } ?>
			</li>
			
			<li class='pending'>
				<?php if($count_pending > 0) { ?>
					<a href="<?php echo $pending_bookings_link; ?>" <?php if ($booking_status_url_val == 'pending' ) {echo 'class="current"';} ?>><?php esc_html_e('Pending', 'sohohotel_booking'); ?> <span class="count">(<?php echo $count_pending; ?>)</span></a> |
				<?php } else { ?>
					<?php esc_html_e('Pending', 'sohohotel_booking'); ?> <span class="count">(<?php echo $count_pending; ?>)</span> |
				<?php } ?>
			</li>
			
			<li class='confirmed'>
				<?php if($count_confirmed > 0) { ?>
					<a href="<?php echo $confirmed_bookings_link; ?>" <?php if ($booking_status_url_val == 'confirmed' ) {echo 'class="current"';} ?>><?php esc_html_e('Confirmed', 'sohohotel_booking'); ?> <span class="count">(<?php echo $count_confirmed; ?>)</span></a> |
				<?php } else { ?>
					<?php esc_html_e('Confirmed', 'sohohotel_booking'); ?> <span class="count">(<?php echo $count_confirmed; ?>)</span> |
				<?php } ?>
			</li>
			
			<li class='cancelled'>
				<?php if($count_cancelled > 0) { ?>
					<a href="<?php echo $cancelled_bookings_link; ?>" <?php if ($booking_status_url_val == 'cancelled' ) {echo 'class="current"';} ?>><?php esc_html_e('Cancelled', 'sohohotel_booking'); ?> <span class="count">(<?php echo $count_cancelled; ?>)</span></a> |
				<?php } else { ?>
					<?php esc_html_e('Cancelled', 'sohohotel_booking'); ?> <span class="count">(<?php echo $count_cancelled; ?>)</span> |
				<?php } ?>
			</li>
			
			<li class='ical'>
				<?php if($count_ical > 0) { ?>
					<a href="<?php echo $ical_bookings_link; ?>" <?php if ($booking_status_url_val == 'ical' ) {echo 'class="current"';} ?>><?php esc_html_e('iCal', 'sohohotel_booking'); ?> <span class="count">(<?php echo $count_ical; ?>)</span></a> |
				<?php } else { ?>
					<?php esc_html_e('iCal', 'sohohotel_booking'); ?> <span class="count">(<?php echo $count_ical; ?>)</span> |
				<?php } ?>
			</li>
			
			<li class='trash'>
				<?php if($count_trash > 0) { ?>
					<a href="<?php echo $trash_bookings_link; ?>" <?php if ($booking_status_url_val == 'trash' ) {echo 'class="current"';} ?>><?php esc_html_e('Trash', 'sohohotel_booking'); ?> <span class="count">(<?php echo $count_trash; ?>)</span></a>
				<?php } else { ?>
					<?php esc_html_e('Trash', 'sohohotel_booking'); ?> <span class="count">(<?php echo $count_trash; ?>)</span>
				<?php } ?>
			</li>
			
		<!-- END .subsubsub -->
		</ul>
		
		<!-- BEGIN #posts-filter -->
		<form id="posts-filter" action="<?php echo get_admin_url() . 'admin.php?page=booking_listing'; ?>" method="get">
			
			<?php if(!empty($_GET["page"])) { ?>
			<input type="hidden" name="page" value="booking_listing" />
			<?php } ?>
			
			<?php if(!empty($_GET["booking_status"])) { ?>
			<input type="hidden" name="booking_status" value="<?php if(!empty($_GET["booking_status"])) {echo $_GET["booking_status"];} ?>" />
			<?php } ?>
			
			<?php if(!empty($_GET["order"])) { ?>
			<input type="hidden" name="order" value="<?php if(!empty($_GET["order"])) {echo $_GET["order"];} ?>" />	
			<?php } ?>
			
			<?php if(!empty($_GET["orderby"])) { ?>
			<input type="hidden" name="orderby" value="<?php if(!empty($_GET["orderby"])) {echo $_GET["orderby"];} ?>" />	
			<?php } ?>
			
			<?php if ( !empty($_GET["booking_status"]) ) {
			
				if ($_GET["booking_status"] != 'trash') { ?>
			
					<p class="search-box">
						<input type="search" id="post-search-input" name="s" value="<?php if ( !empty($_GET["s"]) ) {echo $_GET["s"];} ?>" />
						<input type="submit" id="search-submit" class="button" value="<?php esc_html_e('Search Guest', 'sohohotel_booking'); ?>"  />
					</p>
			
				<?php }
				
			} else { ?>
			
				<p class="search-box">
					<input type="search" id="post-search-input" name="s" value="<?php if ( !empty($_GET["s"]) ) {echo $_GET["s"];} ?>" />
					<input type="submit" id="search-submit" class="button" value="<?php esc_html_e('Search Guest', 'sohohotel_booking'); ?>"  />
				</p>
				
			<?php } ?>
			
			<!-- BEGIN .tablenav -->
			<div class="tablenav top">
				
				<!-- BEGIN .bulkactions -->
				<div class="alignleft actions bulkactions">
					
						<select name="action" id="bulk-action-selector-bottom">
						
						<?php if ( !empty($_GET["booking_status"]) ) { ?>
							
							<?php if ( $_GET["booking_status"] == 'trash' ) { ?>
						
								<option value="-1"><?php esc_html_e('Bulk Actions', 'sohohotel_booking'); ?></option>
								<option value="untrash"><?php esc_html_e('Restore', 'sohohotel_booking'); ?></option>
								<option value="delete"><?php esc_html_e('Delete Permanently', 'sohohotel_booking'); ?></option>
								
						
							<?php } else { ?>
							
								<option value="-1"><?php esc_html_e('Bulk Actions', 'sohohotel_booking'); ?></option>
								<option value="trash"><?php esc_html_e('Move to Trash', 'sohohotel_booking'); ?></option>
							
							<?php } ?>
						
						<?php  } else { ?>
							
							<option value="-1"><?php esc_html_e('Bulk Actions', 'sohohotel_booking'); ?></option>
							<option value="trash"><?php esc_html_e('Move to Trash', 'sohohotel_booking'); ?></option>
							
						<?php } ?>
						
						</select>
					<input type="submit" id="doaction" class="button action" value="<?php esc_html_e('Apply', 'sohohotel_booking'); ?>"  />
					
				<!-- END .bulkactions -->
				</div>
				
				<!-- BEGIN .actions -->
				<div class="alignleft actions">
				
					<?php if ( !empty($_GET["booking_status"]) ) {
						if ($_GET["booking_status"] != 'trash') { ?>

							<select name='room' id='room' class='postform'>
								<option value='0'><?php esc_html_e('All rooms', 'sohohotel_booking'); ?></option>

								<?php $args_accommodation = array('post_type' => 'accommodation','posts_per_page' => '9999');
								$wp_query_accommodation = new WP_Query( $args_accommodation );
								if ($wp_query_accommodation->have_posts()) :
									while($wp_query_accommodation->have_posts()) :
										$wp_query_accommodation->the_post(); ?>
										<option value="<?php echo get_the_ID(); ?>" <?php if ( $room_id != 0 ) {if ( $room_id == get_the_ID() ) {echo 'selected';}} ?>><?php echo get_the_title(); ?></option>
									<?php endwhile;
								endif; ?>

							</select><input type="text" class="datepicker check_in" placeholder="<?php if ( !empty($_GET["from_date"]) ) {echo sh_display_formatted_date( $_GET["from_date"] ); } else {echo esc_html__('From (Any Date)', 'sohohotel_booking');} ?>" value="<?php if ( !empty($_GET["from_date"]) ) {echo sh_display_formatted_date( $_GET["from_date"] ); } ?>" /><input type="text" class="datepicker check_out" placeholder="<?php if ( !empty($_GET["to_date"]) ) {echo sh_display_formatted_date( $_GET["to_date"] ); } else {echo esc_html__('To (Any Date)', 'sohohotel_booking');} ?>" value="<?php if ( !empty($_GET["to_date"]) ) {echo sh_display_formatted_date( $_GET["to_date"] ); } ?>" /><input type="submit" name="filter_action" id="post-query-submit" class="button" value="<?php esc_html_e('Filter', 'sohohotel_booking'); ?>"  />
							
							<input type="text" class="check_in_alt" name="from_date" placeholder="<?php if ( !empty($_GET["from_date"]) ) {echo $_GET["from_date"]; } else {echo esc_html__('From (Any Date)', 'sohohotel_booking');} ?>" value="<?php if ( !empty($_GET["from_date"]) ) {echo $_GET["from_date"]; } ?>" />
							
							<input type="text" class="check_out_alt" name="to_date" placeholder="<?php if ( !empty($_GET["to_date"]) ) {echo $_GET["to_date"]; } else {echo esc_html__('To (Any Date)', 'sohohotel_booking');} ?>" value="<?php if ( !empty($_GET["to_date"]) ) {echo $_GET["to_date"]; } ?>" />
							
						<?php } ?>
					<?php } else { ?>
						
						<select name='room' id='room' class='postform'>
							<option value='0'><?php esc_html_e('All rooms', 'sohohotel_booking'); ?></option>

							<?php $args_accommodation = array('post_type' => 'accommodation','posts_per_page' => '9999');
							$wp_query_accommodation = new WP_Query( $args_accommodation );
							if ($wp_query_accommodation->have_posts()) :
								while($wp_query_accommodation->have_posts()) :
									$wp_query_accommodation->the_post(); ?>
									<option value="<?php echo get_the_ID(); ?>" <?php if ( $room_id != 0 ) {if ( $room_id == get_the_ID() ) {echo 'selected';}} ?>><?php echo get_the_title(); ?></option>
								<?php endwhile;
							endif; ?>

						</select><input type="text" class="datepicker check_in" placeholder="<?php if ( !empty($_GET["from_date"]) ) {echo sh_display_formatted_date( $_GET["from_date"] ); } else {echo esc_html__('From (Any Date)', 'sohohotel_booking');} ?>" value="<?php if ( !empty($_GET["from_date"]) ) {echo sh_display_formatted_date( $_GET["from_date"] ); } ?>" /><input type="text" class="datepicker check_out" placeholder="<?php if ( !empty($_GET["to_date"]) ) {echo sh_display_formatted_date( $_GET["to_date"] ); } else {echo esc_html__('To (Any Date)', 'sohohotel_booking');} ?>" value="<?php if ( !empty($_GET["to_date"]) ) {echo sh_display_formatted_date( $_GET["to_date"] ); } ?>" /><input type="submit" name="filter_action" id="post-query-submit" class="button" value="<?php esc_html_e('Filter', 'sohohotel_booking'); ?>"  />
						
						<input type="text" class="check_in_alt" name="from_date" placeholder="<?php if ( !empty($_GET["from_date"]) ) {echo $_GET["from_date"]; } else {echo esc_html__('From (Any Date)', 'sohohotel_booking');} ?>" value="<?php if ( !empty($_GET["from_date"]) ) {echo $_GET["from_date"]; } ?>" />
						
						<input type="text" class="check_out_alt" name="to_date" placeholder="<?php if ( !empty($_GET["to_date"]) ) {echo $_GET["to_date"]; } else {echo esc_html__('To (Any Date)', 'sohohotel_booking');} ?>" value="<?php if ( !empty($_GET["to_date"]) ) {echo $_GET["to_date"]; } ?>" />
						
					<?php } ?>
				
				<!-- END .actions -->
				</div>
				
				<?php sh_admin_pagination($paged,$found_posts,'admin.php?page=booking_listing',$posts_per_page,'top'); ?>
				
			<!-- END .tablenav -->
			</div>
				
			<!-- BEGIN .wp-list-table -->
			<table class="wp-list-table widefat fixed striped posts">
				
				<!-- BEGIN thead -->
				<thead>
					
					<tr>
						
						<td id='cb' class='manage-column column-cb check-column'>	
							<input id="cb-select-all-1" type="checkbox" />
						</td>
						
						<th scope="col" id='booking' class='column-booking column-primary'><?php esc_html_e('Booking', 'sohohotel_booking'); ?></th>
						
						<th scope="col" id='room' class='column-room'><?php esc_html_e('Room', 'sohohotel_booking'); ?></th>
						<th scope="col" id='checkin' class='column-categories'><?php esc_html_e('Check In', 'sohohotel_booking'); ?></th>
						<th scope="col" id='checkout' class='column-checkout'><?php esc_html_e('Check Out', 'sohohotel_booking'); ?></th>
						
						<th scope="col" id='received' class='manage-column column-received sortable <?php if ( !empty($_GET['order']) ) {if ( $_GET['order'] == 'asc' ) {echo 'asc';} else {echo 'desc';}}else{echo 'desc';} ?>'>
							<a href="<?php if ( !empty($_GET['order']) ) {if ( $received_order == 'ASC' ) {echo $order_desc_link;} else {echo $order_asc_link;}}else{echo $order_asc_link;} ?>"><span><?php esc_html_e('Received', 'sohohotel_booking'); ?></span><span class="sorting-indicator"></span></a>
						</th>
						
						<th scope="col" id='status' class='column-status'><?php esc_html_e('Status', 'sohohotel_booking'); ?></th>
						<th scope="col" id='actions' class='column-actions'><?php esc_html_e('Actions', 'sohohotel_booking'); ?></th>
						
					</tr>
				
				<!-- END thead -->
				</thead>
				
				<!-- BEGIN .the-list -->
				<tbody id="the-list">
					
					<?php if ($wp_query->have_posts()) :
						while($wp_query->have_posts()) :
						$wp_query->the_post(); 
						$booking_meta = get_post_meta( get_the_ID(), '_booking_meta', true );
						
						if(!empty($booking_meta['ical_data'])) {
							
							foreach ($booking_meta['ical_data'] as $key => $val) {
			
								if ( $key == 'SUMMARY'  ) {
									$ical_summery = $val;
								} 
								
								if ( $key == 'LOCATION'  ) {
									$ical_location = $val;
								} 
			
							}
							
							$ical_domain = parse_url($booking_meta["feed_url"]);
							$ical_domain_clean = preg_replace('#^www\.(.+\.)#i', '$1', $ical_domain['host']);
							
							$ical_booking = '[' . $ical_domain_clean . ']<span class="ical_summary">' . $ical_summery . '</span><span class="ical_location">' . $ical_location . '</span>';
						} else {
							$ical_booking = '';
						}
						
						if ( !empty($booking_meta["first_name"]) && !empty($booking_meta["last_name"]) ) {
							$booking_name = $booking_meta["first_name"] . ' ' . $booking_meta["last_name"];
							
							if ( !empty($_GET["booking_status"]) ) {
								if ( $_GET["booking_status"] == 'trash' ) {
									$booking_title_link = '#' . get_the_ID() . ' ' . $booking_name . ' ' . $ical_booking;
								} else {
									$booking_title_link = '<a class="row-title" title="' . esc_html__('View Booking', 'sohohotel_booking') . '" href="' . get_admin_url() . 'admin.php?page=booking_add&booking=' . get_the_ID() . '">#' . get_the_ID() . ' ' . $booking_name . ' ' . $ical_booking . '</a>';
								}
							} else {
								$booking_title_link = '<a class="row-title" title="' . esc_html__('View Booking', 'sohohotel_booking') . '" href="' . get_admin_url() . 'admin.php?page=booking_add&booking=' . get_the_ID() . '">#' . get_the_ID() . ' ' . $booking_name . ' ' . $ical_booking . '</a>';
							}
							
						} else {
							
							if ( !empty($_GET["booking_status"]) ) {
								if ( $_GET["booking_status"] == 'trash' ) {
									$booking_title_link = '#' . get_the_ID() . ' ' . $ical_booking;
								} else {
									$booking_title_link = '<a class="row-title" title="' . esc_html__('View Booking', 'sohohotel_booking') . '" href="' . get_admin_url() . 'admin.php?page=booking_add&booking=' . get_the_ID() . '">#' . get_the_ID() . ' ' . $ical_booking . '</a>';
								}
							} else {
								$booking_title_link = '<a class="row-title" title="' . esc_html__('View Booking', 'sohohotel_booking') . '" href="' . get_admin_url() . 'admin.php?page=booking_add&booking=' . get_the_ID() . '">#' . get_the_ID() . ' ' . $ical_booking . '</a>';
							}
								
						} ?>

						<!-- BEGIN booking -->
						<tr id="post-<?php echo get_the_ID(); ?>" class="post-<?php echo get_the_ID(); ?> type-post">

							<th scope="row" class="check-column">
								<input id="cb-select-<?php echo get_the_ID(); ?>" type="checkbox" name="post[]" value="<?php echo get_the_ID(); ?>" />
							</th>

							<td class="booking column-booking column-primary" data-colname="<?php esc_html_e('Booking', 'sohohotel_booking'); ?>">
								<?php echo $booking_title_link; ?>
								<button type="button" class="toggle-row"><span class="screen-reader-text"><?php esc_html_e('Show more details', 'sohohotel_booking'); ?></span></button>
							</td>

							<td class='room column-room' data-colname="<?php esc_html_e('Room', 'sohohotel_booking'); ?>">

								<?php $room_booking_data_decoded = json_decode($booking_meta["save_rooms"], true);
								$room_booking_data_decoded_count = count($room_booking_data_decoded);

								foreach($room_booking_data_decoded as $key => $val) {

									$room_key = preg_replace('/[^0-9]/', '', $key);
									$room_type = $val['room_type'];	

									if ( $room_booking_data_decoded_count > $room_key ) {
										$room_space = ', ';
									} else {
										$room_space = '';
									}

									if ( empty( $room_type ) ) {
										echo esc_html__( 'Unknown' ) . $room_space;
									} else {
										echo '<a title="' . esc_html__('View Room', 'sohohotel_booking') . '" target="_blank" href="' . get_permalink($room_type) . '">' . get_the_title($room_type) . '</a>' . $room_space;
									}

								} ?>

							</td>

							<td class='checkin column-checkin' data-colname="<?php esc_html_e('Check In', 'sohohotel_booking'); ?>">
								<?php $check_in = sh_display_formatted_date( $booking_meta["check_in"] );

								if ( empty( $check_in ) ) {
									echo esc_html__('Unknown', 'sohohotel_booking');
								} else {
									echo $check_in;
								} ?>
							</td>

							<td class='checkout column-checkout' data-colname="<?php esc_html_e('Check Out', 'sohohotel_booking'); ?>">
								<?php $check_out = sh_display_formatted_date( $booking_meta["check_out"] );

								if ( empty( $check_out ) ) {
									echo esc_html__('Unknown', 'sohohotel_booking');
								} else {
									echo $check_out;
								} ?>
							</td>

							<td class='comments column-received' data-colname="<?php esc_html_e('Received', 'sohohotel_booking'); ?>">
								<?php echo sh_get_time_elapsed( get_the_date('Y-m-d H:i:s') ); ?>
							</td>

							<td class='date column-status' data-colname="<?php esc_html_e('Status', 'sohohotel_booking'); ?>">
								<?php $booking_status = $booking_meta["booking_status"];
								
								if ( !empty($_GET["booking_status"]) ) {
									
									if ( $_GET["booking_status"] == 'trash' ) {
										echo '<span class="booking-status-trash">' . esc_html__('Trash', 'sohohotel_booking') . '</span>';
									} else {
										
										if ( empty( $booking_status ) ) {
											echo '<span class="booking-status-unknown">' . esc_html__('Unknown', 'sohohotel_booking') . '</span>';
										} else {

											if ($booking_status == '1') {
												echo '<span class="booking-status-pending">' . esc_html__('Pending', 'sohohotel_booking') . '</span>';
											} elseif ($booking_status == '2') {
												echo '<span class="booking-status-confirmed">' . esc_html__('Confirmed', 'sohohotel_booking') . '</span>';
											} elseif ($booking_status == '3') {
												echo '<span class="booking-status-cancelled">' . esc_html__('Cancelled', 'sohohotel_booking') . '</span>';
											}

										}
										
									}
								
								} else {
									
									if ( empty( $booking_status ) ) {
										echo '<span class="booking-status-unknown">' . esc_html__('Unknown', 'sohohotel_booking') . '</span>';
									} else {

										if ($booking_status == '1') {
											echo '<span class="booking-status-pending">' . esc_html__('Pending', 'sohohotel_booking') . '</span>';
										} elseif ($booking_status == '2') {
											echo '<span class="booking-status-confirmed">' . esc_html__('Confirmed', 'sohohotel_booking') . '</span>';
										} elseif ($booking_status == '3') {
											echo '<span class="booking-status-cancelled">' . esc_html__('Cancelled', 'sohohotel_booking') . '</span>';
										}

									}
									
								} ?>
							</td>

							<td class='date column-actions' data-colname="<?php esc_html_e('Actions', 'sohohotel_booking'); ?>">
								
								<?php if ( !empty($_GET["booking_status"]) ) {
									
									if ( $_GET["booking_status"] == 'trash' ) {
										
										echo '<div class="sh-row-actions">';
										echo '<a href="' . sh_untrash_post( get_the_ID() ) . '">' . esc_html__('Restore', 'sohohotel_booking') . '</a> | ';
										echo '<a href="' . sh_delete_post( get_the_ID() ) . '">' . esc_html__('Delete', 'sohohotel_booking') . '</a>';
										echo '</div>';
										
									} else {
										
										echo '<div class="sh-row-actions">';
										echo '<a href="' . sh_trash_post( get_the_ID() ) . '">' . esc_html__('Trash', 'sohohotel_booking') . '</a>';
										echo '</div>';
										
									}
									
								} else {
									
									echo '<div class="sh-row-actions">';
									echo '<a href="' . sh_trash_post( get_the_ID() ) . '">' . esc_html__('Trash', 'sohohotel_booking') . '</a>';
									echo '</div>';
									
								} ?>
								
							</td>

						<!-- END booking -->
						</tr>		
								
						<?php endwhile;
						else : ?>
					
							<tr class="no-items"><td class="colspanchange" colspan="8"><?php esc_html_e('No bookings found','sohohotel_booking'); ?></td></tr>
							
						<?php endif; ?>
						
						</tbody>

						<tfoot>

							<tr>

								<td id='cb' class='manage-column column-cb check-column'>	
									<input id="cb-select-all-1" type="checkbox" />
								</td>

								<th scope="col" id='booking' class='column-booking column-primary'><?php esc_html_e('Booking', 'sohohotel_booking'); ?></th>

								<th scope="col" id='room' class='column-room'><?php esc_html_e('Room', 'sohohotel_booking'); ?></th>
								<th scope="col" id='checkin' class='column-categories'><?php esc_html_e('Check In', 'sohohotel_booking'); ?></th>
								<th scope="col" id='checkout' class='column-checkout'><?php esc_html_e('Check Out', 'sohohotel_booking'); ?></th>

								<th scope="col" id='received' class='manage-column column-received sortable <?php if ( !empty($_GET['order']) ) {if ( $_GET['order'] == 'asc' ) {echo 'asc';} else {echo 'desc';}}else{echo 'desc';} ?>'>
									<a href="<?php if ( !empty($_GET['order']) ) {if ( $received_order == 'ASC' ) {echo $order_desc_link;} else {echo $order_asc_link;}}else{echo $order_asc_link;} ?>"><span><?php esc_html_e('Received', 'sohohotel_booking'); ?></span><span class="sorting-indicator"></span></a>
								</th>

								<th scope="col" id='status' class='column-status'><?php esc_html_e('Status', 'sohohotel_booking'); ?></th>
								<th scope="col" id='actions' class='column-actions'><?php esc_html_e('Actions', 'sohohotel_booking'); ?></th>

							</tr>

						</tfoot>

					</table>

					<div class="tablenav bottom">

						<div class="alignleft actions bulkactions">
							
							<select name="action2" id="bulk-action-selector-bottom">
							
							<?php if ( !empty($_GET["booking_status"]) ) { ?>
								
								<?php if ( $_GET["booking_status"] == 'trash' ) { ?>
							
									<option value="-1"><?php esc_html_e('Bulk Actions', 'sohohotel_booking'); ?></option>
									<option value="untrash"><?php esc_html_e('Restore', 'sohohotel_booking'); ?></option>
									<option value="delete"><?php esc_html_e('Delete Permanently', 'sohohotel_booking'); ?></option>
									
							
								<?php } else { ?>
								
									<option value="-1"><?php esc_html_e('Bulk Actions', 'sohohotel_booking'); ?></option>
									<option value="trash"><?php esc_html_e('Move to Trash', 'sohohotel_booking'); ?></option>
								
								<?php } ?>
							
							<?php  } else { ?>
								
								<option value="-1"><?php esc_html_e('Bulk Actions', 'sohohotel_booking'); ?></option>
								<option value="trash"><?php esc_html_e('Move to Trash', 'sohohotel_booking'); ?></option>
								
							<?php } ?>
							
							</select>
							
							<input type="submit" id="doaction2" class="button action" value="<?php esc_html_e('Apply', 'sohohotel_booking'); ?>"  />
							
						</div>
						<div class="alignleft actions">

					</div>

				<?php sh_admin_pagination($paged,$found_posts,'admin.php?page=booking_listing',$posts_per_page,'bottom'); ?>

			</div>
			
			<!-- END #posts-filter -->
			</form>

	<?php 
	
} ?>