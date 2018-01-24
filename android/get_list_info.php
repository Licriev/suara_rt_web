<?php

	include "../config/koneksi.php";

	$id_category = $_POST['category'];
	$id_group = $_POST['group'];

	$query = "SELECT a.* FROM srt_thread WHERE id_category='$id_category' AND id_group='$id_group'";
	$sql = mysqli_query($connect,$query);

	$num = mysqli_num_rows($sql);

	if($num > 0){
    	$response =array();
    	$response ["emergency"] = array();
 
	    while ($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
	        $cek['id_thread'] = $data['id_thread'];
	        $cek['id_category'] = $data['id_category'];
	        $cek['id_group'] = $data['id_group'];
	        $cek['id_user'] = $data['id_user'];
	        $cek['judul'] = $data['judul'];
	        $cek['tanggal_post'] = $data['tanggal_post'];
	        array_push($response['emergency'], $cek);
	    }

	    $response['success']= true ;
	    $response['message']="Data Retreived";
	    echo json_encode($response);
	}else { 
		$response['success']= false ;
    	$response['message']="Something Wrong";
    	echo json_encode($response);
    }

?>