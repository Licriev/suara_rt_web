<?php
	
	include "../config/koneksi.php";

	date_default_timezone_set("Asia/Bangkok");
	$now = date('Y-m-d H:i');

	$kode = $_POST['kode'];
	$id_user = $_POST['id_user'];
	$id_kandidat_pemilihan = $_POST['id_kandidat'];
	$id_sesi = $_POST['id_sesi'];

	$query = "SELECT * FROM srt_suara_masuk WHERE id_user='$id_user' AND id_sesi_pemilihan='$id_sesi'";
	$sql = mysqli_query($connect,$query);

	$nums = mysqli_num_rows($sql);

	if($nums>0){
		$response['success']= false ;
    	$response['message']="Anda sudah melakukan voting, tidak dapat melakukan voting dua kali";
    	echo json_encode($response);
	}else{

		$query = "SELECT * FROM srt_kode_verifikasi WHERE kode='$kode' AND id_user='$id_user' AND expired>'$now'";
		$sql = mysqli_query($connect,$query);

		$numb = mysqli_num_rows($sql);

		if($numb>0){

			$query = "INSERT INTO srt_suara_masuk VALUES('','$id_user','$id_kandidat_pemilihan','$id_sesi')";
			$sql = mysqli_query($connect,$query);

			if($sql){
				$response['success']= true ;
		    	$response['message']="Voting sudah berhasil masuk";
		    	echo json_encode($response);
			}
		}else{
			$response['success']= false ;
    		$response['message']="Kode Verifikasi Anda salah";
    		echo json_encode($response);
		}

	}
	

?>