
$.getScript("http://jquery.bassistance.de/validate/jquery.validate.js");
$.getScript("http://jquery.bassistance.de/validate/additional-methods.js");
$(document).ready(function() {

	var url = 'https://s1.yimg.com/rz/l/yahoo_en-US_f_p_135x24.png';
	// URL of the image
	$('<img>')// create a new image element
	.attr('src', url)// set src
	.appendTo("#yahoologoid");

	$('#addFarmbenchmarkid').click(function() {
		//document.location.href = 'newFarmbenchmark.php';
		$( "#dialog" ).dialog( "open" );
		$('#biggercontainerid').css("opacity","0.4");

	});

	//Ajax Farmname autocomplete
	$("#fname_req").autocomplete({
		source : "get_farm.php",
		minLength : 1,
		select : function(evt, ui) {

			var fname = ui.item.value;
			var fsize = ui.item.size;
			var frps = ui.item.rps;
			var fwps = ui.item.wps;
			this.form.fsize.value = fsize;
			this.form.frps.value = frps;
			this.form.fwps.value = fwps;
			//edit Farm_benchmark
			$('#edit_id').click(function() {
				jQuery.ajax({
					type : "POST",
					url : "editFarm.php",
					data : {
						fname : $('#fname_req').val(),
						fsize : $('#fsize_req').val(),
						frps : $('#frps_req').val(),
						fwps : $('#fwps_req').val()
					},
					cache : false,
					success : function(response) {
						if (response) {
							alert(response);

						}

					}
				});
			});

		}
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
	var newfname=$('#newfname_req').val();
	var newfsize=$('#newfsize_req').val();
	var newfrps=$('#newfrps_req').val();
	var newfwps=$('#newfwps_req').val();
	jQuery.ajax({
			type : "POST",
			url : "newFarmSubmit.php",
			data : {
				newfname : newfname,
				newfsize : newfsize,
				newfrps	 : newfrps,
				newfwps  : newfwps
			},
			cache : false,
			success : function(response) {
				alert(response);		
		
			}
		});
}





});

