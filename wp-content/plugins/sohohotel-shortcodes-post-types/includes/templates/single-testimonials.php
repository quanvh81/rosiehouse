<?php global $page_layout; ?>
<?php get_header(); ?>
<?php get_template_part( 'sohohotel', 'pageheader1' ); ?>

<!-- BEGIN .sohohotel-content-wrapper -->
<div class="sohohotel-content-wrapper sohohotel-clearfix sohohotel-content-wrapper-<?php echo $page_layout['sohohotel-content-wrapper']; ?>">

	<!-- BEGIN .sohohotel-main-content -->
	<div class="sohohotel-main-content sohohotel-main-content-<?php echo $page_layout['sohohotel-main-content']; ?>">

		<?php if ( post_password_required() ) {
			echo sohohotel_password_form();
		} else { ?>
			
			<!-- BEGIN .sohohotel-testimonial-wrapper-1 -->
			<div class="sohohotel-testimonial-wrapper-1 sohohotel-testimonials-wrapper-full sohohotel-testimonials-wrapper-single">
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
				<?php
					// Get testimonial data
					$testimonial_name = get_post_meta($post->ID, 'sohohotel_testimonial_name', true);
					$testimonial_other_details = get_post_meta($post->ID, 'sohohotel_testimonial_other_details', true);			
				?>
				
				<!-- BEGIN .sohohotel-testimonial-block -->
				<div id="post-<?php the_ID(); ?>" class="sohohotel-testimonial-block">
					
					<div><span class="sohohotel-open-quote">“</span><?php the_content(); ?><span class="sohohotel-close-quote">”</span></div>
										
					<?php if( has_post_thumbnail() ) { ?>

						<div class="sohohotel-testimonial-image">
							<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sohohotel-image-style7' ); ?>
							<?php echo '<img src="' . $src[0] . '" alt="" />'; ?>
						</div>

					<?php } ?>

					<div class="sohohotel-testimonial-author"><p><?php echo esc_textarea($testimonial_name); ?> - <?php echo esc_textarea($testimonial_other_details); ?></p></div>
										
				<!-- END .sohohotel-testimonial-block -->
				</div>

			<?php endwhile;endif; ?>
			
			<!-- END .sohohotel-testimonial-wrapper-1 -->
			</div>
			
		<?php } ?>
		
		<!-- END .sohohotel-main-content -->
		</div>
	
		<?php if( $page_layout['sohohotel-sidebar-content'] == 'left-sidebar' OR $page_layout['sohohotel-sidebar-content'] == 'right-sidebar' ) { ?>
	
			<!-- BEGIN .sohohotel-sidebar-content -->
			<div class="sohohotel-sidebar-content sohohotel-sidebar-content-<?php echo $page_layout['sohohotel-sidebar-content']; ?>">
		
				<?php get_sidebar(); ?>
		
			<!-- END .sohohotel-sidebar-content -->
			</div>
	
		<?php } ?>

	<!-- END .sohohotel-content-wrapper -->
	</div>

<?php get_footer(); ?>