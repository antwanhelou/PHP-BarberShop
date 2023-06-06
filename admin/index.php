<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
  <title>Document</title>
</head>
<body>
  <?php include '../DBconnect.php';
  include '../apointments.php';
  $date2 = date('Y-m-d');
$time = date('H');
  $isActive = activeApoinments($con, $date2, $time);
//commit try
 // $change=$isActive;
 // var_dump($change); 

    session_start();

    error_reporting(0);

    session_start();
    $apointments="SELECT * FROM  history_of_queues";
    $result=mysqli_query($con,$apointments);
    $NumOfApointments=mysqli_num_rows($result);
   
    if(!isset($_SESSION['email'])){
        header('location:../login.php');
    }
  ?>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">
        <i class="fas fa-user"></i> Welcome Admin <?php echo $_SESSION['name']; ?>
      </a>
      
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="addPr.php">
              <i class="fas fa-plus-square"></i> Add Product
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Usersinfo.php">
              <i class="fas fa-users"></i> About Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="updateOrdelete.php">
              <i class="fas fa-edit"></i> Update/Delete Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="apointments.php">
              <i> 
                <?php  if($change==false){ ?>
                <img src="../images/off2.gif" height="25px" width="25px" >
            <?php  }
            else{
            ?><img src="../images/on.gif" height="25px" width="25px" ><?php  }?>
            </i> Active apointments
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-danger text-white" href="../Logout.php">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  

</body>
</html>
