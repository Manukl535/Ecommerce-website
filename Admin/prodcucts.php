
<?php
// Check if the user is logged in as an admin, you may implement your own authentication logic
session_start();
if (!isset($_SESSION['admin_name'])) {
    header('Location: login.php'); // Redirect to login page if not logged in as admin
    exit();
}


include('../Includes/connection.php');

function getProducts($conn)
{
    $productStmt = $conn->prepare("SELECT * FROM products");
    $productStmt->execute();
    $products = $productStmt->get_result();
    $productStmt->close();

    return $products;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $gender = $_POST['Gender'];
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_description = $_POST['product_description'];
    $product_image = $_POST['product_image'];
    $product_price = $_POST['product_price'];
    $product_special_offer = $_POST['product_special_offer'];
    $product_color = $_POST['product_color'];

    $addProductStmt = $conn->prepare("INSERT INTO products (Gender, product_name, product_category, product_description, product_image, product_price, product_special_offer, product_color) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $addProductStmt->bind_param('ssssssss', $gender, $product_name, $product_category, $product_description, $product_image, $product_price, $product_special_offer, $product_color);
    $addProductStmt->execute();
    $addProductStmt->close();
}

if (isset($_GET['delete_product'])) {
    $deleteProductId = $_GET['delete_product'];

    $deleteProductStmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $deleteProductStmt->bind_param('s', $deleteProductId);
    $deleteProductStmt->execute();
    $deleteProductStmt->close();
}

$products = getProducts($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel - Manage Products</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .main-content {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h2, h3 {
            color: #333;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        form div {
            flex: 0 0 48%;
            padding: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: 90%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 50px;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: #d9534f;
            text-decoration: none;
            cursor: pointer;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Additional styles for the export button */
        #export-btn {
            background-color: #008CBA;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        #export-btn:hover {
            background-color: #00587a;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <h2>Manage Products</h2>

        <form method="post" action="" style="border: 1px solid #ddd; padding: 20px; border-radius: 5px;">

            <div>
                <label for="Gender">Gender:</label>
                <input type="text" name="Gender" required>

                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" required>

                <label for="product_category">Product Category:</label>
                <input type="text" name="product_category">

                <label for="product_description">Product Description:</label>
                <input name="product_description" style="resize: none;">
            </div>

            <div>
                <label for="product_image">Product Image Name:</label>
                <input type="text" name="product_image">

                <label for="product_price">Product Price:</label>
                <input type="text" name="product_price" required>

                <label for="product_special_offer">Special Offer:</label>
                <input type="text" name="product_special_offer">

                <label for="product_color">Product Color:</label>
                <input type="text" name="product_color">
            </div>

            <div style="text-align: center; margin: 5px auto;">
                <button type="submit" name="add_product">Add Product</button>
            </div>
        </form>

        <!-- Export button -->
        <button id="export-btn" onclick="exportToExcel()">Export To Excel</button>

        <div>
            <h2>Product List</h2>
            <table id="product-table">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Gender</th>
                        <th>Product Name</th>
                        <th>Product Category</th>
                        <th>Product Description</th>
                        <th>Product Image</th>
                        <th>Product Price</th>
                        <th>Product Special Offer</th>
                        <th>Product Color</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $products->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['product_id']; ?></td>
                            <td><?php echo $row['Gender']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['product_category']; ?></td>
                            <td><?php echo $row['product_description']; ?></td>
                            <td><?php echo $row['product_image']; ?></td>
                            <td><?php echo $row['product_price']; ?></td>
                            <td><?php echo $row['product_special_offer'] ?? 'N/A'; ?></td>
                            <td><?php echo $row['product_color']; ?></td>
                            <td>
                                <a href="?delete_product=<?php echo $row['product_id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include the SheetJS library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

    <script>
        function exportToExcel() {
            /* Get table data */
            var table = document.querySelector('#product-table');

            /* Create a workbook containing the table data */
            var ws = XLSX.utils.table_to_sheet(table);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

            /* Save the workbook to a file */
            XLSX.writeFile(wb, 'products.xlsx');
        }
    </script>
</body>

</html>
