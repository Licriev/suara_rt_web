<?php
	
	include "../config/koneksi.php";

	$id_user = $_POST['id_user'];
	$nama_lengkap = $_POST['nama_lengkap'];
	$tanggal_lahir = date('Y-m-d', strtotime($_POST['tanggal_lahir']));
	$jenis_kelamin = $_POST['jenis_kelamin'];

	$query = "UPDATE srt_warga SET nama='$nama_lengkap', tanggal_lahir='$tanggal_lahir', jk='$jenis_kelamin' WHERE id_user='$id_user'";
	$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

	if($sql){
    	
	    $response['success']= true ;
	    $response['message']="Berhasil Mengubah Profile";
	    echo json_encode($response);

	}else{
		$response['success']= false ;
    	$response['message']="Terjadi Kesalahan Saat mengganti Profile";
    	echo json_encode($response);
	}


?>