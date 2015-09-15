<?php
include("connect.php");

$error= "";
$content = $_POST['content'];
$idcomment = $_POST['idcomment'];

//validasi content
if($content=="") $error="content must be filled";

//klo lolos validasi
if($error==""){
	$query = "UPDATE comment set Content = '$content' where CommentID=$idcomment";
	

	mysql_query($query);

	//menutup koneksi
	mysql_close($con);
			
	//balik ke home
	header("location:../comment.php");

}
//klo ga lolos validasi
else header("location:../editcomment.php?error=$error & id=$idcomment");
?>