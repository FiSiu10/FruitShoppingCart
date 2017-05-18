<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_QIWQso4Fzb7l8vy3CjFqQ1gh",
  "publishable_key" => "pk_test_rc4Xn9ma1QpB67d6ZPtSuZqS"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>