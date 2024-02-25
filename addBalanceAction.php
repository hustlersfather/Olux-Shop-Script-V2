<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "./config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}

if(isset($_POST['deposit-btn'])) {
    $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
    $amount = $_POST['amount'];
    $method = "Bitcoin";

    if($amount > 5) {
        $api_key = 'YOUR_COINBASE_COMMERCE_API_KEY';

        // Call Coinbase Commerce API to create a charge
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.commerce.coinbase.com/charges',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "name": "Payment for Account Recharge",
                "description": "Add deposit balance to account",
                "local_price": {
                    "amount": '.$amount.',
                    "currency": "USD"
                },
                "pricing_type": "fixed_price"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'X-CC-Api-Key: '.$api_key,
                'X-CC-Version: 2018-03-22'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $charge_data = json_decode($response, true);

        if(isset($charge_data['data']['code'])) {
            $charge_code = $charge_data['data']['code'];
            $charge_address = $charge_data['data']['addresses']['bitcoin'];
            $charge_id = $charge_data['data']['id'];

            // Store payment details in the database
            $insert_query = "INSERT INTO payment (user, method, address, p_data, amount, amountusd) VALUES ('$uid', '$method', '$charge_address', '$charge_code', $amount, $amount)";
            mysqli_query($dbcon, $insert_query);

            // Redirect the user to the payment redirection page with payment data
            header("Location: payment.php?address=$charge_address&amount=$amount");
            exit();
        } else {
            // Handle API error
            echo "Error occurred while processing payment.";
        }
    } else {
        // Handle amount less than 5 error
        echo "Amount should be greater than 5 USD for Bitcoin payments.";
    }
}
?>