<?php 
include '../DBconnect2.php';
 session_start();
$email= $_SESSION['email'];
$current_Date = date('d/m/y');
 
 
 $earningsforToday = "SELECT * FROM history_of_orders WHERE date_order='$current_Date'";
 $res_earningsforToday = mysqli_query($con,$earningsforToday);
 $sum = 0;  
 
 while ($row = mysqli_fetch_assoc($res_earningsforToday)) {
     $sum +=$row['price']*$row['quantity'];
 }
 
$last10Orders = "SELECT * FROM history_of_orders ORDER BY date_order DESC LIMIT 10 ";
$res_last10Orders = mysqli_query($con, $last10Orders);

function printUserName($x, $con) { // function that return the user name from the id thats gets from history_of_odres id_user
  $name = "SELECT * FROM userss WHERE ID_u='$x'";
  $res_name = mysqli_query($con, $name);
  $username = mysqli_fetch_assoc($res_name);
  return $username['name'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
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
        <h2 class="main-title">Dashboard</h2>
        <div class="row stat-cards">
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon primary">
                <i data-feather="users" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <?php   $users="SELECT * FROM userss";
                $resusers=mysqli_query($con,$users);
                $numusers=mysqli_num_rows($resusers);
                ?>
                <p class="stat-cards-info__num"><?php  echo $numusers  ?></p>
                <p class="stat-cards-info__title">Total users</p>
                <p class="stat-cards-info__progress">
               
                </p>
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon warning">
                <i data-feather="file" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <?php  
                date_default_timezone_set("Asia/Jerusalem");
                $currentDate = date('Y-m-d');
                $currentTime=date("H");
            
                $apointments="SELECT * FROM history_of_queues WHERE date='$currentDate' AND time ='$currentTime' ";
                $resapointments=mysqli_query($con,$apointments);
                $numapointments=mysqli_num_rows($resapointments);
                ?>
                <p class="stat-cards-info__num"><?php echo $numapointments  ?></p>
                <p class="stat-cards-info__title">Active apointments </p>
                <p class="stat-cards-info__progress">
                  
                </p>
              </div>
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
              <div class="stat-cards-icon purple">
              <i class = "material-icons">wallet</i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num"><?php 

                echo $sum  ?>$</p>
                <p class="stat-cards-info__title"> Earnings for today</p>
               
            </article>
          </div>
          <div class="col-md-6 col-xl-3">
          <article class="white-block">
              <div class="top-cat-title">
                <h3>Todo list</h3>
                <?php $tasks="SELECT * FROM task WHERE date ='$currentDate'";
                $restasks=mysqli_query($con,$tasks);

                ?>
                <p>  You have todo today <?php  echo mysqli_num_rows($restasks); ?> tasks  </p>
              </div>
              <ul class="top-cat-list">
                <?php  while($row=mysqli_fetch_array($restasks)){  ?>
                <li>
                  <a href="##">
                    <div class="top-cat-list__title">
                      <?php echo $row['name'] ?>
                    </div>
                    <div class="top-cat-list__subtitle">
                      <?php  echo $row['details']  ?>
                    </div>
                  </a>
                </li>
            <?php  }?>
               
              </ul>
            </article>
          </div>
        <div class="row">
          <div class="col-lg-9">
          <h1> Last 10 recent orders</h1>
            <div class="users-table table-wrapper">
              <table class="posts-table">
                <thead>
                  <tr class="users-table-info">
                 
                    <th>Name</th>
                    <th>product</th>
                    <th>Quantity</th>
                    <th>Date</th>
                 
                  </tr>
                </thead>
                <tbody>
                  <?php while ($order = mysqli_fetch_assoc($res_last10Orders)) { ?>
                  <tr>
                    <td>
                      <?php 
                      $username = printUserName($order['id_user'], $con);
                      echo $username; ?>
                    </td>
                    <td>
                    <p class=" ">  <?php  echo $order['name'] ?></p>  
                    </td>
                    <td>
                     <?php echo $order['quantity'] ?>
                    </td>
                   
                    <td>
                        <?php  echo $order['date_order'] ?>
                    </td>
                    <?php  }?>
                  </tr>
                  <tr>                                   
                    </td>               
                  </tr>
                  <tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-lg-3">
              <!--              <p class="customers__title">New Customers <span>+958</span></p>
              <p class="customers__date">28 Daily Avg.</p>
              <picture><source srcset="./img/svg/customers.svg" type="image/webp"><img src="./img/svg/customers.svg" alt=""></picture> -->
           
          </div>
        </div>
      </div>
    </main>
    <!-- ! Footer -->
    <footer class="footer">
  
  </div>
</footer>
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
 
</head>

<body>
   
</body>

</html>
