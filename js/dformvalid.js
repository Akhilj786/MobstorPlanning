
$(document).ready(function () {

    $('#FormName').validate({ // initialize the plugin
        rules: {
            dname: {
                required: true,
              
            },
            size: {
                required: true,
                
            },
               rps: {
                required: true,
                
            },
               wps: {
                required: true,
                
            }
            
        },
        submitHandler: function () { // for demo
            				var size = $('#size_req').val();

				jQuery.ajax({
					type : "POST",
					url : "Actual_Algo.php",
					data : 'size=' + size,
					cache : false,
					success : function(response) {
						if (response) {
							$("#FarmTableid").show();	
							$('#Farm_prediction').show();
							$('#Farm_prediction tbody').append(response);

						}

					}
				});
				}
		});
});