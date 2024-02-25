<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) || !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}

$dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if (!$dbcon) {
    die("Connection failed: " . mysqli_connect_error());
}

$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$method = mysqli_real_escape_string($dbcon, $_POST['methodpay']);
$amount = mysqli_real_escape_string($dbcon, htmlspecialchars($_POST['amount']));

if($_POST['methodpay'] == "BitcoinPayment") {
    if ($amount < 5) {
        echo "01"; // This is unclear, consider providing a more descriptive error message
    } else {
        $url_btc = 'https://blockchain.info/ticker';
        $response_btc = file_get_contents($url_btc);
        $object_btc = json_decode($response_btc);
        $usdprice = $object_btc->USD->last;
        $rate = $object_btc->USD->last;
        $btcamount = number_format($amount / $rate, 8, '.', '');

        $guid = 'omermaksutiofficial@yandex.com';  // Block.io account
        $main_password = 'Omeri1233'; // Block.io Password
        $pin = '19082002'; // Block.io PIN
        $apikey = "4ddf-2744-15d7-2c1a"; // block.io API KEY
        $uidz = $uid . '-' . time();
        
        $ao = file_get_contents("https://block.io/api/v2/get_new_address/?api_key=$apikey&label=$uidz");
        $zz = json_decode($ao);
        $btcadrs = $zz->data->address;
        $random = substr(md5(mt_rand()), 0, 60);
        $date = date('Y/m/d h:i:s');
        $sql2 = "INSERT INTO payment (user, method, amount, amountusd, address, p_data, state, date) VALUES ('$uid', 'Bitcoin', '$btcamm', '$amount', '$btcadrs', '$random', 'pending', '$date')";
        mysqli_query($dbcon, $sql2) or die(mysqli_error($dbcon));
        echo $random;
    }
} else {
    header("location: index.html");
    exit();
}

mysqli_close($dbcon);
?>