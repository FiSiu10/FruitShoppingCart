<?php
	require_once '../model/db_connect.php';
	require_once '../model/db_functions.php';

	$keyword = trim($_REQUEST['term']); // this is user input
	$sugg_json = array();    // this is for displaying json data as a autosearch suggestion
	$json_row = array();     // this is for stroring mysql results in json string
	$keyword = preg_replace('/\s+/', ' ', $keyword); // it will replace multiple spaces from the input.
  
 	$products = searchProduct();
 
	if ( $products ) {
		foreach($products as $recResult) {
			$json_row["id"] = $recResult['prod_id'];
			$json_row["value"] = $recResult['prod_name'];
			$json_row["label"] = $recResult['prod_name'];
   		array_push($sugg_json, $json_row);
		}
	} else {
		$json_row["id"] = "#";
		$json_row["value"] = "";
		$json_row["label"] = "Nothing Found!";
 		array_push($sugg_json, $json_row);
	} 
 
	$jsonOutput = json_encode($sugg_json, JSON_UNESCAPED_SLASHES); 
	print $jsonOutput;
?>