<?php
require_once 'header.php';
require_once '../model/db_connect.php';
require_once '../model/db_functions.php';
session_start();

for ($i = 0; $i < count($_SESSION['itemQty']); $i++) {
    $productInfo = getCartInfo($_SESSION['prod_id'][$i]);
}


for ($i = 0; $i < count($productInfo); $i++) {
    $prod = $productInfo[$i];
}

//Calculate item total

//Calculate cart subtotal
echo "
    <div class='container'>
        <h2>Shopping Cart</h2>
        <table class='table table-striped'>
            <thead>
            <tr>
                <th><h4>Product</h4></th>
                <th><h4>Quantity</h4></th>
                <th><h4>Price</h4></th>
                <th><h4>Total</h4></th>
            </tr>
            </thead>
           ";

for ($i = 0; $i < count($_SESSION['itemQty']); $i++) {
    echo "
                <tbody>
                <tr><td><h5>" . $prod['prod_name'] . "</h5>
                    </td>
                    <td><h5>" . $_SESSION['itemQty'][$i] . "</h5>
                    </td>
                    <td><h5>" . $prod['unit_price'] . "</h5>
                    </td>
                    <td>
                        <h5>$$$$$</h5>
                    </td>
                    <td>
                        <button type='button' class='btn btn-danger btn-sm'>
                            <span class='glyphicon glyphicon-remove'></span>  Remove</button>
                    </td>
                </tr>
                </tbody>
                ";
}
echo "
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><h5>Subtotal</h5></td>
                    <td><h5>$$$$</h5></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><h5>Shipping</h5></td>
                    <td><h5>$10.00</h5></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><h5>Total</h5></td>
                    <td><h5>$$$$</h5></td>
                </tr>
                <tr>
                    <td>
                        <button type='button' class='btn btn-primary btn-md'><span class='glyphicon glyphicon-chevron-left'></span>  Continue Shopping</button>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button type='button' class='btn btn-primary btn-md'>Purchase <span class='glyphicon glyphicon-chevron-right'></span></button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>";
?>

</body>

</html>