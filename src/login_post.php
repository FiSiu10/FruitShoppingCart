<?php
	session_start();

	require_once 'model/db_connect.php';
	require_once 'model/db_functions.php';
  
    // Setup the error_message - empty string to start
    $error_message = '';

    // Get Email and password from Form -- use server-side validation (the filter_input function)
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');

	if(!isset($email) || !isset($password)) exit; 

    // Get result of filter_input() and check for invalid data
    if ($email === false) {
        $error_message = 'Invalid email. ';
    } elseif ($password === false) {
        $error_message = 'Invalid password.';
    }	

    // Check if there is an error. Print it and then stop the Script.
	if (!empty($error_message)) {
        echo "<script>alert('" . $error_message . "');history.back();</script>";
        exit();
    }

	$_user = checkUserExists($email);

    //$success = ($result) ? 'True': 'False';

	if(!password_verify($password, $_user['password'])) {
		$error_message = 'Invalid email or password. ';
		echo "<script>alert('" . $error_message . "');history.back();</script>";
        exit();		
	}

	$_SESSION["custid"] = $_user['cust_id'];
	$_SESSION["custname"] = $_user['cust_name'];

	header('Location: /index.php');
?>