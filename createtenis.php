<?php 
   session_start();
   if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {  
    include('db_conn.php');
    $idcat = $name = $price = $description = $talla = "";
    $idcat_err = $name_err = $price_err = $description_err = $talla_err = ""; 

    // Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["name"]))){
        $name_err = "Por favor ingrese el nombre del producto.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["name"]))){
        $name_err = "El nombre del producto solo puede contener letras, números y guión bajo.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM tenis WHERE id = ?";
        
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_name);
            
            // Set parameters
            $param_name = trim($_POST["name"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $name_err = "Este producto ya existe.";
                } else{
                    $name = trim($_POST["name"]);
                }
            } else{
                echo "Oops! Algo salión mal, intente de nuevo.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate description
    if(empty(trim($_POST["description"]))){
        $description_err = "Por favor ingrese una descripción del producto.";     
    }else{
        $description = trim($_POST["description"]);
    }

    // Validate price
    if(empty(trim($_POST["price"]))){
        $price_err = "Por favor ingrese el precio del producto.";     
    }else{
        $price = trim($_POST["precio"]);
    }

    // Validate talla
    if(empty(trim($_POST["talla"]))){
        $talla_err = "Por favor ingrese la talla del producto.";     
    }else{
        $talla = trim($_POST["talla"]);
    }

    // Validate id de la categoria
    if(empty(trim($_POST["idcat"]))){
        $name_err = "Por favor ingrese el id de la categoria del producto.";
    } elseif(!preg_match('/^[0-9]+$/', trim($_POST["idcat"]))){
        $name_err = "El id solo puede contener números";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM tenis WHERE idcategory = ?";
        
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_name);
            
            // Set parameters
            $param_name = trim($_POST["idcat"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 0){
                    $name_err = "Esta id de categoria no existe.";
                } else{
                    $name = trim($_POST["idcat"]);
                }
            } else{
                echo "Oops! Algo salión mal, intente de nuevo.";
            }

            // Close statement
            $stmt->close();
        }
    }


    
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($description) && empty($price) && empty($idcat) && empty($talla_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO tenis (name, description, price, idcategory, talla) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_name, $param_description, $param_price, $param_idcategory, $param_talla);
            
            // Set parameters
            $param_name = $name;
            $param_description = $description;
            $param_price = $price;
            $param_idcategory = $idcat;
            $param_talla = $talla;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: logout.php");
            } else{
                echo "Vaya! Algo salión mal, intenta de nuevo.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $link->close();
}      
       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Inicio de sesión</title>
    
    
</head>
<h1><a href="logout.php">Regresar</a></h1>
<body>
    <div class="center">
   <form method="post">
      	      <h1>Crear nueva categoria</h1>
                <?php } ?>
        <div class="txt_field">
            <input type="text" name="name_teni" id="name_teni" required class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"></span>  
            <label>Nombre del producto</label>
            <div class="txt_field">
            <input type="text" name="description" id="description" required class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"></span>  
            <label>Descripción (tallas, colores, etc).</label>
            <div class="txt_field">
            <input type="text" name="price" id="price" required class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"></span>  
            <label>Precio (MX)</label>
            <div class="txt_field">
            <input type="text" name="idcategory" id="idcategory" required class="form-control <?php echo (!empty($idcat_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"></span>  
            <label>Id de la cateregoria a la que pertenece</label>
        </div>
        <div class="txt_field">
            <input type="text" name="talla" id="talla" required class="form-control <?php echo (!empty($talla_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"></span>  
            <label>Tallas disponibles</label>
        </div>
        <input type="submit" value="Crear producto">
    </form>
    </div>
    
</body>
</html>