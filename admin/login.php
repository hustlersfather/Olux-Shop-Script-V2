<?php
// login_process.php
session_start();
ob_start();

date_default_timezone_set('UTC');

include "../includes/config.php";
include "../encrypt.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($dbcon, $_POST['username']);
    $password = mysqli_real_escape_string($dbcon, $_POST['password']);

    // Encrypt the entered password for comparison
    $encrypted_password = dec_enc('encrypt', $password);

    // Perform your authentication here, for example:
    $query = "SELECT * FROM manager WHERE username = '$username' AND password = '$encrypted_password'";
    $result = mysqli_query($dbcon, $query);

    if(mysqli_num_rows($result) == 1) {
        $_SESSION['sname'] = $username;
        header("location: admin_dashboard.php");
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>

<!-- login.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>