<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="sohohotel-search-widget">
	<div class="sohohotel-search-field-wrapper">
		<input type="text" onblur="if(this.value=='')this.value='<?php esc_html_e('Search...', 'soho-hotel'); ?>';" onfocus="if(this.value=='<?php esc_html_e('Search...', 'soho-hotel'); ?>')this.value='';" value="<?php esc_html_e('Search...', 'soho-hotel'); ?>" name="s" />
		<i class="fa fa-search"></i>
	</div>
</form>