<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

// Include the configuration file
require_once "includes/config.php";

// Check if the user is authenticated
if (!isset($_SESSION['sname']) || !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}

// Get the user ID from the session
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

// Check if the form is submitted
if (isset($_POST['add-balance-btn'])) {
    // Validate and sanitize the input data
    $balance = filter_input(INPUT_POST, 'balance', FILTER_VALIDATE_FLOAT);

    if ($balance === false || $balance <= 0) {
        die("Balance amount is missing or invalid.");
    }

    // Your Coinbase Commerce API key
    $apiKey = 'f7e1cc3c-8e54-4c43-a2e8-94ae2eb10e74';

    // URL for Coinbase Commerce API charges endpoint
    $apiUrl = 'https://api.commerce.coinbase.com/charges';

    // Custom success page URL
    $redirectUrl = 'payment.php';

    // Payment data for Coinbase Commerce API
    $paymentData = [
        'name' => 'Account Balance Addition',
        'description' => 'Adding balance to account',
        'pricing_type' => 'fixed_price',
        'local_price' => [
            'amount' => $balance,
            'currency' => 'USD'
        ],
        'metadata' => [
            'customer_id' => $usrid,
            'payment_method' => 'Coinbase Commerce'
        ],
        'redirect_url' => $redirectUrl,
        'cancel_url' => 'http://yourdomain.com/payment_cancel.php'
    ];

    // Headers for the HTTP request
    $headers = [
        'Content-Type: application/json',
        'X-CC-Api-Key: ' . $apiKey,
        'X-CC-Version: 2018-03-22'
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute the cURL session and retrieve response
    $response = curl_exec($ch);

    // Check for cURL errors
    if ($response === false) {
        die('cURL Error: ' . curl_error($ch));
    }

    // Close cURL session
    curl_close($ch);

    // Decode the JSON response from Coinbase Commerce
    $responseData = json_decode($response);

    // Check if charge creation was successful
    if (isset($responseData->data)) {
        // Extract payment URL and charge code from the response
        $paymentUrl = $responseData->data->hosted_url;
        $coinbaseChargeCode = $responseData->data->code;

        // Insert balance history into the database
        $insert = "INSERT INTO balance_history (user_id, amount, payment_method, charge_code) VALUES ('$usrid', '$balance', 'Coinbase Commerce', '$coinbaseChargeCode')";
        mysqli_query($dbcon, $insert);

        // Store payment details in session for use in the success page
        $_SESSION['payment_details'] = [
            'amount' => $balance,
            'method' => 'Coinbase Commerce',
            'charge_code' => $coinbaseChargeCode
        ];

        // Redirect the user to the payment URL
        header("Location: $paymentUrl");
        exit();
    } else {
        // Handle errors from Coinbase Commerce
        echo "Failed to create charge with Coinbase Commerce. Error: " . htmlspecialchars($responseData->error->message ?? 'Unknown error');
    }
} else {
    // Handle cases where the form was not submitted
    echo "Form submission error: Form data not received.";
}
?>