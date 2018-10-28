<?php
//incluir o ficheiro onde contem a ligação
include('ligar_bd.php');
//se houver um pedido de resposta do formulario(isto ta defenido no input submit, o submit faz um pedido ao servidor, que tem como nome "register")
if($_POST['register'])
{
    //guardamos os valores enviados atraves do input e guardamos em variaves, isto defenimos no "name" do input

    $user = $_POST['user'];
    
    $name = $_POST['name'];
    
    $pass = $_POST['repeatpass'];

    //faz um hash da password
    $hashed_pass = crypt($pass,"123");
    
    //cross-site scripting protection
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

    //preparamos a query que vai ser enviada para a base de dados, onde vai fazer o registo
    $sql = $db->prepare(" INSERT INTO `user` (`name`,`username`,`password`) VALUES (:name,:user,:pass)");
    
    //fazemos um "bind" nos parametros:name,user,pass que é onde vai ser enviado a informação, isto para evitar mysql injection
    $sql->bindParam(':name', $name);
    $sql->bindParam(':user', $user);
    $sql->bindParam(':pass', $hashed_pass);

    //faz execute da query que preparamos anteriormente 
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