<?php
    session_start();
    if (!isset($_SESSION['admin_name'])) {
        header('Location: login.php');
        exit();
    }

    include('../Includes/connection.php');

    $orderStmt = $conn->prepare("SELECT COUNT(*) AS orderCount FROM order_item");
    $orderStmt->execute();
    $orderCountResult = $orderStmt->get_result();
    $orderCount = $orderCountResult->fetch_assoc()['orderCount'];
    $orderStmt->close();

    $userStmt = $conn->prepare("SELECT COUNT(*) AS userCount FROM users");
    $userStmt->execute();
    $userCountResult = $userStmt->get_result();
    $userCount = $userCountResult->fetch_assoc()['userCount'];
    $userStmt->close();

    $returnStmt = $conn->prepare("SELECT COUNT(*) AS returnCount FROM return_requests");
    $returnStmt->execute();
    $returnCountResult = $returnStmt->get_result();
    $returnCount = $returnCountResult->fetch_assoc()['returnCount'];
    $returnStmt->close();
    
    if ($orderCount != 0) {
        $salesPercentage = ($orderCount - $returnCount) / $orderCount * 100;
        $salesPercentage = number_format($salesPercentage, 2); 
    } else {
        $salesPercentage = 0; 
    }
    
    
    $amountReceivedStmt = $conn->prepare("SELECT SUM(product_price) AS totalAmountReceived FROM order_item");
    $amountReceivedStmt->execute();
    $amountReceivedResult = $amountReceivedStmt->get_result();
    $totalAmountReceived = $amountReceivedResult->fetch_assoc()['totalAmountReceived'];
    $amountReceivedStmt->close();

    $stmtQuantity = $conn->prepare("SELECT SUM(available_qty) as quantity FROM products");
    $stmtQuantity->execute();
    $resultQuantity = $stmtQuantity->get_result();
    $rowQuantity = $resultQuantity->fetch_assoc();

    $feedbackStmt = $conn->prepare("SELECT COUNT(*) AS feedCount FROM feedback");
    $feedbackStmt->execute();
    $feedbackCountResult = $feedbackStmt->get_result();
    $feedCount = $feedbackCountResult->fetch_assoc()['feedCount'];
    $feedbackStmt->close();  

    $stmtCount = $conn->prepare("SELECT COUNT(*) as totalProducts FROM products");
    $stmtCount->execute();
    $resultCount = $stmtCount->get_result();
    $rowCount = $resultCount->fetch_assoc();

    $totalProducts = $rowCount['totalProducts'];
    $totalQuantity = $rowQuantity['quantity'];

    $refundAmountStmt = $conn->prepare("SELECT SUM(product_price) AS totalRefundAmount FROM return_requests");
    $refundAmountStmt->execute();
    $refundAmountResult = $refundAmountStmt->get_result();
    $totalRefundAmount = $refundAmountResult->fetch_assoc()['totalRefundAmount'];
    $refundAmountStmt->close();

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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
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

    <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
        <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey"
            onclick="w3_open();"><i class="fa fa-bars"></i> &nbsp;Menu</button>
        <span class="w3-bar-item w3-right"><a href="logout.php" style="text-decoration:none;">Logout</a></span>
    </div>

    <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
        <div class="w3-container w3-row">
            <div class="w3-col s8 w3-bar">
                <span style="padding-top:0">Welcome, <strong><?php echo $_SESSION['admin_name']; ?></strong></span><br>
            </div>
        </div>
            <hr>
        <div class="w3-container" style="padding-top:0">
            <h5>Dashboard</h5>
        </div>
        <div class="w3-bar-block">

            <a href="dashboard.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="material-icons" style="font-size:15px">dashboard</i>&nbsp; Overview</a>

            <div style="margin-top: 10px;"></div>

            <a href="orders.php" class="w3-bar-item w3-button w3-padding w3-green"><i class="fa fa-shopping-cart fa-fw"></i>&nbsp; Orders (<?php echo $orderCount; ?>)</a>

            <div style="margin-top: 10px;"></div>

            <a href="prodcucts.php" class="w3-bar-item w3-button w3-padding w3-orange"><i class="fa fa-cube fa-fw"></i>&nbsp; Products (<?php echo $totalProducts; ?>)</a>
            
            <div style="margin-top: 10px;"></div>
            
            <a href="returns.php" class="w3-bar-item w3-button w3-padding w3-pink"><i class="fa fa-undo fa-fw"></i>&nbsp; Returns (<?php echo $returnCount; ?>)</a>

            <div style="margin-top: 10px;"></div>
            
            <a href="feedback.php" class="w3-bar-item w3-button w3-padding w3-yellow"><i class="fa fa-bell fa-fw"></i>&nbsp; Notifications (<?php echo $feedCount; ?>)</a>

            <div style="margin-top: 10px;"></div>

            <a href="account_settings.php" class="w3-bar-item w3-button w3-padding w3-light-blue"><i class="fa fa-cog fa-fw"></i>&nbsp; Account Settings</a>
        </div>

        
    </nav>

    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer"
        title="close side menu" id="myOverlay"></div>

    <div class="w3-main" style="margin-left:300px;margin-top:43px;">

        <header class="w3-container" style="padding-top:0">
            <h5><b><i class="fa fa-dashboard"></i> Dashboard</b></h5>
        </header>

        <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
        <div class="w3-container w3-orange w3-text-white w3-padding-16">
            <div class="w3-left"><i class="fa fa-users w3-xxlarge"></i></div>
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
            <div class="w3-left"><i class="fa fa-line-chart w3-xxlarge"></i></div>
            <div class="w3-right">
                <h3><?php echo $salesPercentage; ?>%</h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Sales</h4>
        </div>
    </div>
        &nbsp;
    <div class="w3-row-padding w3-margin-bottom" style="padding:0 0 10px 0;">
    <div class="w3-quarter">
        <div class="w3-container w3-light-blue w3-padding-16">
            <div class="w3-left"><img src="../Assets/product.png" alt="" style="width:61px;height: 58px;"></div>
            <div class="w3-right">
                <h3><?php echo $totalProducts; ?> </h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Total Products</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-yellow w3-padding-16">
            <div class="w3-left"><i class="fa fa-cubes" style="font-size:38px;"></i></div>
            <div class="w3-right">
                <h3><?php echo $totalQuantity ?></h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Inventory Stock</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-purple w3-padding-16">
            <div class="w3-left"><i class="fa fa-inr w3-xxlarge"></i></div>
            <div class="w3-right">
                <h3><?php echo number_format($remainingAmount, 2); ?></h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Balance</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-red w3-padding-16">
            <div class="w3-left"><i class="fa fa-bell w3-xxlarge"></i></div>
            <div class="w3-right">
                <h3><?php echo $feedCount; ?></h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Notifications</h4>
        </div>
    </div>
</div>
    

<div class="w3-container">
            <h5>General Stats</h5>
            <div class="w3-row-padding">
    <div class="w3-third">
        <p>New Visitors (<?php echo file_get_contents('../visitor_count.txt'); ?>)</p>
        <div class="w3-grey">
            <?php
                // Read visitor count from the file
                $visitorCount = file_get_contents('../visitor_count.txt');
                $visitorCount = intval($visitorCount);

                $usersPerPercentageIncrease = 10; // Set the number of users per 1% increase
                $percentageIncrease = floor($visitorCount / $usersPerPercentageIncrease);

                // Ensure the percentage doesn't exceed 100%
                $width = min($percentageIncrease, 100);

                echo '<div class="w3-container w3-center w3-padding w3-green" style="width:' . $width . '%">' . $width . '%</div>';
            ?>
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
    
    <div class="copyright" style="text-align:center;padding-left:10px;">
        <p>2023 &#169; All Rights Reserved</p><p>Designed and Maintained by <b>Manu </b>and <b>Srisha</b></p>
    </div>
    
</body>

</html>
