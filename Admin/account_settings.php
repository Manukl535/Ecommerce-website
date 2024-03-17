<?php
    // Check if the user is logged in as an admin, you may implement your own authentication logic
    session_start();
    if (!isset($_SESSION['admin_name'])) {
        header('Location: login.php'); // Redirect to login page if not logged in as admin
        exit();
    }

    // Password constraints
    $passwordMinLength = 6; // Minimum password length
    $passwordMaxLength = 20; // Maximum password length
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Account Settings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>

<div class="container">
    <center>
        <a href="#" onclick="window.history.back(); return false;"><i style="font-size:24px" class="fa">&#xf190;</i></a>
        &nbsp;
        <a href="dashboard.php"><i style="font-size:24px;color:blue;" class="fa">&#xf015;</i></a>
        <br/>
    </center>
    <h2>Account Settings</h2>
    <?php
        include('../Includes/connection.php'); 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];
            $newName = $_POST['new_name'];
            $newEmail = $_POST['new_email'];
            $newPhone = "+91" . $_POST['new_phone']; // Append +91 to the phone number
            
            // Password validation
            if ($newPassword !== $confirmPassword) {
                echo '<p style="color: red;text-align:center">Passwords do not match.</p>';
            } elseif (strlen($newPassword) < $passwordMinLength || strlen($newPassword) > $passwordMaxLength) {
                echo '<p style="color: red;text-align:center">Password must have '.$passwordMinLength.' characters.</p>';
            } else {
                // Update the admin table
                $updateStmt = $conn->prepare("UPDATE admin SET password = ?, admin_name = ?, email = ?, phone = ? WHERE admin_id = ?");
                $updateStmt->bind_param("ssssi", $newPassword, $newName, $newEmail, $newPhone, $_SESSION['admin_id']);

                if ($updateStmt->execute()) {
                    echo '<p style="color: green;">Account updated successfully!</p>';
                    echo '<script>alert("Account info updated!\nLogging out."); window.location.href = "logout.php";</script>';
                    exit; // To prevent further execution
                } else {
                    echo '<p style="color: red;">Error updating account. Please try again.</p>';
                }

                $updateStmt->close();
            }
        }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" required>
        </div>

        <div class="form-group">
            <label for="new_name">New Name:</label>
            <input type="text" name="new_name" required>
        </div>

        <div class="form-group">
            <label for="new_email">New Email:</label>
            <input type="email" name="new_email" required>
        </div>

        <div class="form-group">
            <label for="new_phone">New Phone:</label>
            <input type="tel" name="new_phone" required>
        </div>

        <button type="submit">Update Account</button>
    </form>
</div>

</body>
</html>
