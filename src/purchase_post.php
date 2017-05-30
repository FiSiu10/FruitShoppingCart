<?php
    session_start();

    require_once 'model/db_connect.php';
    require_once 'model/db_functions.php';

    // Setup the error_message - empty string to start
    $error_message = '';

    $bill_addr = filter_input(INPUT_POST, 'bill_addr');
    $bill_city = filter_input(INPUT_POST, 'bill_city');
    $bill_pc = filter_input(INPUT_POST, 'bill_pc');
    $bill_prov = filter_input(INPUT_POST, 'bill_prov');
    $bill_country = filter_input(INPUT_POST, 'bill_country');
    $ship_first_name = filter_input(INPUT_POST, 'ship_first_name');
    $ship_last_name = filter_input(INPUT_POST, 'ship_last_name');
    $ship_addr = filter_input(INPUT_POST, 'ship_addr');
    $ship_city = filter_input(INPUT_POST, 'ship_city');
    $ship_pc = filter_input(INPUT_POST, 'ship_pc');
    $ship_prov = filter_input(INPUT_POST, 'ship_prov');
    $ship_country = filter_input(INPUT_POST, 'ship_country');

    $custid = $_SESSION['custid'];

//    print $bill_addr;
//    print "<br>" . $bill_city;
//    print "<br>" . $bill_pc;
//    print "<br>" . $bill_prov;
//    print "<br>" . $bill_country;
//    print "<br>" . $ship_first_name;
//    print "<br>" . $ship_last_name;
//    print "<br>" . $ship_addr;
//    print "<br>" . $ship_city;
//    print "<br>" . $ship_pc;
//    print "<br>" . $ship_prov;
//    print "<br>" . $ship_country;
//    print "<br>custid=" . $custid . "<br>";


/*
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
*/
//if(empty(checkUserExists($email))) {
    $orderId = storeCustomerOrder($bill_addr,$bill_city,$bill_pc,$bill_prov,$bill_country,$custid);

    updateCustomerOrder($ship_first_name,$ship_last_name,$ship_addr,$ship_city,$ship_pc,$ship_prov,$ship_country,$orderId);

    for ($i = 0; $i < count($_SESSION['prod_id']); $i++){
        storeOrderProduct($orderId,$_SESSION['prod_id'][$i],$_SESSION['itemQty'][$i]);
    }

    unset($_SESSION['itemQty']);
    unset($_SESSION['prod_id']);

    header('Location: view/purchaseComplete.php');

//} else {
/*    $error_message = 'Email address already registered.';
    echo "<script>alert('" . $error_message . "');history.back();</script>";
    exit();
} */
?>