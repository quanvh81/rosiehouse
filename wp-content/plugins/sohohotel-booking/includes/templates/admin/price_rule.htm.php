<?php 

global $sohohotel_data;

if ( !empty($sohohotel_data["weekend_nights"]) ) {
	
	if ( $sohohotel_data["weekend_nights"] == '1' ) {
		$week_nights = esc_html__('Weekdays (Sun - Thu)', 'sohohotel_booking');
		$weekend_nights = esc_html__('Weekends (Fri - Sat)', 'sohohotel_booking');
	} elseif ( $sohohotel_data["weekend_nights"] == '2' ) {
		$week_nights = esc_html__('Weekdays (Mon - Fri)', 'sohohotel_booking');
		$weekend_nights = esc_html__('Weekends (Sat - Sun)', 'sohohotel_booking');
	} elseif ( $sohohotel_data["weekend_nights"] == '3' ) {
		$week_nights = esc_html__('Weekdays (Sun - Wed)', 'sohohotel_booking');
		$weekend_nights = esc_html__('Weekends (Thu - Sat)', 'sohohotel_booking');
	} else {
		$week_nights = esc_html__('Weekdays (Mon - Thu)', 'sohohotel_booking');
		$weekend_nights = esc_html__('Weekends (Fri - Sun)', 'sohohotel_booking');
	}
	
} else {
	$week_nights = esc_html__('Weekdays (Sun - Thu)', 'sohohotel_booking');
	$weekend_nights = esc_html__('Weekends (Fri - Sat)', 'sohohotel_booking');
}

?>

<!-- BEGIN .price-rule-wrapper-inner -->
<div class="price-rule-wrapper-inner">

	<div class="price-rule-number">
		<?php esc_html_e('Price rule #','sohohotel_booking'); ?><span><?php if( strlen($keyPrice) != 0 ) {echo $keyPrice;} else {echo $key;} ?></span>
	</div>
	
	<div class="sohohotel_booking-field-wrapper clearfix">
		<div class="sohohotel_booking-one-third"></div>
		<div class="sohohotel_booking-one-third"><label><?php echo $week_nights; ?></label></div>
		<div class="sohohotel_booking-one-third"><label><?php echo $weekend_nights; ?></label></div>
	</div>

	<div class="sohohotel_booking-field-wrapper clearfix">
		<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Adult','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
		<div class="sohohotel_booking-one-third"><input type="text" name="<?php echo 'standard-adult-weekday' . '-'; ?><?php if( strlen($keyPrice) != 0 ) {echo $keyPrice;} else {echo $key;} ?>" <?php if( strlen($season["price_adult_weekdays"]) != 0 ) { echo 'value="'.$season["price_adult_weekdays"] . '"'; } ?><?php if( strlen($seasonPrice["price_adult_weekdays"]) != 0 ) { echo 'value="'.$seasonPrice["price_adult_weekdays"] . '"'; } ?> class="standard-adult-weekday price-validation" /></div>
		<div class="sohohotel_booking-one-third">
			
			<input type="text" name="<?php echo 'standard-adult-weekend' . '-'; ?><?php if( strlen($keyPrice) != 0 ) {echo $keyPrice;} else {echo $key;} ?>" <?php if( strlen($season["price_adult_weekends"]) != 0 ) { echo 'value="'.$season["price_adult_weekends"] . '"'; } ?><?php if( strlen($seasonPrice["price_adult_weekends"]) != 0 ) { echo 'value="'.$seasonPrice["price_adult_weekends"] . '"'; } ?> class="standard-adult-weekend price-validation" />
			</div>
	</div>
	
	<div class="sohohotel_booking-field-wrapper clearfix">
		<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Child','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
		<div class="sohohotel_booking-one-third">
			
			<input type="text" name="<?php echo 'standard-child-weekday' . '-'; ?><?php if( strlen($keyPrice) != 0 ) {echo $keyPrice;} else {echo $key;} ?>" <?php if( strlen($season["price_child_weekdays"]) != 0 ) { echo 'value="'.$season["price_child_weekdays"] . '"'; } ?><?php if( strlen($seasonPrice["price_child_weekdays"]) != 0 ) { echo 'value="'.$seasonPrice["price_child_weekdays"] . '"'; } ?> class="standard-child-weekday price-validation" />
			
			
			</div>
		<div class="sohohotel_booking-one-third"><input type="text" name="<?php echo 'standard-child-weekend' . '-'; ?><?php if( strlen($keyPrice) != 0 ) {echo $keyPrice;} else {echo $key;} ?>" <?php if( strlen($season["price_child_weekends"]) != 0 ) { echo 'value="'.$season["price_child_weekends"] . '"'; } ?><?php if( strlen($seasonPrice["price_child_weekends"]) != 0 ) { echo 'value="'.$seasonPrice["price_child_weekends"] . '"'; } ?> class="standard-child-weekend price-validation" /></div>
	</div>
		
	<button class="button remove-price-rule" type="button"><?php esc_html_e('Remove price filter','sohohotel_booking'); ?></button>

<!-- END .price-rule-wrapper-inner -->
</div>