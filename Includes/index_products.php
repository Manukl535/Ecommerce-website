<?php

include('connection.php');

// men
$stmt = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Apperal/Hoodie' LIMIT 4");

if (!$stmt) {
    die("Error in men's query: " . $conn->error);
}

$stmt->execute();

$index_men = $stmt->get_result();

if (!$index_men) {
    die("Error fetching men's products: " . $conn->error);
}

// women
$stmt1 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Apperal/Hoodie' LIMIT 4");

if (!$stmt1) {
    die("Error in women's query: " . $conn->error);
}

$stmt1->execute();

$index_women = $stmt1->get_result();

if (!$index_women) {
    die("Error fetching women's products: " . $conn->error);
}

// trending
$stmt2 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Apperal/shirt' LIMIT 4");

if (!$stmt2) {
    die("Error in trending products query: " . $conn->error);
}

$stmt2->execute();

$trending_products = $stmt2->get_result();

if (!$trending_products) {
    die("Error fetching trending products: " . $conn->error);
}

?>
