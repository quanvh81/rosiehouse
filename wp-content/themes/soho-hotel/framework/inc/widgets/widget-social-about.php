<?php

// Widget Class
class sohohotel_social_about_widget extends WP_Widget {


/* ----------------------------------------------------------------------------

   Widget setup

---------------------------------------------------------------------------- */

	function __construct() {
		
		parent::__construct(false, $name = esc_html__('Soho Hotel Social Icons & About Us','soho-hotel'), array(
			'description' => esc_html__('Display social icons & about us','soho-hotel')
		));
	
	}


/* ----------------------------------------------------------------------------

   Display widget

---------------------------------------------------------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$about_us = apply_filters('about_us', $instance['about_us'] );
		$facebook = apply_filters('facebook', $instance['facebook'] );
		$twitter = apply_filters('twitter', $instance['twitter'] );
		$instagram = apply_filters('instagram', $instance['instagram'] );
		$yelp = apply_filters('yelp', $instance['yelp'] );
		$youtube = apply_filters('youtube', $instance['youtube'] );
		$tripadvisor = apply_filters('tripadvisor', $instance['tripadvisor'] );
		$pinterest = apply_filters('pinterest', $instance['pinterest'] );
		$skype = apply_filters('skype', $instance['skype'] );
		$flickr = apply_filters('flickr', $instance['flickr'] );
		$googleplus = apply_filters('googleplus', $instance['googleplus'] );
		$tumblr = apply_filters('tumblr', $instance['tumblr'] );
		$vimeo = apply_filters('vimeo', $instance['vimeo'] );
		
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		 } ?>
		
		<div class="sohohotel-footer-social-icons-wrapper">
			
			<?php if ($about_us != '') {echo $instance['about_us'];} ?>
				
			<?php if ($facebook != '') {echo '<a target="_blank" href="' . $instance['facebook'] . '"><i class="fa fa-facebook"></i></a>';} ?>
			<?php if ($twitter != '') {echo '<a target="_blank" href="' . $instance['twitter'] . '"><i class="fa fa-twitter"></i></a>';} ?>
			<?php if ($instagram != '') {echo '<a target="_blank" href="' . $instance['instagram'] . '"><i class="fa fa-instagram"></i></a>';} ?>
			<?php if ($yelp != '') {echo '<a target="_blank" href="' . $instance['yelp'] . '"><i class="fa fa-yelp"></i></a>';} ?>
			<?php if ($youtube != '') {echo '<a target="_blank" href="' . $instance['youtube'] . '"><i class="fa fa-youtube-play"></i></a>';} ?>
			<?php if ($tripadvisor != '') {echo '<a target="_blank" href="' . $instance['tripadvisor'] . '"><i class="fa fa-tripadvisor"></i></a>';} ?>
			<?php if ($pinterest != '') {echo '<a target="_blank" href="' . $instance['pinterest'] . '"><i class="fa fa-pinterest"></i></a>';} ?>
			<?php if ($skype != '') {echo '<a target="_blank" href="' . $instance['skype'] . '"><i class="fa fa-skype"></i></a>';} ?>
			<?php if ($flickr != '') {echo '<a target="_blank" href="' . $instance['flickr'] . '"><i class="fa fa-flickr"></i></a>';} ?>
			<?php if ($googleplus != '') {echo '<a target="_blank" href="' . $instance['googleplus'] . '"><i class="fa  fa-google-plus"></i></a>';} ?>
			<?php if ($tumblr != '') {echo '<a target="_blank" href="' . $instance['tumblr'] . '"><i class="fa fa-tumblr"></i></a>';} ?>
			<?php if ($vimeo != '') {echo '<a target="_blank" href="' . $instance['vimeo'] . '"><i class="fa fa-vimeo"></i></a>';} ?>

		</div>
		
		<?php
		
		echo $after_widget;
	}	
	
	
/* ----------------------------------------------------------------------------

  Update widget

---------------------------------------------------------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['about_us'] = $new_instance['about_us'];
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['instagram'] = strip_tags( $new_instance['instagram'] );
		$instance['yelp'] = strip_tags( $new_instance['yelp'] );
		$instance['youtube'] = strip_tags( $new_instance['youtube'] );
		$instance['tripadvisor'] = strip_tags( $new_instance['tripadvisor'] );
		$instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
		$instance['skype'] = strip_tags( $new_instance['skype'] );
		$instance['flickr'] = strip_tags( $new_instance['flickr'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		$instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
		$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
		
		return $instance;
	}
	
	
/* ----------------------------------------------------------------------------

   Widget input form

---------------------------------------------------------------------------- */

	function form( $instance ) {
		$defaults = array(
		'title' => 'Soho Hotel',
		'about_us' => '',
		'facebook' => '',
		'twitter' => '',
		'instagram' => '',
		'yelp' => '',
		'youtube' => '',
		'tripadvisor' => '',
		'pinterest' => '',
		'skype' => '',
		'flickr' => '',
		'googleplus' => '',
		'tumblr' => '',
		'vimeo' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'soho-hotel'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'about_us' )); ?>"><?php esc_html_e('About Us', 'soho-hotel') ?>:</label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('about_us')); ?>" name="<?php echo $this->get_field_name('about_us'); ?>"><?php echo $instance['about_us']; ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>"><?php esc_html_e('Facebook URL', 'soho-hotel') ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" value="<?php echo esc_attr($instance['facebook']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>"><?php esc_html_e('Twitter URL', 'soho-hotel') ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" value="<?php echo esc_attr($instance['twitter']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>"><?php esc_html_e('Instagram', 'soho-hotel') ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" value="<?php echo esc_attr($instance['instagram']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'yelp' )); ?>"><?php esc_html_e('Yelp', 'soho-hotel') ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('yelp')); ?>" name="<?php echo esc_attr($this->get_field_name('yelp')); ?>" value="<?php echo esc_attr($instance['yelp']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>"><?php esc_html_e('Youtube', 'soho-hotel') ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" value="<?php echo esc_attr($instance['youtube']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'tripadvisor' )); ?>"><?php esc_html_e('Tripadvisor', 'soho-hotel') ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('tripadvisor')); ?>" name="<?php echo esc_attr($this->get_field_name('tripadvisor')); ?>" value="<?php echo esc_attr($instance['tripadvisor']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>"><?php esc_html_e('Pinterest', 'soho-hotel') ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" value="<?php echo esc_attr($instance['pinterest']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'skype' )); ?>"><?php esc_html_e('Skype', 'soho-hotel') ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('skype')); ?>" name="<?php echo esc_attr($this->get_field_name('skype')); ?>" value="<?php echo esc_attr($instance['skype']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'flickr' )); ?>"><?php esc_html_e('Flickr', 'soho-hotel') ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('flickr')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr')); ?>" value="<?php echo esc_attr($instance['flickr']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'googleplus' )); ?>"><?php esc_html_e('Googleplus', 'soho-hotel') ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('googleplus')); ?>" name="<?php echo esc_attr($this->get_field_name('googleplus')); ?>" value="<?php echo esc_attr($instance['googleplus']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'tumblr' )); ?>"><?php esc_html_e('Tumblr', 'soho-hotel') ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('tumblr')); ?>" name="<?php echo esc_attr($this->get_field_name('tumblr')); ?>" value="<?php echo esc_attr($instance['tumblr']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'vimeo' )); ?>"><?php esc_html_e('Vimeo', 'soho-hotel') ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('vimeo')); ?>" name="<?php echo esc_attr($this->get_field_name('vimeo')); ?>" value="<?php echo esc_attr($instance['vimeo']); ?>" />
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'sohohotel_social_about_widget' );

// Register Widget
function sohohotel_social_about_widget() {
	register_widget( 'sohohotel_social_about_widget' );
}