<?php sh_add_ical_post(); ?>

<p class="description"><?php esc_html_e('You can sync booking data for this room with iCal. Add the full iCal feed URL below e.g. http://website.com/feed.ics To add multiple feeds add a comma between each feed URL e.g. http://website.com/feed.ics,http://website.com/feed.ics','sohohotel_booking'); ?></p>
<textarea class="ical_data_input" rows="10" cols="40" name="_accommodation_meta[ical_feed]"><?php if($accommodation_meta['ical_feed']) {echo $accommodation_meta['ical_feed'];} ?></textarea>
<p class="description"><?php esc_html_e('The iCal URL for this room is:','sohohotel_booking'); ?> <a href="<?php echo get_site_url() . '/ical.ics?room_id=' . get_the_ID(); ?>"><?php echo get_site_url() . '/ical.ics?room_id=' . get_the_ID(); ?></a></p>