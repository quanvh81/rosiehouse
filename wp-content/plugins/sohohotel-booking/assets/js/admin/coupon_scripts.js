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
	
	function sohohotel_numeric_field() {
		
		var sh_validation_error = false;
		
		$('.sh-is-numeric').each(function() {
		
			if (!$.isNumeric($(this).val()) ) {
				sh_validation_error = true;
			}
			
		});
		
		if ( sh_validation_error == true ) {
			return true;
		} else {
			return false;
		}
		
	}
	
	$("#publish").on( "click", function() {
	
		if ( sohohotel_required_field() == true ) {
			alert(sohohotel_required_msg);
			return false;
		}
		
		if ( sohohotel_numeric_field() == true ) {
			alert(sohohotel_coupon_amounts_msg);
			return false;
		}
		
		if( $('.sh_coupon_type').is(':checked') != true ) {	
			alert(sohohotel_coupon_type_msg);
			return false;
		}
		
    });

});