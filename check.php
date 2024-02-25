 
<?php
// This file should handle the AJAX request to check the Bitcoin address for payment status

// Include your database connection or any other necessary files
include_once "includes/config.php";

// Retrieve the payment data from the AJAX request
$p_data = $_GET['p_data']; // Assuming p_data is passed as a parameter in the AJAX request

// Perform any necessary database queries to get payment information based on $p_data
// For demonstration purposes, I'll just simulate the data here
$paymentData = array(
    'time' => date("Y-m-d H:i:s"),
    'btc' => '0.5 BTC', // Sample BTC amount
    'state' => 'Confirmed', // Sample state
    'error' => 0, // Sample error status
    'errorTXT' => '', // Sample error message
    'stop' => 0 // Sample stop status
);

// Encode the payment data as JSON and output it
echo json_encode($paymentData);
?>