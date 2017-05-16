<?php
    require_once 'header.html';
    require_once '../model/db_connect.php';
    require_once '../model/db_functions.php';
	
	
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
    } else {
        $error_message = '';
    }

    // Check if there is an error. Print it and then stop
    // the Script.
    if (!empty($error_message)) {
        echo $error_message . '<p>Go <a href="billing.html">back to the form</a></p>';
        exit();
    }

   
 ?>
   <div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="correct.php" method="post">
                <h2>The Shipping Address you entered in the Form was:</h2>
				<!-- Note: Don't need htmlspecialchars() function here since these vars were already sanitized above -->
				<h4 class="name">First Name: <?php echo $shipFirstName; ?></h4>
				<h4 class="name">Last Name: <?php echo $shipLastName; ?></h4>
				<h4 class="name">Street Address: <?php echo $shipAddress; ?></h4>
				<h4 class="name">City: <?php echo $shipCity; ?></h4>
				<h4 class="name">Province: <?php echo $shipProvince; ?></h4>
				<h4 class="name">Postal Code: <?php echo $shipPostal; ?></h4>
				<h4 class="name">Country: <?php echo $shipCountry; ?></h4><br>
				<h2>The Billing Address you entered in the Form was:</h2>
				<!-- Note: Don't need htmlspecialchars() function here since these vars were already sanitized above -->
				<h4 class="name">Street Address: <?php echo $billAddress; ?></h4>
				<h4 class="name">City: <?php echo $billCity; ?></h4>
				<h4 class="name">Province: <?php echo $billProvince; ?></h4>
				<h4 class="name">Postal Code: <?php echo $billPostal; ?></h4>
				<h4 class="name">Country: <?php echo $billCountry; ?></h4>
                </div>
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
				<h2>If the info on this page is correct please submit your order:</h2>
                <button type="submit" class="btn btn-default">Continue to Stripe</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div><br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="progress">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" area-valuemax="100" style="width:40%">
                    Billing Information
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

</div><br><br>

</body>
</html>