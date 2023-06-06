
<?php 
include './DBconnect.php';
include 'navbar.php';
session_start();
?>
<div class="container">
<form method="POST">

  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
  </div>
  <div class="form-group form-check">
  </div>
  <button type="submit" name="login" class="btn btn-dark">Login</button>

</form>
</div>
  <?php

include 'DBconnect.php';

//loginusers

$sql="SELECT * FROM userss" ;
$result=mysqli_query($con,$sql);
if(!isset($_SESSION['count'])){
	$_SESSION['count']=0; 
}
//making random password:
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
$_SESSION['randpassword'] = randomPassword();
if(!isset($_SESSION['email']))
$_SESSION['email']=$_POST['email'];


if($_SESSION['email']!=$_POST['email'])
{
$_SESSION['count']=0;
$_SESSION['email']=$_POST['email'];
}
$sql="SELECT * From userss";
$result = mysqli_query($con,$sql);

if(!empty( $_POST['email'])&&!empty($_POST['password'])){
	$user = $_POST['email'];
	$passs = $_POST['password'];
	while($row = mysqli_fetch_array($result))
	{
		if($row['Email']==$_POST['email'])
		{
			
			break;
		}
		
	}
   if($row['Password']==$_POST['password'])
	header('location:home.php');
	else{
		
		if(!isset($_SESSION['count']))
			$_SESSION['count']=0;
		$_SESSION['count'] =$_SESSION['count']+1;
		
		if($_SESSION['count']==3)
		{   
			$result1=  mysqli_query($con,"UPDATE userss set isblocked='1' WHERE email='$user'");
			$_SESSION['count']=0;
			
			echo"we sent an email with the new password <br> we will sent u to the log in again and there enter the new password.";
				$to =$_SESSION['email'] ;
				$subject = 'New password';
			 	$message = "Hello  your new password is: \n" .$_SESSION['randpassword'].
				"\nLogin: http://localhost/labs/pass_ran.php";
				$headers = "From: helou527@gmail.com";
				$mail_sent = mail($to, $subject, $message, $headers);
				if($mail_sent == true){
					$result =  mysqli_query($con,"UPDATE userss set tempass= '".$_SESSION['randpassword']."' WHERE email='".$user."'");
					echo "your new password sending to your mail";
					header('location:pass_ran.php');
			
				}
				else{
					
					die(mysqli_error($con));
				}
		
		}
		
					}
				
			}
			
?>
