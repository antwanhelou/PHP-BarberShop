<?php include '../DBconnect.php';
session_start();
  $name=$_SESSION['name'];
  $time=$_SESSION['time'];
 $email= $_SESSION['email'];
  $date=$_SESSION['date'];
  $iduser=$_SESSION['iduser'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Appointment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            color: #333;
        }

        .confirmation-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .confirmation-info {
            text-align: center;
            margin-top: 30px;
            font-size: 18px;
        }

        .confirmation-info p {
            margin-bottom: 15px;
        }

        .btn-container {
            text-align: center;
            margin-top: 30px;
        }

        .cancel-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .cancel-btn:hover {
            background-color: #c82333;
        }
        .no-cancel-btn{
            background-color: #FFC500;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Are you sure you want to cancel the appointment for:</h1>
    <div class="confirmation-container">
        <div class="confirmation-info">
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Time:</strong> <?php echo $time; ?></p>
            <p><strong>Date:</strong> <?php echo $date; ?></p>
           
        </div>
        <div class="btn-container">
            <form method="post" >
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="time" value="<?php echo $time; ?>">
                <input type="hidden" name="date" value="<?php echo $date; ?>">
                <input type="submit" class="cancel-btn" name="confirm_cancel" value="Yes" ></input>
                <input type="submit" class="no-cancel-btn" name="no" value="No" ></input>
            </form>
         </div>
    </div>
</body>

</html>
<?php 
if (isset($_POST['confirm_cancel'])) {// if pressed on yes the apointment will cancel and go back to apointments page of worker
    $cancelAppointment = "DELETE FROM history_of_queues WHERE id_user = '$iduser' AND date = '$date' AND time = '$time'";
    $res_cancelAppointment = mysqli_query($con, $cancelAppointment);
    if ($res_cancelAppointment) {
        echo '<script> alert("Appointment canceled successfully");</script>';  
    }
    echo ' <script>window.open("app.php", "_self", "");</script>';

}
if(isset($_POST['no']))  //if pressed on no go back to apointments page of worker
{
    echo ' <script>window.open("app.php", "_self", "");</script>';

}
?>
