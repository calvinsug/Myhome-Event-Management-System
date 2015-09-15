<?php 
	include("connect.php");
	$query = "DELETE FROM product where ProductID = ".$_GET['id']." ";

	mysql_query($query);

	mysql_close($con);

	header("locationL:../product.php");


?>