<?php
include '../DBconnect.php';

session_start();
$iduser = $_SESSION['ID_u'];

$clear_history = "DELETE FROM history_of_orders WHERE id_user=$iduser";
$result = mysqli_query($con, $clear_history);

if($result){
    // redirect to the history page after clearing the history
    header("Location:historyorders.php"); 
} else {
    echo "Error clearing history: " . mysqli_error($con);
}

mysqli_close($con);
?>
