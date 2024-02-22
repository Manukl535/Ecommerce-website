<?php
session_start();
include('Includes/connection.php');

$order_info = array(); // Provide a default value

if (isset($_GET['return_btn']) && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Retrieve billed address from orders table
    $stmt1 = $conn->prepare("SELECT user_name,user_phone,user_address,user_city,user_state,dod FROM orders WHERE order_id=? AND user_id=?");
    $stmt1->bind_param('ii', $order_id, $_SESSION['user_id']);
    $stmt1->execute();
    $order_info = $stmt1->get_result()->fetch_assoc();
    $stmt1->close();
} else {
    // Handle the case where return_btn and order_id are not set, e.g., redirect or display an error message
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Form</title>
    <style>
        .container {
            width: 50%;
            margin: auto;
        }

        .reason-header {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .radio-container {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .radio-label {
            margin-bottom: 5px;
        }

        .comment-header {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .comment-box {
            width: 100%;
            height: 100px;
            margin-bottom: 20px;
        }

        .pickup-address-header {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .pickup-address-box {
            width: 100%;
            height: 100px;
            margin-bottom: 20px;
        }

        .continue-button {
            padding: 10px 20px;
            font-size: 1em;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <form action="product_return.php" method="post">
        <div class="reason-header">Reason for Return</div>

        <div class="radio-container">
            <label class="radio-label"><input type="radio" name="reason" value="message1">Product Damaged</label>
            <label class="radio-label"><input type="radio" name="reason" value="message2"> Product Missing</label>
            <label class="radio-label"><input type="radio" name="reason" value="other"> Others</label>
        </div>

        <div class="comment-header">Comment</div>
        <textarea name="comments" class="comment-box" placeholder="Explain the problem..."></textarea>

        <div class="pickup-address-header">Pickup Address</div>
      
        <p><?php echo isset($order_info['user_name']) ? $order_info['user_name'] : ''; ?></p>
        <p><?php echo isset($order_info['user_address']) ? $order_info['user_address'] : ''; ?></p>
        <p><?php echo isset($order_info['user_city']) ? $order_info['user_city'] : ''; ?></p>
        <p><?php echo isset($order_info['user_state']) ? $order_info['user_state'] : ''; ?></p>
        <p><?php echo isset($order_info['user_phone']) ? $order_info['user_phone'] : ''; ?></p><br/>

        <button type="submit" class="continue-button">Continue</button>
    </form>
</div>

</body>
</html>
