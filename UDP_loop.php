<?php
 
//Reduce errors
error_reporting(~E_WARNING);
 
//Create a UDP socket
if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Couldn't create socket: [$errorcode] $errormsg \n");
}
 
echo "Socket created \n";
 
// Bind the source address
if( !socket_bind($sock, "0.0.0.0" , 9992) )
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not bind socket : [$errorcode] $errormsg \n");
}
 
echo "Socket bind OK \n";
 
 
   $dbhost = '140.135.9.72';
    $dbuser = 'jason';
    $dbpass = '123456789';
    $dbname = 'ua616';


 
//Do some communication, this loop can handle multiple clients
while(1)
{
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    mysql_select_db($dbname);
	date_default_timezone_set("Asia/Taipei");
	mysql_query("SET NAMES 'utf8'");

   
	$date = date('m/d/Y h:i:s a', time());
	
	//////////////////////////////////////////////////////////////////////
    //Receive some data
    $r = socket_recvfrom($sock, $buf, 512, MSG_WAITALL, $remote_ip, $remote_port);

	list($nwkaddr,$type, $value, $location) =  explode(":",$buf);
	//////////////////////////////////////////////////////////////////////
	
			//FILTER VALUES:
	$arrays = array((array($type,$value)));
	if($arrays[0][0] == 'QUERY' && $arrays[0][1] == 0)
	{ 
    $sql = "SELECT Value ,Date FROM `urine_616` where `Location` = '616' AND `Type`= 'MPH'  ORDER BY `Date` DESC LIMIT 0,1 ";  
    $result = $conn->query($sql);
    $data = mysqli_fetch_row($result);
    echo "SENT DATABASE..."."MPH=".$data[0]."\n";
    socket_sendto($sock, "MPH=" . $data[0] , 100 , 0 , $remote_ip , $remote_port);
	}
		if($arrays[0][0] == 'QUERY' && $arrays[0][1] == 1)
	{ 
    $sql = "SELECT Value ,Date FROM `urine_616` where `Location` = '616' AND `Type`= 'BPH'  ORDER BY `Date` DESC LIMIT 0,1 ";  
    $result = $conn->query($sql);
    $data = mysqli_fetch_row($result);
    echo "SENT DATABASE..."."BPH=".$data[0]."\n";
    socket_sendto($sock, "BPH=" . $data[0] , 100 , 0 , $remote_ip , $remote_port);
	}
	
	
    if($arrays[0][0] != 'QUERY')
	{
    $date =  date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
	$value = number_format((float)$value,2, '.', '');
	echo $nwkaddr.":".$type.":".(float)$value.":".$date.":".$location."\n";
	
	$date =  date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
	$sql = "INSERT INTO  `urine_616` (`ID` ,`Address` ,`Date` ,`Type` ,`Value` ,`Location` )
					          VALUES (NULL ,'$nwkaddr','$date','$type','$value','$location' )";
  $result = $conn->query($sql);
    //Send back the data to the client
    socket_sendto($sock, "OK " . $buf , 100 , 0 , $remote_ip , $remote_port);
	}
}

 
socket_close($sock);
?>