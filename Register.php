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
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name="name">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="retypepassword"> Retype password Password</label>
    <input type="password" class="form-control" name="retypepassword" placeholder=" Retype Password">
  </div>
  <div class="form-group form-check">
  </div>
  <p>
  <button type="submit" name="Register" class="btn btn-dark">Register</button>
  

</form>


</div>
<?php
include 'DBconnect.php';
?>
