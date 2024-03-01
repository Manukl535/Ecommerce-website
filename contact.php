<?php
// Include the database connection file
include('Includes/connection.php');

// Function to display an alert and redirect
function function_alert($message, $redirectUrl) {
    // Display the alert box
    echo "<script>alert('$message');</script>";
    // Redirect to the specified URL after the alert is closed
    echo "<script>window.location.href = '$redirectUrl';</script>";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid Email Format";
        $redirectUrl = "index.php"; // Adjust the URL
        function_alert($message, $redirectUrl);
        exit(); // Stop further execution
    }

    // Prepare and bind the INSERT statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, phone, feedback) VALUES (?, ?, ?, ?)");

    // Check for errors in preparing the statement
    if (!$stmt) {
        $message = "Error in preparing the SQL statement";
        $redirectUrl = "index.php"; // Adjust the URL
        function_alert($message, $redirectUrl);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    // Execute the statement
    $result = $stmt->execute();

    // Check for errors in executing the statement
    if (!$result) {
        $message = "Error in executing the SQL statement: " . $stmt->error;
        $redirectUrl = "index.php"; // Adjust the URL
        function_alert($message, $redirectUrl);
    }

    // Close the statement
    $stmt->close();

    // Check if the execution was successful
    if ($result) {
        $message = "Thanks..!\\nWe Received Your Feedback";
        $redirectUrl = "index.php"; // Adjust the URL
        function_alert($message, $redirectUrl);
    } else {
        // Handle the case when the insertion fails
        $message = "Failed to submit feedback. Please try again.";
        $redirectUrl = "index.php"; // Adjust the URL
        function_alert($message, $redirectUrl);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="Assets/logo2.png">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header Section -->
    <?php include_once("includes/head.php"); ?>

    <section id="contact_us" class="contact">
        <h2>#let's_meet</h2>
        <p>We are happy to hear from you...</p>
    </section>
    <br><br></br/>

    <section id="contact" class="contact_us">
        <div class="">              
            <h4>Meet Us</h4> <br/> 
            <h5>Head Office:</h5>
            <p>Address: 223 Main Street Electronic City Bengaluru 562107</p>
            <p>Phone: +91 98765 43210</p>
            <p>Email: posh.com</p>
        </div>
    </div>
        
    <div id="map" style="width:50%; height: 300px;"></div>
                
                <script>
                    function myMap() {
                      var mapCanvas = document.getElementById("map");
                      var mapOptions = {
                        center: new google.maps.LatLng(12.840711, 77.676369), zoom: 10
                      };
                      var map = new google.maps.Map(mapCanvas, mapOptions);
                    }
                 </script>
                    
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCIRoC23VBrHHRJbgQosiK-SfHLm74JWQ&callback=myMap"></script>

        </section>
        <br/>
   
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px 10px auto;
            padding: 20px;
            text-align: left; 
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            width: 20%;
            font-weight: 700;
        }

        button:hover {
            background-color: #45a049;
        }

        .center {
            text-align: center;
        }
    </style>
    
    <div class="container">
        <h4>Leave us a Message</h4><br/>
        <form action="contact.php" method="post" onsubmit="return validateEmail()">
            <div class="form-group">
                <label for="name"> Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|in)">
</div>


            <div class="form-group">
                <label for="phone"> Phone:</label>
                <input type="phone" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="feedback"> Feedback:</label>
                <textarea id="feedback" name="message" rows="4" required style="resize:none;"></textarea>
            </div>
            
            <div class="center">
                <button type="submit" name="feedback">Submit</button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="section-p1">
        <div class="copyright">
            <p>2023 &#169; All Rights Reserved</p>
            <p>Designed and Maintained by <b>Manu</b> and <b>Srisha</b></p>
        </div>
    </footer>           
    <script>
        function validateEmail() {
            var emailInput = document.getElementById('email');
            var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (!emailPattern.test(emailInput.value)) {
                alert('Invalid Email Format');
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>
</body>
</html>
