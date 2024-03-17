<?php
session_start();
include('../Includes/connection.php');

function function_alert($message, $redirectUrl) {
    echo "<script>alert('$message');</script>";
    echo "<script>window.location.href = '$redirectUrl';</script>";
    exit();
}

require_once 'C:\xampp\htdocs\twilio-php-main\src\Twilio\autoload.php';
use Twilio\Rest\Client;

$sid = "ACc52a9ad7912313f3a2fac31a004cb494";
$token = "dd17626c541f7546c284653c62e085da";
$twilioPhoneNumber = '+15169798118';
$twilio = new Client($sid, $token);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit']) && isset($_POST['phone'])) {
        $otp = rand(100000, 999999);
        $phone = $_POST['phone'];

        // Check if the phone number starts with +91
        if (strpos($phone, '+91') !== 0) {
            function_alert("Please enter a valid phone number starting with +91.", "forgot_pass.php");
        }

        // Update the database with the generated OTP
        $updateQuery = "UPDATE admin SET otp = '$otp' WHERE phone = '$phone'";
        $conn->query($updateQuery);

        // Set the phone number in the session
        $_SESSION['phone'] = $phone;

        // Send OTP to the registered mobile number using Twilio
        $message = $twilio->messages
            ->create($phone, [
                'from' => $twilioPhoneNumber,
                'body' => "Your OTP is: $otp",
            ]);
        
        // Show OTP verification form
        header("Location: forgot_pass.php?verify=true&phone=" . urlencode($phone));
        exit();
    } elseif (isset($_POST['verify']) && isset($_POST['otp']) && isset($_POST['phone'])) {
        $enteredOtp = $_POST['otp'];
        $phone = $_POST['phone'];

        // Retrieve stored OTP from the database
        $getStoredOtpQuery = "SELECT otp FROM admin WHERE phone = '$phone'";
        $result = $conn->query($getStoredOtpQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedOtp = $row['otp'];

            // Check if the entered OTP matches the stored OTP in the database
            if ($enteredOtp == $storedOtp) {
                // OTP is valid, proceed to change password
                // Redirect to change password page
                header("Location: forgot_pass.php?change=true&phone=" . urlencode($phone));
                exit();
            } else {
                function_alert("Invalid OTP. Please try again.", "forgot_pass.php?verify=true&phone=" . urlencode($phone));
            }
        } else {
            function_alert("User not found!.", "index.php");
        }
    }

    if (isset($_POST['Change_Password'])) {
        if (!isset($_SESSION['phone'])) {
            function_alert("Session phone not set. Please try again.", "forgot_pass.php");
        }

        $password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $phone = $_SESSION['phone'];

        if (strlen($password) < 6) {
            function_alert("Password must have at least 6 characters", "forgot_pass.php");
        } elseif ($password !== $confirm_password) {
            function_alert("Passwords didn't match. Try Again", "forgot_pass.php");
        } else {
            $stmt = $conn->prepare("UPDATE admin SET password=? WHERE phone=?");
            $stmt->bind_param('ss', $password, $phone);
            if ($stmt->execute()) {
                function_alert("Password changed successfully!\\nRedirecting to Login page", "../admin/login.php");
            } else {
                function_alert("Couldn't update the password", "index.php");
            }
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
        font-size: 16px;
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
    <div class="container">
        <?php if (isset($_GET['verify']) && $_GET['verify'] == 'true'): ?>
            <form action="forgot_pass.php" method="post">
                <center>
                    <a href="#" onclick="window.history.back(); return false;"><i style="font-size:24px" class="fa">&#xf190;</i></a>
                    &nbsp;
                    <a href="../admin/index.php"><i style="font-size:24px;color:blue;" class="fa">&#xf015;</i></a>
                    <br/>
                </center>
                <h2>Verify OTP</h2>
                <label for="otp">Enter OTP:</label>
                <input type="text" name="otp" required>
                <input type="hidden" name="phone" value="<?php echo htmlspecialchars($_GET['phone']); ?>">
                <button type="submit" name="verify">Verify OTP</button>
            </form>

        <?php elseif (isset($_GET['change']) && $_GET['change'] == 'true'): ?>

            <div class="profile-section" style="flex: 1;">
            <center>
        <a href="#" onclick="window.history.back(); return false;"><i style="font-size:24px" class="fa">&#xf190;</i></a>
        &nbsp;
        <a href="../admin/index.php"><i style="font-size:24px;color:blue;" class="fa">&#xf015;</i></a>
        <br/>
    </center>
                <center>
                    <h3>Change Password</h3>
                    <p style="color:red;"><?php if (isset($_GET['error'])) { echo $_GET['error']; } ?></p>
                    <p style="color:green;"><?php if (isset($_GET['message'])) { echo $_GET['message']; } ?></p>
                </center>
                <form id="account-form" action="forgot_pass.php" method="POST">
                    <label for="new_password">New Password</label> <input type="password" id="new_password"
                        name="new_password" required="">
                    <label for="confirm_password">Confirm New Password</label> <input type="password"
                        id="confirm_password" name="confirm_password" required="">
                    <center>
                        <button type="submit" name="Change_Password" style='border-radius: 50px;'>Change Password</button>
                    </center>
                </form>
                <script>
                    // Add JavaScript to scroll to the changePassword section
                    if (window.location.hash === '#changePassword') {
                        document.getElementById('account-form').style.display = 'block';
                    }
                    // JavaScript for password mismatch alert
                    var form = document.getElementById('account-form');
                    form.addEventListener('submit', function(event) {
                        var newPassword = document.getElementById('new_password').value;
                        var confirmPassword = document.getElementById('confirm_password').value;
                        if (newPassword !== confirmPassword) {
                            alert("Passwords didn't match. Try Again");
                            event.preventDefault();
                        }
                    });
                </script>
  <script>
    // JavaScript for form submission and password validation
    var form = document.getElementById('account-form');
    form.addEventListener('submit', function(event) {
        var newPassword = document.getElementById('new_password').value;
        if (newPassword.length < 6) {
            alert("Password must have at least 6 characters");
            event.preventDefault(); // Prevent form submission
        }
    });
</script>
            </div>
        </div>
    </div>
        <?php else: ?>
            <form action="forgot_pass.php" method="post">
                <center>
                    <a href="#" onclick="window.history.back(); return false;"><i style="font-size:24px" class="fa">&#xf190;</i></a>
                    &nbsp;
                    <a href="../admin/index.php"><i style="font-size:24px;color:blue;" class="fa">&#xf015;</i></a>
                    <br/>
                </center>
                <h2>Forgot Password?</h2>
                <label for="phone">Mobile Number (With +91):</label>
                <input type="text" name="phone" placeholder="+917022015320" required>
                <button type="submit" name="submit">Send OTP</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
