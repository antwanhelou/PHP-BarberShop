<?php 
include '../DBconnect2.php';
session_start();
$email=$_SESSION['email'];
$admin="SELECT * FROM userss WHERE email='$email'";
$res_admin=mysqli_query($con,$admin);
$row=mysqli_fetch_assoc($res_admin);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My profile</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="./css/style.min.css">
</head>
<style>
img {
  border-radius: 50%;
}
.profile {

  inline-size: 30%;
  border-block-start-width: 10px;
  border-block-start-style: solid;
  border-block-start-color: orange;
    border-block-end-style: solid;
  border-block-end-width: 10px;
}
p {
  font-weight: 800;
}
</style>
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
       <center> <h2 class="main-title">My profile</h2>
        <div class="profile" >
        <table>  <tr><img src="<?php echo $row['photo'] ?>" alt="Paris" width="220" height="220"> </tr> <br><br>
            <tr> <p> Name :<?php echo $row['name'];?> </p> </tr>
            <tr> <p> Email :<?php echo $row['email'];?> </p> </tr>
        </table>
        </div>
       

      </center>
      
            
          </div>
          <div class="col-lg-3">
            
          
            </article>
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

