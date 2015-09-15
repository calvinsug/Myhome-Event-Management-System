<?php
include("connect.php");

$data['location'] = array();
$data['value'] = array();

$query = "select * from location";

$result = mysql_query($query);

while($row=mysql_fetch_array($result)){
	
	array_push($data['location'], $row['LocationAddress']);
	array_push($data['value'], $row['LocationID']);

}

echo json_encode($data);

?>