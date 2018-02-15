<?php

	date_default_timezone_set('Asia/Bangkok');
	include "../config/koneksi.php";

	$error = false;
	$id_layanan = 0;

	$id_group = $_POST['id_group'];
	$id_user = $_POST['id_user'];
	$nama = $_POST['nama'];
	$no_ktp = $_POST['no_ktp'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$tanggal_lahir = date('Y-m-d', strtotime($_POST['tanggal_lahir']));
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$status_pernikahan = $_POST['status_pernikahan'];
	$keperluan = $_POST['keperluan'];
	$det_keperluan = $_POST['det_keperluan'];

	$tanggal = date('Y-m-d H:i:s');


	$query = "INSERT INTO srt_layanan VALUEs('','$id_group','$id_user','$nama','$no_ktp','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$status_pernikahan','$keperluan','$det_keperluan','$tanggal','1')";
	$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));


	if(!$error){
		$id_layanan = mysqli_insert_id($connect);
    	$response =array();
    	$response ["id_layanan"] = $id_layanan;
	 
	    $response['success']= true ;
	    $response['message']="Data berhasil disimpan";
	    echo json_encode($response);
	}else { 
		$response['success']= false ;
    	$response['message']="Terjadi kesalahan saat menyimpan data";
    	echo json_encode($response);
    }
?>