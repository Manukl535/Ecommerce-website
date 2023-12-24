<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Men Hoodie' LIMIT 4");

$stmt->execute();

$index_men = $stmt->get_result();

?>