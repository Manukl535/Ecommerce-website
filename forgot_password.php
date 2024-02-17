<?php
// Include database connection
include('Includes/connection.php');

// Include Twilio dependencies
require_once 'C:\xampp\htdocs\twilio-php-main\src\Twilio\autoload.php';
use Twilio\Rest\Client;

// Your Twilio credentials
$sid = "ACc52a9ad7912313f3a2fac31a004cb494";
$token = "dd17626c541f7546c284653c62e085da";
$twilioPhoneNumber = '+15169798118'; 
$twilio = new Client($sid, $token);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit']) && isset($_POST['phone'])) {
        // Generate OTP (You may use a library or your own method)
        $otp = rand(100000, 999999);
        $phone = $_POST['phone'];

        // Update the database with the generated OTP
        $updateQuery = "UPDATE users SET otp = '$otp' WHERE phone = '$phone'";
        $conn->query($updateQuery);

        // Send OTP to the registered mobile number using Twilio
        $message = $twilio->messages
            ->create($phone, // To
                [
                    'from' => $twilioPhoneNumber,
                    'body' => "Your OTP is: $otp",
                ]
            );

        // Redirect to OTP verification page
        header("Location: forgot_password.php?verify=true&phone=" . urlencode($phone));
        exit();
    } elseif (isset($_POST['verify']) && isset($_POST['otp']) && isset($_POST['phone'])) {
        // Verify OTP logic
        $enteredOtp = $_POST['otp'];
        $phone = $_POST['phone'];

        // Retrieve stored OTP from the database
        $getStoredOtpQuery = "SELECT otp FROM users WHERE phone = '$phone'";
        $result = $conn->query($getStoredOtpQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedOtp = $row['otp'];

            // Check if the entered OTP matches the stored OTP in the database
            if ($enteredOtp == $storedOtp) {
                // OTP is valid, proceed to change password
                // Redirect to change password page
                header("Location: forgot_password.php?change=true&phone=" . urlencode($phone));
                exit();
            } else {
                echo "Invalid OTP. Please try again.";
            }
        } else {
            echo "User not found or OTP not generated. Please try again.";
        }
    } elseif (isset($_POST['change_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password']) && isset($_POST['phone'])) {
        // Change password logic
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];
        $phone = $_POST['phone'];

        // Check if the new password and confirm password match
        if ($newPassword === $confirmPassword) {
            // Update the password in the database
            $updatePasswordQuery = "UPDATE users SET password = '$newPassword' WHERE phone = '$phone'";
            $conn->query($updatePasswordQuery);

            // Redirect to login page
            header("Location: login_user.php");
            exit();
        } else {
            echo "Passwords do not match. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Forgot Password</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px; 
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); 
        width: 300px; 
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 15px; 
        font-weight: bold; 
    }

    input {
        padding: 12px; 
        margin-bottom: 20px; 
        border: 1px solid #ccc; 
        border-radius: 5px; 
        transition: border-color 0.3s ease; 
    }

    input:focus {
        outline: none; 
        border-color: #4caf50; 
    }

    button {
        background-color: #4caf50;
        color: #fff;
        padding: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease; 
    }

    button:hover {
        background-color: #45a049;
    }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_GET['verify']) && $_GET['verify'] == 'true'): ?>
            <form action="forgot_password.php" method="post">
                <h2>Verify OTP</h2>
                <label for="otp">Enter OTP:</label>
                <input type="text" name="otp" required>
                <input type="hidden" name="phone" value="<?php echo htmlspecialchars($_GET['phone']); ?>">
                <button type="submit" name="verify">Verify OTP</button>
            </form>
        <?php elseif (isset($_GET['change']) && $_GET['change'] == 'true'): ?>
            <form action="forgot_password.php" method="post">
                <h2>Change Password</h2>
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" required>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" required>
                <input type="hidden" name="phone" value="<?php echo htmlspecialchars($_GET['phone']); ?>">
                <button type="submit" name="change_password">Change Password</button>
            </form>
        <?php else: ?>
            <form action="forgot_password.php" method="post">
                <h2>Forgot Password?</h2>
                <label for="phone">Mobile Number (With +91):</label>
                <input type="text" name="phone" placeholder="+917022015320" required>
                <button type="submit" name="submit">Submit</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
