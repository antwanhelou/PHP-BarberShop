<?php  include '../DBconnect.php'; 
 
$IDprod= $_GET['id'];
session_start();
$iduser=$_SESSION['deleteuser'];
 
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
        <h2> Are you sure want delete accout </h2><br>

        <?php  

        $user="SELECT email from Userss WHERE ID_u=$iduser";
        $res=mysqli_query($con,$user);
        $row=mysqli_fetch_assoc($res);
        echo $row['email'];
         ?>
      <br>
        <button type="submit" name="yes"  class="btn btn-danger" >     YES </button>
        <button type="submit" name="no"  class="btn btn-warning" > no</button>
    <a href="Shop.php"> back to  shop</a>
    </form> 
    </div>
</center>
</body>
</html>

<?php     
if(isset($_POST['yes'])){
    echo $iduser;
    $n=$_POST['name'];
    $p=$_POST['price'];
    $q=$_POST['quantity'];
    
   if(mysqli_query($con,"DELETE FROM Userss WHERE ID_u=$iduser" )){
       echo '<script> alert("User DELETED!") </script>';
   }
   else{
       echo 'Not DELETED';
   }
 
}
 

?>
  