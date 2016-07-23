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
">Change Status</legend>
    <div class="form-group" style="
    margin-left: 300px;
    margin-right: 10px;
    margin-top: 100px;
">
<br>
Invoice#<input type="text" name="invoice_id">
<br>
Status<input type="text" name="status"><br><br>
<input type="submit" name="insert_post" value="Change" class="btn btn-primary">
</div>
</fieldset>
</form>
</body>
</html>


<?php
include_once "/includes/db.php";

if(isset($_POST['insert_post'])){

	$invoice_id = $_POST['invoice_id'];
	$status = $_POST['status'];


$insert_cost = "update invoice set status='$status' where invoice_id='$invoice_id'";
$run_cost = mysqli_query($con1,$insert_cost);
if($run_cost)
	{
	echo "<script>alert('Successfully changed !')</script>";
	}

}



?>

