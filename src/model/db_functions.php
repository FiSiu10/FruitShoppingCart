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
function getAllProducts()
{
    global $dbc;

	$query = 'SELECT prod_id, prod_name, prod_desc, stock_amount, unit_price, photo FROM product';
	$statement = $dbc->prepare($query);
	$statement->execute();
	$products = $statement->fetchAll();
	$statement->closeCursor();
	return $products;
}

/** 
 * This function takes in a first, last name, email and password
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
?>
