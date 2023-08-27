<?php
// Include the database connection file
include '../DBconnect2.php';

// Start the session
session_start();

// Get the ID of the product to delete from the URL parameter
$IDprod = $_GET['id'];

// Retrieve the product details from the database using the ID
$idp = $_SESSION['delete'];
$show = "SELECT * FROM products WHERE ID_p=$idp";
$res = mysqli_query($con, $show);

// Check if the query was successful and fetch the product details
if ($row = mysqli_fetch_assoc($res)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <style>
        .main {
            width: 30%;
            padding: 20px;
            box-shadow: 1px 1px 10px silver;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <center>
        <div class="main">
            <form method="POST">
                <h2>Are you sure you want to delete?</h2><br>
                <!-- Display product details if necessary -->
                <!-- For example:
                <p>Name: <?php echo $row['name']; ?></p>
                <p>Price: <?php echo $row['price']; ?></p>
                <p>Quantity: <?php echo $row['quantity']; ?></p>
                -->

                <button type="submit" name="yes" class="btn btn-danger">YES</button>
                <button type="submit" name="no" class="btn btn-warning">NO</button>
                <a href="Shop.php">Back to the shop</a>
            </form>
        </div>
    </center>
</body>
</html>

<?php
}

// Process the form submission
if (isset($_POST['yes'])) {
    // Delete the product from the database using the ID
    $n = $_POST['name']; // If you have input fields, access them here
    $p = $_POST['price'];
    $q = $_POST['quantity'];

    if (mysqli_query($con, "DELETE FROM products WHERE ID_p=$idp")) {
        echo '<script> alert("Product DELETED!") </script>';
    } else {
        echo 'Not DELETED';
    }
}
?>