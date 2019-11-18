<?php



/* ----------------------------------------------------------------------------

   Init

---------------------------------------------------------------------------- */
add_action( 'init', 'booking_post_type' );



/* ----------------------------------------------------------------------------

   booking Post Type

---------------------------------------------------------------------------- */
function booking_post_type() {
	
	$labels = array(
        'name'                  => __('Booking','sohohotel_booking'),
        'singular_name'         => __('Booking','sohohotel_booking'),
        'menu_name'             => __('Booking','sohohotel_booking'),
        'parent_item_colon'     => __('Parent Booking:','sohohotel_booking'),
        'all_items'             => __('All Bookings','sohohotel_booking'),
        'view_item'             => __('View Booking','sohohotel_booking'),
        'add_new_item'          => __('Add New Booking','sohohotel_booking'),
        'add_new'               => __('Add Booking','sohohotel_booking'),
        'edit_item'             => __('Edit Booking','sohohotel_booking'),
        'update_item'           => __('Update Booking','sohohotel_booking'),
        'search_items'          => __('Search Booking','sohohotel_booking'),
        'not_found'             => __('Not found','sohohotel_booking'),
        'not_found_in_trash'    => __('Not found in Trash','sohohotel_booking'),
    );

    $args = array(
        'label'                 => __('booking','sohohotel_booking'),
        'description'           => '',
        'labels'                => $labels,
        'supports'              => array('title'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => false,
        'show_in_menu'          => false,
        'show_in_nav_menus'     => false,
        'show_in_admin_bar'     => false,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-home',
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );

    register_post_type( 'booking', $args );
	
}


?>