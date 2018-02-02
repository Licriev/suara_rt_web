<?php
	
	include "../config/koneksi.php";

	$id_layanan = $_POST['id_layanan'];

	$query = "SELECT * FROM srt_layanan WHERE id_layanan='$id_layanan'";
	$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

	$num = mysqli_num_rows($sql);

	if($num > 0){
    	$response =array();

    	$data = mysqli_fetch_array($sql,MYSQLI_ASSOC);
 
    	$response['nama_lengkap'] = $data['nama'];
    	$response['nomor_ktp'] = $data['nomor_ktp'];
    	$response['tempat_lahir'] = $data['tempat_lahir'];
    	$response['tanggal_lahir'] = date('d-m-Y', strtotime($data['tanggal_lahir']));
    	$response['jenis_kelamin'] = $data['jenis_kelamin'];
    	$response['status_pernikahan'] = $data['status_pernikahan'];
    	$response['keperluan'] = $data['keperluan'];
    	$response['detail_keperluan'] = $data['detail_keperluan'];
    	$response['tanggal'] = date('d-m-Y',strtotime($data['tanggal']));
    	$response['status_layanan'] = ($data['status']==1 ? "Pending" : "Selesai");
    	$response['status_layanan_num'] = $data['status'];

	    $response['success']= true ;
	    $response['message']="Data Retreived";
	    echo json_encode($response);
	}else { 
		$response['success']= false ;
    	$response['message']="Something Wrong";
    	echo json_encode($response);
    }
?>