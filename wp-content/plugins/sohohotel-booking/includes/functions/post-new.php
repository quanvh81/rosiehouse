<?php

include_once('../../../../../wp-load.php');

// Move booking to trash
if ( !empty($_GET["action"]) && !empty($_GET["booking_id"]) ) {
	
	if ( $_GET["action"] == 'trash' ) {
		wp_trash_post( $_GET["booking_id"] );
		header("location:" . get_admin_url() . 'admin.php?page=booking_listing');
	}

// Updating existing booking
} elseif( !empty($_POST["booking_id"]) ) {
	
	$my_post = array(
		'ID'           => $_POST["booking_id"],
		'post_title'   => sanitize_title_for_query($_POST["post_title"])
	);
	
	wp_update_post( $my_post );
	update_post_meta($_POST["booking_id"], '_booking_meta', $_POST["_booking_meta"]);
	header("location:" . get_admin_url() . 'admin.php?page=booking_add&booking=' . $_POST["booking_id"]);
	
// Adding new booking
} else {
	
	// Add new post
	$post_id = wp_insert_post(array (
	   'post_type' => 'booking',
	   'post_title' => sanitize_title_for_query($_POST["post_title"]),
	   'post_content' => '',
	   'post_status' => 'publish',
	   'comment_status' => 'closed',
	   'ping_status' => 'closed',
	));

	// Save custom fields
	if ($post_id) {
	   add_post_meta($post_id, '_booking_meta', $_POST["_booking_meta"], true);
		header("location:" . get_admin_url() . 'admin.php?page=booking_add&booking=' . $post_id);
	}
	
}

?>