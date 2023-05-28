<?php
include '../DBconnect.php';
include 'index.php';

session_start();
$iduser = $_SESSION['ID_u'];

$orders = "SELECT * FROM history_of_orders WHERE id_user=$iduser";
$result = mysqli_query($con, $orders);

$appointments = "SELECT * FROM history_of_queues WHERE id_user=$iduser";
$appointment_result = mysqli_query($con, $appointments);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
</head>
<style>
        body {
            font-family: Arial, sans-serif; /* Set a font */
            font-size: 16px; /* Set a font size */

        }
        th, td, tr{
            font-size: 1.05rem; /* Increase the font size of table headers and cells */
            font-weight: bolder;
        }
    </style>
<body>
    <div class="container mt-5">
        <button class="btn btn-dark" onclick="clearHistory()">Clear History</button>
        <table class="table table-striped table-responsive-sm">
            <thead class="thead-dark">
                <tr class="bg-white">
                    <th scope="col" >Name of product</th>
                    <th scope="col">Quantity of product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Date of order</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <tr class="bg-white">
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['quantity'] . '</td>
                    <td>' . $row['price'] . '</td>
                    <td>' . $row['date_order'] . '</td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function clearHistory() {
            if(confirm("Are you sure you want to clear your history? This action cannot be undone.")) {
                window.location.href = "clear_history.php";
            }
        }
    </script>

</body>

</html>
