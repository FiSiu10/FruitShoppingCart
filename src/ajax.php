<?php
session_start();

//$action = filter_input(INPUT_GET, 'action', FILTER_VALIDATE_INT);
$action = $_GET['action']; //the action from the URL

switch($action) {

case "remove":
//$prod_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
//$prod_id = filter_input(INPUT_GET, 'prod_id', FILTER_VALIDATE_INT);
$prod_id = intval( $_GET["id"] );
			
	//print_r $_SESSION['prod_id'][0];
	//print $_SESSION['itemQty'];
	
	/*
	for ($i = 0; $i <= count($_SESSION['itemQty']); $i++){
      if ($prod_id == $_SESSION['prod_id'][$i]){
        //$_SESSION['itemQty'][$i] += $quantity;
		unset($_SESSION['prod_id'][$i]);
		//unset($_SESSION['itemQty'];
		unset($_SESSION['itemQty'][$i]);
		//unset($_SESSION['prod_id']);
		//unset($_SESSION['itemQty']);
		break;
      }
    }*/
	
	
	
	for ($i = 0; $i < count($_SESSION['prod_id']); $i++){
      if ($prod_id == $_SESSION['prod_id'][$i]){
		  echo 'if is true';
        //$_SESSION['itemQty'][$i] += $quantity;
		unset($_SESSION['prod_id'][$i]);
		//unset($_SESSION['itemQty'];
		unset($_SESSION['itemQty'][$i]);
		$_SESSION['itemQty'] = array_values($_SESSION['itemQty']);
		$_SESSION['prod_id'] = array_values($_SESSION['prod_id']);
		//unset($_SESSION['prod_id']);
		//unset($_SESSION['itemQty']);
		break;
      }
    }
  
	
	
	/*
  if (in_array($prod_id, $_SESSION['prod_id'])){
    for ($i = 0; $i <= count($_SESSION['prod_id']); $i++){
      if ($prod_id == $_SESSION['prod_id'][$i]){
        //$_SESSION['itemQty'][$i] += $quantity;
		
		//unset($_SESSION['prod_id'][$i]);
		//unset($_SESSION['itemQty'][$i]);
		unset($_SESSION['prod_id']);
		unset($_SESSION['itemQty']);
		break;
      }
    }
  } */
  
case "empty":
//$prod_id = filter_input(INPUT_GET, 'prod_id', FILTER_VALIDATE_INT);


//for ($i = 0; $i < count($_SESSION['itemQty']); $i++) {
//    $productInfo = getCartInfo($_SESSION['prod_id'][$i]);
//    for ($j = 0; $j < count($productInfo); $j++) {
//        $prod[$i] = $productInfo[$j];
//    }
//}



    for ($i = 0; $i <= count($_SESSION['prod_id']); $i++){
        //$_SESSION['itemQty'][$i] += $quantity;
		unset($_SESSION['prod_id'][$i]);
		unset($_SESSION['itemQty'][$i]);
		//unset($_SESSION['prod_id']);
		//unset($_SESSION['itemQty']);
				$_SESSION['itemQty'] = array_values($_SESSION['itemQty']);
		$_SESSION['prod_id'] = array_values($_SESSION['prod_id']);
		break;
    }
break;
  //header('Location: /view/shoppingcart.php');

}
?>