<?php

include('connection.php');

//hoodie 
$stmt1 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Apperal/Hoodie' LIMIT 4");

$stmt1->execute();

$men_up = $stmt1->get_result();

// shirts
$stmt2 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Apperal/shirt' LIMIT 4");

$stmt2->execute();

$men_up1 = $stmt2->get_result();

// tshirts
$stmt3 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Apparal/tshirt' LIMIT 4");

$stmt3->execute();

$men_up2 = $stmt3->get_result();

// polo_tshirts
$stmt4 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Apparal/polo_tshirt' LIMIT 4");

$stmt4->execute();

$men_up3 = $stmt4->get_result();

//footwear
$stmt5 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Apparal/footwear' LIMIT 4");

$stmt5->execute();

$men_footwear = $stmt5->get_result();

?>