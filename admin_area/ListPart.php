<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CSCI467/567 Access to Legacy Database Test Page</title>
</head>
<body>	
<h3>Parts Database Content</h3>
<?php 
 // Connects to your Database 
  mysql_connect("blitz.cs.niu.edu", "student", "student") or die(mysql_error()); 
 mysql_select_db("csci467") or die(mysql_error()); 
 // Collects data from "parts" table 
 $data = mysql_query("SELECT * FROM parts") 
 or die(mysql_error());
 // print nicely
 Print "<table border cellpadding=3>"; 
 Print "<tr>"; 
 Print "<th>Number</th><th>Description</th><th>Price</th>";
 Print "</tr>";
 while($info = mysql_fetch_array( $data )) { 
    Print "<tr>"; 
    Print "<td>".$info['number'] . "</td> "; 
    Print "<td>".$info['description'] . " </td>"; 
    Print "<td>".$info['price'] . " </td></tr>"; 
 } 
 Print "</table>"; 
 ?> 
</body>
</html>
