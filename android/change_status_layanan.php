<?php
	
	include "../config/koneksi.php";

	$id_layanan = $_POST['id_layanan'];

	$query = "UPDATE srt_layanan SET status='2' WHERE id_layanan='$id_layanan'";
	$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));


	if($sql){
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