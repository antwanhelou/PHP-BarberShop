<?php
// Include the 'DBconnect.php' file to establish a connection to the database
include '../DBconnect.php';


session_start();

// Retrieve the 'ID_u' from the session and store it in the $iduser variable
$iduser = $_SESSION['ID_u'];

// Construct the SQL query to delete all rows from the 'history_of_orders' table where 'id_user' matches the user's ID
$clear_history = "DELETE FROM history_of_orders WHERE id_user=$iduser";

// Execute the SQL query using the mysqli_query function with the database connection ($con) and store the result in $result
$result = mysqli_query($con, $clear_history);

// Check if the deletion was successful
if ($result) {
    // If the deletion was successful, redirect the user to the 'historyorders.php' page
    header("Location: historyorders.php"); 
} else {
    // If there was an error in the deletion process, display the error message along with the error details using mysqli_error
    echo "Error clearing history: " . mysqli_error($con);
}


mysqli_close($con);
?>
