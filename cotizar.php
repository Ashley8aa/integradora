<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body class="container">
    <table class="table table-dark table-striped">
        
    


<?php
include ('db_conn.php');

$sql = "SELECT name, description, price, talla FROM tenis";
$resultado = $link->query($sql);

if ($resultado->num_rows>0){
    while ($fila = $resultado -> fetch_assoc())
    {
        echo "<tr>";
        echo "<td>".$fila ['name']."</td>";
        echo "<td>".$fila ['description']."</td>";
        echo "<td>".$fila ['price']."</td>";
        echo "<td>".$fila ['talla']."</td>";
        echo "</tr>";
    }
}
else {
    echo "No se encuentran los productos";
}
$con -> close();



?>
    </table>
</body>
</html>
