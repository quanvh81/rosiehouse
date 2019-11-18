<?php

// Widget Class
class sohohotel_recent_posts_widget extends WP_Widget {


/* ----------------------------------------------------------------------------

   Widget setup

---------------------------------------------------------------------------- */

	function __construct() {
		
		parent::__construct(false, $name = esc_html__('Soho Hotel Recent Posts','soho-hotel'), array(
			'description' => esc_html__('Display Recent Posts','soho-hotel')
		));
	
	}


/* ----------------------------------------------------------------------------

   Display widget

---------------------------------------------------------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$post_limit = $instance['post_limit'];

		global $sohohotel_allowed_html_array;
		
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		 } ?>

			<?php // Set News Limit
			if ( $instance['post_limit'] ) : 
				$news_limit = $instance['post_limit'];
			elseif ( !is_numeric ( $instance['post_limit'] ) )	:
				$news_limit = '8';
			else :
				$news_limit = '8';
			endif;
			?>
			
			<?php $args = array(
				'posts_per_page' => $news_limit,
				'ignore_sticky_posts' => 1,
				'post_type' => 'post',
				'order' => 'DESC',
				'orderby' => 'date'
			);

			$post_query = new WP_Query( $args );
				
			if( $post_query->have_posts() ) : while( $post_query->have_posts() ) : $post_query->the_post(); ?>
				
				<!-- BEGIN .sohohotel-blog-widget-wrapper -->
				<div class="sohohotel-blog-widget-wrapper clearfix">	
					
					<?php if( has_post_thumbnail() ) { ?>
						
						<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post_query->ID), 'sohohotel-image-style6' ); ?>
							<?php echo '<img src="' . esc_url( $src[0] ) . '" alt="" />'; ?>
						</a>

					<?php } ?>
					
					<div class="sohohotel-blog-widget-content">
					
						<h4><a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
						<p><?php echo get_the_date(); ?></p>
					</div>
				
				<!-- END .sohohotel-blog-widget-wrapper -->
				</div>
				
			<?php endwhile; endif; ?>	
				
		<?php echo $after_widget;
	
	}	
	
	
/* ----------------------------------------------------------------------------

   Update widget

---------------------------------------------------------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_limit'] = strip_tags( $new_instance['post_limit'] );
		return $instance;
	}
	
	
/* ----------------------------------------------------------------------------

   Widget input form

---------------------------------------------------------------------------- */
	 
	function form( $instance ) {
		$defaults = array(
		'title' => 'Recent Posts',
		'post_limit' => '8'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
				
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'soho-hotel'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'post_limit' )); ?>"><?php esc_html_e('Post Limit:', 'soho-hotel') ?></label>
			<input type="text" size="3" id="<?php echo esc_attr($this->get_field_id('post_limit')); ?>" name="<?php echo esc_attr($this->get_field_name('post_limit')); ?>" value="<?php echo esc_attr($instance['post_limit']); ?>" />
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'sohohotel_recent_posts_widget' );

// Register Widget
function sohohotel_recent_posts_widget() {
	register_widget( 'sohohotel_recent_posts_widget' );
}