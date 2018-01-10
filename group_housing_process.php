<?php

	include "config/koneksi.php";


	if(isset($_POST['action'])){

		if($_POST['action']=='add'){

			$housing = $_POST['housing'];
			$rt = $_POST['rt'];
			$rw = $_POST['rw'];
			$id_group = $_POST['id_group'];

			if($id_group>0){

				$query = "UPDATE srt_group SET id_housing='$housing', rt='$rt', rw='$rw' WHERE id_group='$id_group'";
				$sql = mysqli_query($connect,$query);

				if($sql){
					echo json_encode(array('result' => true,'msg'=>'Data berhasil diubah'));
				}else{
					echo json_encode(array('result' => false,'msg'=>'Data gagal diubah'));
				}

			}else{
				$query = "INSERT INTO srt_group VALUES('','$housing','$rt','$rw')";
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

			$query = "SELECT a.*,b.nama_housing FROM srt_group a LEFT JOIN srt_housing b ON a.id_housing = b.id_housing ORDER BY id_group ASC";
			$sql = mysqli_query($connect,$query);

			$data = array();
			while($row = mysqli_fetch_assoc($sql)){
				$data[] = $row;
			}

			echo json_encode(array('data'=>$data));

		}elseif($_GET['action']=='del'){


			$id = $_GET['id'];

			$query = "DELETE FROM srt_group WHERE id_group='$id'";
			$sql = mysqli_query($connect,$query);

			
			if($sql){
				echo json_encode(array('result' => true,'msg'=>'Data berhasil dihapus'));
			}else{
				echo json_encode(array('result' => false,'msg'=>'Data  gagal dihapus'));
			}
		}
	}


?>