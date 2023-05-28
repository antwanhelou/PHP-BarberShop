<?php
include '../DBconnect.php';
include 'index.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$query = "SELECT DAYNAME(STR_TO_DATE(date, '%Y-%m-%d')) as day, COUNT(ID_q) as count
          FROM history_of_queues 
          GROUP BY DAY(STR_TO_DATE(date, '%Y-%m-%d'))";

$result = mysqli_query($con, $query);

if (!$result) {
    echo "Query error: " . mysqli_error($con);
    exit;
}

$counts = array('Sunday' => 0, 'Monday' => 0, 'Tuesday' => 0, 'Wednesday' => 0, 'Thursday' => 0, 'Friday' => 0, 'Saturday' => 0);
while($row = mysqli_fetch_assoc($result)) {
    $counts[$row['day']] = $row['count'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
</head>
   
<body>
<div style="max-width: 800px; margin: auto;"class="bg-white">
    <canvas id="chart"></canvas>
</div>
<script>
var ctx = document.getElementById('chart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode(array_keys($counts)); ?>,
        datasets: [{
            label: 'Appointments',
            data: <?php echo json_encode(array_values($counts)); ?>,
            backgroundColor: 'rgba(0, 123, 255, 0.5)',
            borderColor: 'rgba(0, 123, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                precision: 0,
                maxTicksLimit: 5,
                ticks: {
                    stepSize: 1,
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                }
            }
        }
    }
});
</script>
</body>
</html>
