<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/Grid.css">
        <link rel="stylesheet" type="text/css" href="CSS/login.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
        <title>Admin</title> 
    </head>
    


    <body>

<?php
include('ligar_bd.php');
if($_POST['submit'])
{

    $admin = $_POST['user'];
    $pass = $_POST['rpass'];
    $hashed_pass = crypt($pass,"123");
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $sql = $db->prepare(" INSERT INTO `admin` (`admin`,`password`) VALUES (:admin,:admin,:pass)");
    $sql->bindParam(':admin', $admin);
    $sql->bindParam(':pass', $hashed_pass);

    $sql->execute();
    
}

?>








          
            <div class="centered">
              <h2>Login</h2>
                    <form action="login.php" method="POST"> 
                        <input type="username" name="admin" placeholder="Username">
                        <input type="password" name="pass" placeholder="Password">
                        <input type="submit" name="submit" value="Login">
                    </form>
            </div>
          </div>
        
    </body>
    
    
    
</html>