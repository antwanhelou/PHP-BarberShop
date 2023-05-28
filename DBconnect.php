<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
  <style>
    body{
      background-image: url("https://static.vecteezy.com/system/resources/previews/010/743/984/original/background-web-template-element-construction-wood-texture-vector.jpg");
    }
  </style>
  <body>
    
  </body>
<?php
$hostname='localhost';
$username='root';
$password='';
$database='Barbershopp';
error_reporting(0);
$con=mysqli_connect($hostname,$username,$password,$database);


if(isset($_POST['Register'])){
     $name=$_POST['name'];

     $email=$_POST['email'];
     $password=$_POST['password'];
     $photo=$_POST['photo'];
     $checkemail="SELECT * FROM Userss WHERE email='$email'";
     $targetDirectory = '../photos/R.png';   
     $result_checkmail=mysqli_query($con,$checkemail);
     if($result_checkmail){
         $num=mysqli_num_rows($result_checkmail);
         if($num>0){
             echo ' <div class="alert alert-danger" role="alert">
             Email already exist
           </div> ';
         }
        
         if($_POST['password']!=$_POST['retypepassword']){
          echo ' <div class="alert alert-danger" role="alert">
         The passwords doesnt match
        </div> ';
        return;
         }
       
           $addUser="INSERT INTO Userss(name,email,password,photo) VALUES('$name', '$email','$password','$targetDirectory') ";
           $result=mysqli_query($con,$addUser);
           if($result){
            
           echo '<div class="alert alert-success" role="alert">
        Registraion Succesfuly
      </div>
      ';
           }
   
    
}   

    }
    // ** LOGIN **//
    $login=0;
    $login_admin=0;
    $invalid=0;
if (isset($_POST['login'])) {
  
  $emailuser = $_POST['email'];
  $sql3 = "SELECT * FROM userss WHERE email='$emailuser'";
  $res = mysqli_query($con, $sql3);

  $row3 = mysqli_fetch_assoc($res);
  if ($row3['isblocked'] == '1') {
   
    header('location:pass_ran.php');
    return;
  }

  $email=$_POST['email'];
  $password=$_POST['password'];
  $check="SELECT * FROM Userss WHERE  email='$email' and password='$password'and ROLE='USER'";
  $check2="SELECT * FROM Userss WHERE  email='$email' and password='$password'and ROLE='ADMIN'";
  $check3="SELECT * FROM Userss WHERE  email='$email' and password='$password'and ROLE='WORKER'";
  $result=mysqli_query($con,$check);
  $result2=mysqli_query($con,$check2);
  $result3=mysqli_query($con,$check3);
  if($check){
      $num=mysqli_num_rows($result);  
      $row=mysqli_fetch_array($result);
      if($num>0){
        $login=1;
          session_start();
          $_SESSION['ID_u']=$row['ID_u'];
          $_SESSION['name']=$row['name'];

          $_SESSION['email']=$email;
          header('location:user/Home.php');

      }
  }
      if($check2){

          $num2=mysqli_num_rows($result2);
          $row2=mysqli_fetch_array($result2);
              if($num2>0){
                  $login=1;
                  session_start();
                  $_SESSION['ID_u']=$row['ID_u'];

                   $_SESSION['nameadmin']=$row2['name'];

                  $_SESSION['email']=$email;
                  header('location:admin/home.php');

              }


          }
          if($check3){
            $num3=mysqli_num_rows($result3);  
            $row3=mysqli_fetch_array($result3);
            if($num3>0){
              $login=1;
                session_start();
                $_SESSION['ID_u']=$row3['ID_u'];
                $_SESSION['nameworker']=$row3['name'];
      
                $_SESSION['email']=$email;
                header('location:worker/Home.php');
      
            }
        }
          if($login==0){
           echo'   <div class="alert alert-danger" role="alert">
              Worng Email/Password!
            </div>';
          }



      }



  if (isset($_POST['addp'])) {
    $name = $_POST['name'];
    $about = $_POST['about'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image'];
    $type = $_POST['type'];
   
    $imagename = $image['name'];

    $insert = "INSERT INTO products (name,about,price,quantity,image,category) VALUES('$name','$about','$price','$quantity','$imagename','$type')";
    $data = mysqli_query($con, $insert);
    if ($data) {
      echo ' <script>alert("Product added succefully");</script>';

    }
  }


  if (isset($_POST['shop'])) {

    echo '<script>   alert("You must login first!"); </script> ';



  }
 
 
?>