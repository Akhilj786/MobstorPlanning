$.getScript("http://jquery.bassistance.de/validate/jquery.validate.js");
$.getScript("http://jquery.bassistance.de/validate/additional-methods.js");
$(document).ready(function() {
$('#addFarmbenchmarkid').click(function() {
		//document.location.href = 'newFarmbenchmark.php';
		$( "#dialog" ).dialog( "open" );
		$('#biggercontainerid').css("opacity","0.4");

	});

$("#dialog").dialog({
		autoOpen : false,

		buttons : {
			"Save" : function() {
				savefunction();
			},
			Cancel : function() {
				
				$(this).dialog("close");
				$('#biggercontainerid').css("opacity","1");
				
			}
		},
		close: function( event, ui ) {
			$('#biggercontainerid').css("opacity","1");
			}
	});
	
function savefunction(){
	var newfname1=$('#newfname_req').val();
	var newfsize1=$('#newfsize_req').val();
	var newfrps1=$('#newfrps_req').val();
	var newfwps1=$('#newfwps_req').val();
	
	jQuery.validator.setDefaults({
debug: true,
success: "valid"
});
var new_farm = $("#dialog");
new_farm.validate({rules:{
	newfname:{requried:true},
	newfsize:{required:true,number:true},
	newfrps:{required:true,number:true},
	newfwps:{required:true,number:true}
},messages:{
	newfname:"*",
	newfsize:"*",
	newfrps:"*",
	newfwps:"*"
	}
});
	
	if(new_farm.valid()){
		alert("Inside");
	jQuery.ajax({
			type : "POST",
			url : "newFarmSubmit.php",
			data : {
				newfname : newfname1,
				newfsize : newfsize1,
				newfrps	 : newfrps1,
				newfwps  : newfwps1
			},
			cache : false,
			success : function(response) {
				alert(response);		
		
			}
		});
		}
}

});