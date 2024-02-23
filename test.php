<?php 

include_once("Includes/connection.php"); 

function function_alert($message, $redirectUrl) {
    // Display the alert box
    echo "<script>alert('$message');</script>";
    // Redirect to the specified URL after the alert is closed
    echo "<script>window.location.href = '$redirectUrl';</script>";
}




// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the feedback is not empty
    if (empty(trim($_POST["feedback"]))) {
        
        $message = "Feedback can't be empty";
        $redirectUrl = "login_user.php";
        function_alert($message, $redirectUrl);
    }
  else {
        $feedback = $_POST["feedback"];
        
        // Prepare and bind the INSERT statement to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO feedback (feedback) VALUES (?)");
        $stmt->bind_param("s", $feedback);

        if ($stmt->execute()) {
            $message = "Thanks..!\\nWe Received Your Feedback";
            $redirectUrl = "index.php";
            function_alert($message, $redirectUrl);
        } else {
                
        }
        $stmt->close();
    }
}
?>
<html>
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
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

    </style>
</head>
<div class="container">
    <h2>Feedback Form</h2>

    <form action="process_feedback.php" method="post">
        <div class="form-group">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="feedback">Your Feedback:</label>
            <textarea id="feedback" name="feedback" rows="4" required></textarea>
        </div>

        <button type="submit">Submit Feedback</button>
    </form>
</div>

</body>
</html>
