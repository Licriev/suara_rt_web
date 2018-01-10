<?php
	
	include "../config/koneksi.php";

	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$query = "SELECT a.id_user, a.email, a.role, b.id_warga, b.nama, b.id_group, b.type as jenis_warga FROM srt_user a
		LEFT JOIN srt_warga b ON a.id_user = b.id_user
	 	where email='$email' AND password='$password' LIMIT 1";
	$sql = mysqli_query($connect,$query);

	$num = mysqli_num_rows($sql);

	if($num > 0){
    	$response =array();
    	$response ["user"] = array();
 
	    while ($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
	        $cek['id_user'] = $data['id_user'];
	        $cek['nama_user'] = $data['nama'];
	        $cek['email_user'] = $data['email'];
	        $cek['role_user'] = $data['role'];
	        $cek['id_warga'] = $data['id_warga'];
	        $cek['id_group'] = $data['id_group'];
	        $cek['jenis_warga'] = $data['jenis_warga'];
	        array_push($response['user'], $cek);
	    }

	    $response['success']= true ;
	    $response['message']="login berhasil";
	    echo json_encode($response);
	}else { 
		$response['success']= false ;
    	$response['message']="maaf,terjadi kesalahan";
    	echo json_encode($response);
    }
?>