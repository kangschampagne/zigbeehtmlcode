<?php 
	//connection kangsq tbl_employee
	$connection = mysql_connect("localhost:3306","kangsq","kangsq","zigbee") or die("Could not connect: " . mysql_error($connection));

	//fetch table rows from mysql db
	mysql_select_db("zigbee", $connection);
	mysql_query("SET NAMES utf8");
    //$lastli = "SELECT MAX(lightintensity) AS lightintensity FROM ZigBee_light";
    //$result = mysql_query($lastli);
    //$result = mysql_query("SELECT LAST(employee_id) FROM tbl_employee");
    $result = mysql_query("SELECT * FROM zigbee_light WHERE light_id IN (
        SELECT max(light_id)  FROM zigbee_light) ");
    //create an array
    $response = array();
    $posts = array();
    while($row =mysql_fetch_assoc($result))
    {
        $lightintensity[] = $row['lightintensity'];
        $dater[] = $row['dater'];
        $posts = array('lightintensity' => $lightintensity, 'dater' => $dater);
        //$rs = $row;
    }

    $response['posts'] = $posts;



    //Convert PHP Array to JSON String
    //echo json_encode($emparray);

    //close the db connection
    mysql_close($connection);

    //write to json file
    $fp = fopen('json/lightintensity.json', 'w');
    fwrite($fp, json_encode($response));
    fclose($fp);
 ?>