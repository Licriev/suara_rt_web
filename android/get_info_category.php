<?php
	
	include "../config/koneksi.php";

	$query = "SELECT a.*, b.nama_icon FROM srt_thread_category a
				LEFT JOIN srt_icon b ON a.id_icon = b.id_icon";
	$sql = mysqli_query($connect,$query);

	$num = mysqli_num_rows($sql);

	if($num > 0){
    	$response =array();
    	$response ["info_cat"] = array();
 
	    while ($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
	        $cek['id_category'] = $data['id_category'];
	        $cek['nama_category'] = $data['nama_category'];
	        $cek['icon'] = $data['nama_icon'];
	        array_push($response['info_cat'], $cek);
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