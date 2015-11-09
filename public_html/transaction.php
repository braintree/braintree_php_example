<?php
    require_once("../includes/braintree_init.php");
    if (isset($_GET["id"])) {
      $transaction = Braintree\Transaction::find($_GET["id"]);
    }
?>
<h1>Transaction <?php echo($transaction->id)?></h1>
<h2>Details</h2>
<p>
  <table>
    <tr>
      <th>Property</th>
      <th>Value</th>
    </tr>
    <tr>
      <td>id</td>
      <td><?php echo($transaction->id)?></td>
    </tr>
    <tr>
      <td>type</td>
      <td><?php echo($transaction->type)?></td>
    </tr>
    <tr>
      <td>amount</td>
      <td><?php echo($transaction->amount)?></td>
    </tr>
    <tr>
      <td>status</td>
      <td><?php echo($transaction->status)?></td>
    </tr>
    <tr>
      <td>created_at</td>
      <td><?php echo($transaction->createdAt->format('Y-m-d H:i:s'))?></td>
    </tr>
    <tr>
      <td>updated_at</td>
      <td><?php echo($transaction->updatedAt->format('Y-m-d H:i:s'))?></td>
    </tr>
  </table>
</p>

<h2>Credit Card Details</h2>
<p>
  <table>
    <tr>
      <th>Property</th>
      <th>Value</th>
    </tr>
    <tr>
      <td>token</td>
      <td><?php echo($transaction->creditCardDetails->token)?></td>
    </tr>
    <tr>
      <td>bin</td>
      <td><?php echo($transaction->creditCardDetails->bin)?></td>
    </tr>
    <tr>
      <td>last_4</td>
      <td><?php echo($transaction->creditCardDetails->last4)?></td>
    </tr>
    <tr>
      <td>card_type</td>
      <td><?php echo($transaction->creditCardDetails->cardType)?></td>
    </tr>
    <tr>
      <td>expiration_date</td>
      <td><?php echo($transaction->creditCardDetails->expirationDate)?></td>
    </tr>
    <tr>
      <td>cardholder_name</td>
      <td><?php echo($transaction->creditCardDetails->cardholderName)?></td>
    </tr>
    <tr>
      <td>customer_location</td>
      <td><?php echo($transaction->creditCardDetails->customerLocation)?></td>
    </tr>
  </table>
</p>

<h2>Customer Details</h2>
<p>
  <table>
    <tr>
      <th>Property</th>
      <th>Value</th>
    </tr>
    <tr>
      <td>id</td>
      <td><?php echo($transaction->customerDetails->id)?></td>
    </tr>
    <tr>
      <td>first_name</td>
      <td><?php echo($transaction->customerDetails->firstName)?></td>
    </tr>
    <tr>
      <td>last_name</td>
      <td><?php echo($transaction->customerDetails->lastName)?></td>
    </tr>
    <tr>
      <td>email</td>
      <td><?php echo($transaction->customerDetails->email)?></td>
    </tr>
    <tr>
      <td>company</td>
      <td><?php echo($transaction->customerDetails->company)?></td>
    </tr>
    <tr>
      <td>website</td>
      <td><?php echo($transaction->customerDetails->website)?></td>
    </tr>
    <tr>
      <td>phone</td>
      <td><?php echo($transaction->customerDetails->phone)?></td>
    </tr>
    <tr>
      <td>fax</td>
      <td><?php echo($transaction->customerDetails->fax)?></td>
    </tr>
  </table>
</p>

<p>
    <a href="/index.php">Return to checkout page</a>
</p>
