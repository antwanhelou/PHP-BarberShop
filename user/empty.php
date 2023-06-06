<?php
include '../DBconnect.php';

session_start();
$iduser= $_SESSION['ID_u'];
echo $iduser;
$empty="DELETE * FROM addcart WHERE  id_u=$iduser";

$result=mysqli_query($con,$empty);

header('location:cart.php');

?>