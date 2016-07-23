<?php ob_start();
session_start();
	include_once "includes/db.php";
	

	if (isset($_POST['submit'])) 
	{
		if (empty($_POST['user_name']) || empty($_POST['userPassword'])) 
		{
			$error = "Username or Password are empty";
		}
		else
		{
			$username1=$_POST['user_name'];
			$password1=$_POST['userPassword'];
			$errorVal = "";
			$query = "SELECT * FROM user WHERE username='$username1' AND password='$password1'";
			
			$result1 = mysqli_query($con1,$query);
			$count = mysqli_num_rows($result1);
			
			if($count == 1)
			{
				while($row = mysqli_fetch_array($result1))
				{
					$userLoginName = $row['fullname'];
					$userLoginType = $row['userType'];
					$userLoginID = $row['userid'];
					$userType = $row['userType']; 
					$_SESSION['login_user']=$userLoginName; // Initializing Session
					$_SESSION['login_type']=$userLoginType;
					$_SESSION['login_ID']=$userLoginID;
					//echo 'user validation succeeded';
					if($userType=='a')
					{
						echo '<script>window.location="admininterface.php"</script>';
		
					}
					else if($userType=='w1')
					{
						echo '<script>window.location="wwinterface.php"</script>';
					}
					else if($userType=='w2')
					{
						echo '<script>window.location="wrdesk.php"</script>';
					}
					else if($userType=='user')
						{
						echo '<script>window.location="index.php"</script>';
						}
					else{
							echo "Username or password is invalid";
						}	

					}

				}

			}
				
		}

?>