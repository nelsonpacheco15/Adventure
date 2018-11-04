<?php

include('ligar_bd.php');

session_start();

    echo $_SESSION['search'][0];


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
        <title>Adventure</title> 
    </head>
    


    <body>
        
        <!-----------HEADER-------------------->
        <header>
            <nav>
            <div class="row">   
                <ul class="main-title">
                <li><h2>Search Results...</h2></li>
                </ul>
            </div> 
            </nav>
        </header>





        
        <!-------------SECTION LIST-------------->
 <section class="section-list" id="list">
            
        
        <div class="row">
            <!---Coluna 1 --->
            <div class="col span-1-of-4 box">
            
            <img href="activity.php" src="img/diving.jpg" alt="Diving">

                <!---Detalhe 1 --->
            <div class="feature">   
                <h3><b>Diving</b></h3> 
                <p>LOrem ipsum sit dolor amt romagnoli torino sasuolo caborini</p>
            </div> 
                 <!----Detalhe 3--->
                <div class="feature">   
                <button class="btn-reserve" href="checkout.php">Reservar</button>
            </div>     
            </div>


            <!---Coluna 2 --->
            <div class="col span-1-of-4 box">
                    <img href="activity.php" src="img/bird.jpg" alt="Birdwatching">
        
                        <!---Detalhe 1 --->
                    <div class="feature">   
                        <h3><b>BirdWatching</b></h3> 
                        <p>LOrem ipsum sit dolor amt romagnoli torino sasuolo caborini</p>
                    </div> 
                         <!----Detalhe 3--->
                        <div class="feature">   
                        <button class="btn-reserve" href="checkout.php">Reservar</button>
                    </div>     
                    </div>



                    <!---Coluna 3 --->
            <div class="col span-1-of-4 box">
                    <img href="activity.php" src="img/paddle.jpg" alt="Paddle">
        
                        <!---Detalhe 1 --->
                    <div class="feature">   
                        <h3><b>Paddle</b></h3> 
                        <p>LOrem ipsum sit dolor amt romagnoli torino sasuolo caborini</p>
                    </div> 
                         <!----Detalhe 3--->
                        <div class="feature">   
                                <button class="btn-reserve" href="checkout.php">Reservar</button>
                    </div>     
                    </div>
        
        
                             <!---Coluna 4--->
            <div class="col span-1-of-4 box">
                    <img href="activity.php" src="img/bi.jpg" alt="Bycicle">
        
                        <!---Detalhe 1 --->
                    <div class="feature">   
                        <h3><b>Bicycle rides</b></h3> 
                        <p>LOrem ipsum sit dolor amt romagnoli torino sasuolo caborini</p>
                    </div> 
                         <!----Detalhe 3--->
                        <div class="feature">   
                        <button class="btn-reserve" href="checkout.php">Reservar</button>
                    </div>     
                    </div>  
                        
                        

                                               
                                
                                
                        


                    

        
    </section> 


        
        <!---SECTION 8 FOOTER--->
    <footer>
    
        </footer>
        
    </body>