<?php
//Graph Ploting of WPS parameter of a Farm
if (isset($_POST['FarmName'])) {
	$FarmName = $_POST['FarmName'];
	include 'mysql_lib.php';
	$sql = "select fdate,fsize,size from farm_use f,farm_benchmark fb where f.fname like '" . "$FarmName" . "' and fb.name='$FarmName'";
	//format required by Dygraph
	$csv_data = "CurrentDate,Fsize,TotalSize,Threshold\n";

	if ($result = mysql_query($sql)) {
		$no_rows = mysql_num_rows($result);
		$counter = 0;
		while ($row = mysql_fetch_assoc($result)) {
			
			$counter++;
			$fdate = $row['fdate'];
			$fsize = $row['fsize'];
			$ftotal = $row['size'];
			$fthreshold = $ftotal * 0.7;
			if ($counter < $no_rows) {$csv_data .= str_replace("'", "", $fdate) . "," . str_replace("'", "", $fsize) . "," . $ftotal . "," . $fthreshold . "\n";
			} else {
				$csv_data .= str_replace("'", "", $fdate) . "," . str_replace("'", "", $fsize) . "," . $ftotal . "," . $fthreshold;
			}

		}
		header('Content-Type: text/plain');
		echo $csv_data;

	} else {
		echo "Not done";
	}
}
?>