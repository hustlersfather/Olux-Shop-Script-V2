<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) || !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}

$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

$method = mysqli_real_escape_string($dbcon, $_POST['methodpay']);
$amount = mysqli_real_escape_string($dbcon, htmlspecialchars($_POST['amount']));

if ($method == "BitcoinPayment") {
    if ($amount < 5) {
        echo "01"; // Adjust your error code or message as per your requirement
    } else {
         Process payment via Commerce API
        // Make API call to the Commerce API endpoint to generate a new Bitcoin address and handle the transaction
        // Example:
        
        $commerceAPIKey = "f7e1cc3c-8e54-4c43-a2e8-94ae2eb10e74";
        $commerceAPIURL = "https://api.commerce.coinbase.com/charges";

        $postData = array(
            'user_id' => $uid,
            'amount' => $amount,
            'currency' => 'BTC',
            // Add other necessary data for the transaction
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $commerceAPIURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $commerceAPIKey,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $responseData = json_decode($response, true);

        // Handle the response from the Commerce API and echo appropriate messages
        if ($responseData['success']) {
            $btcadrs = $responseData['btc_address'];
            $random = substr(md5(mt_rand()), 0, 60);
            $date = date('Y-m-d H:i:s');
            $sql2 = "INSERT INTO payment(user, method, amount, amountusd, address, p_data, state, date) VALUES ('$uid', 'Bitcoin', '$amount', '$amount', '$btcadrs', '$random', 'pending', '$date')";
            mysqli_query($dbcon, $sql2);
            echo $random;
        } else {
            echo "Error occurred while processing payment."; // Handle error response from the Commerce API
        }
        
    }
} else {
    header("location: index.html");
}
?>