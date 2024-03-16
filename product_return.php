<?php
session_start();
include('Includes/connection.php');

// Initialize variables
$account_number = '';
$ifsc_code = '';

if (isset($_SESSION['shipped_address'])) {
    $shipped_address = $_SESSION['shipped_address'];
} else {
    header('location: unauthorized.php');
    exit();
}

if (isset($_POST['return-btn'])) {
    $reason = isset($_POST['reason']) ? htmlspecialchars($_POST['reason']) : '';
    $comments = isset($_POST['comments']) ? htmlspecialchars($_POST['comments']) : '';
    $returning_qty = isset($_POST['returning_qty']) ? intval($_POST['returning_qty']) : 1;
    $status = 'Yes';

    $order_id = isset($_SESSION['order_id']) ? $_SESSION['order_id'] : null;
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Bank details
    $bank = isset($_POST['bank']) ? trim($_POST['bank']) : '';
    $account_number = isset($_POST['account_number']) ? trim($_POST['account_number']) : '';
    $ifsc_code = isset($_POST['ifsc_code']) ? trim($_POST['ifsc_code']) : '';

    // Get the current product ID from the session
    $current_product_id = $_SESSION['current_product_id'];

    // Check if there is a previous return for the same order ID and product ID
    $prevReturnStmt = $conn->prepare("SELECT SUM(returning_qty) AS total_return_qty FROM return_requests WHERE order_id = ? AND product_id = ?");
    $prevReturnStmt->bind_param("ii", $order_id, $current_product_id);
    $prevReturnStmt->execute();
    $prevReturnResult = $prevReturnStmt->get_result();
    $prevReturnRow = $prevReturnResult->fetch_assoc();
    $total_return_qty = $prevReturnRow['total_return_qty'];
    $prevReturnStmt->close();

    // Fetch product_price based on product_id
    $priceStmt = $conn->prepare("SELECT product_price FROM products WHERE product_id = ?");
    $priceStmt->bind_param('i', $current_product_id);
    $priceStmt->execute();
    $priceResult = $priceStmt->get_result();
    $product_price = $priceResult->fetch_assoc()['product_price'];
    $priceStmt->close();

    // Fetch the ordered quantity from the database based on the order ID and product ID
    $stmt = $conn->prepare("SELECT product_quantity FROM order_item WHERE order_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $order_id, $current_product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $ordered_qty = $row['product_quantity'];
    $stmt->close();

    // Calculate the remaining quantity that can be returned
    $remaining_qty = $ordered_qty - $total_return_qty;

    // Calculate the total quantity to be updated (previously returned quantity + current returning quantity)
    $total_returning_qty = $total_return_qty + $returning_qty;

    // Check if returning quantity is less than or equal to remaining quantity
    if ($total_returning_qty <= $ordered_qty) {
        // Check if there is a previous return for the same order ID and product ID
        if ($total_return_qty > 0) {
            // If there is a previous return, update the existing entry
            $updateStmt = $conn->prepare("UPDATE return_requests SET reason = ?, comments = ?, returning_qty = ?, bank = ?, account_number = ?, ifsc_code = ? WHERE order_id = ? AND product_id = ?");
            $updateStmt->bind_param("ssssssii", $reason, $comments, $total_returning_qty, $bank, $account_number, $ifsc_code, $order_id, $current_product_id);
    
            if ($updateStmt->execute()) {
                echo '<script>';
                echo 'alert("Return request updated. Refund will be processed.");';
                echo 'window.location.href = "account.php";';
                echo '</script>';
    
                exit();
            } else {
                echo '<script>alert("Failed to update return request. Please try again.");</script>';
            }
    
            $updateStmt->close();
        } else {
            // Proceed with return request
            $stmt = $conn->prepare("INSERT INTO return_requests (order_id, user_id, product_id, product_price, reason, comments, returning_qty, user_name, user_phone, user_address, user_city, user_state, return_status, bank, account_number, ifsc_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('iiisssssssssssss', $order_id, $user_id, $current_product_id, $product_price, $reason, $comments, $returning_qty, $shipped_address['user_name'], $shipped_address['user_phone'], $shipped_address['user_address'], $shipped_address['user_city'], $shipped_address['user_state'], $status, $bank, $account_number, $ifsc_code);
    
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
    } else {
        // Display an alert message if returning quantity exceeds ordered quantity
        echo '<script>alert("Returning quantity exceeds ordered quantity, Please check.");</script>';
    }
}

// Update the bank details in the database if they are provided
if (!empty($bank) && !empty($account_number) && !empty($ifsc_code)) {
    $updateBankStmt = $conn->prepare("UPDATE return_requests SET bank = ?, account_number = ?, ifsc_code = ? WHERE user_id = ?");
    $updateBankStmt->bind_param("sssi", $bank, $account_number, $ifsc_code, $user_id);
    
    if ($updateBankStmt->execute()) {
        echo '<script>alert("Bank details updated successfully.");</script>';
    } else {
        echo '<script>alert("Failed to update bank details. Please try again.");</script>';
    }
    
    $updateBankStmt->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .container {
            width: 50%;
            margin: 0 0 0 330px;
            padding: 20px;
            border: 4px solid beige;
            border-radius: 20px;
            background-color: rgba(0, 0, 0, 0.1);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .reason-header,
        .comment-header,
        .pickup-address-header {
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

        .comment-box {
            width: 100%;
            height: 100px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .comment-box:focus {
            outline: none;
            border-color: #4d90fe;
            box-shadow: 0 0 5px #4d90fe;
        }

        .bank-details {
            margin-top: 20px;
        }

        .bank-details label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .bank-details select,
        .bank-details input {
            width: 30%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .bank-details select:focus,
        .bank-details input:focus {
            outline: none;
            border-color: #4d90fe;
            box-shadow: 0 0 5px #4d90fe;
        }

        .pickup-address-header {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .continue-button {
            padding: 10px 20px;
            font-size: 1em;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            transition: background-color 0.3s, transform 0.2s;
            margin: 0 0 0 580px;
        }

        .continue-button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .return-quantity {
            width: 60px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .return-quantity:focus {
            outline: none;
            border-color: #4d90fe;
            box-shadow: 0 0 5px #4d90fe;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <a href="#" onclick="window.history.back(); return false;"><i style="font-size:30px" class="fa">&#xf190;</i></a>
    &nbsp;

    <a href="index.php"><i style="font-size:30px;color:blue" class="fa">&#xf015;</i></a>

    <br />

    <div class="container">
        <form action="product_return.php" method="post">
            <div class="reason-header">Reason for Return</div>

            <div class="radio-container">
                <label class="radio-label"><input type="radio" name="reason" value="Product Damaged" required>Product Damaged</label>
                <label class="radio-label"><input type="radio" name="reason" value="Product Missing" required> Product Missing</label>
                <label class="radio-label"><input type="radio" name="reason" value="Others"> Others</label>
            </div>

            <div class="comment-header">Comments</div>
            <textarea name="comments" class="comment-box" placeholder="Explain the problem..." style="resize:none;" required></textarea>

            <label for="returning_qty"><h3>Returning Qty:</h3></label>
            <input type="number" id="returning_qty" name="returning_qty" value="1" min="1" class="return-quantity" required>
            </h3>

            <?php
            // Check if user bank details exist in return_requests table
            $bankDetailsStmt = $conn->prepare("SELECT account_number, ifsc_code FROM return_requests WHERE user_id = ?");
            $bankDetailsStmt->bind_param("i", $user_id);
            $bankDetailsStmt->execute();
            $bankDetailsResult = $bankDetailsStmt->get_result();
            $bankDetailsRow = $bankDetailsResult->fetch_assoc();
            $bankDetailsStmt->close();

            // If user bank details exist, populate the bank details
            if ($bankDetailsRow) {
                $account_number = $bankDetailsRow['account_number'];
                $ifsc_code = $bankDetailsRow['ifsc_code'];
            }
            ?>
<div class="bank-details">
    <label for="bank">Select Bank For Refund:</label>
    <select id="bank" name="bank" required onchange="fetchBankDetails()">
        <option value="">Select Bank</option>
        <option value="Canara Bank">Canara Bank</option>
        <option value="SBI">SBI</option>
        <option value="HDFC">HDFC</option>
    </select>

    <!-- Add input areas for bank account number and IFSC code -->
    <label for="account_number">Bank Account Number:</label>
    <input type="text" pattern="[0-9]+" id="account_number" name="account_number" placeholder="Account Number" required value="<?php echo $account_number; ?>">

    <label for="ifsc_code">IFSC Code:</label>
    <input type="text" id="ifsc_code" name="ifsc_code" placeholder="IFSC Code" required value="<?php echo $ifsc_code; ?>">
</div>


<script>
    function fetchBankDetails() {
        var bankSelect = document.getElementById("bank");
        var bankValue = bankSelect.options[bankSelect.selectedIndex].value;
        
        if (bankValue !== "") {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    var bankDetails = JSON.parse(this.responseText);
                    // Check if bank details are available
                    if (bankDetails.account_number && bankDetails.ifsc_code) {
                        // Populate account number and IFSC code fields
                        document.getElementById("account_number").value = bankDetails.account_number;
                        document.getElementById("ifsc_code").value = bankDetails.ifsc_code;
                    } else {
                        // If bank details are not available, leave fields blank
                        document.getElementById("account_number").value = "";
                        document.getElementById("ifsc_code").value = "";
                    }
                }
            };
            xhttp.open("GET", "fetch_bank_details.php?bank=" + encodeURIComponent(bankValue), true);
            xhttp.send();
        } else {
            // If no bank is selected, leave fields blank
            document.getElementById("account_number").value = "";
            document.getElementById("ifsc_code").value = "";
        }
    }
</script>




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
