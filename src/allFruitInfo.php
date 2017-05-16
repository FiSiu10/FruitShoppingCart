<?php
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
        <div class="col-sm-5">
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Quantity
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu"><?php for ($i = 1; $i <= 10; $i++) {
                  echo "
                  <li><a href='#'>" . $i . "</a>
                  </li>
                  ";
                } ?>
                </ul>
            </div>
        </div>
        <div class="col-sm-3">
            <div>
                <button type="button" class="btn btn-primary btn-md">Add to Cart</button>
            </div>
        </div>
    </div>


  </div>
</div>
<br>
<br>


</body>

</html>
