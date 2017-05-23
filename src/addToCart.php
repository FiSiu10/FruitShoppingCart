<?php
session_start();
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
$prod_id = filter_input(INPUT_POST, 'prod_id', FILTER_VALIDATE_INT);
$stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);

if (empty($_SESSION['itemQty'])) {
  $_SESSION['itemQty'] = array();
}

if (!isset($quantity)) {
    $error_message = 'We have an error';
}

if (empty($_SESSION['prod_id'])){
  $_SESSION['prod_id'] = array();
}

if (!empty($error_message)) {
  echo $error_message;
} else if ($quantity > $stock){
  echo $error_message;
} else {
  if (in_array($prod_id, $_SESSION['prod_id'])){
    for ($i = 0; $i <= count($_SESSION['prod_id']); $i++){
      if ($prod_id == $_SESSION['prod_id'][$i]){
        $_SESSION['itemQty'][$i] += $quantity;
      }
    }
  } else {
    array_push($_SESSION['itemQty'], $quantity);
    array_push($_SESSION['prod_id'], $prod_id);
  }
  header('Location: /view/shoppingcart.php');
}
?>
