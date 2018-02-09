<?php

	include "config/koneksi.php";


	if(isset($_POST['action'])){

		if($_POST['action']=='add'){

			$periode_pemilihan = $_POST['periode_pemilihan'];
			$waktu_pemilihan = $_POST['waktu_pemilihan'];
			$group_user = $_POST['group_user'];
			$user_id = $_POST['id_user'];
			$id_pemilihan = $_POST['id_pemilihan'];

			list($tanggal_mulai, $tanggal_selesai) = split(" - ", $waktu_pemilihan);
			$tanggal_mulai = date('Y-m-d H:i', strtotime($tanggal_mulai));
			$tanggal_selesai = date('Y-m-d H:i', strtotime($tanggal_selesai));


			if($id_pemilihan>0){

				$query = "UPDATE srt_sesi_pemilihan SET periode_pemilihan='$periode_pemilihan', tanggal_mulai='$tanggal_mulai', tanggal_selesai='$tanggal_selesai' WHERE id_sesi_pemilihan='$id_pemilihan'";
				$sql = mysqli_query($connect,$query);

				if($sql){
					echo json_encode(array('result' => true,'msg'=>'Data berhasil diubah'));
				}else{
					echo json_encode(array('result' => false,'msg'=>'Data gagal diubah'));
				}

			}else{
				$query = "INSERT INTO srt_sesi_pemilihan VALUES('','$periode_pemilihan','$tanggal_mulai','$tanggal_selesai','$user_id','$group_user')";
				$sql = mysqli_query($connect,$query);

				if($sql){
					echo json_encode(array('result' => true,'msg'=>'Data baru berhasil ditambah'));
				}else{
					echo json_encode(array('result' => false,'msg'=>'Data baru gagal ditambah'));
				}
			}

			

		}

	}

	if(isset($_GET['action'])){

		if($_GET['action']=='get'){

			if($_GET['group'] > 0){
				$query = "SELECT a.*, DATE_FORMAT(a.tanggal_mulai, '%d-%m-%Y %H:%i') as tgl_mulai, DATE_FORMAT(a.tanggal_selesai, '%d-%m-%Y %H:%i') as tgl_selesai  FROM srt_sesi_pemilihan a WHERE a.id_group='".$_GET['group']."' ORDER BY a.id_sesi_pemilihan DESC";				
			}else{
				$query = "SELECT a.*, DATE_FORMAT(a.tanggal_mulai, '%d-%m-%Y %H:%i') as tgl_mulai, DATE_FORMAT(a.tanggal_selesai, '%d-%m-%Y %H:%i') as tgl_selesai FROM srt_sesi_pemilihan a ORDER BY a.id_sesi_pemilihan DESC";				
			}

			$sql = mysqli_query($connect,$query);

			$data = array();
			while($row = mysqli_fetch_assoc($sql)){
				$data[] = $row;
			}

			echo json_encode(array('data'=>$data));

		}elseif($_GET['action']=='del'){


			$id = $_GET['id'];

			$query = "DELETE FROM srt_sesi_pemilihan WHERE id_sesi_pemilihan='$id'";
			$sql = mysqli_query($connect,$query);

			
			if($sql){
				echo json_encode(array('result' => true,'msg'=>'Data berhasil dihapus'));
			}else{
				echo json_encode(array('result' => false,'msg'=>'Data  gagal dihapus'));
			}
		}
	}


?>