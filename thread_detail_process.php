<?php

	include "config/koneksi.php";


	if(isset($_GET['action'])){

		if($_GET['action']=='get'){

			$id=$_GET['id'];

			$query = "SELECT a.*, DATE_FORMAT(a.tanggal_post,'%d-%m-%Y') as tgl, b.nama FROM srt_thread_content a LEFT JOIN srt_warga b ON a.id_user=b.id_user WHERE id_thread='$id' ORDER BY id_content ASC LIMIT 1, 9999999";
			$sql = mysqli_query($connect,$query);

			$data = array();
			while($row = mysqli_fetch_assoc($sql)){
				$data[] = $row;
			}

			echo json_encode(array('data'=>$data));

		}elseif($_GET['action']=='del'){


			$id = $_GET['id'];

			$query = "DELETE FROM srt_thread_content WHERE id_content='$id'";
			$sql = mysqli_query($connect,$query);

			
			if($sql){
				echo json_encode(array('result' => true,'msg'=>'Data berhasil dihapus'));
			}else{
				echo json_encode(array('result' => false,'msg'=>'Data  gagal dihapus'));
			}
		}
	}


?>