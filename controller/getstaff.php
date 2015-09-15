<?php
include("connect.php");

//$data = array('address' => 'rawarawa' , 'value'=>'BRA0001');

//$data = array();

$data['StaffID'] = array();
$data['StaffName'] = array();

$query = "select StaffID,StaffName from staff";

$result = mysql_query($query);

while($row=mysql_fetch_array($result)){
	//print_r($row);
	
	//$row['BranchID']
	//echo $row['BranchAddress'];
	//array_push($data['address'], $row['BranchAddress']);
	//array_push($data['value'], $row['BranchID']);
	
	array_push($data['StaffID'], $row['StaffID']);
	array_push($data['StaffName'], $row['StaffName']);

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