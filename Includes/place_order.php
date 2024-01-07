<?php
session_start();
include('connection.php');
 if(isset($_POST['place_order'])){

   //user information

    $name = $_POST['name'];
    $address = $_POST['address'];
    $cardno = $_POST['cardno'];
    $cvv = $_POST['cvv'];
    $email = $_POST['email'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $expdate = $_POST['expdate'];
    $dod = $_POST['dod'];
    $phone = $_POST['phone'];
    $order_cost = $_SESSION['total'];
    $order_status = "on_hold";
    $cust_id = 1;
    $order_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders (cust_id, address, cardno, cvv, email, state, city, expdate, dod, phone, order_date, order_status, order_cost) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);");

    $stmt->bind_param('issssssssssss', $cust_id, $address, $cardno, $cvv, $email, $state, $city, $expdate, $dod, $phone, $order_date, $order_status, $order_cost);
    
    $stmt->execute();
    
    if ($stmt->error) {
        echo "Error: " . $stmt->error; // Print any errors
    } else {
        $order_id = $stmt->insert_id;
        echo $order_id;
    }
 }

?>