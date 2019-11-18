<?php



/* ----------------------------------------------------------------------------

   Init

---------------------------------------------------------------------------- */
add_action( 'init', 'blocked_dates_post_type' );
add_action('add_meta_boxes', 'blocked_dates_meta_init');
add_action('save_post', 'blocked_dates_meta_save');



/* ----------------------------------------------------------------------------

   blocked_dates Post Type

---------------------------------------------------------------------------- */
function blocked_dates_post_type() {
	
	$labels = array(
        'name'                  => __('Blocked Dates','sohohotel_booking'),
        'singular_name'         => __('Blocked Dates','sohohotel_booking'),
        'menu_name'             => __('Blocked Dates','sohohotel_booking'),
        'parent_item_colon'     => __('Parent Blocked Dates:','sohohotel_booking'),
        'all_items'             => __('All Blocked Dates','sohohotel_booking'),
        'view_item'             => __('View Blocked Dates','sohohotel_booking'),
        'add_new_item'          => __('Add New Blocked Dates','sohohotel_booking'),
        'add_new'               => __('Add Blocked Dates','sohohotel_booking'),
        'edit_item'             => __('Edit Blocked Dates','sohohotel_booking'),
        'update_item'           => __('Update Blocked Dates','sohohotel_booking'),
        'search_items'          => __('Search Blocked Dates','sohohotel_booking'),
        'not_found'             => __('Not found','sohohotel_booking'),
        'not_found_in_trash'    => __('Not found in Trash','sohohotel_booking'),
    );

    $args = array(
        'label'                 => __('Blocked Dates','sohohotel_booking'),
        'description'           => '',
        'labels'                => $labels,
        'supports'              => array('title'),
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
    );

    register_post_type( 'blocked_dates', $args );
	
}



/* ----------------------------------------------------------------------------

   blocked_dates Meta Boxes

---------------------------------------------------------------------------- */
function blocked_dates_meta_init() {
	
	add_meta_box(
		'blocked_dates_pricing_details_meta', // id
		esc_html__( 'Blocked Date Details', 'sohohotel_booking' ), // title
		'blocked_dates_payment_details_meta_box', // callback
		'blocked_dates', // post type
		'normal',  // context
		'high' // priority
	);
	
    add_action('save_post','blocked_dates_meta_save');

}



/* ----------------------------------------------------------------------------

   Payment Details

---------------------------------------------------------------------------- */
function blocked_dates_payment_details_meta_box() {
	
    global $post;
    $blocked_dates_meta = get_post_meta($post->ID,'_blocked_dates_meta',TRUE);
    include(sohohotel_booking_BASE_DIR . '/includes/templates/admin/blocked_dates_meta.htm.php');
    echo '<input type="hidden" name="blocked_dates_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';

}



/* ----------------------------------------------------------------------------

   Save Meta Data

---------------------------------------------------------------------------- */
function blocked_dates_meta_save( $post_id ){
	
	if ( isset($_POST['blocked_dates_meta_noncename'])) {
		
		if (!wp_verify_nonce($_POST['blocked_dates_meta_noncename'],__FILE__)) {
			return $post_id;
		}

		if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;

		update_post_meta($post_id,'_blocked_dates_meta',$_POST['_blocked_dates_meta']);

	}

}


?>