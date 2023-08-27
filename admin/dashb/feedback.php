<?php 
// Include the database connection file
include '../DBconnect2.php';

// Check if a delete request has been submitted and the ID to delete is numeric
if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    // Construct the DELETE query to remove the record with the corresponding ID from the 'contactus' table
    $deleteQuery = "DELETE FROM contactus WHERE ID = $id";
    // Execute the deletion query
    mysqli_query($con, $deleteQuery);
}

// Define the number of cards to be displayed per page
$cardsPerPage = 8;

// Get the current page number from the query string, or set it to 1 if not provided
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the starting offset for fetching records based on the current page
$offset = ($page - 1) * $cardsPerPage;

// Construct the SELECT query to retrieve records from the 'contactus' table with pagination
$sql = "SELECT * FROM contactus ORDER BY ID DESC LIMIT $offset, $cardsPerPage";


// Execute the SELECT query to get the records
$result = mysqli_query($con, $sql);

// Calculate the total number of cards in the 'contactus' table
$totalCardsQuery = "SELECT COUNT(*) AS total FROM contactus";
$totalCardsResult = mysqli_query($con, $totalCardsQuery);
$totalCardsData = mysqli_fetch_assoc($totalCardsResult);
$totalCards = $totalCardsData['total'];

// Calculate the total number of pages needed for pagination
$totalPages = ceil($totalCards / $cardsPerPage);
?>



<!-- Rest of the HTML code -->

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
</head>
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
 
     
    </div>
   <?php include 'navbar.php';  ?>
    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
      <div class="container">
        <h2 class="main-title">All feedbacks</h2>
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
        </div>
      </div>
    </main>
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
    
</body>

</html>
