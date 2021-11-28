<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {   
    include('db_conn.php');
    $id=$_REQUEST['id'];
    $sql="DELETE FROM tenis WHERE id=$id";
    $resultado= mysqli_query($link,$sql)or die(mysqli_error($link));
    header("Location: editar.php")
?><?php }else{
	header("Location: welcome.php");
} ?>