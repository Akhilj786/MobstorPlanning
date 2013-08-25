<html>
	<head>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<link rel="stylesheet" type="text/css" href="../lib/Full.css">
		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../js/doc_ready.js"></script>
		<script src="http://jquery.bassistance.de/validate/jquery.validate.js"></script>
		<script src="http://jquery.bassistance.de/validate/additional-methods.js"></script>

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

					<div id="Farm_benchmarkformid" class="Farm_benchmarkform">
						<div id="newProvisionid" class="panel-primary" style="margin-top: 18px" >
							<h2 style="margin-bottom:0;display:inline" > &nbsp;Farm_BenchMark</h2>
							<button id="addFarmbenchmarkid" class="addFarmbenchmark">
								Add
							</button>
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
								<input type="text" name="dname" id="dname_req" style="width:218px" required>
								<br>
								<label for="Size">Required Size:&nbsp;&nbsp;&nbsp;&nbsp;</label>
								<input type ="text" name="size" id="size_req" required>
								<br>
								<label for="RPS">Read per Second:</label>
								<input type ="text" name="rps" id="rps_req" required>
								<br>
								<label for="WPS">Write per Second:</label>
								<input type ="text" name="wps" id="wps_req" required>
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
					<script type="text/javascript" src="../js/dformvalid.js"></script>
					<div id="FarmTableid" class="FarmTable" style="display:inline">
						<table id="Farm_prediction" class="bordered table" style="display: none">
							<thead>
								<tr>
									<th>FarmName</th>
									<th>Days</th>
									<th>%size_Util</th>
									<th>%wps_Util</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<script type="text/javascript" src="../js/graph_Plot.js"></script>
					<div id="outerGraphContainerid" class="outerGraphContainer" style="position: relative">
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

				</div>

			</div>
		</div>
		<div id="dialog" title="Add New Farm">
			<form name="newfarmdetailname" id="farm_detailsid" class="farm_detail" method="post">
				<fieldset style="border: 1px solid #2D1152">
					<label for="fName">FarnName:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<input type="text" name="newfname" id="newfname_req" style="width:218px" required>

					<br>
					<label for="fsize">Size:&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<input type ="text" name="newfsize" id="newfsize_req" required>
					<br>
					<label for="frps">Read per Second:</label>
					<input type ="text" name="newfrps" id="newfrps_req" required>
					<br>
					<label for="fwps">Write per Second:</label>
					<input type ="text" name="newfwps" id="newfwps_req" required>
					<br>
					<br>

				</fieldset>
			</form>
		</div>
		

	</body>
</html>
