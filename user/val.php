<?php

include 'index.php';


session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $IDprod = $_POST['id'];
    $quantity = $_POST['quantity'];

    $up = mysqli_query($con, "SELECT * FROM products WHERE ID_p=$IDprod");
    $data = mysqli_fetch_array($up);

    if ($data['quantity'] <= 0) {
        echo json_encode(["status" => "error", "message" => "Product Sold out"]);
        exit;
    }

    $_SESSION['idprod'] = $IDprod;
    $_SESSION['q'] = $data['quantity'];

    $np = $_SESSION['idprod'];
    $id1user = $_SESSION['ID_u'];

    $check = "SELECT * FROM addcart WHERE id_user=$id1user ";
    $checkmaxquantity = "SELECT quantity FROM products WHERE ID_p=$IDprod";
    $result2 = mysqli_query($con, $checkmaxquantity);
    $row2 = mysqli_fetch_assoc($result2);

    $current_quantity = $row2['quantity'];
    $chekq = "SELECT quantity FROM addcart WHERE id_p=$np ";
    $res1 = mysqli_query($con, $chekq);
    $rows = mysqli_fetch_assoc($res1);

    $checkadd = $row2['quantity'] - $rows['quantity'];

    if ($quantity > $row2['quantity'] || $quantity > $checkadd) {
        echo json_encode([
            "status" => "error",
            "message" => "You can't order this quantity for product. The max quantity " . $row2['quantity']
        ]);
        exit;
    }

    $quantity_query = "SELECT quantity FROM addcart WHERE id_p=$np";
    $res2 = mysqli_query($con, $quantity_query);

    $res = mysqli_query($con, $check);
    $row = mysqli_fetch_assoc($res);

    if ($np == $row['id_p']) {
        $x = $row['quantity'] + $quantity;
        $addq = "UPDATE addcart set quantity=$x WHERE id_p=$np";

        $added = mysqli_query($con, $addq);

        echo json_encode(["status" => "success"]);
        exit;
    } else {
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
