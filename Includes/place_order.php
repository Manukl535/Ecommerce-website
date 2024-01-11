<?php
session_start();
include('connection.php');

if (isset($_POST['place_order'])) {
    //user information
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $order_cost = $_SESSION['total'];
    $order_status = "on_hold";
    $user_id = 1;
    $order_date = date('Y-m-d H:i:s');

    // $cardno = $_POST['cardno'];
    // $cvv = $_POST['cvv'];
    // $state = $_POST['state'];
    // $expdate = $_POST['expdate'];
    // $dod = $_POST['dod'];

    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('issssss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
    $stmt->execute();

    if ($stmt->error) {
        echo "Error: " . $stmt->error; // Print any errors
    } else {
        $order_id = $stmt->insert_id;
        echo $order_id;
    }
}
?>