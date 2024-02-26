<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();
session_start();
date_default_timezone_set('UTC');
require_once "includes/config.php";

if (!isset($_SESSION['sname']) || !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}

$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

if (isset($_POST['add-balance-btn'])) {
    $amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);
    $method = filter_input(INPUT_POST, 'methodpay', FILTER_SANITIZE_STRING);

    if ($amount === false || $amount <= 0) {
        die("Amount is missing or invalid.");
    }

    $apiKey = 'f7e1cc3c-8e54-4c43-a2e8-94ae2eb10e74'; // Use your actual Coinbase Commerce API key
    $apiUrl = 'https://api.commerce.coinbase.com/charges';

    $redirectUrl = 'https://xbasetools.store/payment.php'; // Custom success page URL

    $paymentData = [
        'name' => 'Account Deposit',
        'description' => 'Deposit into account',
        'pricing_type' => 'fixed_price',
        'local_price' => [
            'amount' => $amount,
            'currency' => 'USD'
        ],
        'metadata' => [
            'customer_id' => $usrid,
            'payment_method' => $method
        ],
        'redirect_url' => $redirectUrl,
        'cancel_url' => 'http://yourdomain.com/payment_cancel.php'
    ];

    $headers = [
        'Content-Type: application/json',
        'X-CC-Api-Key: ' . $apiKey,
        'X-CC-Version: 2018-03-22'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    if (!$response) {
        die('cURL Error: ' . curl_error($ch));
    }
    curl_close($ch);

    $responseData = json_decode($response, true);
    if (isset($responseData['data'])) {
        $paymentUrl = $responseData['data']['hosted_url'];
        $coinbaseChargeCode = $responseData['data']['code'];

        $stmt = $dbcon->prepare("INSERT INTO payment (user, method, address, p_data, amount, amountusd) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssdd", $usrid, $method, $coinbaseChargeCode, $response['data']['id'], $amount, $amount);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['payment_details'] = [
                'amount' => $amount,
                'method' => $method,
                'charge_code' => $coinbaseChargeCode,
            ];
            header("Location: $redirectUrl");
            exit();
        } else {
            echo "Failed to store payment details.";
        }
    } else {
        echo "Failed to create charge with Coinbase Commerce. Error: " . htmlspecialchars($responseData['error']['message'] ?? 'Unknown error');
    }
}
?>