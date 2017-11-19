<?php
	$no_pegawai = $_GET['no_pegawai'];
	include_once "koneksi.php";
	$sql = "DELETE from riwayat_pegawai where no_pegawai='$no_pegawai'";
	$hasil = mysqli_query($db_link,$sql);
	if(!$hasil){
	echo "<center>Nomor Pegawai ' $no_pegawai ' tidak dapat dihapus :</br>";
	echo "<align='center'><a href='riwayat_tampil.php'>Kembali </a>";
	}else{
	header("location:riwayat_tampil.php");}
	
?>
