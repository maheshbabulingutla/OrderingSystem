<html><head><link rel="stylesheet" href="styles/style.css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="js/bootstrap.min.js"></script>
</head>

<?php
include_once("includes/legacydb.php");
include_once("includes/db.php");

function getProducts(){
global $con;


$data = mysql_query("SELECT * FROM parts order by RAND() LIMIT 0,6") ;
?> <table class="table table-striped">
<thead>
	<th>Part Name</th>
	<th>Price</th>
	<th>Details</th>
	<th> </th>
</thead>
<tbody>



<?php
while($row_prod=mysql_fetch_array($data)){
	$product_id = $row_prod['number'];
	$product_title = $row_prod['description'];
	$pro_price = $row_prod['price'];
	?>  <tr><?php
	?>
				<td><b><?php echo $product_title; ?></b></td>
				<td><?php echo "$". $pro_price; ?></td>
				<td><a href='details.php?pro_id= <?php echo $product_id; ?>'>Details</a><td>
				<td><a href='index.php?add_cart=<?php echo $product_id; ?>'>
				<button style='float:right' style='width: 103px;'>Add to Cart</button></a></td>
			
	
	</tr>
			<?php
	}
?></tbody><table><?php

}

function getIP(){
$ip = $_SERVER['REMOTE_ADDR'];
if(! empty($_SERVER['HTTP_CLIENT_IP'])){
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif(!empty($_SERVER['HTTP_X FORWARDED_FOR'])){
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
return $ip;

}

function cart() {

	if(isset($_GET['add_cart'])){
		

		global $con1;
		$ip = getIP();
		$pro_id = $_GET['add_cart'];
		$check_pro = "select * from cart where ip_add='$ip' and p_id='$pro_id'";

		$run_check=mysqli_query($con1, $check_pro);

		if(mysqli_num_rows($run_check)>0){
			echo "";
		}
		else{
			$insert_pro = "insert into cart (p_id,ip_add) values ('$pro_id','$ip')";

		$run_pro = mysqli_query($con1, $insert_pro);
		echo "<script>window.open('index.php','_self')</script>";
		}
		


	}

}

//calculate total for added items

function total_items(){
if(isset($_GET['add_cart'])){
	global $con1;
	$ip = getIP();
	$get_items = "select * from cart where ip_add='$ip'";
	$run_items = mysqli_query($con1,$get_items);
	$count_items = mysqli_num_rows($run_items);
   }
	else {
		global $con1;
		$ip = getIP();
		$get_items = "select * from cart where ip_add='$ip'";
		$run_items = mysqli_query($con1,$get_items);
		$count_items = mysqli_num_rows($run_items);

	}
	echo $count_items;
}


//calculating total price

function total_price(){
	
	$total = 0;
	global $con1;

	$ip = getIP();
	$sel_price = "select * from cart where ip_add='$ip'";
	$run_price = mysqli_query($con1,$sel_price);

	while($p_price = mysqli_fetch_array($run_price)){
		global $con;
		$pro_id = $p_price['p_id'];
		$run_pro_price = mysql_query("SELECT * FROM parts where number = '$pro_id'");

		while($pp_price = mysql_fetch_array($run_pro_price)){
			$product_price = array($pp_price['price']);
			$values = array_sum($product_price);
			$total += $values;
		}


	}
echo "$" . $total;

}
?>