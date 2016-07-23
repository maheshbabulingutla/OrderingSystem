<!DOCTYPE>
<?php
include("../includes/db.php");

?>
<html>
	<head>
		<title>Inserting Product</title>
	</head>
<body bgcolor="skyblue">
	<form method="post" enctype="multipart/form-data">
		<table align="center" width="600" border="2">
			<tr>
				<td colspan="8"><h2>Insert new products</h2></td>
			</tr>
			<tr>
				<td align="right">Product Title</td>
				<td><input type="text" name="product_title" required/></td>
			</tr>
			<tr>
				<td align="right">Product Image</td>
				<td><input type="file" name="product_image"/></td>
			</tr>
			<tr>
				<td align="right">Product Description</td>
				<td><input type="text" name="product_desc" required/></td>
			</tr>
			<tr>
				<td align="right">Product Price</td>
				<td><input type="text" name="product_price" required/></td>
			</tr>
			<tr>
				<td align="right">Product Keywords</td>
				<td><input type="text" name="product_keywords"/></td>
			</tr>
			
			<tr align="center">
				<td colspan="8"><input type="submit" name="insert_post" value="insert_Now"/></td>
			</tr>
		</table>
	</form>

</html>
<?php

if(isset($_POST['insert_post'])){ 

//getting the text data from the fields
	$product_title = $_POST['product_title'];
	$product_desc = $_POST['product_desc'];
	$product_price = $_POST['product_price'];
	$product_keywords = $_POST['product_keywords'];

//getting the image from the field
$product_image = $_FILES['product_image']['name'];
$product_image_tmp = $_FILES['product_image']['tmp_name'];
move_uploaded_file($product_image_tmp,"product_images/$product_image");

$insert_product ="insert into products(product_title,product_price,product_desc,product_image,product_keywords) values ('$product_title','$product_price','$product_desc','$product_image','$product_keywords')";

$insert_pro = mysqli_query($con,$insert_product);


if($insert_pro){
echo "<script>alert('Product has been inserted')</script>";
echo "<script>window.open('insert_product.php','_self')</script>";

}

}