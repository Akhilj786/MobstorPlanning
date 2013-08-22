<?php
include 'mysql_lib.php';

	
	$search_string = $_POST['term'];
	$fname=$_POST['fname'];
	$fsize=$_POST['fsize'];
	$frps=$_POST['frps'];
	$fwps=$_POST['fwps'];
	$sql = "update farm_benchmark set size='$fsize',rps='$frps',wps='$fwps' where name='$fname' ";
		echo $sql;	
	if ($result = mysql_query($sql)) {
		echo "Succesfully Update Farm Benchmark";
	} else {
		echo "No Success";
	}

?>