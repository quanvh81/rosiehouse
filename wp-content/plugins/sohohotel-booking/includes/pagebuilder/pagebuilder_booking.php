<?php



/* ----------------------------------------------------------------------------

   Map Theme Shortcodes To WP Bakery Page Builder

---------------------------------------------------------------------------- */

// Booking Page
function sohohotel_booking_page_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Booking Page", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "booking_page",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Enter a hotel category slug here to only display rooms for a specific hotel category (leave blank if you don't have any categories, or you want to display all)", 'sohohotel' ),
				"param_name"	=> "hotel_category",
				"value"			=> "",
			)
		)
	) );
}
add_action( 'vc_before_init', 'sohohotel_booking_page_vc' );



// Booking Form 1
function sohohotel_booking_form_1_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Booking Form 1", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "booking_form_1",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> ""
	) );
}
add_action( 'vc_before_init', 'sohohotel_booking_form_1_vc' );



// Booking Form 2
function sohohotel_booking_form_2_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Booking Form 2", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "booking_form_2",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> ""
	) );
}
add_action( 'vc_before_init', 'sohohotel_booking_form_2_vc' );



// Booking Form 3
function sohohotel_booking_form_3_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Booking Form 3", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "booking_form_3",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> ""
	) );
}
add_action( 'vc_before_init', 'sohohotel_booking_form_3_vc' );



// Booking Form 4
function sohohotel_booking_form_4_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Booking Form 4", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "booking_form_4",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> ""
	) );
}
add_action( 'vc_before_init', 'sohohotel_booking_form_4_vc' );



// Booking Form 5
function sohohotel_booking_form_5_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Booking Form 5", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "booking_form_5",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> ""
	) );
}
add_action( 'vc_before_init', 'sohohotel_booking_form_5_vc' );



// Accommodation Listing
function accommodation_listing_1_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Accommodation Listing 1", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "accommodation_listing_1",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Columns", 'sohohotel' ),
				"param_name"	=> "columns",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5'
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Rooms per page", 'sohohotel' ),
				"param_name"	=> "rooms_per_page",
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
				"heading"		=> esc_html__( "Order", 'sohohotel' ),
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
				"heading"		=> esc_html__( "Accommodation Category Slug (Leave blank to display all)", 'sohohotel' ),
				"param_name"	=> "hotel_category",
				"value"			=> "",
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Hide Pagination", 'sohohotel' ),
				"param_name"	=> "hide_pagination",
				"value"			=> array(
					'No' 	=> '1',
					'Yes' 	=> '2'
				),
			),
		)
	) );
}
add_action( 'vc_before_init', 'accommodation_listing_1_vc' );



// Accommodation Listing
function accommodation_listing_2_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Accommodation Listing 2", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "accommodation_listing_2",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Columns", 'sohohotel' ),
				"param_name"	=> "columns",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5'
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Rooms per page", 'sohohotel' ),
				"param_name"	=> "rooms_per_page",
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
				"heading"		=> esc_html__( "Order", 'sohohotel' ),
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
				"heading"		=> esc_html__( "Accommodation Category Slug (Leave blank to display all)", 'sohohotel' ),
				"param_name"	=> "hotel_category",
				"value"			=> "",
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Hide Pagination", 'sohohotel' ),
				"param_name"	=> "hide_pagination",
				"value"			=> array(
					'No' 	=> '1',
					'Yes' 	=> '2'
				),
			),
		)
	) );
}
add_action( 'vc_before_init', 'accommodation_listing_2_vc' );



// Accommodation Listing
function accommodation_listing_3_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Accommodation Listing 3", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "accommodation_listing_3",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Columns", 'sohohotel' ),
				"param_name"	=> "columns",
				"value"			=> array(
					'1' 	=> '1',
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
					'5' 	=> '5'
				),
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Rooms per page", 'sohohotel' ),
				"param_name"	=> "rooms_per_page",
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
				"heading"		=> esc_html__( "Order", 'sohohotel' ),
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
				"heading"		=> esc_html__( "Accommodation Category Slug (Leave blank to display all)", 'sohohotel' ),
				"param_name"	=> "hotel_category",
				"value"			=> "",
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Hide Pagination", 'sohohotel' ),
				"param_name"	=> "hide_pagination",
				"value"			=> array(
					'No' 	=> '1',
					'Yes' 	=> '2'
				),
			),
		)
	) );
}
add_action( 'vc_before_init', 'accommodation_listing_3_vc' );



// Accommodation Carousel
function accommodation_carousel_1_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Accommodation Carousel 1", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "accommodation_carousel_1",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'sohohotel' ),
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
				"heading"		=> esc_html__( "Accommodation Category Slug (Leave blank to display all)", 'sohohotel' ),
				"param_name"	=> "hotel_category",
				"value"			=> "",
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Rooms per page", 'sohohotel' ),
				"param_name"	=> "rooms_per_page",
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
		)
	) );
}
add_action( 'vc_before_init', 'accommodation_carousel_1_vc' );



// Accommodation Carousel
function accommodation_carousel_2_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Accommodation Carousel 2", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "accommodation_carousel_2",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'sohohotel' ),
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
				"heading"		=> esc_html__( "Accommodation Category Slug (Leave blank to display all)", 'sohohotel' ),
				"param_name"	=> "hotel_category",
				"value"			=> "",
			),
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Rooms per page", 'sohohotel' ),
				"param_name"	=> "rooms_per_page",
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
		)
	) );
}
add_action( 'vc_before_init', 'accommodation_carousel_2_vc' );



// Accommodation Listing
function accommodation_listing_video_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Accommodation Listing Video", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "accommodation_listing_video",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Order", 'sohohotel' ),
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
				"heading"		=> esc_html__( "Accommodation Category Slug (Leave blank to display all)", 'sohohotel' ),
				"param_name"	=> "hotel_category",
				"value"			=> "",
			),
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Video Thumbnail", 'soho-hotel' ),
				"param_name"	=> "video_thumbnail",
				"value"			=> "",
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
add_action( 'vc_before_init', 'accommodation_listing_video_vc' );



// Hotel Listing
function hotel_listing_1_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Hotel Listing 1", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "hotel_listing_1",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Columns", 'sohohotel' ),
				"param_name"	=> "columns",
				"value"			=> array(
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4'
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Name 1", 'soho-hotel' ),
				"param_name"	=> "hotel_name_1",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Link 1", 'soho-hotel' ),
				"param_name"	=> "hotel_link_1",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Name 2", 'soho-hotel' ),
				"param_name"	=> "hotel_name_2",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Link 2", 'soho-hotel' ),
				"param_name"	=> "hotel_link_2",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Name 3", 'soho-hotel' ),
				"param_name"	=> "hotel_name_3",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Link 3", 'soho-hotel' ),
				"param_name"	=> "hotel_link_3",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Name 4", 'soho-hotel' ),
				"param_name"	=> "hotel_name_4",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Link 4", 'soho-hotel' ),
				"param_name"	=> "hotel_link_4",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'hotel_listing_1_vc' );



// Hotel Listing
function hotel_listing_2_vc() {
	vc_map( array(
		"name"					=> esc_html__( "Hotel Listing 2", 'sohohotel' ),
		"description"			=> esc_html__( "", 'sohohotel' ),
		"base"					=> "hotel_listing_2",
		'category'				=> "Soho Hotel Booking",
		"icon"					=> "",
		"params"				=> array(
			array(
				"type"			=> "dropdown",
				"admin_label"	=> false,
				"class"			=> "",
				"heading"		=> esc_html__( "Columns", 'sohohotel' ),
				"param_name"	=> "columns",
				"value"			=> array(
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4'
				),
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Name 1", 'soho-hotel' ),
				"param_name"	=> "hotel_name_1",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Link 1", 'soho-hotel' ),
				"param_name"	=> "hotel_link_1",
				"value"			=> "",
			),
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Image 1", 'soho-hotel' ),
				"param_name"	=> "hotel_image_1",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Name 2", 'soho-hotel' ),
				"param_name"	=> "hotel_name_2",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Link 2", 'soho-hotel' ),
				"param_name"	=> "hotel_link_2",
				"value"			=> "",
			),
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Image 2", 'soho-hotel' ),
				"param_name"	=> "hotel_image_2",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Name 3", 'soho-hotel' ),
				"param_name"	=> "hotel_name_3",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Link 3", 'soho-hotel' ),
				"param_name"	=> "hotel_link_3",
				"value"			=> "",
			),
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Image 3", 'soho-hotel' ),
				"param_name"	=> "hotel_image_3",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Name 4", 'soho-hotel' ),
				"param_name"	=> "hotel_name_4",
				"value"			=> "",
			),
			array(
				"type"			=> "textfield",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Link 4", 'soho-hotel' ),
				"param_name"	=> "hotel_link_4",
				"value"			=> "",
			),
			array(
				"type"			=> "attach_image",
				"admin_label"	=> true,
				"class"			=> "",
				"heading"		=> esc_html__( "Hotel Image 4", 'soho-hotel' ),
				"param_name"	=> "hotel_image_4",
				"value"			=> "",
			),
		)
	) );
}
add_action( 'vc_before_init', 'hotel_listing_2_vc' );



?>