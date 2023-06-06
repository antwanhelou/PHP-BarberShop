<style>
h2{
    text-align:center ;
    padding-top: 20px;
  font-weight: bold;
}
table tr {background: white;}
</style>
<?php
include '../DBconnect.php';
include 'index.php';

// Set the new timezone
date_default_timezone_set('Asia/Jerusalem');

$date = date('d-m-Y');
$date2 = date('Y-m-d');
$time = date('H');

var_dump($date);
echo $time;

function activeApoinments($con, $date2, $time)
{
    $active = "SELECT * FROM history_of_queues WHERE date='$date2' AND time='$time'";
    $result = mysqli_query($con, $active);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

$isActive = activeApoinments($con, $date2, $time);
var_dump($isActive);
if($isActive==false){
?>
<h2> No Active Apointments </h2>
<?php }else{
    ?>
    <h2> The Active Apoinments for <?php echo $date  ?> 
    and hour <?php echo ' '. $time ?> <br>
</h2>
<table class="table">
  <thead class="thead-dark">
    <tr>
    <th scope="col"> ID Apointment </th>
      <th scope="col">Name of user</th>
      <th scope="col">Name of Worker</th>
        <?php  
        $active = "SELECT * FROM history_of_queues WHERE date='$date2' AND time='$time'";
        $result = mysqli_query($con, $active);
        while($row=mysqli_fetch_assoc($result)){
            echo $row['ID_q'];
            $user = "SELECT name FROM userss WHERE ID_u='" . $row['id_user'] . "'";
            $worker = "SELECT name FROM userss WHERE ID_u='" . $row['id_userW'] . "'";

        $result2 = mysqli_query($con, $user); 
        $result3= mysqli_query($con, $worker); 
         $row2 = mysqli_fetch_assoc($result2); 
         $row3 = mysqli_fetch_assoc($result3); 
        ?>
    
     
      <?php ?>
    </tr>
  </thead>
  <tbody>
    <tr class="thead-white" >
      <th scope="row">  <?php echo $row['ID_q'];  ?></th>
      <td>  <?php echo $row2['name']; ?> </td>
      <td>  <?php echo $row3['name']; ?> </td>
    
    </tr>
    <tr>
 <?php }?>


    </tr>
  </tbody>
</table>
    <?php
} ?>