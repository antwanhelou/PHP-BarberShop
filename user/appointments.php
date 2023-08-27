<?php
include '../DBconnect.php';
include 'index.php';

session_start();
// Retrieve the 'ID_u' from the session and store it in the $iduser variable
$iduser = $_SESSION['ID_u'];

// Select all rows from the 'history_of_orders' table where the 'id_user' matches the $iduser
$orders = "SELECT * FROM history_of_orders WHERE id_user=$iduser";

$result = mysqli_query($con, $orders);

// Select all data from the 'history_of_queues' table and include the 'name' field from the 'userss' table as 'worker_name'
// Also, perform an inner join between 'history_of_queues' and 'userss' tables using the condition 'id_userW = ID_u'
// to get the name of the worker associated with each appointment.
$appointments = "SELECT history_of_queues.*, userss.name as worker_name 
                FROM history_of_queues 
                INNER JOIN userss ON history_of_queues.id_userW = userss.ID_u 
                WHERE history_of_queues.id_user = $iduser 
                ORDER BY date DESC";

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
<body>

<?php
echo '
<div class="container mt-5">
  <table class="table table-striped table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Appointment Date</th>
        <th scope="col">Appointment Time</th>
        <th scope="col">Barber</th>
        <th scope="col">Cancel</th>
      </tr>
    </thead>
    <tbody>';

// Fetch the appointment data from the query result using a loop
$appointment_result = mysqli_query($con, $appointments);
while ($appointment = mysqli_fetch_assoc($appointment_result)) {
    // Check if the appointment time has passed
    $currentDateTime = new DateTime();
    $appointmentDateTime = new DateTime($appointment['date'] . ' ' . $appointment['time'] . ':00');
    $disableCancel = ($currentDateTime >= $appointmentDateTime) ? true : false;

    echo '<tr class="bg-white">
        <td>' . $appointment['date'] . '</td>
        <td>' . $appointment['time'] . ':00</td>
        <td>' . $appointment['worker_name'] . '</td>
        <td>';

    if ($disableCancel) {
        echo "Can't Cancel";
    } else {
        echo '<button class="btn btn-dark edit-appointment-btn" data-appointment-id="' . $appointment['ID_q'] . '">Cancel</button>';
    }

    echo '</td></tr>';
}
echo '</tbody></table></div>';
?>

<!-- Edit appointment modal -->
<div class="modal" tabindex="-1" id="editAppointmentModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cancel Appointment</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to cancel this appointment?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="cancelAppointmentBtn">Cancel Appointment</button>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript code -->
<script>
// Initialize the Bootstrap modal instance
const editAppointmentModal = new bootstrap.Modal(document.getElementById("editAppointmentModal"));

function editAppointment(appointmentId) {
  selectedAppointmentId = appointmentId;
  editAppointmentModal.show();
}

document.addEventListener("DOMContentLoaded", function () {
  // Attach click event listener to edit appointment buttons
  const editAppointmentBtns = document.querySelectorAll(".edit-appointment-btn");

  editAppointmentBtns.forEach(function (btn) {
    btn.addEventListener("click", function () {
      const appointmentId = btn.getAttribute("data-appointment-id");
      editAppointment(appointmentId);
    });
  });

  // Attach click event listener to cancel appointment button
  document.getElementById("cancelAppointmentBtn").addEventListener("click", function () {
    if (selectedAppointmentId) {
      $.ajax({
        url: "delete_appointment.php",
        type: "POST",
        data: {
          appointment_id: selectedAppointmentId,
        },
        success: function (response) {
          if (response.trim().includes("success")) {
            location.reload();
          } else {
            alert("Error: Could not cancel the appointment. Please try again.");
          }
        },
      });
    }
  });
});
</script>

</body>
</html>
