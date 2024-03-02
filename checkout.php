<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, set a session variable with a message
    $_SESSION['login_message'] = 'Please login/register for placing an order';
    header('Location: login_user.php');
    exit();
}

if (!empty($_SESSION['cart']) && isset($_POST['checkout'])) {

} else {
    header('location:index.php');
}

// Check if the form is submitted to place an order
if (!empty($_SESSION['cart']) && isset($_POST['place_order'])) {
    // Process the order logic here
    header('Location: place_order.php');
    exit();
}

// Generate a random date within a 1-3 day period
$startDate = (new DateTime())->format('Y-m-d');
$endDate = (new DateTime())->modify('+3 days')->format('Y-m-d');
$randomDate = date('Y-m-d', mt_rand(strtotime($startDate), strtotime($endDate)));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
         body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            background-color: #f8f8f8;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: lavender;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #3498db;
            margin-bottom: 20px;
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .col-25,
        .col-50,
        .col-75 {
            float: left;
            width: 100%;
            padding: 0 20px;
            box-sizing: border-box;
        }

        label {
            margin-bottom: 8px;
            display: block;
            font-weight: bold;
        }

        input[type=text],
        input[type=email],
        input[type=date],
      
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 15px;
            display: inline-block;
        }

        .location {
            width: 100%;
            padding: 12px;
            border: 1px solid #3498db;
            border-radius: 4px;
            background-color: #3498db;
            color: white;
            font-size: 17px;
            cursor: pointer;
            display: inline-block;
        }

        .location:hover {
            background-color: #2980b9;
        }

        .col-50 {
            margin-top: -6px;
        }

        .btn {
            background-color: #3498db;
            color: white;
            padding: 14px;
            margin: 10px 0;
            border: none;
            width: 30%;
            border-radius: 25px;
            cursor: pointer;
            font-size: 17px;
        }

        .btn:hover {
          background-color:#45a049;
        }

        .copyright {
            text-align: center;
            margin-top: 20px;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Checkout</h2>
        <form action="place_order.php" method="POST">
            <button onclick="history.back()" style='background-color:white'><span
                    style='font-size:20px; background-color:white'>&#129092;</span></button>
            <div class="row">
                <div class="col-50">
                    <h3>Shipping Address</h3>
                    <label for="fname">Full Name</label>
                    <input type="text" id="fname" name="name" placeholder="SRISHA L" required>

                    <label for="adr">Address</label>
                    <input type="text" id="adr" name="address" placeholder="#123, 15th Street" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="srisha@gmail.com" required>
                </div>

                <div class="col-50">
                    <label for="states">State</label>
                    <select type="select" id="states" name="state" onchange="populateCities()" required>
    <option value="" disabled selected>Select State</option>
    <option value="Karnataka">KARNATAKA</option>
    <option value="Maharashtra">MAHARASHTRA</option>
    <!-- Add more states as needed -->
</select>
<label for="states">City</label>
<select id="cities" name="city" required>
    <option value="" disabled selected>Select City</option>
    <!-- Cities for Karnataka -->
    <option value="Bengaluru" data-state="Karnataka">BENGALURU</option>
    <option value="Mysuru" data-state="Karnataka">MYSURU</option>
    <!-- Cities for Maharashtra -->
    <option value="Mumbai" data-state="Maharashtra">MUMBAI</option>
    <option value="Pune" data-state="Maharashtra">PUNE</option>
    <!-- Add more cities as needed -->
</select>

                    <input type="date" id="deliverydate" name="dod" style="display: none;" value="<?php echo $randomDate; ?>" required>

                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" placeholder="93425 32878" pattern="[0-9]{10}" title="Enter the Mobile number" required>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <?php echo "<h4 style='text-align: left; margin: 8px;'>Total cart Qty: " . $_SESSION['total_items'] . "</h4>"; ?>

                <label for="total_amount"><b>Total Amount: &#8377; <?php echo $_SESSION['total']; ?></b></label>

                <label id="deliveryDateLabel" style="display: none;" for="dod">Delivery by <span><?php echo date('D F j', strtotime($randomDate)); ?></span></label>
            </div>

            <center>
                <input type="submit" value="Place Order" name="place_order" class="btn" data-target="#paymentModal" data-toggle="modal">
            </center>
        </form>
    </div>

    <script>
    function populateCities() {
        var stateSelect = document.getElementById("states");
        var citySelect = document.getElementById("cities");
        var selectedState = stateSelect.options[stateSelect.selectedIndex].value;

        for (var i = 0; i < citySelect.options.length; i++) {
            var option = citySelect.options[i];
            if (option.getAttribute("data-state") === selectedState || option.getAttribute("data-state") === null) {
                option.style.display = "block";
            } else {
                option.style.display = "none";
            }
        }

        // Check if both state and city are selected
        var selectedCity = citySelect.options[citySelect.selectedIndex].value;
        var deliveryDateLabel = document.getElementById("deliveryDateLabel");
        var deliveryDateSpan = document.getElementById("deliveryDateSpan");

        if (selectedState !== "" && selectedCity !== "") {
            // Show the delivery date label
            deliveryDateLabel.style.display = "block";

            // Set the available delivery dates
            var today = new Date();
            var startDate = new Date(today);
            startDate.setDate(today.getDate() + 2); // Start from the day after tomorrow

            var endDate = new Date(today);
            endDate.setDate(today.getDate() + 7); // 1 week from tomorrow

            deliveryDateSpan.innerHTML = startDate.toLocaleDateString() + " to " + endDate.toLocaleDateString();
        } else {
            // Hide the delivery date label
            deliveryDateLabel.style.display = "none";
        }
    }

    // Trigger populateCities() on state and city change
    document.getElementById("states").addEventListener("change", populateCities);
    document.getElementById("cities").addEventListener("change", populateCities);

    // Trigger populateCities() once on page load to handle initial state
    populateCities();
</script>

    <center>
        <div class="copyright">
            <p>2023 &#169; All Rights Reserved</p>
            <p>Designed and Maintained by <b>Manu </b>and <b>Srisha</b></p>
        </div>
    </center>

</body>

</html>
