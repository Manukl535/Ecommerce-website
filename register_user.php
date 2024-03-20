<?php
session_start();

function function_alert($message, $redirectUrl) {
    // Display the alert box
    echo "<script>alert('$message');</script>";
    // Redirect to the specified URL after the alert is closed
    echo "<script>window.location.href = '$redirectUrl';</script>";
}

include("Includes/connection.php");

if (isset($_SESSION['logged-in'])) {
    header('location:account.php?');
    exit;
}

if (isset($_POST['register-btn'])) {

    $name = $_POST['name'];
    $phone = trim($_POST['phone']); // Trim any extra spaces

    // Check if the length of the phone number is not 10 digits
    if (strlen($phone) !== 10) {
        // Redirect with an error message
        header('location:register_user.php?error=Phone number should be exactly 10 digits.');
        exit;
    } else {
        $phone = "+91" . $phone; // Append +91 if the length is exactly 10 digits
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Password confirmation
    if ($password !== $confirm_password) {
        header('location:register_user.php?error=Password did not match');
        exit;
    } elseif (strlen($password) < 6) {
        header('location:register_user.php?error=Password must have 6 characters');
        exit;
    }

    // Validate email format
    $emailPattern = "/^[a-zA-Z0-9._%+-]+@(gmail|email|yahoo)\.com$/i";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match($emailPattern, $email)) {
        $error_message = "Invalid email format. Example: abc@gmail.com";
        header("location:register_user.php?error=" . urlencode($error_message));
        exit;
    }

    // Check for existing email
    $stmt1 = $conn->prepare("SELECT COUNT(*) FROM users WHERE email=?");
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();

    if ($num_rows != 0) {
        header('location:register_user.php?error=Email Already Taken, Try Again');
        exit;
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (user_name, phone, email, password) VALUES (?,?,?,?)");
        $stmt->bind_param('ssss', $name, $phone, $email, $password);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;

            // Display alert and redirect
            $message = "You registered successfully..!\\nRedirecting to Login page";
            $redirectUrl = "login_user.php";
            function_alert($message, $redirectUrl);
        } else {
            header('location:register_user.php?error=Account cannot be created');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <title>Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
       	body {
		color: #fff;
		background: #63738a;
		font-family: 'Varela Round', sans-serif;
	}
    .form-control{
		height: 40px;
		box-shadow: none;
		/* color: #969fa4; */
	}
	.form-control:focus{
		border-color: #5cb85c;
	}
    .form-control, .btn{        
        border-radius: 3px;
    }
	.signup-form{
		width: 400px;
		margin: 0 auto;
		padding: 30px 0;
	}
	.signup-form h2{
		color: #636363;
        margin: 0 0 15px;
		position: relative;
		text-align: center;
    }
	.signup-form h2:before, .signup-form h2:after{
		content: "";
		height: 2px;
		width: 30%;
		background: #d4d4d4;
		position: absolute;
		top: 50%;
		z-index: 2;
	}	
	.signup-form h2:before{
		left: 0;
	}
	.signup-form h2:after{
		right: 0;
	}
    .signup-form .hint-text{
		color: #999;
		margin-bottom: 30px;
		text-align: center;
	}
    .signup-form form{
		color: #999;
		border-radius: 3px;
    	margin-bottom: 15px;
        background: #fff;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
	.signup-form .form-group{
		margin-bottom: 20px;
	}
	.signup-form input[type="checkbox"]{
		margin-top: 3px;
	}
	.signup-form .btn{        
        font-size: 16px;
        font-weight: bold;		
		min-width: 140px;
        outline: none !important;
    }
	.signup-form .row div:first-child{
		padding-right: 10px;
	}
	.signup-form .row div:last-child{
		padding-left: 10px;
	}    	
    .signup-form a{
		color: #5cb85c;
		text-decoration: underline;
	}
    .signup-form a:hover{
		text-decoration: none;
	}
	.signup-form form a{
		color: #5cb85c;
		text-decoration: none;
	}	
	.signup-form form a:hover{
		text-decoration: underline;
	} 
    </style>
</head>
<body>
<div class="signup-form">
    <form id="register-form" action="register_user.php" method="POST">
        <h2>Register</h2>
        <p class="hint-text">Create your account. It's free and only takes a minute.</p>
        <center><p style="color:red;"><?php if(isset($_GET['error'])) { echo $_GET['error']; } ?></p></center>
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name" required="required">
        </div>
        <div class="form-group">
            <input type="tel" class="form-control" pattern="[0-9]" name="phone" placeholder="7022015320" required="required">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="required">
        </div>
        <div class="form-group">
            <label class="checkbox-inline"><input type="checkbox" required="required"> I accept the <a href="T&C.html">Terms of Use &amp; Privacy Policy</a></label>
        </div>
        <div class="form-group">
            <button type="submit"  class="btn btn-success btn-lg btn-block" name="register-btn">Register Now</button>
        </div>
    </form>
    <div class="text-center">Already have an account? <a href="login_user.php">Sign in</a></div>
</div>

<!-- Your footer HTML -->

</body>
</html>
