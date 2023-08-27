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
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
        <h2 class="main-title">Add new task</h2>
        <form  method="post">
        <label>Name of task <input type="text" name="name" id="" placeholder="Name of task" required></label><br>
                        <label>Details about task <input type="text" name="details"  placeholder="details of task" id="" required></label><br>
                        <label for="date">Date of task</label>
                        <input  type="date" name="date" id="date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">

                        <input type="submit" name="add" value="Add task">

        

        </form>
        <?php
if (isset($_POST['add'])) {
 $nameOfTask=$_POST['name'];
 $detailsAboutTask=$_POST['details'];
 $date=$_POST['date'];
    $addTask = "INSERT INTO task (name, details, date) VALUES ('$nameOfTask', '$detailsAboutTask', '$date')";
   $addRes = mysqli_query($con, $addTask);
    if ($addRes) {
     ?>
   <div class="w3-panel w3-green">
  <h3 style="color:white" >Success!</h3>
  <p>Task added succesfully</p>
</div>
     <?php
    }
    else
    echo 'error to add the task';   
}
 
?>
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

<body>
    
</body>

</html>
