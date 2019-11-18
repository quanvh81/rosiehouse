<?php

function sohohotel_testimonials_carousel_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
			'posts_per_page' => '10',
			'order' => '',
			'border' => '',
			'type' => ''
		), $atts ) );

		global $post;
		global $wp_query;
		$prefix = 'sohohotel_';
		
		// Set testimonials displayed per page
		if ( $posts_per_page != '' ) {
			$posts_per_page = $posts_per_page;
		} else {
			$posts_per_page = '1';
		}

		// Set testimonials display order
		if ( $order == 'newest' ) {
			$order = 'DESC';
		} elseif ( $order == 'oldest' ) {
			$order = 'ASC';
		} else {
			$order = 'DESC';
		}
		
		// Set type
		if ( $type == '2' ) {
			$type = '2';
		} else {
			$type = '1';
		}
		
		// Set border
		if ( $border == '2' ) {
			$border = '2';
		} else {
			$border = '1';
		}

	ob_start(); ?>
	
		<!-- BEGIN .sohohotel-testimonial-wrapper -->
		<div class="sohohotel-testimonial-wrapper-<?php echo $type; ?> sohohotel-testimonials-border-<?php echo $border; ?>">

			<!-- BEGIN .sohohotel-testimonial-list- -->
			<div class="sohohotel-testimonial-list sohohotel-owl-carousel-1">

				<?php $args = array(
		            'posts_per_page' => $posts_per_page,
		            'post_type' => 'testimonial',
		            'order' => 'DESC',
		            'orderby' => 'date'
		        );

				$post_query = new WP_Query( $args );

				$sohohotel_count_total_posts = $post_query->post_count;

				if( $post_query->have_posts() ) : while( $post_query->have_posts() ) : $post_query->the_post(); ?>

					<?php
						// Get testimonial data
						$testimonial_name = get_post_meta($post->ID, $prefix.'testimonial_name', true);
						$testimonial_other_details = get_post_meta($post->ID, $prefix.'testimonial_other_details', true);			
					?>

					<!-- BEGIN .sohohotel-testimonial-block -->
					<div class="sohohotel-testimonial-block">
						
						<div>
							<span class="sohohotel-open-quote">“</span>
							<?php global $more;$more = 0;?>
							<?php the_excerpt(); ?>
							<span class="sohohotel-close-quote">”</span>
						</div>

						<?php if( has_post_thumbnail() ) { ?>

							<div class="sohohotel-testimonial-image">
								<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sohohotel-image-style7' ); ?>
								<?php echo '<img src="' . $src[0] . '" alt="" />'; ?>
							</div>

						<?php } ?>

						<div class="sohohotel-testimonial-author"><p><?php echo esc_textarea($testimonial_name); ?> - <?php echo esc_textarea($testimonial_other_details); ?></p></div>

					<!-- END .sohohotel-testimonial-block -->
					</div>

				<?php endwhile; endif; ?>

			<!-- END .sohohotel-testimonial-list -->
			</div>

		<!-- END .sohohotel-testimonial-wrapper -->
		</div>
	
	<?php return ob_get_clean();

}

add_shortcode( 'sohohotel_testimonials_carousel', 'sohohotel_testimonials_carousel_shortcode' );

?>