<?php header('Refresh:90;URL = login.php');
error_reporting(0);
 echo '<script> alert("you are blocked,please reset your password");</script> ';?>

<html>
<link >
    <body>
       <?php echo'
       
    <div class="container">
	   <div class="screen">
		<div class="screen__content">
            <h1>Enter the temporary password that you received on the email !!</h1>
              <form action="" method="post" class="login">
			<div class="login__field">	
			<i style="color:#9d8189"  class="bi bi-people-fill"></i>
			<input type="text" name="pass_ra" class="login__input" placeholder="password that was sent by email...">
		</div>
        
				<button class="button login__submit" name="submit">
					<span class="button__text" style="	font-family: cursive;" >
					Send Reset Instructions </span>
        </form>
        </div>
        </div>
        ';?>
<?php
session_start();
$user=$_SESSION['email'];
$con=mysqli_connect("localhost","root","","barbershopp");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
} 

// Check if the form has been submitted
if (isset($_POST['submit'])) {
  // Get the email address or username and new password from the form
  $pass_ra = $_POST['pass_ra'];
  $sql = "SELECT * FROM userss WHERE  email='$user'";
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_array($result))
	{
    
			if($row['isblocked']==1)
      header('location:login.php');

		if($pass_ra==$row['tempass']){
       header('Location: http://localhost/labss2/resetpass.php');
  }
}



}?>