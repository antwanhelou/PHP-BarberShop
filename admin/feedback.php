

<?php include 'index.php';
  include '../DBconnect.php';
  $show="SELECT * FROM contactus ";
  $result=mysqli_query($con,$show);
  ?>
 <CENTER> <br> <h1><span class="border border-secondary rounded-sm bg-warning ">
   Welcome to all feedbacks </span> </h1>
</CENTER>
  <form  method="POST">
   <div class="container py-5">
  <div class="row mt-4">
    

      <?php
      $i=0;
  while($row=mysqli_fetch_assoc($result)){
  
  echo '
  <div class="col-md-3">
  <div class="card-group">
    <div class="card h-100"">

  
    <div class="card-body">
    <p class="card-text">  Name : '. $row['name'] .'</p>
    <p class="card-text">  Email : '. $row['email'] .'</p>
     <p class="card-text">  Message : '. $row['message'].' </p>

    </div>
    </div>
  </div>
   </div>
  <br>

';

 
  
  } 
  ?>
  </form>
  <body>
  
</body>