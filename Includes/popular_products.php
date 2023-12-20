<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products LIMIT 4");

$stmt->execute();

$popular_products = $stmt->get_result();

?>