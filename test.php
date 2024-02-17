<?php 
    if (isset($_POST['Change_Password'])) {
    $password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['email'];

    //pass_confirm pass
    if ($password !== $confirm_password) {
        header('location:account.php?error=Password did not match');
    }
    //length of pass
    elseif (strlen($password) < 6) {
        header('location:account.php?error=Password must have 6 characters');
    //if all correct
    } else {
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");

        $stmt->bind_param('ss', $password, $email);

        if ($stmt->execute()) {
            header("location:account.php?message=Password Updated Successfully");
        } else {
            header("location:account.php?error=Couldn't Update the Password");
        }
    }
}
?>

<div class="profile-section" style="flex: 1;">
            <!-- Change password -->
            <div class="container" style="height: 55vh;">
                <center>
                    <h3>Change Password</h3>
                    <p style="color:red;"><?php if (isset($_GET['error'])) { echo $_GET['error']; } ?></p>
                    <p style="color:green;"><?php if (isset($_GET['message'])) { echo $_GET['message']; } ?></p>
                </center>
                <form id="account-form" action="account.php" method="POST">
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
                </script>
            </div>
        </div>
    </div>