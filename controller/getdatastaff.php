<?php
include("connect.php");


$username = $_POST['username'];




$query = "select * from staff where username like '$username' ";

//echo $query;die;

$result = mysql_query($query);

if(mysql_num_rows($result) > 0){
	$row=mysql_fetch_array($result);

	$data['StaffID'] = $row['StaffID'];
	$data['SecurityQuestion'] = $row['SecurityQuestion'];
	//$data['Answer'] = $row['Answer'];



	echo json_encode($data);

}
else echo '0';

//print_r($data); die;



//return $this->load->view('json_view', array('json' => $data));

//print_r('json_view',array('json' => $data));die;



//return array('json' => $data);

//print_r($data);die;
//$data['value']= 'BRA0001';
//$data['address'] = 'rawarawa'

//return $data;
//return 1;
?>