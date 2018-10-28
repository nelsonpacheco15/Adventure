<?php
//incluir o ficheiro onde contem a ligação
include('../ligar_bd.php');
//se houver um pedido de resposta do formulario(isto ta defenido no input submit, o submit faz um pedido ao servidor, que tem como nome "login")
if($_POST['login'])
{
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    //cross-site scripint protection
    $user = htmlspecialchars($user, ENT_QUOTES, 'UTF-8');
    //mysql injection protection
    $hashed_password = crypt($pass,"123");

    $sql = $db->prepare("SELECT * from administrator where username = :username and password= :password");    
    $sql->bindParam(':username', $user);
    $sql->bindParam(':password', $hashed_password);
    $sql->execute();

    $count = $sql->rowCount();
    if ($count > 0){
        header('Location:index_back.php');

    } else {
        echo "<script type='text/javascript'>alert('Error wrong credencials')</script>";
    }
}
?>
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
            <div class="centered">
              <h2>Login</h2>
                    <form action="" method="POST"> 
                        <input type="username" name="user" placeholder="Username">
                        <input type="password" name="pass" placeholder="Password">
                        <input type="submit" name="login" value="Login">
                    </form>
            </div>
          </div>
        
    </body>
    
    
    
</html>