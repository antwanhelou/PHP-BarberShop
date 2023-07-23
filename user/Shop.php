<?php include 'index.php';
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
  <title>Document</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
 
 
  
  <style>
    
    .card {
      
      width: 240PX;
      transition: transform 0.3s;
    }
    
    .card:hover {
      
      transform: scale(1.05);
    }

    .price, .add-to-cart {
      display: none;
    }

    .card:hover .price,
    .card:hover .add-to-cart {
      display: block;
    }

    .add-to-cart {
      cursor: pointer;
      transition: transform 0.3s;
    }
    

    .add-to-cart.clicked {
      transform: scale(1.5) rotate(20deg);
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
    
<?php include '../DBconnect.php';

$_SESSION['cn']=$data1['total'];

while($row=mysqli_fetch_assoc($result)){
  if($row['quantity']==0){
    $row['image'] = "./images/soldout.webp";
  }
 echo'
<div class="col-md-3 mb-4">
  <div class="card h-100 bg-dark">
    <img src="../'. $row['image'] .'" class="card-img-top" width="200px" height="200px" alt="...">
    <div class="card-body d-flex flex-column text-white">
      <h5 class="card-title">'. $row['name'] .'</h5>
      <p class="card-text">'. $row['about'] .'</p>
      <p class="card-text price">'. $row['price'] .'$</p>
      <i class="fas fa-shopping-cart add-to-cart mt-auto" data-product-id="'.$row['ID_p'].'"></i>
    </div>
  </div>
</div>
';
}
$iduser=$_SESSION['ID_u'];
$resssult=mysqli_query($con,"SELECT count(*) as total from addcart WHERE id_user=$iduser  ");
$data1=mysqli_fetch_assoc($resssult);

$_SESSION['cn']=$data1['total'];

?>

  </div>
</div>
<div class="pagination">
  <?php for ($i = 1; $i <= $totalPages; $i++): ?>
    <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
  <?php endfor ?>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const cartIcons = document.querySelectorAll('.add-to-cart');

    cartIcons.forEach((icon) => {
      icon.addEventListener('click', function() {
        const productId = icon.getAttribute('data-product-id');
        icon.classList.add('clicked');

        // Add product to cart (replace with your actual AJAX request)
        setTimeout(() => {
          addToCart(productId);
          icon.classList.remove('clicked');
        }, 500);
      });
    });
  });
  function addToCart(productId) {
    $.ajax({
      url: "val.php",
      type: "POST",
      data: {
        id: productId,
        quantity: 1
      },
      success: function(response) {
        location.reload('shop.php');
        const jsonResponse = JSON.parse(response);
      },
    });
  }
</script>

</body>
</html>



