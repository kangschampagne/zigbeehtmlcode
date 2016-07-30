<?php 
	//connection kangsq zigbee "120.27.117.224:3306","phonegap" "localhost:3306","kangsq"
	$connection = mysql_connect("127.0.0.1:3306","kangsq","kangsq","esp_log") or die("Could not connect: " . mysql_error($connection));

	//fetch table rows from mysql db
	mysql_select_db("esp_log", $connection);
	mysql_query("SET NAMES utf8");

    //light
    $temp_result = mysql_query("SELECT * FROM `log_envirparameters` WHERE `ClusterID` = 'ESP02_S1' AND `type` = 'Temp' ORDER BY `log_envirparameters`.`ID` DESC LIMIT 1");

    //create an array
    $temp_response = array();
    $temp_posts = array();
    while($temp_row =mysql_fetch_assoc($temp_result))
    {
        $temperature[] = $temp_row['value'];
        $temp_dater[] = $temp_row['Date'];
        $temp_posts = array('value' => $temperature, 'Date' => $temp_dater);
    }
    $temp_response['temp_posts'] = $temp_posts;

    //close the db connection
    mysql_close($connection);

    //write to temp json file
    $temp_fp = fopen('../json/esp02_s1_temp.json', 'w');
    fwrite($temp_fp, json_encode($temp_response));
    fclose($temp_fp);
?>