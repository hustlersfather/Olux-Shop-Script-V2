<?php
$cp12 = 'http://' . $_GET["cp12"] . ':2082/login';
$logine = $_GET["login"];
$passee = rawurldecode($_GET["pass"]);

$ch = curl_init($cp12);
curl_setopt_array($ch, [
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13',
    CURLOPT_POST => true,
    CURLOPT_CONNECTTIMEOUT => 0,
    CURLOPT_TIMEOUT => 15, //timeout in seconds
    CURLOPT_POSTFIELDS => [
        'user' => $logine,
        'pass' => $passee
    ],
    CURLOPT_RETURNTRANSFER => 1
]);

$postResult = curl_exec($ch);
curl_close($ch);

if (preg_match('#CONTENT="2;URL=/cpsess#', $postResult)) {
    echo 'CP Work';
} else {
    echo 'Bad CP';
}

$cp12 = 'https://' . $_GET["cp12"] . ':2083/login';

$ch = curl_init($cp12);
curl_setopt_array($ch, [
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13',
    CURLOPT_POST => true,
    CURLOPT_CONNECTTIMEOUT => 0,
    CURLOPT_TIMEOUT => 15, //timeout in seconds
    CURLOPT_POSTFIELDS => [
        'user' => $logine,
        'pass' => $passee
    ],
    CURLOPT_RETURNTRANSFER => 1
]);

$postResult = curl_exec($ch);
curl_close($ch);

if (preg_match('#CONTENT="2;URL=/cpsess#', $postResult)) {
    echo '<br>CP Work';
} else {
    echo 'Bad CP';
}
?>