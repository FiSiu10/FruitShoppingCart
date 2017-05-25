<?php
session_start();
$qty = filter_input(INPUT_POST, 'qty', FILTER_VALIDATE_INT);
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
//$stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);

if (empty($_SESSION['itemQty'])) {
    $_SESSION['itemQty'] = array();
}

if (!isset($qty)) {
    $error_message = 'We have an error';
}

if (empty($_SESSION['prod_id'])){
    $_SESSION['prod_id'] = array();
}

/*
if (isset($qty)){
    $index = array_search(id, $_SESSION['prod_id']);

    $_SESSION['itemQty'][$index] = $qty;

    unset($_SESSION['itemQty'][$index]);
    //unset($_SESSION['prod_id'][$index]);

    $_SESSION['itemQty'][$index]=array(
        'quantity'=>$qty
    );
}
*/

if (!empty($error_message)) {
    echo $error_message;
} else if ($quantity > $stock){
    echo $error_message;
} else {
    if (in_array($id, $_SESSION['prod_id'])){
        for ($i = 0; $i <= count($_SESSION['prod_id']); $i++){
            if ($id == $_SESSION['prod_id'][$i]){
                $_SESSION['itemQty'][$i] = $qty;
            }
        }
    } else {
        array_push($_SESSION['itemQty'], $qty);
        array_push($_SESSION['prod_id'], $id);
    }
    header('Location: shoppingcart.php');
}
?>
