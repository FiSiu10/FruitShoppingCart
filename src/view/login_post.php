<?php
	session_start();

	require_once '../model/db_connect.php';
	require_once '../model/db_functions.php';
	require_once 'common_functions.php';
  
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
        echo $error_message . '<p>Go <a href="login.php">back to the form</a></p>';
        exit();
    }

	$result = checkUserExists($email, $password);

	if($result == null) {
		$error_message = 'Invalid email or password. ';
		echo "<script>alert('" . $error_message . "');history.back();</script>";
        exit();		
	}

	$_SESSION["custid"] = $result['cust_id'];
	$_SESSION["custname"] = $result['cust_name'];

	header('Location: test_login.php');
	
	// to use
	//print_r($_SESSION);
	//print $_SESSION['custid'];
	//print $_SESSION['custname'];
?>