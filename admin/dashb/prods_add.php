<?php 
include '../DBconnect2.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add product</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="./css/style.min.css">
</head>
<style>
.main{
            width:70%;
            padding:30px;
            box-shadow: 1px 1px 10px orange;
            margin-top:60px;
            margin: 0 auto; 
         
        }</style>
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
      <center>   <h2 class="main-title">Add product</h2>
      
  <div class="main">
 <form   method="POST" enctype="multipart/form-data" >
 <div class="form-group">
    name <input  type="text" name="name" placeholder="name"/>
</div>
<div class="form-group">
    about the product <input type="text" name="about"/>
</div>
<div class="form-group">
    price <input type="text" name="price"/>
</div>
<div class="form-group">
    quantity <input type="text" name="quantity"/>
</div>
<div class="form-group">
    photo of product <input type="file" name="image"/> 
</div>
<div class="form-group">
    Type of product <select  name="type">
      
  <option value="shavemachine">Shave machine</option>
  <option value="spray">spray</option>
  <option value="gel">Gel</option>
  <option value="brush">Brush</option>
</select>
</div>
 <br>
 <div class="form-group">
    <input type="submit" name="addp" class="btn btn-warning rounded-pill" value="add product"/>

</div>
</div>
      </center>
</form>

</body>
 

      
      
            
         
     
          </div>
        </div>
      </div>
    </main>
    <!-- ! Footer -->
 
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
<style>
        
     

        </style>
<body>
<?php
if (isset($_POST['addp'])) {
  $name = $_POST['name'];
  $about = $_POST['about'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $image = $_FILES['image'];
  $type = $_POST['type'];

  // Get the original image name
  $imagename = $image['name'];

  // Add the "./images/" prefix to the image name
  $imagename = "./images/" . $imagename;

  $insert = "INSERT INTO products (name,about,price,quantity,image,category) VALUES('$name','$about','$price','$quantity','$imagename','$type')";
  $data = mysqli_query($con, $insert);
  if ($data) {
      echo '<script>alert("Product added successfully");</script>';
  }
}
  ?>  
