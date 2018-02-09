<?php
	
	include "../config/koneksi.php";

	$id_sesi = $_POST['id_sesi'];

	$query = "SELECT a.*, b.nama, c.jumlah_suara FROM srt_suara_masuk a
                LEFT JOIN srt_warga b ON a.id_kandidat_pemilihan= b.id_user
                LEFT JOIN (SELECT COUNT(*)  as jumlah_suara, id_kandidat_pemilihan FROM srt_suara_masuk GROUP BY id_kandidat_pemilihan) c ON a.id_kandidat_pemilihan=c.id_kandidat_pemilihan
                WHERE id_sesi_pemilihan='$id_sesi'";
	$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

	$num = mysqli_num_rows($sql);

	if($num > 0){
    	$response =array();
        $response ['pemilihan'] = array();
 
        while ($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){
            $cek['id_kandidat_pemilihan'] = $data['id_kandidat_pemilihan'];
            $cek['nama'] = $data['nama'];
            $cek['total'] = $data['jumlah_suara'];
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