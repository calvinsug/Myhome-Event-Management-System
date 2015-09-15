<?php 
	include("connect.php");
	$query = "DELETE FROM comment where CommentID = ".$_GET['id']." ";

	mysql_query($query);

	mysql_close($con);

	header("location:../comment.php");


?>