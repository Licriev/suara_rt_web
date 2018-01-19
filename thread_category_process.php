<?php

	include "config/koneksi.php";


	if(isset($_POST['action'])){

		if($_POST['action']=='add'){

			$nama_category = $_POST['nama_category'];
			$parent_category = $_POST['parent_category'];
			$id_category = $_POST['id_category'];
			$id_icon = $_POST['id_icon'];

			if($id_category>0){

				$query = "UPDATE srt_thread_category SET nama_category='$nama_category',parent_category='$parent_category', id_icon='$id_icon' WHERE id_category='$id_category'";
				$sql = mysqli_query($connect,$query);

				if($sql){
					echo json_encode(array('result' => true,'msg'=>'Data berhasil diubah'));
				}else{
					echo json_encode(array('result' => false,'msg'=>'Data gagal diubah'));
				}

			}else{
				$query = "INSERT INTO srt_thread_category VALUES('','$nama_category','$parent_category','$id_icon')";
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

			$query = "SELECT a.*, b.* FROM srt_thread_category a LEFT JOIN srt_icon b ON b.id_icon = a.id_icon ORDER BY a.nama_category ASC";
			$sql = mysqli_query($connect,$query);

			$data = array();
			while($row = mysqli_fetch_assoc($sql)){
				$data[] = $row;
			}

			echo json_encode(array('data'=>$data));

		}elseif($_GET['action']=='del'){


			$id = $_GET['id'];

			$query = "DELETE FROM srt_thread_category WHERE id_category='$id'";
			$sql = mysqli_query($connect,$query);

			
			if($sql){
				echo json_encode(array('result' => true,'msg'=>'Data berhasil dihapus'));
			}else{
				echo json_encode(array('result' => false,'msg'=>'Data  gagal dihapus'));
			}
		}
	}


?>