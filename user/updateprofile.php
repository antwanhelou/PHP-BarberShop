<?php
include '../DBconnect.php';
include 'index.php';
session_start();
$iduser = $_SESSION['update'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- Add the required MDB CSS -->
<!-- Add Font Awesome -->
    <style>
        body {
            background-color: #343a40; /* Dark background color */
            color: black; /* White text color */
        }

        .main {
            width: 30%;
            padding: 20px;
            box-shadow: 1px 1px 10px silver;
            margin-top: 50px;
            background-color: white; /* Dark background color */
            color:black; /* White text color */
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            background-color: transparent; /* Dark background color */
            color:black; /* White text color */
        }

        .btn-danger {
            background-color: #dc3545; /* Red background color */
            border-color: #dc3545; /* Red border color */
        }
    </style>
</head>
<body>
    <center>
        <div class="main">
            <form method="POST" enctype="multipart/form-data">
                <h2 class="text-center">Update Your Profile</h2><br>

                <?php
                $user = "SELECT * from Userss WHERE ID_u=$iduser";
                $res = mysqli_query($con, $user);
                while ($row = mysqli_fetch_assoc($res)) {
                ?>

                    <div class="mb-3 bg-">
                        <label for="name" class="form-label text-dark">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $row['name'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-dark">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo $row['email'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-dark">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" value="<?php echo $row['password'] ?>">
                    </div>

                    <div class="text-center">
                        <button class="btn btn-danger rounded-pill" type="submit" name="updateprof">Update</button>
                    </div>

                <?php
                }
                ?>

            </form>

            <br>

            <form method="POST" enctype="multipart/form-data" >
                <div class="text-center ">
                    <img class="img-thumbnail" width="250px" src="<?php echo $details['image']; ?>">
                </div>
                <div class="file-field">
                    <label for="profileImage" class="form-label text-white">Upload Image:</label>
                    <input type="file" class="form-control text-white " id="profileImage" name="profileImage" >
                </div>
                <div class="text-center">
                    <button class="btn btn-white bg-dark text-white" type="submit" name="updateImage">Update Image</button>
</div>
</form>
</div>
</center>
<!-- Add the required MDB JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>

</body>
</html>
<?php
if (isset($_POST['updateImage'])) {
    $imageName = $_FILES['profileImage']['name'];
    $imageTemp = $_FILES['profileImage']['tmp_name'];

    // Define the target directory to save the uploaded image
    $targetDirectory = '../photos/';
    $targetPath = $targetDirectory . $imageName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($imageTemp, $targetPath)) {
        // Update the image path in the database for the user
        $updateQuery = "UPDATE Userss SET photo='$targetPath' WHERE ID_u=$iduser";
        mysqli_query($con, $updateQuery);

        // Redirect or display a success message
        header('Location: profile.php');
        exit;
    } else {
        // Handle the case if the file upload fails
        echo 'Failed to upload image.';
    }
}

if (isset($_POST['updateprof'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (mysqli_query($con, "UPDATE Userss SET name='$name', email='$email', password='$password' WHERE ID_u=$iduser")) {
        echo '<div class="alert alert-success" role="alert">Details updated successfully</div>';
    }
}

if (isset($_POST['close'])) {
    echo '<script> window.close(); </script>';
}
?>
