<?php

	date_default_timezone_set('Asia/Bangkok');
	include "../config/koneksi.php";

	$id_thread = $_POST['thread'];
	$id_user = $_POST['user'];
	$content = $_POST['comment'];

	$tanggal = date('Y-m-d H:i:s');


	$query = "INSERT INTO srt_thread_content VALUES('','$id_thread','$id_user','$content','$tanggal')";
	$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

	if($sql){
		$last_id = mysqli_insert_id($connect);
    	$response =array();
    	$response ["id_content"] = $last_id;
	 
	    $response['success']= true ;
	    $response['message']="Data berhasil disimpan";
	    echo json_encode($response);
	}else { 
		$response['success']= false ;
    	$response['message']="Terjadi kesalahan saat menyimpan data";
    	echo json_encode($response);
    }
?>
