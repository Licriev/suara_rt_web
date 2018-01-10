<?php
	
	$host = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'srt_db';

	$base_url ="http://localhost/suara_rt";

	$connect = mysqli_connect($host,$username,$password,$db);

	if(!$connect){
		echo 'cannot connect to database!';
	}


?>