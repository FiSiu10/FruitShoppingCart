<?php
session_start();
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
require_once 'view/header.php';


$prod_id = filter_input(INPUT_GET,  'prod_id', FILTER_VALIDATE_INT);

$productInfo = getProductInfo($prod_id);

for ($i = 0; $i < count($productInfo); $i++){
  $prod = $productInfo[$i];

}
$productStock = $prod['stock_amount'];

?>

<div class="container">
  <div class="container-fluid">
    <?php
      echo
       "<div class='row'>
            <div class='col-sm-4'><img src='" . $prod['photo'] . "' width='350px' height='250px'></div>
            <div class='col-sm-6'><h2>" . $prod['prod_name'] . "</h2></div>
            <div class='col-sm-6'><h4>PRICE: $ " . " " . $prod['unit_price'] . " / Case of 12</h4></div>
            <div class='col-sm-6'><br></div>
            <div class='col-sm-6'><h5>Description: </div>
            <div class='col-sm-6'>" . $prod['prod_desc'] ."</div>
        </div>
        "
    ?>

    <div class="row">
        <div class="col-sm-4"></div>
        <div class='col-sm-4'></div>
        <div class="col-sm-4">
            <div class="dropdown">
              <form action="addToCart.php" method="post" >
                <h4>Quantity:
                  <input type="number" style="width:150px" min="1" max="<?php print $productStock; ?>"name="quantity" placeholder="Stock: <?php print $productStock; ?>" />
                  <input type="hidden" name="prod_id" value="<?php print $prod_id; ?>"/>
                  <input type="hidden" name="stock" value="<?php print $productStock; ?>">
                </h4>
            </div>
        </div>
    </div>
      <div class="row">
            <div class="col-sm-4"></div>
            <div class='col-sm-4'></div>
            <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-md">Add to Cart</button>
            </div>
            </form>
      </div>

  </div>
</div>
<br>
<br>


</body>

</html>