<?php global $page_layout; ?>
<?php get_header(); ?>
<?php get_template_part( 'sohohotel', 'pageheader1' ); ?>

<!-- BEGIN .sohohotel-content-wrapper -->
<div class="sohohotel-content-wrapper sohohotel-clearfix sohohotel-content-wrapper-<?php echo $page_layout['sohohotel-content-wrapper']; ?>">

	<!-- BEGIN .sohohotel-main-content -->
	<div class="sohohotel-main-content sohohotel-main-content-<?php echo $page_layout['sohohotel-main-content']; ?>">
		
		<?php if(get_option('posts_per_page')) {
			$posts_per_page = esc_attr(get_option('posts_per_page'));
		} else {
			$posts_per_page = '10';
		} ?>
		
		<!-- BEGIN .sohohotel-blog-wrapper -->
		<div class="sohohotel-blog-wrapper sohohotel-blog-wrapper-1-col sohohotel-blog-wrapper-1-col-index">
			
			<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
			<?php query_posts( "post_type=post&paged=" . $paged . "&posts_per_page=" . $posts_per_page ); ?>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					
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
									<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sohohotel-image-style2' ); ?>
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
					
				<?php endwhile; ?>
			<?php endif; ?>
		
		<!-- END .sohohotel-blog-wrapper -->
		</div>
		
		<?php get_template_part( 'sohohotel', 'pagination' ); ?>
		
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