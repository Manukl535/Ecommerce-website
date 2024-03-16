<?php
session_start();
include('Includes/connection.php');

// Check if necessary parameters are set
if (isset($_GET['orders_btn']) && isset($_GET['order_id']) && isset($_GET['product_id'])) {
    $order_id = $_GET['order_id'];
    $product_id = $_GET['product_id'];

    // Retrieve order details for the specific product
    $stmt = $conn->prepare("SELECT order_item.*, orders.user_id, orders.order_date, orders.dod, product_image, product_price, product_quantity, product_id
    FROM order_item 
    JOIN orders ON order_item.order_id = orders.order_id
    WHERE order_item.order_id=? AND orders.user_id=? AND order_item.product_id=?");

    $stmt->bind_param('iii', $order_id, $_SESSION['user_id'], $product_id);
    $stmt->execute();
    $order_details_result = $stmt->get_result();

    // Check if there are results for the query
    if ($order_details_result->num_rows === 0) {
        // No results, redirect to unauthorized.php or display an appropriate message
        header('location: unauthorized.php');
        exit();
    }

    // Fetch all order details into an array
    $order_details_array = $order_details_result->fetch_all(MYSQLI_ASSOC);

    // Fetch the billed address from the orders table
    $stmt1 = $conn->prepare("SELECT orders.user_name, orders.user_phone, orders.user_address, orders.user_city, orders.user_state, orders.dod
    FROM orders
    JOIN order_item ON orders.order_id = order_item.order_id
    WHERE orders.order_id=? AND orders.user_id=?");

    $stmt1->bind_param('ii', $order_id, $_SESSION['user_id']);
    $stmt1->execute();
    $order_info = $stmt1->get_result()->fetch_assoc();

    // Save the shipped address, order_id, and current_product_id in the session
    $_SESSION['shipped_address'] = $order_info;
    $_SESSION['order_id'] = $order_id;

    foreach ($order_details_array as $row) {
        // Create a session variable for the current product ID
        $_SESSION['current_product_id'] = $row['product_id'];
    }

    $stmt1->close();
} else {
    // Redirect to product_return.php if parameters are not set
    header('location: product_return.php');
    exit();
}

// Check if the order_id is the same for the previous return
if (!empty($order_details_array)) {
    $current_product_id = $order_details_array[0]['product_id'];

    // Fetch the sum of returning quantity for the same order ID and product ID
    $return_qty_stmt = $conn->prepare("SELECT SUM(returning_qty) AS total_return_qty, account_number FROM return_requests WHERE order_id=? AND product_id=? GROUP BY account_number");
    $return_qty_stmt->bind_param('ii', $order_id, $current_product_id);
    $return_qty_stmt->execute();
    $return_qty_result = $return_qty_stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Order Details</title>
    <style>
         body {
    font-family: Arial, sans-serif;
}

h1 {
    text-align: center;
}

.refund-message {
    text-align: center;
    color: green;
    font-weight: bold;
    margin-top: 20px;
}

.order-details {
    margin-top: 20px;
    border: 1px solid #ddd; 
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 0 10px rgba(1, 2, 9, 0.1); 
    transition: box-shadow 0.3s ease-in-out; 
}




.product-image {
    max-width: 150px;
    margin-right: 10px;
}

.product-description {
    flex-grow: 1;
    text-align: center;
    margin-right: 10px;
}

.product-price {
    margin-right: 10px;
}

button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 50%;
    }
    button:hover {
      background-color: #45a049;
    }
    
.return-button-disabled {
    background-color: #dddddd;
    cursor: not-allowed;
}

.hidden-checkbox {
    display: none;
}

    </style>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<a href="#" onclick="window.history.back(); return false;"><i style="font-size:30px" class="fa">&#xf190;</i></a>
&nbsp;

<a href="index.php"><i style="font-size:30px;color:blue" class="fa">&#xf015;</i></a>

<br/>

<h1>Order Details</h1>

<h2>Shipped Address</h2>

<!-- Display shipped address -->
<p><?= isset($order_info['user_name']) ? $order_info['user_name'] : ''; ?></p>
<p><?= isset($order_info['user_address']) ? $order_info['user_address'] : ''; ?></p>
<p><?= isset($order_info['user_city']) ? $order_info['user_city'] : ''; ?></p>
<p><?= isset($order_info['user_state']) ? $order_info['user_state'] : ''; ?></p>
<p><?= isset($order_info['user_phone']) ? $order_info['user_phone'] : ''; ?></p>
<br>


<form method="GET" action="invoice.php">
            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
            <button style="background-color: rgb(81, 182, 81); text-decoration: none; font-weight: 30px; width: 10%; height: 7vh; color: black; font-weight: bold; border: 1px solid black; border-radius: 50px;" type="submit" name="invoice_btn">
                <i class="fa fa-print"></i> Invoice
            </button>  
</form>
<?php
// Check if the refund message is present and if return_status is 'Yes'
if (isset($return_status) && $return_status === 'Yes') {
    echo '<center><img src="Assets/returned.png" style="max-width: 5%; margin: 1px auto;"></center>';
}
?>


<?php
// Fetch the return status and account number for the first product in the order
if (!empty($order_details_array)) {
    $first_product_id = $order_details_array[0]['product_id'];
    $return_status_query = $conn->prepare("SELECT return_status, account_number, returning_qty, product_price, bank FROM return_requests WHERE order_id=? AND user_id=? AND product_id=?");
    $return_status_query->bind_param('iii', $order_id, $_SESSION['user_id'], $first_product_id);
    $return_status_query->execute();
    $return_status_query->bind_result($return_status, $account_number, $returning_qty, $product_price, $bank_name);

    // Initialize arrays to store refund information
    $refund_info = array();

    // Fetch the return status, account number, returning quantity, product price, and bank name
    while ($return_status_query->fetch()) {
        // Store refund information based on bank name and account number
        $refund_key = $bank_name . '_' . $account_number;
        if (!isset($refund_info[$refund_key])) {
            $refund_info[$refund_key] = array(
                'refund_amount' => 0,
                'account_number' => $account_number
            );
        }
        
        // Aggregate refund amount for the same bank and account number
        $refund_info[$refund_key]['refund_amount'] += $returning_qty * $product_price;
    }

    // Close the return status query
    $return_status_query->close();

    // Fetch the sum of returning quantity for the given order_id
    $returning_qty_stmt = $conn->prepare("SELECT SUM(returning_qty) AS total_return_qty FROM return_requests WHERE order_id=? AND product_id=?");
    $returning_qty_stmt->bind_param('ii', $order_id, $first_product_id);
    $returning_qty_stmt->execute();
    $returning_qty_result = $returning_qty_stmt->get_result();

    // Initialize total return quantity to 0
    $total_return_qty = 0;

    // Check if there are any returning quantities
    if ($returning_qty_result && $returning_qty_row = $returning_qty_result->fetch_assoc()) {
        // Retrieve the total returning quantity
        $total_return_qty = $returning_qty_row['total_return_qty'];
    }

    // Close the returning quantity statement
    $returning_qty_stmt->close();

    // Calculate the ordered quantity (assuming it's available in the order_details_array)
    $ordered_qty = $order_details_array[0]['product_quantity'];

    // Display appropriate message based on return status
    if ($return_status === 'Yes') {
        // Display the image and refund message
        echo '<center><img src="Assets/returned.png" style="max-width: 5%; margin: 1px auto;"></center>';
        echo '<div class="refund-message">';
        
        // Display refund information for each bank and account number
        foreach ($refund_info as $refund_key => $info) {
            $bank_info = explode('_', $refund_key);
            echo 'Refund amount &#8377; ' . $info['refund_amount'] . ' transferred to Account Number ending with: ' . substr($info['account_number'], -4) . ' (' . $bank_info[0] . ')';
            echo '<br/>'; // Add a line break between each bank's refund information
        }

        echo '<br/>';
        echo '<div>
        Returned Qty: ' . $total_return_qty . '/' . $ordered_qty . '</div>';
        echo '</div>';
    }
}

// Iterate over the stored order details array
foreach ($order_details_array as $row) {
    // Accumulate product details for each product
    $productImages[] = 'Assets/' . $row['product_image'];
    $productDescriptions[] = isset($row['product_name']) ? $row['product_name'] : '';
    $productPrices[] = isset($row['product_price']) ? $row['product_price'] : '';
    $productid[] = isset($row['product_id']) ? $row['product_id'] : '';
    $productqty[] = isset($row['product_quantity']) ? $row['product_quantity'] : '';

    // Add the product ID to the session variable with a consistent prefix
    $_SESSION['product_ids'][] = 'ProductID_' . $row['product_id'];
    
    // Create a session variable for the current product ID
    $_SESSION['current_product_id'] = $row['product_id'];
    ?>

    <!-- Check return status for the current product -->
    <?php
    $current_product_id = $row['product_id'];
    $return_status_query = $conn->prepare("SELECT return_status FROM return_requests WHERE order_id=? AND user_id=? AND product_id=?");
    $return_status_query->bind_param('iii', $order_id, $_SESSION['user_id'], $current_product_id);
    $return_status_query->execute();
    $return_status_result = $return_status_query->get_result();
    $return_status = ($return_status_result->num_rows > 0) ? 'Returned' : '';
    $return_status_query->close();

    // Check if the current date is more than 2 days after the delivered date
    $delivered_date = strtotime($row['dod']);
    $current_date = time();
    $two_days_after_delivered = strtotime('+2 days', $delivered_date);
    $disable_checkbox = ($current_date > $two_days_after_delivered) ? 'disabled' : '';
    ?>

    <!-- Display the order details -->
    <div class="order-details">
        <!-- Checkbox for each product -->
        <input type="checkbox" class="hidden-checkbox" name="selected_products[]" value="<?= 'ProductID_' . $current_product_id; ?>" <?= ($return_status === 'Returned' || $disable_checkbox) ? 'disabled' : ''; ?>>
        <!-- Display product image for the current product -->
        <img src="<?= end($productImages); ?>" alt="Product Image" class="product-image">

        <!-- Display product details for the current product -->
        <div class="product-description">
            <p><?= end($productDescriptions); ?></p>

            <span class="product-price"><?php echo 'Ordered Qty: ' . end($productqty); ?></span>

            <br/><br/>
            <span class="product-price"><?php echo 'Total Price: &#8377; ' . end($productPrices); ?></span>

            

            <span style="display:none;">Product ID:<?php echo end($productid); ?></span>
            
        </div>

        <div>Delivered On: <?= date('d-m-Y', strtotime($row['dod'])); ?></div>
    </div>
<?php } ?>
<!-- Add a hidden input to track if any checkbox is selected -->
<input type="hidden" id="checkboxSelected" name="checkbox_selected" value="0">
</form>
<br/>
<style>
    #returnButton:disabled {
        background-color: #dddddd;
        cursor: not-allowed;
        opacity: 0.7; 
    }
</style>

<button type="button" id="returnButton" style="background-color: rgb(81, 182, 81); text-decoration: none; font-weight: 30px; width: 10%; height: 7vh; color: black; font-weight: bold; border: 1px solid black; border-radius: 50px; margin-left: 1190px;">
    <img src="Assets/return_btn.png" style="width: 20px; height: 15px; padding-top: -3px;" alt="Return"> Return
</button>

<script>
    var returnButtonClickCount = 0;

    document.getElementById('returnButton').addEventListener('click', function() {
        returnButtonClickCount++;

        if (returnButtonClickCount === 1) {
            // Enable checkboxes on the first click
            var checkboxes = document.querySelectorAll('.hidden-checkbox');
            checkboxes.forEach(function(checkbox) {
                checkbox.style.display = 'block'; // Make the checkboxes visible
            });
        } else {
            // Check if at least one checkbox is selected
            var checkboxes = document.querySelectorAll('.hidden-checkbox:checked');

            if (checkboxes.length === 0) {
                // No checkbox is selected, display an alert
                alert('Select the product to return.');
            } else {
                // Update the hidden input to indicate that a checkbox is selected
                document.getElementById('checkboxSelected').value = '1';

                // At least one checkbox is selected, navigate to product_return.php
                window.location.href = 'product_return.php';
            }
        }

        // Check if all checkboxes are disabled
        var allCheckboxesDisabled = Array.from(document.querySelectorAll('.hidden-checkbox')).every(function(checkbox) {
            return checkbox.disabled;
        });

        if (allCheckboxesDisabled) {
            // All checkboxes are disabled
            if (document.querySelectorAll('.hidden-checkbox').length > 0) {
                // If there are checkboxes available, check if ordered qty matches returned qty
                var checkboxes = document.querySelectorAll('.hidden-checkbox');
                var allProductsReturned = true;

                checkboxes.forEach(function(checkbox) {
                    if (!checkbox.checked) {
                        allProductsReturned = false;
                    }
                });

                if (allProductsReturned) {
                    // If all products have been returned, display an alert and navigate to account.php after a short delay
                    alert('All products have been returned.');
                    setTimeout(function() {
                        window.location.href = 'account.php';
                    }, 0);
                } else {
                    // If not all products have been returned, check if the returned quantity matches the ordered quantity
                    var orderedQty = <?php echo json_encode($ordered_qty); ?>;
                    var returnedQty = <?php echo json_encode($returning_qty); ?>;

                    if (orderedQty === returnedQty) {
                        // Alert when returned quantity equals ordered quantity
                        alert('Product(s) have been returned.');
                        // Navigate to account.php after the alert is closed
                        window.location.href = 'account.php';
                    }
                }
            }
        }
    });

    // Check if the ordered qty is not equal to the returned qty
    var orderedQty = <?php echo json_encode($ordered_qty); ?>;
    var returnedQty = <?php echo json_encode($returning_qty); ?>;

    if (orderedQty !== returnedQty) {
        // Enable checkboxes for return
        var checkboxes = document.querySelectorAll('.hidden-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.disabled = false;
        });
    }
</script>

<script>
    // Check if today is more than 2 days after the delivered date
    var deliveredDate = new Date('<?= date('Y-m-d', strtotime($row['dod'])) ?>');
    var currentDate = new Date();
    var twoDaysAfterDelivered = new Date(deliveredDate);
    twoDaysAfterDelivered.setDate(deliveredDate.getDate() + 2);

    if (currentDate > twoDaysAfterDelivered) {
        // Today is more than 2 days after the delivered date, disable the return button
        document.getElementById('returnButton').disabled = true;
    }
    
</script>



</body>
</html>
