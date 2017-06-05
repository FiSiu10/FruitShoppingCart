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
        $error_message = 'Missing address. Please fill out shipping information.';
	} elseif (!isset($shipFirstName)) {
        $error_message = 'Missing first name. Please fill out shipping information.';
	} elseif (!isset($shipLastName)) {
        $error_message = 'Missing last name. Please fill out shipping information.';
    } elseif (!isset($shipCity)) {
        $error_message = 'Missing city. Please fill out shipping information.';
	} elseif (!isset($shipProvince)) {
        $error_message = 'Missing province. Please fill out shipping information.';
	} elseif (!isset($shipPostal)) {
        $error_message = 'Missing postal code. Please fill out shipping information.';
	} elseif (!isset($shipCountry)) {
        $error_message = 'Missing country. Please fill out shipping information.';
	} elseif (!isset($custid)) {
        $error_message = 'Not logged in. Please fill out shipping information.';
    } elseif ($shipAddress === false) {
        $error_message = 'Invalid address. Please fill out shipping information.';
    } elseif ($shipFirstName === false) {
        $error_message = 'Invalid first name. Please fill out shipping information.';
    } elseif ($shipLastName === false) {
        $error_message = 'Invalid last name. Please fill out shipping information.';
    } elseif ($shipCity === false) {
        $error_message = 'Invalid city. Please fill out shipping information.';
	} elseif ($shipProvince === false) {
        $error_message = 'Invalid province. Please fill out shipping information.';
	} elseif ($shipPostal === false) {
        $error_message = 'Invalid postal code. Please fill out shipping information.';
	} elseif ($shipCountry === false) {		
        $error_message = 'Invalid country. Please fill out shipping information.';
	} elseif ($custid === false) {		
        $error_message = 'Invalid login. Please fill out shipping information.';
    } else {
        $error_message = '';
    }

    // Check if there is an error. Print it and then stop
    // the Script.
/*
    if (!empty($error_message)) {
        echo "<br><br><p><h1 style='margin-left:50px; text-align: center'><a href=\"shipping.php\">$error_message </a></h1></p>";
        exit();
    }
*/
	
	//if checkbox is selected, set values of the form to the data sent from shipping.
	$same = $_POST['same'];

?>

<style>
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
    .click{
        margin-left: 70px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-4"><h1>Billing Address</h1></div>
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

                <div class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
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
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="summary.php" method="post">
                <div class="form-group">
                    <label for="address">Street Address</label>
					<!-- do some client-side validation of form data -->
                    <input required pattern="\W*\d+\W*\d* [0-9a-zA-Z. ]+" title="Use symbols, numbers or letters" type="text" class="form-control" id="address" name="billAddress" placeholder="Address" value="<?php if ($same) print $shipAddress; ?>"/>
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
                        <option value="MB" <?php if ($same) { if ($shipProvince == 'MB') { echo 'selected="selected"'; } } ?>"/>Manitoba</option>
                        <option value="NB" <?php if ($same) { if ($shipProvince == 'NB') { echo 'selected="selected"'; } } ?>"/>New Brunswick</option>
                        <option value="NL" <?php if ($same) { if ($shipProvince == 'NL') { echo 'selected="selected"'; } } ?>"/>Newfoundland and Labrador</option>
                        <option value="NS" <?php if ($same) { if ($shipProvince == 'NS') { echo 'selected="selected"'; } } ?>"/>Nova Scotia</option>
                        <option value="ON" <?php if ($same) { if ($shipProvince == 'ON') { echo 'selected="selected"'; } } ?>"/>Ontario</option>
                        <option value="PE" <?php if ($same) { if ($shipProvince == 'PE') { echo 'selected="selected"'; } } ?>"/>Prince Edward Island</option>
                        <option value="QC" <?php if ($same) { if ($shipProvince == 'QC') { echo 'selected="selected"'; } } ?>"/>Quebec</option>
                        <option value="SK" <?php if ($same) { if ($shipProvince == 'SK') { echo 'selected="selected"'; } } ?>"/>Saskatchewan</option>
                        <option value="NT" <?php if ($same) { if ($shipProvince == 'NT') { echo 'selected="selected"'; } } ?>"/>Northwest Territories</option>
                        <option value="NU" <?php if ($same) { if ($shipProvince == 'NU') { echo 'selected="selected"'; } } ?>"/>Nunavut</option>
                        <option value="YT" <?php if ($same) { if ($shipProvince == 'YT') { echo 'selected="selected"'; } } ?>"/>Yukon</option>
                    </select>
                </div>
				<div class="form-group">
                    <label for="postalcode">Postal Code</label>
					<!-- do some client-side validation of form data -->
                    <input required pattern="^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$" title="Must go letter # letter # letter #" type="text" class="form-control" id="postalcode" name="billPostal" placeholder="Postal Code" value="<?php if ($same) print $shipPostal; ?>"/>
                </div>
                <div class="form-group">
                    <label>Country</label><br>
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
                <button type="submit" class="btn btn-primary pull-right">Review Address Information</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div><br>
</div><br><br>

</body>
</html>