<?php 
	include("connect.php");

	$query = "delete FROM galleryevent where GalleryID = '".$_GET['id']."' ";

	$type = $_GET['type'];


	mysql_query($query);

	mysql_close($con);

	if($type == 'photo')
		header("location:../popup/viewGallery.php?success=1&EventID=".$_GET['EventID']);
	else if($type == 'video')
		header("location:../popup/viewVideo.php?success=1&EventID=".$_GET['EventID']);

?>