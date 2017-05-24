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

    if(!isset($firstname) || !isset($lastname) || !isset($email) || !isset($password)) exit;

    // Get result of filter_input() and check for invalid data
    if ($firstname === false) {
        $error_message = 'Invalid first name. ';
    } elseif ($lastname === false) {
        $error_message = 'Invalid last name. ';
    } else if ($email === false) {
        $error_message = 'Invalid email. ';
    } elseif ($password === false) {
        $error_message = 'Invalid password.';
    }

    // Check if there is an error. Print it and then stop the Script.
    if (!empty($error_message)) {
        echo "<script>alert('" . $error_message . "');history.back();</script>";
        exit();
    }

    if(empty(checkUserExists($email))) {
        storeNewUsers($firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT));
    } else {
        $error_message = 'Email address already registered.';
        echo "<script>alert('" . $error_message . "');history.back();</script>";
        exit();
    }
?>
<div class="container">
    <div class="jumbotron text-center">
        <h1>Thank you for joining us!</h1>
    </div>
    <hr class="style1">
    <div class="text-center">
        <a href="view/login.php" class="btn btn-info btn-lg" role="button">Continue to shopping</a>
    </div>
</div>

</body>
</html>