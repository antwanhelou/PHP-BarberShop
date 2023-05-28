<?php 
  include '../DBconnect.php';
  include 'index.php';
 
  if(isset($_POST["shop_user"]) ){
    header("location:shop.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
  
    <style>
        h5{
            color:white;
            text-align:center;
            font-size:50px;
        }
        p{
            color:white;
            font-size:25px;
        }
        h1{
            color:white;
        }
    </style>
</head>
<body>
    <form method="POST">
        <div class="card bg-dark text-white">
            <img src="https://www.soundproofcow.com/wp-content/uploads/2020/06/salon.jpg" height="350px" class="card-img" alt="...">
            <div class="card-img-overlay text-center">
                <h5 class="card-title">Welcome To Our HairShop</h5>
                <p class="card-text">You can here find all the hair equipments</p>
                <p class="card-text">
                <a href="shop.php" class="btn btn-dark">
            <i class="fas fa-shopping-cart"></i> Shop Now!
        </a>
              
                </p>
                </a>
            </div>
        </div>
        <div class="card bg-dark text-white">
            <img src="../images/BARBER.jpg" height="350px" class="card-img" alt="...">
            <div class="card-img-overlay text-center">
                
                <p class="card-text">You can tell us how the service or if you want to say something for improve the store just click on contact us!</p>
               
                    <!-- <p class="card-text">
                        <button type="submit" name="contact" class="btn btn-warning rounded-pill">
                            <i class="fas fa-envelope"></i> Contact us!
                        </button>
                    </p> -->
                    <a href="contactus.php" class="btn btn-dark">
            <i class="fas fa-envelope"></i> Contact us!
        </a>
                </a>
            </div>
        </div>
    </form>
</body>
</html>
