<?php
	
	date_default_timezone_set("Asia/Bangkok");
	// echo date('Y-m-d H:i');
	include "../config/koneksi.php";

	$id_group = $_POST['id_group'];
	$id_user = $_POST['id_user'];
	
	$now = date('Y-m-d H:i');

	$query = "SELECT * FROM srt_sesi_pemilihan WHERE id_group='$id_group' AND tanggal_selesai>'$now'";
	$sql = mysqli_query($connect,$query);

	$num = mysqli_num_rows($sql);

	if($sql){
    	$response =array();
    	$response ["pemilihan"] = array();
 
	    while ($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
	        $cek['id_sesi_pemilihan'] = $data['id_sesi_pemilihan'];
	        $cek['periode_pemilihan'] = $data['periode_pemilihan'];
	        $cek['tanggal'] = date('d-m-Y', strtotime($data['tanggal_mulai']))." - ".date('d-m-Y', strtotime($data['tanggal_selesai']));
	        array_push($response['pemilihan'], $cek);
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