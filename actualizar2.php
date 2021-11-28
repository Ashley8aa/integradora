<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {  
 include('db_conn.php');
$id=$_POST['id'];
$nom=$_POST['Nombre'];
$des=$_POST['Descripción'];
$price=$_POST['Precio'];
$cat=$_POST['Categoria'];
$tall=$_POST['Talla'];

$sql="UPDATE tenis SET Nombre='$nom', Descripción='$des', Precio='$price', Categoria='$cat', Talla='$tall' WHERE id='$id';";
$resultado=mysqli_query($link,$sql) or die(mysqli_error($link));
header("Location: editar.php")
?><?php }else{
	header("Location: welcome.php");
} ?>