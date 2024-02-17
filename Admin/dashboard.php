<?php
// Check if the user is logged in as an admin, you may implement your own authentication logic
session_start();
$isAdmin = true;

if (!$isAdmin) {
    header('Location: login.php'); // Redirect to login page if not logged in as admin
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: row-reverse; /* Change to row-reverse to move the side menu to the left */
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            width: 100%;
        }

        nav {
            background-color: #444;
            color: #fff;
            padding: 10px;
            height: 100vh;
            width: 200px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 5px;
        }

        section {
            padding: 20px;
            flex: 1;
        }
        #top h1{
            padding 10px; 0 0 10px;
        }
    </style>
</head>
<body>




    <section>
        <h2>Welcome, <?php echo $_SESSION['admin_name']; ?></h2>
        
    </section>



<nav>
    <a href="#">Dashboard</a>
    <a href="#">Orders</a>
    <a href="#">Products</a>
    <a href="#">Account</a>
    <a href="logout.php">Logout</a>
</nav>


</body>
</html>
