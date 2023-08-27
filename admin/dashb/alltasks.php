<?php 
include '../DBconnect2.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
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
        <h2 class="main-title">All tasks</h2>
        
        <table class="table">
  <thead class="thead-dark">
    <tr>
    
      <th scope="col">ID of task</th>
      <th scope="col">Name of task</th>
      <th scope="col">Details about task</th>
      <th scope="col">Date of task</th>
    </tr>
  </thead>
  <tbody>
  <?php   $allTasks="SELECT * FROM task";
        $res_Tasks=mysqli_query($con,$allTasks);
        $currentDate = date('Y-m-d');

        while($row=mysqli_fetch_assoc($res_Tasks)){
        ?>
    <tr>
        <?php  if ($currentDate==$row['date']){
            ?>
       <th scope="row">   <p style="color:green"> <?php  echo $row['ID_task']  ?>  </p> </th>
      <td> <p style="color:green"> <?php  echo $row['name'] ?>  </p> </td>
      <td> <p style="color:green"> <?php  echo $row['details'] ?> </p> </td>
      <td> <p style="color:green"> <?php  echo $row['date'] ?> </p></td>
            <?php 
        } else if($currentDate>$row['date']) { ?>
      <th scope="row">  <p style="color:red"> <?php  echo $row['ID_task']  ?></p></th>
      <td>  <p style="color:red"> <?php  echo $row['name'] ?> </p> </td>
      <td>   <p style="color:red"> <?php  echo $row['details'] ?> </p> </td>
      <td>  <p style="color:red"> <?php  echo $row['date'] ?> </p> </td>
    <?php }  else{
        ?>
           <th scope="row"> <p style="color:blue"> <?php  echo $row['ID_task']  ?></p></th>
      <td>  <p style="color:blue">  <?php  echo $row['name'] ?> </p></td>
      <td>  <p style="color:blue"> <?php  echo $row['details'] ?> </p> </td>
      <td>  <p style="color:blue"> <?php  echo $row['date'] ?> </p> </td>
        <?php
    }  ?>
    </tr>
    <?php 
}  ?>
   
  </tbody>
</table>
   
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
$con = mysqli_connect("localhost", "barshop", "root", "");
if (!$con) {
    echo "Problem in database connection! Contact administrator!" ;
} else {
    $sql = "SELECT * FROM history_of_orders";
    $result = mysqli_query($con, $sql);
    $productname = array();
    $quantity = array();
    while ($row = mysqli_fetch_array($result)) {
        $productname[] = $row['name'];
        $quantity[] = $row['quantity'];
    }
}
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

