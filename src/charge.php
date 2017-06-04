<?php
session_start();
require_once 'confirmationEmail.php';
require_once('config.php');
require_once 'vendor/autoload.php';
require_once 'view/header.php';
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
//require('vendor/phpmailer/PHPMailer/PHPMailerAutoload.php');
$token = filter_input(INPUT_POST, 'stripeToken', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'stripeEmail', FILTER_VALIDATE_EMAIL);
$amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_INT);
$shipFirstName = filter_input(INPUT_POST, 'shipFirstName', FILTER_SANITIZE_SPECIAL_CHARS);
$shipLastName = filter_input(INPUT_POST, 'shipLastName', FILTER_SANITIZE_SPECIAL_CHARS);
$shipAddress = filter_input(INPUT_POST, 'shipAddress', FILTER_SANITIZE_SPECIAL_CHARS);
$shipCountry = filter_input(INPUT_POST, 'shipCountry', FILTER_SANITIZE_SPECIAL_CHARS);
$shipCity = filter_input(INPUT_POST, 'shipCity', FILTER_SANITIZE_SPECIAL_CHARS);
$shipProvince = filter_input(INPUT_POST, 'shipProvince', FILTER_SANITIZE_SPECIAL_CHARS);
$shipPostal = filter_input(INPUT_POST, 'shipPostal', FILTER_SANITIZE_SPECIAL_CHARS);
$shipProviceCountry = $shipCity . ", " . $shipProvince . " " . $shipCountry;
$billAddress = filter_input(INPUT_POST, 'billAddress', FILTER_SANITIZE_SPECIAL_CHARS);
$billCity = filter_input(INPUT_POST, 'billCity', FILTER_SANITIZE_SPECIAL_CHARS);
$billProvince = filter_input(INPUT_POST, 'billProvince', FILTER_SANITIZE_SPECIAL_CHARS);
$billPostal = filter_input(INPUT_POST, 'billPostal', FILTER_SANITIZE_SPECIAL_CHARS);
$billCountry = filter_input(INPUT_POST, 'billCountry', FILTER_SANITIZE_SPECIAL_CHARS);
$billProvinceCountry = $billCity . ", " . $billProvince . " " . $billCountry;
if (!isset($shipAddress)) {
      $error_message = 'Missing address.';
} elseif (!isset($shipFirstName)) {
      $error_message = 'Missing first name.';
} elseif (!isset($shipLastName)) {
      $error_message = 'Missing last name.';
  } elseif (!isset($shipCity)) {
      $error_message = 'Missing city.';
} elseif (!isset($shipProvince)) {
      $error_message = 'Missing province.';
} elseif (!isset($shipPostal)) {
      $error_message = 'Missing postal code.';
} elseif (!isset($shipCountry)) {
      $error_message = 'Missing country.';
} elseif (!isset($custid)) {
      $error_message = 'Not logged in.';
  } elseif ($shipAddress === false) {
      $error_message = 'Invalid address.';
  } elseif ($shipFirstName === false) {
      $error_message = 'Invalid first name.';
  } elseif ($shipLastName === false) {
      $error_message = 'Invalid last name.';
  } elseif ($shipCity === false) {
      $error_message = 'Invalid city.';
} elseif ($shipProvince === false) {
      $error_message = 'Invalid province.';
} elseif ($shipPostal === false) {
      $error_message = 'Invalid postal code.';
} elseif ($shipCountry === false) {
      $error_message = 'Invalid country.';
  } elseif (!isset($billAddress)) {
      $error_message = 'Missing address.';
  } elseif (!isset($billCity)) {
      $error_message = 'Missing city.';
} elseif (!isset($billProvince)) {
      $error_message = 'Missing province.';
} elseif (!isset($billPostal)) {
      $error_message = 'Missing postal code.';
} elseif (!isset($billCountry)) {
      $error_message = 'Missing country.';
  } elseif ($billAddress === false) {
      $error_message = 'Invalid address.';
  } elseif ($billCity === false) {
      $error_message = 'Invalid city.';
} elseif ($billProvince === false) {
      $error_message = 'Invalid province.';
} elseif ($billPostal === false) {
      $error_message = 'Invalid postal code.';
} elseif ($billCountry === false) {
      $error_message = 'Invalid country.';
} elseif ($custid === false) {
      $error_message = 'Invalid login.';
  } else {
      $error_message = '';
  }

$mail = new PHPMailer;
/* Send Confirmation Email here.
See https://github.com/PHPMailer/PHPMailer/blob/master/examples/gmail.phps
as example using Gmail as Mail Server with PHPMailer

$customer = \Stripe\Customer::create(array(
'email' => $email,
'source' => $token
));
$charge = \Stripe\Charge::create(array(
'customer' => $customer->id,
'amount' => $amount,
'currency' => 'cad'
));
*/
$name = $shipFirstName . ' ' . $shipLastName;

$amount = number_format(($amount / 100), 2);
//echo "<h1>Successfully charged $amount!</h1>";
?>
<style>
    .enter{
        text-align: right;
        margin-right: 150px;
    }
    .bs-wizard {margin-top: 40px; margin-right: 500px; text-align: right;}

    /*Form Wizard*/
    .bs-wizard {border-bottom: solid 1px #e0e0e0; padding: 0 0 10px 0; width: 100%;}
    .bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
    .bs-wizard > .bs-wizard-step + .bs-wizard-step {}
    .bs-wizard > .bs-wizard-step .bs-wizard-stepnum {color: #595959; font-size: 13px; margin-bottom: 5px; font-weight: bold;}
    .bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 10px;}
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #b6ddc2; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;}
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: ' '; width: 14px; height: 14px; background: #97aa40; border-radius: 50px; position: absolute; top: 8px; left: 8px; }
    .bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
    .bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #b6ddc2;}
    .bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
    .bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
    .bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
    .bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
    .bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
    .bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
    .bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
    /*END Form Wizard*/
</style>

<div class="container">
    <div class="row">
        <div class="col-md-4"><h1>Order Review</h1></div>
        <div class="col-md-4">
            <div class="row bs-wizard" style="border-bottom:0;">
                <div class="col-xs-3 bs-wizard-step complete">
                    <div class="text-center bs-wizard-stepnum">Login</div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="#" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center"></div>
                </div>

                <div class="col-xs-3 bs-wizard-step complete"><!-- complete -->
                    <div class="text-center bs-wizard-stepnum">Shipping/Billing</div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="#" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center"></div>
                </div>

                <div class="col-xs-3 bs-wizard-step complete"><!-- complete -->
                    <div class="text-center bs-wizard-stepnum">Payment</div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="#" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center"></div>
                </div>

                <div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
                    <div class="text-center bs-wizard-stepnum">Purchase</div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="#" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Shipping Details</div>
                <div class="panel-body">
                    <?php print $name ?><br>
                    <?php print $shipAddress ?><br>
                    <?php print $shipProviceCountry ?><br>
                    <?php print $shipPostal ?><br></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Billing Details</div>
                <div class="panel-body">
                    <?php print $name ?><br>
                    <?php print $billAddress ?><br>
                    <?php print $billProvinceCountry  ?><br>
                    <?php print $billPostal ?><br></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Payment Information</div>
                <div class="panel-body">Successfully charged $<?php print $amount ?>!</div>
                <?php sendConfirmationEmail($email, $name, $shipAddress, $shipCity, $shipProvince, $shipPostal)?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Order Summary</strong></h3>
                </div>
                <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <td><strong>Item Name</strong></td>
                                <td><strong>Item Price</strong></td>
                                <td><strong>Item Quantity</strong></td>
                                <td><strong>Total</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
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
                            for ($m = 0; $m < count($_SESSION['itemQty']); $m++) {echo "
                                        <tr>
                                            <td>" . $prod[$m]['prod_name'] . "</td>
                                            <td>" . '$ ' . number_format($prod[$m]['unit_price'], 2) . "</td>
                                            <td>" . $_SESSION['itemQty'][$m] . "</td>
                                            <td>" . '$' . number_format($total[$m], 2) . "</td>
                                        </tr>";}?>
                            <?php
                            echo "<tr>
                                            <td class='highrow'></td>
                                            <td class='highrow'></td>
                                            <td class='highrow'><strong>Subtotal</strong></td>
                                            <td class='highrow'>" . '$' . number_format($subtotal, 2) . "</td>
                                        </tr>
                                        <tr>
                                            <td class='emptyrow'></td>
                                            <td class='emptyrow'></td>
                                            <td class='emptyrow'><strong>Shipping</strong></td>
                                            <td class='emptyrow'>$10.00</td>
                                        </tr>
                                        <tr>
                                            <td class='emptyrow'><i class='fa fa-barcode iconbig'></i></td>
                                            <td class='emptyrow'></td>
                                            <td class='emptyrow'><strong>Total</strong></td>
                                            <td class='emptyrow'>" . '$' . number_format($grandTotal, 2) . "</td>
                                        </tr>
                                        ";?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <button type="submit" class="btn btn-primary pull-right" onclick="javascript:document.frm.submit();">Make Purchase</button>
    </div>
    <br>
</div><br><br>

<form method="post" name="frm" action="purchase_post.php">
    <input type="hidden" name="bill_addr" value="<?php print $billAddress  ?>">
    <input type="hidden" name="bill_city" value="<?php print $billCity ?>">
    <input type="hidden" name="bill_pc" value="<?php print $billPostal ?>">
    <input type="hidden" name="bill_prov" value="<?php print $billProvince ?>">
    <input type="hidden" name="bill_country" value="<?php print $billCountry ?>">
    <input type="hidden" name="ship_first_name" value="<?php print $shipFirstName ?>">
    <input type="hidden" name="ship_last_name" value="<?php print $shipLastName ?>">
    <input type="hidden" name="ship_addr" value="<?php print $shipAddress ?>">
    <input type="hidden" name="ship_city" value="<?php print $shipCity ?>">
    <input type="hidden" name="ship_pc" value="<?php print $shipPostal ?>">
    <input type="hidden" name="ship_prov" value="<?php print $shipProvince ?>">
    <input type="hidden" name="ship_country" value="<?php print $shipCountry ?>">
</form>

</body>
</html>
