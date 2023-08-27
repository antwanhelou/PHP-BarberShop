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
       <center> <h2 class="main-title">Products Analys</h2>
    <?php
       $sql = "SELECT * FROM products";
    $result = mysqli_query($con, $sql);
    $productname = array();
    $quantity = array();
    while ($row = mysqli_fetch_array($result)) {
        $productname[] = $row['name'];
        $selled[] = $row['selled'];
    }
 
error_reporting(E_ALL);
ini_set('display_errors', 1);   
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
    <div style="width:60%;hieght:20%;text-align:center">
        <h2 class="page-header">Product Sales Reports</h2>
        <p style="align:center;"><canvas id="chartjs_bar"></canvas></p>
    </div>
    <script type="text/javascript">
        var productname = <?php echo json_encode($productname); ?>;
        var quantity = <?php echo json_encode($selled); ?>;
        
        var ctx = document.getElementById("chartjs_bar").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: productname,
                datasets: [{
                    backgroundColor: [
                        "#5969aa",
                        "#ff407b",
                        "#331523",
                        "#ffc750"
                    ],
                    data: quantity,
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        fontColor: '#71748d',
                        fontFamily: 'Circular Std Book',
                        fontSize: 14,
                    }
                }
            }
        });
    </script>
</body>

</html>

      </center>
      
            
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
 
 
