<?php
session_start();

require_once 'view/header.php';
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';

// Setup the error_message - empty string to start
$error_message = '';

// Get Email and password from Form -- use server-side validation (the filter_input function)
$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');

if(!isset($firstname) || !isset($lastname) || !isset($email)) exit;

// Get result of filter_input() and check for invalid data
if ($firstname === false) {
    $error_message = 'Invalid first name. ';
} elseif ($lastname === false) {
    $error_message = 'Invalid last name. ';
} else if ($email === false) {
    $error_message = 'Invalid email. ';
}

// Check if there is an error. Print it and then stop the Script.
if (!empty($error_message)) {
    echo "<script>alert('" . $error_message . "');history.back();</script>";
    exit();
}

$cust_id = $_SESSION['custid'];

updateCustomerInfo($firstname, $lastname, $email, $cust_id);

if (!empty($password)){
    updatePassword(password_hash($password, PASSWORD_DEFAULT), $cust_id);
}

$_SESSION['custname'] = $firstname . ' ' . $lastname;

?>
<div class="container">
    <div class="jumbotron text-center">
        <h1>Updated Your Information!</h1>
    </div>
    <hr class="style1">
    <div class="text-center">
        <a href="/index.php" class="btn btn-info btn-lg" role="button">Continue to shopping</a>
    </div>
</div>

</body>
</html>