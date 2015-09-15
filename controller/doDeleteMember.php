<?php
include("connect.php");

$id=$_REQUEST['id'];

$query="delete from Member where MemberID=$id";

mysql_query($query);

header("location:../listMember.php");
?>