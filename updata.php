<?php

	//$url = 'http://www.weiwen.love:8080/updata.php?lightintensity=80&temperature';
	
	//
	$lightint = $_GET["lightintensity"];
	date_default_timezone_set("Asia/Chongqing");
	$daterint = Date("Y-m-d H:i:s" ,time());
	
	//$gets=parse_url($url);
	// print_r($gets);
	// print_r($gets['scheme']);

	//$emid =  $gets['scheme'];
	//$emname = $gets['fragment'];

	//connection kangsq tbl_employee
	$connection = mysql_connect("localhost:3306","kangsq","kangsq","ZigBee") or die("Could not connect: " . mysql_error($connection));

	//fetch table rows from mysql db
	mysql_select_db("ZigBee", $connection);
	mysql_query("SET NAMES utf8");

	//
	$sql="INSERT INTO ZigBee_light (lightintensity,dater)
	VALUES
	('$lightint','$daterint')";

	if (!mysql_query($sql,$connection))
	  {
	  die('Error: ' . mysql_error());
	  }
	echo "1 light intensity record added";

	mysql_close($connection);
?>