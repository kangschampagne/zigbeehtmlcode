<?php
$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
$msg = 'ON_PUMP1';
$len = strlen($msg);
socket_sendto($sock, $msg, $len, 0, '120.27.117.224', 11106);
socket_close($sock);
?>