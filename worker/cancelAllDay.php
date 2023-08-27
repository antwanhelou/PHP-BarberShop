<?php
include 'index.php';
include 'DBconnect.php';

?>
 <style>
     .cancel-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
<center>
<h1> Select date that you want to cancel it all day</h1>
<form method="post" >
<input type="date" name="date"/><br>
<input type="submit" name="cancel" class="cancel-btn" value ="Confirm cancel"/>  
</form>
</center>
<?php 
if(isset($_POST['cancel'])){//  pressed on confirm cancel that will delete all apointments for this date
    $date_selected=$_POST['date'];// the selected date from form
    $cancel_apointment="DELETE FROM history_of_queues WHERE date='$date_selected'";
    $res_cancelAppointment=mysqli_query($con,$cancel_apointment);
    if($res_cancelAppointment){
        echo '<script> alert("Apointments for this date cancled successfuly");</script>';
    }
}

?>