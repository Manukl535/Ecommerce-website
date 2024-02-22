<?php
session_start();
include('Includes/connection.php');

if (isset($_GET['orders_btn']) && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Retrieve order details along with user_id, product image URL, and product price
    $stmt = $conn->prepare("SELECT order_item.*, orders.user_id, orders.order_date, orders.dod, product_image, product_price
                            FROM order_item 
                            JOIN orders ON order_item.order_id = orders.order_id
                            WHERE order_item.order_id=? AND orders.user_id=?");

    $stmt->bind_param('ii', $order_id, $_SESSION['user_id']);
    $stmt->execute();

    $order_details = $stmt->get_result();

    // Check if there are results for the query
    if ($order_details->num_rows === 0) {
        // No results, redirect to unauthorized.php
        header('location: unauthorized.php');
        exit();
    }

    // Retrieve billed address from orders table
    $stmt1 = $conn->prepare("SELECT user_name,user_phone,user_address,user_city,user_state,dod FROM orders WHERE order_id=? AND user_id=?");
    $stmt1->bind_param('ii', $order_id, $_SESSION['user_id']);
    $stmt1->execute();
    $order_info = $stmt1->get_result()->fetch_assoc();

    // Save the shipped address in the session
    $_SESSION['shipped_address'] = $order_info;
    $stmt1->close();
} else {
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

        .order-details {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-image {
            max-width: 80px; /* Adjust the maximum width as needed */
            margin-right: 10px; /* Reduce margin between product image and product name */
        }

        .product-description {
            flex-grow: 1; /* Allow product description to take up available space */
            text-align: center; /* Center-align the product description */
            margin-right: 10px; /* Reduce margin between product name and product price */
        }

        .product-price {
            margin-right: 10px; /* Reduce margin between product price and return button */
        }

        button {
            margin-left: 10px;
            padding: 8px 12px;
            background-color: #4CAF50;
            color: black;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 750;
        }

        button:hover {
            background-color: #45a049; /* Darker green color on hover */
        }

        .return-button-disabled {
            background-color: #dddddd;
            cursor: not-allowed;
        }

        #return-all-button {
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: black;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 750;
        }

        #return-all-button:hover {
            background-color: #45a049; /* Darker green color on hover */
        }
    </style>
</head>
<body>

<h1>Order Details</h1>
<h2>Shipped Address</h2>

<p><?php echo isset($order_info['user_name']) ? $order_info['user_name'] : ''; ?></p>
<p><?php echo isset($order_info['user_address']) ? $order_info['user_address'] : ''; ?></p>
<p><?php echo isset($order_info['user_city']) ? $order_info['user_city'] : ''; ?></p>
<p><?php echo isset($order_info['user_state']) ? $order_info['user_state'] : ''; ?></p>
<p><?php echo isset($order_info['user_phone']) ? $order_info['user_phone'] : ''; ?></p><br/>


<?php if ($order_details->num_rows > 1) { ?>
    <button class="<?php echo $returnButtonClass; ?>" style="float: right;" onclick="returnProduct()">&#8634; Return All</button>
<?php } ?>

<br><br><br><br>
<?php
$productImages = array(); // Array to store product images
$productDescriptions = array(); // Array to store product descriptions
$productPrices = array(); // Array to store product prices
?>

<?php while ($row = $order_details->fetch_assoc()) { ?>
    <div class="order-details">
        <?php
        // Accumulate product details for each product
        $productImages[] = 'Assets/' . $row['product_image'];
        $productDescriptions[] = isset($row['product_name']) ? $row['product_name'] : '';
        $productPrices[] = isset($row['product_price']) ? $row['product_price'] : '';
        ?>

        <!-- Display product image for the current product -->
        <img src="<?php echo end($productImages); ?>" alt="Product Image" class="product-image">

        <!-- Display product details for the current product -->
        <div class="product-description">
            <p><?php echo end($productDescriptions); ?></p>
            <span class="product-price"><?php echo 'Price: &#8377; ' .  end($productPrices); ?></span>
        </div>

        <div>Delivered On: 
            <?php  
            $dod = $row['dod'];
            $formatted_date = date('d-m-Y', strtotime($dod));
            echo $formatted_date;
            ?>
        </div>

        <!-- Single "Return" button for each product -->
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
            $currentDate = new DateTime();
            $deliveryDate = new DateTime($row['dod']);
            $interval = $currentDate->diff($deliveryDate);
            $daysDifference = $interval->days;
            $returnButtonClass = ($daysDifference <= 2) ? '' : ' return-button-disabled';
        ?>
        <form action="product_return.php" >
        <button style="background-color: rgb(81, 182, 81); text-decoration: none; font-weight: 30px; width: 99%; height: 7vh; color: black; font-weight: bold; border: 1px solid black; border-radius: 50px;" type="submit" name="return_btn">Return</button>
        
<?php } ?>




</body>
</html>
