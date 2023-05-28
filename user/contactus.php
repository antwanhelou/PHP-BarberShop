<?php
include 'index.php';
session_start();
 
$iduser=$_SESSION['ID_u'];
$details="SELECT * FROM userss WHERE ID_u=$iduser";
$res=mysqli_query($con,$details);
$row=mysqli_fetch_assoc($res);

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
<form method="POST" >
<div class="form-group">
    <label >Name</label>
    <input type="text" class="form-control"  name="name" value="<?php echo $row['name']?>  "  >

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" d name="email" aria-describedby="emailHelp" value=" <?php echo $row['email']?>" >
    <small id="emailHelp" class="form-text text-muted">Enter the email you want to contacts us from.</small>
  </div>
  <div class="form-group">
    <label >Your message</label>
    <input type="text" class="form-control" name="message"  placeholder="Your message" required >
  </div>
 
  
  <div class="form-group form-check">
  </div>
  <p>
  <button type="submit"  name="send" class="btn btn-warning">Send</button>
  

</form>


</div>
<?php

include 'DBconnect.php';

$name=$_POST['name'];
$email=$_POST['email'];
 
$message=$_POST['message'];
if($message!=""){
$insertTo_contactus="INSERT INTO contactus (name,email,message) VALUES ('$name','$email','$message')";
$result=mysqli_query($con,$insertTo_contactus);

    echo '<div class="alert alert-success" role="alert">
   Thank You For Contact Us!
  </div>';
 
}


?>
