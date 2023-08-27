<?php

include '../DBconnect.php';

// Check if the 'appointment_id' parameter is set in the POST request
if (isset($_POST['appointment_id'])) {
  // Retrieve the 'appointment_id' from the POST data and store it in the $appointment_id variable
  $appointment_id = $_POST['appointment_id'];

  // Construct the SQL query to delete the appointment from the 'history_of_queues' table where 'ID_q' matches the specified 'appointment_id'
  $sql = "DELETE FROM history_of_queues WHERE ID_q=$appointment_id";

  // Execute the SQL query using the database connection ($con) and the query() method

  if ($con->query($sql)) {
    echo 'success';
  } else {
    echo 'error';
  }
} else {
  // If the 'appointment_id' parameter is not set in the POST request, echo 'error'
  echo 'error';
}

// Close the database connection
$con->close();
?>
