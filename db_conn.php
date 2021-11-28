<?php  

$sname = "localhost:3307";
$uname = "root";
$password = "root";
$db_name = "integradora";

$mysqli = mysqli_connect($sname, $uname, $password, $db_name);

if (!$mysqli) {
	echo "Connection Failed!";
	exit();
}