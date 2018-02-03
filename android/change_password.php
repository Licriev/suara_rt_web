<?php
	
	include "../config/koneksi.php";

	$id_user = $_POST['id_user'];
	$password = md5($_POST['password_lama']);
	$password_baru = md5($_POST['password_baru']);

	$query = "SELECT * FROM srt_user WHERE id_user='$id_user' AND password='$password'";
	$sql = mysqli_query($connect,$query);

	$num = mysqli_num_rows($sql);

	$response =array();
	
	if($num>0){

		$query = "UPDATE srt_user SET password='$password_baru' WHERE id_user='$id_user'";
		$sql = mysqli_query($connect,$query);

		if($sql){
	    	
		    $response['success']= true ;
		    $response['message']="Berhasil Mengubah Password";
		    echo json_encode($response);

		}else{
			$response['success']= false ;
	    	$response['message']="Terjadi Kesalahan Saat mengganti Password";
	    	echo json_encode($response);
		}

	}else{
		$response['success']= false ;
    	$response['message']="Password lama tidak cocok";
    	echo json_encode($response);
	}


?>