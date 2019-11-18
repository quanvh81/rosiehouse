<?php

global $sohohotel_data;
global $page_title;

$page_title = sohohotel_page_title(get_the_ID());

$sohohotel_page_header_image = sohohotel_page_header_image(wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'sohohotel-image-style11' ));

if($sohohotel_data["site-header-style"]) {
	if($sohohotel_data["site-header-style"] == 'sohohotel-header1') {
		$sohohotel_page_title_class = 'sohohotel-page-header-1';
	} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header2') {
		$sohohotel_page_title_class = 'sohohotel-page-header-2';
	} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header3') {
		$sohohotel_page_title_class = 'sohohotel-page-header-3';
	} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header4') {
		$sohohotel_page_title_class = 'sohohotel-page-header-4';
	} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header5') {
		$sohohotel_page_title_class = 'sohohotel-page-header-5';
	} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header6') {
		$sohohotel_page_title_class = 'sohohotel-page-header-6';
	} else {
		$sohohotel_page_title_class = 'sohohotel-page-header-1';
	}
}
	
if ( !empty($page_title["sohohotel-page-header"]) ) {
	if ( $page_title["sohohotel-page-header"] == 'no_title' ) {
		$sohohotel_page_header = 'no_title';
	} else {
		$sohohotel_page_header = 'title';
	}
} else {
	$sohohotel_page_header = 'title';
}

if( $sohohotel_page_header == 'title' ) { ?> 

	<!-- BEGIN .sohohotel-page-header -->
	<div class="sohohotel-page-header <?php echo $sohohotel_page_title_class; ?>" <?php echo $sohohotel_page_header_image; ?>>
		
		<h1><?php if(is_front_page() OR is_single() && get_post_type() == 'post'){esc_html_e('Blog','soho-hotel');} else {the_title();} ?></h1>

	<!-- END .sohohotel-page-header -->
	</div>

<?php } ?>