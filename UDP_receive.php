<?php
 //echo phpversion();
//Reduce errors
 //error_reporting(~E_WARNING);
 //error_reporting(~E_NOTICE);
 error_reporting(0);
 //ini_set('mysql.connect_timeout',3000);
 //ini_set('default_socket_timeout',3000);
 //ini_set('display_errors', 1);
 //error_reporting(E_ALL);

set_time_limit( 0 );
ob_implicit_flush();
//mysql_query("SET NAMES utf8");

//Create a UDP socket

$socket = socket_create( AF_INET, SOCK_DGRAM, SOL_UDP );
if ( $socket === false ) {
    echo "socket_create() failed:reason:" . socket_strerror( socket_last_error() ) . "\n";
}
echo "Socket created. \n";

$ok = socket_bind( $socket, '0.0.0.0', 11109 );
if ( $ok === false ) {
    echo "socket_bind() failed:reason:" . socket_strerror( socket_last_error( $socket ) );
}
echo "Socket bind OK \n";

// GET FROM DATABASE
define('DBHOST','127.0.0.1');//IP
define('DBUSER','kangsq');
define('DBPASSWORD','kangsq');
define('DBNAME','esp_log');


 
//Do some communication, this loop can handle multiple clients
while(1)
{
	$db = new mysqli(DBHOST,DBUSER,DBPASSWORD,DBNAME);
	$link = mysql_connect(DBHOST,DBUSER,DBPASSWORD) or die ("Could not connect: " . mysql_error($link));

	date_default_timezone_set("Asia/Taipei");

	mysql_query("SET NAMES utf8");
	mysql_select_db(DBNAME, $link);
    
    if( !mysql_ping($link) ) $link = mysql_connect(DBHOST,DBUSER,DBPASSWORD, true);
   
	$date = date('m/d/Y h:i:s a', time());
	
	// //////////////////////////////////////////////////////////////////////
 //    //Receive some data
 //    $r = socket_recvfrom($sock, $buf, 512, MSG_WAITALL, $remote_ip, $remote_port);
 //    //echo "$remote_ip : $remote_port -- " . $buf;
	// list($nwkaddr,$type, $value, $location) =  explode(":",$buf);
    //$remote_ip = "";
    //$remote_port = 0;
    socket_recvfrom($socket, $buf, 512, 0, $remote_ip, $remote_port);
    list($nwkaddr,$type, $value, $location) =  explode(":",$buf);
    //echo $buf;
    //usleep( 1000 );
	// //////////////////////////////////////////////////////////////////////
	

    $date =  date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
	$value = number_format((float)$value,3, '.', '');
	$sql = "INSERT INTO  `esp_log`.`log_envirparameters` (`ID` ,`nwkAddr` ,`ClusterID` ,`Date` ,`type` ,`value` ,`extAddr` ,`location` ,`isbackup`)
					VALUES (NULL , '$nwkaddr',  NULL,  '$date',  '$type',  '$value', NULL ,  '$location',  '0')";

	$result = $db->query($sql);
	if($result)
	{
		echo "Success.";

	}
	else
	{
		echo "Error.";

	}
	echo $nwkaddr.":".$type.":".(float)$value.":".$date.":".$location."\n";
    //Send back the data to the client
    socket_sendto($sock, "OK " . $buf , 100 , 0 , $remote_ip , $remote_port);
		
}


// while ( true ) {
//     $remote_ip = "";
//     $remote_port = 0;
//     //socket_recvfrom( $socket, $buf,1024, 0, $from, $port );

//     socket_recvfrom($socket, $buf, 512, 0, $remote_ip, $remote_port);
//     list($nwkaddr,$type, $value, $location) =  explode(":",$buf);

//     echo $buf;
//     usleep( 1000 );
// }
	

    socket_close($socket);
?>