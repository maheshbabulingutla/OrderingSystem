<?php
include_once "includes/db.php";


function tax(){
global $con1;

$insert_cost = "select * from cost where cost_id=1";
$run_cost = mysqli_query($con1,$insert_cost);

if($row_cost=mysqli_fetch_array($run_cost)){

$tax = $row_cost['tax'];


}
return $tax;
}

function shipcost(){
	global $con1;

$insert_cost = "select * from cost where cost_id=1";
$run_cost = mysqli_query($con1,$insert_cost);

if($row_cost=mysqli_fetch_array($run_cost)){
$shipcost = $row_cost['ship_hand'];
}
return $shipcost;
}


?>

