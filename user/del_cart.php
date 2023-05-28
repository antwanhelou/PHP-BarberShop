<?php
include '../DBconnect.php';

session_start();
$id=$_GET['id'];
mysqli_query($con,"DELETE FROM addcart WHERE  id=$id");

header('location:cart.php');

?>