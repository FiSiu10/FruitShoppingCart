<?php
require_once 'header.php';
require_once '../model/db_connect.php';
require_once '../model/db_functions.php';
session_start();
$prod = array();

for ($i = 0; $i < count($_SESSION['itemQty']); $i++) {
    $productInfo = getCartInfo($_SESSION['prod_id'][$i]);
    for ($j = 0; $j < count($productInfo); $j++) {
        $prod[$i] = $productInfo[$j];
    }

    //Calculate item total
    for ($k = 0; $k < count($_SESSION['itemQty']); $k++) {
        $total = (int) $_SESSION['itemQty'][$k] * (int) $prod['unit_price'];
        $subtotal = $total + $total;
    }

    $grandtotal = $subtotal + 10;
}

//for ($c = 0; $c < count($_SESSION['itemQty']); $c++){
//    echo "<p> Item quantity:" . $_SESSION['itemQty'][$c] . "
//   Product ID: " . $_SESSION['prod_id'][$c] ."</p>";
//}


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
//print count($_SESSION['itemQty']);
for ($m = 0; $m < count($_SESSION['itemQty']); $m++) {
//print $prod['prod_name'];
//print "<br>";

    echo "
                <tbody>
                <tr><td><h5>" . $prod[$m]['prod_name'] . "</h5>
                    </td>
                    <td><h5>" . $_SESSION['itemQty'][$m] . "</h5>
                    </td>
                    <td><h5>" . $prod[$m]['unit_price'] . "</h5>
                    </td>
                    <td>
                        <h5>$total</h5>
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
                    <td><h5>$subtotal</h5></td>
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
                    <td><h5>$grandtotal</h5></td>
                </tr>
                <tr>
                    <td>
                        <button type='button' class='btn btn-default btn-md'><a href='../index.php'><span class='glyphicon glyphicon-chevron-left'></span>  Continue Shopping</button>
                        </a>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button type='button' class='btn btn-default btn-md'><a href='login.php'>Purchase <span class='glyphicon glyphicon-chevron-right'></span></button></a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>";
?>

</body>

</html>