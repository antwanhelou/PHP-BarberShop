<?php  include '../DBconnect.php'; 
 session_start();
$IDprod= $_GET['id'];
$idp=$_SESSION['delete'];
    $show="SELECT * FROM products WHERE ID_p=$idp";
    $res=mysqli_query($con,$show);
    while($row=mysqli_fetch_assoc($res)){
       

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
    <form   method="POST" >
        <h2> Are you sure want to delete</h2><br>

    
      
        <button type="submit" name="yes"  class="btn btn-danger" > YES </button>
        <button type="submit" name="no"  class="btn btn-dark" > no</button>
    <a href="updateOrdelete.php"> back to  shop</a>
    </form> 
    </div>
</center>
</body>
</html>

<?php    }
if(isset($_POST['yes'])){
    echo $idp;
    $n=$_POST['name'];
    $p=$_POST['price'];
    $q=$_POST['quantity'];
    
   if(mysqli_query($con,"DELETE  FROM products WHERE ID_p=$idp  " )){
       echo '<script> alert("Product DELETED!") </script>';
   }
   else{
       echo 'Not DELETED';
   }
 
}
 

?>
  