<?php
include 'index.php';
include '../DBconnect.php';

$productsPerPage = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page > 1) ? ($page - 1) * $productsPerPage : 0;

$sql = "SELECT * FROM products ORDER BY category LIMIT $productsPerPage OFFSET $offset";
$result = mysqli_query($con, $sql);

$totalProducts = mysqli_query($con, "SELECT COUNT(*) FROM products");
$totalProducts = mysqli_fetch_array($totalProducts)[0];
$totalPages = ceil($totalProducts / $productsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
  <style>
    .card {
      width: 240px;
      transition: transform 0.3s;
    }
    
    .card:hover {
      transform: scale(1.05);
    }

    .price {
      display: none;
    }

    .card:hover .price {
      display: block;
    }

    .update-button,
    .delete-button {
      display: none;
      margin-top: 10px;
    }

    .card:hover .update-button,
    .card:hover .delete-button {
      display: block;
    }
    
    .update-button {
      background-color: black;
    }

    .delete-button {
      background-color: #dc3545;
    }

    .update-button,
    .delete-button {
      color: #fff;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
      transition: transform 0.3s;
    }

    .update-button:hover,
    .delete-button:hover {
      transform: scale(1.1);
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

    .pagination a:hover:not(.active) {
      background-color: #ddd;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="row mt-4">
      <?php while($row = mysqli_fetch_assoc($result)): ?>
      <div class="col-md-3 mb-4">
        <div class="card h-100">
          <img src="../<?php echo $row['image']; ?>" class="card-img-top" width="200px" height="200px" alt="...">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?php echo $row['name']; ?></h5>
            <p class="card-text"><?php echo $row['about']; ?></p>
            <p class="card-text price"><?php echo $row['price']; ?>$</p>
            <button class="update-button" onclick="location.href='update.php?id=<?php echo $row['ID_p']; ?>'">Update</button>
            <button class="delete-button" onclick="location.href='delete.php?id=<?php echo $row['ID_p']; ?>'">Delete</button>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
  <div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
    <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
  </div>
</body>
</html>
