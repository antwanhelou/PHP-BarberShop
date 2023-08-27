<?php
include '../DBconnect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>shop</title>
    <!-- Add the required MDB CSS and JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.12.0/mdb.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
<!-- Add Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
 .nav {
            overflow: hidden;
            background-color: #333;
            position: fixed; /* Set the navbar to fixed position */
            top: 0; /* Position the navbar at the top of the page */
            width: 100%; /* Full width */
        }

        .navbar-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            overflow: hidden;
        }
        
        .navbar-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

    </style>

</head>
<body>
<?php
if (!isset($_SESSION['email'])) {
    header('location:../login.php');
    session_unset();
    session_destroy();
}

$iduser = $_SESSION['ID_u'];
$sumcart = "SELECT SUM(quantity) AS sum FROM addcart WHERE id_user=$iduser";
$sumres = mysqli_query($con, $sumcart);

while ($row2 = mysqli_fetch_assoc($sumres)) {
    if ($row2['sum'] == 0) {
        $sumincart = 0;
    } else {
        $sumincart = $row2['sum'];
    }
}
$resssult = mysqli_query($con, "SELECT count(*) as total from addcart WHERE id_user=$iduser");
$data1 = mysqli_fetch_assoc($resssult);

$name = mysqli_query($con, "SELECT name FROM Userss WHERE ID_u=$iduser");
$rows = mysqli_fetch_assoc($name);

$photo = mysqli_query($con, "SELECT photo FROM Userss WHERE ID_u=$iduser");
$rows5 = mysqli_fetch_assoc($photo);
$imagePath = $details['photo'];
echo '

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
       
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="Home.php">Welcome ' . $rows['name'] . '</a>
        </li>
        
        
       
     
        
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
    <div class="container-fluid">
    <ul class="navbar-nav">
      <!-- Avatar -->
     <a href="/labss2/user/Home.php"> <p style="font-size: 18px; padding-top: 8px; color:white;">Enter like user</p></a>
      <li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle d-flex align-items-center"
          href="#"
          id="navbarDropdownMenuLink"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <img 
          src="'.$rows5['photo'].'"
          
            class="rounded-circle"
            height="25"
           
            loading="lazy"
          />
        </a>
        <ul
        class="dropdown-menu dropdown-menu-end bg-dark"
        aria-labelledby="navbarDropdownMenuLink "
      >
      <li>
      <a class="dropdown-item text-white bg-dark" href="profile.php">My profile</a>
    </li>
        
        <li>
          <a class="dropdown-item text-white bg-dark" href="app.php">My Appointments</a>
        </li>
        <li>
          <a class="dropdown-item text-white bg-dark" href="chart.php">Charts</a>
        </li>
        <li>
          <a class="dropdown-item text-white bg-danger" href="../logout.php">Log out</a>
        </li>
      </ul>
      </li>
    </ul>
  </div>
      <!-- Icon -->
    
      

        <!-- Notifications -->
      
        <!-- Avatar -->
        <div class="dropdown">
          <a
            class="dropdown-toggle d-flex align-items-center hidden-arrow"
            href="#"
            id="navbarDropdownMenuAvatar"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
            
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuAvatar"
          >
            <li>
              <a class="dropdown-item" href="profile.php">My profile</a>
            </li>
            <li>
            <a class="dropdown-item" href="profile.php">Cancel apointment for all day</a>
          </li>
            <li>
              <a class="dropdown-item" href="#">Settings</a>
            </li>
            <li>
              <a class="dropdown-item" href="../Logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- Right elements -->
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    '
    ?>
    </body>
    </html>      
