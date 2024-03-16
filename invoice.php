<?php
session_start();
include('Includes/connection.php');

if (isset($_GET['invoice_btn']) && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header('location: unauthorized.php');
        exit();
    }

    // Retrieve order details along with user_id
    $stmt = $conn->prepare("SELECT order_item.*, products.product_name, products.product_price 
                            FROM order_item 
                            JOIN products ON order_item.product_id = products.product_id
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
    $stmt1 = $conn->prepare("SELECT user_name,user_phone,user_address,user_city,user_state FROM orders WHERE order_id=? AND user_id=?");
    $stmt1->bind_param('ii', $order_id, $_SESSION['user_id']);
    $stmt1->execute();
    $order_info = $stmt1->get_result()->fetch_assoc();
    $stmt1->close();
} else {
    header('location: account.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .invoice {
            width: 95%;
            height:100%;
            margin: 20px auto;
            padding: 20px;
        }
        .invoice-header {
            text-align: right;
            margin-bottom: 20px;
            margin-right:10px;
            font-weight:bold;
        }
        .invoice-header h1 {
            margin: 0;
            color: #333;
        }
        .invoice-header p {
            margin: 5px 0;
            color: #555;
        }
        .invoice-body {
            margin-top: 20px;
        }
        .invoice-body p {
            margin: 5px 0;
            color: #333;
        }
        .invoice-table {
            width: 100%; 
            border-collapse: collapse;
            margin: 0 auto; 
            margin-top: 10px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
        .company-profile {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
            style="display:flex; 
            justify-content:center"
        }
        .company-profile h2 {
            margin: 0;
            color: #333;
        }
        .company-profile p {
            margin: 5px 0;
            color: #333;
        }
        .invoice-table th,
        .invoice-table td {
            padding: 10px;
            text-align: left;
        }
        .invoice-table th:nth-child(1),
        .invoice-table td:nth-child(1) {
            width: 25%;
        }
        .invoice-table th:nth-child(2),
        .invoice-table td:nth-child(2) {
            width: 25%;
        }
        .invoice-table th:nth-child(3),
        .invoice-table td:nth-child(3) {
            width: 25%;
        }
        .invoice-table th:nth-child(4),
        .invoice-table td:nth-child(4) {
            width: 25%;
        }
    </style>
</head>
<body>

<div><img src="Assets/paid.png" alt=""></div>
<div class="invoice">
    <?php while($row = $order_details->fetch_assoc()) { ?>
        <?php if ($order_details->data_seek(0)) { ?>
            <center><h1>Tax Invoice</h1></center>
            <div class="invoice-header">
                <p>Invoice No: ODR<?php echo str_pad($row['order_id'], 3, '0', STR_PAD_LEFT); ?></p>
                <p>Date: <?php
                    $dod = $row['order_date']; 
                    $formatted_date = date('d-m-Y', strtotime($dod));
                    echo $formatted_date;
                ?></p>
            </div>
            <div class="company-profile">
                <h2>Posh Boutique</h2>
                <p>223 Main Street,</p>
                <p>Electronic City,</p> Bengaluru-07,
                <p>posh.com</p>
                <p>+91 98765 43210</p>
            </div>

            <div class="invoice-body">
                <p><strong>Billed To:</strong></p>
                <p><?php echo $order_info['user_name']; ?></p>
                <p><?php echo $order_info['user_address']; ?></p>
                <p><?php echo $order_info['user_city']; ?></p>
                <p><?php echo $order_info['user_state']; ?></p>
                <p><?php echo $order_info['user_phone']; ?></p><br/>

                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th  style="text-align: center;">Product Name</th>
                            <th  style="text-align: center;">Quantity</th>
                            <th  style="text-align: center;">Price</th>
                            <th  style="text-align: center;">Total (Included Tax)</th>
                        </tr>
                    </thead>
                    <tbody >
                        <center><p><b>Order Number: ODR<?php echo str_pad($row['order_id'], 3, '0', STR_PAD_LEFT); ?></b></p></center><br/>
                        <?php 
                        // Check if there are items in the order_details
                        if ($order_details->num_rows > 0) {
                            while($row = $order_details->fetch_assoc()) { 
                                // Calculate total for each item
                                $total = $row['product_quantity'] * $row['product_price'];
                        ?>
                                <tr >
                                    <td  style="text-align: center;"><?php echo $row['product_name']; ?></td>
                                    <td  style="text-align: center;"><?php echo $row['product_quantity']; ?></td>
                                    <td  style="text-align: center;"><?php echo $row['product_price']; ?></td>
                                    <td  style="text-align: center;"><?php echo $total; ?></td>
                                </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='4'>No items in the order</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <div class="invoice-total">
                    <?php
                    // Calculate the total amount for all products
                    $totalAmount = 0;
                    $order_details->data_seek(0); // Reset result set pointer
                    while($row = $order_details->fetch_assoc()) {
                        $totalAmount += $row['product_quantity'] * $row['product_price'];
                    }
                    ?>
                    <p><strong>Grand Total: </strong>&#8377; <?php echo $totalAmount;?></p>
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <div style="text-align: right;">
        <p><img src="Assets/signature.png" alt="Digital Signature" style="width: 100px; height: auto;"></p>
        <p>Authorised Sign</p>
    </div>
    <div class="footer" style="text-align: center; margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
        <p>Thank you for shopping with Posh Boutique!</p>
        <p>For any inquiries, please contact support @ <a href="contact.php" style="text-decoration: none; color: black;">posh.com</a></p>
    </div>
</div>

<center>
    <p id="savePaper">Save Paper Save Earth</p>
    <p id="printInvoiceText">Print the invoice if necessary</p>    
    <button id="printButton" onclick="printInvoice()"><i style="font-size:20px" class="fa" color="black">&#xf02f;</i></button>
</center>

<script>
    function printInvoice() {
        // Remove the paragraphs
        document.getElementById("savePaper").remove();
        document.getElementById("printInvoiceText").remove();

        // Remove the print button
        document.getElementById("printButton").remove();

        // Trigger the print function
        window.print();
    }
</script>

</body>
</html>
