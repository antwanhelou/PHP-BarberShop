<?php
include 'index.php';
session_start();

// Retrieve the 'ID_u' from the session and store it in the $iduser variable
$iduser = $_SESSION['ID_u'];

// Construct the SQL query to select all data from the 'userss' table where 'ID_u' matches the user's ID
$details = "SELECT * FROM userss WHERE ID_u=$iduser ";

// Execute the SQL query using the mysqli_query function with the database connection ($con) and store the result in $res
$res = mysqli_query($con, $details);

// Fetch a single row of data from the query result and store it in the $row variable as an associative array
$row = mysqli_fetch_assoc($res);
?>

 <style>
       
        .main{
            width:30%;
            padding:20px;
            box-shadow: 1px 1px 10px silver;
            margin-top:50px;
        }

        </style>
<div class="container">
<form method="POST" >
<div class="form-group">
    <label >Name</label>
    <input type="text" class="form-control"  name="name" value="<?php echo $row['name']?>  "  >

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" d name="email" aria-describedby="emailHelp" value=" <?php echo $row['email']?>" >
    <small id="emailHelp" class="form-text text-muted">Enter the email you want to contacts us from.</small>
  </div>
  <div class="form-group">
    <label >Your message</label>
    <input type="text" class="form-control" name="message"  placeholder="Your message" required >
  </div>
 
  
  <div class="form-group form-check">
  </div>
  <p>
  <button type="submit"  name="send" class="btn btn-dark">Send</button>
  

</form>


</div>
<?php

include 'DBconnect.php';

// Retrieve the data sent via POST method and store them in respective variables
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Check if the 'message' field is not empty (if the user submitted a message)
if ($message != "") {
    // Construct the SQL query to insert the user's contact information into the 'contactus' table
    $insertTo_contactus = "INSERT INTO contactus (name, email, message) VALUES ('$name', '$email', '$message')";

    // Execute the SQL query using the mysqli_query function with the database connection ($con) and store the result in $result
    $result = mysqli_query($con, $insertTo_contactus);

    // Check if the query was executed successfully
    if ($result) {
        // If the query was successful, display a success message to the user
        echo '<div class="alert alert-success" role="alert">
                Thank You For Contacting Us!
              </div>';
    } else {
        // If there was an error during the query execution, display an error message to the user
        echo '<div class="alert alert-danger" role="alert">
                Error: Unable to process your request. Please try again later.
              </div>';
    }
}


 



?>
