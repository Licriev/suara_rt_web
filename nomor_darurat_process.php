<?php

	include "config/koneksi.php";


	if(isset($_POST['action'])){

		if($_POST['action']=='add'){

			$nama_kontak = $_POST['nama_kontak'];
			$telp = $_POST['telp'];
			$id_group = $_POST['id_group'];
			$id_emergency = $_POST['id_emergency'];

			if($id_emergency>0){

				$query = "UPDATE srt_emergency SET nama_kontak='$nama_kontak', telp='$telp' WHERE id_emergency='$id_emergency'";
				$sql = mysqli_query($connect,$query);

				if($sql){
					echo json_encode(array('result' => true,'msg'=>'Data berhasil diubah'));
				}else{
					echo json_encode(array('result' => false,'msg'=>'Data gagal diubah'));
				}

			}else{
				$query = "INSERT INTO srt_emergency VALUES('','$id_group','$nama_kontak','$telp')";
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
				$query = "SELECT * FROM srt_emergency WHERE id_group='".$_GET['group']."' ORDER BY nama_kontak ASC";				
			}else{
				$query = "SELECT * FROM srt_emergency ORDER BY nama_kontak ASC";				
			}

			$sql = mysqli_query($connect,$query);

			$data = array();
			while($row = mysqli_fetch_assoc($sql)){
				$data[] = $row;
			}

			echo json_encode(array('data'=>$data));

		}elseif($_GET['action']=='del'){


			$id = $_GET['id'];

			$query = "DELETE FROM srt_emergency WHERE id_emergency='$id'";
			$sql = mysqli_query($connect,$query);

			
			if($sql){
				echo json_encode(array('result' => true,'msg'=>'Data berhasil dihapus'));
			}else{
				echo json_encode(array('result' => false,'msg'=>'Data  gagal dihapus'));
			}
		}
	}


?>