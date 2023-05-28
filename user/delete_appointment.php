<?php
include '../DBconnect.php';

if (isset($_POST['appointment_id'])) {
  $appointment_id = $_POST['appointment_id'];
  $sql = "DELETE FROM history_of_queues WHERE ID_q=$appointment_id";
  
  if ($con->query($sql)) {
    echo 'success';
  } else {
    echo 'error';
  }
} else {
  echo 'error';
}
$con->close();
?>
