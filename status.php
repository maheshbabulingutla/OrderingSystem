<?php
include_once "functions/functions.php";
include_once "login_check.php";
?>

<!DOCTYPE>
<html>
	<head>
		<title>Ordering System</title>
		<link rel="stylesheet" href="styles/bootstrap.css" media="all"/>
		<link rel="stylesheet" href="styles/bootstrap.min.css" media="all"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		
		
		
			<ul class="nav nav-tabs">
				<li role="presentation" ><a href="index.php">Home</a></li>
				<li role="presentation" ><a href="allproducts.php">Catalog</a></li>
				<li role="presentation" ><a href="signup.php">Sign up</a></li>
				<li role="presentation" ><a href="cart.php">Cart</a></li>
				<li role="presentation" class="active"><a href="status.php">Status</a></li>
				<li role="presentation" ><a href="#">Contact Us</a></li>

				<div id="form">
				<form method="get" action="result.php" enctype="multipart/form-data" class="form-inline">
					<input type="text" name="user_query" placeholder="Search a product"  class="form-control"/>
					<input type="submit" name="search" value="Search" class="btn btn-primary"/>
				</form>
				</div> 
			</ul>

			<nav class="navbar navbar-default">
				
		
		
		<!--this is content area-->
		
		
				
				<p style="padding-left: 1px; padding-top: 1px; padding-bottom: 1px;  padding-right: 1px; border-left-width: 20px; margin-left: 5px;
    margin-top: 2px;">
				<?php
				if(isset($_SESSION['login_user'])){
					echo 'Welcome, '.$_SESSION['login_user'];
	}else{
		echo 'Welcome, Guest!';
				}?>&nbsp&nbsp<b> <button class="btn btn-primary" type="button">Shopping Cart &nbsp-&nbsp</b> Total Items &nbsp<span class="badge"><?php total_items(); ?> </span>Total Price&nbsp<span class="badge"><?php total_price(); ?></span> <span class="badge"><a href="cart.php">Go to Cart</a></span></button>
							


				</p>

			</div>
			</nav>
			
			

			<div class="panel-body">
		<div class="well"">
		
			<?php cart(); ?>

			
				<?php 
					$ip=getIP(); 
					?>
				
					
					   <form class="form-horizontal" method="post" enctype="multipart/form-data">
					    <div class="form-group" style="
    margin-left: 300px;
    margin-right: 10px;
    margin-top: 100px;
">
<br>
Invoice Number <input type="text" name="invoice">&nbsp&nbsp

<input type="submit" name="insert_post" value="Check Status" class="btn btn-primary">
</div>
					   </form>

					   
					
<?php
include_once "includes/db.php";

if(isset($_POST['insert_post'])){

	$invoice = $_POST['invoice'];
	
$check_status = "select status from invoice where invoice_id='$invoice'";
$run_cost = mysqli_query($con1,$check_status);

while($status=mysqli_fetch_array($run_cost)){
$check=$status['status'];

?>
<div class="alert alert-danger" role="alert"><center>
   <?php

echo $check;

?>
</center></div> <?php
}

}

?>
 
  
</div>
				
		
		</div>
		</div>
		<div class="panel-footer">
		<h2 style="text-align:center; ">&copy;2015 by Team - 11<h2>
		</div>
	</body>
</html>

