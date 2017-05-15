<?php
	require_once 'view/allproducts_header.html';
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
    <a href = "view/fruitpage.html">
<?php
		}
	    	
    echo "<div class='col-sm-4'>
        <div class='panel panel-success'>
            <div class='panel-heading'>" . $prod['prod_name'] . "</div>
            <div class='panel-body'><img src='" . $prod['photo'] . "' class='img-responsive' style='width:300px; height:200px' alt='Image'></div>
            <div class='panel-footer'>" . $prod['unit_price'] . "</div>
        </div>
    </div>";
        
		if($end == $i) {
?>	    
</a>    
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