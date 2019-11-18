<?php global $sohohotel_data; ?>
	
<!-- BEGIN .sohohotel-fixed-navigation-wrapper -->
<div class="sohohotel-fixed-navigation-wrapper">
	
	<!-- BEGIN .sohohotel-header-4 -->
	<div class="sohohotel-header-4 sohohotel-fixed-navigation">
		
		<!-- BEGIN .sohohotel-logo-navigation-wrapper -->
		<div class="sohohotel-logo-navigation-wrapper">
			
			<!-- BEGIN .sohohotel-logo-navigation -->
			<div class="sohohotel-logo-navigation sohohotel-clearfix">
					
				<?php if ( !empty($sohohotel_data['logo-image']['url'] ) ) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'description' ); ?>"><img class="sohohotel-logo" src="<?php echo esc_url($sohohotel_data['logo-image']['url']); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<?php } else { ?>
					<h2 class="sohohotel-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'description' ); ?>"><?php bloginfo( 'name' ); ?></a></h2>
				<?php } ?>
				
				<a href="#sohohotel-search-lightbox" class="sohohotel-menu-search-link" data-gal="prettyPhoto"><i class="fa fa-search"></i></a>
				
				<!-- BEGIN #search-lightbox -->
				<div id="sohohotel-search-lightbox">

					<!-- BEGIN .sohohotel-search-lightbox-inner -->
					<div class="sohohotel-search-lightbox-inner">

						<form name="s" action="#" method="get">
							<input class="sohohotel-menu-search-field" type="text" onblur="if(this.value=='')this.value='To search, type and hit enter';" onfocus="if(this.value=='To search, type and hit enter')this.value='';" value="To search, type and hit enter" name="s" />
						</form>

					<!-- END .sohohotel-search-lightbox-inner -->
					</div>

				<!-- END #sohohotel-search-lightbox -->
				</div>
				
				<!-- BEGIN .sohohotel-navigation -->
				<div class="sohohotel-navigation">

					<?php wp_nav_menu( array(
						'theme_location' => 'sohohotel-primary',
						'container' => false,
						'items_wrap' => '<ul>%3$s</ul>',
						'fallback_cb' => 'sohohotel_main_menu_fallback',
						'echo' => true,
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0 )
					); ?>

				<!-- END .sohohotel-navigation -->
				</div>
				
				<a href="#" class="sohohotel-mobile-navigation-button"><i class="fa fa-bars"></i></a>
				
			<!-- BEGIN .sohohotel-logo-navigation -->
			</div>
		
		<!-- BEGIN .sohohotel-logo-navigation-wrapper -->
		</div>
		
		<!-- BEGIN .sohohotel-mobile-navigation-wrapper -->
		<div class="sohohotel-mobile-navigation-wrapper clearfix">

			<?php if ( has_nav_menu( 'sohohotel-top-right' ) ) {
				$sohohotel_top_right_menu = true;
			} else {
				$sohohotel_top_right_menu = false;
			} ?>
			
			<?php if ( $sohohotel_top_right_menu == true ) { ?>
			
				<!-- BEGIN .sohohotel-language-menu -->
				<div class="sohohotel-language-menu sohohotel-clearfix">
				
					<p><span><?php if( $sohohotel_data['top-right-menu-text'] ) { ?><?php echo esc_attr($sohohotel_data['top-right-menu-text']); ?><?php } ?></span></p>
					<?php wp_nav_menu( array(
						'theme_location' => 'sohohotel-top-right',
						'container' =>false,
						'items_wrap' => '<ul>%3$s</ul>',
						'fallback_cb' => false,
						'echo' => true,
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0 )
					); ?>
			
				<!-- END .sohohotel-language-menu -->
				</div>
			
			<?php } ?>

			<?php if( $sohohotel_data['top-right-button-text'] ) { ?>
				
				<a <?php if( $sohohotel_data["top-right-button-link-target"] ) { ?><?php echo 'target="_blank"'; ?><?php } ?> href="<?php if( $sohohotel_data["top-right-button-url"] ) { ?><?php echo $sohohotel_data["top-right-button-url"]; ?><?php } ?>" class="sohohotel-top-right-button <?php if ( $sohohotel_top_right_menu == false ) {echo 'sohohotel-top-right-button-left';} ?>"><?php if( $sohohotel_data['top-right-button-text'] ) { ?><i class="fa fa-calendar"></i><?php echo esc_attr($sohohotel_data['top-right-button-text']); ?><?php } ?></a>
				
			<?php } ?>
				
			<div class="sohohotel-clearboth"></div>

			<?php wp_nav_menu( array(
				'theme_location' => 'sohohotel-primary',
				'container' => false,
				'items_wrap' => '<ul class="sohohotel-mobile-navigation">%3$s</ul>',
				'fallback_cb' => 'sohohotel_main_menu_fallback',
				'echo' => true,
				'before' => '',
				'after' => '',
				'link_before' => '',
				'link_after' => '',
				'depth' => 0 )
			); ?>

		<!-- END .sohohotel-mobile-navigation-wrapper -->
		</div>
		
	<!-- END .sohohotel-header-4 -->
	</div>
	
<!-- END .sohohotel-fixed-navigation-wrapper -->
</div>