<!Doctype html>
<head>
<script type="text/javascript" src="../js/dygraph-combined.js"></script>
</head>
<body>
<div id="graphdiv" style="width:900px ; height:300px" class="div_graph"></div>
		<script type="text/javascript">
		<?php
			$farm_id=$_GET['farm_id'];
			include 'mysql_lib.php';
			$sql =""
		?>

  		g = new Dygraph(

    // containing div
    document.getElementById("graphdiv"),

    // CSV or path to a CSV file.
    $var

  );
</script>

</body>
</html>