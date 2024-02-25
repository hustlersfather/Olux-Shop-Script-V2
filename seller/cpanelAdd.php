<?php
ob_start();
error_reporting(0);
session_start();
date_default_timezone_set('UTC');
include_once "../includes/config.php";

if (!isset($_SESSION['sname']) && !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}

$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

// Function to extract text between two strings
function ambilKata($param, $kata1, $kata2)
{
    if (strpos($param, $kata1) === FALSE) return FALSE;
    if (strpos($param, $kata2) === FALSE) return FALSE;
    $start = strpos($param, $kata1) + strlen($kata1);
    $end = strpos($param, $kata2, $start);
    $return = substr($param, $start, $end - $start);
    return $return;
}

$date = date('d/m/Y H:i:s a');
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$site = explode("\n", $_POST['inputs']);
$price = mysqli_real_escape_string($dbcon, $_POST['price']);

$url = $_POST["cpanel_host"];
$login = $_POST["cpanel_login"];
$pass = $_POST["cpanel_pass"];
$k = "$url|$login|$pass";

$o = parse_url($url, PHP_URL_HOST);
$cp1 = "$o";

$qq = @mysqli_query($dbcon, "SELECT * FROM cpanels") or die("error here");

if (isset($_POST['start']) && $_POST['start'] == "work") {
    if ($price == 0 || preg_match('/[^0-9]/', $price)) {
        $ov = parse_url($k, PHP_URL_HOST);
        echo htmlspecialchars($ov) . "Price is not valid!";
    } else {
        $check = "SELECT * FROM cpanels WHERE url = '$k'";
        $rs = mysqli_query($dbcon, $check);
        $data = mysqli_fetch_array($rs, MYSQLI_NUM);
        if ($data[0] > 1) {
            while ($row = mysqli_fetch_assoc($qq)) {
                $st = $row['url'];
                $ov = parse_url($k, PHP_URL_HOST);
                if (preg_match("#$ov#", $st)) {
                }
            }
            echo "Already Added !";
        } else {
            ini_set('max_execution_time', 10);
            $urltoapi = "http://xbasetools.store/apicheckcp.php?cp12=$cp1&login=$login&pass=" . rawurlencode($pass) . "";
            $urltoapi2 = file_get_contents($urltoapi);
            if (preg_match('#CP Work#', $urltoapi2)) {
                $o = parse_url($url, PHP_URL_HOST);
                $oip = gethostbyname($o);
                $iptohosting = "https://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$oip&fields=isp";
                $creatorhosting = file_get_contents($iptohosting);
                $hostingg = ambilKata($creatorhosting, '{"ip":"' . $oip . '","isp":"', '"}');
                $iptolocation = "http://api.ipstack.com/$o?access_key=f991d31642a29f8a8197b57ef76f167b&fields=country_name";
                $creatorlocation = file_get_contents($iptolocation);
                $country = ambilKata($creatorlocation, '{"country_name":"', '"}');
                $date = date('Y/m/d h:i:s');
                $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
                mysqli_query($dbcon, "INSERT INTO cpanels
  (acctype,country,infos,url,price,sold,sto,dateofsold,resseller,date,reported)
  VALUES
  ('cpanel','$country','$hostingg','$k','$price','0','',null,'$uid','$date','')") or die(mysqli_error($dbcon));
                echo htmlspecialchars($o) . " .. Added Succesfully";
            } else {
                echo "Not Working !";
            }
        }
    }
}
?>