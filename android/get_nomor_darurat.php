<?php
	
	include "../config/koneksi.php";

	$id_group = $_POST['id_group'];

	$query = "SELECT a.*,b.nama_icon FROM srt_emergency a
		LEFT JOIN srt_icon b ON a.id_icon = b.id_icon 
	 	where id_group='$id_group'";
	$sql = mysqli_query($connect,$query);

	$num = mysqli_num_rows($sql);

	if($num > 0){
    	$response =array();
    	$response ["emergency"] = array();
 
	    while ($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
	        $cek['id_emergency'] = $data['id_emergency'];
	        $cek['nama_kontak'] = $data['nama_kontak'];
	        $cek['nama_kontak'] = $data['nama_kontak'];
	        $cek['telp'] = $data['telp'];
	        $cek['icon'] = $data['nama_icon'];
	        array_push($response['emergency'], $cek);
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