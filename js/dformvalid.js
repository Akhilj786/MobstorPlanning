$.getScript("http://jquery.bassistance.de/validate/jquery.validate.js");
$.getScript("http://jquery.bassistance.de/validate/additional-methods.js");
$(document).ready(function() {
	
	jQuery.validator.setDefaults({
debug: true,
success: "valid"
});
var domain_form = $("#New_domain");
domain_form.validate({rule:{
	dname:{requried:true},
	size:{required:true,number:true},
	rps:{required:true,number:true},
	wps:{required:true,number:true}
},messages:{
	dname:"*",
	size:"*",
	rps:"*",
	wps:"*"
	}
});


	$('#Save_id').click(Table_fill);
	
	function Table_fill() {
	//Prediction table

	if(domain_form.valid()){
		var size = $('#size_req').val();
		var wps = $('#wps_req').val();
		jQuery.ajax({
			type : "POST",
			url : "HoltWinter.php",
			data : {
				size : size,
				wps : wps
			},
			cache : false,
			success : function(response) {
				if (response) {
					$('#FarmTableid').show();
					$('#Farm_prediction').show();
					$('#Farm_prediction tbody').html("");
					$('#Farm_prediction tbody').html(response);

				}

			}
		});
	} 
}

$("#dcancel_id").click(function() {

		document.forms["New_domain"].reset();
		

	});
	
	
});