<?php
	
	include "../config/koneksi.php";

	$group = $_POST['group'];
	$category = $_POST['category'];

	$page = $_POST['page'];

	if($page=="archive"){

		$query = "SELECT a.*, b.nama as sender FROM srt_thread a
					LEFT JOIN srt_warga b ON a.id_user = b.id_user
					WHERE a.id_category='$category' AND a.id_group='$group'
					AND datediff(current_date,date(tanggal_post)) >  30
					ORDER BY id_thread DESC";

	}else{

		$query = "SELECT a.*, b.nama as sender FROM srt_thread a
					LEFT JOIN srt_warga b ON a.id_user = b.id_user
					WHERE a.id_category='$category' AND a.id_group='$group'
					AND tanggal_post BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
					ORDER BY id_thread DESC";

	}
	$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

	$num = mysqli_num_rows($sql);

	if($num > 0){
    	$response =array();
    	$response ["listinfo"] = array();
 
	    while ($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
	        $cek['id_thread'] = $data['id_thread'];
	        $cek['id_user'] = $data['id_user'];
	        $cek['sender'] = $data['sender'];
	        $cek['judul'] = $data['judul'];
	        $cek['tanggal_post'] = date('d-m-Y H:i',strtotime($data['tanggal_post']));
	        array_push($response['listinfo'], $cek);
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