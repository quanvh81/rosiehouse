<?php

	get_header();
	
/* ----------------------------------------------------------------------------

   Get Page Title

---------------------------------------------------------------------------- */

	// Category
	if (is_category()) :
		$page_title = sprintf( esc_html__('All posts in: "%s"', 'soho-hotel'), single_cat_title('',false) );

	// Tag
	elseif (is_tag()) :
		$page_title = sprintf( esc_html__('All posts tagged: "%s"', 'soho-hotel'), single_tag_title('',false) );

	// Author
	elseif ( is_author() ) :	
		$userdata = get_userdata($author);
		$page_title = sprintf( esc_html__('All posts by: "%s"', 'soho-hotel'), $userdata->display_name );

	// Day
	elseif ( is_day() ) :
		$page_title = sprintf( esc_html__( 'Daily Archives: %s', 'soho-hotel' ), get_the_date() );
	
	// Month	
	elseif ( is_month() ) :
		$page_title = sprintf( esc_html__( 'Monthly Archives: %s', 'soho-hotel' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'soho-hotel' ) ) );
	
	// Year
	elseif ( is_year() ) :
		$page_title = sprintf( esc_html__( 'Yearly Archives: %s', 'soho-hotel' ), get_the_date( _x( 'Y', 'yearly archives date format', 'soho-hotel' ) ) );
	
	else : 
		$page_title = esc_html__('Archives', 'soho-hotel');
	
	endif; ?>

<!-- BEGIN .sohohotel-page-header -->
<div class="sohohotel-page-header">
	
	<h1><?php echo esc_attr($page_title); ?></h1>

<!-- END .sohohotel-page-header -->
</div>

<!-- BEGIN .sohohotel-content-wrapper -->
<div class="sohohotel-content-wrapper sohohotel-clearfix sohohotel-content-wrapper-<?php echo $page_layout['sohohotel-content-wrapper']; ?>">

	<!-- BEGIN .sohohotel-main-content -->
	<div class="sohohotel-main-content sohohotel-main-content-<?php echo $page_layout['sohohotel-main-content']; ?>">
			
		<?php if ( have_posts() ) : ?>
				
			<!-- BEGIN .sohohotel-blog-wrapper -->
			<div class="sohohotel-blog-wrapper sohohotel-blog-wrapper-1-col sohohotel-blog-wrapper-1-col-index">
				
				<?php if ( category_description() ) : ?>
					<div class="sohohotel-archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
				
				<?php while ( have_posts() ) : the_post(); ?>
					
					<!-- BEGIN .sohohotel-blog-block -->
					<div id="post-<?php the_ID(); ?>" <?php post_class("sohohotel-blog-block"); ?>>

						<h3><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

						<!-- BEGIN .sohohotel-blog-meta -->
						<div class="sohohotel-blog-meta clearfix">
							<span class="sohohotel-blog-meta-date"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo get_the_date('F j, Y'); ?></a></span>
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
				
				<!-- END .sohohotel-blog-wrapper -->
				</div>

			<?php get_template_part( 'sohohotel', 'pagination' ); ?>
			
		<?php endif; ?>
			
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