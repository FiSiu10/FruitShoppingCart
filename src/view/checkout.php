<?php require_once('./config.php'); ?>

<form action="charge.php" method="post">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="<?php echo $stripe['publishable_key']; ?>"
          data-description="Payment Checkout"
          data-amount="<?php echo $total * 100; ?>"
          data-locale="auto"
		  data-currency="cad"></script>
		 <input type="hidden" name="amount" value="<?php echo $total * 100; ?>" />
</form>