<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {   
include('db_conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Editar registros</title>
</head>
<body>
    <nav><h1>Mis productos</h1></nav>
    <div class="container">
        <table>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Categoria</th>
                <th>Talla</th>
                <th colspan='2'>Editar</th>
            </tr>
          
<?php
$count=1;            
$sql="SELECT * FROM tenis ORDER BY id";

$resultado=$link->query($sql);

    while($fila=$resultado->fetch_assoc())
{?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $fila["Nombre"]; ?></td>
                <td><?php echo $fila["Descripción"]; ?></td>
                <td><?php echo $fila["Precio"]; ?></td>
                <td><?php echo $fila["Categoria"]; ?></td>
                <td><?php echo $fila["Talla"]; ?></td>
                <td><a href="eliminar.php?id=<?php echo $fila['id'];?>">Eliminar</a></td>
                <td><a href="actualizar.php?id=<?php echo $fila['id'];?>">Actualizar</a></td>
            </tr>

<?php $count++;
$link->close();
}?>      
    </table>
    </div>
</body>
</html><?php }else{
	header("Location: welcome.php");
} ?>