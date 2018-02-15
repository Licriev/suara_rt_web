<?php

	include "config/koneksi.php";


	if(isset($_POST['action'])){

		if($_POST['action']=='add'){

			

		}

	}

	if(isset($_GET['action'])){

		if($_GET['action']=='get'){

			$group = $_GET['group'];

			if($group>0){
				$query = "SELECT * FROM srt_layanan WHERE id_group='$group' ORDER BY tanggal DESC";
			}else{
				$query = "SELECT * FROM srt_layanan ORDER BY tanggal DESC";
			}

			$sql = mysqli_query($connect,$query);

			$data = array();
			while($row = mysqli_fetch_assoc($sql)){
				$data[] = $row;
			}

			echo json_encode(array('data'=>$data));

		}elseif($_GET['action']=='del'){


			$id = $_GET['id'];

			$query = "DELETE FROM srt_layanan WHERE id_layanan='$id'";
			$sql = mysqli_query($connect,$query);

			
			if($sql){
				echo json_encode(array('result' => true,'msg'=>'Data berhasil dihapus'));
			}else{
				echo json_encode(array('result' => false,'msg'=>'Data  gagal dihapus'));
			}
		}
	}


?>