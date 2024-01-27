<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .invoice {
            width: 60%;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            margin: 0;
            color: #333;
        }
        .invoice-body {
            margin-top: 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
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
    </style>
</head>
<body>

<?php
// Sample data (replace this with your actual data retrieval logic)
$orderDetails = [
    'order_id' => 'OD123',
    'order_date' => '2024-01-27',
    'products' => [
        ['name' => 'Product A', 'quantity' => 2, 'price' => 50],
        ['name' => 'Product B', 'quantity' => 1, 'price' => 30],
        ['name' => 'Product C', 'quantity' => 3, 'price' => 20],
    ],
];

$totalAmount = 0;
?>

<div class="invoice">
    <div class="invoice-header">
        <h1>Invoice</h1>
        <p>Invoice No: <?php echo $orderDetails['order_id'];?></p>
        <p>Date: <?php echo $orderDetails['order_date'];?></p>
    </div>
    <div class="invoice-body">
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderDetails['products'] as $product) : ?>
                    <tr>
                        <td><?php echo $orderDetails['order_id'];?></td>
                        <td><?php echo $product['name'];?></td>
                        <td><?php echo $product['quantity'];?></td>
                        <td><?php echo $product['price'];?></td>
                        <td><?php
                            $productTotal = $product['quantity'] * $product['price'];
                            $totalAmount += $productTotal;
                            echo $productTotal;
                        ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="invoice-total">
            <p><strong>Total: </strong>&#8377; <?php echo $totalAmount;?></p>
        </div>
    </div>
</div>

</body>
</html>
