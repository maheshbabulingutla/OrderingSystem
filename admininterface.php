<html>
<head>
<title>Admin Interface</title>
<link rel="stylesheet" href="styles/bootstrap.min.css" media="all"/>
</head>
<body>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend style="
    margin-left: 10px;
">Admin Interface</legend>
    <div class="form-group" style="
    margin-left: 300px;
    margin-right: 10px;
    margin-top: 100px;
">
<br>
Shipping and Handling <input type="text" name="ship_hand">
<br>
Tax<input type="text" name="tax"><br><br>
<input type="submit" name="insert_post" value="Change" class="btn btn-primary">
</div>
</fieldset>
</form>
</body>
</html>


<?php
include_once "/includes/db.php";

if(isset($_POST['insert_post'])){

	$tax = $_POST['tax'];
	$shipcost = $_POST['ship_hand'];


$insert_cost = "update cost set tax='$tax', ship_hand='$shipcost' where cost_id=1";
$run_cost = mysqli_query($con1,$insert_cost);
if($run_cost)
	{
	echo "<script>alert('Successfully changed !')</script>";
	}

}



?>

