<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
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
<body>

<div class="container">
    <h2>Account Settings</h2>
    <?php
    // PHP script to handle form submission and update database
    session_start();
    include('../Includes/connection.php'); 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $newPassword = $_POST['new_password'];
        $newName = $_POST['new_name'];
        $newEmail = $_POST['new_email'];
        $newphone = $_POST['new_phone'];
        
        // Update the admin table
        $updateStmt = $conn->prepare("UPDATE admin SET password = ?, admin_name = ?, email = ?,phone= ? WHERE admin_id = ?");
        $updateStmt->bind_param("ssssi", $newPassword, $newName, $newEmail, $newphone,$_SESSION['admin_id']);

        if ($updateStmt->execute()) {
            echo '<p style="color: green;">Account updated successfully!</p>';
            echo '<script>alert("Account info updated!"); window.location.href = "dashboard.php";</script>';
            exit; // To prevent further execution
        } else {
            echo '<p style="color: red;">Error updating account. Please try again.</p>';
        }

        $updateStmt->close();
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required>
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
            <input type="phone" name="new_phone" required>
        </div>

        <button type="submit">Update Account</button>
    </form>
</div>

</body>
</html>
