<?php
session_start();
include("Includes/connection.php");
if(isset($_POST['register']))
{
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

//password match
if($password !== $confirm_password){
	header("location:register.php?error=Password doesn't mactch");
}
//length of password
else if(strlen($password)<8){
	header("location:register.php?error=Password must contain 8 charactes");
}
else
{	
			//for checking existing user
			
			$stmt1 =$conn->prepare("SELECT COUNT(*) FROM users WHERE email=?");
			
			$stmt1->bind_param('s',$email);

			$stmt1->execute();

			$stmt1->bind_result($num_rows);

			$stmt1->store_result();

			$stmt1->fetch();

		if($num_rows != 0)
		{
			header("location:register.php?error=User name not available");
		}
		else{

				//for new user

				$stmt = $conn->prepare("INSERT INTO users (user_name,phone,email,password) VALUES (?,?,?,?)");

				$stmt->bind_param('ssss',$name,$phone,$email,md5($password));

				//if account created
				if($stmt->execute()){

					$_SESSION['email'] = $email;
					$_SESSION['user_name']= $name;
					$_SESSION['logged_in'] = true;
					header("location:account.php?register=You Registered Successfully");
				}
				//if not account created
				else{
					header('location:register.php?error=Account Not Created');
				}

			}
	}
}
// else{
// 	header("location:register.php?error=Please fill the form");
// }

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
		color: #969fa4;
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
<body>
<div class="signup-form">
        <form id="register-form" action="register_user.php" method="POST">
            <h2>Register</h2>
            <p class="hint-text">Create your account. It's free and only takes a minute.</p>
            <p style="color:red;"><?php if(isset($_GET['error'])) { echo $_GET['error']; } ?></p>
            <!-- Display error message here -->
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6">  </div>
                                  
                </div>  
				<input type="text" class="form-control" name="name" placeholder="Name" required="required">        
            </div>
            <div class="form-group">
                <input type="phone" class="form-control" name="phone" placeholder="70220 15320" required="required">
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
            <button type="submit"  class="btn btn-success btn-lg btn-block" name="register">Register Now</button>
        </div>
    </form>
	<div class="text-center">Already have an account? <a href="login_user.php">Sign in</a></div>
</div>


<center>
<footer class="section-p1">
    <div class="copyright">
        <p>2023 &#169; All Rights Reserved</p><p>Designed and Maintained by <b>Manu </b>and <b>Srisha</b></p>
    </div>

</footer></center>
</body>
</html>