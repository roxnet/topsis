<?php
	include "koneksi.php";
	$id_kriteria				=$_POST['id_kriteria'];
	$nama_kriteria	=$_POST['nama_kriteria'];
	$atribut		=$_POST['atribut'];
	
	$sql	= 'UPDATE kriteria SET nama_kriteria="'.$nama_kriteria.'", atribut="'.$atribut.'" WHERE id_kriteria="'.$id_kriteria.'"';
	$query	= mysqli_query($db_link,$sql);
	
	if($query){
		header('location: kriteria_tampil.php');
	}
	else{
		echo 'Gagal';
	}
	
	?>