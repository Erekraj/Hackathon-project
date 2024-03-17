<<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'your_username');
define('DB_PASSWORD', 'your_password');
define('DB_NAME', 'usersession');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

