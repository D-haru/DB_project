<?php 
// 디비 연결 주소 
$con='(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57 )(PORT = 1521)))(CONNECT_DATA =(SID = orcl)))';
$username="DBB2022G3";
$password="test1234";

$db = oci_connect($username, $password, $con);

if($db){
    # echo("Oracle 19c \$db : $db<br>");
    #$st = oci_server_version($db);
    #echo("$st<br>");

}

 ?>