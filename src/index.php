<?php
	require_once 'view/header.html';
	require_once 'model/db_connect.php';
	require_once 'model/db_functions.php';

	$products = getAllProducts();

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
        <div class='panel panel-success'>
            <div class='panel-heading'>" . $prod['prod_name'] . "</div>
            <div class='panel-body'><img src='" . $prod['photo'] . "' class='img-responsive' style='width:300px;height:200px' alt='Image'></div>
            <div class='panel-footer'>" . $prod['unit_price'] . "</div>
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
