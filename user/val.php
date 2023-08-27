<?php
include 'index.php';

// Start or resume the session
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $IDprod = $_POST['id'];
    $quantity = $_POST['quantity'];

    // Fetch product information from the database based on the product ID
    $up = mysqli_query($con, "SELECT * FROM products WHERE ID_p=$IDprod");
    $data = mysqli_fetch_array($up);

    // Check if the product is sold out
    if ($data['quantity'] <= 0) {
        echo json_encode(["status" => "error", "message" => "Product Sold out"]);
        exit;
    }

    // Store product ID and available quantity in session variables for later use
    $_SESSION['idprod'] = $IDprod;
    $_SESSION['q'] = $data['quantity'];

    $productID = $_SESSION['idprod'];
    $id1user = $_SESSION['ID_u'];

    // Check the current quantity of the product in the user's cart
    $check = "SELECT * FROM addcart WHERE id_user=$id1user ";
    $checkmaxquantity = "SELECT quantity FROM products WHERE ID_p=$IDprod";
    $result2 = mysqli_query($con, $checkmaxquantity);
    $row2 = mysqli_fetch_assoc($result2);

    // Calculate the maximum quantity that can be ordered based on the product's availability and the current quantity in the cart
    $current_quantity = $row2['quantity'];
    $chekq = "SELECT quantity FROM addcart WHERE id_p=$productID ";
    $res1 = mysqli_query($con, $chekq);
    $rows = mysqli_fetch_assoc($res1);

    $checkadd = $row2['quantity'] - $rows['quantity'];

    // Check if the requested quantity exceeds the maximum allowed quantity
    if ($quantity > $row2['quantity'] || $quantity > $checkadd) {
        echo json_encode([
            "status" => "error",
            "message" => "You can't order this quantity for the product. The max quantity is " . $row2['quantity']
        ]);
        exit;
    }

    // Check if the product is already in the user's cart
    $quantity_query = "SELECT quantity FROM addcart WHERE id_p=$productID";
    $res2 = mysqli_query($con, $quantity_query);

    $res = mysqli_query($con, $check);
    $row = mysqli_fetch_assoc($res);

    if ($productID == $row['id_p']) {
        // If the product is already in the cart, update the quantity
        $sumQuantity = $row['quantity'] + $quantity;
        $addq = "UPDATE addcart set quantity=$sumQuantity WHERE id_p=$productID";

        $added = mysqli_query($con, $addq);

        echo json_encode(["status" => "success"]);
        exit;
    } else {
        // If the product is not in the cart, insert it as a new item
        $_SESSION['idp'] = $data['ID_p'];
        $name = $data['name'];
        $price = $data['price'];
        $iduser = $_SESSION['ID_u'];

        $insert = "INSERT INTO addcart(id_user, id_p, name, price, quantity) VALUES ('$iduser', '$IDprod', '$name', '$price', '$quantity') ";
        mysqli_query($con, $insert);

        echo json_encode(["status" => "success"]);
        exit;
    }
}
?>
