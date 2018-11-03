<?php

include('../ligar_bd.php');

session_start() ;

if(isset($_SESSION['admin'])==null){
  header('location:login.php');
}

  $id = $_GET['id'];

  $sql = $db->prepare(" SELECT * FROM `activity` where idActivity = :id ");

  $sql->bindParam(':id', $id);

  $sql->execute();

  $row = $sql->fetchAll(PDO::FETCH_ASSOC);

  if($_POST['edit']){

    $id = $_GET['id'];
    var_dump($id);
    $title = $_POST['title'];
    var_dump($title);
    $desc = $_POST['description'];
    var_dump($desc);
    $image=($_FILES["image"]["name"]);
    var_dump($image);
    $location = $_POST['location'];
    var_dump($location);
    

    $sql = $db->prepare(" UPDATE activity SET title = :title, description= :description, location= :location, image= :image where idActivity = :id ");

    $sql->bindParam(':title', $title);
    $sql->bindParam(':description', $desc);
    $sql->bindParam(':location', $location);
    $sql->bindParam(':image', $image);
    $sql->bindParam(':id', $id);

    $sql->execute();


    $count = $sql->rowCount();
    

    if ($count > 0){

      header('location:activities.php');

    }else {

        echo"erro";

    }

  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Edit Page</title>
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
            <li><a href="activities.php">Activities</a></li>
            <li><a href="reservations.php">Reservations</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome, Admin</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Edit Page<small>About</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li class="active">Edit Page</li>
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
                <h3 class="panel-title">Edit Page</h3>
              </div>
              <div class="panel-body">
               <form action ="" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Title Activity</label>
                    <input type="text" name="title" class="form-control" placeholder="Page Title" value="<?php echo $row[0]['title']?>">
                  </div>
                    <div class="form-group">
                    <label>Activity Description</label>
                    <textarea name="description" class="form-control" placeholder="Activity Body">
                    <?php echo $row[0]['description']?>
                    </textarea>
                  </div>
                  <div class="form-group">
                  <label>Activity Image</label>
                  <input type="file" name="image" value="<?php echo $row[0]['image']?> " id="fileupload">
                  <?php echo $row[0]['image']?> 
                  </div>
                   <div class="form-group">
                  <label>Location</label>
                  <select name ="location">
                        <option selected value="<?php echo $row[0]['location']?>"><?php echo $row[0]['location']?></option>
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
                  <input type="submit" name="edit" class="btn btn-default" value="Edit">
                </form>
              </div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
    </footer>

  <script>
     CKEDITOR.replace( 'editor1' );
     CKEDITOR.replace( 'editor2' );
 </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
