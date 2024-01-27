<?php
session_start();
include('Includes/connection.php');

if (isset($_GET['invoice_btn']) && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $stmt = $conn->prepare("SELECT * FROM order_item 
                        JOIN orders ON order_item.order_id = orders.order_id
                        WHERE order_item.order_id=?");

    $stmt->bind_param('i', $order_id);
    $stmt->execute();

    $order_details = $stmt->get_result();
    
    // Retrieve billed address from orders table
    $stmt1=$conn->prepare("SELECT user_name,user_phone,user_address,user_city,user_state FROM orders WHERE order_id=?");
    $stmt1->bind_param('i', $order_id);
    $stmt1->execute();
    $order_info = $stmt1->get_result()->fetch_assoc();
    $stmt1->close();
} else {
    header('location:account.php');
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
            height:84vh;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
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
    </style>
   
</head>
<body>

<?php
while($row = $order_details->fetch_assoc()) {
?>
<div class="invoice">
    <center><h1>Invoice</h1></center>
    <div class="invoice-header" >
        <p>Invoice No: OD00<?php echo $row['order_id'];?></p>
        <p>Date:<?php echo $row['order_date'];?></p>
    </div>
    <div class="company-profile">
        <h2>Posh Botique</h2>
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
        <p><?php echo $order_info['user_phone']; ?></p>
        

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
                <?php
                // Loop through each product
                do {
                ?>
                <tr>
                    <td>OD00<?php echo $row['order_id'];?></td>
                    <td><?php echo $row['product_name'];?></td>
                    <td><?php echo $row['product_quantity'];?></td>
                    <td><?php echo $row['product_price'];?></td>
                    <td><?php echo $row['product_quantity'] * $row['product_price'];?></td>
                </tr>
                <?php
                } while($row = $order_details->fetch_assoc());
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
            <p><strong>Total: </strong>&#8377; <?php echo $totalAmount;?></p>
        </div>
    </div>

    
</div>

<center><button onclick="window.print()"><i style="font-size:24px" class="fa">&#xf02f;</i></button></center>

</body>
</html>
<?php
}
?>