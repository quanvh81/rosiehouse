<?php


// Remove VC Items
/*vc_remove_element("vc_zigzag");
vc_remove_element("vc_cta");
vc_remove_element("vc_btn");
vc_remove_element("vc_custom_heading");
vc_remove_element("vc_tta_tour");
vc_remove_element("vc_masonry_grid");
vc_remove_element("vc_basic_grid");
vc_remove_element("vc_line_chart");
vc_remove_element("vc_round_chart");
vc_remove_element("vc_pie");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_gmaps");
vc_remove_element("vc_video");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_tta_pageable");
vc_remove_element("vc_text_separator");
vc_remove_element("vc_message");
vc_remove_element("vc_hoverbox");
vc_remove_element("vc_images_carousel");
vc_remove_element("vc_section");
vc_remove_element("vc_icon");
vc_remove_element("vc_media_grid");
vc_remove_element("vc_masonry_media_grid");*/



/* ----------------------------------------------------------------------------

   Map theme shortcodes for WP Bakery Page Builder plugin

---------------------------------------------------------------------------- */



// Title
function sohohotel_title_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Title", 'soho-hotel' ),
		"description"			=> esc_html__( "Add a title", 'soho-hotel' ),
		"base"					=> "sohohotel_title",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Type", 'soho-hotel' ),
				"param_name"	=> "type",
				"value"			=> array(
					esc_html__( "Large Double Title", 'soho-hotel' ) => 'title1',
					esc_html__( "Single Center Aligned Title", 'soho-hotel' ) => 'title2',
					esc_html__( "Single Left Aligned Title", 'soho-hotel' ) => 'title3'
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Title 1", 'soho-hotel' ),
				"param_name"	=> "title1",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Title 2", 'soho-hotel' ),
				"param_name"	=> "title2",
				"value"			=> "",
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Text Color", 'soho-hotel' ),
				"param_name"	=> "text_color",
				"value"			=> array(
					esc_html__( "Dark", 'soho-hotel' ) => '1',
					esc_html__( "Light", 'soho-hotel' ) => '2'
				),
			),
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_title_vc' );



// Contact Details
function sohohotel_contact_details_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Contact Details", 'soho-hotel' ),
		"description"			=> esc_html__( "Display contact details in icon list", 'soho-hotel' ),
		"base"					=> "sohohotel_contact_details",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Type", 'soho-hotel' ),
				"param_name"	=> "type",
				"value"			=> array(
					esc_html__( "Type 1", 'soho-hotel' ) => '1',
					esc_html__( "Type 2", 'soho-hotel' ) => '2'
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Address", 'soho-hotel' ),
				"param_name"	=> "address",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Phone", 'soho-hotel' ),
				"param_name"	=> "phone",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Email", 'soho-hotel' ),
				"param_name"	=> "email",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_contact_details_vc' );



// Google Map
function sohohotel_google_map_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Google Map", 'soho-hotel' ),
		"description"			=> esc_html__( "Display Google Map", 'soho-hotel' ),
		"base"					=> "sohohotel_googlemap",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Map ID", 'soho-hotel' ),
				"param_name"	=> "map_id",
				"value"			=> "1",
				),
		
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Width", 'soho-hotel' ),
				"param_name"	=> "width",
				"value"			=> "100%",
				),
			
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Height", 'soho-hotel' ),
				"param_name"	=> "height",
				"value"			=> "550px",
				),
		
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Map Type", 'soho-hotel' ),
				"param_name"	=> "maptype",
				"value"			=> "road",
				),
			
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Zoom", 'soho-hotel' ),
				"param_name"	=> "zoom",
				"value"			=> "14",
				),
			
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Latitude", 'soho-hotel' ),
				"param_name"	=> "latitude",
				"value"			=> "40.703316",
				),
			
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Longitude", 'soho-hotel' ),
				"param_name"	=> "longitude",
				"value"			=> "-73.988145",
				),
			
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Marker Content", 'soho-hotel' ),
				"param_name"	=> "marker_content",
				"value"			=> "Soho Hotel",
				),
			
			array(
				"type"			=> "textfield",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Map Color", 'soho-hotel' ),
				"param_name"	=> "map_color",
				"value"			=> "#cc4452",
				),
				array(
					"type"			=> "textfield",
					"admin_label"	=> false,
					"class"			=> "",
					"heading"		=> esc_html__( "Marker Color", 'soho-hotel' ),
					"param_name"	=> "marker_color",
					"value"			=> "#cc4452",
					),
			),	
	) );
}
add_action( 'vc_before_init', 'sohohotel_google_map_vc' );



// Social Media
function sohohotel_social_media_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Social Media", 'soho-hotel' ),
		"description"			=> esc_html__( "Display social media icon links", 'soho-hotel' ),
		"base"					=> "sohohotel_social_media",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Facebook", 'soho-hotel' ),
				"param_name"	=> "facebook",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Flickr", 'soho-hotel' ),
				"param_name"	=> "flickr",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Google Plus", 'soho-hotel' ),
				"param_name"	=> "googleplus",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Instagram", 'soho-hotel' ),
				"param_name"	=> "instagram",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Pinterest", 'soho-hotel' ),
				"param_name"	=> "pinterest",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Skype", 'soho-hotel' ),
				"param_name"	=> "skype",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Soundcloud", 'soho-hotel' ),
				"param_name"	=> "soundcloud",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Tumblr", 'soho-hotel' ),
				"param_name"	=> "tumblr",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Twitter", 'soho-hotel' ),
				"param_name"	=> "twitter",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Vimeo", 'soho-hotel' ),
				"param_name"	=> "vimeo",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Vine", 'soho-hotel' ),
				"param_name"	=> "vine",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Yelp", 'soho-hotel' ),
				"param_name"	=> "yelp",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Youtube", 'soho-hotel' ),
				"param_name"	=> "youtube",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Trip Advisor", 'soho-hotel' ),
				"param_name"	=> "tripadvisor",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_social_media_vc' );



// Image Text
function sohohotel_image_text_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Image Text", 'soho-hotel' ),
		"description"			=> esc_html__( "Add a large image with text and a button beside it", 'soho-hotel' ),
		"base"					=> "sohohotel_image_text",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Image Alignment", 'soho-hotel' ),
				"param_name"	=> "type",
				"value"			=> array(
					esc_html__( "Left Align Image", 'soho-hotel' ) => '1',
					esc_html__( "Right Align Image", 'soho-hotel' ) => '2'
				),
			),
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Image", 'soho-hotel' ),
				"param_name"	=> "image",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Title", 'soho-hotel' ),
				"param_name"	=> "title",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Text", 'soho-hotel' ),
				"param_name"	=> "content",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button Text", 'soho-hotel' ),
				"param_name"	=> "button_text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button URL", 'soho-hotel' ),
				"param_name"	=> "button_url",
				"value"			=> "",
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Open link in new window", 'soho-hotel' ),
				"param_name"	=> "button_target",
				"value"			=> array(
					esc_html__( "Yes", 'soho-hotel' ) => '1',
					esc_html__( "No", 'soho-hotel' ) => '2'
				),
			),
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_image_text_vc' );



// Video Text
function sohohotel_video_text_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Video Text", 'soho-hotel' ),
		"description"			=> esc_html__( "Add a video with text and a button beside it", 'soho-hotel' ),
		"base"					=> "sohohotel_video_text",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Image", 'soho-hotel' ),
				"param_name"	=> "image",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Title", 'soho-hotel' ),
				"param_name"	=> "title",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Text", 'soho-hotel' ),
				"param_name"	=> "text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button Text", 'soho-hotel' ),
				"param_name"	=> "button_text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button URL", 'soho-hotel' ),
				"param_name"	=> "button_url",
				"value"			=> "",
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Open link in new window", 'soho-hotel' ),
				"param_name"	=> "button_target",
				"value"			=> array(
					esc_html__( "Yes", 'soho-hotel' ) => '1',
					esc_html__( "No", 'soho-hotel' ) => '2'
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Video URL", 'soho-hotel' ),
				"param_name"	=> "video_url",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_video_text_vc' );



// Icon Text
function sohohotel_icon_text_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Icon Text", 'soho-hotel' ),
		"description"			=> esc_html__( "Add an icon with text", 'soho-hotel' ),
		"base"					=> "sohohotel_icon_text",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Type", 'soho-hotel' ),
				"param_name"	=> "type",
				"value"			=> array(
					esc_html__( "Left Aligned Icons", 'soho-hotel' ) => '1',
					esc_html__( "Center Aligned Icons", 'soho-hotel' ) => '2'
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon 1", 'soho-hotel' ),
				"param_name"	=> "icon1",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Title 1", 'soho-hotel' ),
				"param_name"	=> "title1",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Content 1", 'soho-hotel' ),
				"param_name"	=> "content1",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon 2", 'soho-hotel' ),
				"param_name"	=> "icon2",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Title 2", 'soho-hotel' ),
				"param_name"	=> "title2",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Content 2", 'soho-hotel' ),
				"param_name"	=> "content2",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon 3", 'soho-hotel' ),
				"param_name"	=> "icon3",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Title 3", 'soho-hotel' ),
				"param_name"	=> "title3",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Content 3", 'soho-hotel' ),
				"param_name"	=> "content3",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon 4", 'soho-hotel' ),
				"param_name"	=> "icon4",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Title 4", 'soho-hotel' ),
				"param_name"	=> "title4",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Content 4", 'soho-hotel' ),
				"param_name"	=> "content4",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_icon_text_vc' );



// Button
function sohohotel_button_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Button", 'soho-hotel' ),
		"description"			=> esc_html__( "Add a button", 'soho-hotel' ),
		"base"					=> "sohohotel_button",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Type", 'soho-hotel' ),
				"param_name"	=> "type",
				"value"			=> array(
					esc_html__( "Standard Button", 'soho-hotel' ) => 'title1'
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Align", 'soho-hotel' ),
				"param_name"	=> "align",
				"value"			=> array(
					esc_html__( "Left", 'soho-hotel' ) => 'left',
					esc_html__( "Right", 'soho-hotel' ) => 'right',
					esc_html__( "Center", 'soho-hotel' ) => 'center'
				),
			),
			array(
				"type"			=> "colorpicker",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Background Color", 'soho-hotel' ),
				"param_name"	=> "background_color",
				"value"			=> "",
			),
			array(
				"type"			=> "colorpicker",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Text Color", 'soho-hotel' ),
				"param_name"	=> "text_color",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button Text", 'soho-hotel' ),
				"param_name"	=> "text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Link", 'soho-hotel' ),
				"param_name"	=> "link",
				"value"			=> "",
				"description"   => 'e.g. http://website.com'
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Icon", 'soho-hotel' ),
				"param_name"	=> "icon",
				"value"			=> "",
				"description"   => esc_html__( 'Add the Font Awesome icon name e.g. "fa-bed", full list available at: https://fontawesome.com/v4.7.0/cheatsheet', 'soho-hotel' )
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Margin Bottom", 'soho-hotel' ),
				"param_name"	=> "margin",
				"value"			=> "",
				"description"   => esc_html__( 'e.g. 30px', 'soho-hotel' )
			),
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_button_vc' );



// Video Thumbnail
function sohohotel_video_thumbnail_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Video Thumbnail", 'soho-hotel' ),
		"description"			=> esc_html__( "Add a video with a thumbnail image", 'soho-hotel' ),
		"base"					=> "sohohotel_video_thumbnail",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Thumbnail Image", 'soho-hotel' ),
				"param_name"	=> "thumbnail_url",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Video URL", 'soho-hotel' ),
				"param_name"	=> "video_url",
				"value"			=> "",
				"description"   => 'e.g. https://www.youtube.com/watch?v=9ATwmA0AZOM'
			),
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_video_thumbnail_vc' );



// Testimonials Carousel
function sohohotel_testimonials_carousel_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Testimonials Carousel", 'soho-hotel' ),
		"description"			=> esc_html__( "Display testimonials in a carousel", 'soho-hotel' ),
		"base"					=> "sohohotel_testimonials_carousel",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Type", 'soho-hotel' ),
				"param_name"	=> "type",
				"value"			=> array(
					'Light Background' 	=> '1',
					'Dark Background' 	=> '2'
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Border", 'soho-hotel' ),
				"param_name"	=> "border",
				"value"			=> array(
					'Border' 	=> '1',
					'No Border' 	=> '2'
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Posts per page", 'soho-hotel' ),
				"param_name"	=> "posts_per_page",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5',
					'6' 	=> '6',
					'7' 	=> '7',
					'8' 	=> '8',
					'9' 	=> '9',
					'10' 	=> '10',
					'11' 	=> '11',
					'12' 	=> '12',
					'13' 	=> '13',
					'14' 	=> '14',
					'15' 	=> '15',
					'16' 	=> '16',
					'17' 	=> '17',
					'18' 	=> '18',
					'19' 	=> '19',
					'20' 	=> '20',
					'21' 	=> '21',
					'22' 	=> '22',
					'23' 	=> '23',
					'24' 	=> '24',
					'25' 	=> '25',
					'26' 	=> '26',
					'27' 	=> '27',
					'28' 	=> '28',
					'29' 	=> '29',
					'30' 	=> '30',
					'31' 	=> '31',
					'32' 	=> '32',
					'33' 	=> '33',
					'34' 	=> '34',
					'35' 	=> '35',
					'36' 	=> '36',
					'37' 	=> '37',
					'38' 	=> '38',
					'39' 	=> '39',
					'40' 	=> '40',
					'41' 	=> '41',
					'42' 	=> '42',
					'43' 	=> '43',
					'44' 	=> '44',
					'45' 	=> '45',
					'46' 	=> '46',
					'47' 	=> '47',
					'48' 	=> '48',
					'49' 	=> '49',
					'50' 	=> '50',
					'51' 	=> '51',
					'52' 	=> '52',
					'53' 	=> '53',
					'54' 	=> '54',
					'55' 	=> '55',
					'56' 	=> '56',
					'57' 	=> '57',
					'58' 	=> '58',
					'59' 	=> '59',
					'60' 	=> '60',
					'61' 	=> '61',
					'62' 	=> '62',
					'63' 	=> '63',
					'64' 	=> '64',
					'65' 	=> '65',
					'66' 	=> '66',
					'67' 	=> '67',
					'68' 	=> '68',
					'69' 	=> '69',
					'70' 	=> '70',
					'71' 	=> '71',
					'72' 	=> '72',
					'73' 	=> '73',
					'74' 	=> '74',
					'75' 	=> '75',
					'76' 	=> '76',
					'77' 	=> '77',
					'78' 	=> '78',
					'79' 	=> '79',
					'80' 	=> '80',
					'81' 	=> '81',
					'82' 	=> '82',
					'83' 	=> '83',
					'84' 	=> '84',
					'85' 	=> '85',
					'86' 	=> '86',
					'87' 	=> '87',
					'88' 	=> '88',
					'89' 	=> '89',
					'90' 	=> '90',
					'91' 	=> '91',
					'92' 	=> '92',
					'93' 	=> '93',
					'94' 	=> '94',
					'95' 	=> '95',
					'96' 	=> '96',
					'97' 	=> '97',
					'98' 	=> '98',
					'99' 	=> '99',
					'100' 	=> '100',
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'soho-hotel' ),
				"param_name"	=> "order",
				"value"			=> array(
					'Newest First' 	=> 'newest',
					'Oldest First' 	=> 'oldest',
				),
				)
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_testimonials_carousel_vc' );



// Testimonials Page
function sohohotel_testimonials_page_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Testimonials Page", 'soho-hotel' ),
		"description"			=> esc_html__( "Display the testimonials page content", 'soho-hotel' ),
		"base"					=> "sohohotel_testimonials_page",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Posts per page", 'soho-hotel' ),
				"param_name"	=> "posts_per_page",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5',
					'6' 	=> '6',
					'7' 	=> '7',
					'8' 	=> '8',
					'9' 	=> '9',
					'10' 	=> '10',
					'11' 	=> '11',
					'12' 	=> '12',
					'13' 	=> '13',
					'14' 	=> '14',
					'15' 	=> '15',
					'16' 	=> '16',
					'17' 	=> '17',
					'18' 	=> '18',
					'19' 	=> '19',
					'20' 	=> '20',
					'21' 	=> '21',
					'22' 	=> '22',
					'23' 	=> '23',
					'24' 	=> '24',
					'25' 	=> '25',
					'26' 	=> '26',
					'27' 	=> '27',
					'28' 	=> '28',
					'29' 	=> '29',
					'30' 	=> '30',
					'31' 	=> '31',
					'32' 	=> '32',
					'33' 	=> '33',
					'34' 	=> '34',
					'35' 	=> '35',
					'36' 	=> '36',
					'37' 	=> '37',
					'38' 	=> '38',
					'39' 	=> '39',
					'40' 	=> '40',
					'41' 	=> '41',
					'42' 	=> '42',
					'43' 	=> '43',
					'44' 	=> '44',
					'45' 	=> '45',
					'46' 	=> '46',
					'47' 	=> '47',
					'48' 	=> '48',
					'49' 	=> '49',
					'50' 	=> '50',
					'51' 	=> '51',
					'52' 	=> '52',
					'53' 	=> '53',
					'54' 	=> '54',
					'55' 	=> '55',
					'56' 	=> '56',
					'57' 	=> '57',
					'58' 	=> '58',
					'59' 	=> '59',
					'60' 	=> '60',
					'61' 	=> '61',
					'62' 	=> '62',
					'63' 	=> '63',
					'64' 	=> '64',
					'65' 	=> '65',
					'66' 	=> '66',
					'67' 	=> '67',
					'68' 	=> '68',
					'69' 	=> '69',
					'70' 	=> '70',
					'71' 	=> '71',
					'72' 	=> '72',
					'73' 	=> '73',
					'74' 	=> '74',
					'75' 	=> '75',
					'76' 	=> '76',
					'77' 	=> '77',
					'78' 	=> '78',
					'79' 	=> '79',
					'80' 	=> '80',
					'81' 	=> '81',
					'82' 	=> '82',
					'83' 	=> '83',
					'84' 	=> '84',
					'85' 	=> '85',
					'86' 	=> '86',
					'87' 	=> '87',
					'88' 	=> '88',
					'89' 	=> '89',
					'90' 	=> '90',
					'91' 	=> '91',
					'92' 	=> '92',
					'93' 	=> '93',
					'94' 	=> '94',
					'95' 	=> '95',
					'96' 	=> '96',
					'97' 	=> '97',
					'98' 	=> '98',
					'99' 	=> '99',
					'100' 	=> '100',
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'soho-hotel' ),
				"param_name"	=> "order",
				"value"			=> array(
					'Newest First' 	=> 'newest',
					'Oldest First' 	=> 'oldest',
				),
			),
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_testimonials_page_vc' );



// Blog Carousel
function sohohotel_blog_carousel_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Blog Carousel", 'soho-hotel' ),
		"description"			=> esc_html__( "Display blog posts in a carousel", 'soho-hotel' ),
		"base"					=> "sohohotel_blog_carousel",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Posts per page", 'soho-hotel' ),
				"param_name"	=> "posts_per_page",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5',
					'6' 	=> '6',
					'7' 	=> '7',
					'8' 	=> '8',
					'9' 	=> '9',
					'10' 	=> '10',
					'11' 	=> '11',
					'12' 	=> '12',
					'13' 	=> '13',
					'14' 	=> '14',
					'15' 	=> '15',
					'16' 	=> '16',
					'17' 	=> '17',
					'18' 	=> '18',
					'19' 	=> '19',
					'20' 	=> '20',
					'21' 	=> '21',
					'22' 	=> '22',
					'23' 	=> '23',
					'24' 	=> '24',
					'25' 	=> '25',
					'26' 	=> '26',
					'27' 	=> '27',
					'28' 	=> '28',
					'29' 	=> '29',
					'30' 	=> '30',
					'31' 	=> '31',
					'32' 	=> '32',
					'33' 	=> '33',
					'34' 	=> '34',
					'35' 	=> '35',
					'36' 	=> '36',
					'37' 	=> '37',
					'38' 	=> '38',
					'39' 	=> '39',
					'40' 	=> '40',
					'41' 	=> '41',
					'42' 	=> '42',
					'43' 	=> '43',
					'44' 	=> '44',
					'45' 	=> '45',
					'46' 	=> '46',
					'47' 	=> '47',
					'48' 	=> '48',
					'49' 	=> '49',
					'50' 	=> '50',
					'51' 	=> '51',
					'52' 	=> '52',
					'53' 	=> '53',
					'54' 	=> '54',
					'55' 	=> '55',
					'56' 	=> '56',
					'57' 	=> '57',
					'58' 	=> '58',
					'59' 	=> '59',
					'60' 	=> '60',
					'61' 	=> '61',
					'62' 	=> '62',
					'63' 	=> '63',
					'64' 	=> '64',
					'65' 	=> '65',
					'66' 	=> '66',
					'67' 	=> '67',
					'68' 	=> '68',
					'69' 	=> '69',
					'70' 	=> '70',
					'71' 	=> '71',
					'72' 	=> '72',
					'73' 	=> '73',
					'74' 	=> '74',
					'75' 	=> '75',
					'76' 	=> '76',
					'77' 	=> '77',
					'78' 	=> '78',
					'79' 	=> '79',
					'80' 	=> '80',
					'81' 	=> '81',
					'82' 	=> '82',
					'83' 	=> '83',
					'84' 	=> '84',
					'85' 	=> '85',
					'86' 	=> '86',
					'87' 	=> '87',
					'88' 	=> '88',
					'89' 	=> '89',
					'90' 	=> '90',
					'91' 	=> '91',
					'92' 	=> '92',
					'93' 	=> '93',
					'94' 	=> '94',
					'95' 	=> '95',
					'96' 	=> '96',
					'97' 	=> '97',
					'98' 	=> '98',
					'99' 	=> '99',
					'100' 	=> '100',
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'soho-hotel' ),
				"param_name"	=> "order",
				"value"			=> array(
					'Newest First' 	=> 'newest',
					'Oldest First' 	=> 'oldest',
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Category", 'soho-hotel' ),
				"param_name"	=> "category",
				"value"			=> "",
				"description" => esc_html__( "Leave blank to display all post categories", 'soho-hotel' )
			),
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_blog_carousel_vc' );



// Blog Page
function sohohotel_blog_page_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Blog Page", 'soho-hotel' ),
		"description"			=> esc_html__( "Display blog posts", 'soho-hotel' ),
		"base"					=> "sohohotel_blog_page",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Columns", 'soho-hotel' ),
				"param_name"	=> "columns",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4'
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Posts per page", 'soho-hotel' ),
				"param_name"	=> "posts_per_page",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5',
					'6' 	=> '6',
					'7' 	=> '7',
					'8' 	=> '8',
					'9' 	=> '9',
					'10' 	=> '10',
					'11' 	=> '11',
					'12' 	=> '12',
					'13' 	=> '13',
					'14' 	=> '14',
					'15' 	=> '15',
					'16' 	=> '16',
					'17' 	=> '17',
					'18' 	=> '18',
					'19' 	=> '19',
					'20' 	=> '20',
					'21' 	=> '21',
					'22' 	=> '22',
					'23' 	=> '23',
					'24' 	=> '24',
					'25' 	=> '25',
					'26' 	=> '26',
					'27' 	=> '27',
					'28' 	=> '28',
					'29' 	=> '29',
					'30' 	=> '30',
					'31' 	=> '31',
					'32' 	=> '32',
					'33' 	=> '33',
					'34' 	=> '34',
					'35' 	=> '35',
					'36' 	=> '36',
					'37' 	=> '37',
					'38' 	=> '38',
					'39' 	=> '39',
					'40' 	=> '40',
					'41' 	=> '41',
					'42' 	=> '42',
					'43' 	=> '43',
					'44' 	=> '44',
					'45' 	=> '45',
					'46' 	=> '46',
					'47' 	=> '47',
					'48' 	=> '48',
					'49' 	=> '49',
					'50' 	=> '50',
					'51' 	=> '51',
					'52' 	=> '52',
					'53' 	=> '53',
					'54' 	=> '54',
					'55' 	=> '55',
					'56' 	=> '56',
					'57' 	=> '57',
					'58' 	=> '58',
					'59' 	=> '59',
					'60' 	=> '60',
					'61' 	=> '61',
					'62' 	=> '62',
					'63' 	=> '63',
					'64' 	=> '64',
					'65' 	=> '65',
					'66' 	=> '66',
					'67' 	=> '67',
					'68' 	=> '68',
					'69' 	=> '69',
					'70' 	=> '70',
					'71' 	=> '71',
					'72' 	=> '72',
					'73' 	=> '73',
					'74' 	=> '74',
					'75' 	=> '75',
					'76' 	=> '76',
					'77' 	=> '77',
					'78' 	=> '78',
					'79' 	=> '79',
					'80' 	=> '80',
					'81' 	=> '81',
					'82' 	=> '82',
					'83' 	=> '83',
					'84' 	=> '84',
					'85' 	=> '85',
					'86' 	=> '86',
					'87' 	=> '87',
					'88' 	=> '88',
					'89' 	=> '89',
					'90' 	=> '90',
					'91' 	=> '91',
					'92' 	=> '92',
					'93' 	=> '93',
					'94' 	=> '94',
					'95' 	=> '95',
					'96' 	=> '96',
					'97' 	=> '97',
					'98' 	=> '98',
					'99' 	=> '99',
					'100' 	=> '100',
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'soho-hotel' ),
				"param_name"	=> "order",
				"value"			=> array(
					'Newest First' 	=> 'newest',
					'Oldest First' 	=> 'oldest',
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Category ID (Leave empty to display all categories)", 'soho-hotel' ),
				"param_name"	=> "category",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_blog_page_vc' );



// Call To Action Small
function sohohotel_call_to_action_small_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Call To Action Small", 'soho-hotel' ),
		"description"			=> esc_html__( "Display call to action", 'soho-hotel' ),
		"base"					=> "sohohotel_call_to_action_small",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Text", 'soho-hotel' ),
				"param_name"	=> "text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button Text", 'soho-hotel' ),
				"param_name"	=> "button_text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button URL", 'soho-hotel' ),
				"param_name"	=> "button_url",
				"value"			=> "",
			),
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Background Image", 'soho-hotel' ),
				"param_name"	=> "background_url",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_call_to_action_small_vc' );



// Call To Action Large
function sohohotel_call_to_action_large_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Call To Action Large", 'soho-hotel' ),
		"description"			=> esc_html__( "Display call to action", 'soho-hotel' ),
		"base"					=> "sohohotel_call_to_action_large",
		'category'				=> "Soho Hotel",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Title", 'soho-hotel' ),
				"param_name"	=> "title",
				"value"			=> "",
			),
			array(
				"type"			=> "textarea",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Text", 'soho-hotel' ),
				"param_name"	=> "text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button Text", 'soho-hotel' ),
				"param_name"	=> "button_text",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Button URL", 'soho-hotel' ),
				"param_name"	=> "button_url",
				"value"			=> "",
			),
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Background Image", 'soho-hotel' ),
				"param_name"	=> "background_url",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_call_to_action_large_vc' );



// Row fixed width
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => esc_html__( "Fixed Width", 'soho-hotel' ),
	"param_name" => "fixed_width",
	"value" => esc_html__( "yes", 'soho-hotel' ),
	"description" => esc_html__( "If you're using the unboxed full width page layout check this option to display boxed content", 'soho-hotel' )
));



?>