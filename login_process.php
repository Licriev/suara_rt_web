<?php

	session_start();

	include "config/koneksi.php";

	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$token = $_POST['token'];

	if('swrrt'==$token){
		$query = "SELECT * FROM srt_user WHERE email='$email' AND password='$password' limit 1";
		$sql = mysqli_query($connect,$query);

		$count = mysqli_num_rows($sql);

		if($count>0){

			$data = mysqli_fetch_array($sql,MYSQLI_ASSOC);

			if($data['role']==1){

				$query = "SELECT * FROM srt_warga WHERE id_user='". $data['id_user'] ."'";
				$sql = mysqli_query($connect,$query);

				$data_rt = mysqli_fetch_array($sql,MYSQLI_ASSOC);

				$_SESSION['login_usr'] = true;
				$_SESSION['user_id_usr'] = $data['id_user'];
				$_SESSION['email_usr'] = $data['email'];
				$_SESSION['role_usr'] =	$data['role'];
				$_SESSION['nama_usr'] = $data_rt['nama'];
				$_SESSION['id_warga_usr'] = $data_rt['id_warga'];

				header("location:".$base_url);
			}else{
				$query = "SELECT * FROM srt_warga WHERE id_user='". $data['id_user'] ."'";
				$sql = mysqli_query($connect,$query);

				$data_rt = mysqli_fetch_array($sql,MYSQLI_ASSOC);

				if($data_rt['type']==1){
					$_SESSION['login_usr'] = true;
					$_SESSION['user_id_usr'] = $data['id_user'];
					$_SESSION['email_usr'] = $data['email'];
					$_SESSION['role_usr'] =	$data['role'];
					$_SESSION['nama_usr'] = $data_rt['nama'];
					$_SESSION['id_warga_usr'] = $data_rt['id_warga'];
					$_SESSION['id_group_usr'] = $data_rt['id_group'];

					header("location:".$base_url);
				}else{
					$_SESSION['notice']		= "Gagal Login!";
					$_SESSION['notice_msg']	= "Hanya ketua RT yang dapat masuk!";

					header("location:login.php");
				}
			}

		}else{

			$_SESSION['notice']		= "Gagal Login!";
			$_SESSION['notice_msg']	= "Username atau password salah, silahkan mencoba kembali";

			header("location:login.php");

		}
	}

?>