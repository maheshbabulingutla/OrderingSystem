
<?php

function getTotal(){
include_once "login_check.php";
 include_once "functions/functions.php";
include_once "includes/db.php";
$ip = getIP();
$userid = $_SESSION['login_ID'];
  $get_amount = "select invoice_id,gtotal from invoice where user_ip='$ip' or user_id='$userid'";
  $get_from = mysqli_query($con1,$get_amount);

  while($details=mysqli_fetch_array($get_from)){
$amount=$details['gtotal'];

  }

  return $amount;
}



?>