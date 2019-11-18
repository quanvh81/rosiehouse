<?php get_header(); ?>

<!-- BEGIN .sohohotel-page-not-found -->
<div class="sohohotel-page-not-found">
	
	<h1><?php esc_html_e('Page Not Found', 'soho-hotel'); ?></h1>
	<p><?php esc_html_e('Sorry, the requested page could not be found, the page may have been deleted or you may have followed a broken link.', 'soho-hotel'); ?></p>
	
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="sohohotel-clearfix" method="get">

		<input type="text" onblur="if(this.value=='')this.value='<?php esc_html_e('Search...', 'soho-hotel'); ?>';" onfocus="if(this.value=='<?php esc_html_e('Search...', 'soho-hotel'); ?>')this.value='';" value="<?php esc_html_e('Search...', 'soho-hotel'); ?>" name="s" />

		<button type="submit"><i class="fa fa-search"></i></button>

	</form>

<!-- END .sohohotel-page-not-found -->
</div>

<?php get_footer(); ?>