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
    $total[$i] = (int) $_SESSION['itemQty'][$i] * $prod[$i]['unit_price'];
    $subtotal += $total[$i];
    $grandTotal = $subtotal + 10;
}

function remove()
{
    unset($_SESSION["itemQty"]);
    unset($_SESSION["prod_id"]);
}

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

for ($m = 0; $m < count($_SESSION['itemQty']); $m++) {
    echo "
                <tbody>
                <tr><td><h5>" . $prod[$m]['prod_name'] . "</h5>
                    </td>
                    <td><h5>" . $_SESSION['itemQty'][$m] . "</h5>
                    </td>
                    <td><h5>" . '$ ' . number_format($prod[$m]['unit_price'], 2) . "</h5>
                    </td>
                    <td>
                        <h5>" . '$ ' . number_format($total[$m], 2) . "</h5>
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
                    <td><h5>" . '$ ' . number_format($subtotal, 2) . "</h5></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><h5>Shipping</h5></td>
                    <td><h5>$ 10.00</h5></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><h5>Grand Total</h5></td>
                    <td><h5>" . '$ ' . number_format($grandTotal, 2) . "</h5></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td> 
                    <td><h5><button type='button' class='btn btn-danger btn-sm'>
                            <span class='glyphicon glyphicon-remove'></span>  Empty Cart</button></h5></td>
                </tr>
                <tr>
                    <td>
                        <a href='../index.php'><button type='button' class='btn btn-default btn-md'>
                                <span class='glyphicon glyphicon-chevron-left'></span>  Continue Shopping</button></a>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href='login.php'><button type='button' class='btn btn-default btn-md'>
                                Purchase <span class='glyphicon glyphicon-chevron-right'></span></button></a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    ";
?>
</body>

</html>