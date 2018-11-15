<?php
//inclui a BD
include('ligar_bd.php');

session_start();

 $no_session ="";

//id da atividade onde agarra atraves do URL
  $id_activity = $_GET['id'];

  $id_activity = htmlspecialchars($id_activity, ENT_QUOTES, 'UTF-8');
  // quero para mostrar toda a informação da atividade para depois estar predefenida no formulario
  //para puder mudar
  $sql = $db->prepare(" SELECT * FROM `Activity` where idActivity = :id ");

  $sql->bindParam(':id', $id_activity);

  $sql->execute();

  $row = $sql->fetchAll(PDO::FETCH_ASSOC);

      if(isset($_POST['commentary'])){

        if(isset($_SESSION['user'])){

          $id_activity = $_GET['id'];
          
          
          $user_id = $_SESSION['user']['idUser'];
      
          $comment = $_POST['comment'];
         
          $date = date('y-m-d');
          
        
            //Cross Site Scripting
            $user_id = htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8');
            $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
            $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
            $date = htmlspecialchars($date, ENT_QUOTES, 'UTF-8');
            

            $sql = $db->prepare(" INSERT INTO `Comment` (`idActivity`,`idUser`, `comment`,`date`)
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
        <title>Adventure</title> 
    </head>
    


    <body>
        
        <!-----------HEADER-------------------->
        <a href="index.php"><header>
            <nav>
            <div class="row">   
                <ul class="main-title">
                <li><h2><?php echo $row[0]['title'];?></h2></li>
                </ul>
            </div> 
            </nav>
        </header></a>





        
        <!-------------SECTION LIST-------------->
 
        
        <section class="section-post" id="post">
                

            <div class="row">
                <div class="col span-1-of-2 style="height: calc(100vh)>
                <div class="post-img">
                        <img src="img/hero.jpg">
                    </div>
            </div>


                <div class="col span-1-of-2 right-col">

                
                    <!-- Open The Modal -->
                    <?php
                        echo
                        '
                         <a href="checkout.php?Activity&id='.$row[0]['idActivity'].'"><button class="btn-reservation">Make Reservation</button></a>
                        ';
                    ?>


                    <div class="description">
                        <p><?php echo $row[0]['description'] ?></p></p>
                    </div>

                    <div class="social">
                        <h3>Share with your friends</h3>
                    <ul class="social-icons">
                        <li><a href="" class="social-icon"> <i class="fa fa-facebook"></i></a></li>
                        <li><a href="" class="social-icon"> <i class="fa fa-twitter"></i></a></li>
                        <li><a href="" class="social-icon"> <i class="fa fa-rss"></i></a></li>
                        <li><a href="" class="social-icon"> <i class="fa fa-linkedin"></i></a></li>
                        <li><a href="" class="social-icon"> <i class="fa fa-google-plus"></i></a></li>
                    </ul>
                    </div>    
                    

                
                    <!----COMMENTS-->
                    <ul class="comment-section">


                    <?php 
                    
                      //query para listar as atividades
                      $sql = $db->prepare(" SELECT * FROM `Comment` where `idActivity` = :idActivity ");

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
                                    <input class="btn-submit" type="submit" name="commentary" value="submit">
                                </div>
                                <?php echo $no_session ?>
                            </form>
            
                        </li>
                    </div>
                    </ul>
                    </div>
            
        </section>
        
        
        
        <!---SECTION 8 FOOTER--->
    <footer>
    
        
        </footer>
        
    </body>
    
    
</html>