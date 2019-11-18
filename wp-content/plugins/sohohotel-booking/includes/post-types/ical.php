<?php



/* ----------------------------------------------------------------------------

   Init

---------------------------------------------------------------------------- */
add_action( 'init', 'ical_post_type' );



/* ----------------------------------------------------------------------------

   ical Post Type

---------------------------------------------------------------------------- */
function ical_post_type() {

    $args = array(
        'label'                 => __('ical','sohohotel_booking'),
        'description'           => '',
        'supports'              => array('title'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => false,
        'show_in_menu'          => false,
        'show_in_nav_menus'     => false,
        'show_in_admin_bar'     => false,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-home',
        'can_export'            => false,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
		'rewrite' => array('slug' => esc_html__( 'ical.ics', 'sohohotel_booking' ),'with_front' => false),
    );

    register_post_type( 'ical', $args );
	
}


?>