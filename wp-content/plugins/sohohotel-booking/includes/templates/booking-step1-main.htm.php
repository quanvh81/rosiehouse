<?php if ( !empty( $_POST["edit_step_2"] ) ) {
	$sh_booking_data = $_SESSION['sh_booking_data'];
	$hidden_dates = $sh_booking_data["check_in"] . ' - ' . $sh_booking_data["check_out"];		
} else {
	if ( !empty($_POST['check_in']) ) {
		$hidden_dates = $_POST['check_in'] . ' - ' . $_POST['check_out'];	
	} else {
		$hidden_dates = '';
	}
} ?>

<input type="hidden" id="check_in_open_hidden" value="<?php echo $hidden_dates; ?>" />
<div class="clearboth"></div>