<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='women Hoodie' LIMIT 4");

$stmt->execute();

$index_women = $stmt->get_result();

?>