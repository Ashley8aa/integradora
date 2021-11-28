<?php
// incluye conexión
require_once "db_conn.php";
 
// Define unas variables 
$username = $name = $password = $role = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Procesamiento para verificación datos enviados
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Valida al usuario
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese un usuario.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Solo letrar, números y guiones bajos.";
    } else{
        // Se prepara la sentencia sql
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $link->prepare($sql)){
            // Enalzamos lA  variables hacia la sentencia sql como un  parametro
            $stmt->bind_param("s", $param_username);
            
            // Establecemos el parametro
            $param_username = trim($_POST["username"]);
            
            // Ejecutamos la sentencia
            if($stmt->execute()){
                //Almacenamos el resultado
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "Este nombre de usuario ya existe.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Algo salio mal. Por favor intente de nuevo.";
            }

            // cerramos la sentencia 
            $stmt->close();
        }
    }

    // Validación  nombre
    if(empty(trim($_POST["name"]))){
        $name_err = "Por favor ingrese su nombre.";     
    } else{
        $name = trim($_POST["name"]);
    }
    
    // Validación  password/contraseña
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese una contraseña.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña debe contener al menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar confirmación password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor confirme su contraseña.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Las contraseñas no coincide.";
        }
    }
    
    // Checa no exista error en la entradas y procede a insertarlo en la bd
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        //Prepara el insert para mysql
        $sql = "INSERT INTO users ('user', username, pass, name) VALUES (?, ?, ?, ?)";
         
        if($stmt = $link->prepare($sql)){
            // Enalazamos
            $stmt->bind_param("ssss", $param_username, $param_password, $param_name, $param_role);
            
            // Establecemos
            $param_username = $username;
            $param_name = $name;
            $param_rolea = $role;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // ejectuamos nuestra sentencia
            if($stmt->execute()){
                // Redirige a la página de iniciar sesión 
                header("location: login.php");
            } else{
                echo "Oops! Algo sucedio, intente de nuevo.";
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
    <title>Registro</title>
</head>
<body>
<div class="center">
        <h1>Registro de usuarios</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="txt_field">
            <input type="text" required name="username"  class="form-control  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
            <label>Nombre</label>   
            <span class="invalid-feedback"><?php echo $username_err; ?></span>  
            
        </div>
        <div class="txt_field">
            <input type="text" required name="name"  class="form-control  <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
            <label>Nombre de usuario</label>   
            <span class="invalid-feedback"><?php echo $name_err; ?></span>  
            
        </div>
        <div class="txt_field">
            <input type="password" required name="password" class="form-control  <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <label>Contraseña</label>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            
        </div>
        <div class="txt_field">
            <input type="password" required name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
            <label>Confirmar contraseña</label>    
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            
        </div>
        <div class="form-group">
        <input type="submit" value="Registrarme">
            </div>
        <div class="signup_link">
            ¿Ya tienes cuenta?,<a href="login.php"> ¡Inicia sesión!</a>
        </div>
    </form>
    </div>
</body>
</html>