<?php



/* ----------------------------------------------------------------------------

   Init

---------------------------------------------------------------------------- */
add_action( 'init', 'coupon_post_type' );
add_action('add_meta_boxes', 'coupon_meta_init');
add_action('save_post', 'coupon_meta_save');



/* ----------------------------------------------------------------------------

   coupon Post Type

---------------------------------------------------------------------------- */
function coupon_post_type() {
	
	$labels = array(
        'name'                  => __('Coupons','sohohotel_coupon'),
        'singular_name'         => __('Coupon','sohohotel_coupon'),
        'menu_name'             => __('Coupons','sohohotel_coupon'),
        'parent_item_colon'     => __('Parent Coupon:','sohohotel_coupon'),
        'all_items'             => __('All Coupons','sohohotel_coupon'),
        'view_item'             => __('View Coupon','sohohotel_coupon'),
        'add_new_item'          => __('Add New Coupon','sohohotel_coupon'),
        'add_new'               => __('Add Coupon','sohohotel_coupon'),
        'edit_item'             => __('Edit Coupon','sohohotel_coupon'),
        'update_item'           => __('Update Coupon','sohohotel_coupon'),
        'search_items'          => __('Search Coupon','sohohotel_coupon'),
        'not_found'             => __('Not found','sohohotel_coupon'),
        'not_found_in_trash'    => __('Not found in Trash','sohohotel_coupon'),
    );

    $args = array(
        'label'                 => __('Coupon','sohohotel_coupon'),
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

    register_post_type( 'coupon', $args );
	
}



/* ----------------------------------------------------------------------------

   coupon Meta Boxes

---------------------------------------------------------------------------- */
function coupon_meta_init() {
	
	add_meta_box(
		'coupon_pricing_details_meta', // id
		esc_html__( 'Payment Details', 'sohohotel_booking' ), // title
		'coupon_payment_details_meta_box', // callback
		'coupon', // post type
		'normal',  // context
		'high' // priority
	);
	
    add_action('save_post','coupon_meta_save');

}



/* ----------------------------------------------------------------------------

   Payment Details

---------------------------------------------------------------------------- */
function coupon_payment_details_meta_box() {
	
    global $post;
    $coupon_meta = get_post_meta($post->ID,'_coupon_meta',TRUE);
    include(sohohotel_booking_BASE_DIR . '/includes/templates/admin/coupon_meta.htm.php');
    echo '<input type="hidden" name="coupon_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';

}



/* ----------------------------------------------------------------------------

   Save Meta Data

---------------------------------------------------------------------------- */
function coupon_meta_save( $post_id ){
	
	if ( isset($_POST['coupon_meta_noncename'])) {
		
		if (!wp_verify_nonce($_POST['coupon_meta_noncename'],__FILE__)) {
			return $post_id;
		}

		if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;

		update_post_meta($post_id,'_coupon_meta',$_POST['_coupon_meta']);

	}

}


?>