<?php include '../DBconnect2.php';
session_start();
$email=$_SESSION['email'];
$admin="SELECT * FROM userss WHERE email='$email'";
$res_admin=mysqli_query($con,$admin);
$row=mysqli_fetch_assoc($res_admin);
$soldout="SELECT * FROM products WHERE quantity=0";
$res_soldout=mysqli_query($con,$soldout);
$soldout_prods=mysqli_num_rows($res_soldout);

?>
   <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel = "stylesheet">

<link rel="stylesheet" href="./css/style.min.css">
  <!-- ! Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="/" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title">Admin</span>
                    <span class="logo-subtitle">Dashboard</span>
                </div>

            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
               
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a class="active" href="index.php"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon document" aria-hidden="true"></span>Tasks
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="alltasks.php">All tasks</a>
                        </li>
                        <li>
                            <a href="addtask.php">Add new task</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a class="show-cat-btn" href="##">
                    <i class = "material-icons">analytics</i>

                    <span class="material-icons-outlined"> Analytics</span>
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="analys_prods.php">Products analys</a>
                        </li>
                        <li>
                            <a href="analys_apoinments.php">Apointments analys</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                    <i class = "material-icons">category</i>
                        <span  aria-hidden="true"></span> Products
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only"></span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="prods_all.php">All products</a>
                        </li>
                        <li>
                            <a href="prods_soldout.php">Soldout products &nbsp; <span class="w3-badge w3-tiny w3-red"><?php echo $soldout_prods ?></span>  </a>  

                        </li>
                        <li>
                            <a href="prods_add.php">Add products</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                    <i class = "material-icons">people</i>
                        <span  aria-hidden="true"></span> <p> Users </p>
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="all_users.php">All users</a>
                        </li>
                        <li>
                            <a href="all_workers.php">All workers</a>
                        </li>
                    </ul>
                </li>
                 
                <li>
                    <a href="feedback.php">
                        <span class="icon message" aria-hidden="true"></span>
                       Feedbacks
                    </a>
                   
                </li>
            </ul>
          
             
          
        </div>
    </div>
    <div >
        
            <span class="sidebar-user-img">
                <picture><source srcset="<?php echo $row['photo'] ?>" type="image/webp"><img src="./img/avatar/avatar-illustrated-01.png" alt="User name"></picture>
            </span>
            <div class="sidebar-user-info">
                <span class="sidebar-user__title"><?php  echo $row['name'];  ?></span>
                <span class="sidebar-user__subtitle">Welcome admin</span>
            </div>
        </a>
    </div>
</aside>
<script src="./plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="./plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="./js/script.js"></script>