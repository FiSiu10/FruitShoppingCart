<?php
    require_once 'view/header.php';
    require_once 'model/db_connect.php';
    require_once 'model/db_functions.php';

	$custid = $_SESSION['custid'];
	
	// Get Names from Form -- use server-side validation (the filter_input function)
	$shipFirstName = filter_input(INPUT_POST, 'shipFirstName', FILTER_SANITIZE_SPECIAL_CHARS);
	$shipLastName = filter_input(INPUT_POST, 'shipLastName', FILTER_SANITIZE_SPECIAL_CHARS);
	$shipAddress = filter_input(INPUT_POST, 'shipAddress', FILTER_SANITIZE_SPECIAL_CHARS);
	$shipCity = filter_input(INPUT_POST, 'shipCity', FILTER_SANITIZE_SPECIAL_CHARS);
	$shipProvince = filter_input(INPUT_POST, 'shipProvince', FILTER_SANITIZE_SPECIAL_CHARS);
	$shipPostal = filter_input(INPUT_POST, 'shipPostal', FILTER_SANITIZE_SPECIAL_CHARS);
	$shipCountry = filter_input(INPUT_POST, 'shipCountry', FILTER_SANITIZE_SPECIAL_CHARS);
    
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
	} elseif ($custid === false) {		
        $error_message = 'Invalid login.';
    } else {
        $error_message = '';
    }

    // Check if there is an error. Print it and then stop
    // the Script.
    if (!empty($error_message)) {
        echo "<p><h3 style='color:red;margin-left:50px;'>$error_message </h3></p>"; 
		echo '<p><h3 style="margin-left:50px;"><a href="shipping.php">Please go back to the shipping form.</a></h3></p>';
        exit();
    }
	
	//if checkbox is selected, set values of the form to the data sent from shipping.
	$same = $_POST['same'];
?>

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="summary.php" method="post">
                <h2>Billing Address</h2><br>
                <div class="form-group">
                    <label for="address">Street Address:</label>
					<!-- do some client-side validation of form data -->
                    <input required pattern="\W*\d+\W*\d+ [0-9a-zA-Z. ]+" title="Use symbols, numbers or letters" type="text" class="form-control" id="address" name="billAddress" placeholder="Address" value="<?php if ($same) print $shipAddress; ?>"/>
                </div>
                <div class="form-group">
                    <label for="city">City</label>
					<!-- do some client-side validation of form data -->
                    <input required pattern="^[A-Z][a-z]+$" title="Must start with a capital letter followed by one or more small letters" type="text" class="form-control" id="city" name="billCity" placeholder="City" value="<?php if ($same) print $shipCity; ?>"/>
                </div>
                <div class="form-group">
                    <label>Province</label><br>
                    <select name="billProvince">
					    <option value="AB" <?php if ($same) { if ($shipProvince == 'AB') { echo 'selected="selected"';} } ?>"/>Alberta</option>
                        <option value="BC" <?php if ($same) { if ($shipProvince == 'BC') { echo 'selected="selected"'; } } ?>"/>British Columbia</option>
                        <option value="MB" <?php if ($same) { if ($shipProvince == 'MB') { echo 'selected="selected"'; } } ?>"/>>Manitoba</option>
                        <option value="NB" <?php if ($same) { if ($shipProvince == 'NB') { echo 'selected="selected"'; } } ?>"/>>New Brunswick</option>
                        <option value="NL" <?php if ($same) { if ($shipProvince == 'NL') { echo 'selected="selected"'; } } ?>"/>>Newfoundland and Labrador</option>
                        <option value="NS" <?php if ($same) { if ($shipProvince == 'NS') { echo 'selected="selected"'; } } ?>"/>>Nova Scotia</option>
                        <option value="ON" <?php if ($same) { if ($shipProvince == 'ON') { echo 'selected="selected"'; } } ?>"/>>Ontario</option>
                        <option value="PE" <?php if ($same) { if ($shipProvince == 'PE') { echo 'selected="selected"'; } } ?>"/>>Prince Edward Island</option>
                        <option value="QC" <?php if ($same) { if ($shipProvince == 'QC') { echo 'selected="selected"'; } } ?>"/>>Quebec</option>
                        <option value="SK" <?php if ($same) { if ($shipProvince == 'SK') { echo 'selected="selected"'; } } ?>"/>>Saskatchewan</option>
                        <option value="NT" <?php if ($same) { if ($shipProvince == 'NT') { echo 'selected="selected"'; } } ?>"/>>Northwest Territories</option>
                        <option value="NU" <?php if ($same) { if ($shipProvince == 'NU') { echo 'selected="selected"'; } } ?>"/>>Nunavut</option>
                        <option value="YT" <?php if ($same) { if ($shipProvince == 'YT') { echo 'selected="selected"'; } } ?>"/>Yukon</option>
                    </select>
                </div>
				<div class="form-group">
                    <label for="postalcode">Postal Code</label>
					<!-- do some client-side validation of form data -->
                    <input required pattern="^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$" title="Must go letter # letter # letter #" type="text" class="form-control" id="postalcode" name="billPostal" placeholder="Postal Code" value="<?php if ($same) print $shipPostal; ?>"/>
                </div>
                <div class="form-group">
                    <label>Country:</label><br>
                    <select name="billCountry">
                        <option value="CA">Canada</option>
                    </select>
                </div>
                <br>
				<input type="hidden" name="custid" value="<?php print $custid; ?>"/>
				<input type="hidden" name="shipFirstName" value="<?php print $shipFirstName; ?>"/>
				<input type="hidden" name="shipLastName" value="<?php print $shipLastName; ?>"/>
				<input type="hidden" name="shipAddress" value="<?php print $shipAddress; ?>"/>
				<input type="hidden" name="shipCity" value="<?php print $shipCity; ?>"/>
				<input type="hidden" name="shipProvince" value="<?php print $shipProvince; ?>"/>
				<input type="hidden" name="shipPostal" value="<?php print $shipPostal; ?>"/>
				<input type="hidden" name="shipCountry" value="<?php print $shipCountry; ?>"/>
                <button type="submit" class="btn btn-default">Continue to Address Info Review</button>
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