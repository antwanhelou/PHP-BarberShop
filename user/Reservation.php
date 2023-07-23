<?php

  include '../DBconnect.php'; 
  include 'index.php';
  include './Login.php';
  session_start();
  $customer= $_SESSION['ID_u'];
  $sql="SELECT * FROM history_of_queues";
  $r=mysqli_query($con,$sql);
  $num= mysqli_num_rows($r);
  $choosed=false;
  $branch='';
  $id_branch='';
  $iduser = $_SESSION['email'];
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
<style></style>
<form style="margin: 15px;"   method="POST" >
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
  <?php if($choosed==true){ ?>
  <select name="barbers" class="select" id="barbers" >
    <?php  
      $area_selected= trim( $_POST['choose_area']);
      $id_branch=$_SESSION['id_branch'];
      $barbers ="SELECT * FROM Userss WHERE ID_branch ='$id_branch' ";
      $res_barbers=mysqli_query($con,$barbers);
      while($row=mysqli_fetch_assoc($res_barbers)){
        
      ?>
        <option  value=" <?php echo trim($row['ID_u'])  ?>  "><?php   echo  $row['name']  ?></option>
      <?php 
      
    }
      ?>
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
 
  <form  method="POST" >
  <table class="table">
    <thead class="table-dark">
    <td>  <td>
    <tr>
      <?php 
        $date = date('Y-m-d');
        $weekOfdays = array();
        for($i =1; $i <= 7; $i++){
          $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
          $dt= date('Y-m-d', strtotime($date));
          array_push($weekOfdays,$dt);
        }
       
        $_SESSION['worker']=$_POST['barbers'];
        $selected_barber=$_SESSION['worker'];
        $date2 = "SELECT * FROM history_of_queues  WHERE id_userW=$selected_barber ";
        $res = mysqli_query($con, $date2);
        while($row=mysqli_fetch_assoc($res)){
          $arr=array();
          $arr['date']=  $row['date'];
          $arr['time']=$row['time'];
          $queues[]=$arr;
        }
        $arr2=array();
        for($i=0;$i<sizeof($weekOfdays);$i++){
          for($j=11;$j<23;$j++){
            $arr2=array();
            $arr2['date']=$weekOfdays[$i];
            $arr2['time']=$j;
            $checks[]=$arr2;
          }
        }
    
       for($i=0;$i<7;$i++){
        if (isset($queues)) {
          for($j=0;$j<sizeof($checks);$j++){
            if($checks[$j]['time']==$queues[$i]['time'] && $checks[$j]['date']==$queues[$i]['date']  ){
              
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
          
      $apo = array_filter($checks);
    
      for($i=0;$i<7;$i++){  
      ?>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
              <input type="radio" name="date1" value="<?php echo ($weekOfdays[$i])?>" "/>   
              <p id="<?php echo $weekOfdays[$i]; ?>" name="dates" id="<?php $weekOfdays[$i]; ?> " required >
                <?php  echo ' ', $weekOfdays[$i];  ?>
              </p>
            </h5>
            <p class="card-text">  
              <?php 
                $c=0;
                for($j=0;$j<sizeof($apo)+$num;$j++){
                  if($apo[$j]['date']===$weekOfdays[$i]  ){   
                      echo '  <input type="radio" name="times" id="times"  value="'.$apo[$j]['time'].'" '    .
                      $apo[$j]["time"].'"   >',' ',
                      $apo[$j]['time'] ,'<br>'; 
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
      <input type="reset"  class="btn btn-light" data-mdb-ripple-color="dark"value="Clear ">
      <input type="submit"  class="btn btn-light" data-mdb-ripple-color="dark" value="Add the apointment" name="addto"  />
     </center>
  </form>
  <?php
  
  $hasReloaded = false;
  if (isset($_POST['addto'])) {
    // Assuming you have properly sanitized and validated $_POST data.
    $success = 0;

    if (!empty($_POST['date1']) && !empty($_POST['times'])) {
        $time = $_POST['times'];
        $barber = $_POST['barbers'];
        $date_sel = $_POST['date1'];
        $customer = $_SESSION['ID_u']; // Assuming you have the customer ID or fetch it appropriately.

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
                echo 'Sorry, this time slot is already taken.';
            } else {
                $add_query = "INSERT INTO history_of_queues (time, id_user, id_userW, date) VALUES ('$time', '$customer', '$barber', '$date_sel')";
                $res = mysqli_query($con, $add_query);

                if ($res) {
                    // Get the barber's name
                    $barber_name = "";
                    $barber_query = "SELECT name FROM Userss WHERE ID_u = $barber";
                    $barber_result = mysqli_query($con, $barber_query);
                    $barber_row = mysqli_fetch_assoc($barber_result);
                    $barber_name = $barber_row["name"];

                    // Assuming $iduser contains the user's email address.
                    $useremail = $iduser;
                    send_confirmation_email($useremail, $date_sel, $time, $barber_name);
                    echo '<script>window.location.replace("appointments.php");</script>';
                } else {
                    echo 'Failed to insert the appointment.';
                }
            }
        }
    } else {
        echo '<b class="text-dark">Please select a date and time slot.</b><br>';
    }
}

// Assuming you have a valid value for $branch to fetch the map URL.
$map = "SELECT map FROM branchs WHERE city ='$branch'";
  $res_map = mysqli_query($con, $map);
  $num_rows = mysqli_num_rows($res_map);
  $row = mysqli_fetch_assoc($res_map);
  
 
  echo ' <b class="text-dark" > Location on map : </b><br>';
      $mapUrl = $row['map'];
      echo " " . $mapUrl."<br>";  
?>
