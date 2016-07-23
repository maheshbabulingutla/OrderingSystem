

<?php

include_once "../includes/legacydb.php";
$sqlget1 = mysql_query("select count(*) from parts");

$count = mysql_result($sqlget1,0);
echo "sir count --> $count<br>";

include_once "../includes/db.php";
$sqlget2 = "select COUNT(part_number) from product";
$run_sql = mysqli_query($con1,$sqlget2);

?>


<?php
	$sql1 = mysql_query("select number from parts");
	<table>
		while($row_sql=mysql_fetch_array($sql1))
	{
		$number = $row_sql['number'];
		$sqlput1= "insert into product (part_number,quantity) values ('$number','100')";
		$run_sql1 = mysqli_query($con1,$sqlput1);
		echo "$number<br>";
	}

	


?>