<?php

include('ligar_bd.php');

if($_POST['register'])
{

    $user = $_POST['user'];
    
    $name = $_POST['name'];
    
    $pass = $_POST['repeatpass'];
    
    $hashed_pass = crypt($pass,"123");
    
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    
    $sql = $db->prepare(" INSERT INTO `user` (`name`,`username`,`password`) VALUES (:name,:user,:pass)");
    
    $sql->bindParam(':name', $name);
    $sql->bindParam(':user', $user);
    $sql->bindParam(':pass', $hashed_pass);
    
    $sql->execute();

    $count = $sql->rowCount();

        if ($count > 0) {

            echo"Registo feito !";
        }

    
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/Grid.css">
        <link rel="stylesheet" type="text/css" href="css/register.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
        <title>Adventure</title> 
    </head>
    


    <body>
        <div class="split left">
            <div class="centered">
              <img src="img/waterfall.jpg">
            </div>
          </div>
          
          <div class="split right">
            <div class="centered">
              <h2>Register</h2>
                    <form action="" method="POST"> 
                        <input type="username" name="user" placeholder="Username">
                        <input type="text" name="name" placeholder="Name">
                        <input type="password" name="pass" placeholder="Password">
                        <input type="password" name="repeatpass" placeholder="Repeat Password">
                        <input type="submit" name="register" value="Register">
                    </form>
            </div>
          </div>
        
    </body>
    
    
    
</html>