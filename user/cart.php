<?php
include '../DBconnect.php';
include 'index.php';


// Execute an SQL query to get the total number of rows in the 'addcart' table and store it in the $data1 variable
$resssult = mysqli_query($con, "SELECT count(*) as total from addcart");
$data1 = mysqli_fetch_assoc($resssult);

// Retrieve the 'ID_u' from the session and store it in the $id variable
$id = $_SESSION['ID_u'];

// Execute an SQL query to retrieve data from the 'addcart' table and join it with the 'products' table
// The result will include all records from 'addcart' table with additional 'image' field from 'products' table
// The INNER JOIN is done using the condition 'addcart.id_p = products.ID_p' to match the related products
// The condition 'addcart.id_user = $id' filters the results to get data only for the specific user's cart
$result = mysqli_query($con, "SELECT addcart.*, products.image 
                              FROM addcart 
                              INNER JOIN products ON addcart.id_p = products.ID_p 
                              WHERE addcart.id_user = $id");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <style>
        .total-container {
            padding: 10px;
            text-align: right;
            font-size: 1.5rem;
            font-weight: bold;
            color: #2B2928;
        }

        .img5 {
            width: 150px;
        }

        .nav {
            overflow: hidden;
            background-color: #333;
            position: fixed; /* Set the navbar to fixed position */
            top: 0; /* Position the navbar at the top of the page */
            width: 100%; /* Full width */
        }

        .navbar-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            overflow: hidden;
        }

        .navbar-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        html, body {
            margin: 0;
            height: 100%;
            overflow: hidden;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="mb-4 text-center">
        <h2>Your Cart</h2>
    </div>

    <div class="d-flex justify-content-between mb-4">
        <a class="btn btn-dark" href="Shop.php">Back to Shop</a>
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <a class="btn btn-dark" href="payment.php">Pay!</a>
            <form method="POST">
                <button type="submit" name="emptycart" class="btn btn-danger">Empty Cart</button>
            </form>
        <?php endif; ?>
    </div>

    <?php
    session_start();
    $flag = $_SESSION['flag'];
    $id = $_SESSION['ID_u'];
    $total = 0;
    $idpr = $_SESSION['idprod'];

    if (isset($_POST['emptycart'])) {
        $empty = "DELETE FROM addcart WHERE id_user=$id";
        $resultempty = mysqli_query($con, $empty);

        if ($resultempty) {
            header("Location: cart.php");
            exit();
        } else {
            echo "Failed to empty cart.";
        }
    }

    if (mysqli_num_rows($result) > 0) {
        $pr = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="card mb-4">
            <div class="row g-0">
            <div class="col-md-4">
            <img class="img5" src="../' . $row['image'] . '" class="img-fluid rounded-start" alt="Product Image">
            </div>
            <div class="col-md-8">
            <div class="card-body">
            <h5 class="card-title">' . $row['name'] . '</h5>
            <p class="card-text">Price: $' . $row['price'] . '</p>
            <p class="card-text">Quantity: ' . $row['quantity'] . '</p>
            <a href="del_cart.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>
            </div>
            </div>
            </div>
            </div>';
            $pr = $row['quantity'] * $row['price'];
            $_SESSION['delete'] = $row['quantity'];
            $total += $pr;
            }
            }
            if (mysqli_num_rows($result) == 0) {
                $total = 0;
                $_SESSION['total'] = $total;
                $_SESSION['sumincart'] = 0;
                echo '
                <div class="text-center">
                    <img src="https://shop.millenniumbooksource.com/static/images/cart1.png" class="img-fluid" />
                </div>';
            }
            ?>
</div>
<div class="total-container">
    <p>Total: $<?php echo $total;
    session_start();
    $_SESSION['total']=$total;
    ?></p>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
</body>
</html>            
