<?php  include '../DBconnect.php'; 

 session_start();
$IDprod= $_GET['id'];
$idp=$_SESSION['update'];
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
        <h2> Update Product</h2>
       ID: <input type="text" name="id"  value='<?php echo $_SESSION['update']?>'/>
       <br>
        Name :  <input type="text" name="name" value='<?php echo  $row['name']?>' />
        <br>
       Price : <input type="text" name="price" value='<?php echo $row['price'] ?>'/>
       <br>
       Quantiny  : <input type="text" min="1" name="quantity"  value=' <?php echo $row['quantity']?>''><br>
        <button type="submit" name="update"  class="btn btn-dark" > Update product </button><br>
    <a href="updateOrdelete.php"> back to  shop</a>
    </form> 
    </div>
</center>
</body>
</html>

<?php    }
if(isset($_POST['update'])){
    echo $idp;
    $n=$_POST['name'];
    $p=$_POST['price'];
    $q=$_POST['quantity'];
    
   if(mysqli_query($con,"UPDATE products set name='". $_POST['name'] ."' ,  price='". $_POST['price'] ."', quantity='". $_POST['quantity'] ."'  WHERE ID_p=$idp  " )){
       echo '<script> alert("Product UPDATED!") </script>';
   }

}
 

?>
  