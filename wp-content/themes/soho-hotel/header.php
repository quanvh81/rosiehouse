<?php

// Set Global Variables
global $sohohotel_data;
global $page_layout;
global $page_title;
$page_layout = sohohotel_page_sidebar(get_the_ID());
$page_title = sohohotel_page_title(get_the_ID());

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<!-- BEGIN head -->
<head>
	
	<!--Meta Tags-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php wp_head(); ?>
	
<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>
	
	<!-- BEGIN .sohohotel-site-wrapper -->
	<div class="sohohotel-site-wrapper <?php if($sohohotel_data["background-layout-style"] == "boxed") {echo 'sohohotel-site-wrapper-boxed';} ?>">
	
	<?php if($sohohotel_data["site-header-style"]) {
		
		if($sohohotel_data["site-header-style"] == 'sohohotel-header1') {
			get_template_part( 'sohohotel', 'siteheader1' );
		} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header2') {
			get_template_part( 'sohohotel', 'siteheader2' );
		} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header3') {
			get_template_part( 'sohohotel', 'siteheader3' );
		} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header4') {
			get_template_part( 'sohohotel', 'siteheader4' );
		} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header5') {
			get_template_part( 'sohohotel', 'siteheader5' );
		} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header6') {
			get_template_part( 'sohohotel', 'siteheader6' );
		} else {
			get_template_part( 'sohohotel', 'siteheader1' );
		}
		
	} ?>