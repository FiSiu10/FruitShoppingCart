<?php
	require_once '../model/db_connect.php';
	require_once '../model/db_functions.php';
	require_once 'common_functions.php';
  
  if (empty($_POST['email']) || empty($_POST['password']))
  {
    print "invalid arguments";
    return;
  }
  
  $email = clean($_POST['email']);
  $password = clean($_POST['password']);
  $email = strtoupper($email);
  $password = strtoupper($password);
  
  $result = checkUserExists($email, $password);
  
  session_start();
  setcookie(session_name(), session_id());
  //ini_set("session.gc_maxlifetime", "18000");
  if (!isset($_SESSION['cust_id']))
  {
    $_SESSION['cust_id'] = $result[0];
    $_SESSION['cust_name'] = $result[1];
  } 
  redirect("../index.php");
?>          