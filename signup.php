<?php
if(isset($_POST['submit']))
{
	include_once "includes/db.php";
	include_once "functions/functions.php";

	$ip = getIP();

$userid= $_POST['user_name'];
$password= $_POST['userPassword'];
$fullname= $_POST['fullname'];
$email= $_POST['userEmail'];
$address= $_POST['useraddress'];
$city= $_POST['usercity'];
$state= $_POST['userstate'];
$contact= $_POST['usercontact'];


$query7= "INSERT INTO user (username,password,fullname,email,address,city,state,contact,user_ip,userType) VALUES('$userid', '$password', '$fullname','$email','$address','$city','$state','$contact','$ip','user')";
$userentry = mysqli_query($con1,$query7);

if($userentry)
	{
	echo "<script>window.location='login.html'</script>";

	}



/*if(empty(mysql_error())
	{
    echo "Records added successfully.";
	} 
else
	{
    echo "ERROR: Could not able to execute $query7. " . mysql_error($conn);
	}*/
 
// close connection

}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>OrderSystem</title>
		<link rel="stylesheet" type="text/css" href="styles/mahesh.css" />
	</head>
		
	<body>
	
	<div id="login">
	      </br>
		  </br>
		  </br>
	
		  <h1>Sign-up Form</h1>
		  <form align="center" name="signup" method = "post" action = "signup.php">
		  
				
				<input type="userid" placeholder="Username" required ="" id="user_name" name="user_name"/>
				</br>
				<input type="password" placeholder="password" required="" id="userPassword" name="userPassword"/>
				</br>	
				<input type="fullname" placeholder="FullName" required ="" id="fullname" name="fullname"/>
				</br>
				<input type="email" placeholder="EmailID" required="" id="userEmail" name="userEmail"/>
				</br>
				<input type="address" placeholder="Address" required="" id="useraddress" name="useraddress"/>
				</br>
				<input type="city" placeholder="City" required="" id="usercity" name="usercity"/>
				</br>
				<input type="state" placeholder="State" required="" id="userstate" name="userstate"/>
				</br>
				<input type="contact" placeholder="Contact No." required="" id="usercontact" name="usercontact"/>
				</br>
				</br>
				<input type="submit" id="submit" name="submit" value="SignUp"/>
				</br>
				</br>
			
				</form>
			</div>
		
	</body>
</html>
