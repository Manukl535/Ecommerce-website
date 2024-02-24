<?php
session_start();
include('Includes/connection.php');

if (isset($_SESSION['shipped_address'])) {
    $shipped_address = $_SESSION['shipped_address'];

    // Fetch product_ids from session
    $product_ids = isset($_SESSION['product_ids']) ? $_SESSION['product_ids'] : array();
} else {
    header('location: unauthorized.php');
    exit();
}

if (isset($_POST['return-btn'])) {
    $reason = isset($_POST['reason']) ? htmlspecialchars($_POST['reason']) : '';
    $comments = isset($_POST['comments']) ? htmlspecialchars($_POST['comments']) : '';
    $status = 'Yes';

    $order_id = isset($_SESSION['order_id']) ? $_SESSION['order_id'] : null;
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Bank details
    $bank = trim($_POST['bank']);
    $account_number = trim($_POST['account_number']);
    $ifsc_code = trim($_POST['ifsc_code']);

    // Loop through each product_id
    foreach ($product_ids as $product_id) {
        $stmt = $conn->prepare("INSERT INTO return_requests (order_id, user_id, product_id, reason, comments, user_name, user_phone, user_address, user_city, user_state, return_status, bank, account_number, ifsc_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iissssssssssss', $order_id, $user_id, $product_id, $reason, $comments, $shipped_address['user_name'], $shipped_address['user_phone'], $shipped_address['user_address'], $shipped_address['user_city'], $shipped_address['user_state'], $status, $bank, $account_number, $ifsc_code);

        if ($stmt->execute()) {
            echo '<script>';
            echo 'alert("Return request accepted. Refund will be processed.");';
            echo 'window.location.href = "account.php";';
            echo '</script>';

            exit();
        } else {
            echo '<script>alert("Failed to submit return request. Please try again.");</script>';
        }

        $stmt->close();
    }
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

        .bank-details {
            margin-top: 20px;
        }

        .bank-details label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .bank-details input,
        #bank {
            width: 30%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .bank-details input:focus,
        #bank:focus {
            outline: none;
            border-color: #4d90fe;
            box-shadow: 0 0 5px #4d90fe;
        }

        #bank {
            width: 30%;
        }

        /* Style the options within the dropdown */
        #bank option {
            padding: 8px;
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
            border-radius:50px;
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

        <div class="bank-details">
            <label for="bank">Select Bank  For Refund:</label>
            <select id="bank" name="bank">
                <option value="Canara Bank">Canara Bank</option>
                <option value="SBI">SBI</option>
                <option value="HDFC">HDFC</option>
            </select>

            <!-- Add input areas for bank account number and IFSC code -->
            <label for="account_number">Bank Account Number:</label>
            <input type="text" id="account_number" name="account_number" required>

            <label for="ifsc_code">IFSC Code:</label>
            <input type="text" id="ifsc_code" name="ifsc_code" required>
        </div>

        <div class="pickup-address-header">Pickup Address</div>

        <!-- Display the shipped address in the form -->
        <p><?php echo isset($shipped_address['user_name']) ? $shipped_address['user_name'] : ''; ?></p>
        <p><?php echo isset($shipped_address['user_address']) ? $shipped_address['user_address'] : ''; ?></p>
        <p><?php echo isset($shipped_address['user_city']) ? $shipped_address['user_city'] : ''; ?></p>
        <p><?php echo isset($shipped_address['user_state']) ? $shipped_address['user_state'] : ''; ?></p>
        <p><?php echo isset($shipped_address['user_phone']) ? $shipped_address['user_phone'] : ''; ?></p>

        <button type="submit" name="return-btn" class="continue-button">Return</button>
    </form>
</div>

</body>
</html>
