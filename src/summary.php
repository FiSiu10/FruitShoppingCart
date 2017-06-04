<?php

	require_once('config.php');
	session_start(); 
    require_once 'view/header.php';
    require_once 'model/db_connect.php';
    require_once 'model/db_functions.php';
	
	$prod = array();

	for ($i = 0; $i < count($_SESSION['itemQty']); $i++) {
		$productInfo = getCartInfo($_SESSION['prod_id'][$i]);
		for ($j = 0; $j < count($productInfo); $j++) {
			$prod[$i] = $productInfo[$j];
		}
		$total[$i] = (int) $_SESSION['itemQty'][$i] * $prod[$i]['unit_price'];
		$subtotal += $total[$i];
		$grandTotal = $subtotal + 10;
}
	
	$custid = $_SESSION['custid'];
	
	// Get Names from Form -- use server-side validation (the filter_input function)
	$shipFirstName = filter_input(INPUT_POST, 'shipFirstName', FILTER_SANITIZE_SPECIAL_CHARS);
	$shipLastName = filter_input(INPUT_POST, 'shipLastName', FILTER_SANITIZE_SPECIAL_CHARS);
	$shipAddress = filter_input(INPUT_POST, 'shipAddress', FILTER_SANITIZE_SPECIAL_CHARS);
	$shipCity = filter_input(INPUT_POST, 'shipCity', FILTER_SANITIZE_SPECIAL_CHARS);
	$shipProvince = filter_input(INPUT_POST, 'shipProvince', FILTER_SANITIZE_SPECIAL_CHARS);
	$shipPostal = filter_input(INPUT_POST, 'shipPostal', FILTER_SANITIZE_SPECIAL_CHARS);
	$shipCountry = filter_input(INPUT_POST, 'shipCountry', FILTER_SANITIZE_SPECIAL_CHARS);
	$billAddress = filter_input(INPUT_POST, 'billAddress', FILTER_SANITIZE_SPECIAL_CHARS);
	$billCity = filter_input(INPUT_POST, 'billCity', FILTER_SANITIZE_SPECIAL_CHARS);
	$billProvince = filter_input(INPUT_POST, 'billProvince', FILTER_SANITIZE_SPECIAL_CHARS);
	$billPostal = filter_input(INPUT_POST, 'billPostal', FILTER_SANITIZE_SPECIAL_CHARS);
	$billCountry = filter_input(INPUT_POST, 'billCountry', FILTER_SANITIZE_SPECIAL_CHARS);
    
    // Get result of filter_input() and check for missing or invalid data
	if (!isset($shipAddress)) {
        $error_message = 'Missing address. Click to go back.';
	} elseif (!isset($shipFirstName)) {
        $error_message = 'Missing first name. Click to go back.';
	} elseif (!isset($shipLastName)) {
        $error_message = 'Missing last name. Click to go back.';
    } elseif (!isset($shipCity)) {
        $error_message = 'Missing city. Click to go back.';
	} elseif (!isset($shipProvince)) {
        $error_message = 'Missing province. Click to go back.';
	} elseif (!isset($shipPostal)) {
        $error_message = 'Missing postal code. Click to go back.';
	} elseif (!isset($shipCountry)) {
        $error_message = 'Missing country. Click to go back.';
	} elseif (!isset($custid)) {
        $error_message = 'Not logged in. Click to go back.';
    } elseif ($shipAddress === false) {
        $error_message = 'Invalid address. Click to go back.';
    } elseif ($shipFirstName === false) {
        $error_message = 'Invalid first name. Click to go back.';
    } elseif ($shipLastName === false) {
        $error_message = 'Invalid last name. Click to go back.';
    } elseif ($shipCity === false) {
        $error_message = 'Invalid city. Click to go back.';
	} elseif ($shipProvince === false) {
        $error_message = 'Invalid province. Click to go back.';
	} elseif ($shipPostal === false) {
        $error_message = 'Invalid postal code. Click to go back.';
	} elseif ($shipCountry === false) {		
        $error_message = 'Invalid country. Click to go back.';
    } elseif (!isset($billAddress)) {
        $error_message = 'Missing address. Click to go back.';
    } elseif (!isset($billCity)) {
        $error_message = 'Missing city. Click to go back.';
	} elseif (!isset($billProvince)) {
        $error_message = 'Missing province. Click to go back.';
	} elseif (!isset($billPostal)) {
        $error_message = 'Missing postal code. Click to go back.';
	} elseif (!isset($billCountry)) {
        $error_message = 'Missing country. Click to go back.';
    } elseif ($billAddress === false) {
        $error_message = 'Invalid address. Click to go back.';
    } elseif ($billCity === false) {
        $error_message = 'Invalid city. Click to go back.';
	} elseif ($billProvince === false) {
        $error_message = 'Invalid province. Click to go back.';
	} elseif ($billPostal === false) {
        $error_message = 'Invalid postal code. Click to go back.';
	} elseif ($billCountry === false) {		
        $error_message = 'Invalid country. Click to go back.';
	} elseif ($custid === false) {		
        $error_message = 'Invalid login. Click to go back.';
    } else {
        $error_message = '';
    }


    // Check if there is an error. Print it and then stop
    // the Script.

    if (!empty($error_message)) {
        echo "<br><br><p><h1 style='margin-left:50px; text-align: center'><a href=\"billing.php\">$error_message </a></h1></p>";
        exit();
    }

   
 ?>

<style>
    .enter{
        text-align: right;
        margin-right: 150px;
    }

    .info{
        margin-left: 175px;
    }

    .bs-wizard {margin-top: 40px; margin-right: 500px; text-align: right;}

    /*Form Wizard*/
    .bs-wizard {border-bottom: solid 1px #e0e0e0; padding: 0 0 10px 0; width: 100%;}
    .bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
    .bs-wizard > .bs-wizard-step + .bs-wizard-step {}
    .bs-wizard > .bs-wizard-step .bs-wizard-stepnum {color: #595959; font-size: 13px; margin-bottom: 5px; font-weight: bold;}
    .bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 10px;}
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #b6ddc2; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;}
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: ' '; width: 14px; height: 14px; background: #97aa40; border-radius: 50px; position: absolute; top: 8px; left: 8px; }
    .bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
    .bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #b6ddc2;}
    .bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
    .bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
    .bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
    .bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
    .bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
    .bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
    .bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
    /*END Form Wizard*/
</style>
 <div class="container">
     <div class="row">
         <div class="col-md-4"><h1>Order Review</h1></div>
         <div class="col-md-4">
             <div class="row bs-wizard" style="border-bottom:0;">
                 <div class="col-xs-3 bs-wizard-step complete">
                     <div class="text-center bs-wizard-stepnum">Login</div>
                     <div class="progress"><div class="progress-bar"></div></div>
                     <a href="#" class="bs-wizard-dot"></a>
                     <div class="bs-wizard-info text-center"></div>
                 </div>

                 <div class="col-xs-3 bs-wizard-step complete"><!-- complete -->
                     <div class="text-center bs-wizard-stepnum">Shipping/Billing</div>
                     <div class="progress"><div class="progress-bar"></div></div>
                     <a href="#" class="bs-wizard-dot"></a>
                     <div class="bs-wizard-info text-center"></div>
                 </div>

                 <div class="col-xs-3 bs-wizard-step complete"><!-- complete -->
                     <div class="text-center bs-wizard-stepnum">Payment</div>
                     <div class="progress"><div class="progress-bar"></div></div>
                     <a href="#" class="bs-wizard-dot"></a>
                     <div class="bs-wizard-info text-center"></div>
                 </div>

                 <div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
                     <div class="text-center bs-wizard-stepnum">Purchase</div>
                     <div class="progress"><div class="progress-bar"></div></div>
                     <a href="#" class="bs-wizard-dot"></a>
                     <div class="bs-wizard-info text-center"></div>
                 </div>
             </div>
         </div>
         <div class="col-md-4"></div>
     </div>
     <br><br>
    <div class="row info">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Shipping Address</h4></div>
                <div class="panel-body">
				<!-- Note: Don't need htmlspecialchars() function here since these vars were already sanitized above -->
					<h5 class="name">First Name: <?php echo $shipFirstName; ?></h5>
					<h5 class="name">Last Name: <?php echo $shipLastName; ?></h5>
					<h5 class="name">Street Address: <?php echo $shipAddress; ?></h5>
					<h5 class="name">City: <?php echo $shipCity; ?></h5>
					<h5 class="name">Province: <?php echo $shipProvince; ?></h5>
					<h5 class="name">Postal Code: <?php echo $shipPostal; ?></h5>
					<h5 class="name">Country: <?php echo $shipCountry; ?></h5>
					<br>
                    <form action="shipping.php" method="post">
                        <h5>If incorrect, please edit shipping address:</h5>
                        <button type="submit" class="btn btn-default">EDIT</button>
                    </form>
				</div>
			</div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Billing Details</h4></div>
                <div class="panel-body">
					<h5 class="name">Street Address: <?php echo $billAddress; ?></h5>
					<h5 class="name">City: <?php echo $billCity; ?></h5>
					<h5 class="name">Province: <?php echo $billProvince; ?></h5>
					<h5 class="name">Postal Code: <?php echo $billPostal; ?></h5>
					<h5 class="name">Country: <?php echo $billCountry; ?></h5>
					<h5> </h5>
                    <h5> </h5>
                    <h5> </h5>
                    <form action="billing.php" method="post">
                        <h5>If incorrect, please edit billing address:</h5>
                        <button type="submit" class="btn btn-default">EDIT</button>
                    </form>
				</div>
			</div>
        </div>
    </div>
     <div class="row enter">
         <form action="charge.php" method="post">
             <input type="hidden" name="custid" value="<?php print $custid; ?>"/>
             <input type="hidden" name="shipFirstName" value="<?php print $shipFirstName; ?>"/>
             <input type="hidden" name="shipLastName" value="<?php print $shipLastName; ?>"/>
             <input type="hidden" name="shipAddress" value="<?php print $shipAddress; ?>"/>
             <input type="hidden" name="shipCity" value="<?php print $shipCity; ?>"/>
             <input type="hidden" name="shipProvince" value="<?php print $shipProvince; ?>"/>
             <input type="hidden" name="shipPostal" value="<?php print $shipPostal; ?>"/>
             <input type="hidden" name="shipCountry" value="<?php print $shipCountry; ?>"/>

             <input type="hidden" name="billFirstName" value="<?php print $billFirstName; ?>"/>
             <input type="hidden" name="billLastName" value="<?php print $billLastName; ?>"/>
             <input type="hidden" name="billAddress" value="<?php print $billAddress; ?>"/>
             <input type="hidden" name="billCity" value="<?php print $billCity; ?>"/>
             <input type="hidden" name="billProvince" value="<?php print $billProvince; ?>"/>
             <input type="hidden" name="billPostal" value="<?php print $billPostal; ?>"/>
             <input type="hidden" name="billCountry" value="<?php print $billCountry; ?>"/>

             <h4>If the info on this page is correct please submit your order:</h4>
             <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                     data-key="<?php echo $stripe['publishable_key']; ?>"
                     data-description="Payment Checkout"
                     data-amount="<?php echo $grandTotal * 100; ?>"
                     data-locale="auto"
                     data-currency="cad">
             </script>
             <input type="hidden" name="amount" value="<?php echo $grandTotal * 100; ?>" />
         </form>
     </div>
    <br>
</div><br><br>

</body>
</html>