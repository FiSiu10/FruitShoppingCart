<?php
require_once 'header.php';
require_once '../model/db_connect.php';
require_once '../model/db_functions.php';
session_start();
?>

    <div class="container">
        <h2>Shopping Cart</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th><h4>Product</h4></th>
                <th><h4>Quantity</h4></th>
                <th><h4>Price</h4></th>
                <th><h4>Total</h4></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><img src="images/durian.jpg" width=50%"><br>
                    <h5>
                        Product Name <?php echo $_SESSION["prod_name"];?>
                    </h5>
                </td>
                <td><form>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Quantity
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <?php for ($i = 1; $i <= 10; $i++) {
                                    echo "
                                    <li>"  .  "   ". $i . "
                                    </li>";
                                } ?>
                            </ul>
                        </div>
                    </form>
                </td>
                <td><h5>
                        Product Price <?php echo $_SESSION["prod_price"];?>
                    </h5>
                </td>
                <td>
                    <h5>$$$$$</h5>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-remove"></span>  Remove</button>
                </td>
            </tr>
            </tbody>
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
                    <td><h5>$$$$</h5></td>
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
                        <button type="button" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-chevron-left"></span>  Continue Shopping</button>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-primary btn-md">Purchase <span class="glyphicon glyphicon-chevron-right"></span></button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>


</body>

</html>