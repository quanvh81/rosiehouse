<?php

function sohohotel_button_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
			'type' => '',
			'text' => '',
			'icon' => '',
			'link' => '',	
			'background_color' => '',
			'text_color' => '',
			'align' => '',
			'margin' => '',
		), $atts ) );
	
		if ( !empty($background_color) ) {$background_color_val = $background_color;} else {$background_color_val = '';}
		if ( !empty($text_color) ) {$text_color_val = $text_color;} else {$text_color_val = '';}
	
		if ( !empty($align) ) {
			
			if ( $align == 'center' ) {
				
				if (!empty($margin)) {
					$align_margin_val = 'margin: 0 auto ' . $margin . ' auto;';
				} else {
					$align_margin_val = 'margin: 0 auto 0 auto;';
				}
				
			} elseif ( $align == 'right' ) {
				
				if (!empty($margin)) {
					$align_margin_val = 'margin: 0 0 ' . $margin . ' 0;float:right;';
				} else {
					$align_margin_val = 'margin: 0;float:right;';
				}
				
			} else {
				
				if (!empty($margin)) {
					$align_margin_val = 'margin: 0 0 ' . $margin . ' 0;float:left;';
				} else {
					$align_margin_val = 'margin: 0;float:left;';
				}
				
			}
			
		} else {
			
			if (!empty($margin)) {
				$align_margin_val = 'margin: 0 0 ' . $margin . ' 0;';
			} else {
				$align_margin_val = 'margin: 0;';
			}
			
		}
		
	$output = '';
	
	if ($type == 'button1') {
		$output .= '<a href="' . $link . '" class="sohohotel-button1" style="background: ' . $background_color_val . ';color:' . $text_color_val . ';' . $align_margin_val . '">' . $text . ' <i class="fa ' . $icon . '"></i></a>';
		$output .= '<div class="sohohotel-clearboth"></div>';
	} else {
		$output .= '<a href="' . $link . '" class="sohohotel-button1" style="background: ' . $background_color_val . ';color:' . $text_color_val . ';' . $align_margin_val . '">' . $text . ' <i class="fa ' . $icon . '"></i></a>';
		$output .= '<div class="sohohotel-clearboth"></div>';
	}
	
	return $output;
	
}

add_shortcode( 'sohohotel_button', 'sohohotel_button_shortcode' );

?>