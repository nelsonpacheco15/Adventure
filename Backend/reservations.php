<?php
session_start() ;

include('../ligar_bd.php');

if(!isset($_SESSION['admin'])){

  header('location:login.php');
}




$name = $_SESSION['admin']['name'];

$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Reservations</title>
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
            <li class="active"><a href="reservations.php">Reservations</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><?php echo $name ?></a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Reservations</h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li class="active">Reservations</li>
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
                <h3 class="panel-title">Reservations</h3>
              </div>
              <div class="panel-body">
                
                
                <table class="table table-striped table-hover">
                      <tr>
                        <th>IdReservation</th>
                        <th>idUser</th>
                        <th>idActivity</th>
                        <th>CardNumber</th>
                        <th>State</th>
                      </tr>

                      <?php
                      //faz a listagem das reservas

                      $sql = $db->prepare(" SELECT * FROM `Reservation` ");
                      $sql->execute();
            
                      $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                      //se for clicado no botao delay muda o estado da reserva
                      if (isset($_POST["delay"])) {
                        
                      $idreserva = $_POST['idreserva']; 

                      $sql = $db->prepare(" UPDATE Reservation SET state = :state WHERE idReservation = :idReserva ");
                        
                      $delay = "Delayed";
                        
                      $sql->bindParam(':idReserva', $idreserva);
                      $sql->bindParam(':state', $delay);

                      $sql->execute();

                      header("Refresh:0; url=reservations.php");

                    }
                     //se for clicado no botao approve muda o estado da reserva
                    if (isset($_POST["approve"])) {
                      
                      $idreserva = $_POST['idreserva'];

                      $sql = $db->prepare(" UPDATE Reservation SET state = :state WHERE idReservation = :idReserva");

                      $approve = "Approved";
                      
                      $sql->bindParam(':idReserva', $idreserva);
                      $sql->bindParam(':state', $approve);

                      $sql->execute();

                      header("Refresh:0; url=reservations.php");


                    }

                     //se for clicado no botao cancel muda o estado da reserva
                    if (isset($_POST["cancel"])) {

                      $idreserva = $_POST['idreserva'];
                      
                      $sql = $db->prepare(" UPDATE Reservation SET state = :state WHERE idReservation = :idReserva ");
                      
                      $cancel = "Rejected";
                      
                      $sql->bindParam(':idReserva', $idreserva);
                      $sql->bindParam(':state', $cancel);

                      $sql->execute();

                      header("Refresh:0; url=reservations.php");

                    }
                      
                      //para cada atividade uso o foreach para 
                      foreach( $row as $value){
                        
                        $key = "teste";
                        
                        $cardnumber = $value['cardNumber'];
                        $c = base64_decode($cardnumber);
                        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                        $iv = substr($c, 0, $ivlen);
                        $hmac = substr($c, $ivlen, $sha2len=32);
                        $ciphertext_raw = substr($c, $ivlen+$sha2len);
                        $newcardnumber = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
                        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
                        
                                              
                        echo'
                        <form action="" method ="POST">
                        <tr>
                        <td>'.$value['idReservation'].'</td>
                        <td>'.$value['idUser'].'</td>
                        <td>'.$value['idActivity'].'</td>
                        <td>'.$newcardnumber.'</td>
                        <td>'.$value['state'].'</td>
                        <td><input type="submit" class="btn btn-default" name="delay" value="Delay"> <input type="submit" class="btn btn-danger approve" name="approve" value="Aprove"> <input type="submit" class="btn btn-danger" name="cancel" value="Cancel"></td>
                        </tr>
                        <input  name="idreserva" type="hidden" value="'.$value['idReservation'].'">
                        </form>';
    

                          

                                              

                      }

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
      <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Activity</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Activity Title</label>
          <input type="text" class="form-control" placeholder="Activity Title">
        </div>
        <div class="form-group">
          <label>Activity Body</label>
          <textarea name="editor2" class="form-control" placeholder="Activity Body"></textarea>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox"> Published
          </label>
        </div>
        <div class="form-group">
          <label>Meta Tags</label>
          <input type="text" class="form-control" placeholder="Add Some Tags...">
        </div>
        <div class="form-group">
          <label>Meta Description</label>
          <input type="text" class="form-control" placeholder="Add Meta Description...">
        </div>
        <div class="form-group">
          <label>Date</label>
          <input type="date" class="form-control">
        </div>
        <div class="form-group">
          <label>Localization</label>
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
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
