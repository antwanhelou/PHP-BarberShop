<?php 
  include '../DBconnect.php';
  include 'index.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

    <style>
        h5 {
            color:white;
            text-align:center;
            font-size:50px;
        }
        p {
            color:white;
            font-size:25px;
        }
        h1 {
            color:white;
        }
    </style>
</head>
<body>
    <form method="POST">
        <div class="card text-bg-dark">
            <img src="https://www.soundproofcow.com/wp-content/uploads/2020/06/salon.jpg" height="350px" class="card-img" alt="...">
            <div class="card-img-overlay">
                <h5 class="card-title">Welcome Admin</h5>
                <center>
                    <p class="card-text">Show All Feedback Customers</p>
                    <p class="card-text"> 
                        <button type="submit" name="feedback" class="btn btn-dark">
                            <i class="fas fa-comments"></i> Feedbacks
                        </button>
                    </p>
                    <p class="card-text">
                        <button type="submit" name="soonend" class="btn btn-danger">
                            <i class="fas fa-exclamation-triangle"></i> Products running out of stock
                        </button>
                    </p>
                </center>
            </div>
        </div>
        <div class="card text-bg-dark">
            <img src="../images/BARBER.jpg" height="350px" class="card-img" alt="...">
        </div>
    </form>

<?php
if(isset($_POST['feedback'])){
    echo '	
    <script>window.location.replace("feedback.php")</script>;' ;
   
}
if(isset($_POST['soonend'])){
     echo '	
    <script>window.location.replace("reports.php")</script>;' ;
}
?>
</body>
</html>
