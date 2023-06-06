<?php
include '../DBconnect.php';
include 'index.php';

session_start();
$iduser = $_SESSION['ID_u'];

$orders = "SELECT * FROM history_of_orders WHERE id_user=$iduser";
$result = mysqli_query($con, $orders);
$appointments = "SELECT history_of_queues.*, userss.name as worker_name FROM history_of_queues INNER JOIN userss
 ON history_of_queues.id_userW = userss.ID_u WHERE history_of_queues.id_user=$iduser";

$appointment_result = mysqli_query($con, $appointments);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointments</title>
  

</head>
<body>

<?php
// ...

echo '
<div class="container mt-5">
  <table class="table table-striped table-hover">
    <thead class="thead-dark">
      <tr>
       <strong> <th scope="col">Appointment Date</th>
        <th scope="col">Appointment Time</th>
        <th scope="col">Barber</th>
        <th scope="col">Cancel</th>
        </strong>
      </tr>
    </thead>
    <tbody>';

$appointment_result = mysqli_query($con, $appointments);
while ($appointment = mysqli_fetch_assoc($appointment_result)) {
  echo '
      <tr class="bg-white">
      <strong>  <td> <strong><b>' . $appointment['date'] . '</td></b></strong>
        <td> <strong><b>' . $appointment['time'] . ':00</td></b></strong>
        <td> <strong><b>' . $appointment['worker_name'] . '</td></b></strong>
        <td><button  class="btn btn-dark edit-appointment-btn" data-appointment-id="' . $appointment['ID_q'] . '">Cancel</button></td>
      </tr></strong>';
}
echo '
    </tbody>
  </table>
</div>';

// ...



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

      <button type="button" class="btn btn-danger"  id="cancelAppointmentBtn">Cancel Appointment</button>


      </div>
    </div>
  </div>
</div>

<!-- JavaScript code -->
<script>
// Initialize the Bootstrap 5 modal instance
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
 
  
  if (response.trim().includes("success")) { // Check if the response contains "success"
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

