<?php

	date_default_timezone_set('Asia/Bangkok');
	include "../config/koneksi.php";

	$error = false;
	$id_thread = 0;

	$judul = $_POST['judul'];
	$konten = $_POST['konten'];
	$user = $_POST['user'];
	$group = $_POST['group'];
	$category = $_POST['category'];

	$tanggal = date('Y-m-d H:i:s');


	$query = "INSERT INTO srt_thread VALUEs('','$category','$group','$user','$judul','$tanggal')";
	$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

	if($sql){
		$id_thread = mysqli_insert_id($connect);

		$query = "INSERT INTO srt_thread_content VALUES('','$id_thread','$user','$konten','$tanggal')";
		$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

		if(!$sql){
			$error=true;
		}	 

	}else{
		$error=true;
	}

	if(!$error){
    	$response =array();
    	$response ["id_thread"] = $id_thread;
	 
	    $response['success']= true ;
	    $response['message']="Data berhasil disimpan";
	    echo json_encode($response);
	}else { 
		$response['success']= false ;
    	$response['message']="Terjadi kesalahan saat menyimpan data";
    	echo json_encode($response);
    }
?>