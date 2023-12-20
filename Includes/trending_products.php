<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='shirts' LIMIT 4");

$stmt->execute();

$trending_products = $stmt->get_result();

?>