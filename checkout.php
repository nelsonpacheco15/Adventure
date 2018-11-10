<?php

include('ligar_bd.php');

session_start();

 if(isset($_POST['reserve'])){

   if(isset($_SESSION['user'])){


    $id_activity = $_GET['id'];
    #var_dump($id_activity);
    $user_id = $_SESSION['user']['idUser'];
    $cardnumber = $_POST['cardnumber'];
    #var_dump($cardnumber);
    $cardholdername = $_POST['cardholdername'];
    #var_dump($cardholdername);
    $expirydate = $_POST['expirydate'];
   # var_dump($expirydate);
    $securitynumber = $_POST['securitynumber'];
   # var_dump($securitynumber);
    $state = 'standby';
    #var_dump($state);

    $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
    $iv = openssl_random_pseudo_bytes($ivlen);

    $cardnumber = openssl_encrypt($cardnumber, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $cardnumber, $key, $as_binary=true);
    $cardnumber = base64_encode( $iv.$hmac.$cardnumber );

    var_dump($cardnumber);

    var_dump($cardholdername);

    $securitynumber = openssl_encrypt($securitynumber, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $securitynumber, $key, $as_binary=true);
    $securitynumber = base64_encode( $iv.$hmac.$securitynumber );

    var_dump($securitynumber);

    $expirydate = openssl_encrypt($expirydate, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $expirydate, $key, $as_binary=true);
    $expirydate = base64_encode( $iv.$hmac.$expirydate );

    var_dump($expirydate);
    

    $expirydate = htmlspecialchars($expirydate, ENT_QUOTES, 'UTF-8');
    $cardholdername = htmlspecialchars($cardholdername, ENT_QUOTES, 'UTF-8');
    $cardnumber = htmlspecialchars($cardnumber, ENT_QUOTES, 'UTF-8');
    $securitynumber = htmlspecialchars($securitynumber, ENT_QUOTES, 'UTF-8');  
    

    $sql = $db->prepare(" INSERT INTO `CreditCard` (`cardNumber`,`cardHolderName`,`expiryDate`,`securityNumber`)
    VALUES (:cardNumber,:cardHolderName,:expiryDate,:securityNumber)");

      $sql->bindParam(':cardNumber', $cardnumber);
      $sql->bindParam(':cardHolderName', $cardholdername);
      $sql->bindParam(':expiryDate', $expirydate);
      $sql->bindParam(':securityNumber', $securitynumber);

      $sql->execute();
      
     /* $count = $sql->rowCount();

            if ($count > 0){
              $success = "success";
              echo $success;
            }
            else{
              $error = "error";
              var_dump($error);
            }

      */

      $sql = $db->prepare(" INSERT INTO `Reservation` (`idUser`, `idActivity`,`cardNumber`,`state`)
      VALUES (:idUser,:idActivity,:cardNumber,:state)");

      $sql->bindParam(':idUser', $user_id);
      $sql->bindParam(':idActivity', $id_activity);
      $sql->bindParam(':cardNumber', $cardnumber);
      $sql->bindParam(':state', $state);
          
      $sql->execute();
     
  }

 }


?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  

        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">

      <link rel="stylesheet" href="css/checkout.css">

  
</head>

<body>

  <div class='container'>
  <form class='modal' method="POST">
    <header class='header'>
      <div class='card-type'>
        <a class='card' href='#'>
          <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/Amex.png'>
        </a>
        <a class='card' href='#'>
          <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/Discover.png'>
        </a>
        <a class='card active' href='#'>
          <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/Visa.png'>
        </a>
        <a class='card' href='#'>
          <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/MC.png'>
        </a>
      </div>
    </header>
    <div class='content'>
      <div class='form'>
        <div class='form-row'>
          <div class='input-group'>
            <label for=''>Name on card</label>
            <input name="cardholdername" placeholder='' type='text'>
          </div>
        </div>
        <div class='form-row'>
          <div class='input-group'>
            <label for=''>Card Number</label>
            <input name="cardnumber" maxlength='16' placeholder='' type='number'>
          </div>
        </div>
        <div class='form-row'>
          <div class='input-group'>
            <label for=''>Expiry Date</label>
            <input name="expirydate" placeholder='' type='month'>
          </div>
          <div class='input-group'>
            <label for=''>CVS</label>
            <input name="securitynumber" maxlenght='3' placeholder='' type='number'>
          </div>
        </div>
      </div>
    </div>
    <footer class='footer'>
      <input type="submit" name="reserve" value="Complete Payment" class='button'>
    </footer>
  </form>
</div>






</body>

</html>