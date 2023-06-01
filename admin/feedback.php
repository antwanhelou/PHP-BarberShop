<?php
include 'index.php';
include '../DBconnect.php';

if (isset($_POST['delete']) && is_numeric($_POST['delete'])) {
  $id = mysqli_real_escape_string($con, $_POST['delete']);
  $deleteQuery = "DELETE FROM contactus WHERE ID = $id";

  if (mysqli_query($con, $deleteQuery)) {
      echo "Record deleted successfully";
  } else {
      echo "Error deleting record: " . mysqli_error($con);
  }
}

$cardsPerPage = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page > 1) ? ($page - 1) * $cardsPerPage : 0;

$sql = "SELECT * FROM contactus LIMIT $cardsPerPage OFFSET $offset";
$result = mysqli_query($con, $sql);

$totalCards = mysqli_query($con, "SELECT COUNT(*) FROM contactus");
$totalCards = mysqli_fetch_array($totalCards)[0];
$totalPages = ceil($totalCards / $cardsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedbacks</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
  <style>
    .card {
      transition: transform 0.3s;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
    }

    .card:hover {
      transform: scale(1.05);
      box-shadow: 0 0 16px rgba(0, 0, 0, 0.5);
    }

    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }
    
    .pagination {
    display: flex;
    justify-content: center;
    padding: 20px 0;
  }
  .pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;
  }
  .pagination a.active {
    background-color: #242924;
    color: white;
    border: 1px solid #242924;
  }
  .pagination a:hover:not(.active) {background-color: #ddd;}
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="row mt-4">
      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="col-md-3">
          <div class="card h-100">
            <div class="card-body">
              <p class="card-text">Name: <?php echo $row['name']; ?></p>
              <p class="card-text">Email: <?php echo $row['email']; ?></p>
              <p class="card-text">Message: <?php echo $row['message']; ?></p>
              <form method="POST" action="" class="d-inline">
                <button class="btn btn-danger" type="submit" name="delete" value="<?php echo $row['ID']; ?>">Mark As Done</button>
              </form>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
    <div class="pagination">
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
      <?php endfor; ?>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
</body>
</html>

<style>
  .card {
    transition: transform 0.3s;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
  }

  .card:hover {
    transform: scale(1.05);
    box-shadow: 0 0 16px rgba(0, 0, 0, 0.5);
  }

  .btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
  }

  .btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
  }
</style>
