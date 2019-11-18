<?php

/*
  Plugin Name: Soho Hotel Shortcodes & Post Types
  Plugin URI: http://quitenicestuff.com
  Description: A Simple Shortcodes and Post Type Plugin
  Version: 3.0.3
  Author: Quite Nice Stuff
  Author URI: http://quitenicestuff.com
*/



/* ----------------------------------------------------------------------------

   Register Session

---------------------------------------------------------------------------- */
function register_session(){
	if( !session_id())
		session_start();
}

add_action('init','register_session');



/* ----------------------------------------------------------------------------

   Load Language Files

---------------------------------------------------------------------------- */
function sohohotel_init() {
	load_plugin_textdomain( 'sohohotel', false, dirname(plugin_basename( __FILE__ ))  . '/languages/' ); 
}
add_action('init', 'sohohotel_init');



/* ----------------------------------------------------------------------------

   Load Files

---------------------------------------------------------------------------- */
if ( ! defined( 'sohohotel_BASE_FILE' ) )
    define( 'sohohotel_BASE_FILE', __FILE__ );

if ( ! defined( 'sohohotel_BASE_DIR' ) )
    define( 'sohohotel_BASE_DIR', dirname( sohohotel_BASE_FILE ) );

if ( ! defined( 'sohohotel_PLUGIN_URL' ) )
    define( 'sohohotel_PLUGIN_URL', plugin_dir_url( __FILE__ ) );



/* ----------------------------------------------------------------------------

   Plugin Activation

---------------------------------------------------------------------------- */
function sohohotel_shortcodes_activation() {}
register_activation_hook(__FILE__, 'sohohotel_shortcodes_activation');

function sohohotel_shortcodes_deactivation() {}
register_deactivation_hook(__FILE__, 'sohohotel_shortcodes_deactivation');



/* ----------------------------------------------------------------------------

   Load JS

---------------------------------------------------------------------------- */
add_action('wp_enqueue_scripts', 'sohohotel_shortcodes_scripts');
function sohohotel_shortcodes_scripts() {
	
    global $post;
	global $sohohotel_data;

	$GoogleMapApiKey = $sohohotel_data['google-map-api-key'];
	
	wp_enqueue_script('jquery');
	
	if ( !empty($sohohotel_data['google-map-api-key']) ) {
		wp_register_script('googlesearch', 'https://maps.googleapis.com/maps/api/js?key=' . $GoogleMapApiKey);
		wp_enqueue_script('googlesearch');
	}
	
	wp_register_script('fontawesomemarkers', plugins_url('assets/js/fontawesome-markers.min.js', __FILE__));
	wp_enqueue_script('fontawesomemarkers');
	
	wp_enqueue_script( array( 'jquery-ui-core', 'jquery-ui-tabs', 'jquery-effects-core' ) );

}



/* ----------------------------------------------------------------------------

   WPML

---------------------------------------------------------------------------- */
global $sitepress;
if ( !empty($sitepress) ){
	define('AJAX_URL', admin_url('admin-ajax.php?lang=' . $sitepress->get_current_language()));
} else {
	define('AJAX_URL', admin_url('admin-ajax.php'));
}



/* ----------------------------------------------------------------------------

   Load CSS

---------------------------------------------------------------------------- */
add_action('wp_enqueue_scripts', 'sohohotel_shortcodes_styles');
function sohohotel_shortcodes_styles() {

	wp_register_style('style', plugins_url('assets/css/style.css', __FILE__));
    wp_enqueue_style('style');

}



/* ----------------------------------------------------------------------------

   Load Template Chooser

---------------------------------------------------------------------------- */
add_filter( 'template_include', 'sohohotel_spt_template_chooser');
function sohohotel_spt_template_chooser( $template ) {
 
    if ( is_search() ) {
		
		return $template;
		
	} else {
		
		$post_id = get_the_ID();

		if ( get_post_type( $post_id ) == 'fleet' ) {
			return sohohotel_spt_get_template_hierarchy( 'single-fleet' );
		} elseif ( get_post_type( $post_id ) == 'testimonial' ) {
			return sohohotel_spt_get_template_hierarchy( 'single-testimonials' );
		} elseif ( get_post_type( $post_id ) == 'rates' ) {
			return sohohotel_spt_get_template_hierarchy( 'single-rates' );
		} elseif ( get_post_type( $post_id ) == 'payment' ) {
			return sohohotel_spt_get_template_hierarchy( 'single-payment' );
		} else {
			return $template;
		}
		
	}

}



/* ----------------------------------------------------------------------------

   Select Template

---------------------------------------------------------------------------- */
add_filter( 'template_include', 'sohohotel_spt_template_chooser' );
function sohohotel_spt_get_template_hierarchy( $template ) {
 
	if ( is_search() ) {
		
		$file = sohohotel_BASE_DIR . '/includes/templates/' . $template;
		return apply_filters( 'sohohotel_template_' . $template, $file );
	
	} else {

    	$template_slug = rtrim( $template, '.php' );
	    $template = $template_slug . '.php';

	    if ( $theme_file = locate_template( array( 'includes/templates/' . $template ) ) ) {
	        $file = $theme_file;
	    }
	    else {
	        $file = sohohotel_BASE_DIR . '/includes/templates/' . $template;
	    }

	    return apply_filters( 'sohohotel_template_' . $template, $file );
	
	}

}



/* ----------------------------------------------------------------------------

   Update shortcodes for users updating 

---------------------------------------------------------------------------- */
function sohohotel_shortcode_updater() {
	
	// Array of shortcodes and attributes to replace
	$shortcodes_array = array(
		1=>array(
			"old_shortcode"=>"call_to_action_large",
			"new_shortcode"=>"sohohotel_call_to_action_large",
			"old_options"=>array(
				1=>"section_background_image_url",
				2=>"section_title",
				3=>"section_text",
				4=>"button_text",
				5=>"button_url"
			),
			"new_options"=>array(
				1=>"background_url",
				2=>"title",
				3=>"text",
				4=>"button_text",
				5=>"button_url"
			),
			"self_closing"=>true
		),
		2=>array(
			"old_shortcode"=>"call_to_action_small",
			"new_shortcode"=>"sohohotel_call_to_action_small",
			"old_options"=>array(
				1=>"section_background_image_url",
				2=>"section_text",
				3=>"button_text",
				4=>"button_url"
			),
			"new_options"=>array(
				1=>"background_url",
				2=>"text",
				3=>"button_text",
				4=>"button_url"
			),
			"self_closing"=>true
		),
		3=>array(
			"old_shortcode"=>"googlemap",
			"new_shortcode"=>"sohohotel_googlemap",
			"old_options"=>array(),
			"new_options"=>array(),
			"self_closing"=>true
		),
		4=>array(
			"old_shortcode"=>"contactdetails",
			"new_shortcode"=>"sohohotel_contact_details",
			"old_options"=>array(),
			"new_options"=>array(),
			"self_closing"=>true
		),
		5=>array(
			"old_shortcode"=>"news_carousel",
			"new_shortcode"=>"sohohotel_blog_carousel",
			"old_options"=>array(),
			"new_options"=>array(),
			"self_closing"=>true
		),
		6=>array(
			"old_shortcode"=>"news_page",
			"new_shortcode"=>"sohohotel_blog_page",
			"old_options"=>array(),
			"new_options"=>array(),
			"self_closing"=>true
		),
		7=>array(
			"old_shortcode"=>"testimonials_carousel",
			"new_shortcode"=>"sohohotel_testimonials_carousel",
			"old_options"=>array(),
			"new_options"=>array(),
			"self_closing"=>true
		),
		8=>array(
			"old_shortcode"=>"testimonials_page",
			"new_shortcode"=>"sohohotel_testimonials_page",
			"old_options"=>array(),
			"new_options"=>array(),
			"self_closing"=>true
		),
		9=>array(
			"old_shortcode"=>"socialmedia",
			"new_shortcode"=>"sohohotel_social_media",
			"old_options"=>array(),
			"new_options"=>array(),
			"self_closing"=>true
		),
		10=>array(
			"old_shortcode"=>"video_text",
			"new_shortcode"=>"sohohotel_video_text",
			"old_options"=>array(
				1=>"section_title",
				2=>"background"
			),
			"new_options"=>array(
				1=>"title",
				2=>"image"
			),
			"self_closing"=>true
		),
		11=>array(
			"old_shortcode"=>"videothumbnail",
			"new_shortcode"=>"sohohotel_video_thumbnail",
			"old_options"=>array(),
			"new_options"=>array(),
			"self_closing"=>true
		),
		12=>array(
			"old_shortcode"=>"msg",
			"new_shortcode"=>"sohohotel_msg",
			"old_options"=>array(),
			"new_options"=>array(),
			"self_closing"=>false
		),
		13=>array(
			"old_shortcode"=>"title",
			"new_shortcode"=>"sohohotel_title",
			"old_options"=>array(),
			"new_options"=>array(),
			"self_closing"=>false
		),
		14=>array(
			"old_shortcode"=>"accommodation_carousel ",
			"new_shortcode"=>"accommodation_carousel_1 ",
			"old_options"=>array(),
			"new_options"=>array(),
			"self_closing"=>true
		),
		15=>array(
			"old_shortcode"=>"accommodation ",
			"new_shortcode"=>"accommodation_listing_1 ",
			"old_options"=>array(),
			"new_options"=>array(),
			"self_closing"=>true
		)
	);
	
	// Get all page, post and accommodation IDs
	$all_post_page_ids = get_all_page_ids();

	$all_accommodation_ids = get_posts(array('fields' => 'ids','posts_per_page' => -1,'post_type' => 'accommodation'));
	foreach($all_accommodation_ids as $key => $val) {$all_post_page_ids[] = $val;}

	$all_post_ids = get_posts(array('fields' => 'ids','posts_per_page' => -1));
	foreach($all_post_ids as $key => $val) {$all_post_page_ids[] = $val;}

	// Loop through all page, post and accommodation IDs
	foreach($all_post_page_ids as $page_key => $page_val) {
		
		// Loop through each shortcode and replace
		foreach($shortcodes_array as $key => $val) {
		
			$original_content = get_post_field('post_content', $page_val);
			$new_content = sohohotel_shortcode_replace($val["old_shortcode"],$val["new_shortcode"],$val["old_options"],$val["new_options"],$val["self_closing"],$original_content);
	
			$my_post = array(
				'ID'           => $page_val,
				'post_title'   => get_the_title($page_val),
				'post_content' => $new_content,
			);
			
			wp_update_post( $my_post );
			
			$old_sohohotel_page_layout = get_post_meta($page_val, 'sohohotel_page_layout', true);
			
			if ( $old_sohohotel_page_layout == 'booking-system' ) {
				update_post_meta( $page_val, 'sohohotel_page_layout', 'full-width', $old_sohohotel_page_layout );
			}
			
		}
	
	}
	
	update_option( 'sohohotel_shortcode_update', 'updated', 'yes' );
	add_action( 'admin_notices', 'sohohotel_update_shortcodes_done_notice' );
	
}

if ( get_option('sohohotel_shortcode_update') == 'update_required') {
	if ( !empty($_GET['sh_shortcode_update']) ) {
		if ( $_GET['sh_shortcode_update'] == 'update' ) {
			add_action( 'admin_init', 'sohohotel_shortcode_updater' );
		}
	}
}



/* ----------------------------------------------------------------------------

   Check if shortcodes need updating

---------------------------------------------------------------------------- */
function sohohotel_check_old_shortcodes() {
	
	// Array of old shortcodes to check for
	$shortcodes_array = array(
		"[call_to_action_large",
		"[call_to_action_small",
		"[googlemap",
		"[contactdetails",
		"[news_carousel",
		"[news_page",
		"[testimonials_carousel",
		"[testimonials_page",
		"[socialmedia",
		"[video_text",
		"[videothumbnail",
		"[msg",
		"[title"
	);
	
	$old_shortcodes_exist = false;
	
	// Get all page, post and accommodation IDs
	$all_post_page_ids = get_all_page_ids();

	$all_accommodation_ids = get_posts(array('fields' => 'ids','posts_per_page' => -1,'post_type' => 'accommodation'));
	foreach($all_accommodation_ids as $key => $val) {$all_post_page_ids[] = $val;}

	$all_post_ids = get_posts(array('fields' => 'ids','posts_per_page' => -1));
	foreach($all_post_ids as $key => $val) {$all_post_page_ids[] = $val;}

	// Loop through all page, post and accommodation IDs
	foreach($all_post_page_ids as $page_key => $page_val) {
		
		$original_content = get_post_field('post_content', $page_val);
		
		foreach($shortcodes_array as $t) {
		    if (strpos($original_content,$t) !== false) {
		        $old_shortcodes_exist = true;
		        break;
		    }
		}
		
	}
	
	if ( $old_shortcodes_exist == true ) {
		add_option( 'sohohotel_shortcode_update', 'update_required', '', 'yes' );
	} else {
		add_option( 'sohohotel_shortcode_update', 'update_not_required', '', 'yes' );
	}

}

if ( empty(get_option('sohohotel_shortcode_update'))) {
	sohohotel_check_old_shortcodes();
}



/* ----------------------------------------------------------------------------

   If shortcodes need updating display a message

---------------------------------------------------------------------------- */
function sohohotel_update_shortcodes_notice() {
    ?>
    <div class="error notice sohohotel-shortcode-update-message">
        <p>
			<?php _e( 'Soho Hotel\'s version 3.0 update is a major update, before doing ANYTHING ', 'sohohotel' ); ?><a href="http://docs.quitenicestuff2.com/sohohotel/update3.html" target="_blank"><?php _e( 'please click here and read the update guide', 'sohohotel' ); ?></a>. <?php _e( 'After carefully reading the guide ', 'sohohotel' ); ?><a href="<?php echo get_admin_url();?>?sh_shortcode_update=update"><?php _e( 'click on the shortcode update link here', 'sohohotel' ); ?></a> <?php _e( 'to proceed updating.', 'sohohotel' ); ?>
		</p>
    </div>
    <?php
}

if ( get_option('sohohotel_shortcode_update') == 'update_required') {
	add_action( 'admin_notices', 'sohohotel_update_shortcodes_notice' );
}



/* ----------------------------------------------------------------------------

  After updating shortcodes display a message

---------------------------------------------------------------------------- */
function sohohotel_update_shortcodes_done_notice() {
    ?>
	
	<style type="text/css">.sohohotel-shortcode-update-message {display: none;}</style>
	
    <div class="notice-success notice">
        <p><?php _e( 'Update complete, if you have encountered any problems please ', 'sohohotel' ); ?> <a href="https://quitenicestuff.ticksy.com" target="_blank"><?php _e( 'open a support ticket', 'sohohotel' ); ?></a> <?php _e( 'or if your support has expired', 'sohohotel' ); ?> <a href="https://themeforest.net/user/quitenicestuff" target="_blank"><?php _e( 'contact me through the form on my profile page here', 'sohohotel' ); ?></a><?php _e( '. I\'m happy to help you fix any issues ASAP, so do not hesitate to get in touch if there are any problems. Please note my timezone is GMT+9, and I\'m generally available throughout the day, but if you contact me while it\'s night time I will not get back to you until the morning.', 'sohohotel' ); ?></p>
    </div>
    <?php
}



/* ----------------------------------------------------------------------------

   Update shortcodes for users updating 

---------------------------------------------------------------------------- */
function sohohotel_shortcode_replace($old_shortcode,$new_shortcode,$old_options,$new_options,$self_closing,$content) {
	
	$pattern_array = array();
	$replace_array = array();
	
	foreach($old_options as $key => $val) {
		$pattern_array[] = '#\[' . $old_shortcode . '(.*)' . $val . '="([^"]*)"(.*)\]#i';
	}
	
	foreach($new_options as $key => $val) {
		$replace_array[] = '[' . $old_shortcode . '$1' . $val . '="$2"$3]';
	}
	
	if ($old_shortcode == 'title') {
		
		$pattern_array[] = '#\[' . $old_shortcode . ' type="title2"]#i';
		$replace_array[] = '[' . $old_shortcode . ' type="title3"]';
		
		$pattern_array[] = '#\[' . $old_shortcode . ']#i';
		$replace_array[] = '[' . $old_shortcode . ' type="title2"]';
		
		$pattern_array[] = '#\[' . $old_shortcode . '([^]]*)]([^[]*)\[/' . $old_shortcode . ']#i';
		$replace_array[] = '[' . $new_shortcode . '$1 title1="$2"]';
		
	} else {
		
		if ($self_closing == true) {
			$pattern_array[] = '#\[' . $old_shortcode . '(.*)#i';
			$replace_array[] = '[' . $new_shortcode . '$1';
		} else {
			$pattern_array[] = '#\[' . $old_shortcode . '(.*?)\[/' . $old_shortcode . '\]#i';
			$replace_array[] = '[' . $new_shortcode . '$1[/' . $new_shortcode . ']';
		}
		
	}
	
	$content1 = preg_quote('[intro_section title_1="', '#');
	$content2 = preg_quote('" title_2="', '#');
	$content3 = preg_quote('" description="', '#');
	$content4 = preg_quote('" button_text="', '#');
	$content5 = preg_quote('" button_url="#"]', '#');
	$pattern_array[] = '#' . $content1 . '(.*?)' . $content2 . '(.*?)' . $content3 . '(.*?)' . $content4 . '(.*?)' . $content5 . '#i';
	$replace_array[] = '[sohohotel_title title1="$1" title2="$2"][vc_column_text]<p style="text-align: center;"><span style="color:#7e8286;">$3</span></p>[/vc_column_text][sohohotel_button align="center" background_color="#b99470" text_color="#ffffff" text="$4" link="$5" icon="fa-angle-right" margin="20px"]';
	
	return preg_replace($pattern_array, $replace_array, $content);
	
}



/* ----------------------------------------------------------------------------

   Load Post Types

---------------------------------------------------------------------------- */
include 'includes/post-types/testimonials.php';



/* ----------------------------------------------------------------------------

   Load Shortcodes

---------------------------------------------------------------------------- */
include 'includes/shortcodes/sohohotel-title.php';
include 'includes/shortcodes/sohohotel-button.php';
include 'includes/shortcodes/sohohotel-video-thumbnail.php';
include 'includes/shortcodes/sohohotel-testimonials-carousel.php';
include 'includes/shortcodes/sohohotel-testimonials-page.php';
include 'includes/shortcodes/sohohotel-blog-carousel.php';
include 'includes/shortcodes/sohohotel-blog-page.php';
include 'includes/shortcodes/sohohotel-call-to-action-large.php';
include 'includes/shortcodes/sohohotel-call-to-action-small.php';
include 'includes/shortcodes/sohohotel-icon-text.php';
include 'includes/shortcodes/sohohotel-image-text.php';
include 'includes/shortcodes/sohohotel-video-text.php';
include 'includes/shortcodes/sohohotel-gallery.php';
include 'includes/shortcodes/sohohotel-contact-details.php';
include 'includes/shortcodes/sohohotel-google-map.php';
include 'includes/shortcodes/sohohotel-social-media.php';
include 'includes/shortcodes/sohohotel-message.php';