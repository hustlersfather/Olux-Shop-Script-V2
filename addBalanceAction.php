<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}

if(isset($_POST['deposit-btn'])) {
    $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
    $amount = $_POST['amount'];
    $method = "Bitcoin";

    // Your code to process the form submission and store data in the database
    // Example:
    $insertQuery = "INSERT INTO payment (user, method, amount) VALUES ('$uid', '$method', '$amount')";
    if(mysqli_query($dbcon, $insertQuery)) {
        echo "Data successfully inserted into the database.";
    } else {
        echo "Error: " . mysqli_error($dbcon);
    }
}
?>
