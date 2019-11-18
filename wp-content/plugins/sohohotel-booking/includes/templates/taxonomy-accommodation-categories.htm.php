<?php get_header(); ?>

<!-- BEGIN #page-header -->
<div id="page-header" <?php echo $page_header_image;?>>

	<!-- BEGIN .page-title-wrapper -->
	<div class="page-title-wrapper">
		<h1 class="page-title"><?php esc_html_e('Hotel Category Page','sohohotel_booking'); ?></h1>
		<div class="title-block1"></div>
	<!-- END .page-title-wrapper -->
	</div>
	
<!-- END #page-header -->
</div>

<!-- BEGIN .clearfix -->
<div class="clearfix">
	
	<div class="main-content main-content-full">
	
		<p><?php esc_html_e('To create a hotel / category page, please go to "Pages > Add New", select the "Accommodation" element in Visual Composer, and enter your hotel / category slug in the "Hotel / Category" field.','sohohotel_booking'); ?></p>
		
	</div>

<!-- END .clearfix -->
</div>

<?php get_footer(); ?>