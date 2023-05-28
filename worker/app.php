<?php
include '../DBconnect.php';
include 'index.php';
session_start();
$id_worker=$_SESSION['ID_u'];
$query = "SELECT history_of_queues.ID_q, history_of_queues.time, history_of_queues.date, Userss.name, Userss.email 
          FROM history_of_queues 
          INNER JOIN Userss ON history_of_queues.id_user = Userss.ID_u 
          WHERE history_of_queues.id_userW = $id_worker";
          $result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
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
            <h2>Appointments</h2>
        </div>
        <div class="container mt-5">
  <table class="table table-striped table-hover">
    <thead class="thead-dark">
      <tr>
       <strong> <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Time</th>
        <th scope="col">Date</th>
        </strong>
      </tr>
    </thead>
    <tbody>
                <?php
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<tr class=bg-white>';
                      
                        echo '<strong><b><td>' . $row['name'] . '</td></b></strong>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['time'] . '</td>';
                        echo '<td>' . $row['date'] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No appointments found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
</body>
</html>
