<?php
session_start() ;

include('ligar_bd.php');

    if(isset($_SESSION['user']['name'])){
        
        $name = $_SESSION['user']['name'];
    }

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $location = $_POST['location'];
    $name_activity = $_POST['name'];

    $location = htmlspecialchars($location, ENT_QUOTES, 'UTF-8');
    $name_activity = htmlspecialchars($name_activity, ENT_QUOTES, 'UTF-8');

  
        $sql = $db->prepare("SELECT * from activity where title = :title or location= :location");   
        
        $sql->bindParam(':title', $name_activity);
        $sql->bindParam(':location', $location);
        
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $count = $sql->rowCount();
        
        if ($count > 0){
            
            session_destroy();
            session_start();
            $_SESSION['search'] = $row;
            header('location:results.php');
            
        }else {
            echo "erro";
        }
        
    
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/Grid.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
        <link href="https://unpkg.com/ionicons@4.4.6/dist/css/ionicons.min.css" rel="stylesheet">
        <title>Adventure</title> 
    </head>
    


    <body>
        
        <!-----------HEADER-------------------->
        <header>
            <nav>
            <div class="row">   
                <ul class="main-nav">
                <li><a href="all_activities.php">Activities</a></li>
                <?php if(isset($_SESSION['user']['name']))
                {
                    echo '<li><a href=""> welcome '.$name.'!</a></li>';
                }
                ?>
                </ul>
            </div> 
            </nav>
            <div class="hero-text-box">
                <h1>Live an <b>amazing</b> Adventure!</h1>
            
            <form method="POST">
            
                <select name ="location" class="local">

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
            
                <input type="text" class="search-bar" placeholder="Search.." name="name">  
            </form>
                
                <a class="btn btn-full" href="register.php">Registar</a>
                <?php if(!isset($_SESSION['user'])){
                    echo '<a class="btn btn-ghost" href="login.php">Login</a>';
                }
                else{
                     echo '<a class="btn btn-ghost" href="logout.php">Logout</a>';
                }
                ?>
               
            </div>
        </header>

        
    </body>
    
    
    
</html>