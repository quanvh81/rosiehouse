<?php 

global $sohohotel_data; 

if ( !empty($sohohotel_data["weekly_booking_nights"]) ) {	
	$weekly_booking_nights = $sohohotel_data["weekly_booking_nights"];
} else {
	$weekly_booking_nights = '6';
}

if ( !empty($sohohotel_data["monthly_booking_nights"]) ) {	
	$monthly_booking_nights = $sohohotel_data["monthly_booking_nights"];
} else {
	$monthly_booking_nights = '28';
}

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

<!-- BEGIN .outer-tabs -->
<div class="outer-tabs clearfix">
	
	<ul class="clearfix">
		<li><a href="#price-per-night"><?php esc_html_e('Pricing Per Night','sohohotel_booking'); ?></a></li>
		<li><a href="#price-per-week"><?php esc_html_e('Pricing Per Week','sohohotel_booking'); ?></a></li>
		<li><a href="#price-per-month"><?php esc_html_e('Pricing Per Month','sohohotel_booking'); ?></a></li>
	</ul>
	
	<!-- BEGIN #price-per-night -->
	<div id="price-per-night">
		
		<p class="msg-guide"><?php esc_html_e('You are inside the "Pricing Per Night" tab, all prices added here will be applied when a guest books for less than','sohohotel_booking'); ?> <?php echo $weekly_booking_nights; ?> <?php esc_html_e('nights','sohohotel_booking'); ?></p>
		
		<!-- BEGIN .inner-tabs -->
		<div class="inner-tabs clearfix">

			<ul class="clearfix">
				<li><a href="#general-pricing"><?php esc_html_e('General Pricing','sohohotel_booking'); ?></a></li>
				<li><a href="#seasonal-pricing"><?php esc_html_e('Seasonal Pricing','sohohotel_booking'); ?></a></li>
			</ul>
			
			<!-- BEGIN .tab-content-wrapper -->
			<div class="tab-content-wrapper clearfix">
			
				<!-- BEGIN #general-pricing -->
				<div id="general-pricing" class="clearfix">

					<div class="sohohotel_booking-field-wrapper clearfix">
						<div class="sohohotel_booking-one-third"></div>
						<div class="sohohotel_booking-one-third"><label><?php echo $week_nights; ?></label></div>
						<div class="sohohotel_booking-one-third"><label><?php echo $weekend_nights; ?></label></div>
					</div>

					<div class="sohohotel_booking-field-wrapper clearfix">
						<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Adult','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
						<div class="sohohotel_booking-one-third"><input type="text" name="_accommodation_meta[price_adult_weekdays]" value="<?php echo $accommodation_meta['price_adult_weekdays']; ?>" class="price-validation" /></div>
						<div class="sohohotel_booking-one-third"><input type="text" name="_accommodation_meta[price_adult_weekends]" value="<?php echo $accommodation_meta['price_adult_weekends']; ?>" class="price-validation" /></div>
					</div>

					<div class="sohohotel_booking-field-wrapper clearfix">
						<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Child','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
						<div class="sohohotel_booking-one-third"><input type="text" name="_accommodation_meta[price_child_weekdays]" value="<?php echo $accommodation_meta['price_child_weekdays']; ?>" class="price-validation" /></div>
						<div class="sohohotel_booking-one-third"><input type="text" name="_accommodation_meta[price_child_weekends]" value="<?php echo $accommodation_meta['price_child_weekends']; ?>" class="price-validation" /></div>
					</div>

					<!-- BEGIN nightly additional pricing -->
					<div>

						<?php if (!empty($accommodation_meta['general_price_rules_1'])) {
							$general_price_rules_1 = $accommodation_meta['general_price_rules_1'];
						} else {
							$general_price_rules_1 = '';
						}
						echo seasonal_price_rules_form('1','pricerule',$general_price_rules_1); ?>

					<!-- END nightly additional pricing -->
					</div>

				<!-- END #general-pricing -->
				</div>

				<!-- BEGIN #seasonal-pricing -->
				<div id="seasonal-pricing">

					<!-- BEGIN nightly seasonal pricing -->
					<div>

						<?php if (!empty($accommodation_meta['general_price_rules_2'])) {
							$general_price_rules_2 = $accommodation_meta['general_price_rules_2'];
						} else {
							$general_price_rules_2 = '';
						}
						echo seasonal_price_rules_form('2','seasonal',$general_price_rules_2); ?>

					<!-- END nightly seasonal pricing -->
					</div>

				<!-- END #seasonal-pricing -->
				</div>
			
			<!-- END .tab-content-wrapper -->
			</div>

		<!-- END .inner-tabs -->
		</div>
		
	<!-- END #price-per-night -->
	</div>
	
	<!-- BEGIN #price-per-week -->
	<div id="price-per-week">
		
		<p class="msg-guide"><?php esc_html_e('You are inside the "Pricing Per Week" tab, all prices added here will be applied when a guest books for','sohohotel_booking'); ?> <?php echo $weekly_booking_nights; ?> <?php esc_html_e('nights or more','sohohotel_booking'); ?></p>
	
		<!-- BEGIN .inner-tabs -->
		<div class="inner-tabs clearfix">

			<ul class="clearfix">
				<li><a href="#general-pricing"><?php esc_html_e('General Pricing','sohohotel_booking'); ?></a></li>
				<li><a href="#seasonal-pricing"><?php esc_html_e('Seasonal Pricing','sohohotel_booking'); ?></a></li>
			</ul>
			
			<!-- BEGIN .tab-content-wrapper -->
			<div class="tab-content-wrapper clearfix">
			
				<!-- BEGIN #general-pricing -->
				<div id="general-pricing" class="clearfix">

					<div class="sohohotel_booking-field-wrapper clearfix">
						<div class="sohohotel_booking-one-third"></div>
						<div class="sohohotel_booking-one-third"><label><?php echo $week_nights; ?></label></div>
						<div class="sohohotel_booking-one-third"><label><?php echo $weekend_nights; ?></label></div>
					</div>

					<div class="sohohotel_booking-field-wrapper clearfix">
						<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Adult','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
						<div class="sohohotel_booking-one-third"><input type="text" name="_accommodation_meta[price_adult_weekdays_weekly]" value="<?php echo $accommodation_meta['price_adult_weekdays_weekly']; ?>" class="price-validation" /></div>
						<div class="sohohotel_booking-one-third"><input type="text" name="_accommodation_meta[price_adult_weekends_weekly]" value="<?php echo $accommodation_meta['price_adult_weekends_weekly']; ?>" class="price-validation" /></div>
					</div>

					<div class="sohohotel_booking-field-wrapper clearfix">
						<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Child','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
						<div class="sohohotel_booking-one-third"><input type="text" name="_accommodation_meta[price_child_weekdays_weekly]" value="<?php echo $accommodation_meta['price_child_weekdays_weekly']; ?>" class="price-validation" /></div>
						<div class="sohohotel_booking-one-third"><input type="text" name="_accommodation_meta[price_child_weekends_weekly]" value="<?php echo $accommodation_meta['price_child_weekends_weekly']; ?>" class="price-validation" /></div>
					</div>

					<!-- BEGIN weekly additional pricing -->
					<div>

						<?php if (!empty($accommodation_meta['general_price_rules_3'])) {
							$general_price_rules_3 = $accommodation_meta['general_price_rules_3'];
						} else {
							$general_price_rules_3 = '';
						}
						echo seasonal_price_rules_form('3','pricerule',$general_price_rules_3); ?>

					<!-- END weekly additional pricing -->
					</div>

				<!-- END #general-pricing -->
				</div>

				<!-- BEGIN #seasonal-pricing -->
				<div id="seasonal-pricing">

					<!-- BEGIN weekly seasonal pricing -->
					<div>

						<?php if (!empty($accommodation_meta['general_price_rules_4'])) {
							$general_price_rules_4 = $accommodation_meta['general_price_rules_4'];
						} else {
							$general_price_rules_4 = '';
						}
						echo seasonal_price_rules_form('4','seasonal',$general_price_rules_4); ?>

					<!-- END weekly seasonal pricing -->
					</div>

				<!-- END #seasonal-pricing -->
				</div>
			
			<!-- END .tab-content-wrapper -->
			</div>

		<!-- END .inner-tabs -->
		</div>
		
	<!-- END #price-per-week -->
	</div>
	
	<!-- BEGIN #price-per-month -->
	<div id="price-per-month">
		
		<p class="msg-guide"><?php esc_html_e('You are inside the "Pricing Per Month" tab, all prices added here will be applied when a guest books for','sohohotel_booking'); ?> <?php echo $monthly_booking_nights; ?> <?php esc_html_e('nights or more','sohohotel_booking'); ?></p>
		
		<!-- BEGIN .inner-tabs -->
		<div class="inner-tabs clearfix">

			<ul class="clearfix">
				<li><a href="#general-pricing"><?php esc_html_e('General Pricing','sohohotel_booking'); ?></a></li>
				<li><a href="#seasonal-pricing"><?php esc_html_e('Seasonal Pricing','sohohotel_booking'); ?></a></li>
			</ul>
			
			<!-- BEGIN .tab-content-wrapper -->
			<div class="tab-content-wrapper clearfix">
			
				<!-- BEGIN #general-pricing -->
				<div id="general-pricing" class="clearfix">

					<div class="sohohotel_booking-field-wrapper clearfix">
						<div class="sohohotel_booking-one-third"></div>
						<div class="sohohotel_booking-one-third"><label><?php echo $week_nights; ?></label></div>
						<div class="sohohotel_booking-one-third"><label><?php echo $weekend_nights; ?></label></div>
					</div>

					<div class="sohohotel_booking-field-wrapper clearfix">
						<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Adult','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
						<div class="sohohotel_booking-one-third"><input type="text" name="_accommodation_meta[price_adult_weekdays_monthly]" value="<?php echo $accommodation_meta['price_adult_weekdays_monthly']; ?>" class="price-validation" /></div>
						<div class="sohohotel_booking-one-third"><input type="text" name="_accommodation_meta[price_adult_weekends_monthly]" value="<?php echo $accommodation_meta['price_adult_weekends_monthly']; ?>" class="price-validation" /></div>
					</div>

					<div class="sohohotel_booking-field-wrapper clearfix">
						<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Child','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
						<div class="sohohotel_booking-one-third"><input type="text" name="_accommodation_meta[price_child_weekdays_monthly]" value="<?php echo $accommodation_meta['price_child_weekdays_monthly']; ?>" class="price-validation" /></div>
						<div class="sohohotel_booking-one-third"><input type="text" name="_accommodation_meta[price_child_weekends_monthly]" value="<?php echo $accommodation_meta['price_child_weekends_monthly']; ?>" class="price-validation" /></div>
					</div>

					<!-- BEGIN monthly additional pricing -->
					<div>

						<?php if (!empty($accommodation_meta['general_price_rules_5'])) {
							$general_price_rules_5 = $accommodation_meta['general_price_rules_5'];
						} else {
							$general_price_rules_5 = '';
						}
						echo seasonal_price_rules_form('5','pricerule',$general_price_rules_5); ?>

					<!-- END monthly additional pricing -->
					</div>

				<!-- END #general-pricing -->
				</div>

				<!-- BEGIN #seasonal-pricing -->
				<div id="seasonal-pricing">

					<!-- BEGIN nightly seasonal pricing -->
					<div>

						<?php if (!empty($accommodation_meta['general_price_rules_6'])) {
							$general_price_rules_6 = $accommodation_meta['general_price_rules_6'];
						} else {
							$general_price_rules_6 = '';
						}
						echo seasonal_price_rules_form('6','seasonal',$general_price_rules_6); ?>

					<!-- END nightly seasonal pricing -->
					</div>

				<!-- END #seasonal-pricing -->
				</div>
			
			<!-- END .tab-content-wrapper -->
			</div>

		<!-- END .inner-tabs -->
		</div>
		
	<!-- END #price-per-month -->
	</div>
	
<!-- END .outer-tabs -->
</div>

<!-- BEGIN .price-templates -->
<div class="price-templates">

	<!-- BEGIN .price-rule-wrapper -->
	<div class="price-rule-wrapper" style="display:none;">

		<!-- BEGIN .price-rule-wrapper-inner -->
		<div class="price-rule-wrapper-inner">

			<div class="price-rule-number">
				<?php esc_html_e('Price rule #','sohohotel_booking'); ?><span><?php esc_html_e('1','sohohotel_booking'); ?></span>
			</div>

			<div class="sohohotel_booking-field-wrapper clearfix">
				<div class="sohohotel_booking-one-third"></div>
				<div class="sohohotel_booking-one-third"><label><?php echo $week_nights; ?></label></div>
				<div class="sohohotel_booking-one-third"><label><?php echo $weekend_nights; ?></label></div>
			</div>

			<div class="sohohotel_booking-field-wrapper clearfix">
				<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Adult','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
				<div class="sohohotel_booking-one-third"><input type="text" name="standard-adult-weekday" class="standard-adult-weekday price-validation" /></div>
				<div class="sohohotel_booking-one-third"><input type="text" name="standard-adult-weekend" class="standard-adult-weekend price-validation" /></div>
			</div>

			<div class="sohohotel_booking-field-wrapper clearfix">
				<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Child','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
				<div class="sohohotel_booking-one-third"><input type="text" name="standard-child-weekday" class="standard-child-weekday price-validation" /></div>
				<div class="sohohotel_booking-one-third"><input type="text" name="standard-child-weekend" class="standard-child-weekend price-validation" /></div>
			</div>

			<button class="button remove-price-rule" type="button"><?php esc_html_e('Remove price filter','sohohotel_booking'); ?></button>

		<!-- END .price-rule-wrapper-inner -->
		</div>

	<!-- END .price-rule-wrapper -->
	</div>

	<!-- BEGIN .seasonal-filter-wrapper -->
	<div class="seasonal-filter-wrapper" style="display:none;">

		<!-- BEGIN .seasonal-filter-wrapper-inner -->
		<div class="seasonal-filter-wrapper-inner">

			<div class="seasonal-filter-number">
				<?php esc_html_e('Seasonal Filter #','sohohotel_booking'); ?><span><?php esc_html_e('1','sohohotel_booking'); ?></span>
			</div>

			<div class="sohohotel_booking-field-wrapper clearfix">
				<div class="sohohotel_booking-one-third"></div>
				<div class="sohohotel_booking-one-third"><label><?php esc_html_e('Date From','sohohotel_booking'); ?></label></div>
				<div class="sohohotel_booking-one-third"><label><?php esc_html_e('Date To','sohohotel_booking'); ?></label></div>
			</div>

			<div class="sohohotel_booking-field-wrapper clearfix">
				<div class="sohohotel_booking-one-third"><?php esc_html_e('Date Range','sohohotel_booking'); ?></div>
				<div class="sohohotel_booking-one-third"><input type="text" name="seasonal-date-from" class="datepicker seasonal-date-from" /></div>
				<div class="sohohotel_booking-one-third"><input type="text" name="seasonal-date-to" class="datepicker seasonal-date-to" /></div>
			</div>

			<div class="sohohotel_booking-field-wrapper clearfix">
				<div class="sohohotel_booking-one-third"></div>
				<div class="sohohotel_booking-one-third"><label><?php echo $week_nights; ?></label></div>
				<div class="sohohotel_booking-one-third"><label><?php echo $weekend_nights; ?></label></div>
			</div>

			<div class="sohohotel_booking-field-wrapper clearfix">
				<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Adult','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
				<div class="sohohotel_booking-one-third"><input type="text" name="seasonal-adult-weekday" class="seasonal-adult-weekday price-validation" /></div>
				<div class="sohohotel_booking-one-third"><input type="text" name="seasonal-adult-weekend" class="seasonal-adult-weekend price-validation" /></div>
			</div>

			<div class="sohohotel_booking-field-wrapper clearfix">
				<div class="sohohotel_booking-one-third"><?php esc_html_e('Per Child','sohohotel_booking'); ?> (<?php echo $sohohotel_data['currency_unit']; ?>)</div>
				<div class="sohohotel_booking-one-third"><input type="text" name="seasonal-child-weekday" class="seasonal-child-weekday price-validation" /></div>
				<div class="sohohotel_booking-one-third"><input type="text" name="seasonal-child-weekend" class="seasonal-child-weekend price-validation" /></div>
			</div>	
			
			<div class="price-rule-wrapper-outer"></div>
			<button class="add-price-rule-season button-primary" type="button"><?php esc_html_e('Add Price Rule','sohohotel_booking'); ?></button>
			<button class="button remove-price-rule" type="button"><?php esc_html_e('Remove seasonal price filter','sohohotel_booking'); ?></button>

		<!-- END .seasonal-filter-wrapper-inner -->
		</div>

	<!-- END .seasonal-filter-wrapper -->
	</div>

<!-- END .price-templates -->
</div>