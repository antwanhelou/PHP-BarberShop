<?php
include '../DBconnect2.php';
session_start();
$email = $_SESSION['email'];
$admin = "SELECT * FROM userss WHERE email='$email'";
$res_admin = mysqli_query($con, $admin);
$row = mysqli_fetch_assoc($res_admin);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My profile</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="./css/style.min.css">
  <style>
   img {
  border-radius: 50%;
}
.profile {

  inline-size: 30%;
  border-block-start-width: 10px;
  border-block-start-style: solid;
  border-block-start-color: orange;
    border-block-end-style: solid;
  border-block-end-width: 10px;
}
p {
  font-weight: 800;
}

  </style>
</head>

<body>
  <div class="layer"></div>
  <!-- ! Body -->
  <a class="skip-link sr-only" href="#skip-target">Skip to content</a>
  <div class="page-flex">
    <?php include 'sidebar.php' ?>
    <div class="main-wrapper">
      <!-- ! Main nav -->
      <nav class="main-nav--bg">
        <div class="container main-nav">
          <div class="main-nav-start">
       
              <!-- Add your search input or content here -->
            </div>
            <?php include 'navbar.php';  ?>
            <!-- ! Main -->
            <main class="main users chart-page" id="skip-target">
              <div class="container">
                <center>
                  <h2 class="main-title"> Apointments Analys</h2>

                  <?php
                  $date_exist = 0;
                  if (isset($_POST['select'])) {
                    $date = trim($_POST['date']);
                    $sql = "SELECT * FROM history_of_queues WHERE date='$date'";
                    $result = mysqli_query($con, $sql);
                    $apoinments = array();
                    $time = array();
                    while ($row = mysqli_fetch_array($result)) {
                      $username = "SELECT * FROM userss WHERE ID_u=" . $row['id_userW'];
                      $res_username = mysqli_query($con, $username);
                      $nameOfUser = mysqli_fetch_assoc($res_username);

                      $apoinments[] =  $nameOfUser['name'];
                      $time[] = $row['time'];

                      // Set date_exist to 1 if there are results for the selected date
                      $date_exist = 1;
                    }
                  }
                  ?>

                  <div style="width:60%;text-align:center">
                    <h2 class="page-header">Appointments Reports for day <?php echo $date; ?></h2>
                    <form method="post">
                      <input type="date" name="date" placeholder="00/00/2022">
                      <input type="submit" value="Select date" name="select">
                    </form>
                    <?php
                    if ($date_exist) {
                      ?>
                      <p><canvas id="chartjs_bar"></canvas></p>
                      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                      <script type="text/javascript">
                        var apoinments = <?php echo json_encode($apoinments); ?>;
                        var time = <?php echo json_encode($time); ?>;

                        var ctx = document.getElementById("chartjs_bar").getContext('2d');
                        var myChart = new Chart(ctx, {
                          type: 'bar',
                          data: {
                            labels: apoinments,
                            datasets: [{
                              backgroundColor: [
                                "#5969aa",
                                "#ff407b",
                                "#331523",
                                "#ffc750"
                              ],
                              data: time,
                            }]
                          },
                          options: {
                            legend: {
                              display: true,
                              position: 'bottom',
                              labels: {
                                fontColor: '#71748d',
                                fontFamily: 'Circular Std Book',
                                fontSize: 14,
                              }
                            }
                          }
                        });
                      </script>
                    <?php
                    } else {
                      ?>
                      <p>No Appointments exist on this date</p>
                    <?php
                    }
                    ?>
                  </div>
                </center>
              </div>
            </main>
            <!-- ! Footer -->
          </div>
        </div>
      </nav>
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
