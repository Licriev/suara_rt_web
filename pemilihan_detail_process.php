<?php

	include "config/koneksi.php";


	if(isset($_POST['action'])){

		if($_POST['action']=='add'){

			$kandidat = $_POST['kandidat_pemilihan'];
			$visi = $_POST['visi'];
			$misi = $_POST['misi'];
			$id_sesi = $_POST['id_sesi_pemilihan'];
			$id_kandidat = $_POST['id_kandidat'];

			if($id_kandidat>0){


			}else{

				$target_dir = "uploads/";
				$target_file = $target_dir . rand() . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
				    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				    if($check !== false) {
				        echo "File is an image - " . $check["mime"] . ".";
				        $uploadOk = 1;
				    } else {
				        echo "File is not an image.";
				        $uploadOk = 0;
				    }
				}
				// Check if file already exists
				if (file_exists($target_file)) {
				    echo "Sorry, file already exists.";
				    $uploadOk = 0;
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 500000) {
				    echo "Sorry, your file is too large.";
				    $uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				        
				    	$query = "INSERT INTO srt_kandidat_pemilihan VALUES('','$id_sesi','$kandidat','$visi','$misi','$target_file')";
				    	$sql = mysqli_query($connect,$query);

				    	if($sql){
				    		echo json_encode(array('result' => true,'msg'=>'Data baru berhasil ditambah'));
				    	}else{
				    		echo json_encode(array('result' => false,'msg'=>'Data baru gagal ditambah'));
				    	}

				    } else {
				        echo "Sorry, there was an error uploading your file.";
				    }
				}
				

				
			}

			

		}

		if($_POST['action']=="edit"){

			$visi = $_POST['visi'];
			$misi = $_POST['misi'];
			$id_kandidat_pemilihan = $_POST['id_kandidat_pemilihan'];

			$query = "UPDATE srt_kandidat_pemilihan SET visi='$visi', misi='$misi' WHERE id_kandidat_pemilihan='$id_kandidat_pemilihan'";
			$sql = mysqli_query($connect,$query);

			if($sql){
				echo json_encode(array('result' => true,'msg'=>'Data baru berhasil ditambah'));
			}else{
				echo json_encode(array('result' => false,'msg'=>'Data baru gagal ditambah'));
			}

		}

		if($_POST['action']=="edit_img"){
			$target_dir = "uploads/";
				$target_file = $target_dir . rand() . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
				    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				    if($check !== false) {
				        echo "File is an image - " . $check["mime"] . ".";
				        $uploadOk = 1;
				    } else {
				        echo "File is not an image.";
				        $uploadOk = 0;
				    }
				}
				// Check if file already exists
				if (file_exists($target_file)) {
				    echo "Sorry, file already exists.";
				    $uploadOk = 0;
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 500000) {
				    echo "Sorry, your file is too large.";
				    $uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				        
				    	$query = "UPDATE srt_kandidat_pemilihan SET image='$target_file' WHERE id_kandidat_pemilihan='".$_POST['id_kandidat_img']."'";
				    	$sql = mysqli_query($connect,$query);

				    	if($sql){
				    		echo json_encode(array('result' => true,'msg'=>'Data baru berhasil ditambah'));
				    	}else{
				    		echo json_encode(array('result' => false,'msg'=>'Data baru gagal ditambah'));
				    	}

				    } else {
				        echo "Sorry, there was an error uploading your file.";
				    }
				}
		}

	}

	if(isset($_GET['action'])){

		if($_GET['action']=='get'){

			$id_sesi = $_GET['sesi'];

			$query = "SELECT a.*, b.nama, c.jumlah_suara FROM srt_kandidat_pemilihan a 
			LEFT JOIN srt_warga b ON a.id_user=b.id_user
			LEFT JOIN (SELECT COUNT(*)  as jumlah_suara, id_kandidat_pemilihan FROM srt_suara_masuk GROUP BY id_kandidat_pemilihan) c ON a.id_kandidat_pemilihan=c.id_kandidat_pemilihan
			WHERE id_sesi_pemilihan='$id_sesi'";

			$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

			$data = array();
			while($row = mysqli_fetch_assoc($sql)){
				$data[] = $row;
			}

			echo json_encode(array('data'=>$data));

		}elseif($_GET['action']=='del'){


			$id = $_GET['id'];

			$query = "DELETE FROM srt_kandidat_pemilihan WHERE id_kandidat_pemilihan='$id'";
			$sql = mysqli_query($connect,$query);

			
			if($sql){
				echo json_encode(array('result' => true,'msg'=>'Data berhasil dihapus'));
			}else{
				echo json_encode(array('result' => false,'msg'=>'Data  gagal dihapus'));
			}
		}
	}


?>