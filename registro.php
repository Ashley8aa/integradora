<?php
// Include config file
require_once "db_conn.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
$nombre=$_POST['name'];
$password=$_POST['password'];
$username=$_POST['username'];
$pass=md5($password);
$rol='user';

$sql= "INSERT INTO users  VALUES(0,'$rol','$username','$pass','$nombre')";



if ($mysqli->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    
    $mysqli->close(); 

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
    <title>Registro de usuarios</title>
    
    
</head>
<body>
    <div class="center">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="txt_field">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control">
                
            </div>    
            <div class="txt_field">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                
            </div>
            
            <div class="txt_field">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control">
                
            </div>
            <div class="txt_field">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>