<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../lib/Full.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<style type="text/css">
			.Farm_benchmarkform {
				width: 20%;
				height: 20%;
			}
		</style>
	</head>
	<body>

		<div id="Farm_benchmarkformid" class="Farm_benchmarkform">
			<div id="newProvisionid" class="panel-primary" >
				<h2 style="margin-bottom:0" align="center">Farm_BenchMark</h2>
			</div>
			<div id="" class="">
				<form name="farm_detailname" id="farm_detailsid" class="farm_details" method="post">
					<fieldset style="border: 1px solid #2D1152">
						<label for="fName">FarnName:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<input type="text" name="dname" id="dname_req" style="width:200px">
						<div id="addButtonid" class="addButton">
							<input type="button" id="add_id" value="Add">
						</div>
						<br>
						<label for="fsize">Required Size:&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<input type ="text" name="size" id="size_req">
						<br>
						<label for="frps">Read per Second:</label>
						<input type ="text" name="rps" id="rps_req">
						<br>
						<label for="fwps">Write per Second:</label>
						<input type ="text" name="wps" id="wps_req">
						<br>
						<br>
						<div id="savebutton" class="saveButton">
							<input type="button" id="Save_id" value="Edit">
						</div>
					</fieldset>
				</form>
			</div>
		</div>

	</body>
</html>