<?php 
    //connection kangsq zigbee
    $connection = mysql_connect("localhost:3306","kangsq","kangsq","zigbee") or die("Could not connect: " . mysql_error($connection));

    //fetch table rows from mysql db
    mysql_select_db("zigbee", $connection);
    mysql_query("SET NAMES utf8");

  //light
    $light_result = mysql_query("SELECT * FROM zigbee_light ORDER BY light_id DESC LIMIT 0,20");
    //create an array
    $light_response = array();
    $light_posts = array();
    while($light_row =mysql_fetch_assoc($light_result))
    {
        $lightintensity[] = $light_row['lightintensity'];
        $light_dater[] = $light_row['light_dater'];
        $light_posts = array('lightintensity' => $lightintensity, 'light_dater' => $light_dater);
    }
    $light_response['light_posts'] = $light_posts;


  //temp
    $temp_result = mysql_query("SELECT * FROM zigbee_temp ORDER BY temp_id DESC LIMIT 0,20");
    //create an array
    $temp_response = array();
    $temp_posts = array();
    while($temp_row =mysql_fetch_assoc($temp_result))
    {
        $temperature[] = $temp_row['temperature'];
        $temp_dater[] = $temp_row['temp_dater'];
        $temp_posts = array('temperature' => $temperature, 'temp_dater' => $temp_dater);
    }
    $temp_response['temp_posts'] = $temp_posts;

  // //humi
  //   $humi_result = mysql_query("SELECT * FROM zigbee_humi WHERE humi_id IN (
  //       SELECT max(humi_id)  FROM zigbee_humi) ");
  //   //create an array
  //   $humi_response = array();
  //   $humi_posts = array();
  //   while($humi_row =mysql_fetch_assoc($humi_result))
  //   {
  //       $humiduty[] = $humi_row['humiduty'];
  //       $humi_dater[] = $humi_row['humi_dater'];
  //       $humi_posts = array('humiduty' => $humiduty, 'humi_dater' => $humi_dater);
  //   }
  //   $humi_response['humi_posts'] = $humi_posts;

  // //gas
  //   $gas_result = mysql_query("SELECT * FROM zigbee_gas WHERE gas_id IN (
  //       SELECT max(gas_id)  FROM zigbee_gas) ");
  //   //create an array
  //   $gas_response = array();
  //   $gas_posts = array();
  //   while($gas_row =mysql_fetch_assoc($gas_result))
  //   {
  //       $gas[] = $gas_row['gas'];
  //       $gas_dater[] = $gas_row['gas_dater'];
  //       $gas_posts = array('gas' => $gas, 'gas_dater' => $gas_dater);
  //   }
  //   $gas_response['gas_posts'] = $gas_posts;

    //close the db connection
    mysql_close($connection);

    //write to light json file
    $light_fp = fopen('../json/chart_light.json', 'w');
    fwrite($light_fp, json_encode($light_response));
    fclose($light_fp);
    //write to temp json file
    $temp_fp = fopen('../json/chart_temp.json', 'w');
    fwrite($temp_fp, json_encode($temp_response));
    fclose($temp_fp);
    // //write to humi json file
    // $humi_fp = fopen('json/humiduty.json', 'w');
    // fwrite($humi_fp, json_encode($humi_response));
    // fclose($humi_fp);
    // //write to gas json file
    // $gas_fp = fopen('json/gas.json', 'w');
    // fwrite($gas_fp, json_encode($gas_response));
    // fclose($gas_fp);
 ?>