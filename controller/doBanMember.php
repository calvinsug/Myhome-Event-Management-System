<?php
include("connect.php");

$id=$_REQUEST['id'];
$status=$_REQUEST['status'];

if($status=="banned"){
$query="update member set status='active' where MemberID=$id";
}
else
$query="update member set status='banned' where MemberID=$id";

mysql_query($query);

header("location:../listMember.php");
?>