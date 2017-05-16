<?php
/**
 * This function generates the result set of
 * the products table.
 *
 * @return array $products - an assoc. array which contains all the products stored in the DB.
 */
function searchProduct()
{
    global $dbc;
    global $keyword;

	$query = 'SELECT prod_id, prod_name, photo FROM product WHERE prod_name LIKE :term'; // select query
	$statement = $dbc->prepare( $query );
	$statement->execute(array(':term'=>"%$keyword%"));
	$products = $statement->fetchAll();
	$statement->closeCursor();
	return $products;
}

/**
 * This function generates the result set of
 * the products table.
 *
 * @return array $products - an assoc. array which contains all the products stored in the DB.
 */
function getAllProducts() {
    global $dbc;

	$query = 'SELECT prod_id, prod_name, prod_desc, stock_amount, unit_price, photo FROM product';
	$statement = $dbc->prepare($query);
	$statement->execute();
	$products = $statement->fetchAll();
	$statement->closeCursor();
	return $products;
}


/**
  * This function generates the result set of
  * the products table with a prod_id as a parameter
  *
  * @return array $productInfo - Array which contains all info of the product
 */
function getProductInfo($prod_id) {
    global $dbc;

		$query = 'SELECT prod_id, prod_name, prod_desc, stock_amount, unit_price, photo FROM product WHERE prod_id = (:prod_id)';
		$statement = $dbc->prepare($query);
    $statement->bindValue(':prod_id', $prod_id);
		$statement->execute();
		$productInfo = $statement->fetchAll();
		$statement->closeCursor();
		return $productInfo;
}


/**
 * This function takes in a first and last name
 * and stores it in the database
 *
 * @param string $firstname - the firstName the user entered in the form.
 * @param string $lastname - the lastName the user enterd in the form.
 * @param string $email - the email the user enterd in the form.
 * @param string $password - the password the user enterd in the form.
 *
 * @return void
 */
function storeNewUsers($firstname, $lastname, $email, $password)
{
    global $dbc;

    $query = 'INSERT INTO customer (first_name, last_name, email, password)
        		VALUES (:firstname, :lastname, :email, :password)';
    $statement = $dbc->prepare($query);
    $statement->bindValue(':firstname', $firstname);
    $statement->bindValue(':lastname', $lastname);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
}

/**
 * This function checkes if the email and password exists
 *
 * @return array $products - an assoc. array which contains all the products stored in the DB.
 */
function checkUserExists($email, $password)
{
    global $dbc;

	$query = "SELECT cust_id, first_name ||' '|| last_name as cust_name
				FROM customer WHERE UPPER(email) = :email AND UPPER(password) = :password";
	$statement = $dbc->prepare( $query );
	$statement->execute(array(':email'=>$email, ':password'=>$password));
	$products = $statement->fetchAll();
	$statement->closeCursor();
	return $products;
}

/**
 * This function generates the result set of
 * the tblNames table.
 *
 * @return array $names - an assoc. array which contains all the names stored in the DB.
 */
/*
function getAllNames()
{
    global $dbc;

    $query = 'SELECT * from tblNames ORDER BY last_name';
    $statement = $dbc->prepare($query);
    $statement->execute();
    $names = $statement->fetchAll();
    $statement->closeCursor();
    return $names;

}
*/

/** 
 * This function takes in a address, city, province, and country
 * and stores it in the database
 *
 * @param string $address - the streetAddress the user entered in the form.
 * @param string $city - the city the user entered in the form.
 * @param string $province - the province the user entered in the form.
 * @param string $postalcode - the postal code the user entered in the form.
 * @param string $country - the country the user entered in the form.  
 *
 * @return void 
 */
function storeAddress($billAddress, $billCity, $billProvince, $billPostal, $billCountry)
{
    global $dbc;
    
    $query = 'INSERT INTO customer_order (bill_addr, bill_city, bill_pc, bill_prov_id, bill_pc, bill_country_id, ship_addr, ship_ciy, ship_pc, ship_prov_id, ship_country_id) 
        		VALUES (:billAddress, :billCity, :billPostal, :billProvince, :billCountry, :shipAddress, :shipCity, :shipPostal, :shipProvince, :shipCountry)';
    $statement = $dbc->prepare($query);
    $statement->bindValue(':address', $address);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':province', $province);
    $statement->bindValue(':postalcode', $postalcode);	
    $statement->bindValue(':country', $country);        
    $statement->execute();
    $statement->closeCursor();
}
?>