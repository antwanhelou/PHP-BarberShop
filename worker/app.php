<?php
include '../DBconnect.php';
include 'index.php';

session_start();
$id_worker=$_SESSION['ID_u'];

// if (isset($_POST['cancel_day_btn'])) {
//     $selectedDay = $_POST['cancel_day'];
    
//     // Query to cancel all appointments for the selected day
//     $cancel_query = "DELETE FROM history_of_queues WHERE id_userW = $id_worker AND date = '$selectedDay'";
//     $cancel_result = mysqli_query($con, $cancel_query);

//     if ($cancel_result) {
//         echo 'All appointments for ' . $selectedDay . ' have been canceled.';
//     } else {
//         echo 'Failed to cancel appointments for ' . $selectedDay . '.';
//     }
// }
if (isset($_POST['cancel_day_btn'])) {
    $selectedDay = $_POST['cancel_day'];

    // Insert the canceled day into history_of_canceled table
    $insert_cancel_query = "INSERT INTO history_of_canceled (worker_id, date) VALUES ('$id_worker', '$selectedDay')";
    $insert_cancel_result = mysqli_query($con, $insert_cancel_query);
    $cancel_query = "DELETE FROM history_of_queues WHERE id_userW = $id_worker AND date = '$selectedDay'";
    $cancel_result = mysqli_query($con, $cancel_query);

    if ($insert_cancel_result) {
        echo '<script>alert("The selected day has been canceled and all its appointments.");</script>';
        // Refresh the page to reflect the updated information
       
    } else {
        echo 'Failed to cancel and add the day to the history of canceled days.';
    }
}

$query = "SELECT history_of_queues.ID_q, history_of_queues.time, history_of_queues.date, Userss.name, Userss.email 
          FROM history_of_queues 
          INNER JOIN Userss ON history_of_queues.id_user = Userss.ID_u 
          WHERE history_of_queues.id_userW = $id_worker ORDER BY date DESC";
          $result = mysqli_query($con, $query);
          date_default_timezone_set("Asia/jerusalem");
         $currentTime= date("H");
         $currentDate = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="thead-dark">Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<style>body {
            font-family: Arial, sans-serif; /* Set a font */
            font-size: 16px; /* Set a font size */
            font-weight: bolder
        }
        th, td, tr {
            font-size: 1.05rem;
            font-weight: bolder; /* Increase the font size of table headers and cells */
        }</style>
<body>
    <div class="container mt-5">
        <div class="mb-4 text-center text-white">
            <h2 class="text-dark">Appointments</h2>
        </div>
        <div class="container mt-5">
            <form method="post">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Time</th>
                            <th scope="col">Date</th>
                            <th scope="col">Cancel appointment </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <div class="container mt-5">
        
        <div class="container mt-3">
            <form method="post">
                <div class="form-group">
                    <label for="cancel_day">Choose a day to cancel appointments:</label>
                    <input type="date" class="form-control" id="cancel_day" name="cancel_day" required>
                </div>
                <button type="submit" class="btn btn-danger" name="cancel_day_btn">Cancel Appointments for Day:</button>
            </form>
        </div>
    </div>
    <?php
   if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr class="bg-white">';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['time'] . '</td>';
        echo '<td>' . $row['date'] . '</td>';
        echo '<td>
                  <form method="post" >
                      <input type="hidden" name="name" value="' . $row['name'] . '">
                      <input type="hidden" name="email" value="' . $row['email'] . '">
                      <input type="hidden" name="time" value="' . $row['time'] . '">
                      <input type="hidden" name="date" value="' . $row['date'] . '">
                      <input type="hidden" name="appointment_id" value="' . $row['ID_q'] . '">';
                      echo '<form method="post">';
                      echo '<input type="hidden" name="cancel_day" value="' . $row['date'] . '">';
                      if ($currentDate < $row['date'] || ($currentDate == $row['date'] && $currentTime < $row['time'])) {// if the the time == currentTime and date== currentdate 
                        // prevent to cancel the apointment else can cancel
                        echo '<input type="submit" class="btn btn-danger" name="cancel" value="Cancel">';
                    } else {
                        echo 'Time to cancel has passed';
                    }
        echo '</form></td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="5">No appointments found</td></tr>';

}
    ?>
</tbody>
                </table>
            </form>
        </div>
    </div>
 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
</body>
</html>
<?php
if (isset($_POST['cancel'])) {
    $email = $_POST['email'];  
    $selectIdUser = "SELECT * FROM userss WHERE email='$email'";
    $res_selectIdUser = mysqli_query($con, $selectIdUser);
    $user = mysqli_fetch_assoc($res_selectIdUser);
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['time'] = $_POST['time'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['date'] = $_POST['date'];
    $_SESSION['iduser'] = $user['ID_u'];

    echo ' <script>window.open("cancelApointment.php", "_self", "width=200,height=100");</script>';// page for confirm the cancel
}

?>