<!DOCTYPE html>
<?php
   include '../DBconnect.php';
   include 'index.php';
   ?>
<html>

<head>
  <title>User Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <style>
    table {
      table-layout: fixed;
      width: 100%;
    }

    .btn-rounded-pill {
      border-radius: 50px;
    }
  </style>
</head>

<body>
  <div class="container">

    <table class="table table-hover">
      <thead>
        <tr class="bg-dark text-white">
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
     
        $users = mysqli_query($con, "SELECT * FROM Userss WHERE ROLE='USER' ");
        while ($row = mysqli_fetch_assoc($users)) {
          session_start();
        ?>
          <form method="GET">
            <tr class="bg-white">
              <th scope="row"><?php echo $row['name'];
                              $_SESSION['name'] = $row['name']; ?></th>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['ROLE']; ?></td>
              <td>
                <button class="btn btn-danger btn-rounded-pill" type="submit" name="deleteuser" value=<?php echo $row['ID_u'] ?>>Delete User</button>
                <button class="btn btn-secondary btn-rounded-pill" type="submit" name="details" value=<?php echo $row['ID_u'] ?>>Details</button>
                <button class="btn btn-dark" type="submit" name="history" value=<?php echo $row['ID_u'] ?>>History of Orders</button>
              </td>
            </tr>
          </form>
        <?php
        }
        ?>
      </tbody>
    </table>
    <?php
    if (isset($_GET['deleteuser'])) {
      session_start();
      $_SESSION['deleteuser'] = $_GET['deleteuser'];
      echo '<script> var myWindow = window.open("deleteuser.php?", "", "width=750,height=450"); </script>';
    }
    if (isset($_GET['details'])) {
      session_start();
      $_SESSION['details'] = $_GET['details'];
      echo '<script> var myWindow = window.open("detailsuser.php?", "_blank", "width=750,height=450"); </script>';
    }
    if (isset($_GET['history'])) {
      session_start();
      $_SESSION['history'] = $_GET['history'];
      echo '<script> var myWindow = window.open("historyorders.php?", "_blank", "width=750,height=450"); </script>';
    }
    ?>
  </div>
</body>

</html>
