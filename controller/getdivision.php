<?php
include("connect.php");

$data['division'] = array();
$data['value'] = array();

$query = "select * from division";

$result = mysql_query($query);

while($row=mysql_fetch_array($result)){
	
	array_push($data['division'], $row['DivisionName']);
	array_push($data['value'], $row['DivisionID']);

}

echo json_encode($data);

?>