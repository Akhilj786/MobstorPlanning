<!DOCTYPE html>
<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		
		<script>
			$(document).ready(function() {
				$('#dname').keyup(dName_check);
				//$("form").submit(alert_func);
			});
			/*
			function alert_func(){
				$('#popRecommendation').show();
					


    				
    				jQuery.ajax({
    					
    					url :"Farm_gather.php",
    					data:"",
    					dataType:"application/json",
    					success:function(data){
    						var table_cons;
    						table_cons="<table class='' id='' ";


    						$.each(data, function () {
    						table_cons+="<tr><td id=farm_id" + $i + "><a href= ''>data[i].id</td></a><td> Valu1</td></tr>";
        					
               				
						});
						$("#table_body").append(table_cons); 

    					}


    				});

			}
			*/
			/*$("form").submit(function(){
				$('#popRecommendation').show();
				alert("Inside Jquery");


    				
    				jQuery.ajax({
    					type :"POST",
    					url :"Farm_gather.php",
    					data:query,
    					dataType:"json",
    					success:function(farm_id_gather){
    						var string;
    						console.log(farm_id_gather);

    						$.each(farm_id_gather, function (data) {
    						string+="<tr><td id=farm_id" + i + "><a href= ''>data[i].id</td></a><td> Valu1</td></tr>";
        					console.log(string);
        					alert("inside Hello");
               				
						});
						$("#table_body").append(string); 
    					}

    				});
    			});*/

    				
				






			function dName_check() {
				var dname = $('#dname').val();

				jQuery.ajax({
					type : "POST",
					url : "check.php",
					data : 'dname=' + dname,
					cache : false,
					success : function(response) {
						if (response == 1) {
							$('#dname').css('border', '3px #C33 solid');
							$('#tick').hide();
							$('#cross').fadeIn();
						} else {
							$('#dname').css('border', '3px #090 solid');
							$('#cross').hide();
							$('#tick').fadeIn();
						}

					}
				});

			}

		</script>

		
		<link rel="stylesheet" href="../lib/provision.css">
	
	</head>
	<body>
		<header>
		</header>

		<div id="provisionPage" class=" div_prov" style="margin-left: auto; margin-right:auto">
			<div id="fill_form"  class="div_form" style="float:left ">
				<form name="provision_form" id="id_provisionForm" >
					<label> DomainName:</label>
					<input type="text" id="dname" >
					<img id="tick" src="../img/tick.png" width="16" height="16"/>
					<img id="cross" src="../img/cross.png" width="16" height="16"/>
					<br />
					<label> WPS:</label>
					<input type="text" id="Attr_wps" >
					<br />
					<label> RPS:</label>
					<input type="text" id="Attr_rps" >
					<br />
					<label> Size:</label>
					<input type="text" id="Attr_size" >
					<br />
					<input type="submit" value="Submit" />
				</form>
			</div>

			<aside>
			<div id="popRecommendation" style="float: right;diplay:none" class="div_farmtable">
				<table  class=" " id="Farm_table" border=1 >
					<thead>
						<th>Farm ID</th>
						<th>No of Days</th>
					</thead>
					<tbody>
					<?php
					
					include 'mysql_lib.php';


					$sql = "select * from Rem_usage limit 1,10";
					$result = mysql_query($sql);
					//$i=0;
					//$return = array();
	
					$tr_create;

				while($row=mysql_fetch_assoc($result)){
  					//echo $row['id'];
  					$tr_create.="<tr><td id= ".$row['id']."><a href=".'graph_disp.php?farm_id= '.$row['id']. ">". $row['id']."</td></a><td>" . $row['size']."</td></tr>";
 	
 	} 
 				echo $tr_create;


					?>
					</tbody>
				</table>	
			</div>
		</aside>
		</div>
		<br>
			
		<footer>
			
		</footer>	
	</body>

</html>