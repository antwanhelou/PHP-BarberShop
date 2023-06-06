<?php
session_start(); 
include '../DBconnect.php';
include 'index.php';
if (!isset($_SESSION['form_token'])) {
    $_SESSION['form_token'] = bin2hex(random_bytes(32));
}
if (isset($_SESSION['discounted_total'])) {
    $_SESSION['total'] = $_SESSION['discounted_total'];
}
?>

<?php
$coins_pay = $_POST['coins'];
$cvv = $_POST['cvv'];
$numcard = $_POST['numcard'];
$flag = 0;
$iduser = $_SESSION['ID_u'];

$query = "SELECT coins FROM userss WHERE ID_u='$iduser'";
        $result = mysqli_query($con, $query);
        $user_data = mysqli_fetch_assoc($result);
        $user_coins = $user_data['coins'];
        
if($user_coins>0){
if (isset($_POST['paycoins']) && isset($_POST['form_token'])){
    if ($_POST['form_token'] === $_SESSION['form_token']) {
    $iduser = $_SESSION['ID_u'];
    
    // Fetch the user's coins from the database
        // Fetch the user's coins from the database
        $query = "SELECT coins FROM userss WHERE ID_u='$iduser'";
        $result = mysqli_query($con, $query);
        $user_data = mysqli_fetch_assoc($result);
        $user_coins = $user_data['coins'];
    
        // Check if the user has enough coins
        if ($coins_pay > 0 && $coins_pay <= $user_coins) {
            $coins_per_dollar = 1; // Assume 1 coin is worth 10 cents
            $coins_to_deduct = $coins_pay * $coins_per_dollar; // Calculate the coins to deduct based on the exchange rate
            $new_total = $_SESSION['total'] - $coins_to_deduct; // Deduct the coins discount from the total
            $_SESSION['total'] = $new_total; // Update the new total in the session variable
            $_SESSION['discounted_total'] = $new_total;
            $_SESSION['applied_coins'] = $coins_pay;
            // Update the user's coins in the database
            $query = "UPDATE userss SET coins=coins-'$coins_pay' WHERE ID_u='$iduser'";
            $result = mysqli_query($con, $query);
    
            // Set the flag to indicate that the coins have been deducted
            $_SESSION['coins_deducted'] = true;
    
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Success!</h4>
            <p><strong>Discount applied</strong> Your new total is $' . $_SESSION['total'] . '.</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
         else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Note:
            You cannot use more coins than you have</h4>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    
        // Unset the form token to prevent form resubmission
        unset($_SESSION['form_token']);
    } 
    header('Location: ' . $_SERVER['payment.php']);
    exit;
}  
  
}
else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <p class="alert-heading">Note:You have no coins available</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
        }
        



if(isset($_POST['pay'])){
if (!(preg_match(('/^[0-9]{3,4}$/'),$cvv))|| $cvv=""){
    echo '<div class="alert alert-danger" role="alert">
    <strong>CVV!</strong> Enter correct cvv.

  </div>  ';

}




else if (!(preg_match(('/^4[0-9]{12}(?:[0-9]{3})?$/'),$numcard))||$numcard=""){
echo '<div class="alert alert-danger" role="alert">
    <strong>Card number!</strong> Enter correct card number.
  </div> ';
}

else{
    $idprod=$_SESSION['idp'];
    $iduser=$_SESSION['ID_u'];
 
    $show2="SELECT * from addcart WHERE id_user=$iduser";
    $res2=mysqli_query($con,$show2);
    $flag=0;
    while($row2=mysqli_fetch_assoc($res2)){
        $id=$row2['id_p'];
        $show3="SELECT * FROM products WHERE ID_p=$id";
        $res4=mysqli_query($con,$show3);
        $row4=mysqli_fetch_assoc($res4);
        $Newprod_quantity=$row4['quantity']-$row2['quantity'];
  
       $total=$row2['price']*$row2['quantity'];
    
       $dateorder=date("d/m/y");
       $name=$row2['name'];
      
       $quantity=$row2['quantity'];
        $addhistory="INSERT INTO  history_of_orders(id_user,id_p,name,price,quantity,date_order,total) VALUES('$iduser','$id','$name','$total','$quantity','$dateorder','$total') ";
        $res=mysqli_query($con,$addhistory);
        $update_quantity="UPDATE products  set quantity=$Newprod_quantity WHERE ID_p=$id " ;
        $res3=mysqli_query($con,$update_quantity);
        $flag=1;
    
        $_SESSION['total']=0;
    }
 }
}

$purchase_amount = $total; // this is the amount of the purchase in dollars
$coins_per_dollar = 0.1; // this is the exchange rate of dollars to coins
$coins_to_add = $purchase_amount * $coins_per_dollar;

if($flag==1){
    $empty = "DELETE FROM addcart WHERE id_user=$iduser";
    $res5 = mysqli_query($con, $empty);
    $query = "SELECT ID_u, coins FROM userss WHERE ID_u='$iduser'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $iduser = $row['ID_u'];
        $user_coins = $row['coins'];
        $new_user_coins = $user_coins + $coins_to_add;

        $query3 = "UPDATE userss SET coins='$new_user_coins' WHERE ID_u='$iduser'";
        $res3 = mysqli_query($con, $query3);

       
    }

    echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Well done!</h4>
            Your payment were successfully done.
          </div>';
}






?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Add MDB CSS -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 

<style>
    .form-container{
        max-width: 500px;
    }
    .form-containerr{
        max-height: 500px;
    }
    .alert-container {
    position: fixed;
    top: 5px;
    right: 5px;
    z-index: 9999; /* Make sure the alerts appear on top of everything else */
    width: 200px;
}

.alert-heading {
    font-size: 1.01rem;
}
body {
  overflow: hidden; /* Hide scrollbars */
}

</style>
<body>
    <div class="container py-5 form-container">
        <div class="card shadow-lg">
            <div class="card-body bg-dark text-white ">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['payment.php']); ?>">
                    <h2 class="text-center mb-4">Continue Payment</h2>
                    
                    <div class="mb-4">
                        <input type="text" name="name" class="form-control" placeholder="Name of cardholder">
                    </div>
                    <div class="mb-4">
                        <input type="text" name="numcard" class="form-control" placeholder="Number of card">
                    </div>
                    <div class="mb-4">
                        <input type="text" min="1" name="cvv" class="form-control" placeholder="CVV">
                    </div>
                    <div class="mb-4">
                        <label>Date</label>
                        <div class="row">
                            <div class="col-6">
                                <select name="mouth" class="form-control">
                                    <?php for($i=1; $i<=12; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="year" class="form-control">
                                    <?php for($i=24; $i<=29; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <input type="text"autocomplete="off" min="1" name="coins" class="form-control" placeholder="use coins">
                    </div>
                    <button name="pay" type="submit" class="btn btn-warning w-100 mb-3">Confirm Payment</button>
                    <button name="paycoins" type="submit" class="btn btn-warning w-100 mb-3">Apply coins discount</button>
                    <p class="text-center font-weight-bold">You have to pay <?php echo $_SESSION['total']; ?>$</p>
                    <a href="Shop.php" class="btn btn-warning w-100 mb-3">Back to shop</a>
                    <input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>">
                </form>
            </div>
        </div>
    </div>
    <!-- Add MDB JS -->
 
</body>

</html>
