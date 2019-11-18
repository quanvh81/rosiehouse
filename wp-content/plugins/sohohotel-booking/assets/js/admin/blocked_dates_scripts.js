jQuery( document ).ready(function($) {
	
	"use strict";
	
	function sohohotel_required_field() {
		
		var sh_validation_error = false;
		
		$('.sh-required-field').each(function() {
			if ($.trim($(this).val()) == '') {
				sh_validation_error = true;
			}
		});
		
		if ( sh_validation_error == true ) {
			return true;
		} else {
			return false;
		}
		
	}
	
	// Check at least 1 day is selected to be blocked
	function sohohotel_blocked_day_check() {
		
		var sh_validation_error = false;
		
		if( $('.sh-blocked-day').is(':checked') != true ) {
			sh_validation_error = true;
		} 
		
		if ( sh_validation_error == true ) {
			return true;
		} else {
			return false;
		}
		
	}
	
	// Check the check in date is before the check out date
	function sohohotel_date_validation(date1, date2) {
	    return new Date(date1) > new Date(date2);
	}
	
	$("#publish").on( "click", function() {
		
		if ( sohohotel_blocked_day_check() == true ) {
			alert(sohohotel_blocked_day_msg);
			return false;
		}
		
		if ( sohohotel_required_field() == true ) {
			alert(sohohotel_required_msg);
			return false;
		}
		
		if ( sohohotel_date_validation($('.check_in_alt').val(), $('.check_out_alt').val()) == true ) {
			alert(sohohotel_date_msg);
			return false;
		}

    });
	
	$('#sh_checkall').click(function (e) {
	    var checked = $(this).data('checked');
	    $('.weekday_checkboxes').find(':checkbox').attr('checked', !checked);
	    $(this).data('checked', !checked);
		e.preventDefault();
	});

});