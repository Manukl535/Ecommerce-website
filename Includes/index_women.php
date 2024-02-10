<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Apperal/Hoodie' LIMIT 4");

$stmt->execute();

$index_women = $stmt->get_result();

?>