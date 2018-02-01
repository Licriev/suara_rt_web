<?php
	
	include "../config/koneksi.php";

	$id_group = $_POST['id_group'];
	$id_user = $_POST['id_user'];
	$jenis_warga = $_POST['jenis_warga'];

	if($jenis_warga > 0){
		$query = "SELECT * FROM srt_layanan WHERE id_group='$id_group'";
	}else{
		$query = "SELECT * FROM srt_layanan WHERE id_user='$id_user'";
	}
	
	$sql = mysqli_query($connect,$query);

	$num = mysqli_num_rows($sql);

	if($num > 0){
    	$response =array();
    	$response ["layanan"] = array();
 
	    while ($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
	        $cek['id_layanan'] = $data['id_layanan'];
	        $cek['nama'] = $data['nama'];
	        $cek['nomor_ktp'] = $data['nomor_ktp'];
	        $cek['tanggal'] = date('d-m-Y', strtotime($data['tanggal']));
	        $cek['status_layanan'] = ($data['status']==1 ? "Pending" : "Selesai");
	        array_push($response['layanan'], $cek);
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