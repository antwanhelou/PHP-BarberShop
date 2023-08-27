<?php
// Include the 'DBconnect.php' file to establish a connection to the database
include '../DBconnect.php';

session_start();

// Retrieve the product ID and product name from the session and store them in respective variables
$idprod = $_SESSION['idp'];
$namep = $_SESSION['namep'];


$q = 0;

// Retrieve the data sent via POST method and store them in respective variables
$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

// Retrieve the user's ID from the session and store it in the $iduser variable
$iduser = $_SESSION['ID_u'];

// Construct the SQL query to insert the user's cart item into the 'addcart' table
$insert = "INSERT INTO addcart (id_user, id_p, name, price, quantity) VALUES ('$iduser', '$idprod', '$name', '$price', '$quantity')";

// Execute the SQL query using the mysqli_query function with the database connection ($con)
mysqli_query($con, $insert);

// Redirect the user to the 'Shop.php' page after adding the item to the cart
header('location: Shop.php');
?>
