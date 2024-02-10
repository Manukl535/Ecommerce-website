<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Apperal/shirt' LIMIT 4");

$stmt->execute();

$trending_products = $stmt->get_result();

?>