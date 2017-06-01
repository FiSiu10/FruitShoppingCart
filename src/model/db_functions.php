<?php

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
function updatePassword($password, $cust_id)
{
    global $dbc;

    $query = 'UPDATE customer SET 
                password = :password
              WHERE cust_id = :cust_id';

    $statement = $dbc->prepare($query);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':cust_id', $cust_id);
    $statement->execute();
    $statement->closeCursor();
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
function updateCustomerInfo($first_name, $last_name, $email, $cust_id)
{
    global $dbc;

    $query = 'UPDATE customer SET 
                first_name = :first_name,
                last_name = :last_name,
                email = :email
              WHERE cust_id = :cust_id';

    $statement = $dbc->prepare($query);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':cust_id', $cust_id);
    $statement->execute();
    $statement->closeCursor();
}

/**
 * This function generates the result set of
 * the products table.
 *
 * @return array $products - an assoc. array which contains all the products stored in the DB.
 */
function getUserInfo($cust_id) {
    global $dbc;

    $query = 'SELECT first_name, last_name, email, password FROM customer WHERE cust_id = :cust_id';
    $statement = $dbc->prepare($query);
    $statement->bindValue(':cust_id', $cust_id);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user;
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
function storeOrderProduct($order_id,$prod_id,$qty)
{
    global $dbc;

    $query = 'INSERT INTO order_product (order_id, prod_id, qty)
                VALUES (:orderid, :prodid, :qty)';

    $statement = $dbc->prepare($query);
    $statement->bindValue(':orderid', $order_id);
    $statement->bindValue(':prodid', $prod_id);
    $statement->bindValue(':qty', $qty);
    $statement->execute();
    $statement->closeCursor();
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
function storeCustomerOrder($bill_addr,$bill_city,$bill_pc,$bill_prov,$bill_country,$cust_id)
{
    global $dbc;

    $query = 'INSERT INTO customer_order (bill_addr,bill_city,bill_pc,bill_prov,bill_country,cust_id)
                VALUES (:bill_addr, :bill_city, :bill_pc, :bill_prov, :bill_country, :cust_id)';

    $statement = $dbc->prepare($query);
    $statement->bindValue(':bill_addr', $bill_addr);
    $statement->bindValue(':bill_city', $bill_city);
    $statement->bindValue(':bill_pc', $bill_pc);
    $statement->bindValue(':bill_prov', $bill_prov);
    $statement->bindValue(':bill_country', $bill_country);
    $statement->bindValue(':cust_id', $cust_id);
    $statement->execute();
    $order_id = $dbc->lastInsertId();
    $statement->closeCursor();

    return $order_id;
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
function updateCustomerOrder($ship_first_name,$ship_last_name,$ship_addr,$ship_city,$ship_pc,$ship_prov,$ship_country,$order_id)
{
    global $dbc;

    $query = 'UPDATE customer_order SET 
                ship_first_name = :ship_first_name,
                ship_last_name = :ship_last_name,
                ship_addr = :ship_addr,
                ship_city = :ship_city,
                ship_pc = :ship_pc,
                ship_prov = :ship_prov,
                ship_country = :ship_country
              WHERE order_id = :order_id';

    $statement = $dbc->prepare($query);
    $statement->bindValue(':ship_first_name', $ship_first_name);
    $statement->bindValue(':ship_last_name', $ship_last_name);
    $statement->bindValue(':ship_addr', $ship_addr);
    $statement->bindValue(':ship_city', $ship_city);
    $statement->bindValue(':ship_pc', $ship_pc);
    $statement->bindValue(':ship_prov', $ship_prov);
    $statement->bindValue(':ship_country', $ship_country);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $statement->closeCursor();
}

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
function getAllProducts($orderby) {
    global $dbc;

	$query = 'SELECT prod_id, prod_name, prod_desc, stock_amount, unit_price, photo FROM product' . ' ' . $orderby;
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

function getCartInfo($prod_id) {
    global $dbc;

		$query = 'SELECT prod_name, unit_price, prod_id FROM product WHERE prod_id = (:prod_id)';
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
 * This function checkes if the email and password exists in order to ensure for logging on
 *
 * @return array $products - an assoc. array which contains all the products stored in the DB.
 */
function checkUserExists($email)
{
    global $dbc;

	$query = "SELECT cust_id, CONCAT(first_name,' ',last_name) AS cust_name, password
				FROM customer WHERE UPPER(email) = UPPER(:email)";
	$statement = $dbc->prepare( $query );
    $statement->execute(array(':email'=>$email));
    $user = $statement->fetch();
	$statement->closeCursor();
	return $user;
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
 /*
function storeAddress($billAddress, $billCity, $billProvince, $billPostal, $billCountry)
{
    global $dbc;

    $query = 'INSERT INTO customer_order (bill_addr, bill_city, bill_pc, bill_prov_id, bill_pc, bill_country_id, ship_addr, ship_city, ship_pc, ship_prov_id, ship_country_id)
        		VALUES (:billAddress, :billCity, :billPostal, :billProvince, :billCountry, :shipAddress, :shipCity, :shipPostal, :shipProvince, :shipCountry)';
    $statement = $dbc->prepare($query);
    $statement->bindValue(':billAddress', $billAddress);
    $statement->bindValue(':billCity', $billCity);
    $statement->bindValue(':province', $province);
    $statement->bindValue(':billPostal', $billPostal);
    $statement->bindValue(':country', $country);
    $statement->execute();
    $statement->closeCursor();
}*/
?>