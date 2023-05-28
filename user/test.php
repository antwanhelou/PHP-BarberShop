<?php
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);
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
?>
<form    method="POST" >
<select name="choose_area" style="width:200px;"id="area">
<?php
  $branch="SELECT * FROM branchs";
  $res_branch=mysqli_query($con,$branch);
while($row=mysqli_fetch_assoc($res_branch))
{
  ?>
    <option value=" <?php echo ($row['city'])  ?>  "><?php   echo  $row['city']  ?></option>
  <?php }?>

</select>
<input type="submit" value="choose area" name="area"  />
<?php  
if (isset($_POST['choose_area'])) {
  $choosed = true;
  $branch =  trim( $_POST['choose_area']);
  $b = "SELECT ID_branch FROM branchs WHERE city='$branch'";
  $res_b = mysqli_query($con, $b);
  $row = mysqli_fetch_assoc($res_b);
  $id_branch = $row['ID_branch'];
 
 // echo "Selected Branch: " '. $branch .'" <br>";
}
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
    
   
  </style>
<form    method="POST" >
  <?php if($choosed==true){ ?>
  <select name="barbers" class="select" id="barbers" >
    <?php  
      $area_selected= trim( $_POST['choose_area']);
      $barbers ="SELECT * FROM Userss WHERE ROLE ='WORKER' ";
      $res_barbers=mysqli_query($con,$barbers);
      while($row=mysqli_fetch_assoc($res_barbers)){
        
      ?>
        <option value=" <?php echo trim($row['ID_u'])  ?>  "><?php   echo  $row['name']  ?></option>
      <?php 
      
    }
      ?>
  <input type="submit"  data-mdb-ripple-color="dark" value="Select barber" name="select"  />
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
        $date = date('Y-m-d'); //today date
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
  if(isset($_POST['addto'])) {

    $success=0;
    if(!empty($_POST['date1']) && !empty($_POST['times'])) {//fix here delete time
      if (!isset($queues)) {
        $time=$_POST['times'];
        echo  $barber=$_POST['barbers'];
       echo  $date_sel=$_POST['date1'];
       
           $add="INSERT INTO   history_of_queues (time,id_user,id_userW,date ) VALUES($time,$customer,$barber,'$date_sel')  "  ;
           $res=mysqli_query($con,$add);

           echo '	
        <script>window.location.replace("appointments.php")</script>;' ;
        $barber_name = "";
              $barber_sql = "SELECT name FROM Userss WHERE ID_u = $barber";
              $useremail = "SELECT email FROM Userss WHERE email= $iduser";
        send_confirmation_email($useremail, $date_sel, $time, $barber_name);


      }
      else{
      $isAvailable = true;
      $c=0;
        
      for($i = 0; $i < sizeof($queues); $i++) {
        $_POST['date1'] = trim($_POST['date1'], ' ');
        if($queues[$i]['date'] === $_POST['date1'] && $queues[$i]['time'] === $_POST['times']) {
          $isAvailable = false;
          echo 'Sorry, this time slot is already taken.';
          break;
        }
        else  {  
      
       
          
        $time=$_POST['times'];
        
  
         echo  $barber=$_POST['barbers'];
        echo  $date_sel=$_POST['date1'];
        echo  $time;
       
            $add="INSERT INTO   history_of_queues (time,id_user,id_userW,date ) VALUES($time,$customer,$barber,'$date_sel')  "  ;
            $res=mysqli_query($con,$add);
            if ($res) {

              // Get the barber's name
              $barber_name = "";
              $barber_sql = "SELECT name FROM Userss WHERE ID_u = $barber";
              $useremail = "SELECT email FROM Userss WHERE email= $iduser";

              $barber_result = mysqli_query($con, $barber_sql);
              if ($barber_row = mysqli_fetch_assoc($barber_result)) {
                $barber_name = $barber_row["name"];
              }
          
              
              send_confirmation_email($useremail, $date_sel, $time, $barber_name);
              
              break;   
            }
             
}

            
        }
        echo '<script>window.location.replace("appointments.php")</script>;
   ';
      
      
    }     
    } 
  }
  
  else {
    echo '<b class="text-dark">Please select a date and time slot.</b><br>';
}
$map = "SELECT map FROM branchs WHERE city ='$branch'";
  $res_map = mysqli_query($con, $map);
  $num_rows = mysqli_num_rows($res_map);
  $row = mysqli_fetch_assoc($res_map);
  
 
  echo ' <b class="text-dark" > Location on map : </b><br>';
      $mapUrl = $row['map'];
      echo " " . $mapUrl."<br>";  
?>
