<?php

function sohohotel_blog_carousel_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'posts_per_page' => '',
		'order' => '',
		'category' => '',
	), $atts ) );
	
	ob_start();
	
	global $post;
	global $wp_query;
	$prefix = 'sohohotel_';
	
	// Set news Displayed Per Page
	if ( $posts_per_page != '' ) {
		$posts_per_page = $posts_per_page;
	} else {
		$posts_per_page = '1';
	}
	
	// Set news Display Order
	if ( $order == 'newest' ) {
		$news_order = 'DESC';
	} elseif ( $order == 'oldest' ) {
		$news_order = 'ASC';
	} else {
		$news_order = 'DESC';
	}
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$args = array(
	'post_type' => 'post',
	'posts_per_page' => $posts_per_page,
	'paged' => $paged,
	'cat' => $category,
	'order' => $news_order
	); ?>
	
	<!-- BEGIN .sohohotel-blog-carousel-wrapper -->
	<section class="sohohotel-blog-carousel-wrapper sohohotel-clearfix">
	
		<?php $wp_query = new WP_Query( $args );
		if ($wp_query->have_posts()) : ?>
		
			<!-- BEGIN .sohohotel-blog-carousel -->
			<div class="sohohotel-blog-carousel sohohotel-owl-carousel-2">
	
			<?php while($wp_query->have_posts()) :
			
				$wp_query->the_post(); ?>
			
				<!-- BEGIN .sohohotel-blog-block -->
				<div class="sohohotel-blog-block">
				
					<?php if( has_post_thumbnail() ) { ?>

						<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="sohohotel-blog-block-image">
							<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sohohotel-image-style8' ); ?>
							<?php echo '<img src="' . $src[0] . '" alt="" />'; ?>
						</a>
					
					<?php } ?>
				
					<h4><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					<p class="sohohotel-blog-date"><?php the_time( get_option( 'date_format' ) ); ?></p>
		
				<!-- END .sohohotel-news-block -->
				</div>
			
			<?php endwhile; ?>
		
			<!-- END .sohohotel-blog-carousel -->
			</div>
		
			<?php else : ?>
				<p><?php esc_html_e('No news has been added yet','sohohotel'); ?></p>
			<?php endif;

			wp_reset_query(); ?>
	
	<!-- END .sohohotel-blog-carousel-wrapper -->
	</section>
		
	<?php return ob_get_clean(); ?>

<?php }

add_shortcode( 'sohohotel_blog_carousel', 'sohohotel_blog_carousel_shortcode' );

?>