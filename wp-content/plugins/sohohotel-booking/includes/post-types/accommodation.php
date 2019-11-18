<?php



/* ----------------------------------------------------------------------------

   Init

---------------------------------------------------------------------------- */
add_action( 'init', 'accommodation_post_type' );
add_action( 'init', 'accommodation_taxonomy' );
add_action('add_meta_boxes', 'accommodation_meta_init');
add_action('save_post', 'accommodation_meta_save');



/* ----------------------------------------------------------------------------

   Accommodation Post Type

---------------------------------------------------------------------------- */
function accommodation_post_type() {
	
	$labels = array(
        'name'                  => __('Accommodation','sohohotel_booking'),
        'singular_name'         => __('Accommodation','sohohotel_booking'),
        'menu_name'             => __('Accommodation','sohohotel_booking'),
        'parent_item_colon'     => __('Parent Room:','sohohotel_booking'),
        'all_items'             => __('All Accommodation','sohohotel_booking'),
        'view_item'             => __('View Room','sohohotel_booking'),
        'add_new_item'          => __('Add New Room','sohohotel_booking'),
        'add_new'               => __('Add Room','sohohotel_booking'),
        'edit_item'             => __('Edit Room','sohohotel_booking'),
        'update_item'           => __('Update Room','sohohotel_booking'),
        'search_items'          => __('Search Room','sohohotel_booking'),
        'not_found'             => __('Not found','sohohotel_booking'),
        'not_found_in_trash'    => __('Not found in Trash','sohohotel_booking'),
    );

    $args = array(
        'label'                 => __('accommodation','sohohotel_booking'),
        'description'           => '',
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-home',
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
		'rewrite' => array('slug' => esc_html__( 'accommodation', 'sohohotel_booking' ),'with_front' => false),
    );

    register_post_type( 'accommodation', $args );
	
}



/* ----------------------------------------------------------------------------

   Accommodation Taxonomy

---------------------------------------------------------------------------- */
function accommodation_taxonomy() {	
    register_taxonomy( 'accommodation-categories', 'accommodation', array( 'hierarchical' => true, 'label' => __('Hotel','sohohotel_booking'), 'query_var' => true, 'rewrite' => true ) );
}



/* ----------------------------------------------------------------------------

   Accommodation Meta Boxes

---------------------------------------------------------------------------- */
function accommodation_meta_init() {
	
	add_meta_box(
		'accommodation_excerpt_meta', // id
		'Room Excerpt', // title
		'show_excerpt_meta_box', // callback
		'accommodation', // post type
		'normal',  // context
		'high' // priority
	);
	
	add_meta_box(
		'accommodation_room_meta', // id
		'Room Options', // title
		'show_room_meta_box', // callback
		'accommodation', // post type
		'normal',  // context
		'high' // priority
	);
	
	add_meta_box(
		'accommodation_pricing_meta', // id
		'Pricing Options', // title
		'show_pricing_meta_box', // callback
		'accommodation', // post type
		'normal',  // context
		'high' // priority
	);
	
	add_meta_box(
		'accommodation_ical_meta', // id
		'iCal Feeds', // title
		'show_ical_meta_box', // callback
		'accommodation', // post type
		'normal',  // context
		'high' // priority
	);
	
    add_action('save_post','accommodation_meta_save');

}



/* ----------------------------------------------------------------------------

   Room Options

---------------------------------------------------------------------------- */
function show_room_meta_box() {
	
    global $post;
    $accommodation_meta = json_decode( get_post_meta($post->ID,'_accommodation_meta',TRUE), true );
    include(sohohotel_booking_BASE_DIR . '/includes/templates/admin/accommodation_room_meta.htm.php');
    echo '<input type="hidden" name="accommodation_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';

}



/* ----------------------------------------------------------------------------

   Excerpt

---------------------------------------------------------------------------- */
function show_excerpt_meta_box() {
	
    global $post;
	$accommodation_meta_room_excerpt = get_post_meta($post->ID,'_accommodation_room_excerpt_meta',TRUE);
    include(sohohotel_booking_BASE_DIR . '/includes/templates/admin/accommodation_excerpt_meta.htm.php');
    echo '<input type="hidden" name="accommodation_room_excerpt_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';

}



/* ----------------------------------------------------------------------------

   Pricing Options

---------------------------------------------------------------------------- */
function show_pricing_meta_box() {
	
    global $post;
    $accommodation_meta = json_decode( get_post_meta($post->ID,'_accommodation_meta',TRUE), true );
    include(sohohotel_booking_BASE_DIR . '/includes/templates/admin/accommodation_meta.htm.php');
    echo '<input type="hidden" name="accommodation_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';

}



/* ----------------------------------------------------------------------------

   iCal

---------------------------------------------------------------------------- */
function show_ical_meta_box() {
	
    global $post;
	$accommodation_meta = json_decode( get_post_meta($post->ID,'_accommodation_meta',TRUE), true );
    include(sohohotel_booking_BASE_DIR . '/includes/templates/admin/accommodation_ical_meta.htm.php');
    echo '<input type="hidden" name="accommodation_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';

}



/* ----------------------------------------------------------------------------

   Save Meta Data

---------------------------------------------------------------------------- */
function accommodation_meta_save( $post_id ){
	
	// Save room excerpt data
	if ( isset($_POST['accommodation_room_excerpt_meta_noncename'])) {
		
		if (!wp_verify_nonce($_POST['accommodation_room_excerpt_meta_noncename'],__FILE__)) {
			return $post_id;
		}

		if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
		
		update_post_meta($post_id,'_accommodation_room_excerpt_meta',$_POST['_accommodation_room_excerpt_meta']);

	}
	
	// Save all other room data
	if ( isset($_POST['accommodation_meta_noncename'])) {
		
		if (!wp_verify_nonce($_POST['accommodation_meta_noncename'],__FILE__)) {
			return $post_id;
		}

		if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
		
		$accommodation_meta = $_POST['_accommodation_meta'];
		$json_data = json_encode( $accommodation_meta );
		
		update_post_meta($post_id,'_accommodation_meta',$json_data);

	}

}


?>