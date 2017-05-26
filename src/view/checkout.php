<?php
require_once('../config.php');
session_start(); 
require_once '../model/db_connect.php';
require_once '../model/db_functions.php';
//to do: grab and validate the total amount; will need to be passed from shopping cart form button
//$total = 0.70

$prod = array();

for ($i = 0; $i < count($_SESSION['itemQty']); $i++) {
    $productInfo = getCartInfo($_SESSION['prod_id'][$i]);
    for ($j = 0; $j < count($productInfo); $j++) {
        $prod[$i] = $productInfo[$j];
    }
    $total[$i] = (int) $_SESSION['itemQty'][$i] * $prod[$i]['unit_price'];
    $subtotal += $total[$i];
    $grandTotal = $subtotal + 10;
}

?>
<h4>Please click the button below to pay for your order:</h4>
<form action="../charge.php" method="post">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="<?php echo $stripe['publishable_key']; ?>"
          data-description="Payment Checkout"
          data-amount="<?php echo $grandTotal * 100; ?>"
          data-locale="auto"
		  data-currency="cad"></script>
		 <input type="hidden" name="amount" value="<?php echo $grandTotal * 100; ?>" />
</form>