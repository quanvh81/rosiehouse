<?php

$update_status = false;

$args_update = array('post_type' => 'booking','posts_per_page' => '99999');
$update_id_array = array();
$wp_query_update = new WP_Query( $args_update );
if ($wp_query_update->have_posts()) :
	while($wp_query_update->have_posts()) :
		$wp_query_update->the_post();

			$date_filter_meta = get_post_meta( get_the_ID(), '_booking_meta', true );
			
			if( !empty($date_filter_meta['save_rooms']) && empty($date_filter_meta['check_in']) && empty($date_filter_meta['check_out']) ) {
				$json_data = $date_filter_meta['save_rooms'];
				$data = json_decode($json_data, true);
				
				$update_id_array[] = get_the_ID();	
				
				if( !empty($_GET["update_database"]) ) {
					
					if ( $_GET["update_database"] == 1 ) {
						
						foreach($data as $key => $val) {
							$date_filter_meta["check_in"] = $val['check_in'];
							$date_filter_meta["check_out"] = $val['check_out'];	
						}
						
						update_post_meta(get_the_ID(), '_booking_meta', $date_filter_meta);
						$update_status = true;
						
					}
					
				}
				
			}
			
	endwhile;
endif;

if ( $update_status == true ) { ?>
	
	<div id='sohohotel-booking-database-update' class='notice-warning settings-error notice is-dismissible'> 
		<p><strong><span><?php esc_html_e('Bookings database update completed!', 'sohohotel_booking'); ?></span></strong></p>
	</div>
	
<?php } elseif (!empty($update_id_array)) { ?>
	
	<div id='sohohotel-booking-database-update' class='notice-warning settings-error notice is-dismissible'> 
		<p><strong><span style="display: block; margin: 0.5em 0.5em 0 0; clear: both;"><?php esc_html_e('You need to update your bookings database, it is recommended you backup your database before updating.', 'sohohotel_booking'); ?></span><span style="display: block; margin: 0.5em 0.5em 0 0; clear: both;"><a href="<?php echo get_admin_url() . 'admin.php?page=booking_listing&update_database=1'; ?>"><?php esc_html_e('Update', 'sohohotel_booking'); ?></a></span></strong></p>
	</div>
	
<?php } ?>