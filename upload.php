<?php
$article_id = $_POST['article_id'];
include('connect_db.php');
include('tabgen_php_functions.php');
if(!empty($_FILES)) {
	if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
		$sourcePath = $_FILES['userImage']['tmp_name'];
		$targetPath = "uploaded_image/".$_FILES['userImage']['name'];
		if(move_uploaded_file($sourcePath,$targetPath)) {
			 //echo "Target: ".$targetPath;
			if($conn){
				$time=time()*1000;
				$query = "Update Article set Images='$targetPath', UpdateAt=$time where Id='$article_id'";
				if($conn->query($query)){
					//echo "<img src='".$targetPath."' width='100%' height='80%'/>";
					echo json_encode(array("status"=>true,"message"=>"Successfully uploaded..","image_path"=>$targetPath));
				}
				else{
					//echo "<center>Something went wrong.. Try again later.</center>";
					echo json_encode(array("status"=>false,"message"=>"Something went wrong.. Try again later."));
				}
			}
			else{
				echo json_encode(array("status"=>false,"message"=>"Something went wrong.. Try again later."));
			}
		}
		else{
			echo json_encode(array("status"=>false,"message"=>"Failed to upload your image. Try again later."));
		}
	}
}
else echo "No file is received....";

?>