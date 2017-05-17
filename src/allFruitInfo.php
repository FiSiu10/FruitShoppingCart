<?php
session_start();
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
require_once 'view/header.html';


$prod_id = filter_input(INPUT_GET,  'prod_id', FILTER_VALIDATE_INT);

$productInfo = getProductInfo($prod_id);

for ($i = 0; $i < count($productInfo); $i++){
  $prod = $productInfo[$i];

}

?>

<div class="container">
  <div class="container-fluid">
    <?php
      echo
       "<div class='row'>
          <div class='col-sm-4'>" . $prod['prod_name'] . "</div>
          <div class='col-sm-8'>PRICE" . $prod['unit_price'] . "CAD</div>
        </div>

        <div class='row'>
          <div class='col-sm-4'><img src='" . $prod['photo'] . "' width='100px' height='100px'></div>
          <div class='col-sm-8'>" . $prod['prod_desc'] ."</div>
        </div>";
    ?>
    <div class="row">
              <div class="col-sm-4"></div>
              <div class="col-sm-8">Fruits are sold by the case.</div>
          </div>
    <br>

    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-5">
            <div class="dropdown">
              <form action="addToCart.php" method="post">
                  <input type="text" name="quantity" placeholder="quantity" />
                  <input type="hidden" name="prod_id" value="<?php print $prod_id; ?>"/>
            </div>
        </div>
        <div class="col-sm-3">
            <div>
                <a href = 'addToCart.php'><button type="submit" class="btn btn-primary btn-md">Add to Cart</button></a>
            </div>
        </div>
        </form>
    </div>


  </div>
</div>
<br>
<br>


</body>

</html>
