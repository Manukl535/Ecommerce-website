<?php

include("connection.php");

// Assuming <link>$conn</link> is the database connection object
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result) {
    $popular_products = $result->fetch_all(MYSQLI_ASSOC);
    // Now $popular_products contains the fetched data from the database
} else {
    // Handle the case where the query fails
    echo "Error executing the query: " . $conn->error;
}

?>