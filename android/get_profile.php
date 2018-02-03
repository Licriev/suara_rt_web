<?php
	
	include "../config/koneksi.php";

	$id_user = $_POST['id_user'];

	$query = "SELECT a.*, b.*, c.*, d.* FROM srt_user a
				LEFT JOIN srt_warga b ON a.id_user = b.id_user
				LEFT JOIN srt_group c ON b.id_group = c.id_group
				LEFT JOIN srt_housing d ON c.id_housing = d.id_housing
				WHERE a.id_user='$id_user'";
	$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

	$num = mysqli_num_rows($sql);

	if($num > 0){
    	$response =array();

    	$data = mysqli_fetch_array($sql,MYSQLI_ASSOC);
 
    	$response['nama'] = $data['nama'];
    	$response['email'] = $data['email'];
    	$response['tanggal_lahir'] = date('d-m-Y', strtotime($data['tanggal_lahir']));
    	$response['alamat'] = $data['nama_housing'];
    	$response['rt'] = $data['rt'];
    	$response['rw'] = $data['rw'];
    	$response['blok'] = $data['blok'];
    	$response['no'] = $data['no'];
    	
	    $response['success']= true ;
	    $response['message']="Data Retreived";
	    echo json_encode($response);
	}else { 
		$response['success']= false ;
    	$response['message']="Something Wrong";
    	echo json_encode($response);
    }
?>
