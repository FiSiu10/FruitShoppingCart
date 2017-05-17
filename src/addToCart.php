<?php
session_start();
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
$prod_id = filter_input(INPUT_POST, 'prod_id', FILTER_VALIDATE_INT);

if (empty($_SESSION['itemQty'])) {
  $_SESSION['itemQty'] = array();
}

if (empty($_SESSION['prod_id'])){
  $_SESSION['prod_id'] = array();
}

array_push($_SESSION['itemQty'], $quantity);
array_push($_SESSION['prod_id'], $prod_id);
header('Location: shoppingcart.php');

/*for ($i = 0; $i < count($_SESSION['itemQty']); $i++){
  echo "<p> Item quantity:" . $_SESSION['itemQty'][$i] . "
   Product ID: " . $_SESSION['prod_id'][$i] ."</p>";
}
echo "<a href = 'index.php'>Home</a>";*/
?>
