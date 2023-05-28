<?php
include '../DBconnect.php';

$search = $_POST['search'];
$result = mysqli_query($con, "SELECT * FROM products WHERE name LIKE '%$search%'");

echo '<ul class="list-group">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<li class="list-group-item">' . $row['name'] . '</li>';
}
echo '</ul>';
?>
