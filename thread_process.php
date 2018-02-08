<?php

	include "config/koneksi.php";


	if(isset($_GET['action'])){

		if($_GET['action']=='get'){

			$category = ($_POST['rt_kategori'] > 0 ? $_POST['rt_kategori'] : "");
			$group = ($_POST['rt_housing'] > 0 ? $_POST['rt_housing'] : "");

			if($category!="" && $group!=""){
				$query = "SELECT a.*, DATE_FORMAT(a.tanggal_post,'%d-%m-%Y') as tgl, b.nama, c.nama_category FROM srt_thread a LEFT JOIN srt_warga b ON b.id_user = a.id_user LEFT JOIN srt_thread_category c ON a.id_category=c.id_category WHERE a.id_category='$category' AND a.id_group='$group' ORDER BY a.tanggal_post ASC";
			}elseif($category!=""){
				$query = "SELECT a.*, DATE_FORMAT(a.tanggal_post,'%d-%m-%Y') as tgl, b.nama, c.nama_category FROM srt_thread a LEFT JOIN srt_warga b ON b.id_user = a.id_user LEFT JOIN srt_thread_category c ON a.id_category=c.id_category WHERE a.id_category='$category' ORDER BY a.tanggal_post ASC";
			}elseif($group!==""){
				$query = "SELECT a.*, DATE_FORMAT(a.tanggal_post,'%d-%m-%Y') as tgl, b.nama, c.nama_category FROM srt_thread a LEFT JOIN srt_warga b ON b.id_user = a.id_user LEFT JOIN srt_thread_category c ON a.id_category=c.id_category WHERE a.id_group='$group' ORDER BY a.tanggal_post ASC";
			}else{
				$query = "SELECT a.*, DATE_FORMAT(a.tanggal_post,'%d-%m-%Y') as tgl, b.nama, c.nama_category FROM srt_thread a LEFT JOIN srt_warga b ON b.id_user = a.id_user LEFT JOIN srt_thread_category c ON a.id_category=c.id_category ORDER BY a.tanggal_post ASC";
			}

			$sql = mysqli_query($connect,$query);

			$data = array();
			while($row = mysqli_fetch_assoc($sql)){
				$data[] = $row;
			}

			echo json_encode(array('data'=>$data));

		}elseif($_GET['action']=='del'){


			$id = $_GET['id'];

			$query = "DELETE FROM srt_thread WHERE id_thread='$id'";
			$sql = mysqli_query($connect,$query);

			
			if($sql){
				echo json_encode(array('result' => true,'msg'=>'Data berhasil dihapus'));
			}else{
				echo json_encode(array('result' => false,'msg'=>'Data  gagal dihapus'));
			}
		}
	}


?>