<?php
    session_start();
    
    require 'view/header.php';
    require_once 'model/db_connect.php';
    require_once 'model/db_functions.php';

    // Get Names from Form -- use server-side validation (the filter_input function)
	$streetAddress = filter_input(INPUT_POST, 'shipAddress', FILTER_SANITIZE_SPECIAL_CHARS);
	$city = filter_input(INPUT_POST, 'shipCity', FILTER_SANITIZE_SPECIAL_CHARS);
	$province = filter_input(INPUT_POST, 'shipProvince', FILTER_SANITIZE_SPECIAL_CHARS);
	$postalcode = filter_input(INPUT_POST, 'shipPostal', FILTER_SANITIZE_SPECIAL_CHARS);
	$country = filter_input(INPUT_POST, 'shipCountry', FILTER_SANITIZE_SPECIAL_CHARS);
    
    // Get result of filter_input() and check for missing or invalid data
    if (!isset($shipAddress)) {
        $error_message = 'Missing address.';
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
        echo $error_message . '<p>Go <a href="shipping.html">back to the form</a></p>';
        exit();
    }

    // Has the user already entered the same name this session?
    //$duplicateName = false;
    // Has the $_SESSION var already been set?
    //if (isset($_SESSION['names'])) {
        // names is an array. Loop through it and see if there is a match
       // foreach($_SESSION['names'] as $name) {
       //     if ($fullName == $name) {
      //         $duplicateName = true;
                // found a match, no need to keep looping
        //        break;
      //      }
    //    }
   // } else {
        // $_SESSION is an associative array. At key => names, will be a regular array
   //     $_SESSION['names'] = array();
  //  }
      
    // Store Name in DB as long as it isn't a duplicate
    //if (!$duplicateName) {
    //    storeName($firstName, $lastName);
        
        // add this name to the $_SESSION 'names' array 
    //    $_SESSION['names'][] = $fullName; // add name to end of names array
   // }
   
   // Store shipping address in database
   
    
    // Get Names from DB
   // $names = getAllNames();
?>
    <h4>The Name you entered in the Form was:</h4>
     <!-- Note: Don't need htmlspecialchars() function here since
        these vars were already sanitized above -->
    <h4 class="name"><?php echo $fullName; ?></h4>
    <?php if ($duplicateName) { echo "<p>You already entered this name so it won't be stored in the DB.</p>"; } ?>
    <table class="table table-bordered table-striped" id="names">
        <caption>Names Stored in DB</caption>
        <thead>
            <tr>
                <th scope="col">Last Name</th>
                <th scope="col">First Name</th>
            </tr>
        </thead>
        <tbody>
            <!-- use foreach loop to fetch contents of each row -->
            <?php foreach ($names as $name) { ?>
            <tr>
                <td><?php echo $name['last_name']; ?></td>
                <td><?php echo $name['first_name']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <p><a href="index.php">Back to the Form</a></p>
    <!-- include the footer. -->
<?php require 'view/footer.php'; ?>