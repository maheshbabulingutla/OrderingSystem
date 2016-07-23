<?php
include_once "functions/functions.php";
?>

<!DOCTYPE>
<html>
	<head>
		<title>Ordering System</title>
		<link rel="stylesheet" href="styles/style.css" media="all"/>
	</head>
	<body>
		<div class="main_wrapper">
			<div class="header_wrapper">
			<img id="logo" src=""/>
			<img id="banner" src=""/>		
		</div>
		<div class="menubar">
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="allproducts.php">Catalog</a></li>
				<li><a href="#">Profile</a></li>
				<li><a href="#">Sign up</a></li>
				<li><a href="#">cart</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>
				<div id="form">
				<form method="get" action="result.php" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Search a product"/>
					<input type="submit" name="search" value="Search"/>
				</form>
				</div>
		</div>
		<!--this is content area-->
		<div class="content_wrapper">
			<div id="content_area">
			<?php cart(); ?>

			<div id="shopping_cart">
				<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
				Welcome Guest!	<b style="color:yellow"> Shopping Cart -	</b> Total Items : <?php total_items(); ?> Total Price: <?php total_price(); ?><a href="cart.php" style="color:yellow">Go to Cart</a>

				</span>

			</div>
			<table>
				<?php 
					echo $ip=getIP(); 
					?>
				<div id="products_box">
					<?php 
					    include_once "includes/db.php";
						include_once "includes/legacydb.php";
						global $con1;
						$total = 0;

						$ip = getIP();
						$sel_price = "select * from cart where ip_add='$ip'";
						$run_price = mysqli_query($con1,$sel_price);
						while($p_price = mysqli_fetch_array($run_price)){
						global $con;
						$pro_id = $p_price['p_id'];
						$qty = $p_price['qty'];
						$run_pro_price = mysql_query("SELECT * FROM parts where number = '$pro_id'");
										while($pp_price = mysql_fetch_array($run_pro_price)){
											$product_price = array($pp_price['price']);

											$product_desc = $pp_price['description'];

											$single_price = $pp_price['price'];

											$values = array_sum($product_price);
											
											$total += $values;
										
										
											$total = $total*$qty;
 


											
									
									?>

									<tr align="center">
										<td><?php echo "Part ID - ".$pro_id;?></td>
										<td><?php echo "Part Name - ".$product_desc; ?></td>
										<td><?php echo "Quantity - ".$qty;?></td>
										


										<?php } }
					?>
					
									</tr>
					</table>
					<br><br><?php echo "Total - ".$total;?>

					<?php
					$main_query = "insert into invoice (total, user_id,


					?>



				</div>
			</div>
		</div>
		<div id="footer">
		<h2 style="text-align:center; padding-top:30px;">&copy;2015 by Team - 11<h2>
		</div>
	</body>
</html>