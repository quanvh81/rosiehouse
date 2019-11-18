<?php



/* ----------------------------------------------------------------------------

   Init

---------------------------------------------------------------------------- */
add_action( 'init', 'service_post_type' );
add_action('add_meta_boxes', 'service_meta_init');
add_action('save_post', 'service_meta_save');



/* ----------------------------------------------------------------------------

   service Post Type

---------------------------------------------------------------------------- */
function service_post_type() {
	
	$labels = array(
        'name'                  => __('Services','qns'),
        'singular_name'         => __('Services','qns'),
        'menu_name'             => __('Services','qns'),
        'parent_item_colon'     => __('Parent Service:','qns'),
        'all_items'             => __('All Services','qns'),
        'view_item'             => __('View Services','qns'),
        'add_new_item'          => __('Add New Service','qns'),
        'add_new'               => __('Add Service','qns'),
        'edit_item'             => __('Edit Service','qns'),
        'update_item'           => __('Update Service','qns'),
        'search_items'          => __('Search Service','qns'),
        'not_found'             => __('Not found','qns'),
        'not_found_in_trash'    => __('Not found in Trash','qns'),
    );

    $args = array(
        'label'                 => __('service','qns'),
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
        'menu_icon'             => 'dashicons-editor-ul',
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );

    register_post_type( 'service', $args );
	
}



/* ----------------------------------------------------------------------------

   service Meta Boxes

---------------------------------------------------------------------------- */
function service_meta_init() {

	add_meta_box(
		'service_service_meta', // id
		'Service Options', // title
		'show_service_meta_box', // callback
		'service', // post type
		'normal',  // context
		'high' // priority
	);
	
    add_action('save_post','service_meta_save');

}



/* ----------------------------------------------------------------------------

   service Options

---------------------------------------------------------------------------- */
function show_service_meta_box() {
	
    global $post;
    $service_meta = get_post_meta($post->ID,'_service_meta',TRUE);
    include(sohohotel_booking_BASE_DIR . '/includes/templates/admin/service_meta.htm.php');
    echo '<input type="hidden" name="service_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';

}



/* ----------------------------------------------------------------------------

   Save Meta Data

---------------------------------------------------------------------------- */
function service_meta_save( $post_id ){
	
	if ( isset($_POST['service_meta_noncename'])) {
		
		if (!wp_verify_nonce($_POST['service_meta_noncename'],__FILE__)) {
			return $post_id;
		}

		if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;

		update_post_meta($post_id,'_service_meta',$_POST['_service_meta']);
		
	}

}


?>