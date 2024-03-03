<?php
    // Check if the user is logged in as an admin, you may implement your own authentication logic
    session_start();
    if (!isset($_SESSION['admin_name'])) {
        header('Location: login.php'); // Redirect to login page if not logged in as admin
        exit();
    }

    // Include database connection and fetch order, user, and return counts
    include('../Includes/connection.php');

    // Fetch order count
    $orderStmt = $conn->prepare("SELECT COUNT(*) AS orderCount FROM order_item");
    $orderStmt->execute();
    $orderCountResult = $orderStmt->get_result();
    $orderCount = $orderCountResult->fetch_assoc()['orderCount'];
    $orderStmt->close();

    // Fetch user count
    $userStmt = $conn->prepare("SELECT COUNT(*) AS userCount FROM users");
    $userStmt->execute();
    $userCountResult = $userStmt->get_result();
    $userCount = $userCountResult->fetch_assoc()['userCount'];
    $userStmt->close();

    // Fetch return count
    $returnStmt = $conn->prepare("SELECT COUNT(*) AS returnCount FROM return_requests");
    $returnStmt->execute();
    $returnCountResult = $returnStmt->get_result();
    $returnCount = $returnCountResult->fetch_assoc()['returnCount'];
    $returnStmt->close();

    // Calculate sales percentage
    $salesPercentage = ($orderCount - $returnCount) / $orderCount * 100;

    // Format the percentage to two decimal places
    $salesPercentage = number_format($salesPercentage, 2);

    // Fetch total amount received from orders
    $amountReceivedStmt = $conn->prepare("SELECT SUM(product_price) AS totalAmountReceived FROM order_item");
    $amountReceivedStmt->execute();
    $amountReceivedResult = $amountReceivedStmt->get_result();
    $totalAmountReceived = $amountReceivedResult->fetch_assoc()['totalAmountReceived'];
    $amountReceivedStmt->close();
    
    //product quantity 
    $stmtQuantity = $conn->prepare("SELECT SUM(available_qty) as quantity FROM products");
    $stmtQuantity->execute();
    $resultQuantity = $stmtQuantity->get_result();
    $rowQuantity = $resultQuantity->fetch_assoc();

    //product count
    $stmtCount = $conn->prepare("SELECT COUNT(*) as totalProducts FROM products");
    $stmtCount->execute();
    $resultCount = $stmtCount->get_result();
    $rowCount = $resultCount->fetch_assoc();

    $totalProducts = $rowCount['totalProducts'];
    $totalQuantity = $rowQuantity['quantity'];
 // Fetch total refund amount
    $refundAmountStmt = $conn->prepare("SELECT SUM(product_price) AS totalRefundAmount FROM return_requests");
    $refundAmountStmt->execute();
    $refundAmountResult = $refundAmountStmt->get_result();
    $totalRefundAmount = $refundAmountResult->fetch_assoc()['totalRefundAmount'];
    $refundAmountStmt->close();

    // Calculate remaining amount in Indian Rupees
    $remainingAmount = $totalAmountReceived - $totalRefundAmount;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: "Raleway", sans-serif
        }
    </style>
</head>

<body class="w3-light-grey">

    <!-- Top container -->
    <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
        <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey"
            onclick="w3_open();"><i class="fa fa-bars"></i> &nbsp;M 
            
    <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
        <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey"
            onclick="w3_open();"><i class="fa fa-bars"></i> &nbsp;Menu</button>
        <span class="w3-bar-item w3-right"><a href="logout.php" style="text-decoration:none;">Logout</a></span>
    </div>

    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
        <div class="w3-container w3-row">
            <div class="w3-col s4">
                <!-- Add your logo or any other content here -->
            </div>
            <div class="w3-col s8 w3-bar">
                <!-- Add any welcome message or user information here -->
                <span>Welcome, <strong><?php echo $_SESSION['admin_name']; ?></strong></span><br>
            </div>
        </div>
        <hr>
        <div class="w3-container">
            <h5>Dashboard</h5>
        </div>
        <div class="w3-bar-block">
            <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black"
                onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>&nbsp; Close Menu</a>

            <a href="dashboard.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>&nbsp; Overview</a>

            <div style="margin-top: 10px;"></div> <!-- Add space between menu items -->

            <a href="orders.php" class="w3-bar-item w3-button w3-padding w3-green"><i class="fa fa-shopping-cart fa-fw"></i>&nbsp; Orders (<?php echo $orderCount; ?>)</a>

            <div style="margin-top: 10px;"></div> <!-- Add space between menu items -->

            <a href="prodcucts.php" class="w3-bar-item w3-button w3-padding w3-orange"><i class="fa fa-cube fa-fw"></i>&nbsp; Products (<?php echo $totalProducts; ?>)</a>
            
            <div style="margin-top: 10px;"></div> <!-- Add space between menu items -->
            
            <a href="returns.php" class="w3-bar-item w3-button w3-padding w3-pink">

            <i class="fa fa-undo fa-fw"></i>&nbsp; Returns (<?php echo $returnCount; ?>)</a>

            <div style="margin-top: 10px;"></div> <!-- Add space between menu items -->

            <a href="account_settings.php" class="w3-bar-item w3-button w3-padding w3-light-blue"><i class="fa fa-cog fa-fw"></i>&nbsp; Account Settings</a>

            
            <!-- Add more menu items as needed -->
        </div>
    </nav>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer"
        title="close side menu" id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main" style="margin-left:300px;margin-top:43px;">

        <!-- Header -->
        <header class="w3-container" style="padding-top:22px">
            <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
        </header>

        <!-- Statistics Cards -->
        <div class="w3-row-padding w3-margin-bottom">
            <div class="w3-quarter">
                <div class="w3-container w3-orange w3-text-white w3-padding-16">
                    <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
                    <div class="w3-right">
                        <h3><?php echo $userCount; ?></h3>
                    </div>
                    <div class="w3-clear"></div>
                    <h4>Users</h4>
                </div>
            </div>

            <div class="w3-quarter">
                <div class="w3-container w3-blue w3-padding-16">
                    <div class="w3-left"><img src="../Assets/orders.png"></div>
                    <div class="w3-right">
                        <h3><?php echo $orderCount; ?></h3>
                    </div>
                    <div class="w3-clear"></div>
                    <h4>Orders</h4>
                </div>
            </div>
            
            <div class="w3-quarter">
                <div class="w3-container w3-teal w3-padding-16">
                    <div class="w3-left"><span style='font-size:38px; font-weight: bold;'>&#10226;</span></div>
                    <div class="w3-right">
                        <h3><?php echo $returnCount; ?></h3>
                    </div>
                    <div class="w3-clear"></div>
                    <h4>Returns</h4>
                </div>
            </div>
            
            
            <div class="w3-quarter">
                <div class="w3-container w3-green w3-padding-16">
                    <div class="w3-left"><i class="fa fa-line-chart w3-xxxlarge"></i></div>
                    <div class="w3-right">
                        <h3><?php echo $salesPercentage; ?>%</h3>
                    </div>
                    <div class="w3-clear"></div>
                    <h4>Sales</h4>
                </div>
            </div>
            
           

        
        

        <hr>
            
        <div class="w3-quarter" style="margin:10px 0.1px 10px 0">
    <div class="w3-container w3-light-blue w3-padding-16">
        <div class="w3-left"><img src="../Assets/product.png" alt=""></div>
        <div class="w3-right">
            <h3><?php echo $totalProducts; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Total Products</h4>
    </div>
</div>
<div class="w3-quarter" style="margin:10px 0.1px 10px 0">
    <div class="w3-container w3-yellow w3-padding-16">
        <div class="w3-left"><i class="fa fa-cubes" style="font-size:36px"></i></div>
        <div class="w3-right">
            <h3><?php echo $totalQuantity ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Inventory Stock</h4>
    </div>
</div>


<!-- Balance section -->
<div class="w3-quarter" style="margin:10px 20px 10px 0">
    <div class="w3-container w3-purple w3-padding-16">
        <div class="w3-left"><i class="fa fa-inr w3-xxxlarge"></i></div>
        <div class="w3-right">
            <h3><?php echo number_format($remainingAmount, 2); ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Balance</h4>
    </div>
</div>
<!-- General Stats -->
        <div class="w3-container">
            <h5>General Stats</h5>
            <div class="w3-row-padding">
                <div class="w3-third">
                    <p>New Visitors</p>
                    <div class="w3-grey">
                        <div class="w3-container w3-center w3-padding w3-green" style="width:25%">+25%</div>
                    </div>
                </div>
                <div class="w3-third">
                    <p>New Users</p>
                    <div class="w3-grey">
                        <div class="w3-container w3-center w3-padding w3-orange" style="width:50%">50%</div>
                    </div>
                </div>
                <div class="w3-third">
                    <p>Sales</p>
                    <div class="w3-grey">
                        <div class="w3-container w3-center w3-padding w3-green" style="width:<?php echo $salesPercentage; ?>%"><?php echo $salesPercentage; ?>%</div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Your script to toggle the sidebar -->
        <script>
            var mySidebar = document.getElementById("mySidebar");
            var overlayBg = document.getElementById("myOverlay");

            function w3_open() {
                if (mySidebar.style.display === 'block') {
                    mySidebar.style.display = 'none';
                    overlayBg.style.display = "none";
                } else {
                    mySidebar.style.display = 'block';
                    overlayBg.style.display = "block";
                }
            }

            function w3_close() {
                mySidebar.style.display = "none";
                overlayBg.style.display = "none";
            }
        </script>

    </div>
    <div class="copyright" style="text-align:center;">
        <p>2023 &#169; All Rights Reserved</p><p>Designed and Maintained by <b>Manu </b>and <b>Srisha</b></p>
    </div>
</body>

</html>
