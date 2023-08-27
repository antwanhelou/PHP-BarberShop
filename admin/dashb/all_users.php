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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
      <div class="search-wrapper">
     
    </div>
    
   <?php include 'navbar.php';  ?>
    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
      <div class="container">
        <h2 class="main-title">All users  </h2>
     <?php
        $users=mysqli_query($con,"SELECT * FROM Userss WHERE ROLE='USER' ");
 echo'
 <table class="table"style=" table-layout: fixed;
 width: 100%;  "  >
 <thead>
   <tr>
     <th scope="col">name</th>
     <th scope="col">email</th>
     <th scope="col">ROLE</th>
     <th scope="col">Actions</th>
   </tr>
 </thead> ';
 
 while($row=mysqli_fetch_assoc($users)){
    session_start();
    
   ?>
   <form method="GET" >
   <table class="table table-hover" "   style=" table-layout: fixed;
    width: 100%;  "  >
    <div class="w3-container">
   <tbody>
       <tr>
       <button onclick="myFunction('Demo1')" class="w3-button w3-light-grey">

         <th scope="row"><?php echo $row['name']; $_SESSION['name']=$row['name'] ; ?></th>
         <td><?php echo $row['email']; ?></td>
         <td><?php echo $row['ROLE'];   ?></td>
         </button>

    <div id="Demo1" class="w3-hide w3-container w3-light-grey">
      <td>   
      <button  class="btn btn-secondary rounded-pill " type="submit" name="details" value= <?php echo $row['ID_u']  ?>>  Details</button><br>
     <button  class="btn btn-danger rounded-pill" type="submit" name="deleteuser" value= <?php echo $row['ID_u']  ?>>  delete user</button><br>
     <button  class="btn btn-dark rounded-pill " type="submit" name="history" value= <?php echo $row['ID_u']  ?>> History of orders </button>
   </td></div></div>
   </form>
       </tr>
     </tbody>
   </table>
     
          <?php }
          ?>
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
<script>
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
</html>

<?php 


if (isset($_GET['deleteuser'])){
 session_start();
 $_SESSION['deleteuser']=$_GET['deleteuser'];
  echo ' <script> var myWindow = window.open("deleteuser.php?", "", "width=750,height=450"); </script>';
}
if(isset($_GET['details'])){
  session_start();
  $_SESSION['details']=$_GET['details'];
  echo ' <script> var myWindow = window.open("detailsuser.php", "_blank", "width=750,height=450"); </script>';

}
if(isset($_GET['history'])){
  session_start();
  $_SESSION['history']=$_GET['history'];
  echo ' <script> var myWindow = window.open("historyorders.php?", "_blank", "width=750,height=450"); </script>';

}
?>
  