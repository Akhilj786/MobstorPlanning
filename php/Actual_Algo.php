<?php
//First comment
if (isset($_POST['size']) && isset($_POST['size'])) {
	$val = $_POST['size'];
	$farm_list = array("usm1", "use12", "use18", "use26", "usw10", "usw26", "use70", "usw70");

	include 'mysql_lib.php';
	$HashList = array();
	$size1 = count($farm_list);
	for ($i = 0; $i < $size1; $i++) {

		$size_array = array();
		$date_array = array();
		$put_array = array();
		$sql = "select fdate,fsize,fput_ops from farm_use where fname like" . "'$farm_list[$i]'";
		#echo $sql;
		if ($result = mysql_query($sql)) {

			while ($row = mysql_fetch_assoc($result)) {
				array_push($size_array, $row['fsize']);
				array_push($date_array, $row['fdate']);
				array_push($put_array,$row['fput_ops']);
				//echo "<br>".$row['fdate'].$row['fsize']."<br>";

			}
			$size = count($size_array);

			list($alpha, $beta) = compute_parameter($size, $size_array, $date_array, $farm_list[$i]);
			list($alpha1, $beta1) = compute_parameter($size, $put_array, $date_array, $farm_list[$i]);
			//list($alpha1,$beta1)=compute_parameter($size,$put_array,$date_array,$farm_list[$i]);

			//echo $farm_list[$i]." ".$alpha." ".$beta."<br>";
			$final_day = Final_compute($size, $size_array, $date_array, $alpha, $beta, $val, $farm_list[$i]);
			$final_day1 = Final_compute($size, $put_array, $date_array, $alpha1, $beta1, $val, $farm_list[$i]);
			$HashList[str_replace("'", "", $farm_list[$i])] = $final_day;

		}

	}
	arsort($HashList);
	//$HashList = array_slice($HashList,0,5);
	
	//$sql = "select size from farm_benchmark where fname like" . "'$farm_list[$i]'";
	$string;
	//="<table id="."Farm_prediction ". "border="."2>

	foreach ($HashList as $key => $val) {
		$sizesql = "select size from farm_benchmark where name like " ."'$key'";
		//echo $sizesql;
		$result1 = mysql_query($sizesql);
		$val_row = mysql_fetch_assoc($result1);
		$fullsize = ($val_row['size']);
		$string .= "<tr><td id=$key>" . $key . "</td><td>" . $val ."</td><td>".$fullsize."</td></tr>";
	}
	echo $string . "</table>";
}

function compute_parameter($size, $x_t, $date, $fname) {

	$fullstring = "fname,fdate,fsize,smoothing_val,best_fit\n";
	$bestalpha = 0;
	$bestbeta = 0;
	$besterror = 10000;
	$string;
	$s_t;
	$b_t;
	for ($a = 0.1; $a < 1.0; $a = $a + 0.05) {
		$alpha = $a;
		for ($b = 0.1; $b < 1.0; $b = $b + 0.05) {
			$beta = $b;
			$s_t = array();
			$b_t = array();
			$future = array();
			$mean_error = array();
			$mean_square = 0;
			$mean_sqerr = 0;
			$mean_bef=0;
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
					//$mean_error[$i] = pow($x_t[$i] - $future[$i], 2);
					$temp=(abs($x_t[$i] - $future[$i])*100);
					if($x_t[$i]!=0)
					$mean_error[$i] = ($temp/$x_t[$i]);
					else
						$mean_error[$i] = 0;

				}

				$mean_square = $mean_square + $mean_error[$i];
			}
			$mean_bef = ($mean_square / $size);
			//$mean_sqerr = sqrt($mean_bef);

			if ($besterror > $mean_bef) {
				$bestalpha = $a;
				$bestbeta = $b;
				$besterror = $mean_bef;
				//$besterror =$mean_bef;
			}

		}

	}

	return array($bestalpha, $bestbeta);
}

Function Final_compute($size, $x_t, $date_t, $alpha, $beta, $val, $fname) {
	include 'mysql_lib.php';
	//$fullstring = "fname,fdate,fsize,smoothing_val,best_fit\n";

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
	$query1 = "select size from farm_benchmark where name like " . "'$fname'";
	//echo $query1."<br>";
	if ($result1 = mysql_query($query1)) {
		$row1 = mysql_fetch_assoc($result1);
		$fullsize = ($row1['size'] * 0.7);
		//	$string="\n\n".$fname.",".$x_t[$size-1].",".$s_t[$size-1].",".$b_t[$size-1]."\n";
		if ($val == 0) {
			$new_s = $s_t[$size - 1];
			$new_b = $b_t[$size - 1];
		} else {
			$new_size = $x_t[$size - 1] + $val;
			$new_s = $alpha * $new_size + (1 - $alpha) * ($s_t[$size - 1] + $b_t[$size - 1]);
			$new_b = $beta * ($new_s - $s_t[$size - 1]) + (1 - $beta) * $b_t[$size - 1];
			//$no_days=($fullsize-$new_s)/$new_b;

			//	$string.=$fname.",".$new_size.",".$new_s.",".$new_b."\n";

		}
		$no_days = (($fullsize - $new_s) / $new_b) + (($alpha - 1) / $alpha);
	} else {
		echo "No Connection";
	}
	//print $string;
	//print $fullsize."\t".$no_days;
	return (round($no_days));

}
?>