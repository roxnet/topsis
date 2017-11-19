<?php
	$id_kriteria = $_GET['id_kriteria'];
	include_once "koneksi.php";
	$sql = "DELETE from kriteria where id_kriteria='$id_kriteria'";
	$hasil = mysqli_query($db_link,$sql);
	if(!$hasil){
	echo "<center>ID Kriteria ' $id_kriteria ' tidak dapat dihapus :</br>";
	echo "<align='center'><a href='kriteria_tampil.php'>Kembali </a>";
	}else{
	header("location:kriteria_tampil.php");}
	
?>
