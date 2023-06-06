

<?php include 'index.php';
  include '../DBconnect.php';
  $show="SELECT * FROM products ORDER BY category";
  $result=mysqli_query($con,$show);
  ?> <form  method="GET">
   <div class="container py-5">
  <div class="row mt-4">

      <?php
  while($row=mysqli_fetch_assoc($result)){
    
  echo '
  <div class="col-md-3">
  <div class="card-group">
    <div class="card h-100"">

   <img src="../'. $row['image'] .' "/   width="200px"
    height="200px" alt="...">
    <div class="card-body">


    <h5 class="card-title">'. $row['name'].'  </h5>
    <p class="card-text"> '. $row['about'] .'</p>
     <p class="card-text"> '. $row['price'].'$ </p>';
     if($row['quantity']=0){
      echo'<strong><p style="color:red" > sold out </strong><br>'; 
     }
     echo '
     <button  class="btn btn-warning rounded-pill" type="submit" name="update" value='.$row['ID_p'].'>  Update</button>
     <button  class="btn btn-danger rounded-pill" type="submit" name="delete" value='.$row['ID_p'].'>  Delete</button>

    </div>
    </div>
  </div>
   </div>
  <br>

';

 
 
  } if(isset($_GET['update'])){
   
    $result=mysqli_query($con,$show);
    session_start();
   $_SESSION['update']= $_GET['update'];
  
    echo ' <script> var myWindow = window.open("update.php?", "", "width=750,height=450"); </script>';
     
 }
 if(isset($_GET['delete'])){
session_start();
  $_SESSION['delete']=$_GET['delete'];
   echo '  <script> var myWindow = window.open("delete.php?", "", "width=450,height=200"); </script>';
   
 }
  ?>
  </form>
  <body>
  
</body>