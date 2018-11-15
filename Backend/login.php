<?php
//incluir o ficheiro onde contem a ligação
include('../ligar_bd.php');
//se houver um pedido de resposta do formulario(isto ta defenido no input submit, o submit faz um pedido ao servidor, que tem como nome "login")
If(isset($_POST['login'])){

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    //cross-site scripint protection
    $user = htmlspecialchars($user, ENT_QUOTES, 'UTF-8');
    
    $pass = htmlspecialchars($pass, ENT_QUOTES, 'UTF-8');
    //mysql injection protection
    $hashed_password = crypt($pass,"123");

    $sql = $db->prepare("SELECT * from Administrator where username = :username and password= :password");    
    $sql->bindParam(':username', $user);
    $sql->bindParam(':password', $hashed_password);

    $sql->execute();
    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

    $count = $sql->rowCount();
    
    if ($count > 0){
      
        session_start();
        $_SESSION['admin'] = $row[0];
        header('location:index.php');

    } else {
        echo "<script type='text/javascript'>alert('Error wrong credencials')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Account Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>

  <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Admin</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center"> Admin Area <small>Account Login</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
                    <form action="" method="POST"> 
                        <input type="username" name="user" placeholder="Username">
                        <input type="password" name="pass" placeholder="Password">
                        <input type="submit" name="login" value="Login">
                    </form>
          </div>
        </div>
      </div>
    </section>


 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
