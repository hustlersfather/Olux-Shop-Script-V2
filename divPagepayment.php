<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) || !isset($_SESSION['spass'])) {
    header("location: ");
    exit();
}

$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$p_data = $_GET['p_data'];

// Fetch payment details from the database
$q = mysqli_query($dbcon, "SELECT * FROM payment WHERE user='$uid' AND p_data='$p_data'") or die(mysqli_error());

// Check if payment details exist
if (mysqli_num_rows($q) > 0) {
    $row = mysqli_fetch_assoc($q);
    
    // Check if payment method is Bitcoin
    if ($row['method'] == "Bitcoin") {
        $address = $row['address'];
        $amountBTC = $row['amount'] + 0.00002730; // Adjusted amount
        
        // Display custom payment form and QR code
        ?>
        <div id="bitcoin">
            <div class="container col-lg-6">
                <h3>Pay using Bitcoin</h3>
                <div class="form-group col-lg-4 ">
                    <center>
                        <a id="bitcoinbutton" href="bitcoin:<?php echo $address; ?>?amount=<?php echo $amountBTC; ?>&amp;message=JeruxShop-15" target="_blank" title="Pay with Bitcoin">
                            <img alt="Pay with Bitcoin" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&amp;data=bitcoin:<?php echo $address; ?>?amount=<?php echo $amountBTC; ?>&amp;message=JeruxShop-15&amp;choe=UTF-8&amp;chs=200x200" style="" height="150" width="150">
                        </a>
                        <br>
                    </center>
                </div>
                <div class="form-group col-lg-6">
                    <br><br>
                    Send exactly <span id="selectable"><b><?php echo $amountBTC; ?></b></span> BTC to: <span class="label label-default" id="selectable2"><?php echo $address; ?></span><br><br>
                    <!-- Additional information here -->
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="bs-component">
                <br><br>
                <div class="well well">
                    <ul>
                        <!-- Payment instructions and details here -->
                    </ul>
                </div>
            </div>
        </div>
        <div id="error" class="form-group col-lg-5 "></div>
        <script type="text/javascript">
            // JavaScript code for handling payment status, etc.
        </script>
        <?php
    } else {
        // Redirect to index.html if payment method is not Bitcoin (e.g., PerfectMoney)
        header('Location: index.html');
    }
} else {
    // Handle case where payment details are not found
    echo "Payment details not found.";
}
?>

<div id="error" class="form-group col-lg-5 "></div>
<script type="text/javascript">
var Check_BTC_x = true;
function check_address(){
      $("#Img").html('<img src="files/img/load.gif" height="15" width="15">').show();
      $.ajax({
      type:       'GET',
      url:        'Check.html?p_data=<?php echo $p_data; ?>',
           success: function(data)
           {         
              var data = JSON.parse(data);
              $("#time").html(data['time'] ).show();
              $("#amount").html(data['btc'] ).show();
              $("#state").html(data['state'] ).show();
              $("#Img").html('').show();
              if (data['error'] == 1) {$("#error").html(data['errorTXT'] ).show();}
              if (data['stop'] == 1) {stopCheckBTC();}

           }
         });

  }
var x23 = 10000;
var Check_BTC = setInterval(function(){check_address()}, x23);

function stopCheckBTC(){
  if (Check_BTC){
  clearInterval(Check_BTC);
  }
  return true;
}

    function selectText(containerid) {
        if (document.selection) {
            var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById(containerid));
            range.select();
        } else if (window.getSelection) {
            var range = document.createRange();
            range.selectNode(document.getElementById(containerid));
            window.getSelection().addRange(range);
        }
    }
</script>
 
<?php
	} } 
?>