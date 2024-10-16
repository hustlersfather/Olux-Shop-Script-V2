Create marketplace projects according below I needed overview documentation and 

Create marketplace resseller makes profit from buyers and admin credit resseller ther profits and remove percentage from it for his web app resources model and views crud  all for below 
Fix and add more options if needed 
Use the routes/


use App\Http\Controllers\Reseller\ResellerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'user/auth'])->group(function () {
    Route::get('/', [ResellerController::class, 'dashboard'])->name('reseller.dashboard.index');

    // Content Management Routes
    Route::get('/index', [ResellerController::class, 'index'])->name('reseller.index');
    Route::get('/ajaxinfo', [ResellerController::class, 'ajaxInfo'])->name('reseller.ajaxinfo');

    // Shell Management Routes
    Route::get('/shell', [ResellerController::class, 'shell'])->name('reseller.shell.index');
    Route::get('/shellMass', [ResellerController::class, 'shellMass'])->name('reseller.shell.mass');
    Route::get('/shellTab1', [ResellerController::class, 'shellTab1'])->name('reseller.shell.tab1');
    Route::get('/shellTab2', [ResellerController::class, 'shellTab2'])->name('reseller.shell.tab2');
    Route::get('/shellTab3', [ResellerController::class, 'shellTab3'])->name('reseller.shell.tab3');

    // RDP Management Routes
    Route::get('/rdp', [ResellerController::class, 'rdp'])->name('reseller.rdp.index');
    Route::get('/rdpAdd', [ResellerController::class, 'rdpAdd'])->name('reseller.rdp.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/rdpTab1', [ResellerController::class, 'rdpTab1'])->name('reseller.rdp.tab1');
    Route::get('/rdpTab2', [ResellerController::class, 'rdpTab2'])->name('reseller.rdp.tab2');

    // Sales and Withdrawal
    Route::get('/sales', [ResellerController::class, 'sales'])->name('reseller.sales.index');
    Route::get('/withdraw', [ResellerController::class, 'withdraw'])->name('reseller.withdraw.index');

    // Reports
    Route::get('/reports', [ResellerController::class, 'reports'])->name('reseller.reports.index');
    Route::get('/reportsTab1', [ResellerController::class, 'reportsTab1'])->name('reseller.reports.tab1');
    Route::get('/reportsTab2', [ResellerController::class, 'reportsTab2'])->name('reseller.reports.tab2');

    // Premium Management
    Route::get('/premium', [ResellerController::class, 'premium'])->name('reseller.premium.index');
    Route::get('/premiumAdd', [ResellerController::class, 'premiumAdd'])->name('reseller.premium.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/premiumTab1', [ResellerController::class, 'premiumTab1'])->name('reseller.premium.tab1');
    Route::get('/premiumTab2', [ResellerController::class, 'premiumTab2'])->name('reseller.premium.tab2');

    // Bank Management
    Route::get('/banks/index', [ResellerController::class, 'banks'])->name('reseller.banks.index');
    Route::get('/banks/Add', [ResellerController::class, 'banksAdd'])->name('reseller.banks.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/banks/Tab1', [ResellerController::class, 'banksTab1'])->name('reseller.banks.tab1');
    Route::get('/banks/Tab2', [ResellerController::class, 'banksTab2'])->name('reseller.banks.tab2');

    // SMTP Management
    Route::get('/smtp/index', [ResellerController::class, 'smtp'])->name('reseller.smtp.index');
    Route::get('/smtp/Add', [ResellerController::class, 'smtpAdd'])->name('reseller.smtp.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/smtp/Tab1', [ResellerController::class, 'smtpTab1'])->name('reseller.smtp.tab1');
    Route::get('/smtp/Tab2', [ResellerController::class, 'smtpTab2'])->name('reseller.smtp.tab2');

    // Tutorials
    Route::get('/tutorial/index', [ResellerController::class, 'tutorial'])->name('reseller.tutorial.index');
    Route::get('/tutorial/Add', [ResellerController::class, 'tutorialAdd'])->name('reseller.tutorial.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/tutorial/Tab1', [ResellerController::class, 'tutorialTab1'])->name('reseller.tutorial.tab1');
    Route::get('/tutorial/Tab2', [ResellerController::class, 'tutorialTab2'])->name('reseller.tutorial.tab2');

    // Mailer Management
    Route::get('/mailer/', [ResellerController::class, 'mailer'])->name('reseller.mailer.index');
    Route::get('/mailer/Add', [ResellerController::class, 'mailerAdd'])->name('reseller.mailer.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/mailer/Tab1', [ResellerController::class, 'mailerTab1'])->name('reseller.mailer.tab1');
    Route::get('/mailer/Tab2', [ResellerController::class, 'mailerTab2'])->name('reseller.mailer.tab2');

    // cPanel Management
    Route::get('/cpanel/', [ResellerController::class, 'cpanel'])->name('reseller.cpanel.index');
    Route::get('/cpanel/Add', [ResellerController::class, 'cpanelAdd'])->name('reseller.cpanel.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/cpanel/Mass', [ResellerController::class, 'cpanelMass'])->name('reseller.cpanel.mass')->middleware('isAdmin'); // Require admin approval
    Route::get('/cpanel/Tab1', [ResellerController::class, 'cpanelTab1'])->name('reseller.cpanel.tab1');
    Route::get('/cpanel/Tab2', [ResellerController::class, 'cpanelTab2'])->name('reseller.cpanel.tab2');
    Route::get('/cpanel/Tab3', [ResellerController::class, 'cpanelTab3'])->name('reseller.cpanel.tab3');

    // Leads Management
    Route::get('/leads/', [ResellerController::class, 'leads'])->name('reseller.leads.index');
    Route::get('/lead/Add', [ResellerController::class, 'leadAdd'])->name('reseller.lead.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/lead/Tab1', [ResellerController::class, 'leadTab1'])->name('reseller.lead.tab1');
    Route::get('/lead/Tab2', [ResellerController::class, 'leadTab2'])->name('reseller.lead.tab2');

    // Scampage Management
    Route::get('/scampage/', [ResellerController::class, 'scampage'])->name('reseller.scampage.index');
    Route::get('/scampage/Add', [ResellerController::class, 'scampageAdd'])->name('reseller.scampage.add')->middleware('isAdmin'); // Require admin approval
    Route::get('/scampage/Tab1', [ResellerController::class, 'scampageTab1'])->name('reseller.scampage.tab1');
    Route::get('/scampage/Tab2', [ResellerController::class, 'scampageTab2'])->name('reseller.scampage.tab2');

    // Dynamic routes for Vt, Vr, Refund, Order
    Route::get('/vt-{id}', [ResellerController::class, 'vt'])->name('reseller.vt');
    Route::get('/vr-{id}', [ResellerController::class, 'vr'])->name('reseller.vr');
    Route::get('/refund-{id}', [ResellerController::class, 'refund'])->name('reseller.refund');
    Route::get('/showOrder{orderId}', [ResellerController::class, 'showOrder'])->name('reseller.showOrder');
});

admin manage users and resseller permissions 

resseller manage all create view and delete  and post and get 
Users that’s not resseller navigate static htnl page with tables and implement post to buy and view purchased item from resseller create tickets support and report to admin 

php artisan make:migration create_banks_table --create=banks
php artisan make:migration create_cpanels_table --create=cpanels
php artisan make:migration create_images_table --create=images
php artisan make:migration create_leads_table --create=leads
php artisan make:migration create_mailers_table --create=mailers
php artisan make:migration create_news_table --create=news
php artisan make:migration create_newseller_table --create=newseller
php artisan make:migration create_payment_table --create=payment
php artisan make:migration create_purchases_table --create=purchases
php artisan make:migration create_rdps_table --create=rdps
php artisan make:migration create_reports_table --create=reports
php artisan make:migration create_ticket_table --create=ticket
php artisan make:migration create_tutorials_table --create=tutorials

php artisan make:controller BankController --resource
php artisan make:controller CpanelController --resource
php artisan make:controller ImageController --resource
php artisan make:controller LeadController --resource
php artisan make:controller MailerController --resource
php artisan make:controller NewsellerController --resource
php artisan make:controller PaymentController --resource
php artisan make:controller PurchaseController --resource
php artisan make:controller RdpController --resource

php artisan make:controller Resseller/Resseller controller --resource
php artisan make:controller Admin/AdminController --resource
php artisan make:controller User/UserController --resource

Create complete frontend Frontend and Views

<?php include"layouts/master.php";?>
<?php include"partials/navbar.php";?>

<ul class="nav nav-tabs">
  <li class="active"><a href="#filter" data-toggle="tab">Filter</a></li>
</ul>
<div id="myTabContent" class="tab-content" >
  <div class="tab-pane active in" id="filter"><table class="table"><thead><tr><th>Country</th>
<th>Description</th>
<th>Seller</th>
<th></th></tr></thead><tbody><tr><td><select class='filterselect form-control input-sm' name="leads_country"><option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`country`) FROM `leads` WHERE `sold` = '0' ORDER BY country ASC");
	while($row = mysqli_fetch_assoc($query)){
	echo '<option value="'.$row['country'].'">'.$row['country'].'</option>';
	}
?>
</select></td><td><input class='filterinput form-control input-sm' name="leads_about" size='3'></td><td><select class='filterselect form-control input-sm' name="leads_seller"><option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`resseller`) FROM `leads` WHERE `sold` = '0' ORDER BY resseller ASC");
	while($row = mysqli_fetch_assoc($query)){
		 $qer = mysqli_query($dbcon, "SELECT DISTINCT(`id`) FROM resseller WHERE username='".$row['resseller']."' ORDER BY id ASC")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
	echo '<option value="'.$SellerNick.'">'.$SellerNick.'</option>';
	}
?>
</select></td><td><button id='filterbutton'class="btn btn-primary btn-sm" disabled>Filter <span class="glyphicon glyphicon-filter"></span></button></td></tr></tbody></table></div>
</div>


<table width="100%"  class="table table-striped table-bordered table-condensed sticky-header" id="table">
<thead>
    <tr>
      <th scope="col" >Country</th>
      <th scope="col">Description</th>
      <th scope="col">Email N</th>

      <th scope="col">Seller</th>
      <th scope="col">Price</th>
      <th scope="col">Added on </th>

      <th scope="col">Buy</th>
    </tr>
</thead>
  <tbody>

 <?php
include("cr.php");
$q = mysqli_query($dbcon, "SELECT * FROM leads WHERE sold='0' ORDER BY RAND()")or die(mysqli_error());
 while($row = mysqli_fetch_assoc($q)){
	 
	 	 $ countryfullname = $row['country'];
	  $code = array_search("$countryfullname", $countrycodes);
	 $countrycode = strtolower($code);
	    $qer = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$row['resseller']."'")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
     echo "
 <tr>     
    <td id='leads_country'><i class='flag-icon flag-icon-$countrycode'></i>&nbsp;".htmlspecialchars($row['country'])." </td>
    <td id='leads_about'> ".htmlspecialchars($row['infos'])." </td> 
	<td> ".htmlspecialchars($row['number'])." </td>
    <td id='leads_seller'> ".htmlspecialchars($SellerNick)."</td>
    <td> ".htmlspecialchars($row['price'])."</td>
	    <td> ".$row['date']."</td>";
    echo '
    <td>
	<span id="leads'.$row['id'].'" title="buy" type="leads"><a onclick="javascript:buythistool('.$row['id'].')" class="btn btn-primary btn-xs"><font color=white>Buy</font></a></span><center>
    </td>
            </tr>
     ';
 }

 ?>
<script type="text/javascript">
$('#filterbutton').click(function () {$("#table tbody tr").each(function() {var ck1 = $.trim( $(this).find("#leads_country").text().toLowerCase() );var ck2 = $.trim( $(this).find("#leads_about").text().toLowerCase() );var ck3 = $.trim( $(this).find("#leads_seller").text().toLowerCase() ); var val1 = $.trim( $('select[name="leads_country"]').val().toLowerCase() );var val2 = $.trim( $('input[name="leads_about"]').val().toLowerCase() );var val3 = $.trim( $('select[name="leads_seller"]').val().toLowerCase() ); if((ck1 != val1 && val1 != '' ) || ck2.indexOf(val2)==-1 || (ck3 != val3 && val3 != '' )){ $(this).hide();  }else{ $(this).show(); } });$('#filterbutton').prop('disabled', true);});$('.filterselect').change(function () {$('#filterbutton').prop('disabled', false);});$('.filterinput').keyup(function () {$('#filterbutton').prop('disabled', false);});
function buythistool(id){
  bootbox.confirm("Are you sure?", function(result) {
        if(result ==true){
      $.ajax({
     method:"GET",
     url:"buytool.php?id="+id+"&t=leads",
     dataType:"text",
     success:function(data){
         if(data.match(/<button/)){
		 $("#leads"+id).html(data).show();
         }else{
            bootbox.alert('<center><img src="files/img/balance.png"><h2><b>No enough balance !</b></h2><h4>Please refill your balance <a class="btn btn-primary btn-xs"  href="addBalance.html" onclick="window.open(this.href);return false;" >Add Balance <span class="glyphicon glyphicon-plus"></span></a></h4></center>')
         }
     },
   });
       ;}
  });
}
function openitem(order){
  $("#myModalLabel").text('Order #'+order);
  $('#myModal').modal('show');
  $.ajax({
    type:       'GET',
    url:        'showOrder'+order+'.html',
    success:    function(data)
    {
        $("#modelbody").html(data).show();
    }});

}

</script>
<?php include"partials/footer.php";?>

Ensure your views align with the CRUD functionality and provide the necessary forms for creating, updating, and displaying items. Use Blade templates to create dynamic views based on the resources managed.

8. User and Reseller Navigation

For users who are not resellers, ensure they have access to static HTML pages and can manage their purchases, support tickets, and reports.

9. Additional Features

Consider adding features such as:

	•	Pagination for long lists of resources.
	•	AJAX calls for dynamic content updates without page refresh.
	•	Detailed reporting features for both admin and reseller dashboards.

Final Notes

Make sure to run migrations after creating your migration files and set up your database connection correctly. You can use:
