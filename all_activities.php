<?php

include('ligar_bd.php');


session_start();

 $no_session ="";


  $id_activity = $_GET['id'];
  $sql = $db->prepare(" SELECT * FROM 'activity');
  $sql->execute();
  $row = $sql->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/Grid.css">
        <link rel="stylesheet" type="text/css" href="css/all_activities.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
        <link href="https://unpkg.com/ionicons@4.4.6/dist/css/ionicons.min.css" rel="stylesheet">
        <title>Adventure | Activities</title> 
    </head>
    


    <body>
        
        <!-----------HEADER-------------------->
        <header>
            <nav>
            <div class="row">   
                <ul class="main-title">
                <li><h2>Activities</h2></li>
                </ul>
            </div> 
            </nav>
        </header>
        

        <!-------------SECTION LIST-------------->
 <section class="section-list" id="list">

            
        
        <div class="row">

        
        <?php
        
        foreach ($row as $value){

            
            echo '

           

            <div class="col span-1-of-4 box">

            <a href="activity.php?activity&id='.$value['idActivity'].'"> <img src="images/'.$value['image'].'"></a>

                <!---Detalhe 1 --->
            <div class="feature">   
                <h3><b>'.$value['title'].'</b></h3> 
                Location : '.$value['location'].'

            </div> 
                 <!----Detalhe 3--->
                <div class="feature">   
                <button class="btn-reserve" href="checkout.php">Reservar</button>
            </div>     
            </div>
            
            ';
            
        }
        
        
        
        ?>
        
        
</section> 


        
        <!---SECTION 8 FOOTER--->
    <footer>
    
    </footer>
        
    </body>