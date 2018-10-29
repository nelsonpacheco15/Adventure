<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Flat Payment Form</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/checkout.css">

  
</head>

<body>

  <div class='container'>
  <div class='info'>
    <span></span>
  </div>
  <form class='modal'>
    <header class='header'>
      <h1>Payment of €145.00</h1>
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
            <input placeholder='' type='text'>
          </div>
        </div>
        <div class='form-row'>
          <div class='input-group'>
            <label for=''>Card Number</label>
            <input maxlength='16' placeholder='' type='number'>
          </div>
        </div>
        <div class='form-row'>
          <div class='input-group'>
            <label for=''>Expiry Date</label>
            <input placeholder='' type='month'>
          </div>
          <div class='input-group'>
            <label for=''>CVS</label>
            <input maxlenght='4' placeholder='' type='number'>
          </div>
        </div>
      </div>
    </div>
    <footer class='footer'>
      <button class='button'>Complete Payment</button>
    </footer>
  </form>
</div>






</body>

</html>