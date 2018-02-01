<h3><i class="fa fa-angle-right"></i> Management Konten</h3>

<?php
include 'config/koneksi.php';



	$query = "SELECT * FROM srt_thread JOIN srt_thread_content
			  ON srt_thread.id_thread = srt_thread_content.id_thread";
	$sql = mysqli_query($connect,$query);
	$data = mysqli_fetch_array($sql,MYSQLI_BOTH);
?>
<div class="row">

<div class="box">
			  
			<table class='table table-striped'>
	<thead>	
	<tr>
		<th>No</th>
		<th>Judul</th>
		<th>Isi Konten</th>
		<th>Tanggal Konten</th>

		
	</tr>
	</thead>

	<?php

$no = 1;

$count = mysqli_num_rows($sql);

if($count<1){
	echo "<tr><td colspan='9'><center>Data Tidak Ditemukan!</center></td></tr>";
}else{

	while($data=mysqli_fetch_array($sql,MYSQLI_BOTH)){


?>

	<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $data['judul']; ?></td>
			<td><?php echo $data['content']; ?></td>
			<td><?php echo $data['tanggal_post']; ?></td>

			
		</tr>

<?php
	}
}
?>
</table>
  
	</div>
</div>