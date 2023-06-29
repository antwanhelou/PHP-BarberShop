

<?php
include '../DBconnect.php';
include 'index.php';
session_start();
$iduser = $_SESSION['ID_u'];
$result = mysqli_query($con, "SELECT * FROM Userss WHERE ID_u=$iduser");
$details = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Add Bootstrap and MDB CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <style>
        .main {
            width: 30%;
            padding: 20px;
            box-shadow: 1px 1px 10px silver;
            margin-top: 50px;
            background-color: #343a40; /* dark grey */
            color: white; /* white text */
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container">
        <div class="main mx-auto text-white">
            <form method="POST">
                <h2 class="text-center">You'r Profile</h2>
                <div class="text-center">
                    <img class="img-thumbnail" width="250px" src="<?php echo $details['photo']; ?>">
                </div>
                <p>Name: <?php echo $details['name']; ?></p>
                <p>Email: <?php echo $details['email']; ?></p>
                <p>coins: <?php echo $details['coins']; ?></p>
                <div class="text-center">
                    <button class="btn btn-white" type="submit" name="update" value="<?php echo $row['ID_u']; ?>">Update Your Details</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Add Bootstrap and MDB JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    $_SESSION['update'] = $iduser;
    echo '<script>window.open("updateprofile.php");</script>';
}
?>
