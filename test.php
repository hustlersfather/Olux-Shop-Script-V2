<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}

$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$p_data = mysqli_real_escape_string($dbcon, $_GET['p_data']);

$q = mysqli_query($dbcon, "SELECT * FROM payment WHERE user='$uid' and p_data='$p_data'") or die(mysqli_error($dbcon));

while ($row = mysqli_fetch_assoc($q)) {
    if ($row['method'] == "Bitcoin") {
        $a = $row["address"];
        $url = "https://api.commerce.coinbase.com/charges/$a";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-CC-Api-Key: YOUR_API_KEY', // Replace with your Coinbase Commerce API Key
            'X-CC-Version: 2018-03-22'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $responseData = json_decode($response, true);
        
        // Sample logic, adjust as per your needs
        $amount = $responseData['data']['payments'][0]['value']['local']['amount']; // Example field to retrieve payment amount

        // Construct the JSON response
        $jsonData = array(
            'stop' => 1,
            'time' => date("Y/m/d h:i:s"),
            'btc' => $amount, // Sample BTC amount
            'state' => "Paid", // Sample state
            'error' => 1,
            'errorTXT' => "<div class='alert alert-dismissible alert-success'><strong>Transaction Received <i class='glyphicon glyphicon-ok'></i></strong><br>An amount of $amount$ has been added to your balance.</div>"
        );

        echo json_encode($jsonData);
    }
}
?>