<?php

function sohohotel_blog_page_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'posts_per_page' => '',
		'order' => '',
		'columns' => '',
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
	'orderby' => 'date',
	'order' => $news_order
	);
	
	$wp_query = new WP_Query( $args );
	if ($wp_query->have_posts()) : ?>
	
	<?php if ( $columns == '1' ) { ?>
	
		<!-- BEGIN .sohohotel-blog-wrapper -->
		<div class="sohohotel-blog-wrapper sohohotel-blog-wrapper-1-col">
	
	<?php } else if ( $columns == '2' ) { ?>
	
		<!-- BEGIN .sohohotel-blog-wrapper -->
		<div class="sohohotel-blog-wrapper sohohotel-blog-wrapper-2-col">
			
	<?php } else if ( $columns == '3' ) { ?>
	
		<!-- BEGIN .sohohotel-blog-wrapper -->
		<div class="sohohotel-blog-wrapper sohohotel-blog-wrapper-3-col">
	
	<?php } else if ( $columns == '4' ) { ?>
	
		<!-- BEGIN .sohohotel-blog-wrapper -->
		<div class="sohohotel-blog-wrapper sohohotel-blog-wrapper-4-col">
		
	<?php } else { ?>
		
		<!-- BEGIN .sohohotel-blog-wrapper -->
		<div class="sohohotel-blog-wrapper sohohotel-blog-wrapper-1-col">
		
	<?php } ?>
	
		<?php while($wp_query->have_posts()) :
			
			$wp_query->the_post(); ?>
			
			<?php if ( $columns == '2' || $columns == '3' || $columns == '4' ) { ?>
				
				<!-- BEGIN .sohohotel-blog-block -->
				<div id="post-<?php the_ID(); ?>" <?php post_class("sohohotel-blog-block"); ?>>

					<?php if( has_post_thumbnail() ) { ?>

						<div class="sohohotel-blog-block-image">
							<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sohohotel-image-style2' ); ?>
								<?php echo '<img src="' . esc_url( $src[0] ) . '" alt="" />'; ?>
							</a>
						</div>

					<?php } ?>
					
					<!-- BEGIN .sohohotel-blog-block-content -->
					<div class="sohohotel-blog-block-content">
					
						<h3><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

						<!-- BEGIN .sohohotel-blog-meta -->
						<div class="sohohotel-blog-meta clearfix">
							<span class="sohohotel-blog-meta-date"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo get_the_date(); ?></a></span>
							<span class="sohohotel-blog-meta-category"><?php the_category(', '); ?></span>
						<!-- END .sohohotel-blog-meta -->
						</div>

						<!-- BEGIN .sohohotel-blog-description -->
						<div class="sohohotel-blog-description sohohotel-clearfix">

							<?php global $more;$more = 0;?>
							<?php the_excerpt(); ?>

						<!-- END .sohohotel-blog-description -->
						</div>
					
					<!-- END .sohohotel-blog-block-content -->
					</div>

				<!-- END .sohohotel-blog-block -->
				</div>
				
			<?php } else { ?>
			
				<!-- BEGIN .sohohotel-blog-block -->
				<div id="post-<?php the_ID(); ?>" <?php post_class("sohohotel-blog-block"); ?>>

					<h3><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

					<!-- BEGIN .sohohotel-blog-meta -->
					<div class="sohohotel-blog-meta clearfix">
						<span class="sohohotel-blog-meta-date"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo get_the_date(); ?></a></span>
						<span class="sohohotel-blog-meta-author"><?php esc_html_e('By','soho-hotel'); ?> <?php the_author_posts_link(); ?></span>
						<span class="sohohotel-blog-meta-category"><?php the_category(', '); ?></span>
						<span class="sohohotel-blog-meta-comments"><?php comments_popup_link(esc_html__( 'No Comments', 'soho-hotel' ),esc_html__( '1 Comment', 'soho-hotel' ),esc_html__( '% Comments', 'soho-hotel' ),'',esc_html__( 'Comments Off','soho-hotel')); ?></span>
					<!-- END .sohohotel-blog-meta -->
					</div>

					<?php if( has_post_thumbnail() ) { ?>

						<div class="sohohotel-blog-block-image">
							<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sohohotel-image-style5' ); ?>
								<?php echo '<img src="' . esc_url( $src[0] ) . '" alt="" />'; ?>
							</a>
						</div>

					<?php } ?>

					<!-- BEGIN .sohohotel-blog-description -->
					<div class="sohohotel-blog-description sohohotel-clearfix">

						<?php global $more;$more = 0;?>
						<?php the_excerpt(); ?>

					<!-- END .sohohotel-blog-description -->
					</div>

				<!-- END .sohohotel-blog-block -->
				</div>
			
			<?php } ?>
			
		<?php endwhile; ?>
		
		<!-- END .sohohotel-blog-wrapper -->
		</div>
		
		<?php else : ?>
			<p><?php esc_html_e('No news has been added yet','sohohotel'); ?></p>
		<?php endif; ?>
		
		<?php if( $columns == '1') { 
			$pagination_class = 'page-pagination pagination-margin clearfix';
		} else {
			$pagination_class = 'page-pagination pagination-margin-2 clearfix';
		} ?>
		
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>

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
		
		return ob_get_clean();

}

add_shortcode( 'sohohotel_blog_page', 'sohohotel_blog_page_shortcode' );

?>