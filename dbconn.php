<?php

$mysql_host = "localhost";
$mysql_user = "root";
$mysql_password = "zzaacc00";
$mysql_db = "test001";

$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

if($conn->connect_error){
    die("연결 실패 : " . $conn->connect_error);
}


session_start();

?>