<?php global $sohohotel_data; ?>

<!-- BEGIN .sohohotel-footer-wrapper -->
<footer class="sohohotel-footer-wrapper">
	
	<?php if( $sohohotel_data['footer-columns'] ) {	
		if ( $sohohotel_data['footer-columns'] == '1-col' ) {
			$sohohotel_footer_columns = '1';
		} elseif ( $sohohotel_data['footer-columns'] == '2-col' ) {
			$sohohotel_footer_columns = '2';
		} elseif ( $sohohotel_data['footer-columns'] == '3-col' ) {
			$sohohotel_footer_columns = '3';
		} elseif ( $sohohotel_data['footer-columns'] == '4-col' ) {
			$sohohotel_footer_columns = '4';
		} elseif ( $sohohotel_data['footer-columns'] == '5-col' ) {
			$sohohotel_footer_columns = '5';
		} elseif ( $sohohotel_data['footer-columns'] == '6-col' ) {
			$sohohotel_footer_columns = '6';
		} else {
			$sohohotel_footer_columns = '3';
		}
	} else {
		$sohohotel_footer_columns = '3';
	} ?>
	
	<?php if ( is_active_sidebar('sohohotel-footer-widget-area') ) { ?>
	
		<!-- BEGIN .sohohotel-footer -->
		<div class="sohohotel-footer sohohotel-footer-<?php echo $sohohotel_footer_columns; ?>-col sohohotel-clearfix">

			<?php dynamic_sidebar( 'sohohotel-footer-widget-area' ); ?>
		
		<!-- END .sohohotel-footer -->
		</div>
	
	<?php } ?>
	
	<!-- BEGIN .sohohotel-footer-bottom-wrapper -->
	<div class="sohohotel-footer-bottom-wrapper">
		
		<!-- BEGIN .sohohotel-footer-bottom -->
		<div class="sohohotel-footer-bottom sohohotel-clearfix">
			
			<?php if( $sohohotel_data['footer-message'] ) { ?>
				<p><?php echo $sohohotel_data['footer-message']; ?></p>
			<?php } ?>
			
			<?php if( $sohohotel_data['footer-link-text-1'] || $sohohotel_data['footer-link-text-2'] || $sohohotel_data['footer-link-text-3'] || $sohohotel_data['footer-link-text-4'] ) {
				
				if ( $sohohotel_data['footer-link-target'] ) {
					$footer_link_target = 'target="_blank"';
				} else {
					$footer_link_target = '';
				} ?>
				
				<ul>
					
					<?php if ( $sohohotel_data['footer-link-text-1'] ) { ?>
						<li><a <?php echo $footer_link_target; ?> href="<?php echo $sohohotel_data['footer-link-url-1']; ?>"><?php echo $sohohotel_data['footer-link-text-1']; ?></a></li>
					<?php } ?>
					
					<?php if ( $sohohotel_data['footer-link-text-2'] ) { ?>
						<li><a <?php echo $footer_link_target; ?> href="<?php echo $sohohotel_data['footer-link-url-2']; ?>"><?php echo $sohohotel_data['footer-link-text-2']; ?></a></li>
					<?php } ?>
					
					<?php if ( $sohohotel_data['footer-link-text-3'] ) { ?>
						<li><a <?php echo $footer_link_target; ?> href="<?php echo $sohohotel_data['footer-link-url-3']; ?>"><?php echo $sohohotel_data['footer-link-text-3']; ?></a></li>
					<?php } ?>
					
					<?php if ( $sohohotel_data['footer-link-text-4'] ) { ?>
						<li><a <?php echo $footer_link_target; ?> href="<?php echo $sohohotel_data['footer-link-url-4']; ?>"><?php echo $sohohotel_data['footer-link-text-4']; ?></a></li>
					<?php } ?>
					
				</ul>
				
			<?php } ?>
			
		<!-- END .sohohotel-footer-bottom -->
		</div>
		
	<!-- END .sohohotel-footer-bottom-wrapper -->
	</div>

<!-- END .sohohotel-footer-wrapper -->	
</footer>

<!-- END .sohohotel-site-wrapper -->
</div>

<?php wp_footer(); ?>

<!-- END body -->
</body>
</html>