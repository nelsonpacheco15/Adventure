<?php

include('ligar_bd.php');


session_start();

$no_result = "";

    if($_SESSION['search']==null){

        $no_result = "No Results found";
        
    }

    $row = $_SESSION['search'];


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/Grid.css">
        <link rel="stylesheet" type="text/css" href="css/results.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
        <link href="https://unpkg.com/ionicons@4.4.6/dist/css/ionicons.min.css" rel="stylesheet">
        <title>Adventure | Results</title> 
    </head>
    


    <body>
        
        <!-----------HEADER-------------------->
        <a href="index.php"> <header>
            <nav>
            <div class="row">   
                <ul class="main-title">
                <li><h2>Search Results...</h2></li>
                </ul>
            </div> 
            </nav>
        </header></a>
        

        <!-------------SECTION LIST-------------->
 <section class="section-list" id="list">

            
        
        <div class="row">

        <div class="no_result"><?php echo $no_result ?></div>
        
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
                <a href="checkout.php?Activity&id='.$value['idActivity'].'"><button class="btn-reserve" > Reserve </button></a>
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