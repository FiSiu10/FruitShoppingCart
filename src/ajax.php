<?php
session_start();

$action = $_GET['action']; //the action from the URL

switch($action) {

	case "remove":
		$prod_id = intval( $_GET["id"] );
			
			for ($i = 0; $i < count($_SESSION['prod_id']); $i++){
				if ($prod_id == $_SESSION['prod_id'][$i]){
					unset($_SESSION['prod_id'][$i]);
					unset($_SESSION['itemQty'][$i]);
					$_SESSION['itemQty'] = array_values(array_filter($_SESSION['itemQty']));
					$_SESSION['prod_id'] = array_values(array_filter($_SESSION['prod_id']));
					break;
				}
			}  
	
break;	
	  
	case "empty":
  
		unset($_SESSION['prod_id']);
		unset($_SESSION['itemQty']);
  
break;

}
?>