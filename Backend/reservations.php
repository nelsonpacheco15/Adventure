<?php
session_start() ;

if(isset($_SESSION['admin'])==null){

  header('location:login.php');
}

$name = $_SESSION['admin']['username'];

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
            <li><a href="login.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Reservations<small>Manage Reservations</small></h1>
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
                <div class="row">
                      <div class="col-md-12">
                          <input class="form-control" type="text" placeholder="Filter Reservations...">
                      </div>
                </div>
                <br>
                <table class="table table-striped table-hover">
                      <tr>
                        <th>Activity</th>
                        <th>User</th>
                        <th>Date</th>
                        <th></th>
                      </tr>
                      <tr>
                        <td>BirdWatching</td>
                        <td>Vasco Oliveira</td>
                        <td>Dec 12, 2016</td>
                        <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                      </tr>
                      <tr>
                        <td>Canoying</td>
                        <td>Miguel PImentel</td>
                        <td>Dec 12, 2016</td>
                        <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                      </tr>
                      <tr>
                        <td>Stand Up Paddle</td>
                        <td>John Doe</td>
                        <td>Dec 12, 2016</td>
                        <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                      </tr>
                      <tr>
                        <td>ATV</td>
                        <td>Nelson Pacheco</td>
                        <td>Dec 12, 2016</td>
                        <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                      </tr>
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
