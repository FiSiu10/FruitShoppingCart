<?php
require_once('config.php');
require_once 'vendor/autoload.php';
//require('vendor/phpmailer/PHPMailer/PHPMailerAutoload.php');
$token = filter_input(INPUT_POST, 'stripeToken', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'stripeEmail', FILTER_VALIDATE_EMAIL);
$amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_INT);
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

sendConfirmationEmail($email);

$amount = number_format(($amount / 100), 2);
echo "<h1>Successfully charged $amount!</h1>";
?>