<?php get_header(); ?>

<!-- BEGIN .sohohotel-page-header -->
<div class="sohohotel-page-header">
	
	<h1><?php esc_html_e('Search Results','soho-hotel'); ?></h1>

<!-- END .sohohotel-page-header -->
</div>

<!-- BEGIN .sohohotel-content-wrapper -->
<div class="sohohotel-content-wrapper sohohotel-clearfix sohohotel-content-wrapper-<?php echo $page_layout['sohohotel-content-wrapper']; ?>">

	<!-- BEGIN .sohohotel-main-content -->
	<div class="sohohotel-main-content sohohotel-main-content-<?php echo $page_layout['sohohotel-main-content']; ?>">
		
		<!-- BEGIN .sohohotel-search-results-wrapper -->
		<div class="sohohotel-search-results-wrapper">
		
			<!-- BEGIN .sohohotel-search-results-form -->
			<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="sohohotel-search-results-form sohohotel-clearfix">
				<input type="text" onblur="if(this.value=='')this.value='<?php esc_html_e('To search, type and hit enter', 'soho-hotel'); ?>';" onfocus="if(this.value=='<?php esc_html_e('To search, type and hit enter', 'soho-hotel'); ?>')this.value='';" value="<?php esc_html_e('To search, type and hit enter', 'soho-hotel'); ?>" name="s" />
				<button type="submit">
					<?php esc_html_e('Search','soho-hotel'); ?> <i class="fa fa-search"></i>
				</button>
			<!-- END .ssohohotel-earch-results-form -->
			</form>
			
			<?php if (have_posts()) : ?>

				<!--BEGIN .sohohotel-search-results-list -->
				<ul class="sohohotel-search-results-list">

					<?php $i = 0;
					while (have_posts()) : the_post(); ?>
						<li><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a> <span>(<?php echo sohohotel_post_type_name(get_post_type());?>)</span></li>
					<?php endwhile;?>

				<!--END .sohohotel-search-results-list -->
				</ul>

			<?php else : ?>

				<!--BEGIN .sohohotel-search-results-list -->
				<ul class="sohohotel-search-results-list">
					<li><?php esc_html_e( 'No results were found.', 'soho-hotel' ); ?></li>
				<!--END .sohohotel-search-results-list -->
				</ul>

			<?php endif; ?>
		
		<!-- END .sohohotel-search-results-wrapper -->
		</div>
		
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