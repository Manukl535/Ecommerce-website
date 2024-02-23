<?php
session_start();
include('Includes/connection.php');

// Check if the shipped address is available in the session
if (isset($_SESSION['shipped_address'])) {
    $shipped_address = $_SESSION['shipped_address'];
} else {
    // Handle the case when shipped_address is not set
    // You may want to redirect the user or display an error message
}

// Check if the form is submitted via POST
if (isset($_POST['continue-btn'])) {
    // Sanitize and retrieve form data
    $reason = isset($_POST['reason']) ? htmlspecialchars($_POST['reason']) : '';
    $comments = isset($_POST['comments']) ? htmlspecialchars($_POST['comments']) : '';
    $status = 'Yes';

    // Retrieve order_id and user_id from the session
    $order_id = isset($_SESSION['order_id']) ? $_SESSION['order_id'] : null;
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Insert the return request into the database
    $stmt = $conn->prepare("INSERT INTO return_requests (order_id, user_id, reason, comments, user_name, user_phone, user_address, user_city, user_state,return_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param('iissssssss', $order_id, $user_id, $reason, $comments, $shipped_address['user_name'], $shipped_address['user_phone'], $shipped_address['user_address'], $shipped_address['user_city'], $shipped_address['user_state'],$status);

    if ($stmt->execute()) {
        // Success, display alert and redirect to account.php
        echo '<script>';
        echo 'alert("Return request accepted. Refund will be processed.");';
        echo 'window.location.href = "account.php";';
        echo '</script>';
        
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
            <label class="radio-label"><input type="radio" name="reason" value="Product Damaged">Product Damaged</label>
            <label class="radio-label"><input type="radio" name="reason" value="Product Missing"> Product Missing</label>
            <label class="radio-label"><input type="radio" name="reason" value="Others"> Others</label>
        </div>

        <div class="comment-header">Comment</div>
        <textarea name="comments" class="comment-box" placeholder="Explain the problem..."></textarea>

        <div class="pickup-address-header">Pickup Address</div>

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
