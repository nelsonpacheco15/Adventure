<?php
//inclui a BD
include('ligar_bd.php');

session_start();

 $no_session ="";

//id da atividade onde agarra atraves do URL
  $id_activity = $_GET['id'];
  // quero para mostrar toda a informação da atividade para depois estar predefenida no formulario
  //para puder mudar
  $sql = $db->prepare(" SELECT * FROM `activity` where idActivity = :id ");

  $sql->bindParam(':id', $id_activity);

  $sql->execute();

  $row = $sql->fetchAll(PDO::FETCH_ASSOC);

      if(isset($_POST['commentary'])){

        if(isset($_SESSION['user'])){

          $id_activity = $_GET['id'];
          
          
          $user_id = $_SESSION['user']['idUser'];
         
          
          $comment = $_POST['comment'];
         
          
          $date = date('y-m-d');
        

            $sql = $db->prepare(" INSERT INTO `comment` (`idActivity`,`idUser`, `comment`,`date`)
            VALUES (:idActivity,:idUser,:comment,:date)");

            //bind dos parametros, isto para evitar mysql injection
            $sql->bindParam(':idActivity', $id_activity);
            $sql->bindParam(':idUser', $user_id);
            $sql->bindParam(':comment', $comment);
            $sql->bindParam(':date', $date);

            //Executa a query que predefenimos
            $sql->execute();

            $count = $sql->rowCount();

            if ($count > 0){

            $success = "Comment done";

            }else {
            
             $error_comment = "error on inserting comment";

             var_dump($error_comment);

            }

        }else{

            $no_session = "To make a comment you need to be logged in first";
           
        }

    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/Grid.css">
        <link rel="stylesheet" type="text/css" href="css/activity.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
        <title>Adventure</title> 
    </head>
    


    <body>
        
        <!-----------HEADER-------------------->
        <header>
            <nav>
            <div class="row">   
                <ul class="main-title">
                <li><h2><?php echo $row[0]['title'];?></h2></li>
                </ul>
            </div> 
            </nav>
        </header>





        
        <!-------------SECTION LIST-------------->
 
        
        <section class="section-post" id="post">
                <div class="post-img">
                        <img src="img/hero.jpg">
                    </div>
            <div class="row">
                <div class="col span-1-of-2">
                    <div class="description">
                        <p><?php echo $row[0]['description'] ?></p></p>
                    </div>
            </div>


                <div class="col span-1-of-2 right-col">
                    <!-- Open The Modal -->
                      <button class="btn-reservation" href="checkout.php">Make Reservation</button>


                    <!----COMMENTS-->
                    <ul class="comment-section">

                    <?php 
                    
                      //query para listar as atividades
                      $sql = $db->prepare(" SELECT * FROM `comment` where `idActivity` = :idActivity ");

                      $sql->bindParam(':idActivity', $id_activity);

                      $sql->execute();
            
                      $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                      
                      //para cada atividade uso o foreach para 
                      foreach( $row as $value){

                       $id_user = $value['idUser'];

                         $sql = $db->prepare(" SELECT username FROM `user` where `idUser` = :id ");

                         $sql->bindParam(':id', $id_user);

                         $sql->execute();
            
                         $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

                                                
                        echo
                        '
                        <li class="comment user-comment">
                        
                        <div class="info">
                        <a href="#">'.$dados[0]['username'].'</a>
                        <span>'.$value['date'].'</span>
                        </div>
                        
                        <a class="avatar" href="#">
                        <img src="img/avatar_author.jpg" width="35" alt="Profile Avatar" title="Cavaco Silva" />
                        </a>
                        
                        <p>'.$value['comment'].'</p>
                        
                        </li>
                        
                        ';
                      }
                        ?>
                        
                        
                        <li class="write-new">
                            
                            <form  method="POST">
                            
                                <textarea placeholder="Write your comment here" name="comment"></textarea>
            
                                <div>
                                    <input type="submit" name="commentary" value="submit">
                                </div>
                                <?php echo $no_session ?>
                            </form>
            
                        </li>
            
                    </ul>

                </div>


        </div>    
            
        </section>
        
        
        
        <!---SECTION 8 FOOTER--->
    <footer>
    
        
        </footer>
        
    </body>
    
    
</html>