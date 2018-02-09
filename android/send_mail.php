<?php

include "../config/koneksi.php";

date_default_timezone_set("Asia/Bangkok");

$id_user = $_POST['id_user'];

$code = sprintf("%06d", mt_rand(1, 999999));

$expire = date('Y-m-d H:i',strtotime("+10 minutes"));

$query = "INSERT INTO srt_kode_verifikasi VALUES('','$code','$expire')";
$sql = mysqli_query($connect,$query);

$query = "SELECT * FROM srt_user WHERE id_user='$id_user'";
$sql = mysqli_query($connect,$query);

$data = mysqli_fetch_array($sql,MYSQLI_ASSOC);


$to = "embowth@gmail.com";
$subject = "HTML email";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>Kode Verifikasi Anda Adalah</p>
<table>
<tr>
<th>$code</th>
</tr>

</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@suara_rt.dev>' . "\r\n";

mail($to,$subject,$message,$headers);
?>