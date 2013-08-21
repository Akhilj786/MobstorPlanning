<?php
include 'mysql_lib.php';
if (isset($_GET['term'])) {
	$return_arr = array();
	$search_string = $_GET['term'];

	$sql = "select distinct name from farm_benchmark where name like '$search_string%' ";
	
	if ($result = mysql_query($sql)) {
		while ($row = mysql_fetch_assoc($result)) {
			$return_arr[] = $row['name'];

		}
		echo json_encode($return_arr);
	} else {
		echo "Not connected";
	}
} else {
	echo "Not done";
}
?>