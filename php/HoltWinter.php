<?php
//Actual Double smoothing Algorithm
//Read Wikipedia for in depth understanding(for simplicity purpose all parameterName remains the same as in Wikipedia)
//Use farmwise data to determine Minimum no of days it could last
//capture size and wps paramter
if (isset($_POST['size']) && isset($_POST['wps'])) {
	$val = $_POST['size'];
	$wps_val = $_POST['wps'];
	$farm_list = array("usm1", "use12", "use18", "use26", "usw10", "usw26", "use70", "usw70");
	
	//mysql connection
	include 'mysql_lib.php';
	$HashList = array();
	$farm_size = count($farm_list);
	//Farmwise Parameter
	for ($i = 0; $i < $farm_size; $i++) {

		$size_array = array();
		$date_array = array();
		$put_array = array();
		$sql = "select fdate,fsize,fput_ops from farm_use" . 
			   " where fname like" . 
			   "'$farm_list[$i]'";

		if ($result = mysql_query($sql)) {

			while ($row = mysql_fetch_assoc($result)) {
				array_push($size_array, $row['fsize']);
				array_push($date_array, $row['fdate']);
				array_push($put_array, $row['fput_ops']);

			}
			$size = count($size_array);
			//Call for Best alpha beta for both Size and WPS
			list($alpha, $beta) = compute_parameter($size, $size_array, $date_array, $farm_list[$i]);
			list($alpha1, $beta1) = compute_parameter($size, $put_array, $date_array, $farm_list[$i]);

			$sizeFinalday = Final_compute($size, $size_array, $date_array, $alpha, $beta, $val, $farm_list[$i]);
			$wpsFinalday = Final_compute1($size, $put_array, $date_array, $alpha1, $beta1, $wps_val, $farm_list[$i]);
			
			$minday;//Capature Minimum value among sizeFinalDay and wpsFinalDay
			if ($sizeFinalday >= 0 && $wpsFinalday >= 0)
				$minday = min($sizeFinalday, $wpsFinalday);
			elseif ($sizeFinalday < 0 && $wpsFinalday < 0)
				$minday = max($sizeFinalday, $wpsFinalday);
			else {
				if ($final_day < 0)
					$minday = $wpsFinalday;
				else
					$minday = $sizeFinalday;
			}
			$HashList[str_replace("'", "", $farm_list[$i])] = $minday;

		}

	}
	//Hashlist contains farmlist and no of days based on max no of days the farm could last
	arsort($HashList);
	$string;
	foreach ($HashList as $key => $val1) {
		//Find size and wps utilization both in %
		$size_wpssql = "select (100/size*(select (fsize+$val) from farm_use where fdate=curdate() and fname='$key')) as size," . 
				   " (100/wps*(select (fput_ops+$wps_val) from farm_use where fdate=curdate() and fname='$key')) as wps" . 
				   " from farm_benchmark" . 
				   " where name='$key' ";
		
		$result1 = mysql_query($size_wpssql);
		$val_row = mysql_fetch_assoc($result1);
		$util_size = round($val_row['size']);
		$util_wps = round($val_row['wps']);
		$string .= "<tr><td id=$key>" . $key . "</td><td>" . $val1 . 
				   "</td><td>" . $util_size . "</td><td>" . $util_wps .
				   "</td></tr>";
	}
	echo $string . "</table>";
}
//Find best Alpha,Beta required for Double exponentail Algorithm
function compute_parameter($size, $x_t, $date, $fname) {

	#$fullstring = "fname,fdate,fsize,smoothing_val,best_fit\n";
	$bestalpha = 0;
	$bestbeta = 0;
	$besterror = 10000;
	$string;
	$s_t;
	$b_t;
	//For Loop for Alpha
	for ($a = 0.1; $a < 1.0; $a = $a + 0.05) {
		$alpha = $a;
		//For Loop for Beta
		for ($b = 0.1; $b < 1.0; $b = $b + 0.05) {
			$beta = $b;
			$s_t = array();
			$b_t = array();
			$future = array();
			$mean_error = array();
			$mean_square = 0;
			$mean_sqerr = 0;
			$mean_bef = 0;
			//for loop for prediction of best alpha and beta
			for ($i = 0; $i < $size; $i++) {
				if ($i < 1) {

					$s_t[0] = 0;
					$b_t[0] = 0;

					$future[$i] = 0;
					$mean_error[$i] = 0;

				} else {
					$s_t[1] = $x_t[1];
					$b_t[1] = $x_t[1] - $x_t[0];
					$s_t[$i] = $alpha * $x_t[$i] + ((1 - $alpha) * ($s_t[$i - 1] + $b_t[$i - 1]));
					$b_t[$i] = $beta * ($s_t[$i] - $s_t[$i - 1]) + (1 - $beta) * $b_t[$i - 1];
					$future[$i] = $s_t[$i - 1] + ($b_t[$i - 1] / $alpha);
					$temp = (abs($x_t[$i] - $future[$i]) * 100);
					if ($x_t[$i] != 0)
						$mean_error[$i] = ($temp / $x_t[$i]);
					else
						$mean_error[$i] = 0;

				}

				$mean_square = $mean_square + $mean_error[$i];
			}
			//Relative mean error(RME)
			$mean_bef = ($mean_square / $size);
			//Alpha Beta with Minimum RME
			if ($besterror > $mean_bef) {
				$bestalpha = $a;
				$bestbeta = $b;
				$besterror = $mean_bef;

			}

		}

	}

	return array($bestalpha, $bestbeta);
}
//Prediction based on size parameter using best alpha beta
Function Final_compute($size, $x_t, $date_t, $alpha, $beta, $val, $fname) {
	include 'mysql_lib.php';
	$s_t = array();
	$b_t = array();
	$no_days;
	$s_t[0] = 0;
	$b_t[0] = 0;
	$s_t[1] = $x_t[1];
	$b_t[1] = $x_t[1] - $x_t[0];

	for ($i = 2; $i < $size; $i++) {
		$s_t[$i] = $alpha * $x_t[$i] + ((1 - $alpha) * ($s_t[$i - 1] + $b_t[$i - 1]));
		$b_t[$i] = $beta * ($s_t[$i] - $s_t[$i - 1]) + (1 - $beta) * $b_t[$i - 1];
	}
	$query1 = "select size from farm_benchmark". 
			  " where name like " . "'$fname'";
			  
	if ($result1 = mysql_query($query1)) {
		$row1 = mysql_fetch_assoc($result1);
		$fullsize = ($row1['size'] * 0.7);
		if ($val == 0) {
			$new_s = $s_t[$size - 1];
			$new_b = $b_t[$size - 1];
		} else {
			$new_size = $x_t[$size - 1] + $val;
			$new_s = $alpha * $new_size + (1 - $alpha) * ($s_t[$size - 1] + $b_t[$size - 1]);
			$new_b = $beta * ($new_s - $s_t[$size - 1]) + (1 - $beta) * $b_t[$size - 1];

		}
		$no_days = (($fullsize - $new_s) / $new_b) + (($alpha - 1) / $alpha);
	} else {
		echo "No Connection";
	}
	return (round($no_days));

}
//Prediction based on WPS using best alpha,beta
Function Final_compute1($size, $x_t, $date_t, $alpha, $beta, $val, $fname) {
	include 'mysql_lib.php';
	$s_t = array();
	$b_t = array();
	$no_days;
	$s_t[0] = 0;
	$b_t[0] = 0;
	$s_t[1] = $x_t[1];
	$b_t[1] = $x_t[1] - $x_t[0];

	for ($i = 2; $i < $size; $i++) {
		$s_t[$i] = $alpha * $x_t[$i] + ((1 - $alpha) * ($s_t[$i - 1] + $b_t[$i - 1]));
		$b_t[$i] = $beta * ($s_t[$i] - $s_t[$i - 1]) + (1 - $beta) * $b_t[$i - 1];
	}
	$query1 = "select wps from farm_benchmark".
			  " where name like " . "'$fname'";
	if ($result1 = mysql_query($query1)) {
		$row1 = mysql_fetch_assoc($result1);
		$fullsize = ($row1['wps'] * 0.7);
		if ($val == 0) {
			$new_s = $s_t[$size - 1];
			$new_b = $b_t[$size - 1];
		} else {
			$new_size = $x_t[$size - 1] + $val;
			$new_s = $alpha * $new_size + (1 - $alpha) * ($s_t[$size - 1] + $b_t[$size - 1]);
			$new_b = $beta * ($new_s - $s_t[$size - 1]) + (1 - $beta) * $b_t[$size - 1];

		}
		$no_days = (($fullsize - $new_s) / $new_b) + (($alpha - 1) / $alpha);
	} else {
		echo "No Connection";
	}
	return (round($no_days));

}
?>