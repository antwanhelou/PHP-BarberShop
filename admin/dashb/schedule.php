<?php
include '../DBconnect2.php';

$currentDate = date('Y-m-d');
$currentHour = date("H");
$schecdule = "SELECT * FROM history_of_queues WHERE date > '$currentDate' OR (date = '$currentDate' ) ORDER BY date ";
$res_schedule = mysqli_query($con, $schecdule);
function getNameUser($idOfUser, $con)
{
  $nameQuery = "SELECT * FROM userss WHERE ID_U='$idOfUser'";
  $res_name = mysqli_query($con, $nameQuery);
  $row = mysqli_fetch_assoc($res_name);
  return $row['name'];
}
$today= date('Y-m-d');
$get7days=date('Y-m-d', strtotime('+7 day'));
$rowDate = $row['date'];
//$minDate = max($tomorrow, $rowDate); // Ensure min date is at least tomorrow
$maxDate=max($get7days,$rowDate);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elegant Dashboard | Dashboard</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="./css/style.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-win8.css">
</head>
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-ios.css">

<body>
  <!-- ! Body -->
  <div class="page-flex">
    <?php include 'sidebar.php'; ?>
    <div class="main-wrapper">
      <!-- ! Main nav -->
      <nav class="main-nav--bg">
        <div class="container main-nav">
          <div class="main-nav-start">
          </div>
          <?php include 'navbar.php'; ?>
          <!-- ! Main -->
          <h2 class="main-title">Dashboard</h2>
          <form  method="post" >
            <table class="table table-striped">
              <thead>
                <tr class="w3-blue-grey">
                  <th>Client</th>
                  <th>Name of barber</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Actions</th>
                </tr>
              </thead>
                 <tr>
                 <?php while ($row = mysqli_fetch_assoc($res_schedule)) {
                   $appointment_id = $row['ID_q'];
                    $j=0  ?>
        <td>
            <?php
            $id_user = $row['id_user'];
            $name = getNameUser($id_user, $con);
            echo $name;
            ?>
        </td>
        <td>
            <?php
            $id_user = $row['id_userW'];
            $name = getNameUser($id_user, $con);
            echo $name;
            ?>
        </td>
        <td>
            <input type="date" id="<?php echo $j?>" name="date" value="<?php echo $row['date'] ?>" min="<?php echo $today?>" max="<?php echo $maxDate?>">
        </td>
        <td>
            <select name="hours">
                <?php
                $i = 11;
                while ($i <= 22) {
                  
                    if ($i == $row['time']) {
                        echo '<option value="' . $i . '" selected>' . $i . '</option>';
                    } else {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    $i++;

                }
                $j++;
                ?>
            </select>
                  </td>
                  </td>
                  <td>
                    <center>
                      <input type="submit" class="w3-panel w3-ios-orange" name="changeDate" value="Change date / time" />
                      <input type="reset" class="w3-panel w3-ios-grey" value="Reset" />
                      <input type="submit" class="w3-panel w3-ios-red" name="cancel" value="Cancel" />

                    </center>
                  </td>
                </tr>
              <?php   } ?>  
              </form>
            </table>
      
          </article>
          <!-- ! Footer -->
        </div>
    </div>
    <!-- Chart library -->
    <script src="./plugins/chart.min.js"></script>
    <!-- Icons library -->
    <script src="plugins/feather.min.js"></script>
    <!-- Custom scripts -->
    <script src="js/script.js"></script>
</body>

</html>
<?php
if(isset($_POST['changeDate'])){
  echo '<script> alert("'.$_POST['hours'].'")</script>';
}


?>