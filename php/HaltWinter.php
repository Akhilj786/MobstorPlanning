<html>
	<head>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<link rel="stylesheet" type="text/css" href="../lib/Full.css">
		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../js/dygraph-combined.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				
				var url = 'https://s1.yimg.com/rz/l/yahoo_en-US_f_p_135x24.png';
				// URL of the image
				$('<img>')// create a new image element
				.attr('src', url)// set src
				.appendTo("#yahoologoid");

				$("#fname_req").autocomplete({
					source : "get_farm.php",
					minLength : 1,
					select:function(evt, ui)
					{
			// when a zipcode is selected, populate related fields in this form
					var fname=ui.item.value;
					var fsize=ui.item.size;
					var frps=ui.item.rps;
					var fwps=ui.item.wps;
			this.form.fsize.value = fsize;
			this.form.frps.value = frps;
			this.form.fwps.value = fwps;
					$('#edit_id').click(function(){
							jQuery.ajax({
					type : "POST",
					url : "editFarm.php",
					data : {fname:$('#fname_req').val(),fsize:$('#fsize_req').val(),frps:$('#frps_req').val(),fwps:$('#fwps_req').val()},
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
				//alert("Save");
				var size = $('#size_req').val();
				var wps=$('#wps_req').val();
				jQuery.ajax({
					type : "POST",
					url : "Actual_Algo.php",
					data : {size:size,wps:wps},
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


			

		</script>

	</head>
	<body>
		<div id="biggercontainerid" class="biggercontainer">
			<div id="bigContainerid" class="bigContainer">
				<div id="headerContainerid" class="panel-primary">
					<div id="yahoologoid" class="yahoologo"></div>
					<div id="headerid" class="header">
						MobStor Provision Tool
					</div>
				</div>
				<div id="mainContainerid" class="mainContainer">

					<div id="Farm_benchmarkformid" class="Farm_benchmarkform" >
						<div id="newProvisionid" class="panel-primary" >
							<h2 style="margin-bottom:0" align="center">Farm_BenchMark</h2>
						</div>

						<form name="farm_detailname" id="farm_detailsid" class="farm_details" method="post">
							<fieldset style="border: 1px solid #2D1152">
								<label for="fName">FarnName:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
								<input type="text" name="fname" id="fname_req" style="width:218px">

								<br>
								<label for="fsize">Required Size:&nbsp;&nbsp;&nbsp;&nbsp;</label>
								<input type ="text" name="fsize" id="fsize_req">
								<br>
								<label for="frps">Read per Second:</label>
								<input type ="text" name="frps" id="frps_req">
								<br>
								<label for="fwps">Write per Second:</label>
								<input type ="text" name="fwps" id="fwps_req">
								<br>
								<br>
								<div id="savebutton" class="savebutton">
									<input type="button" id="edit_id" value="Edit">
								</div>
								<div id="cancelbuttonid" class="cancelbutton">
									<input type="reset" id="cancel_id" value="Cancel">
								</div>
							</fieldset>
						</form>

					</div>

					<div id="ProvisionForm" class="provision_form" style="display:inline">
						<div id="newProvisionid" class="panel-primary" >
							<h2 style="margin-bottom:0" align="center">New Provision</h2>
						</div>

						<form name="FormName" id="New_domain" class="" method="post">
							<fieldset style="border: 1px solid #2D1152">
								<label for="dName">DomainName:&nbsp;&nbsp;&nbsp;&nbsp;</label>
								<input type="text" name="dname" id="dname_req" style="width:218px">
								<br>
								<label for="Size">Required Size:&nbsp;&nbsp;&nbsp;&nbsp;</label>
								<input type ="text" name="size" id="size_req">
								<br>
								<label for="RPS">Read per Second:</label>
								<input type ="text" name="rps" id="rps_req">
								<br>
								<label for="WPS">Write per Second:</label>
								<input type ="text" name="wps" id="wps_req">
								<br>
								<br>
								<div id="savebutton" class="savebutton">
									<input type="button" id="Save_id" value="Save">
								</div>
								<div id="dcancelbuttonid" class="cancelbutton">
									<input type="button" id="dcancel_id" value="Cancel">
								</div>
							</fieldset>
						</form>

					</div>
					<div id="FarmTableid" class="FarmTable" style="display:inline">
						<table id="Farm_prediction" class="bordered table" style="display: none">
							<thead>
								<tr>
									<th>FarmName</th><th>Days</th><th>%Utilization</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
					<br />
					<br />

					<div id="outerGraphContainerid" class="outerGraphContainer">
						<div id="sizeContainerid" class="sizeContainer">
							<div id="sizepanelid" class="panel-primary" >
								<h2 style="margin-bottom:0" align="center">SizeGraph</h2>
							</div>
							<div id="sizeGraphid" class="sizeGraph"></div>
						</div>

						<div id="WPSContainer" class="wpsContainer">
							<div id="wpspanelid" class="panel-primary" >
								<h2 style="margin-bottom:0" align="center">WPSGraph</h2>
							</div>
							<div id="wpsGraphid" class="wpsGraph"></div>
						</div>
					</div>

					<script type="text/javascript">
						$('#Farm_prediction').on('click', 'tbody tr', function() {
							var FarmName = $(this).find('td:eq(0)').text();

							jQuery.ajax({
								type : "POST",
								url : "sizeGraph.php",
								data : 'FarmName=' + FarmName,
								cache : false,
								datatype : "text",
								success : function(response) {
									if (response) {
										var res = response;
										$("#outerGraphContainerid").show();
										g = new Dygraph(document.getElementById("sizeGraphid"), res, {

											xlabel : 'Date'
										});
									}
								}
							});

							jQuery.ajax({
								type : "POST",
								url : "wpsGraph.php",
								data : 'FarmName=' + FarmName,
								cache : false,
								datatype : "text",
								success : function(response1) {
									if (response1) {
										var res = response1;
										$("#outerGraphContainerid").show();
										g = new Dygraph(document.getElementById("wpsGraphid"), res, {

											xlabel : 'Date'
										});
									}
								}
							});

						});

					</script>
				</div>

			</div>
		</div>
	</body>
</html>
