<?php
 echo phpversion();
//Reduce errors
 error_reporting(0);
 //ini_set('mysql.connect_timeout',3000);
 //ini_set('default_socket_timeout',3000);
 //ini_set('display_errors', 1);
 set_time_limit( 0 );
 ob_implicit_flush();

//Create a UDP socket
$socket = socket_create( AF_INET, SOCK_DGRAM, SOL_UDP );
if ( $socket === false ) {
    echo "socket_create() failed:reason:" . socket_strerror( socket_last_error() ) . "\n";
}
echo "Socket created. \n";

$ok = socket_bind( $socket, '0.0.0.0', 11106 );
if ( $ok === false ) {
    echo "socket_bind() failed:reason:" . socket_strerror( socket_last_error( $socket ) );
}
echo "Socket bind OK \n";
 
 
// GET FROM DATABASE
define('DBHOST','127.0.0.1');//IP
define('DBUSER','kangsq');
define('DBPASSWORD','kangsq');
define('DBNAME','home_control');

//define
$flag = 1;
$sendflag = 1;
 
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
	
	//////////////////////////////////////////////////////////////////////
    //Receive some data
    socket_recvfrom($socket, $buf, 512, 0, $remote_ip, $remote_port);
    //echo "$remote_ip : $remote_port -- " . $buf;

    echo "$remote_ip : $remote_port -- " . $buf."\r\n";

    //save socket ip port//
    
    if ($buf == "controled_client_connected_ok" ) {
    	$controled_client_ip = $remote_ip;
    	$controled_client_port = $remote_port;
    	$controled_client_buf = $buf;
    	$flag = 0;
    	$sendflag = 0;
    }
	//////////////////////////////////////////////////////////////////////

    //1.Server received controled_client data
	//if ($sendflag == 1 && $controled_client_buf=="controled_client_connected_ok") {
   			//2.Send back the data to the controled_client
	//		socket_sendto($socket, "ready to sent data" , 100 , 0 , $remote_ip , $remote_port);
	//		$flag = 1;
	//		$buf = "controled_client_connected_ok";
    //}
    
    //3.control_client to sql
	if (sendflag == 0) {
		if($buf=="ON_PUMP1")
		{
			$STATS = "PUMP1";
			$SWITCH = "ON";
		}
			if($buf=="ON_PUMP2")
		{
			$STATS = "PUMP2";
			$SWITCH = "ON";
		}
			if($buf=="ON3")
		{
			$STATS = "STAT3";
			$SWITCH = "ON";
		}	if($buf=="ON4")
		{
			$STATS = "STAT4";
			$SWITCH = "ON";
		}
		
			if($buf=="OFF_PUMP1")
		{
			$STATS = "PUMP1";
			$SWITCH = "OFF";
		}
			if($buf=="OFF_PUMP2")
		{
			$STATS = "PUMP2";
			$SWITCH = "OFF";
		}
			if($buf=="OFF3")
		{
			$STATS = "STAT3";
			$SWITCH = "OFF";
		}	if($buf=="OFF4")
		{
			$STATS = "STAT4";
			$SWITCH = "OFF";
		}
		$date =  date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
		
		$sql = "INSERT INTO  `home_control`.`led_state` (`ID` ,`SWITCH`, `STAT`, `IP`, `DATETIME`)
						VALUES (NULL,'$STATS','$SWITCH','$remote_ip','$date')";

		$result = $db->query($sql);

		if($result){
			echo "Success"."\r\n";
		}
		else{
			echo "Error"."\r\n";
		}

		//4.Send back the data to the control_client
		if ($sendflag == 0) {
			socket_sendto($socket, "Control_OK " . $buf , 100 , 0 , $controled_client_ip , $controled_client_port);
		// 	echo "Send to control_client alrealdy!" . $buf;
		 }
	}
    
}

 
socket_close($socket);
?>