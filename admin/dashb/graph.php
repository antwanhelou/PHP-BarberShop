<?php
$con = mysqli_connect("localhost", "barshop", "root", "");
if (!$con) {
    echo "Problem in database connection! Contact administrator!";
} else {
    $sql = "SELECT * FROM history_of_orders";
    $result = mysqli_query($con, $sql);
    $productname = array();
    $quantity = array();
    while ($row = mysqli_fetch_array($result)) {
        $productname[] = $row['name'];
        $quantity[] = $row['quantity'];
    }
}
error_reporting(E_ALL);
ini_set('display_errors', 1);   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div style="width:60%;hieght:20%;text-align:center">
        <h2 class="page-header">Product Sales Reports</h2>
        <p style="align:center;"><canvas id="chartjs_bar"></canvas></p>
    </div>
    <script type="text/javascript">
        var productname = <?php echo json_encode($productname); ?>;
        var quantity = <?php echo json_encode($quantity); ?>;
        
        var ctx = document.getElementById("chartjs_bar").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: productname,
                datasets: [{
                    backgroundColor: [
                        "#5969aa",
                        "#ff407b",
                        "#331523",
                        "#ffc750"
                    ],
                    data: quantity,
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
</body>

</html>
