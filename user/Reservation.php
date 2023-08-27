<?php

  include '../DBconnect.php'; 
  include 'index.php';
  include './Login.php';
  session_start();
  // Query to fetch all records from the "history_of_queues" table
  $customer= $_SESSION['ID_u'];
  $sql="SELECT * FROM history_of_queues";
  $r=mysqli_query($con,$sql);
  $num= mysqli_num_rows($r);
  $choosed=false;
  $branch='';
  $id_branch='';
  $iduser = $_SESSION['email'];

  // Function to send appointment confirmation email
  function send_confirmation_email($to, $date, $time, $barber_name) {
    $subject = "Reservation Confirmation";
    $message = "Hello,\n\nYour reservation has been confirmed!\n\nDate: {$date}\nTime: {$time}\nBarber: {$barber_name}\n\nThank you for choosing our services!";
    $headers = "From: helou527@gmail.com\r\n";
  
    if (mail($to, $subject, $message, $headers)) {
      echo "Confirmation email sent successfully.";
    } else {
      echo "Failed to send the confirmation email.";
    }
  }
?>

<form style="margin: 15px;"   method="POST" >
  <!-- Dropdown to select the branch/area -->
<select  name="choose_area" class="select"style="width:200px;"id="area">
<?php
  $branch="SELECT * FROM branchs  ";
  $res_branch=mysqli_query($con,$branch);
while($row=mysqli_fetch_assoc($res_branch))
{
  ?>
    <option value=" <?php echo ($row['city'])  ?>  "><?php   echo  $row['city']  ?></option>
  <?php }?>

</select>
<input  type="submit" class="btn btn-dark"  value="choose area" name="area"  />
<?php  
if (isset($_POST['choose_area'])) {
  $choosed = true;
  $branch =  trim( $_POST['choose_area']);
  $b = "SELECT ID_branch FROM branchs WHERE city='$branch'";
  $res_b = mysqli_query($con, $b);
  $row = mysqli_fetch_assoc($res_b);
  //$id_branch = $row['ID_branch'];
  $_SESSION['id_branch']=$row['ID_branch'];
 
 // echo "Selected Branch: " '. $branch .'" <br>";
}
  
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
  <style>
    form {
   
      color: #fff;
    }
    .card {
      background-color: #343a40;
    }
    .card-text {
      color: #ccc;
    }
    .table-dark {
      color: #ccc;
      background-color: #343a40;
    }
    .select-wrapper {
    position: relative;
    display: inline-block;
    user-select: none;
  }

  .select {
    display: inline-block;
    padding: 10px;
    background-color: #f1f1f1;
    color: #000;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    z-index: 1;
  }

  .select select {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
  }

  .select::after {
    content: "\f078";
    font-family: "FontAwesome";
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    pointer-events: none;
  }

  .select.open::after {
    content: "\f077";
  }

  .select-items {
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    border-top: none;
    border-radius: 4px;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 3;
    overflow-y: auto;
    max-height: 200px;
  }

  .select-items div {
    padding: 10px;
    cursor: pointer;
  }

  .select-items div:hover {
    background-color: #f1f1f1;
  }
    
   
  </style>
  
<form    method="POST" >
<?php if ($choosed == true) { ?>
  <!-- Display a select dropdown for barbers if the $choosed variable is true -->
  <select name="barbers" class="select" id="barbers">
    <?php
      // Retrieve the chosen area value from the POST data
      $area_selected = trim($_POST['choose_area']);
      
      // Retrieve the branch ID from the session
      $id_branch = $_SESSION['id_branch'];
      
      // Query to fetch all barbers from the Userss table who belong to the selected branch
      $barbers = "SELECT * FROM Userss WHERE ID_branch = '$id_branch'";
      
      // Execute the query to get the list of barbers
      $res_barbers = mysqli_query($con, $barbers);
      
      // Loop through the query result to populate the select dropdown options
      while ($row = mysqli_fetch_assoc($res_barbers)) {
    ?>
      <!-- Generate an option for each barber with their ID as the value and their name as the displayed text -->
      <option value="<?php echo trim($row['ID_u']) ?>"><?php echo $row['name'] ?></option>
    <?php
      }
    ?>
  </select>


      
  <input type="submit" class="btn btn-dark" data-mdb-ripple-color="dark" value="Select barber" name="select"  />
    <?php   }
      if(isset($_POST['select'])){      
        if(!empty($_POST['barbers'])) {
          $_SESSION['worker']=$_POST['barbers'];
        }
      }
    ?>
  <script type="text/javascript"> // keep the selected value for name barber
    document.getElementById('barbers').value = "<?php echo $_POST['barbers'];?>";
    document.getElementById('area').value = "<?php echo $_POST['choose_area'];?>";

    function onFormSubmit() {
  event.preventDefault();
  return false;

}
  </script>
 
 <form method="POST">
  <table class="table">
    <thead class="table-dark">
    <td><td>
    <tr>
      <?php
        // Generate an array of the next 7 days starting from today
        $date = date('Y-m-d'); // Today's date
        $weekOfdays = array();
        for ($i = 1; $i <= 7; $i++) {
          $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
          $dt = date('Y-m-d', strtotime($date));
          array_push($weekOfdays, $dt);
        }

        // Retrieve the selected barber from the form submission
        $_SESSION['worker'] = $_POST['barbers'];
        $selected_barber = $_SESSION['worker'];

        // Query to fetch existing appointments for the selected barber
        $date2 = "SELECT * FROM history_of_queues  WHERE id_userW=$selected_barber ";
        $res = mysqli_query($con, $date2);

        // Store the existing appointments in an array
        $queues = array();
        while ($row = mysqli_fetch_assoc($res)) {
          $arr = array();
          $arr['date'] = $row['date'];
          $arr['time'] = $row['time'];
          $queues[] = $arr;
        }

        // Generate an array of date-time pairs for all possible appointments in the next 7 days
        $checks = array();
        $arr2 = array();
        for ($i = 0; $i < sizeof($weekOfdays); $i++) {
          for ($j = 11; $j < 23; $j++) {
            $arr2 = array();
            $arr2['date'] = $weekOfdays[$i];
            $arr2['time'] = $j;
            $checks[] = $arr2;
          }
        }

        // Filter out the booked appointments from the list of possible appointments
        for ($i = 0; $i < 7; $i++) {
          if (isset($queues)) {
            for ($j = 0; $j < sizeof($checks); $j++) {
              if ($checks[$j]['time'] == $queues[$i]['time'] && $checks[$j]['date'] == $queues[$i]['date']) {
                unset($checks[$j]['date']);
                unset($checks[$j]['time']);
              }
            }
          }
        }
      ?>
    </tr>
    <div class="container mt-5">
      <div class="card-group">
        <?php
          // Remove any empty elements from the $checks array
          $apo = array_filter($checks);

          // Loop through each day in the next 7 days
          for ($i = 0; $i < 7; $i++) {
        ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                <!-- Radio button to select the appointment date -->
                <input type="radio" name="date1" value="<?php echo ($weekOfdays[$i])?>" required/>
                <p id="<?php echo $weekOfdays[$i]; ?>" name="dates" id="<?php $weekOfdays[$i]; ?> " required>
                  <?php echo ' ', $weekOfdays[$i]; ?>
                </p>
              </h5>
              <p class="card-text">
                <?php
                  // Display available time slots for the selected day
                  $c = 0;
                  for ($j = 0; $j < sizeof($apo) + $num; $j++) {
                    if ($apo[$j]['date'] === $weekOfdays[$i]) {
                      echo '<input type="radio" name="times" id="times" value="' . $apo[$j]['time'] . '" ' . $apo[$j]["time"] . '" >',
                      ' ',
                      $apo[$j]['time'], '<br>';
                    }
                  }
                ?>
              </p>
            </div>
          </div>
        <?php
          }
        ?>
      </div>
      <center>
        <!-- Reset and submit buttons for the form -->
        <input type="reset" class="btn btn-light" data-mdb-ripple-color="dark" value="Clear ">
        <input type="submit" class="btn btn-light" data-mdb-ripple-color="dark" value="Add the appointment" name="addto" />
      </center>
    </div>
  </form>
  <?php
$hasReloaded = false;
if (isset($_POST['addto'])) {
    
    $success = 0;

    // Check if both the date and time are selected
    if (!empty($_POST['date1']) && !empty($_POST['times'])) {
        $time = $_POST['times'];
        $barber = $_POST['barbers'];
        $date_sel = $_POST['date1'];
        $customer = $_SESSION['ID_u'];

        // Validate the selected date to ensure it's not in the past.
        $selected_date = strtotime($date_sel);
        $current_date = time();

        if (date('Y-m-d', $selected_time) != date('Y-m-d', $selected_date_only)) {
            echo 'Sorry, you cannot select a date in the past.';
        } else {
            // Query to check if the selected time is available.
            $check_query = "SELECT COUNT(*) AS count FROM history_of_queues WHERE date = '$date_sel' AND time = '$time'";
            $check_result = mysqli_query($con, $check_query);
            $check_row = mysqli_fetch_assoc($check_result);
            $count = $check_row['count'];

            if ($count > 0) {
                echo '<h6 color="black">Sorry, this time slot is already taken.';
            } else {
                
                session_start();
                $_SESSION['customer'] = $_SESSION['ID_u'];
                $_SESSION['time'] = $_POST['times'];
                $_SESSION['date'] = $_POST['date1'];
                $_SESSION['barbers'] = $_POST['barbers'];

                // Redirect to the "payforapointment.php" page to proceed with payment.
                echo '<script>window.location.replace("payforapointment.php");</script>';

                //  $iduser contains the user's email address.
                $useremail = $iduser;
            }
        }
    } else {
        echo '<b class="text-dark">Please select a date and time slot.</b><br>';
    }
}

// value for $branch to fetch the map URL.
$map = "SELECT map FROM branchs WHERE city ='$branch'";
$res_map = mysqli_query($con, $map);
$num_rows = mysqli_num_rows($res_map);
$row = mysqli_fetch_assoc($res_map);

// Display the map URL
echo ' <b class="text-dark" > Location on map : </b><br>';
$mapUrl = $row['map'];
echo " " . $mapUrl . "<br>";
?>
