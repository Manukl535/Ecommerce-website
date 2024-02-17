<?php

include('connection.php');

// men
$stmt = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Apperal/Hoodie' LIMIT 4");

$stmt->execute();

$index_men = $stmt->get_result();

//women

$stmt1 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Apperal/Hoodie' LIMIT 4");

$stmt1->execute();

$index_women = $stmt1->get_result();

// trendning

$stmt2 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Apperal/shirt' LIMIT 4");

$stmt2->execute();

$trending_products = $stmt2->get_result();



?>