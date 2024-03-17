<?php
session_start();
$host = "localhost";
$username = "your_username";
$password = "your_password";
$database = "login_system";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION["username"] = $username;
        header("Location: ./p.html"); // Redirect to dashboard
    } else {
        header("Location: login.html"); // Redirect back to login page
    }
}
?>
<!-- HTML form for login -->
<!-- Include form fields for username and password -->
