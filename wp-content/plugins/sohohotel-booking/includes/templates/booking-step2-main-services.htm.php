<form name="bookroom" class="booking-form-data">

	<?php global $post;
	global $wp_query; ?>
	
	<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
	'post_type' => 'service',
	'posts_per_page' => '9999',
	'paged' => $paged
	);

	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) : ?>
	
	<h4><?php esc_html_e('Services','sohohotel_booking'); ?></h4>
	<div class="title-block-3"></div>
	
	<!-- BEGIN .booking-services-wrapper -->
	<div class="booking-services-wrapper clearfix">
	
		<?php while($wp_query->have_posts()) :
			$wp_query->the_post();
				
				// Reset services session
				$_SESSION['sh_booking_data']["services"] = array();
				
				// Get service data
				$service_meta = get_post_meta($post->ID,'_service_meta',TRUE); ?>
			
				<?php if($service_meta['optional_mandatory'] == 'mandatory') { ?>
					
					<div class="booking-service booking-service-mandatory clearfix">	
						<input type="checkbox" name="service_<?php echo the_ID(); ?>" class="fl" value="1" checked />
						<label for="service_<?php echo the_ID(); ?>" class="fl"><?php echo get_the_title() . ' <span>(' . sh_get_price($service_meta['price']) . ' / ' . sh_get_service_name($service_meta['price_scheme_1']) . ' / ' . sh_get_service_name($service_meta['price_scheme_2']) . ')</span>'; ?></label>
					</div>
					
				<?php } else { ?>
				
					<div class="booking-service clearfix">	
						<input type="checkbox" name="service_<?php echo the_ID(); ?>" class="fl" />
						<label for="service_<?php echo the_ID(); ?>" class="fl"><?php echo get_the_title() . ' <span>(' . sh_get_price($service_meta['price']) . ' / ' . sh_get_service_name($service_meta['price_scheme_1']) . ' / ' . sh_get_service_name($service_meta['price_scheme_2']) . ')</span>'; ?></label>
					</div>
				
				<?php } ?>

		<?php endwhile; ?>
		
		<!-- END .booking-services-wrapper -->
		</div>

		<hr class="space8" />
		
		<?php endif;
	wp_reset_query(); ?>
	
	<input type="hidden" name="action" value="sh_booking_process_frontend_action_callback" />
	<?php echo wp_nonce_field('sh_booking_process_frontend', '_acf_nonce', true, false); ?>
	<button class="select-services" type="submit"><?php esc_html_e('Continue To Payment','sohohotel_booking'); ?></button>
	
	<input type="hidden" name="select_services" value="true" />
	<input type="hidden" name="edit_room_data" class="edit-room-field" value="" />
	<input type="hidden" name="edit_step_2" class="edit-step-2" value="" />
	
</form>