<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="lib/UTC_Time.js"></script>
	
	</head>
	<body>
		<div id="Main-Page" class="">
			<div id="Main-Meniu" class="">
				<a href="" >Actual Mobstor Usage</a> | <a href="php/provision.php"> Provisioning </a>| <a href="">Config</a> | <a href="">Usage Trend</a>
			</div>
			<br />
			<div id="Region-Selection">

				<span class="" src=""><Strong> Region:
					<select id="region_id"  >
						<?php
						include 'php/mysql_lib.php';

						$sql = "SELECT distinct rname FROM region_farm";
						$result = mysql_query($sql);

						//echo "<select name='region_name' id='region_id'>";
						while ($row = mysql_fetch_array($result)) {
							echo "<option value='" . $row['rname'] . "'>" . $row['rname'] . "</option>";
						}
						//echo "</select>";
						?>
					</select></span>
			</div>
			<script>
				$("select").change(function() {
					var region_sel = $(this).val();
					$.ajax({
						url:'php/farm_Sel.php',
						data: region_sel,
						success:function(response){
							$("p").text(response);
							
						}
					});
					
					var date = new Date();
					console.log(date);
					//console.log(date.toISOString());
					var UTCdate = ISODateString(date);
					console.log(UTCdate);
					console.log(region_sel);
					//$("p").text(region_sel);

				});

			</script>
			<div id="Main-Table" class="">
				<table id="Farm-table" class="">

				</table>

			</div>
			<p></p>
		</div>

	</body>
</html>