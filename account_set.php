<?php

if(isset($_POST['Change_Password'])){
            $password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            $user_name = $_SESSION['$user_name'];

            //pass=confirm pass
            if($password !== $confirm_password){
              header('location:account.php?error=Password did not match');
              
            }
            //length of pass
            else if(strlen($password) < 6){
              header('location:account.php?error=Password must have 6 characters');
            //if all correct
            }
            else{
              $stmt=$conn->prepare("UPDATE users SET password=? WHERE user_name=?");
              $stmt->bind_param('ss',$password,$user_name);
              if($strmt->execute()){
                header("location:account.php?message=Password Updated Successfully");
              }
              else{
                header("location:account.php?error=Couldn't Update the Password");
              }
            }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .container {
      width: 300px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    
    input {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }
    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
<center><h2>Change Password</h2>
        <p style="color:red;"><?php if(isset($_GET['error'])) { echo $_GET['error']; } ?></p>
        <p style="color:green;"><?php if(isset($_GET['message'])) { echo $_GET['message']; } ?></p>
</center>
    <form id="account-form" action="account.php" method="POST">
      
      <label for="new_password">New Password</label>
      <input type="password" id="new_password" name="new_password" required>
      
      <label for="confirm_password">Confirm New Password</label>
      <input type="password" id="confirm_password"  name="confirm_password" required>
      
      <button type="submit" name="Change_Password">Change Password</button>
    </form>
  
  </div>
  
</body>
</html>