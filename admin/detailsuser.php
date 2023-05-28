<?php  include '../DBconnect.php'; 
 
 
session_start();
$iduser=$_SESSION['details'];
 echo $iduser;
       

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* input{
            display:none;
        } */
        .main{
            width:30%;
            padding:20px;
            box-shadow: 1px 1px 10px silver;
            margin-top:50px;
        }
        </style>
</head>
<body>
    <center>
        <div class="main">
    <form  method="POST" >
        <h2> Details about user </h2><br>
  
        <?php  

        $user="SELECT * from Userss WHERE ID_u=$iduser";
        $res=mysqli_query($con,$user);
       while( $row=mysqli_fetch_assoc($res)){    
             ?>
        <p> name : <?php echo $row['name'];?></p>
        <p> email :<?php echo $row['email']; ?></p>
        <button  class="btn btn-danger rounded-pill " type="submit" name="close" > Close  </button>

 
 <?php

       }
       ?>
 
</script>
      <br>
    <a href="Shop.php"> back to  shop</a>
    </form> 
    </div>
</center>
</body>
</html>

<?php    //}
if(isset($_POST['close']))
echo '<script>  var mywindow= window.close();   </script>';
 

?>
  