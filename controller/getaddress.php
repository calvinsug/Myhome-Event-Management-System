<?php
include("connect.php");

//$data = array('address' => 'rawarawa' , 'value'=>'BRA0001');

//$data = array();

$data['address'] = array();
$data['value'] = array();
$data['lat'] = array();
$data['lng'] = array();
$data['TotalMember'] = array();

$query = "select * from branch";

$result = mysql_query($query);

while($row=mysql_fetch_array($result)){
	//print_r($row)
	$BranchID = $row['BranchID'];
	$query2 = "select count(memberid) as TotalMember from member where branchid= '$BranchID'";
	
	//echo $query2;die;	

	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_array($result2);

	//$row['BranchID']
	//echo $row['BranchAddress'];
	//array_push($data['address'], $row['BranchAddress']);
	//array_push($data['value'], $row['BranchID']);
	
	array_push($data['address'], $row['BranchAddress']);
	array_push($data['value'], $row['BranchID']);
	array_push($data['lat'], $row['BranchLatitude']);
	array_push($data['lng'], $row['BranchLongitude']);
	array_push($data['TotalMember'], $row2['TotalMember']);
}

//print_r($data); die;
echo json_encode($data);


//return $this->load->view('json_view', array('json' => $data));

//print_r('json_view',array('json' => $data));die;



//return array('json' => $data);

//print_r($data);die;
//$data['value']= 'BRA0001';
//$data['address'] = 'rawarawa'

//return $data;
//return 1;
?>