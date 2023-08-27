<?php
// Start the session to access session variables
session_start(); 

// Include the 'DBconnect.php' file to establish a connection to the database
include '../DBconnect.php';
// Include the 'index.php' file, although the purpose of including it here is not clear from the provided code
include 'index.php';

// Generate a unique form token for CSRF protection, if it doesn't exist in the session
if (!isset($_SESSION['form_token'])) {
    $_SESSION['form_token'] = bin2hex(random_bytes(32));
}

// If there is a discounted total in the session, set it as the total
if (isset($_SESSION['discounted_total'])) {
    $_SESSION['total'] = $_SESSION['discounted_total'];
}
?>

<?php
// Retrieve data sent via POST method and store them in respective variables
$coins_pay = $_POST['coins'];
$cvv = $_POST['cvv'];
$numcard = $_POST['numcard'];
$flag = 0;
$iduser = $_SESSION['ID_u'];

// Fetch the user's current coins from the database
$query = "SELECT coins FROM userss WHERE ID_u='$iduser'";
$result = mysqli_query($con, $query);
$user_data = mysqli_fetch_assoc($result);
$user_coins = $user_data['coins'];

// Check if the user has any coins available to use
if ($user_coins > 0) {
    // Check if the 'paycoins' button was pressed and the form token is valid 
    if (isset($_POST['paycoins']) && isset($_POST['form_token'])) {
        if ($_POST['form_token'] === $_SESSION['form_token']) {
            // Fetch the user's coins from the database again to get the most up-to-date value
            $query = "SELECT coins FROM userss WHERE ID_u='$iduser'";
            $result = mysqli_query($con, $query);
            $user_data = mysqli_fetch_assoc($result);
            $user_coins = $user_data['coins'];

            // Check if the user has enough coins and apply the discount
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
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">Note: You cannot use more coins than you have</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }

            // Unset the form token to prevent form resubmission
            unset($_SESSION['form_token']);
        }
        // Redirect to the 'payment.php' page after processing the coins payment
        header('Location: ' . $_SERVER['payment.php']);
        exit;
    }  
}
else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <p class="alert-heading">Note: You have no coins available</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

// Check if the 'pay' button was pressed for credit card payment
if (isset($_POST['pay'])) {
    // Validate the CVV and card number using regular expressions
    if (!(preg_match(('/^[0-9]{3,4}$/'), $cvv)) || $cvv == "") {
        echo '<div class="alert alert-danger" role="alert">
            <strong>CVV!</strong> Enter correct cvv.
          </div>  ';
    } else if (!(preg_match(('/^4[0-9]{12}(?:[0-9]{3})?$/'), $numcard)) || $numcard == "") {
        echo '<div class="alert alert-danger" role="alert">
            <strong>Card number!</strong> Enter correct card number.
          </div> ';
    } else {
        // Payment processing logic here
        

        // After processing the payment and updating the database, set the $flag to 1 if payment was successful
        $flag = 1;

        // Reset the 'total' session variable to 0 after the order is completed
        $_SESSION['total'] = 0;
    }
}

// Calculate the number of coins to add to the user's balance based on the purchase amount and the exchange rate
$purchase_amount = $total; // This is the amount of the purchase in dollars
$coins_per_dollar = 0.1; // This is the exchange rate of dollars to coins 
$coins_to_add = $purchase_amount * $coins_per_dollar;

// If the $flag is 1, it means the payment was successful and we can add coins to the user's balance
if ($flag == 1) {
    // Clear the shopping cart after successful payment
    $empty = "DELETE FROM addcart WHERE id_user=$iduser";
    $res5 = mysqli_query($con, $empty);

    // Fetch the user's ID and current coins from the database
    $query = "SELECT ID_u, coins FROM userss WHERE ID_u='$iduser'";
    $result = mysqli_query($con, $query);

    // Check if there are rows in the result
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $iduser = $row['ID_u'];
        $user_coins = $row['coins'];

        // Calculate the new coins balance for the user after the purchase
        $new_user_coins = $user_coins + $coins_to_add;

        // Update the user's coins in the database
        $query3 = "UPDATE userss SET coins='$new_user_coins' WHERE ID_u='$iduser'";
        $res3 = mysqli_query($con, $query3);

        // Display a success message
        echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                Your payment was successful.
              </div>';
    }
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.12.0/mdb.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
<!-- Add Font Awesome -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 

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
                    <p class="text-center font-weight-bold">You have to pay <?php
                    $total=$_SESSION['total'];
                     echo $total; ?>$</p>
                    <a href="Shop.php" class="btn btn-warning w-100 mb-3">Back to shop</a>
                    <input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>">
                </form>
            </div>
        </div>
    </div>
    <!-- Add MDB JS -->
 
</body>

</html>