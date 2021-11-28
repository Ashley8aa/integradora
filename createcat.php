<?php 
   session_start();
   if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {  
    include('db_conn.php');
    $category = "";
    $category_err = ""; 

    // Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["category"]))){
        $category_err = "Por favor ingrese el nombre de la categoria.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["category"]))){
        $category_err = "El nombre de la categoria solo puede contener letras, números y guión bajo.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM category_tenis WHERE id = ?";
        
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_category);
            
            // Set parameters
            $param_category = trim($_POST["category"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $category_err = "Esta categoria ya existe.";
                } else{
                    $category = trim($_POST["category"]);
                }
            } else{
                echo "Oops! Algo salión mal, intente de nuevo.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Check input errors before inserting in database
    if(empty($category_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO category_tenis (name) VALUES (?)";
         
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_category);
            
            // Set parameters
            $param_category = $category;
            
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
			</div>
              <?php } ?>
        <div class="txt_field">
            <input type="text" name="category" id="category" required class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"></span>  
            <label>Nombre de la categoria</label>
        </div>
        <input type="submit" value="Crear categoria">
    </form>
    </div>
    
</body>
</html>