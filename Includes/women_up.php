<?php

include('connection.php');

//hoodie 
$stmt1 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Apperal/Hoodie' LIMIT 4");

$stmt1->execute();

$women_up = $stmt1->get_result();

// frocks
$stmt2 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Apparal/frocks' LIMIT 4");

$stmt2->execute();

$frocks = $stmt2->get_result();

//sweaters
$stmt3 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Apparal/sweater' LIMIT 4");

$stmt3->execute();

$sweater = $stmt3->get_result();

//croptop
$stmt4 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Apparal/croptop' LIMIT 4");

$stmt4->execute();

$croptop= $stmt4->get_result();

//onepiece
$stmt5 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Apparal/onepiece' LIMIT 4");

$stmt5->execute();

$onepiece= $stmt5->get_result();

//sandals
$stmt6 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Footwear/sandals' LIMIT 4");

$stmt6->execute();

$sandals= $stmt6->get_result();

// shoes
$stmt7 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Footwear/shoes' LIMIT 4");

$stmt7->execute();

$shoes= $stmt7->get_result();

// Flats
$stmt8 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Footwear/flats' LIMIT 4");

$stmt8->execute();

$flats= $stmt8->get_result();

// Boots
$stmt9 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Footwear/boots' LIMIT 4");

$stmt9->execute();

$boots= $stmt9->get_result();


//sunglasses
$stmt10 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Accessories/sunglass' LIMIT 4");

$stmt10->execute();

$sunglass = $stmt10->get_result();

//watches
$stmt11 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Accessories/watch' LIMIT 4");

$stmt11->execute();

$watch = $stmt11->get_result();

//hats
$stmt12 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Accessories/hat' LIMIT 4");

$stmt12->execute();

$hat = $stmt12->get_result();

//wallets
$stmt13 = $conn->prepare("SELECT * FROM products WHERE Gender='Women' AND product_category='Accessories/bag' LIMIT 4");

$stmt13->execute();

$bag = $stmt13->get_result();



?>