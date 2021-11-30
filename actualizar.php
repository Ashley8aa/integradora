<?php
 session_start();
 if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {  
  include('db_conn.php');
$id=$_GET['id'];

$query=mysqli_query($link,"SELECT * FROM tenis WHERE id=$id");
$fila=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar productos</title>
</head>
<body>
    <nav><h1>Actualizar productos</h1></nav>
    <div>
        <form action="actualizar2.php" method="post">
            <p><label for="id">Id: <input type="text" name="id" id="" value="<?php echo $fila['id'];?>" readonly></label></p>
            <p><label for="Nombre">Nombre: <input type="text" name="Nombre" id="" value="<?php echo $fila['Nombre'];?>"></label></p>
            <p><label for="Email">Descripción: <input type="text" name="Email" id="" value="<?php echo $fila['Descripción'];?>"></label></p>
            <p><label for="Direccion">Precio: <input type="text" name="Direccion" id="" value="<?php echo $fila['Precio'];?>"></label></p>
            <p><label for="Telefono">Categoria: <input type="tex" name="Categoria" id="" value="<?php echo $fila['Categoria'];?>"></label></p>
            <p><label for="Telefono">Talla: <input type="text" name="Talla" id="" value="<?php echo $fila['Talla'];?>"></label></p>
            <p><input type="submit" value="Actualizar datos"></p>
        </form>
    </div>
</body>
</html><?php }else{
	header("Location: welcome.php");
} ?>
