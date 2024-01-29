<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

// Assuming getUserBalance, getProductDetails, and purchaseProduct methods are defined in UserManager.php
include "core/UserManager.php"; 
$userManager = new UserManager($dbcon);
$userBalance = $userManager->getUserBalance($usrid);

if (isset($_GET['buy'])) {
    $productId = $_GET['buy'];
    $productPrice = $userManager->getProductPrice($productId);

    if ($userBalance >= $productPrice) {
        if ($userManager->purchaseProduct($usrid, $productId)) {
            echo "<script>alert('Purchase successful');</script>";
        } else {
            echo "<script>alert('Purchase failed');</script>";
        }
    } else {
        echo "<script>alert('Insufficient balance');</script>";
    }
}

include "template/header.php";
?>

<!-- Product Filtering -->
<div id="myTabContent" class="tab-content">
  <div class="tab-pane active in" id="filter">
    <!-- Filter Form -->
  </div>
</div>

<!-- Product Table -->
<table width="100%" class="table table-striped table-bordered table-condensed sticky-header" id="table">
  <thead>
    <tr>
      <th>Country</th>
      <th>Bank Name</th>
      <th>Balance</th>
      <th>Info</th>
      <th>Seller</th>
      <th>Price</th>
      <th>Added on</th>
      <th>Buy</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $q = mysqli_query($dbcon, "SELECT * FROM banks WHERE sold='0' ORDER BY RAND()");
    while($row = mysqli_fetch_assoc($q)) {
        $sellerInfo = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$row['resseller']."'"));
        $sellerNick = "seller".$sellerInfo["id"];
        // Display each product row
    ?>
    <tr>
      <td><?php echo htmlspecialchars($row['country']); ?></td>
      <td><?php echo htmlspecialchars($row['bankname']); ?></td>
      <td><?php echo htmlspecialchars($row['balance']); ?></td>
      <td><?php echo htmlspecialchars($row['infos']); ?></td>
      <td><?php echo htmlspecialchars($sellerNick); ?></td>
      <td><?php echo htmlspecialchars($row['price']); ?></td>
      <td><?php echo $row['date']; ?></td>
      <td>
        <a href="products.php?buy=<?php echo $row['id']; ?>" class="btn btn-primary btn-xs">Buy</a>
      </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>

<!-- Include Modal and Footer -->
<?php include "template/footer.php"; ?>