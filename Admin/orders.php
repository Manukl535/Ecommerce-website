<?php
// Check if the user is logged in as an admin, you may implement your own authentication logic
session_start();
if (!isset($_SESSION['admin_name'])) {
    header('Location: login.php'); // Redirect to login page if not logged in as admin
    exit();
}

include('../Includes/connection.php');




$stmt = $conn->prepare("SELECT * FROM order_item ORDER BY dod DESC");
$stmt->execute();
$orders = $stmt->get_result();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
     body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.profile-section {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 20px;
}

.orders-heading {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

.order-box {
    margin-top: 20px;
}

.table th,
.table td {
    border: 1px solid #dee2e6;
    padding: 12px;
    text-align: left;
}

.table th {
    background-color: #f2f2f2;
}

button {
    background-color: #007bff;
    color: #ffffff;
    padding: 12px 24px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
}

button:hover {
    background-color: #0056b3;
}

/* Responsive styles */
@media (max-width: 768px) {
    .table th,
    .table td {
        font-size: 14px;
    }

    button {
        width: 100%;
    }
}

</style>
    
    <title>Admin Panel - Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>



  

    <div class="profile-section">

                <a href="#" onclick="window.history.back(); return false;"><i style="font-size:24px" class="fa">&#xf190;</i></a>

            &nbsp;

            <a href="dashboard.php"><i style="font-size:24px" class="fa">&#xf015;</i></a>

            <br/>
    <button onclick="exportToExcel()">Export to Excel</button>
        <h4 class="orders-heading">Orders</h4>
    
        <div class="order-box">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Order ID</th>
                            <th style="text-align: center;">Order Date</th>
                            <th style="text-align: center;">Order Status</th>
                            <th style="text-align: center;">Order Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $orders->fetch_assoc()) { ?>
                            <tr>
                                <td style="text-align: center;">ODR<?php echo str_pad($row['order_id'], 3, '0', STR_PAD_LEFT); ?></td>
                                <td style="text-align: center;"><?php echo date('d-m-Y', strtotime($row['order_date'])); ?></td>

                                   <?php
                                    $dod = $row['dod'];
                                    $formatted_date = date('d-m-Y', strtotime($dod));
                                    $isDelivered = strtotime($dod) <= strtotime(date('Y-m-d'));
                                    $statusText = $isDelivered ? 'Delivered' : 'Delivery On';
                                    $statusColor = $isDelivered ? 'green' : 'black';
                                    ?>

                                <td style="text-align: center; color: <?php echo $statusColor; ?>"><strong><?php echo $statusText . ': ' . $formatted_date; ?></strong></td>

                                <td style="text-align: center;">&#8377; <?php echo $row['product_price']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
           
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

<script>
    function exportToExcel() {
    /* Get table data */
    var table = document.querySelector('.table');

    /* Remove the rupee icon from the cost cells */
    var costCells = table.querySelectorAll('tbody td:nth-child(4)');
    costCells.forEach(function (cell) {
        var costText = cell.innerText.trim();
        cell.innerText = costText.replace('₹', ''); // Remove the rupee icon
    });

    /* Modify the cell content for delivery status */
    var rows = table.querySelectorAll('tbody tr');
    rows.forEach(function (row) {
        var statusCell = row.querySelector('td:nth-child(3)');
        var statusText = statusCell.innerText.split(':')[0].trim();
        statusCell.innerText = statusText;
    });

    /* Create a workbook containing the modified table data */
    var ws = XLSX.utils.table_to_sheet(table);
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

    /* Save the workbook to a file */
    XLSX.writeFile(wb, 'orders.xlsx');
}


</script>

</body>

</html>
