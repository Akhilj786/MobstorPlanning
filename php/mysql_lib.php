<?php
//Database connection File
$hostname = "127.0.0.1";
$username = 'root';
$password = '';
$database = 'Farm_Mobstor';
mysql_connect($hostname, $username, $password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error());

?>