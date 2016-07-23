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
				<li><a href="#">Home</a></li>
				<li><a href="#">Catalog</a></li>
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

			<div id="shopping_cart">
				<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
				Welcome Guest!	<b style="color:yellow"> Shopping Cart -	</b> Total Items : Total Price: <a href="cart.php" style="color:yellow">Go to Cart</a>

				</span>

			</div>
				<div id="products_box">
					<?php
					if(isset($_GET['pro_id'])){
						$product_id = $_GET['pro_id'];
				include_once("includes/legacydb.php");
				
				global $con;


				$data = mysql_query("SELECT * FROM parts where number='$product_id'") ;


				while($row_prod=mysql_fetch_array($data)){
					$product_id = $row_prod['number'];
					$product_title = $row_prod['description'];
					$pro_price = $row_prod['price'];
					
					echo "
							<div id='single_product'>
								<h3>$product_title</h3>
								<img src='admin_area/product_images/pro_image' width='400' height='300'/>
								<p></b>$ $pro_price</b></p>
								<a href='index.php' style='float:left;'>Go Back</a>
								<a href='index.php>pro_id=$product_id'><button style='float:right'>Add to Cart</button></a>
							</div>
							";
					}

				
			}

?>
				</div>
			</div>
		</div>
		<div id="footer">
		<h2 style="text-align:center; padding-top:30px;">&copy;2015 by Team - 11<h2>
		</div>
	</body>
</html>