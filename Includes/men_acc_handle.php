<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM product2 WHERE product_category='Men_acc' LIMIT 4");

$stmt->execute();

$index_men = $stmt->get_result();

?>