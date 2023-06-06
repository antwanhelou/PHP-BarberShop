<?php
include 'navbar.php';
?>
 <style>
       
        .main{
            width:30%;
            padding:20px;
            box-shadow: 1px 1px 10px silver;
            margin-top:50px;
        }

        </style>
<div class="container">
<form method="POST">
<div class="form-group">
    <label >Name</label>
    <input type="text" class="form-control" name="name" required >

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" required >
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label >Your message</label>
    <input type="text" class="form-control" name="message"  placeholder="Your message" required >
  </div>
 
  
  <div class="form-group form-check">
  </div>
  <p>
  <button type="submit" name="send" class="btn btn-dark">Send</button>
  

</form>


</div>
<?php

include 'DBconnect.php';
$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];
$insertTo_contactus="INSERT INTO contactus (name,email,message) VALUES ('$name','$email','$message')";
$result=mysqli_query($con,$insertTo_contactus);
if($name!="" && $email!=""&& $message!=""  ){
    echo '<div class="alert alert-success" role="alert">
   Thank you for contacting us!
  </div>';
}

?>
