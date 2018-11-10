<?php
//incluir o ficheiro onde contem a ligação
include('ligar_bd.php');
//se houver um pedido de resposta do formulario(isto ta defenido no input submit, o submit faz um pedido ao servidor, que tem como nome "login")
if(isset($_POST['login']))
{
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $hashed_password = crypt($pass,"123");

    $user = htmlspecialchars($user, ENT_QUOTES, 'UTF-8');

    $sql = $db->prepare("SELECT * from User where username = :username and password= :password");   

    $sql->bindParam(':username', $user);
    $sql->bindParam(':password', $hashed_password);

    $sql->execute();
    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

    $count = $sql->rowCount();

    if ($count > 0){

        session_start();
        $_SESSION['user'] = $row[0];
        header('location:index.php');
        
    }else {
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
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
        <title>Adventure | Login</title> 
    </head>
    


    <body>
        <div class="split left">
            <div class="centered">
              <img src="img/login.jpg">
            </div>
          </div>
          
          <div class="split right">
            <div class="centered">
              <h2>Welcome Back!</h2>
              <h3>We are happy to see you again!</h3>
                    <form action="" method="POST"> 
                        <input type="username" name="user" placeholder="Username">
                        <input type="password" name="pass" placeholder="Password">
                        <input type="submit" name="login" value="Login">
                        <p>Not a member? <a href="register.php">Try registering</a> </p>
                    </form>
            </div>
          </div>
        
    </body>
    
    
    
</html>