<?php
	
	include "../config/koneksi.php";

	$id_group = $_POST['id_group'];
	$id_user = $_POST['id_user'];
	$id_sesi = $_POST['id_sesi'];
	
	$query = "SELECT a.*, b.nama FROM srt_kandidat_pemilihan a LEFT JOIN srt_warga b ON a.id_user=b.id_user WHERE id_sesi_pemilihan='$id_sesi' ORDER BY id_kandidat_pemilihan ASC";
	$sql = mysqli_query($connect,$query);

	$num = mysqli_num_rows($sql);

	if($sql){
    	$response =array();
    	$response ["pemilihan"] = array();
 
	    while ($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
	        $cek['id_kandidat_pemilihan'] = $data['id_kandidat_pemilihan'];
	        $cek['id_user'] = $data['id_user'];
	        $cek['nama'] = $data['nama'];
	        $cek['visi'] = $data['visi'];
	        $cek['misi'] = $data['misi'];
	        $cek['image'] = $data['image'];
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