<?php

if (isset($_POST['newfname']) && isset($_POST['newfsize']) && isset($_POST['newfwps']) && isset($_POST['newfrps'])) {
	include 'mysql_lib.php';

	$fname = $_POST['newfname'];
	$fsize = $_POST['newfsize'];
	$frps = $_POST['newfrps'];
	$fwps = $_POST['newfwps'];
	$sql_query = "insert into farm_benchmark (name,size,rps,wps) values ('$fname',$fsize,$frps,$fwps)";

	if (mysql_query($sql_query)) {
		echo "Succesfully Inserted";
	} else {
		echo "No Success";
	}

}
?>

