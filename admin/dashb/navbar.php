<?php include '../DBconnect2.php';
session_start();
$email=$_SESSION['email'];
$admin="SELECT * FROM userss WHERE email='$email'";
$res_admin=mysqli_query($con,$admin);
$row=mysqli_fetch_assoc($res_admin);
 
if ($email == null) {
  echo '<script>';
  echo 'alert("Please login first");';
  echo 'window.location.href = "/labss2/Login.php";';
  echo '</script>
 
  ';
 
  exit; // Stop further execution of the script
}
 
?>
<html lang="en">

<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elegant Dashboard | Dashboard</title>
  <!-- Favicon -->
  <!-- Custom styles -->
  <link rel="stylesheet" href="./css/style.min.css">
</head>
<style>
 
</style>
<link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">

 
<div class="main-nav-end"  >
 
   
      <div class="nav-user-wrapper">
        <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
          <span class="sr-only">My profile</span>
          <span class="nav-user-img">
            <picture><source srcset="<?php echo $row['photo'] ?>" type="image/webp"><img src="./img/avatar/avatar-illustrated-02.png" alt="User name"></picture>
          </span>
        </button>
        <ul class="users-item-dropdown nav-user-dropdown dropdown">
          <li><a href="myprof.php">
              <i data-feather="user" aria-hidden="true"></i>
              <span>Profile</span>
            </a></li>
         
          <li><a class="danger" href="##">
              <i data-feather="log-out" aria-hidden="true"></i>
              <button onclick="document.getElementById('id01').style.display='block'" class="    w3-white  w3-section"  >Logout</button>

            </a></li>
        </ul>
      </div>
    </div>
  
</div>
</nav>
<script src="./plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="./plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="./js/script.js"></script>
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
    <div class="w3-center"><br>
    <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
</div>
<form class="w3-container" action="/labss2/Login.php">
        <div class="w3-section">
          <h2> Are you sure want to logout?</h2>
           <button class="w3-button w3-block w3-red w3-section w3-padding" type="submit">Yes </button>
           <button onclick="document.getElementById('id01').style.display='none'" type="button"  class="w3-button w3-block w3-gray   w3-section w3-padding">No</button>

        </div>
      </form>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
      </div>

    </div>
</div>