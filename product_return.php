<?php
session_start();
include('Includes/connection.php');

// Check if the shipped address is available in the session
if (isset($_SESSION['shipped_address'])) {
    $shipped_address = $_SESSION['shipped_address'];
} else {
    
}

// Check if the form is submitted via POST
if (isset($_POST['continue-btn'])) {
    // Sanitize and retrieve form data
    $reason1 = isset($_POST['reason1']) ? htmlspecialchars($_POST['reason1']) : '';
    $reason2 = isset($_POST['reason2']) ? htmlspecialchars($_POST['reason2']) : '';
    $reason3 = isset($_POST['reason3']) ? htmlspecialchars($_POST['reason3']) : '';
    $comments = isset($_POST['comments']) ? htmlspecialchars($_POST['comments']) : '';

    // Insert the return request into the database
    $stmt = $conn->prepare("INSERT INTO return_requests (order_id, user_id, reason, comments, pickup_address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('iisss', $_SESSION['order_id'], $_SESSION['user_id'], $reason, $comments, $pickup_address);

    if ($stmt->execute()) {
        // Success, display alert and redirect
        echo '<script>alert("Return request accepted. Refund will be processed.");</script>';
        header('location: orders_details.php?order_id=' . $_SESSION['order_id'] . '&orders_btn=true');
        exit();
    } else {
        // Failed to insert into the database, handle accordingly
        echo '<script>alert("Failed to submit return request. Please try again.");</script>';
    }

    $stmt->close();
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

        <!-- Display the user's address received from the session -->
         <!-- Display the shipped address in the form -->
         <p><?php echo isset($shipped_address['user_name']) ? $shipped_address['user_name'] : ''; ?></p>
        <p><?php echo isset($shipped_address['user_address']) ? $shipped_address['user_address'] : ''; ?></p>
        <p><?php echo isset($shipped_address['user_city']) ? $shipped_address['user_city'] : ''; ?></p>
        <p><?php echo isset($shipped_address['user_state']) ? $shipped_address['user_state'] : ''; ?></p>
        <p><?php echo isset($shipped_address['user_phone']) ? $shipped_address['user_phone'] : ''; ?></p><br/>


        <br/>
        <button type="submit"  name="continue-btn" class="continue-button">Continue</button>
    </form>
</div>

</body>
</html>
