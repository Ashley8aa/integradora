<?php 
   session_start();
   if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {   ?>

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
<h1><a href="index.html">Happiness Merch!</a></h1>
<body>
    <div class="center">
   <form
      	      action="php/check-login.php" 
      	      method="post">
      	      <h1>Inicio de sesión</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
              <?php } ?>
        <div class="txt_field">
            <input type="text" name="username" id="username" required class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"></span>  
            <label>Nombre de usuario</label>
        </div>
        <div class="txt_field">
            <input type="password" required name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"></span>
            <label>Contraseña</label>
        </div>
        <div class="mb-1">
		    <label class="form-label">Selecciona el tipo de usuario:</label>
		  </div>
		  <select class="form-select mb-3"
		          name="role" 
		          aria-label="Default select example">
			  <option  value="user">Usuario</option>
			  <option value="admin">Admin</option>
		  </select>
        <input type="submit" value="Ingresar">
        <div class="signup_link">
            ¿Eres nuevo?,<a href="registro.php"> Crea una cuenta</a>
        </div>
    </form>
    </div>
    
</body>
</html>
<?php }else{
	header("Location: welcome.php");
} ?>