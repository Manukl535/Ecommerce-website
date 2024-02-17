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

//sandals
$stmt5 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Footwear/sandals' LIMIT 4");

$stmt5->execute();

$sandals = $stmt5->get_result();

// crocks
$stmt6 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Footwear/crocks' LIMIT 4");

$stmt6->execute();

$crocks = $stmt6->get_result();

//sneakers
$stmt7 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Footwear/sneakers' LIMIT 4");

$stmt7->execute();

$sneakers = $stmt7->get_result();

//formal_shoes
$stmt8 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Footwear/formals' LIMIT 4");

$stmt8->execute();

$formal_shoes = $stmt8->get_result();

//sunglasses
$stmt9 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Accessories/sunglass' LIMIT 4");

$stmt9->execute();

$sunglass = $stmt9->get_result();

//watches
$stmt10 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Accessories/watch' LIMIT 4");

$stmt10->execute();

$watch = $stmt10->get_result();

//hats
$stmt11 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Accessories/hat' LIMIT 4");

$stmt11->execute();

$hat = $stmt11->get_result();

//wallets
$stmt12 = $conn->prepare("SELECT * FROM products WHERE Gender='Men' AND product_category='Accessories/wallet' LIMIT 4");

$stmt12->execute();

$wallet = $stmt12->get_result();

?>