<?php 
// print_r($_FILES);exit;
if(isset($_FILES['pic']) && $_FILES['pic']['error'] == 0){
	$name = mt_rand(100000,999999);
	$ext = explode('.',$_FILES['pic']['name']);
	$ext = end($ext);
	$full = $name . '.' . $ext;
	$rs = move_uploaded_file($_FILES['pic']['tmp_name'],'./upload/'.$full);
	if(!$rs){
		exit('upload error');
	}

	// upload ok
	$pic = 'http://chenphp.top/upload/' . $full;
	$api = 'http://apicn.faceplusplus.com/v2/detection/detect?api_key=d85ffaa3d6e6a9f782c50eb2385aef61&api_secret=x2sOOG18KXHrCPBa8c1Eawl35WfjQ8Dg&url='.$pic.'&attribute=glass,pose,gender,age,race,smiling';
	$rs = json_decode(file_get_contents($api),true);

	if(count($rs['face']) == 0){
		exit('no face');
	}
	$face_id = $rs['face'][0]['face_id'];
}


