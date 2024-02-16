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
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            background-color: #444;
            color: #fff;
            padding: 10px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 5px;
        }

        section {
            padding: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Admin Dashboard</h1>
</header>

<nav>
    <a href="#">Home</a>
    <a href="#">Users</a>
    <a href="#">Settings</a>
    <a href="logout.php">Logout</a> <!-- Implement your logout functionality -->
</nav>

<section>
<h2>Welcome, <?php echo $_SESSION['admin_name']; ?></h2>

    <p>This is your admin dashboard. You can manage users, settings, and more.</p>
</section>

</body>
</html>
