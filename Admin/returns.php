<?php
session_start();
include('../Includes/connection.php');

$stmt = $conn->prepare("SELECT * FROM return_requests");
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
            background-color: #f8f9fa; /* Bootstrap background color */
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
        }

        .order-box {
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }
        button {
        background-color: #007bff;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }

    button:hover {
        background-color: #0056b3;
    }
    </style>
    <title>Returns</title>
</head>

<body>

    <div class="profile-section">
        <h4 class="orders-heading">Returns</h4>

        <div class="order-box">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product_id</th>
                            <th>Reason</th>
                            <th>Product Price</th>
                            <th>Refund Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $orders->fetch_assoc()) { ?>
                            <tr>
                                <td>ODR<?php echo str_pad($row['order_id'], 3, '0', STR_PAD_LEFT); ?></td>
                                <td><?php echo $row['product_id']; ?></td>
                                <td><?php echo $row['reason']; ?></td>
                                <td><?php echo $row['product_price']; ?></td>
                                <td>Settled</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <button onclick="exportToExcel()">Export to Excel</button>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Modified SheetJS/xlsx script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

    <script>
        function exportToExcel() {
            /* Get table data */
            var table = document.querySelector('.table');
            var ws = XLSX.utils.table_to_sheet(table);

            /* Create a workbook containing the Excel data */
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

            /* Save the workbook to a file */
            XLSX.writeFile(wb, 'returns.xlsx');
        }
    </script>
</body>

</html>
