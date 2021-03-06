<?php
//incluir o ficheiro onde contem a ligação
include('ligar_bd.php');
//se houver um pedido de resposta do formulario(isto ta defenido no input submit, o submit faz um pedido ao servidor, que tem como nome "register")

$err_username = $err_password_length = $erro_pass = $success = "";

if(isset($_POST['register']))
{
    //guardamos os valores enviados atraves do input e guardamos em variaves, isto defenimos no "name" do input

    $user = $_POST['user'];
    $name = $_POST['name'];

    //verificar se existe um utilizador com este username

    $sql = $db->prepare("SELECT * from User where username = :username");
    
    $sql->bindParam(':username', $user);

    //faz execute da query que preparamos anteriormente 
    $sql->execute();    


    $count = $sql->rowCount();

        if ($count > 0) {

            $user=null;
            $err_username = "Already exists a User !";
        }

    //verifica se a pass tem mais do que 8 caracteres
    if (strlen($_POST['pass']) < 8 || strlen($_POST['repeatpass']) <8 )
    {
        $err_password_length = 'The password needs a minimum of 8 characters';
        $_POST['pass'] = null;
        $_POST['repeatpass'] = null;
        
    }
    //verifica se a pass é igual ao repeatpass
    if($_POST['pass'] == $_POST['repeatpass']){

         $pass = $_POST['pass'];
         
    }
    else{
          $erro_pass = "The password has to be the same ! ";  
    }

    //faz um hash da password e verifica que so faz isso se a pass não estiver como null
    if($pass !=null){
        $hashed_password = crypt($pass,"123");
    }
    
    //cross-site scripting protection e verifica que so faz isso se o user não estiver como null
    if($user != null){
        $user = htmlspecialchars($user, ENT_QUOTES, 'UTF-8');
    }
    
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    
    //preparamos a query que vai ser enviada para a base de dados, onde vai fazer o registo
    $sql = $db->prepare(" INSERT INTO `User` (`name`,`username`,`password`) VALUES (:name,:user,:pass)");
    
    //fazemos um "bind" nos parametros:name,user,pass que é onde vai ser enviado a informação, isto para evitar mysql injection
    $sql->bindParam(':name', $name);
    $sql->bindParam(':user', $user);
    $sql->bindParam(':pass', $hashed_password);

    //faz execute da query que preparamos anteriormente 
    $sql->execute();

    $count = $sql->rowCount();

        if ($count > 0) {
            $success = "Registered !";
        }
        else{
            $error_register ="Error !";
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
        <title>Adventure | Register</title> 
    </head>
    


    <body>
        <div class="split left">
            <div class="centered">
              <img src="img/waterfall.jpg">
            </div>
          </div>
          
          <div class="split right">
            <div class="centered">
              <h2>Welcome!</h2>
              <h3>We are happy to see you joining</h3>
                    <form action="" method="POST"> 
                        <input type="username" name="user" placeholder="Username">
                        <?php echo $err_username ?>
                        <input type="text" name="name" placeholder="Name">
                        <input type="password" name="pass" placeholder="Password">
                        <input type="password" name="repeatpass" placeholder="Repeat Password">
                        <?php echo $erro_pass; ?>
                        <?php echo $err_password_length; ?>
                        <input type="submit" name="register" value="Register">
                        <?php echo $success; ?>
                        <?php echo $error_register ?>
                    </form>
            </div>
          </div>
        
    </body>
    
    
    
</html>