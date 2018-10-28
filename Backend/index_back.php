
<head>
  <link rel="stylesheet" type="text/css" href="CSS/style.css">
  <link href="https://unpkg.com/ionicons@4.4.6/dist/css/ionicons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
</head>



<div class="admin-panel clearfix">
  <div class="slidebar">
    <div class="logo">
      <a href=""></a>
    </div>
    <ul>
      <li><a href="#dashboard" id="targeted">dashboard</a></li>
      <li><a href="#posts">Activities</a></li>
    </ul>
  </div>
  <div class="main">
    <ul class="topbar clearfix">
      <li><a href="#">q</a></li>
      <li><a href="#">p</a></li>
      <li><a href="#">o</a></li>
      <li><a href="#">f</a></li>
      <li><a href="#">n</a></li>
    </ul>
    <div class="mainContent clearfix">
      <div id="dashboard">
        <h2 class="header"><span class="icon"></span>Dashboard</h2>
          <div class="monitor">
            <h4>Right Now</h4>
            <div class="clearfix">
              <ul class="content">
                <li>content</li>
                <li class="posts"><span class="count">179</span><a href="">posts</a></li>
                <li class="pages"><span class="count">13</span><a href="">pages</a></li>
                <li class="categories"><span class="count">21</span><a href="">categories</a></li>
                <li class="tags"><span class="count">305</span><a href="">tags</a></li>
              </ul>
              <ul class="discussions">
                <li>discussions</li>
                <li class="comments"><span class="count">353</span><a href="">comments</a></li>
                <li class="approved"><span class="count">319</span><a href="">approved</a></li>
                <li class="pending"><span class="count">0</span><a href="">pending</a></li>
                <li class="spam"><span class="count">34</span><a href="">spam</a></li>
             </ul>
           </div>
           <p>Theme <a href="">Twenty Eleven</a> with <a href="">3 widgets</a></p>
         </div>
         <div class="quick-press">
           <h4>Quick Press</h4>
           <form action="" method="post">
             <input type="text" name="title" placeholder="Title"/>
             <input type="text" name="content" placeholder="Content"/>
             <input type="text" name="tags" placeholder="Tags"/>
             <button type="button" class="save">l</button>
             <button type="button" class="delet">m</button>
             <button type="submit" class="submit" name="submit">Publish</button>
           </form>
         </div>
       </div>
       <div id="posts">
         <h2 class="header">Activities</h2>

         <div class="activity">
          <a href="#create"><button class="btn-add">Add Activity</button></a>



          <div class="container">
            <div class="content">
              <p>Mergulho </p>
              <a href="#edit"><button class="btn-edit"><i class="icon ion-ios-build"></i></button></a>
              <a href="#"><button class="btn-remove"><i class="icon ion-ios-close"></i></button></a>
</div>
          </div>

         </div>
       </div>



       <div id="create">
         <h2 class="header">Add Activity</h2>
         <form class="add" action="#" method="POST"> 
            <input type="text" name="name" placeholder="Activity name...">
            <input type="date" name="date" placeholder="Date">
            <input type="textarea" name="description" placeholder="Description..">
            <input type="submit" name="submit" value="Submit">
        </form>


       </div>
       <div id="edit">
         <h2 class="header">Edit Activity</h2>
         <form class="add" action="#" method="POST"> 
            <input type="text" name="name" placeholder="Activity name...">
            <input type="date" name="date" placeholder="Date">
            <input type="textarea" name="description" placeholder="Description..">
            <input type="submit" name="submit" value="Submit">
        </form>
       </div>
       
     </div>
     <ul class="statusbar">
       <li><a href=""></a></li>
       <li><a href=""></a></li>
       <li class="profiles-setting"><a href="">s</a></li>
       <li class="logout"><a href="">k</a></li>
     </ul>
   </div>
</div>