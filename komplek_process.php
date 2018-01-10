<?php

	include "config/koneksi.php";


	if(isset($_POST['action'])){

		if($_POST['action']=='add'){

			$nama_housing = $_POST['nama_housing'];
			$kota = $_POST['kota'];
			$kelurahan = $_POST['kelurahan'];
			$kecamatan = $_POST['kecamatan'];
			$id_housing = $_POST['id_housing'];

			if($id_housing>0){

				$query = "UPDATE srt_housing SET nama_housing='$nama_housing', id_kota='$kota',kelurahan='$kelurahan',kecamatan='$kecamatan' WHERE id_housing='$id_housing'";
				$sql = mysqli_query($connect,$query);

				if($sql){
					echo json_encode(array('result' => true,'msg'=>'Data berhasil diubah'));
				}else{
					echo json_encode(array('result' => false,'msg'=>'Data gagal diubah'));
				}

			}else{
				$query = "INSERT INTO srt_housing VALUES('','$nama_housing','$kota','$kelurahan','$kecamatan')";
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

			$query = "SELECT a.*,b.nama_kota FROM srt_housing a LEFT JOIN srt_kota b ON a.id_kota = b.id_kota ORDER BY nama_housing ASC";
			$sql = mysqli_query($connect,$query);

			$data = array();
			while($row = mysqli_fetch_assoc($sql)){
				$data[] = $row;
			}

			echo json_encode(array('data'=>$data));

		}elseif($_GET['action']=='del'){


			$id = $_GET['id'];

			$query = "DELETE FROM srt_housing WHERE id_housing='$id'";
			$sql = mysqli_query($connect,$query);

			
			if($sql){
				echo json_encode(array('result' => true,'msg'=>'Data berhasil dihapus'));
			}else{
				echo json_encode(array('result' => false,'msg'=>'Data  gagal dihapus'));
			}
		}
	}


?>