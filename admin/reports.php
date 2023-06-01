<?php
include '../DBconnect.php';
include 'index.php';

$soon_end = "SELECT * FROM products WHERE quantity < 10";
$result1 = mysqli_query($con, $soon_end);

echo '
<div class="container mt-5">
<table class="table table-striped table-bordered table-hover">
<thead class="thead-dark">
  <tr >
    <th scope="col">ID product</th>
    <th scope="col">Name of product</th>
    <th scope="col">Current quantity</th>
  </tr>
</thead>
<tbody>
</div>';

while ($row = mysqli_fetch_assoc($result1)) {
    echo '
    <tr class="bg-white">
      <td>' . $row['ID_p'] . '</td>
      <td>' . $row['name'] . '</td>
      <td>' . $row['quantity'] . '</td>
    </tr>';
}

echo '
</tbody>
</table>';
?>
