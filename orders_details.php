<?php
session_start();
include('Includes/connection.php');

// Check if necessary parameters are set
if (isset($_GET['orders_btn']) && isset($_GET['order_id']) && isset($_GET['product_id'])) {
    $order_id = $_GET['order_id'];
    $product_id = $_GET['product_id'];

    // Retrieve order details for the specific product
    $stmt = $conn->prepare("SELECT order_item.*, orders.user_id, orders.order_date, orders.dod, product_image, product_price, product_id
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            margin-top: 20px; /* Adjust margin as needed */
        }

        .order-details {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-image {
            max-width: 80px;
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
            margin-left: 10px;
            padding: 8px 12px;
            background-color: #4CAF50;
            color: black;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 900;
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
</head>
<body>

<h1>Order Details</h1>
<h2>Shipped Address</h2>

<!-- Display shipped address -->
<p><?= isset($order_info['user_name']) ? $order_info['user_name'] : ''; ?></p>
<p><?= isset($order_info['user_address']) ? $order_info['user_address'] : ''; ?></p>
<p><?= isset($order_info['user_city']) ? $order_info['user_city'] : ''; ?></p>
<p><?= isset($order_info['user_state']) ? $order_info['user_state'] : ''; ?></p>
<p><?= isset($order_info['user_phone']) ? $order_info['user_phone'] : ''; ?></p><br/>

<form method="GET" action="invoice.php">
            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
            <button style="background-color: rgb(81, 182, 81); text-decoration: none; font-weight: 30px; width: 10%; height: 7vh; color: black; font-weight: bold; border: 1px solid black; border-radius: 50px;" type="submit" name="invoice_btn">
                <i class="fa fa-print"></i> Invoice
            </button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="button" id="returnButton"style="background-color: rgb(81, 182, 81); text-decoration: none; font-weight: 30px; width: 10%; height: 7vh; color: black; font-weight: bold; border: 1px solid black; border-radius: 50px; margin-right:20px;" >
    <img src="Assets/return_btn.png" style="width: 20px; height: 15px; padding-top: -3px;" alt="Return"> Return
</button>
</form>

<!-- Fetch the return status and account number for the first product in the order -->
<?php
if (!empty($order_details_array)) {
    $first_product_id = $order_details_array[0]['product_id'];
    $return_status_query = $conn->prepare("SELECT return_status, account_number FROM return_requests WHERE order_id=? AND user_id=? AND product_id=?");
    $return_status_query->bind_param('iii', $order_id, $_SESSION['user_id'], $first_product_id);
    $return_status_query->execute();
    $return_status_query->bind_result($return_status, $account_number);

    // Fetch the return status and account number
    $return_status_query->fetch();

    // Check if the checkbox is disabled
    $checkbox_disabled = ($return_status === 'Returned') ? 'disabled' : '';

    // Fetch the product price from the order details array
    $product_price = $order_details_array[0]['product_price'];

    // Display appropriate message based on return status
    if ($return_status === 'Yes') {
        echo '<div class="refund-message">';
        echo 'Refund amount Rs ' . $product_price . ' transferred to Account no ending with: ';
        echo ($checkbox_disabled) ? $account_number : substr($account_number, -4);
        echo '</div>';
    }

    $return_status_query->close();
}
?>
        

       
<?php
$productImages = $productDescriptions = $productPrices = $productid = array();

// Iterate over the stored order details array
foreach ($order_details_array as $row) {
    // Accumulate product details for each product
    $productImages[] = 'Assets/' . $row['product_image'];
    $productDescriptions[] = isset($row['product_name']) ? $row['product_name'] : '';
    $productPrices[] = isset($row['product_price']) ? $row['product_price'] : '';
    $productid[] = isset($row['product_id']) ? $row['product_id'] : '';

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
            <span class="product-price"><?php echo 'Price: Rs ' . end($productPrices); ?></span>
            <span>Product ID:<?php echo end($productid); ?></span>
        </div>

        <div>Delivered On: <?= date('d-m-Y', strtotime($row['dod'])); ?></div>
    </div>
<?php } ?>
<!-- Add a hidden input to track if any checkbox is selected -->
<input type="hidden" id="checkboxSelected" name="checkbox_selected" value="0">
</form>

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
                alert('Select at least one product.');
            } else {
                // Update the hidden input to indicate that a checkbox is selected
                document.getElementById('checkboxSelected').value = '1';

                // At least one checkbox is selected, navigate to product_return.php
                window.location.href = 'product_return.php';
            }
        }
    });
</script>
</body>
</html>
