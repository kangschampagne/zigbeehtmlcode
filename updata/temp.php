<?php

	//$url = 'http://www.weiwen.love:8080/updata/temp.php?temperature=80&other';
	
	//
	$tempint = $_GET["temperature"];
	date_default_timezone_set("Asia/Chongqing");
	$daterint = Date("Y-m-d H:i:s" ,time());

	//connection kangsq tbl_employee
	$connection = mysql_connect("localhost:3306","kangsq","kangsq","ZigBee") or die("Could not connect: " . mysql_error($connection));

	//fetch table rows from mysql db
	mysql_select_db("ZigBee", $connection);
	mysql_query("SET NAMES utf8");

	//
	$sql="INSERT INTO ZigBee_temp (temperature,temp_dater)
	VALUES
	('$tempint','$daterint')";

	if (!mysql_query($sql,$connection))
	  {
	  die('Error: ' . mysql_error());
	  }
	echo "1 temperature record added";

	mysql_close($connection);
?>