	$.getScript("../js/formvalidate.js");
	$(document).ready(function() {

				var url = 'https://s1.yimg.com/rz/l/yahoo_en-US_f_p_135x24.png';
				// URL of the image
				$('<img>')// create a new image element
				.attr('src', url)// set src
				.appendTo("#yahoologoid");

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

				$("#dcancel_id").click(function() {

					document.forms["New_domain"].reset();
					$("#FarmTableid").html("");
					$("#sizeGraphid").html("");
					$("#wpsGraphid").html("");

				});

				$('#Save_id').click(Table_fill);

			});

			function Table_fill() {
				//Prediction table
				
				
				if($('#size_req').val()!=null && $('#size_req').val()!==''){
				var size = $('#size_req').val();
				var wps = $('#wps_req').val();
				jQuery.ajax({
					type : "POST",
					url : "Actual_Algo.php",
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
				else
				alert("Fill Entire Form");
			}