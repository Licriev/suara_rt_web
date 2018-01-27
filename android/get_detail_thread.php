<?php
	
	include "../config/koneksi.php";

	$id = $_POST['id_thread'];

	$query = "SELECT * FROM srt_thread WHERE id_thread='$id'";
	$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

	$num = mysqli_num_rows($sql);

	if($num > 0){
		$data_thread = mysqli_fetch_array($sql,MYSQLI_ASSOC);

		$query = "SELECT a.*, b.nama FROM srt_thread_content a 
					LEFT JOIN srt_warga b ON a.id_user=b.id_user
					WHERE a.id_thread='$id'";
		$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

		$num_det = mysqli_num_rows($sql);

		if($num_det>0){
	    	$response =array();
	    	$response ["details"] = array();
	 
		    while ($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
		        $cek['id_content'] = $data['id_content'];
		        $cek['id_user'] = $data['id_user'];
		        $cek['sender'] = $data['nama'];
		        $cek['content'] = $data['content'];
		        $cek['tanggal_post'] = date('d-m-Y H:i',strtotime($data['tanggal_post']));
		        array_push($response['details'], $cek);
		    }
		}

		$response['judul'] = $data_thread['judul'];
	    $response['success']= true ;
	    $response['message']="Data Retreived";
	    echo json_encode($response);
	}else { 
		$response['success']= false ;
    	$response['message']="Something Wrong";
    	echo json_encode($response);
    }
?>