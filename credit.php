<html>
<head>
<title>Credit Card Authorization Test Page</title>
</head>
<body>
<h3>Credit Card Authorization Test Page via PHP</h3>

<?php
$fp = fsockopen( "udp://blitz.cs.niu.edu", 4445, $errno, $errstr );
if (!$fp) die("$errstr ($errno)<br>");


if(isset($_POST['card-holder-name'],$_POST['card-number'],$_POST['expiry-month'],$_POST['expiry-year'])){

	include_once "functions/total_function.php";
	$amount = getTotal();
	

$message=$_POST['card-number'].":".$_POST['expiry-month']."/".$_POST['expiry-year'].":".$amount.":".$_POST['card-holder-name'];

//$message = "1234234534567:12/2016:521.21:John Doe";
echo "Sending: $message<br>";
fwrite( $fp, $message ) or die("write failed<br>");
$response = fread($fp, 1024);
echo "Received: $response<br>";

include_once "invoice_function.php";
$invoice = getinvoice();

echo '<script language="javascript">';
echo 'alert("Payment Success! Your invoice number is'.'$invoice")';
echo '</script>'; 

fclose($fp);

}
?>

</body>
</html>

