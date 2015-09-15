<?php
//connect
include("connect.php");
session_start();
//get all parameter


$error= "";

$userid=$_SESSION['useridonline'];//ini tergantung dr forum nya dy isi apa  jd gw blom fixin
$comment =$_POST['comment'];//ini tergantung dr forum nya dy isi apa 
$commentdate = date('Y-m-d');


if($comment=="") $error="content must be filled";

if($error==""){
	$query = "INSERT INTO comment(MemberID,Content,CommentDate) VALUES('$userid','$comment','$commentdate')";
	mysql_query($query);
	mysql_close($con);
	header("location:../comment.php");
}
else 
header("location:../comment.php?error=$error");

?>