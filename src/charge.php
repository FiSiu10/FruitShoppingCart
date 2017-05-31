<?php
require_once 'confirmationEmail.php';
require_once('config.php');
require_once 'vendor/autoload.php';
//require('vendor/phpmailer/PHPMailer/PHPMailerAutoload.php');
$token = filter_input(INPUT_POST, 'stripeToken', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'stripeEmail', FILTER_VALIDATE_EMAIL);
$amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_INT);
$shipFirstName = filter_input(INPUT_POST, 'shipFirstName', FILTER_SANITIZE_SPECIAL_CHARS);
$shipLastName = filter_input(INPUT_POST, 'shipLastName', FILTER_SANITIZE_SPECIAL_CHARS);
$shipAddress = filter_input(INPUT_POST, 'shipAddress', FILTER_SANITIZE_SPECIAL_CHARS);
$shipCity = filter_input(INPUT_POST, 'shipCity', FILTER_SANITIZE_SPECIAL_CHARS);
$shipProvince = filter_input(INPUT_POST, 'shipProvince', FILTER_SANITIZE_SPECIAL_CHARS);
$shipPostal = filter_input(INPUT_POST, 'shipPostal', FILTER_SANITIZE_SPECIAL_CHARS);

$mail = new PHPMailer;
/* Send Confirmation Email here.
See https://github.com/PHPMailer/PHPMailer/blob/master/examples/gmail.phps
as example using Gmail as Mail Server with PHPMailer
*/
$customer = \Stripe\Customer::create(array(
'email' => $email,
'source' => $token
));
$charge = \Stripe\Charge::create(array(
'customer' => $customer->id,
'amount' => $amount,
'currency' => 'cad'
));

$name = $shipFirstName . ' ' . $shipLastName;
sendConfirmationEmail($email, $name, $shipAddress, $shipCity, $shipProvince, $shipPostal);

$amount = number_format(($amount / 100), 2);
echo "<h1>Successfully charged $amount!</h1>";
?>