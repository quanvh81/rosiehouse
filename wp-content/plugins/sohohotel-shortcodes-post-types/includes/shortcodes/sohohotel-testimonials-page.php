<?php

function sohohotel_testimonials_page_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'posts_per_page' => '',
		'order' => ''
	), $atts ) );
	
	global $post;
	global $wp_query;
	$prefix = 'sohohotel_';
	
	// Set Testimonials Displayed Per Page
	if ( $posts_per_page != '' ) {
		$posts_per_page = $posts_per_page;
	} else {
		$posts_per_page = '1';
	}
	
	// Set Testimonials Display Order
	if ( $order == 'newest' ) {
		$testimonials_order = 'DESC';
	} elseif ( $order == 'oldest' ) {
		$testimonials_order = 'ASC';
	} else {
		$testimonials_order = 'DESC';
	}
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$args = array(
	'post_type' => 'testimonial',
	'posts_per_page' => $posts_per_page,
	'paged' => $paged,
	);
	
	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) : ?>
	
		<!-- BEGIN .sohohotel-testimonial-wrapper-1 -->
		<div class="sohohotel-testimonial-wrapper-1 sohohotel-testimonials-wrapper-full">
			
		<?php while($wp_query->have_posts()) :
			
			$wp_query->the_post(); ?>
	
			<?php
				// Get testimonial data
				$testimonial_name = get_post_meta($post->ID, $prefix.'testimonial_name', true);
				$testimonial_other_details = get_post_meta($post->ID, $prefix.'testimonial_other_details', true);			
			?>
			
			<!-- BEGIN .sohohotel-testimonial-block -->
			<div class="sohohotel-testimonial-block">
				
				<div><span class="sohohotel-open-quote">“</span><?php global $more;$more = 0;?><?php the_content(''); ?><span class="sohohotel-close-quote">”</span></div>
				
				<?php if( has_post_thumbnail() ) { ?>

					<div class="sohohotel-testimonial-image">
						<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sohohotel-image-style7' ); ?>
						<?php echo '<img src="' . $src[0] . '" alt="" />'; ?>
					</div>

				<?php } ?>
				
				<div class="sohohotel-testimonial-author"><p><?php echo esc_textarea($testimonial_name); ?> - <?php echo esc_textarea($testimonial_other_details); ?></p></div>
				
			<!-- END .sohohotel-testimonial-block -->
			</div>
			
		<?php endwhile; ?>
		
		<!-- END .sohohotel-testimonial-wrapper-1 -->
		</div>
		
		<?php else : ?>
			<p><?php esc_html_e('No testimonials have been added yet','sohohotel'); ?></p>
		<?php endif;

		if ( $wp_query->max_num_pages > 1 ) : ?>

			<div class="sohohotel-clearboth"></div>

			<?php if(is_plugin_active('wp-pagenavi/wp-pagenavi.php')) {
				echo '<div class="sohohotel-page-pagination clearfix">';
				wp_pagenavi();
				echo '</div>';
				echo '<div class="sohohotel-clearboth"></div>';
			} else { ?>

			<div class="sohohotel-page-pagination sohohotel-clearfix">
				<p class="sohohotel-clearfix">
					<span class="sohohotel-prev-pagination"><?php next_posts_link( esc_html__( '&larr; Older posts', 'sohohotel' ) ); ?></span>
					<span class="sohohotel-next-pagination"><?php previous_posts_link( esc_html__( 'Newer posts &rarr;', 'sohohotel' ) ); ?></span>	
				</p>
			</div>

			<?php } ?>

		<?php endif; wp_reset_query();

}

add_shortcode( 'sohohotel_testimonials_page', 'sohohotel_testimonials_page_shortcode' );

?>