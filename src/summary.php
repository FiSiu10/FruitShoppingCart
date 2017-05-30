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
        $error_message = 'Missing address.';
	} elseif (!isset($shipFirstName)) {
        $error_message = 'Missing first name.';
	} elseif (!isset($shipLastName)) {
        $error_message = 'Missing last name.';
    } elseif (!isset($shipCity)) {
        $error_message = 'Missing city.';
	} elseif (!isset($shipProvince)) {
        $error_message = 'Missing province.';
	} elseif (!isset($shipPostal)) {
        $error_message = 'Missing postal code.';		
	} elseif (!isset($shipCountry)) {
        $error_message = 'Missing country.';
	} elseif (!isset($custid)) {
        $error_message = 'Not logged in.';
    } elseif ($shipAddress === false) {
        $error_message = 'Invalid address.';
    } elseif ($shipFirstName === false) {
        $error_message = 'Invalid first name.';
    } elseif ($shipLastName === false) {
        $error_message = 'Invalid last name.';
    } elseif ($shipCity === false) {
        $error_message = 'Invalid city.';
	} elseif ($shipProvince === false) {
        $error_message = 'Invalid province.';
	} elseif ($shipPostal === false) {
        $error_message = 'Invalid postal code.';
	} elseif ($shipCountry === false) {		
        $error_message = 'Invalid country.';
    } elseif (!isset($billAddress)) {
        $error_message = 'Missing address.';
    } elseif (!isset($billCity)) {
        $error_message = 'Missing city.';
	} elseif (!isset($billProvince)) {
        $error_message = 'Missing province.';
	} elseif (!isset($billPostal)) {
        $error_message = 'Missing postal code.';		
	} elseif (!isset($billCountry)) {
        $error_message = 'Missing country.';
    } elseif ($billAddress === false) {
        $error_message = 'Invalid address.';
    } elseif ($billCity === false) {
        $error_message = 'Invalid city.';
	} elseif ($billProvince === false) {
        $error_message = 'Invalid province.';
	} elseif ($billPostal === false) {
        $error_message = 'Invalid postal code.';
	} elseif ($billCountry === false) {		
        $error_message = 'Invalid country.';
	} elseif ($custid === false) {		
        $error_message = 'Invalid login.';
    } else {
        $error_message = '';
    }

    // Check if there is an error. Print it and then stop
    // the Script.
    if (!empty($error_message)) {
		echo "<p><h3 style='color:red;margin-left:50px;'>$error_message </h3></p>"; 
		echo '<p><h3 style="margin-left:50px;"><a href="billing.php">Please go back to the billing form.</a></h3></p>';
        exit();
    }

   
 ?>
 <div class="container">
    <div class="row">
        <h2>Order Review</h2><br>
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Shipping Address</div>
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
            <div class="panel panel-success">
                <div class="panel-heading">Billing Details</div>
                <div class="panel-body">
					<h5 class="name">Street Address: <?php echo $billAddress; ?></h5>
					<h5 class="name">City: <?php echo $billCity; ?></h5>
					<h5 class="name">Province: <?php echo $billProvince; ?></h5>
					<h5 class="name">Postal Code: <?php echo $billPostal; ?></h5>
					<h5 class="name">Country: <?php echo $billCountry; ?></h5>
					<br>
			<form action="billing.php" method="post">
				<h5>If incorrect, please edit billing address:</h5>
				<button type="submit" class="btn btn-default">EDIT</button>
			</form>
				</div>
			</div>
            <div class="panel panel-success">

                </div>
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

    </div><br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="progress">
                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" area-valuemax="100" style="width:80%">
                    Order Summary
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div><br><br>

</body>
</html>