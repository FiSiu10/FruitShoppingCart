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
    } else {
        $error_message = '';
    }

    // Check if there is an error. Print it and then stop
    // the Script.
    if (!empty($error_message)) {
        echo $error_message . '<p>Go <a href="shipping.php">back to the form</a></p>';
        exit();
    }
	
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
                    <input pattern="\d+ [0-9a-zA-Z. ]+" title="Must start with a number and can be followed by a number or letters" type="text" class="form-control" id="address" name="billAddress" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
					<!-- do some client-side validation of form data -->
                    <input pattern="^[A-Z][a-z]+$" title="Must start with a capital letter followed by one or more small letters" type="text" class="form-control" id="city" name="billCity" placeholder="City">
                </div>
                <div class="form-group">
                    <label>Province</label><br>
                    <select name="billProvince">
                        <option value="AB">Alberta</option>
                        <option value="BC">British Columbia</option>
                        <option value="MB">Manitoba</option>
                        <option value="NB">New Brunswick</option>
                        <option value="NL">Newfoundland and Labrador</option>
                        <option value="NS">Nova Scotia</option>
                        <option value="ON">Ontario</option>
                        <option value="PE">Prince Edward Island</option>
                        <option value="QC">Quebec</option>
                        <option value="SK">Saskatchewan</option>
                        <option value="NT">Northwest Territories</option>
                        <option value="NU">Nunavut</option>
                        <option value="YT">Yukon</option>
                    </select>
                </div>
				<div class="form-group">
                    <label for="postalcode">Postal Code</label>
					<!-- do some client-side validation of form data -->
                    <input pattern="^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$" title="Must go letter # letter # letter #" type="text" class="form-control" id="postalcode" name="billPostal" placeholder="Postal Code">
                </div>
                <div class="form-group">
                    <label>Country:</label><br>
                    <select name="billCountry">
                        <option value="CA">Canada</option>
                    </select>
                </div>
                <br>
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