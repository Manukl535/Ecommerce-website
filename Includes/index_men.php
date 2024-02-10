<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Apperal/Hoodie' LIMIT 4");

$stmt->execute();

$index_men = $stmt->get_result();

?>