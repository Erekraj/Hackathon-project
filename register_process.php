<?php
session_start();

// Include your database connection configuration (e.g., config.php)
include('config.php');

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Validate form data (add more validation rules as needed)
    if (empty($username) || empty($email) || empty($_POST['password'])) {
        // Handle validation errors (e.g., display error messages)
        header("Location: register.php?error=emptyfields");
        exit();
    }

    // Check if the username or email already exists
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Handle duplicate username or email
        header("Location: register.php?error=duplicate");
        exit();
    }

    // Insert new user into the database
    $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($conn, $insert_query)) {
        // Registration successful
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Redirect to welcome page
        exit();
    } else {
        // Handle database insertion error
        header("Location: register.php?error=dberror");
        exit();
    }
} else {
    // Redirect back to the registration form
    header("Location: register.php");
    exit();
}
?>
