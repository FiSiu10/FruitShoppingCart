<?php
    require_once 'header.php';
    require_once '../model/db_connect.php';
    require_once '../model/db_functions.php';

	// Get Names from Form -- use server-side validation (the filter_input function)
	$custid = $_SESSION['custid'];
    
    // Get result of filter_input() and check for missing or invalid data
    if (!isset($custid)) {
        $error_message = 'Not logged in.';
	} elseif ($custid === false) {		
        $error_message = 'Invalid login.';
    } else {
        $error_message = '';
    }

    // Check if there is an error. Print it and then stop
    // the Script.
    if (!empty($error_message)) {
        echo $error_message . '<p>Go <a href="login.php">please login to proceed.</a></p>';
        exit();
    }
	
?>

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="billing.php" method="post">
                <h2>Shipping Address</h2><br>
                <div class="form-group">
                    <label for="firstname">First Name</label>
					<!-- do some client-side validation of form data -->
                    <input required pattern="^[A-Z][a-z]+$" title="Must start with a capital letter followed by one or more small letters" type="text" class="form-control" id="firstname" name="shipFirstName" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
					<!-- do some client-side validation of form data -->
                    <input required pattern="^[A-Z][a-z]+$" title="Must start with a capital letter followed by one or more small letters" type="text" class="form-control" id="lastname" name="shipLastName" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="address">Street Address:</label>
					<!-- do some client-side validation of form data -->
                    <input required pattern="\d+ [0-9a-zA-Z. ]+" title="Must start with a number and can be followed by a number or letters" type="text" class="form-control" id="address" name="shipAddress" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
					<!-- do some client-side validation of form data -->
                    <input required pattern="^[A-Z][a-z]+$" title="Must start with a capital letter followed by one or more small letters" type="text" class="form-control" id="city" name="shipCity" placeholder="City">
                </div>
                <div class="form-group">
                    <label>Province</label><br>
                    <select name="shipProvince">
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
                    <input required pattern="^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$" title="Must go letter # letter # letter #" type="text" class="form-control" id="postalcode" name="shipPostal" placeholder="Postal Code">
                </div>
                <div class="form-group">
                    <label>Country:</label><br>
                    <select name="shipCountry">
                        <option value="CA">Canada</option>
                    </select>
                </div>
                <br>
				<input type="hidden" name="custid" value="<?php print $custid; ?>"/>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div><br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="progress">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" area-valuemax="100" style="width:40%">
                    Shipping Information
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

</div><br><br>

</body>
</html>
