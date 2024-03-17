<?php
session_start();
include('config.php');

$username = "";
$email = "";
$errors = array();

if (isset($_POST['reg_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']); // Encrypt the password

    // Form validation
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    // Add more validation rules as needed

    // Check if user already exists
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }
        if ($user['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }

    // Register user if no errors
    if (count($errors) == 0) {
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        mysqli_query($conn, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php'); // Redirect to welcome page
    }
}
?>

