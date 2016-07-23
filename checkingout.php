<?php
include_once "functions/functions.php";
?>

<!DOCTYPE>
<html>
	<head>
		<title>Ordering System</title>
		<link rel="stylesheet" href="styles/bootstrap.css" media="all"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		
		<nav class="navbar navbar-default">
		<div class="container-fluid">
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="allproducts.php">Catalog</a></li>
				<li><a href="#">Profile</a></li>
				<li><a href="#">Sign up</a></li>
				<li><a href="#">cart</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>
				<div id="form">
				<form method="get" action="result.php" enctype="multipart/form-data" class="form-inline">
					<input type="text" name="user_query" placeholder="Search a product"  class="form-control"/>
					<input type="submit" name="search" value="Search" class="btn btn-primary"/>
				</form>
				</div>
		</div>
		</nav>
		<!--this is content area-->
		<nav class="navbar navbar-default">
		<div class="container-fluid">
				
				Welcome Guest!	<b> Shopping Cart -	</b> Total Items : <span class="badge"><?php total_items(); ?></span> Total Price:<span class="badge"> <?php total_price(); ?> </span><a href="cart.php" class="navbar-link">Go to Cart</a>

				

			</div>
			</nav>

			<div class="panel-body">
		<div class="well"">
					<?php
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

											$product_desc = $pp_price['description'];

											$single_price = $pp_price['price'];

											$values = array_sum($product_price);
											$total += $values;
										
											$qty = $_POST['qty'];
											$update_qty = "update cart set qty='$qty' where p_id='$pro_id' and ip_add='$ip_add'";
											$run_qty = mysqli_query($con1,$update_qty);

											$_SESSION ['qty']=$qty;
											$total = $total*$qty;
									
									?>

									<tr align="center">
										<td><?php echo $pro_id;?>"</td>
										<td><?php echo $product_desc; ?></td>
										<td><?php echo $qty;?></td>
										<td><?php echo $total;?></td>


										<?php } } ?>
				</div>
		</div>
		<div class="panel-footer">
		<h2 style="text-align:center; ">&copy;2015 by Team - 11<h2>
		</div>
	</body>
</html>