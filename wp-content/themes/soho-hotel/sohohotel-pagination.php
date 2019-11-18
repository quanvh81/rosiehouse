<?php global $the_query; ?>

<?php if ( $the_query ) { ?>
	
	<?php if ( $the_query->max_num_pages > 1 ) : ?>

		<div class="sohohotel-clearboth"></div>

		<?php if(is_plugin_active('wp-pagenavi/wp-pagenavi.php')) {
			echo '<div class="sohohotel-page-pagination sohohotel-clearfix">';
			wp_pagenavi( array( 'query' => $the_query ) );
			echo '</div>';
			echo '<div class="sohohotel-clearboth"></div>';
		} else { ?>

		<div class="sohohotel-page-pagination sohohotel-clearfix">
			<p class="sohohotel-clearfix">
				<span class="sohohotel-prev-pagination"><?php next_posts_link( esc_html__( '&larr; Older posts', 'soho-hotel' ), $the_query->max_num_pages ); ?></span>
				<span class="sohohotel-next-pagination"><?php previous_posts_link( esc_html__( 'Newer posts &rarr;', 'soho-hotel' ), $the_query->max_num_pages ); ?></span>	
			</p>
		</div>

		<?php } ?>

	<?php endif; ?>
	
<?php } else {
	
	if ( $wp_query->max_num_pages > 1 ) : ?>

		<div class="sohohotel-clearboth"></div>

		<?php if(is_plugin_active('wp-pagenavi/wp-pagenavi.php')) {
			echo '<div class="sohohotel-page-pagination sohohotel-clearfix">';
			wp_pagenavi();
			echo '</div>';
			echo '<div class="sohohotel-clearboth"></div>';
		} else { ?>

		<div class="sohohotel-page-pagination sohohotel-clearfix">
			<p class="clearfix">
				<span class="sohohotel-prev-pagination"><?php next_posts_link( esc_html__( '&larr; Older posts', 'soho-hotel' ) ); ?></span>
				<span class="sohohotel-next-pagination"><?php previous_posts_link( esc_html__( 'Newer posts &rarr;', 'soho-hotel' ) ); ?></span>	
			</p>
		</div>

		<?php } ?>

	<?php endif; ?>
	
<?php } ?>