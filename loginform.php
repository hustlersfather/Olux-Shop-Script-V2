<?php
session_start();
ob_start();

date_default_timezone_set('UTC');

include "includes/config.php";
include 'encrypt.php';

if(isset($_SESSION['sname']) && isset($_SESSION['spass'])) {
    header("location: index.html");
    exit();
}

if (isset($_POST['user'], $_POST['pass'])) {
    $username = mysqli_real_escape_string($dbcon, $_POST['user']);
    $password = mysqli_real_escape_string($dbcon, $_POST['pass']);
    $encrypted_password = dec_enc('encrypt', $password);

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$encrypted_password'";
    $result = mysqli_query($dbcon, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['freshtools'] == 2) { // Check if freshtools column value is 2
            $_SESSION['sname'] = $username;
            $_SESSION['spass'] = $encrypted_password;
            header('location: admin_dashboard.php'); // Redirect to admin dashboard
            exit();
        } else {
            header('location:index.html'); // Redirect to regular user page
            exit();
        }
    } else {
        header('location:login.html?error=true'); // Redirect to login page with error message
        exit();
    }
} else {
    header('location:index.html'); // Redirect to index page
    exit();
}
?>