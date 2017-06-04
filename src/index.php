<?php
require_once 'view/header.php';
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
?>

<style>
    .welcome{
        text-align: center;
    }

    .panel-default > .panel-heading{
        background-color: lightgrey;
        text-align: center;
        font-size: 20px;
        color: #222222;
    }
    .panel-default{
        font-family: Verdana, sans-serif;
        text-align: center;
        font-size: 18px;
        color: lightgray;
        border-color: darkgray;
        font-weight: bold;

    }

    .panel-default > .panel-footer{
        background-color: lightgrey;
        color: #b12704;
    }

    h1, h3 {
        font-family: 'Francois One', sans-serif;
    }

    .price{
        font-family: Arial;
        font-weight: bold;
    }

    .sort{
        text-align: right;
        margin-right: 150px;
        font-weight: bold;
        font-size: 18px;
    }


</style>

<div class="welcome">
    <h1>$10.00 Flat Shipping Rate</h1>
    <h3>View Our Full Inventory Below<br></h3>
    <h1></h1>
</div>
<br><br><br>

<div class="sort" style="margin-left:150px">
	<form name="sort" method="get"> Sort by:
  	<select name="sort" onclick="this.form.submit">
      <option value="">--Select--</option>
			<option value="prod_id">Product ID</option>
      <option value="prod_name_ASC">Product Name (A-Z)</option>
      <option value="prod_name_DSC">Product Name (Z-A)</option>
      <option value="unit_price_ASC">Price: Low-High</option>
      <option value="unit_price_DSC">Price: High-Low</option>
  	</select>
    <input type="submit" value="Sort"/>
  </form>
</div>
<br>
<?php
  if (!empty($_GET['sort']) && $_GET['sort'] == 'prod_id'){
    $orderby_query = 'ORDER BY prod_id';
  } else if (!empty($_GET['sort']) && $_GET['sort'] == 'prod_name_ASC') {
    $orderby_query = 'ORDER BY prod_name ASC';
  } else if (!empty($_GET['sort']) && $_GET['sort'] == 'prod_name_DSC'){
    $orderby_query = 'ORDER BY prod_name DESC';
  } else if (!empty($_GET['sort']) && $_GET['sort'] == 'unit_price_ASC'){
    $orderby_query = 'ORDER BY convert(unit_price, decimal)';
  } else if (!empty($_GET['sort']) && $_GET['sort'] == 'unit_price_DSC'){
    $orderby_query = 'ORDER BY convert(unit_price, decimal) DESC';
  }

	$products = getAllProducts($orderby_query);

	$end = 2;
	for($i = 0; $i < count($products); $i++) {
		$prod = $products[$i];

		if($i % 3 == 0) {
?>

<div class="container">
    <div class="row">
<?php
		}
    echo "<div class='col-sm-4'>
		<a href='allFruitInfo.php?prod_id=" . $prod['prod_id'] . "'>
        <div class='panel panel-default'>
            <div class='panel-heading'>" . $prod['prod_name'] . "</div>
            <div class='panel-body'><img src='" . $prod['photo'] . "' class='img-responsive center-block' style='width:300px;height:200px' alt='Image'></div>
            <div class='panel-footer price'>" . "CAD $" . $prod['unit_price'] . "</div>
        </div>
    </div></a>";
		if($end == $i) {
?>
    </div>
</div><br>
<?php
			$end = $end + 3;
		}
	}
?>

<br>
</body>
</html>