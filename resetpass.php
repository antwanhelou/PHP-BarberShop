<html>
<link rel="stylesheet" href="css/resetpass.css">
    <body>

      
    <div class="container">
	
	<div class="screen">
   
		<div class="screen__content">
 <h1>Reset Password!!</h1>
			<form action="" method="post" class="login">
		
                <div class="login__field">
					<i style="color:#9d8189"  class="bi bi-lock-fill"></i>
					<input type="password" name="password" class="login__input" placeholder="Password">
				</div>
                <div class="login__field">
					<i style="color:#9d8189"  class="bi bi-lock-fill"></i>
			<input type="password" name="passwordc" class="login__input" placeholder="Confirm Password">
				</div>
				<button class="button login__submit" name="submit">
					<span class="button__text" style="	font-family: cursive;" >
					Send Reset Instructions </span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</div>
		</div>
		<div class="screen__background">
			<span class="screen_backgroundshape screenbackground_shape4"></span>
			<span class="screen_backgroundshape screenbackground_shape3"></span>		
			<span class="screen_backgroundshape screenbackground_shape2"></span>
			<span class="screen_backgroundshape screenbackground_shape1"></span>
		</div>	
			
	</div>
</div>
<?php
error_reporting(0);
session_start();
$user=$_SESSION['email'];
$con=mysqli_connect("localhost","root","","barbershopp");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
} 

$sql = "SELECT * FROM userss where  email='".$user."'";
 $result = mysqli_query($con, $sql);
 $repass =$_POST['password'];
$password2 = $_POST['passwordc'];
while($row = mysqli_fetch_array($result)){
		// Check if the form has been submi
		$PASS=$row['password'];
		$PASS1=$row['pass1'];
		$PASS2=$row['pass2'];

}	
if($repass!=$PASS1 && $repass!=$PASS2 && $repass!=$PASS){
if($repass== $password2){
if (isset($_POST['submit']) ) {
	$result1 = mysqli_query($con,"UPDATE userss set  pass2='".$PASS1."',pass1='".$PASS."',password='".$repass."',isblocked='0' where email='".$user."'");
	
	header('location:login.php');
}
}
}
else
{
echo "You have to enter a password that was not in the last 3 passwords ";
}	
?>

</form>
	

</body>
</html>