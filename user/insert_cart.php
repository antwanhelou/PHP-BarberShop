<?php
include '../DBconnect.php';
session_start();
$idprod=$_SESSION['idp'];
$namep=$_SESSION['namep'];
$q=0;

    $name=$_POST['name'];
    $price=$_POST['price'];
    $quantity=$_POST['quantity'];
    session_start();
    $iduser=$_SESSION['ID_u'];
    $_SESSION['ID_u'];
    $insert="INSERT INTO addcart(id_user,id_p,name,price,quantity)VALUES ('$iduser','$idprod','$name','$price','$quantity') ";
    mysqli_query($con,$insert);
    header('location:Shop.php');

?>