<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    header('Location: login.php');
    exit();
}

// Include the database connection
include('../Includes/connection.php');

// Function to get products from the database
function getProducts($conn)
{
    $productStmt = $conn->prepare("SELECT * FROM products");
    $productStmt->execute();
    $products = $productStmt->get_result();
    $productStmt->close();

    return $products;
}

// Check if the add product form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    // Extract form data
    $gender = $_POST['Gender'];
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_description = $_POST['product_description'];
    $product_image = $_POST['product_image'];
    $product_price = $_POST['product_price'];
    $product_special_offer = $_POST['product_special_offer'];
    $product_color = $_POST['product_color'];
    $available_qty = $_POST['available_qty'];

    // Prepare and execute the INSERT query
    $addProductStmt = $conn->prepare("INSERT INTO products (Gender, product_name, product_category, product_description, product_image, product_price, product_special_offer, product_color, available_qty) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $addProductStmt->bind_param('ssssssssi', $gender, $product_name, $product_category, $product_description, $product_image, $product_price, $product_special_offer, $product_color, $available_qty);
    $addProductStmt->execute();
    $addProductStmt->close();
}

// Check if the update product form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    // Extract form data
    $updateProductId = $_POST['product_id'];
    $newQuantity = $_POST['available_qty'];

    // Prepare and execute the UPDATE query
    $updateProductStmt = $conn->prepare("UPDATE products SET available_qty = ? WHERE product_id = ?");
    $updateProductStmt->bind_param('ii', $newQuantity, $updateProductId);
    $updateProductStmt->execute();
    $updateProductStmt->close();
}

// Check if the delete product is requested
if (isset($_GET['delete_product'])) {
    // Extract product ID
    $deleteProductId = $_GET['delete_product'];

    // Prepare and execute the DELETE query
    $deleteProductStmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $deleteProductStmt->bind_param('s', $deleteProductId);
    $deleteProductStmt->execute();
    $deleteProductStmt->close();
}

// Fetch products using the getProducts function
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

        .update-btn {
            background-color: #008CBA;
            color: #fff;
            padding: 5px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }

        .update-btn:hover {
            background-color: #00587a;
        }

        .update-row {
            display: none;
        }

        .editable-qty input {
            width: 60px;
            margin-right: 10px;
        }

        .export-btn {
            background-color: #337ab7;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .export-btn:hover {
            background-color: #286090;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="main-content">
        
    <div class="profile-section">

<a href="#" onclick="window.history.back(); return false;"><i style="font-size:24px;color:blue;" class="fa">&#xf190;</i></a>

&nbsp;

<a href="dashboard.php"><i style="font-size:24px;color:blue;" class="fa">&#xf015;</i></a>

<br/>
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

                <label for="available_qty">Available Quantity:</label>
                <input type="text" name="available_qty" required>
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
                    <button type="submit" name="add_product" onclick="return confirm('Are you sure about adding the product?')">Add Product</button>
                </div>
        </form>

        <div>
            <h2>Product List</h2>

            <!-- Export to Excel button -->
            <button class="export-btn" onclick="exportToExcel('product-table')">Export to Excel</button>

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
                        <th>Available Quantity</th>
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
                            <td><?php echo $row['product_color'] ?? 'N/A'; ?></td>
                            <td class="editable-qty">
                                <span><?php echo $row['available_qty']; ?></span>
                                <br>
                                <button type="button" class="update-btn" data-product-id="<?php echo $row['product_id']; ?>">Update</button>
                            </td>
                            <td>
                                <a href="?delete_product=<?php echo $row['product_id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                            </td>
                        </tr>
                        <tr class="update-row" data-product-id="<?php echo $row['product_id']; ?>">
                            <td colspan="5">
                                <input type="text" name="available_qty" placeholder="New Quantity" style="width: 20%;">
                                <button type="button" class="update-btn" data-product-id="<?php echo $row['product_id']; ?>">Save</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Function to export table data to Excel
        function exportToExcel(tableId) {
            var tab_text = "<table border='2px'><tr>";
            var textRange; var j = 0;
            tab = document.getElementById(tableId); // id of table

            for (j = 0; j < tab.rows.length; j++) {
                tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
                //tab_text=tab_text+"</tr>";
            }

            tab_text = tab_text + "</table>";
            tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
            tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
            tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");

            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
            {
                txtArea1.document.open("txt/html", "replace");
                txtArea1.document.write(tab_text);
                txtArea1.document.close();
                txtArea1.focus();
                sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
            }
            else {
                sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
            }

            return (sa);
        }

        document.addEventListener('DOMContentLoaded', function () {
            var updateButtons = document.querySelectorAll('.update-btn');
            updateButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var productId = this.getAttribute('data-product-id');
                    var updateRow = document.querySelector('.update-row[data-product-id="' + productId + '"]');
                    updateRow.style.display = 'table-row';

                    // Add click event listener for the "Save" button in the update row
                    var saveButton = updateRow.querySelector('.update-btn');
                    saveButton.addEventListener('click', function () {
                        var newQuantityInput = updateRow.querySelector('input[name="available_qty"]');
                        var newQuantity = newQuantityInput.value;

                        // Send the updated quantity to the server using AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'update_quantity.php', true);
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                // Handle the response from the server if needed
                                alert(xhr.responseText);
                                // Reload the page after updating the quantity
                                location.reload();
                            }
                        };
                        xhr.send('product_id=' + productId + '&new_quantity=' + newQuantity);
                    });
                });
            });
        });
    </script>
</body>

</html>
