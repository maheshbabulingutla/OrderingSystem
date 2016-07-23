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
				<li role="presentation" class="active"><a href="cart.php">Cart</a></li>
				<li role="presentation" ><a href="status.php">Status</a></li>
				<li role="presentation" ><a href="#">Contact Us</a></li>
				<?php if(isset($_SESSION['login_user'])){ ?>
				<li role="presentation" ><a href="signout.php">Sign Out</a></li>

			<?php }else {
				?>
				<li role="presentation" ><a href="login.html">Sign In</a></li>
			<?php } ?>

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
				<?php 
					//echo 
					$ip=getIP(); 
					?>
				<div class="panel panel-default">
					<form action ="" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">

					<table width="700" class="table">
						<thead>
							<th colspan="5" align="center"><h2>Update cart/ Checkout</h2></td>
						</th>
						<tr>
							<td >Remove</th>
							<td>Parts</th>
							<td>Quantity</th>
							<th>Total Price</th>
						</tr>
									<?php
											
									$total = 0;
									global $con1;

									$ip = getIP();
									$sel_price = "select * from cart where ip_add='$ip'";
									$run_price = mysqli_query($con1,$sel_price);

									while($p_price = mysqli_fetch_array($run_price)){
										global $con;
										$pro_id = $p_price['p_id'];
										$qtynew = $p_price['qty'];
										$run_pro_price = mysql_query("SELECT * FROM parts where number = '$pro_id'");

										while($pp_price = mysql_fetch_array($run_pro_price)){
											$product_price = array($pp_price['price']);

											$product_desc = $pp_price['description'];

											$single_price = $pp_price['price'];

											$values = array_sum($product_price);
											$total += $values;
										
									?>

									<tr >
										<td><input type = "checkbox" name ="remove[]" value="<?php echo $pro_id;?>"/></td>
										<td><?php echo $product_desc; ?><br</td>
										<td><input type = "number" min="0" size="2" style = "width:30px" name ="qty" value="<?php echo $qtynew;?>"/></td>


										<?php
											if(isset($_POST['update_cart'])){
											$qty = $_POST['qty'];
											$update_qty = "update cart set qty='$qty'";
											$run_qty = mysqli_query($con1,$update_qty);

											$_SESSION ['qty']=$qty;
											$total = $total*$qty;

											
										}
										?>

										<td><?php echo "$".$single_price; ?></td>
									</tr>
									<?php } } ?>
									<tr>
										<td colspan="5" align="right"><b>Sub Total:&nbsp</b><?php echo "$".$total; ?></td>
									</tr>

									<tr>
										<td colspan="5" align="right"><b>Tax:&nbsp</b><?php 
										include_once "admin_interface/cost.php";
										$tax = tax();
										$a = $total*$tax;
										echo "$".$a; ?></td>

									</tr>
									<tr>
									<td colspan="5" align="right"><b>Shipping & Handling:&nbsp</b><?php 
										include_once "admin_interface/cost.php";
										$ship = shipcost();
										$b = $total*$ship;
										echo "$".$b?></td>
									</tr>
									<tr>
										<td colspan="5" align="right"><b>Grand Total:&nbsp</b><?php 
										$gtotal = $total + $a + $b;
										echo "$".$gtotal;?></td>
									</tr>

									<tr>
										<td><input type="submit" name="update_cart" value="Update Cart" class="btn-group btn-group-sm" role="group"/>
										<input type="submit" name="continue" value="Continue Shopping" class="btn-group btn-group-sm" role="group"/>
										<input type="submit" name="checkout" value="Checkout"  class="btn-group btn-group-sm" role="group"></td>
									</tr>

														

					</table>
					</form>

				<?php 
				
					
				include_once "includes/db.php";
				global $con1;
				

				if(isset($_POST['update_cart'])){
					$ip = getIP();				

						foreach($_POST['remove'] as $remove_id){

						$delete_product = "delete from cart where p_id='$remove_id' and ip_add='$ip'";

						$run_delete = mysqli_query($con1, $delete_product);
						if($run_delete){
							echo "<script>window.open('cart.php','_self')</script>";
							}

							

					}
				}
				

				if(isset($_POST['checkout'])){
					$ip = getIP();				
					$id = $_SESSION['login_ID'];
						
						$send_invoice = "insert into invoice (user_ip,gtotal,subtotal,tax,ship_hand,user_id) values ('$ip','$gtotal','$total','$b','$a','$id')";

						$run_invoice = mysqli_query($con1, $send_invoice);
						echo '<script>window.location="finalpage.php"</script>';
				}
				
					
						
				
				

				if(isset($_POST['continue'])){
					echo "<script>window.open('index.php','_self')</scipt>";
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