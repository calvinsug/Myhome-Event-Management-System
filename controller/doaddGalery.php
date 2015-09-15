<?php
//connect
include("connect.php");
session_start();
//get all parameter

$error= "";
$EventID = $_POST['EventID'];

$Type = $_POST['Type'];

$image = $_FILES['img']['name'];
$video = $_POST['video'];

if($Type == 'photo')
	if($image=="") $error="Image must be chosen.";

if($Type == 'video')
	if($video=="") $error="URL video must be filled.";

if($error==""){

	$query = "select max(GalleryID) from galleryevent";

	$result = mysql_query($query);

	if(mysql_num_rows($result) > 0){
		$row=mysql_fetch_array($result);

		$GalleryID = substr($row[0],3,4);

		$id= intval($GalleryID) +1;
		
		$id = str_pad($id, 4, '0', STR_PAD_LEFT);

		$GalleryID = 'GAL' . $id;
	}
	else{
		$GalleryID = 'GAL0001';
	} 

	if($Type == 'photo'){
		$query = "insert into galleryevent(GalleryID,Source,Type,EventID) VALUES('$GalleryID','$image','$Type','$EventID')";
		//upload file ke folder image
		move_uploaded_file($_FILES['img']['tmp_name'], "../assets/images/photogallery/".$image);		
	}
	else if($Type == 'video')
		$query = "insert into galleryevent(GalleryID,Source,Type,EventID) VALUES('$GalleryID','$video','$Type','$EventID')";


	mysql_query($query);
	mysql_close($con);
	header("location:../popup/addGalery.php?success=1");
}
else 
	header("location:../popup/addGalery.php?error=".$error);

?>