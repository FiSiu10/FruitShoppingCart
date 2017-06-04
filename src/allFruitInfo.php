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
<style>
    .btn{
        margin-right: 90px;
    }
    .product{
        margin-top: 20px;
    }
    .price{
        color: #b12704;
        font-size: 22px;
    }
	
	/* Desktops and laptops ----------- */
@media only screen  and (min-width: 950px) and (max-width : 1224px) {
	.product {
		margin-right: 110px;
	}
	.description {
		margin-left: 10px;
	}
}

	/* Laptops ----------- */
@media only screen  and  (min-width: 800px) and (max-width : 949px) {
	.product {
		margin-right: 110px;
	}
	.description {
		margin-left: 10px;
		width: 200px;
	}
}

	/* Laptops and tablets ----------- */
@media only screen  and  (max-width : 799px) {
	.product {
		margin-right: 110px;
	}
	.description {
		margin-left: 10px;
		width: 180px;
	}
}

</style>
<div class="container">
  <div class="container-fluid">
    <?php
      echo
       "<div class='row'>
            <div class='col-sm-4 product'><img src='" . $prod['photo'] . "' width='350px' height='250px'></div>
            <div class='col-sm-6 description'><h1>" . $prod['prod_name'] . "</h1></div>
            <div class='col-sm-6'><hr></div>
            <div class='col-sm-6 description'><h4>" . $prod['prod_desc'] ."</h4></div>
        </div>
        "
    ?>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4"></div>
        <div class="col-sm-4 price"><?php echo "Price: $" . $prod['unit_price'] . " " ?></div>
    </div>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="dropdown">
              <form action="addToCart.php" method="post" >
                <h3>Quantity:
                  <input type="number" style="width:150px" min="1" max="<?php print $productStock; ?>"name="quantity" placeholder="Stock: <?php print $productStock; ?>" />
                  <input type="hidden" name="prod_id" value="<?php print $prod_id; ?>"/>
                  <input type="hidden" name="stock" value="<?php print $productStock; ?>">
                </h3>
            </div>
        </div>
    </div>
      <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                    <br><button type="submit" class="btn btn-primary btn-md pull-right">Add to Cart</button>
            </div>
            <div class="col-sm-4"></div>
            </form>
      </div>

  </div>
</div>
<br>
<br>


</body>

</html>