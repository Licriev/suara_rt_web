<html> 

<?php

	include "config/koneksi.php";

	$bulan = array(0=>'','I','II','III','IV','V','VI','VII','VIII','IX','X','XI',"XII");

	$id_layanan = $_GET['id'];

	$query = "SELECT * FROM srt_layanan WHERE id_layanan='$id_layanan' LIMIT 1";
	$sql = mysqli_query($connect,$query);

	$data_layanan = mysqli_fetch_array($sql,MYSQLI_ASSOC);

	$query = "SELECT * FROM srt_group WHERE id_group='".$data_layanan['id_group']."' LIMIT 1";
	$sql = mysqli_query($connect,$query);

	$data_group = mysqli_fetch_array($sql,MYSQLI_ASSOC);

	$query = "SELECT * FROM srt_housing WHERE id_housing='".$data_group['id_housing']."' LIMIT 1";
	$sql = mysqli_query($connect,$query);

	$data_housing = mysqli_fetch_array($sql,MYSQLI_ASSOC);

	$query = "SELECT * FROM srt_kota WHERE id_kota='".$data_housing['id_kota']."' LIMIT 1";
	$sql = mysqli_query($connect,$query);

	$data_kota = mysqli_fetch_array($sql,MYSQLI_ASSOC);

	$query = "SELECT * FROM srt_warga WHERE id_user='".$data_layanan['id_user']."' LIMIT 1";
	$sql = mysqli_query($connect,$query);

	$data_warga = mysqli_fetch_array($sql,MYSQLI_ASSOC);

	$query = "UPDATE srt_layanan SET status='2' WHERE id_layanan='$id_layanan'";
	$sql = mysqli_query($connect,$query);


?>

<head>
<title>Surat Pengantar</title>
<style type="text/css">
	
	body{
		font-family: sans-serif;
	}

	@page { margin: 0; }
	@media print {
	  @page { margin: 0; }
	  body { margin: 1.6cm; }
	}

	.header-top{
		font-size: 13pt;
	}

	.header{
		font-size: 12pt;
		font-weight: bold;
	}

	.det{
		font-weight: bold;
	}
</style>
</head>

<body onload="window.print();">
<table align="center" border="0" cellpadding="1" style="width: 100%;" class="tbl-header"><tbody>
<tr>     <td colspan="3"><div align="center">
<span class="header-top"><b>PEMERINTAH KOTA <?php echo strtoupper($data_kota['nama_kota']);?></b></span>
<br>
<span class="header-top"><b>KECAMATAN <?php echo strtoupper($data_housing['kecamatan']);?> - KELURAHAN <?php echo strtoupper($data_housing['kelurahan']);?></b></span>
<br>
<span class="header-top"><b>RT <?php echo sprintf('%03d', $data_group['rt']);?> RW <?php echo sprintf('%03d', $data_group['rw']);?></b></span>
<hr />
</div>
</td>   </tr>
	<tr>     
	<td colspan="2"><table align="center" border="0" cellpadding="1" style="width: 100%;"><tbody></td>      
	</tr>

<div align="center">
<span class="header">

SURAT KETERANGAN PENGANTAR <br>
Nomor : <?php echo $data_layanan['id_layanan'];?>/SKD/<?php echo $bulan[date('n',strtotime($data_layanan['tanggal']))];?>/<?php echo date('Y',strtotime($data_layanan['tanggal']));?>
</span> 
</div>
<br>

<tr>     
	<td colspan="3" height="300" valign="top"><div align="justify">
		<span>Yang bertanda tangan dibawah ini Ketua RT. <?php echo sprintf('%03d', $data_group['rt']);?> RW. <?php echo sprintf('%03d', $data_group['rw']);?> <?php echo ucwords($data_housing['nama_housing']);?> Kelurahan <?php echo ucwords($data_housing['kelurahan']);?> Kecamatan <?php echo ucwords($data_housing['kecamatan']);?>  Kota <?php echo ucwords($data_kota['nama_kota']);?> menerangkan dengan ini sebenarnya bahwa :</span>
		
<table border="0" style="width: 100%;"><tbody>
			<tr>           
			<td width="30%"><span>Nomor KTP</span></td>
			<td><span class='det'>:<?php echo ucwords($data_layanan['nomor_ktp']);?></span></td>
			</tr>

			<tr>           
			<td><span>Nama</span></td>
			<td><span class='det'>: <?php echo ucwords($data_layanan['nama']);?></span></td>
			</tr>

			<tr>           
			<td><span>Tempat Tanggal Lahir </span></td>
			<td><span class='det'>: <?php echo ucwords($data_layanan['tempat_lahir'].", ".date('d-m-Y',strtotime($data_layanan['tanggal_lahir'])));?></span></td>
			</tr>

			<tr>           
			<td><span>Jenis Kelamin</span></td>
			<td><span class='det'>: <?php echo ucwords($data_layanan['jenis_kelamin']);?></span></td>      
			</tr>

			<tr>
			<td><span>Status Perkawinan</span></td>
			<td><span class='det'>: <?php echo ucwords($data_layanan['status_pernikahan']);?></span></td>                        
			</tr>

			<tr>           
			<td><span>Alamat</span></td>
			<td><span class='det'>: <?php echo ucwords($data_housing['nama_housing']." Blok ".$data_warga['blok']." No. ".$data_warga['no']);?></span></td>                        
			</tr>

			<tr>           
			<td><span>Keperluan</span></td>
			<td><span class='det'>: <?php echo ucwords($data_layanan['keperluan']);?></span></td>                        
			</tr>
</tbody></table>
<br>
<div align="justify">
	<span>
	Orang tersebut diatas, memang benar adalah warga RT. <?php echo sprintf('%03d', $data_group['rt']);?> RW. <?php echo sprintf('%03d', $data_group['rw']);?> Kelurahan <?php echo ucwords($data_housing['kelurahan']);?>  Kecamatan <?php echo ucwords($data_housing['kecamatan']);?>  Kota <?php echo ucwords($data_kota['nama_kota']);?>, Demikian surat pengantar ini kami buat agar dapat dipergunakan sebagaimana mestinya dan penuh tanggung jawab.</span> 
</div>
<br>
<div align="center">
	<span>
	ketua RT <?php echo sprintf('%03d', $data_group['rt']);?> RW. <?php echo sprintf('%03d', $data_group['rw']);?></span> 
</div>
<br>
<br>
<br>
<br>
<div align="center">
	<span>
	BEKASI</span> 
</div>
</div>

</td>   
</tr>


</tbody></table></body>

<script type="text/javascript">
	window.onafterprint = function(){
		window.history.back();
	}
</script>
</html>