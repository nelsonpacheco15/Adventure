<?php
//inclui BD
include('../ligar_bd.php');

session_start() ;


//verifica se existe sessão de admin senão volta para o login.php, isto para proteger quem quiser aceder
//ao ficheiro 
if(isset($_SESSION['admin'])==null){
  header('location:login.php');

}

// nome do admin so para mostrar que tem sessão iniciada na pagina
$name = $_SESSION['admin']['username'];

// se houver um post do formulario com o nome to input submit "activity" cria uma nova atividade
if(isset($_POST['activity']))
{

  //id do admin
  $id_admin = $_SESSION['admin']['idAdministrator'];
  
  //titulo da atividade
  $title = $_POST['title'];
  
  //descrição da atividade
  $description = $_POST['description'];
  
  //localização da atividade
  $location = $_POST['location'];

  $destFile = "../images/".$_FILES['image']['name'];
  move_uploaded_file( $_FILES['image']['tmp_name'], $destFile );

  $image = $_FILES['image']['name'];

    //query de inserção de uma atividade com parametros predefenidos
    $sql = $db->prepare(" INSERT INTO `activity` (`idAdministrator`,`title`, `description`,`location`,`image`)
    VALUES (:idAdmin,:title,:desc,:location,:image)");

    //bind dos parametros, isto para evitar mysql injection
    $sql->bindParam(':idAdmin', $id_admin);
    $sql->bindParam(':title', $title);
    $sql->bindParam(':desc', $description);
    $sql->bindParam(':location', $location);
    $sql->bindParam(':image', $image);

    //Executa a query que predefenimos
    $sql->execute();

    $count = $sql->rowCount();

    //verifica se houve uma nova linha adiçionada na tabela se sim quer dizer que ouve sucesso !
        if ($count > 0) {
            $success = "Registo feito !";
        }
        else{
          echo "erro";
        }

        

} 

if(isset($_POST['editing'])){

 header('location:edit.php');

}   
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Activities</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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
          <ul class="nav navbar-nav">
            <li><a href="index.php">Dashboard</a></li>
           <li class="active"><a href="activities.php">Activities</a></li>
            <li><a href="reservations.php">Reservations</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><?php echo $name ?></a></li>
            <li><a href="login.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Activities<small>Manage Activities</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li class="active">Activities</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="activities.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Activities <span class="badge">33</span></a>
              <a href="reservations.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Reservations <span class="badge">3</span></a>
            </div>


          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Activities</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                      <div class="col-md-12">
                          <input class="form-control" type="text" placeholder="Filter Activities...">
                           <div class="col-md-2">
                          <div class="dropdown create">

                            <button class="btn-activity btn-default dropdown-toggle" type="button"  data-toggle="modal" data-target="#addActivity" aria-haspopup="true" aria-expanded="true">
                              Add Activity
                            </button>

                          </div>
                        </div>  
                      </div>
                </div>
                <br>
                <table class="table table-striped table-hover">
                      <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Image</th>
                      </tr>

                      <?php
                      //query para listar as atividades
                      $sql = $db->prepare(" SELECT * FROM `activity` ");

                      $sql->execute();
            
                      $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                      
                      //para cada atividade uso o foreach para 
                      foreach( $row as $value){

                        
                        
                        echo'
                        <form action="" method ="GET">
                        <tr>
                        <td>'.$value['idActivity'].'</td>
                        <td>'.$value['title'].'</td>
                        <td>'.$value['description'].'</td>
                        <td>'.$value['location'].'</td>
                        <td>'.$value['image'].'</td>
                        <td><a class="btn btn-default"  href="edit.php?editing&id='.$value['idActivity'].'">Edit</a> <a class="btn btn-danger" href="delete.php?deleting&id='.$value['idActivity'].'">Delete</a></td>
                        </tr>
                        </form>';

                                              

                      }

                      //no botao editar quando foi clicado leva consigo no URL o Id da ativiade para que na pagina onde
                      //vai ser redirecionada é possivel pegarmos no ID e a partir dai fazemos uma query para a BD
                      //para ter toda a informação necessária da atividade cujo queromos editar
                      

                      ?>
                    </table>
              </div>
              </div>

          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
    </footer>

  <!-- Modals -->


 <!-- Add Activity -->
 <div class="modal fade" id="addActivity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action ="" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Activity Form</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Activity Title</label>
          <input type="text" name="title" class="form-control" placeholder="Activity Title">
        </div>
        <div class="form-group">
          <label>Activity Description</label>
          <textarea name="description" class="form-control" placeholder="Activity Body"></textarea>
        </div>
        <div class="form-group">
          <label>Activity Image</label>
          <input type="file" name="image" value="fileupload" id="fileupload"> 
          <label for="fileupload"> Select a file to upload</label> <br>
        </div>
        <div class="form-group">
          <label>Location</label>
           <select name ="location">
                <option selected value="SaoMiguel">S.Miguel</option>
                <option value="SantaMaria">Santa Maria</option>
                <option value="Terceira">Terceira</option>
                <option value="Pico">Pico</option>
                <option value="Faial">Faial</option>
                <option value="SaoJorge">S.Jorge</option>
                <option value="Graciosa">Graciosa</option>
                <option value="Flores">Flores</option>
                <option value="Corvo">Corvo</option>
           </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="activity" class="btn btn-primary" value="Add Activity">
      </div>Imagem
    </form>
    </div>
  </div>
</div>

<script>
  CKEDITOR.replace( 'editor1' );
  CKEDITOR.replace( 'editor2' );
</script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
