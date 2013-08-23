<?php
//Fill Form details based on autocomplete selection
include 'mysql_lib.php';
if (isset($_GET['term'])) {
	$return_arr = array();
	$search_string = $_GET['term'];

	$sql = "select distinct name,size,rps,wps from farm_benchmark where name like '$search_string%' order by name";
			$return_arr=array();
	if ($result = mysql_query($sql)) {
		while ($row = mysql_fetch_assoc($result)) {
			$return_arr[] = array(
						'value'=>$row['name'],
				        'size'=>$row['size'],
				        'rps'=>$row['rps'],
				    		'wps'=>$row['wps']
			);

		}
		echo json_encode($return_arr);
	} else {
		echo "Not connected";
	}
} else {
	echo "Not done";
}
?>