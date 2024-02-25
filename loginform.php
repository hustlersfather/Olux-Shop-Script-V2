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
    $userpass = dec_enc('encrypt', $password);
    $lvisi = date('Y-m-d');

    $finder = mysqli_query($dbcon, "SELECT * FROM users WHERE username='".strtolower($username)."' AND password='".$userpass."'") or die("mysqli error");

    if(mysqli_num_rows($finder) != 0){
        $row = mysqli_fetch_assoc($finder);
        if(strtolower($username) == strtolower($row['username']) && $userpass == $row['password']) {
            $_SESSION['sname'] = $username;
            $_SESSION['spass'] = $userpass;
            header('location:index.html');
            exit();
        } else {
            header('location:login.html?error=true');
            exit();
        }
    } else {
        header('location:login.html?error=true');
        exit();
    }
} else {
    header('location:index.html');
    exit();
}
?>