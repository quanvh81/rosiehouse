<?php

// Widget Class
class sohohotel_contact_widget extends WP_Widget {


/* ----------------------------------------------------------------------------

   Widget setup

---------------------------------------------------------------------------- */

	function __construct() {
		
		parent::__construct(false, $name = esc_html__('Soho Hotel Contact Details','soho-hotel'), array(
			'description' => esc_html__('Display Contact Details','soho-hotel')
		));
	
	}


/* ----------------------------------------------------------------------------

   Display widget

---------------------------------------------------------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$contact_address = apply_filters('contact_address', $instance['contact_address'] );
		$contact_phone = apply_filters('contact_phone', $instance['contact_phone'] );
		$contact_cell_phone = apply_filters('contact_cell_phone', $instance['contact_cell_phone'] );
		$contact_email = apply_filters('contact_email', $instance['contact_email'] );
		
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		 } ?>
		
		<ul class="sohohotel-contact-widget">
			<?php if ($contact_address != '') {echo '<li class="sohohotel-address">'. esc_textarea($instance['contact_address']) . '</li>';} ?>
			<?php if ($contact_phone != '') {echo '<li class="sohohotel-phone">'. esc_textarea($instance['contact_phone']) . '</li>';} ?>
			<?php if ($contact_cell_phone != '') {echo '<li class="sohohotel-cell-phone">'. esc_textarea($instance['contact_cell_phone']) . '</li>';} ?>
			<?php if ($contact_email != '') {echo '<li class="sohohotel-email">'. esc_textarea($instance['contact_email']) . '</li>';} ?>
		</ul>
		
		<?php
		
		echo $after_widget;
	}	
	
	
/* ----------------------------------------------------------------------------

   Update widget

---------------------------------------------------------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['contact_address'] = strip_tags( $new_instance['contact_address'] );
		$instance['contact_phone'] = strip_tags( $new_instance['contact_phone'] );
		$instance['contact_cell_phone'] = strip_tags( $new_instance['contact_cell_phone'] );
		$instance['contact_email'] = strip_tags( $new_instance['contact_email'] );
		return $instance;
	}
	
	
/* ----------------------------------------------------------------------------

   Widget input form

---------------------------------------------------------------------------- */

	function form( $instance ) {
		$defaults = array(
		'title' => 'Contact',
		'contact_address' => '55 Columbus Circle, New York, NY',
		'contact_phone' => '1111-2222-3333',
		'contact_cell_phone' => '3333-2222-1111',
		'contact_email' => 'booking@example.com'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'soho-hotel'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'contact_address' )); ?>"><?php esc_html_e('Address/Location:', 'soho-hotel') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_address')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_address')); ?>" value="<?php echo esc_attr($instance['contact_address']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'contact_phone' )); ?>"><?php esc_html_e('Phone Number:', 'soho-hotel') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_phone')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_phone')); ?>" value="<?php echo esc_attr($instance['contact_phone']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'contact_cell_phone' )); ?>"><?php esc_html_e('Cell Phone Number:', 'soho-hotel') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_cell_phone')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_cell_phone')); ?>" value="<?php echo esc_attr($instance['contact_cell_phone']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'contact_email' )); ?>"><?php esc_html_e('Email Address:', 'soho-hotel') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_email')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_email')); ?>" value="<?php echo esc_attr($instance['contact_email']); ?>" />
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'sohohotel_contact_widget' );

// Register Widget
function sohohotel_contact_widget() {
	register_widget( 'sohohotel_contact_widget' );
}