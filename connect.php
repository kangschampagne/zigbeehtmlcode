<?php 
	//connection kangsq tbl_employee
	$connection = mysql_connect("localhost:3306","kangsq","kangsq","zigbee") or die("Could not connect: " . mysql_error($connection));

	//fetch table rows from mysql db
	mysql_select_db("zigbee", $connection);
	mysql_query("SET NAMES utf8");

    //light
    $light_result = mysql_query("SELECT * FROM zigbee_light WHERE light_id IN (
        SELECT max(light_id)  FROM zigbee_light) ");
    //create an array
    $light_response = array();
    $light_posts = array();
    while($light_row =mysql_fetch_assoc($light_result))
    {
        $lightintensity[] = $light_row['lightintensity'];
        $light_dater[] = $light_row['dater'];
        $posts = array('lightintensity' => $lightintensity, 'dater' => $light_dater);
    }

    $light_response['posts'] = $light_posts;
    //Convert PHP Array to JSON String
    //echo json_encode($emparray);

    //close the db connection
    mysql_close($connection);

    //write to json file
    $fp = fopen('json/lightintensity.json', 'w');
    fwrite($fp, json_encode($response));
    fclose($fp);
 ?>