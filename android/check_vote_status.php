<?php
	
	include "../config/koneksi.php";

    $id_user = $_POST['id_user'];
	$id_sesi = $_POST['id_sesi'];

	$query = "SELECT * FROM srt_suara_masuk WHERE id_user='$id_user' AND id_sesi_pemilihan='$id_sesi'";
	$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

	$num = mysqli_num_rows($sql);

	if($num > 0){
    	$response =array();
	    $response['success']= true ;
	    $response['message']="Data Retreived";
	    echo json_encode($response);
	}else { 
		$response['success']= false ;
    	$response['message']="Something Wrong";
    	echo json_encode($response);
    }
?>