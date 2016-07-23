
<?php
//include_once "../login_check.php";
include_once "functions.php";
include_once "includes/db.php";

$ip = getIP();
//$userid = $_SESSION['login_ID'];
getinvoice();

function getinvoice(){
global $con1;

  $get_amount = "select invoice_id from invoice ";
  $get_from = mysqli_query($con1,$get_amount);

  if($details=mysqli_fetch_array($get_from)){
$inv=$details['invoice_id'];
return $inv;
  }
}


?>