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
//header('Location: /view/shoppingcart.php');

if (!empty($error_message)) {
  echo $error_message;
} else if ($quantity > $stock){
  echo $error_message;
} else {
  array_push($_SESSION['itemQty'], $quantity);
  array_push($_SESSION['prod_id'], $prod_id);
  for ($i = 0; $i < count($_SESSION['itemQty']); $i++){
    echo "<p> Item quantity:" . $_SESSION['itemQty'][$i] . "
     Product ID: " . $_SESSION['prod_id'][$i] ."</p>";
  }
  echo "<a href = 'index.php'>Home</a>";
}
?>
