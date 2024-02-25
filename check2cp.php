<?php
session_start();
date_default_timezone_set('UTC');
include_once "includes/config.php";

if (!isset($_SESSION['sname']) && !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}

$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

function curl_get_contents($url)
{
    $curl = curl_init($url);
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_TIMEOUT => 10 //timeout in seconds
    ]);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

$id = mysqli_real_escape_string($dbcon, $_GET['id']);

$sql = "SELECT * FROM cpanels WHERE id=$id";
$query = mysqli_query($dbcon, $sql);

function sanitize_input($item)
{
    return trim($item);
}

while ($row = mysqli_fetch_array($query)) {
    $serverurl = $row['url'];
    $d = explode("|", $serverurl);
    $url = sanitize_input($d[0]);
    $login = sanitize_input($d[1]);
    $pass = sanitize_input($d[2]);
    $o = parse_url($url, PHP_URL_HOST);
    $cp1 = "$o";
    $urltoapi = "http://xbasetools.store/apicheckcp.php?cp12=$cp1&login=$login&pass=" . rawurlencode($pass);
    $urltoapi2 = curl_get_contents($urltoapi);
    if (preg_match('#CP Work#', $urltoapi2)) {
        echo "<span class='label label-success'>Working</span>";
        return true;
    } else {
        echo "<span class='label label-danger'>Bad!</span>";
        $sql = "UPDATE cpanels SET sold='deleted' WHERE id='$id'";
        $query = mysqli_query($dbcon, $sql);
    }
}
?>