<?php 
include '../DBconnect2.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elegant Dashboard | Dashboard</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="./css/style.min.css">
</head>

<body>
  <div class="layer"></div>
<!-- ! Body -->
<a class="skip-link sr-only" href="#skip-target">Skip to content</a>
<div class="page-flex">
  <?php include 'sidebar.php' ?>
  <div class="main-wrapper">
    <!-- ! Main nav -->
    <nav class="main-nav--bg">
  <div class="container main-nav">
    <div class="main-nav-start">
   
     
    </div>
   <?php include 'navbar.php';  ?>
    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
      <div class="container">
      <center>  <h2 class="main-title">Sold out products</h2></center>
        <?php
        $show="SELECT * FROM products WHERE quantity=0 ORDER BY category";
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
    <p class="card-text"> '. $row['about'] .'</p><br>   
     <p class="card-text"> '. $row['price'].'$ </p><br>';
     if($row['quantity']=0){
      echo'<strong><p style="color:red" > sold out </strong><br>'; 
     }
     echo '
     <button  class="btn btn-dark rounded-pill" type="submit" name="update" value='.$row['ID_p'].'>  Update</button>
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
  
   echo '<script> 
   var myWindow = window.open("update.php?", "", "width=750,height=450");
   window.focus();
</script>';     
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

      
      
            
          </div>
          <div class="col-lg-3">
            
          
            </article>
          </div>
        </div>
      </div>
    </main>

 
  </div>
</div>
<!-- Chart library -->
<script src="./plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="js/script.js"></script>
</body>

</html>
<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    
</body>

</html>

