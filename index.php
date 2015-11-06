<?php require_once("braintree_init.php"); ?>

<html>
<head>
</head>
<body>
    <h1>Checkout</h1>
    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    <script>
      var client_token = "<?php echo(Braintree\ClientToken::generate()); ?>";
      braintree.setup(client_token, "dropin", {
        container: "payment-form"
      });
    </script>
</body>
</html>
