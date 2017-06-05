<?php
	session_start();
    require_once 'view/header.php';
    require_once 'model/db_connect.php';
    require_once 'model/db_functions.php';

	// Get Names from Form -- use server-side validation (the filter_input function)
	$custid = $_SESSION['custid'];
    
    // Get result of filter_input() and check for missing or invalid data
    if (!isset($custid)) {
        $error_message = 'PLEASE LOGIN BEFORE PROCEEDING';
	} elseif ($custid === false) {		
        $error_message = 'Invalid login.';
    } else {
        $error_message = '';
    }

    // Check if there is an error. Print it and then stop
    // the Script.
    if (!empty($error_message)) {
        echo "<br><br><p><h1 style='margin-left:50px; text-align: center'><a href=\"view/login.php\">$error_message </a></h1></p>";
        exit();
    }

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

    .button{
        margin-left: 150px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-4"><h1>Shipping Address</h1></div>
        <br>
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
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="billing.php" method="post">
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
                    <label for="address">Street Address</label>
					<!-- do some client-side validation of form data -->
                    <input required pattern="\W*\d+\W*\d* [0-9a-zA-Z. ]+" title="Use symbls, numbers, or letters" type="text" class="form-control" id="address" name="shipAddress" placeholder="Address">
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
                    <label>Country</label><br>
                    <select name="shipCountry">
                        <option value="CA">Canada</option>
                    </select>
                </div>
				<input type="checkbox" name="same" value="same">  Billing address is the same
				<br><br>
				<input type="hidden" name="custid" value="<?php print $custid; ?>"/>
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div><br>
</div><br><br>

</body>
</html>
