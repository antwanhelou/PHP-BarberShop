<?php

include '../DBconnect.php';
// Include the 'index.php' file, although the purpose of including it here is not clear from the provided code
include 'index.php';

// Retrieve data sent via POST method and store them in respective variables
$numcard = $_POST['numcard'];
$cvv = $_POST['cvv'];

// Function to send a confirmation email to the user
function send_confirmation_email($to, $date, $time, $barber_name) {
    $subject = "Reservation Confirmation";
    $message = "Hello,\n\nYour reservation has been confirmed!\n\nDate: {$date}\nTime: {$time}\nBarber: {$barber_name}\n\nThank you for choosing our services!";
    $headers = "From: helou527@gmail.com\r\n";
  
    // Attempt to send the email using PHP's mail() function and check if it was successful
    if (mail($to, $subject, $message, $headers)) {
        
    } else {
        echo "Failed to send the confirmation email.";
    }
}

// Check if the 'pay' button was pressed (payment is being confirmed)
if (isset($_POST['pay'])) {
    // Validate the card number and CVV using regular expressions
    if (!(preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $numcard)) || $numcard == "") {
        echo '<div class="alert alert-danger" role="alert">
                <strong>Card number!</strong> Enter correct card number.
              </div>';
    } else if (!(preg_match('/^[0-9]{3,4}$/', $cvv)) || $cvv == "") {
        echo '<div class="alert alert-danger" role="alert">
                <strong>CVV!</strong> Enter correct cvv.
              </div>';
    } else {
        // Start the PHP session to access session variables
        session_start();
        // Retrieve various session variables and store them in variables
        $customer = $_SESSION['customer'];
        $time = $_SESSION['time'];
        $date_selected = $_SESSION['date'];
        $barber = $_SESSION['barbers'];
        $barber_name = $_SESSION['barber_name'];
        $emailuser = $_SESSION['email'];

        // Construct the SQL query to insert the appointment into the 'history_of_queues' table
        $add = "INSERT INTO history_of_queues (time, id_user, id_userW, date) VALUES ($time, $customer, $barber, '$date_selected')";
        // Execute the SQL query using the mysqli_query function with the database connection ($con)
        $res = mysqli_query($con, $add);

        // Check if the appointment insertion was successful
        if ($res) {
            $barber_name = "";
            // Construct the SQL query to retrieve the barber's name from the 'Userss' table where 'ID_u' matches the barber's ID
            $barber_sql = "SELECT name FROM Userss WHERE ID_u = $barber";

            // Execute the SQL query to get the barber's name using the mysqli_query function with the database connection ($con)
            $barber_result = mysqli_query($con, $barber_sql);
            // Fetch the data from the query result into the $barber_row variable as an associative array
            if ($barber_row = mysqli_fetch_assoc($barber_result)) {
                // Store the barber's name in the $barber_name variable
                $barber_name = $barber_row["name"];
            }

            // Call the send_confirmation_email function to send a confirmation email to the user
            send_confirmation_email($emailuser, $date_selected, $time, $barber_name);

            // Display a success message to the user and open the 'appointments.php' page
            echo '<div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    Your appointment was successfully added, Confirmation email has been sent.
                    <script>window.open("appointments.php");</script>
                  </div>';

            // Reset the 'total' session variable to 0 (the purpose of this variable is not clear from the provided code)
            $_SESSION['total'] = 0;
        }
    }
}
?>

<script></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Add MDB CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
  <style>
  
        .form-container {
            max-width: 500px;
        }
        .form-containerr {
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
</head>
<body>
    <div class="container py-5 form-container">
        <div class="card shadow-lg">
            <div class="card-body bg-dark text-white">
                <form method="POST">
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
                                <select name="month" class="form-control">
                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="year" class="form-control">
                                    <?php for ($i = 24; $i <= 29; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input name="pay" type="submit" class="btn btn-warning w-100 mb-3" value="Confirm Payment">
                    <p class="text-center font-weight-bold">You have to pay 15$</p>
                    <a href="Shop.php" class="btn btn-warning w-100 mb-3">Back to shop</a>
                </form>
            </div>
        </div>
    </div>
    <!-- Add MDB JS -->

</body>
</html>