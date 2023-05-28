<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to MySQL database
include '../DBconnect.php';

// Get the search query from the URL
$search_query = $_GET['search'];

// Prepare the MySQL statement to search for matching products
$stmt = $con->prepare("SELECT * FROM products WHERE name LIKE ?");
$search_query = "%$search_query%"; // Add wildcard characters to the search query
$stmt->bind_param("s", $search_query);
$stmt->execute();

// Get the search results as an associative array
$results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Check if there are any search results
if (count($results) > 0) {
    // Loop through the search results and display each product
    foreach ($results as $product) {
        echo "Name: " . $product['name'] . "<br>";
        echo "Description: " . $product['description'] . "<br><br>";
    }
} else {
    // No search results found
    echo "No products found.";
}
?>
