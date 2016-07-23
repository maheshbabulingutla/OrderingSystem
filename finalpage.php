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
				<li role="presentation" class="active"><a href="index.php">Home</a></li>
				<li role="presentation" ><a href="allproducts.php">Catalog</a></li>
				<li role="presentation" ><a href="signup.php">Sign up</a></li>
				<li role="presentation" ><a href="cart.php">Cart</a></li>
				<li role="presentation" ><a href="Cart.php">Status</a></li>
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

			
				
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
        <fieldset>

          <!-- Form Name -->
          <legend>Shipping Details</legend>

          <!-- Text input-->
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Name</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Name" class="form-control" name="name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Line 1</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Address Line 1" class="form-control" name="add1">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput" >Line 2</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Address Line 2" class="form-control" name="add2">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">City</label>
            <div class="col-sm-10">
              <input type="text" placeholder="City" class="form-control" name="city">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput" >State</label>
            <div class="col-sm-4">
              <input type="text" placeholder="State" class="form-control" name="state">
            </div>

            <label class="col-sm-2 control-label" for="textinput" >Postcode</label>
            <div class="col-sm-4">
              <input type="text" placeholder="Post Code" class="form-control" name="postal">
            </div>
          </div>



          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Country</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Country" class="form-control" name="country">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="pull-right">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary" name="insert_post">Pay</button>
              </div>
            </div>
          </div>

        </fieldset>
      </form>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
		
		</div>
		</div>
		<div class="panel-footer">
		<h2 style="text-align:center; ">&copy;2015 by Team - 11<h2>
		</div>
	</body>
</html>

<?php
include_once "/includes/db.php";
$userid = $_SESSION['login_ID'];
$ip = getIP();
if(isset($_POST['insert_post'])){

	$name = $_POST['name'];
	$add1 = $_POST['add1'];
	$add2 = $_POST['add2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$postal = $_POST['postal'];
	


$insert_cost = "update invoice set name='$name',add1='$add1',add2='$add2',city='$city',state='$state',postal='$postal' where user_id='$userid' or user_ip='$ip'";
$run_cost = mysqli_query($con1,$insert_cost);
if($run_cost)
	{
	echo '<script>window.location="credit_form.php"</script>';
	}

}



?>