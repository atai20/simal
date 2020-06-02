<html>
<head>
<title>Donate With PayPal</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="css/flexslider.css" type="text/css">
</head>
<body>
<div id = "main">
<h1>Donate With PayPal</h1>
<div id = "container">
<h2>Save the Children Needs Your Support To Bring Back Smiles</h2>
<hr/>
<!-- Place somewhere in the <body> of your page -->
<div class="flexslider">
<!-- image slider start here -->
<ul class="slides">
<li>
<div class="box-shadow-preview">
<img src="images/1.jpg"/>
</div>
</li>
<li>
<div class="box-shadow-preview">
<img src="images/2.jpg" />
</div>
</li>
<li>
<div class="box-shadow-preview">
<img src="images/3.jpg" />
</div>
</li>
<li>
<div class="box-shadow-preview">
<img src="images/4.jpg" />
</div>
</li>
<li>
<div class="box-shadow-preview">
<img src="images/5.jpg" />
</div>
</li>
</ul>
</div>
<div class="donate">
<!-- 1st charity container -->
<div class="charity">
<a href=""><img src="images/logo1.PNG"></a>
<form action="process.php" method="POST">
<input type="hidden" name="id" value="<?php echo base64_encode(1); ?>">
<input type="submit" value="Donate $25" name="submit">
</form>
<p>Or give <a href="#" onclick="show('<?php echo base64_encode(1); ?>');" class="show2">any amount</a>.</p>
</div>
<!-- 2nd charity container -->
<div class="charity">
<a href=""><img src="images/logo2.PNG"></a>
<form action="process.php" method="POST">
<input type="hidden" name="id" value="<?php echo base64_encode(2); ?>">
<input type="submit" value="Donate $25" name="submit">
</form>
<p>Or give <a href="#" onclick="show('<?php echo base64_encode(2); ?>');">any amount</a>.</p>
</div>
<!-- 3rd charity container -->
<div class="charity">
<a href=""><img src="images/logo3.PNG"></a>
<form action="process.php" method="POST">
<input type="hidden" name="id" value="<?php echo base64_encode(3); ?>">
<input type="submit" value="Donate $25" name="submit">
</form>
<p>Or give <a href="#" onclick="show('<?php echo base64_encode(3); ?>');">any amount</a>.</p>
</div>
<!-- 4th charity container -->
<div class="charity">
<a href=""><img src="images/logo4.PNG"></a>
<form action="process.php" method="POST">
<input type="hidden" name="id" value="<?php echo base64_encode(4); ?>">
<input type="submit" value="Donate $25" name="submit">
</form>
<p>Or give <a href="#" onclick="show('<?php echo base64_encode(4); ?>');">any amount</a>.</p>
</div>
</div>
</div>
<img id="paypal_logo" style="margin-left: 722px;" src="images/secure-paypal-logo.jpg">
</div>
<div id="pop2" class="simplePopup">
<h3>Donate and start helping today!</h3>
<form action="process.php" method="POST">
<img src="images/donate.jpg">
<br/>
<b>$</b><input type="hidden" name="id" id='charity_id' value=''>
<input type="number" value="" name="amount" required="required" step=".1">
<input type="submit" value="Donate Now" name="submit">
</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="js/jquery.flexslider.js"></script>
<!-- code for sliders -->
<script type="text/javascript" charset="utf-8">
$(window).load(function() {
$('.flexslider').flexslider();
});</script>
<script src="js/jquery.simplePopup.js" type="text/javascript"></script>
<!-- call popup -->
<script type="text/javascript">
function show(id) {
$('#charity_id').val(id);
$('.box-shadow-preview').css("opacity", "0.1");
$('#pop2').simplePopup();
}
</script>
</body>
</html>