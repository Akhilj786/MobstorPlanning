<?php
//Mysql connection
//Form to edit Farm Benchmark
include 'mysql_lib.php';

	//Here Autocompleted farm Name will be capture and then we fill 
	$search_string = $_POST['term'];
	$fname=$_POST['fname'];
	$fsize=$_POST['fsize'];
	$frps=$_POST['frps'];
	$fwps=$_POST['fwps'];
	$sql_query = "update farm_benchmark set size='$fsize',rps='$frps',wps='$fwps' where name='$fname' ";
			
	if (mysql_query($sql_query)) {
		echo "Succesfully Update Farm Benchmark";
	} else {
		echo "No Success";
	}

?>