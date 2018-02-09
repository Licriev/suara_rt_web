<?php

	include "config/koneksi.php";


	if(isset($_POST['action'])){

		if($_POST['action']=='add'){

			$nama = $_POST['nama'];
			$email = $_POST['email'];
			$jk = $_POST['jk'];
			$tanggal_lahir = $_POST['tanggal_lahir'];
			$blok = $_POST['blok'];
			$no = $_POST['no_rumah'];
			$group = $_POST['group_housing'];
			$role = $_POST['role'];
			$ketua_rt = $_POST['ketua_rt'];
			$id_warga = $_POST['id_warga'];

			$password = md5($tanggal_lahir);
			$tanggal_lahir = date('Y-m-d',strtotime($tanggal_lahir));

			$query = "SELECT email FROM srt_user WHERE email='$email' LIMIT 1";
			$sql = mysqli_query($connect,$query);

			$num = mysqli_num_rows($sql);

			if($num>0){
				echo json_encode(array('result' => false,'msg'=>'Gagal menambahkan data, email sudah terdaftar!'));
			}else{
				$query = "INSERT INTO srt_user VALUES('','$email','$password','$role','1')";
				$sql = mysqli_query($connect,$query);

				$id_user = mysqli_insert_id($connect);

				$query = "INSERT INTO srt_warga VALUES('','$id_user','$nama','$jk','$tanggal_lahir','$blok','$no','$group','$ketua_rt')";
				$sql = mysqli_query($connect,$query);
				if($sql){
					echo json_encode(array('result' => true,'msg'=>'Data baru berhasil ditambah'));
				}else{
					echo json_encode(array('result' => false,'msg'=>'Data baru gagal ditambah'));
				}
			}	

		}elseif($_POST['action']=='edit'){
			$nama = $_POST['nama'];
			$jk = $_POST['jk'];
			$tanggal_lahir = date('Y-m-d',strtotime($_POST['tanggal_lahir']));
			$blok = $_POST['blok'];
			$no = $_POST['no_rumah'];
			$group = $_POST['group_housing'];
			$ketua_rt = $_POST['ketua_rt'];
			$id_warga = $_POST['id_warga'];

			if($ketua_rt==1){
				$query = "UPDATE srt_warga SET type='0' WHERE id_group='$group'";
				$sql = mysqli_query($connect,$query);
			}

			$query = "UPDATE srt_warga SET nama='$nama', jk='$jk',tanggal_lahir='$tanggal_lahir',blok='$blok',no='$no',id_group='$group',type='$ketua_rt' WHERE id_warga='$id_warga'";
			$sql = mysqli_query($connect,$query);

			if($sql){
				echo json_encode(array('result' => true,'msg'=>'Data berhasil diubah'));
			}else{
				echo json_encode(array('result' => false,'msg'=>'Data gagal diubah'));
			}
		}elseif ($_POST['action']=='editlogin') {
			$email = $_POST['email'];
			$role = $_POST['role'];
			$id_user = $_POST['id_user'];

			$update = true;

			$query = "SELECT * FROM srt_user WHERE email='$email' LIMIT 1";
			$sql = mysqli_query($connect,$query);

			$data = mysqli_fetch_array($sql,MYSQLI_ASSOC);

			if($data['email']==$email && $data['id_user']==$id_user){
				$query = "UPDATE srt_user SET role='$role' WHERE id_user='$id_user'";
				$sql = mysqli_query($connect,$query);

				if($sql){
					echo json_encode(array('result' => true,'msg'=>'Data berhasil diubah'));
				}else{
					echo json_encode(array('result' => false,'msg'=>'Data gagal diubah'));
				}
			}elseif($data['email']==$email && $data['id_user']!=$id_user){
				echo json_encode(array('result' => false,'msg'=>'Gagal menambahkan data, email sudah terdaftar!'));
			}else{
				$query = "UPDATE srt_user SET email='$email',role='$role' WHERE id_user='$id_user'";
				$sql = mysqli_query($connect,$query);

				if($sql){
					echo json_encode(array('result' => true,'msg'=>'Data berhasil diubah'));
				}else{
					echo json_encode(array('result' => false,'msg'=>'Data gagal diubah'));
				}
			}

		}elseif($_POST['action']=='reset'){

			$id_user = $_POST['id_user'];

			$query = "SELECT tanggal_lahir FROM srt_warga WHERE id_user='$id_user' LIMIT 1";
			$sql = mysqli_query($connect,$query);

			if($sql){
				$data = mysqli_fetch_array($sql,MYSQLI_ASSOC);

				$passwd = md5(date('d-m-Y',strtotime($data['tanggal_lahir'])));

				$query = "UPDATE srt_user SET password='$passwd' WHERE id_user='$id_user'";
				$sql = mysqli_query($connect,$query);


				if($sql){
					echo json_encode(array('result' => true,'msg'=>'Reset password berhasil'));
				}else{
					echo json_encode(array('result' => false,'msg'=>'Reset password tidak berhasil'));
				}

			}else{
				echo json_encode(array('result' => false,'msg'=>'Reset password tidak berhasil!'));
			}		

		}elseif($_POST['action']=='check_type'){

			$id = $_POST['id_user'];

			$query = "SELECT type FROM srt_warga WHERE id_user='$id'";
			$sql = mysqli_query($connect,$query);

			$data = mysqli_fetch_array($sql,MYSQLI_ASSOC);
			echo json_encode(array('result'=>true, 'type'=>$data['type']));
		}

	}

	if(isset($_GET['action'])){

		if($_GET['action']=='get'){

			if($_GET['group']>0){
				$query = "SELECT a.*,DATE_FORMAT(a.tanggal_lahir,'%d-%m-%Y') as tgl_lahir,b.email,b.role,c.rt,c.rw,d.nama_housing 
							FROM srt_warga a 
							LEFT JOIN srt_user b ON a.id_user = b.id_user
							LEFT JOIN srt_group c ON a.id_group = c.id_group
							LEFT JOIN srt_housing d ON d.id_housing = c.id_housing
							WHERE a.id_group = '". $_GET['group'] ."' 
							ORDER BY id_warga ASC";
			}else{				
				$query = "SELECT a.*,DATE_FORMAT(a.tanggal_lahir,'%d-%m-%Y') as tgl_lahir,b.email,b.role,c.rt,c.rw,d.nama_housing 
							FROM srt_warga a 
							LEFT JOIN srt_user b ON a.id_user = b.id_user
							LEFT JOIN srt_group c ON a.id_group = c.id_group
							LEFT JOIN srt_housing d ON d.id_housing = c.id_housing 
							ORDER BY id_warga ASC";
			}
			$sql = mysqli_query($connect,$query);

			$data = array();
			while($row = mysqli_fetch_assoc($sql)){
				$data[] = $row;
			}

			echo json_encode(array('data'=>$data));

		}elseif($_GET['action']=='del'){


			$id = $_GET['id'];

			$query = "DELETE FROM srt_group WHERE id_warga='$id'";
			$sql = mysqli_query($connect,$query);

			
			if($sql){
				echo json_encode(array('result' => true,'msg'=>'Data berhasil dihapus'));
			}else{
				echo json_encode(array('result' => false,'msg'=>'Data  gagal dihapus'));
			}
		}
	}


?>