<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";

// Check if session variables for username and password are set
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("location: ../");
    exit();
}

$username = mysqli_real_escape_string($dbcon, $_SESSION['username']);
$query = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$username'") or die(mysqli_error($dbcon));
$user = mysqli_fetch_assoc($query);

// Check if the user is a reseller
if ($user['resseller'] != "1") {
    header("location: ../");
    exit();
}

// Get reseller information
$resellerId = mysqli_real_escape_string($dbcon, $_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jerux Seller</title>
    
    <!-- CSS files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/bootstrap.css">
    <link rel="stylesheet" href="../buyer/assets/flags.css">
    <link rel="stylesheet" href="css/tickets.css">
    
    <!-- JavaScript files -->
    <script type="text/javascript" src="./assets/jquery.js"></script>
    <script type="text/javascript" src="./assets/bootstrap.js"></script>
    <script type="text/javascript" src="./assets/bootbox.min.js"></script>
    <script type="text/javascript" src="./assets/sorttable.js"></script>
    <link href="./assets/style.css" rel="stylesheet">

    <style>
        .sortable th:not(.sorttable_sorted):not(.sorttable_sorted_reverse):not(.sorttable_nosort):after { 
            content: " \25BE"; 
        }

        .content { display: none; }
    </style>
    
    <script type="text/javascript">
        // Ajax call to fetch dynamic data
        function ajaxinfo() {
            $.ajax({
                type: 'GET',
                url: 'ajaxinfo.html',
                timeout: 10000,
                success: function(data) {
                    if (data != '01') {
                        var parsedData = JSON.parse(data);
                        for (var prop in parsedData) {
                            $("#" + prop).html(parsedData[prop]).show();
                        }
                    } else {
                        window.location = "logout.html";
                    }
                }
            });
        }
        
        // Set an interval to call ajaxinfo() every 3 seconds
        setInterval(function() { ajaxinfo(); }, 3000);
        ajaxinfo();
    </script>
</head>
<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="./index">
                        <div class="navbar-brand">
                            <font color="white"><b><span class="glyphicon glyphicon-fire"></span> Seller Panel</b></font>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="https://jerux.to/buyer/index.html" onclick="window.open(this.href); return false;">
                        <font color="white">Back to Jerux SHOP <span class="glyphicon glyphicon-share-alt"></span></font>
                    </a>
                </li>
                <li><font color="white"><b>Seller Dashboard</b></font></li>
                <li><a href="./index.html" style="cursor: pointer;">Main</a></li>

                <?php
                    $queryReseller = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='$username'") or die(mysqli_error($dbcon));
                    $resellerData = mysqli_fetch_assoc($queryReseller);
                ?>
                <li><a href="./sales.html" style="cursor: pointer;">Sales <div id="sales" class="label label-info"></div></a></li>
                <li><a href="./withdraw.html" style="cursor: pointer;">Withdraw</a></li>
                <li><a href="./reports.html" style="cursor: pointer;">My Reports 
                    <?php
                        $reportQuery = mysqli_query($dbcon, "SELECT * FROM reports WHERE resseller='$username' AND status IN (1, 2)");
                        if (mysqli_num_rows($reportQuery) > 0) {
                            echo '<div id="reports" class="label label-danger"></div>';
                        }
                    ?>
                </a></li>

                <li><font color="white"><b>Tools Management</b></font></li>
                <li><a href="./rdp.html" style="cursor: pointer;">RDP <span id="rdp" class="label label-info"></span></a></li>
                <li><a href="./shell.html" style="cursor: pointer;">Shell <span id="shell" class="label label-info"></span></a></li>
                <li><a href="./cpanel.html" style="cursor: pointer;">cPanel <span id="cpanel" class="label label-info"></span></a></li>
                <li><a href="./mailer.html">PHP Mailer <span id="mailer" class="label label-info"></span></a></li>
                <li><a href="./smtp.html">SMTP <span id="smtp" class="label label-info"></span></a></li>
                <li><a href="./leads.html">Leads <span id="leads" class="label label-info"></span></a></li>
                <li><a href="./scampage.html">Scampage <span id="scams" class="label label-info"></span></a></li>
                <li><a href="./tutorial.html">Tutorial/Method <span id="tutorials" class="label label-info"></span></a></li>
                <li><a href="./banks.html">Bank Accounts <span id="banks" class="label label-info"></span></a></li>
                <li><a href="./premium.html">Premium/Shop/Dating <span id="premium" class="label label-info"></span></a></li>
            </ul>
        </div>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div id="divPage">
                    <script>
                        var toggleState = 0;
                        $("#menu-toggle").click(function(e) {
                            e.preventDefault();
                            $("#wrapper").toggleClass("toggled");
                            if (toggleState === 1) {
                                $("#menu-toggle").html('<span class="glyphicon glyphicon-indent-right"></span>').show();
                                toggleState = 0;
                            } else {
                                $("#menu-toggle").html('<span class="glyphicon glyphicon-indent-left"></span>').show();
                                toggleState = 1;
                            }
                        });
                    </script>

                    <div class="row">
                        <div class="preload">
                            <div id="mydiv"><img src="img/wait.gif" class="ajax-loader"></div>
                        </div>

                        <div class="content">
                            <?php include "./header.php"; ?>

                            <div class="well well-sm">
                                Hello <span class="label label-primary"> <?php echo $username; ?></span><br>
                                If you have any <b>Question</b>, <b>Suggestion</b> or <b>Request</b>, feel free to 
                                <a class="label label-default" href="../buyer/tickets.html">
                                    <span class="glyphicon glyphicon-pencil"></span> Open Ticket
                                </a>
                                <br>

                                <h4>Your information <small><?php echo $username; ?></small> </h4>
                                <?php
                                    $resellerQuery = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='$username'") or die(mysqli_error($dbcon));
                                    $reseller = mysqli_fetch_assoc($resellerQuery);
                                    $sellerNickname = "seller" . $reseller["id"];
                                ?>
                                &nbsp; &nbsp; • Your selling nickname in this shop is <b><?php echo $sellerNickname; ?></b><br>
                                &nbsp; &nbsp; • You get paid anytime you like using the Withdraw section<br>
                                &nbsp; &nbsp; • You get <b>65%</b> of your sales<br>
                                &nbsp; &nbsp; • You can change your Bitcoin address from the withdrawal section<br>

                                <?php
                                    $btcQuery = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='$username'") or die(mysqli_error($dbcon));
                                    $btcInfo = mysqli_fetch_assoc($btcQuery);
                                    $btcAddress = $btcInfo["btc"];
                                ?>
                                &nbsp; &nbsp; • Your Bitcoin address is <b><?php echo empty($btcAddress) ? "N/A" : htmlspecialchars($btcAddress); ?></b><br><br>
                            </div>
                        </div>

                        <?php
                            $sellerQuery = mysqli_query($dbcon, "SELECT * FROM resseller ORDER BY CAST(lastweek AS UNSIGNED) DESC");
                            while ($row = mysqli_fetch_assoc($sellerQuery)) {
                                $seller = $row['username'];
                                $salesQuery = mysqli_query($dbcon, "SELECT SUM(price) AS total FROM purchases WHERE resseller='$seller' AND YEARWEEK(date) = YEARWEEK(NOW())");
                                $salesData = mysqli_fetch_assoc($salesQuery);
                                $sales = empty($salesData['total']) ? "0" : $salesData['total'];

                                $updateQuery = mysqli_query($dbcon, "UPDATE resseller SET lastweek='$sales' WHERE username='$seller'") or die(mysqli_error($dbcon));
                            }

                            $dayOfWeek = date('w');
                            $weekStart = date('m/d', strtotime("-$dayOfWeek days"));
                            $weekEnd = date('m/d', strtotime('+' . (6 - $dayOfWeek) . ' days'));
                            echo "<h4>Top Sellers <small>From Sunday ($weekStart) to Saturday ($weekEnd)</small></h4>";

                            $topSellersQuery = mysqli_query($dbcon, "SELECT * FROM resseller ORDER BY CAST(lastweek AS UNSIGNED) DESC LIMIT 5");
                            $place = 0;

                            echo '<table class="table table-striped table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Seller</th>
                                            <th>Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                            while ($topSeller = mysqli_fetch_assoc($topSellersQuery)) {
                                $place++;
                                $seller = $topSeller['username'];
                                $salesQuery = mysqli_query($dbcon, "SELECT SUM(price) AS total FROM purchases WHERE resseller='$seller' AND YEARWEEK(date) = YEARWEEK(NOW())");
                                $salesData = mysqli_fetch_assoc($salesQuery);
                                $sales = empty($salesData['total']) ? "0" : $salesData['total'];
                                $sellerNick = 'seller' . $topSeller['id'];

                                if ($sellerNick == $sellerNickname) {
                                    echo "<tr>
                                            <td><b>$place.</b></td>
                                            <td><b><span class='glyphicon glyphicon-user'></span> $sellerNickname</b></td>
                                            <td><b>$sales\$</b></td>
                                        </tr>";
                                } else {
                                    echo "<tr>
                                            <td>$place.</td>
                                            <td>seller{$topSeller['id']}</td>
                                            <td>$sales\$</td>
                                        </tr>";
                                }
                            }

                            // Display user's own sales if not in top 5
                            $userSalesQuery = mysqli_query($dbcon, "SELECT SUM(price) AS total FROM purchases WHERE resseller='$username' AND YEARWEEK(date) = YEARWEEK(NOW())");
                            $userSalesData = mysqli_fetch_assoc($userSalesQuery);
                            if (!isset($imintop)) {
                                echo "<tr>
                                        <td></td>
                                        <td><b><span class='glyphicon glyphicon-user'></span> $sellerNickname</b></td>
                                        <td><b>{$userSalesData['total']}\$</b></td>
                                    </tr>";
                            }
                            echo '</tbody></table>';
                        ?>

                        <div class="list-group" id="div2">
                            <h3><i class="glyphicon glyphicon-info-sign"></i> News</h3>
                            <?php
                                $newsQuery = mysqli_query($dbcon, "SELECT * FROM newseller ORDER BY id DESC LIMIT 5") or die(mysqli_error($dbcon));
                                while ($news = mysqli_fetch_assoc($newsQuery)) {
                                    echo "<a class='list-group-item'>
                                            <h5 class='list-group-item-heading'><b>" . stripcslashes($news['content']) . "</b></h5>
                                            <h6 class='list-group-item-text'>{$news['date']}</h6>
                                          </a>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>