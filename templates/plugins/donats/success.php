<html>
<head>
<title>Donate With PayPal</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
if (!empty($_REQUEST)) {
$product_no = $_REQUEST['item_number']; // Product ID
$product_transaction = $_REQUEST['tx']; // Paypal transaction ID
$product_price = $_REQUEST['amt']; // Paypal received amount value
$product_currency = $_REQUEST['cc']; // Paypal received currency type
$product_status = $_REQUEST['st']; // Paypal product status
}
?>
<div id="main">
<h1 style="margin-left: -37%;">Donate With PayPal</h1>

<div id="return">

<h2>Payment Status </h2>
<hr/>
<?php
//Rechecking the product price and currency details

echo "<h3 id='success'>Thanks For Donation</h3>";
echo "<P>Transaction Status - " . $product_status . "</P>";
echo "<P>Transaction Id - " . $product_transaction . "</P>";
echo "<div class='back_btn'><a href='index.php' id= 'btn'><< Back</a></div>";

?>
</div>
</div>
</body>
</html>