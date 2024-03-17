<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.html"); // Redirect to login page if not logged in
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION["username"]; ?>!</h1>
    <p>You are now logged in.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
