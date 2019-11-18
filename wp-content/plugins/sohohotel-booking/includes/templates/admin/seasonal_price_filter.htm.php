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

	<!-- BEGIN .seasonal-filter-wrapper-inner -->
	<div class="seasonal-filter-wrapper-inner">

		<div class="seasonal-filter-number">
			<?php esc_html_e('Seasonal Filter #','sohohotel_booking'); ?><span><?php echo $key; ?></span>
		</div>

		<div class="sohohotel_booking-field-wrapper clearfix">
			<div class="sohohotel_booking-one-third"></div>
			<div class="sohohotel_booking-one-third"><label><?php esc_html_e('Date From','sohohotel_booking'); ?></label></div>
			<div class="sohohotel_booking-one-third"><label><?php esc_html_e('Date To','sohohotel_booking'); ?></label></div>
		</div>

		<div class="sohohotel_booking-field-wrapper clearfix">
			<div class="sohohotel_booking-one-third"><?php esc_html_e('Date Range','sohohotel_booking'); ?></div>
			<div class="sohohotel_booking-one-third"><input type="text" name="<?php if( strlen($key) != 0 ) { echo 'seasonal-date-from' . '-' . $key; } ?>" <?php if( strlen($season["date_range_from"]) != 0 ) { echo 'value="'.$season["date_range_from"] . '"'; } ?> class="datepicker seasonal-date-from" /></div>
			<div class="sohohotel_booking-one-third"><input type="text" name="<?php if( strlen($key) != 0 ) { echo 'seasonal-date-to' . '-' . $key; } ?>" <?php if( strlen($season["date_range_to"]) != 0 ) { echo 'value="'.$season["date_range_to"] . '"'; } ?> class="datepicker seasonal-date-to" /></div>
		</div>

		<div class="sohohotel_booking-field-wrapper clearfix">
			<div class="sohohotel_booking-one-third"></div>
			<div class="sohohotel_booking-one-third"><label><?php echo $week_nights; ?></label></div>
			<div class="sohohotel_booking-one-third"><label><?php echo $weekend_nights; ?></label></div>
		</div>

		<div class="sohohotel_booking-field-wrapper clearfix">
			<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Adult','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
			<div class="sohohotel_booking-one-third"><input type="text" name="<?php if( strlen($key) != 0 ) { echo 'seasonal-adult-weekday' . '-' . $key; } ?>" <?php if( strlen($season["season_adult_weekdays"]) != 0 ) { echo 'value="'.$season["season_adult_weekdays"] . '"'; } ?> class="seasonal-adult-weekday price-validation" /></div>
			<div class="sohohotel_booking-one-third"><input type="text" name="<?php if( strlen($key) != 0 ) { echo 'seasonal-adult-weekend' . '-' . $key; } ?>" <?php if( strlen($season["season_adult_weekends"]) != 0 ) { echo 'value="'.$season["season_adult_weekends"] . '"'; } ?> class="seasonal-adult-weekend price-validation" /></div>
		</div>

		<div class="sohohotel_booking-field-wrapper clearfix">
			<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Child','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
			<div class="sohohotel_booking-one-third"><input type="text" name="<?php if( strlen($key) != 0 ) { echo 'seasonal-child-weekday' . '-' . $key; } ?>" <?php if( strlen($season["season_child_weekdays"]) != 0 ) { echo 'value="'.$season["season_child_weekdays"] . '"'; } ?> class="seasonal-child-weekday price-validation" /></div>
			<div class="sohohotel_booking-one-third"><input type="text" name="<?php if( strlen($key) != 0 ) { echo 'seasonal-child-weekend' . '-' . $key; } ?>" <?php if( strlen($season["season_child_weekends"]) != 0 ) { echo 'value="'.$season["season_child_weekends"] . '"'; } ?> class="seasonal-child-weekend price-validation" /></div>
		</div>	

		<button class="add-price-rule-season button-primary" type="button"><?php esc_html_e('Add Price Rule','sohohotel_booking'); ?></button>
		<button class="button remove-price-rule" type="button"><?php esc_html_e('Remove seasonal price filter','sohohotel_booking'); ?></button>
		
		<div class="price-rule-wrapper-outer">
			<?php if (!empty($season["price"][1])) {
		        foreach ($season["price"] as $keyPrice => $seasonPrice) {
		            include (sohohotel_booking_BASE_DIR . "/includes/templates/admin/price_rule.htm.php");
		        }
		    } ?>
		</div>
		
	<!-- END .seasonal-filter-wrapper-inner -->
	</div>