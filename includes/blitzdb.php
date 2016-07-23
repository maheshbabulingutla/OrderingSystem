<?php
	$username="student";
	$password="student";
	$hostname="blitz.cs.niu.edu";
	$dbname="csci467";
	$conn1 = mysql_connect($hostname, $username, $password, $dbname);
    $db_selected1 = mysql_select_db($dbname, $conn1);
?>
