<?php
include('ConnectAPI.php');
include('server_IP.php');
$rolaname = $_POST['rolaname'];
$ousel = $_POST['ousel'];
$access = $_POST['access'];
if($rolaname!='' && $ousel!=''){
	$data = array(
	   "organisationUnit"  => $ousel,
		"universalRole" => $access,
		"role_name" => $rolaname 
	);
	
	$url_send ="http://".IP.":8065/api/v1/organisationRole/create";
	$str_data = json_encode($data);
	
	$connect = new ConnectAPI();
	$result = $connect->sendPostData($url_send,$str_data);
	if($result!=null){
		try{
			$responseData = json_decode($result);
			if($connect->httpResponseCode==200){
				echo "true";
			}else if($connect->httpResponseCode==0){
				echo "false";
			}
			else 
				echo $responseData->message;
		}catch(Exception $e){
			echo "Exception: ".$e->getMessage();
		}
	}
	else 
		echo "false";
}
else{	
	echo 'false';
}

?>
