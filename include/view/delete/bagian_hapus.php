<?php
	echo $_GET['id_bagian'];
	if(isset($_GET['id_bagian'])){
		
		$id_bagian = $_GET['id_bagian'];
		$sql = "DELETE from bagian where id_bagian='''$id_bagian''";
		$hasil = mysqli_query($db_link,$sql);
		if(!$hasil){
		echo "<center>Kode Bagian ' $id_bagian ' tidak dapat dihapus karena sudah dipakai pada <br> tabel kriteria pegawai, kriteria bagian & koordinator :</br>";
		echo "<align='center'><a href='index.php?navigasi=bagian&crud=view'>Kembali </a>";
		}else{
		header("location:index.php?navigasi=bagian&crud=view");
	}
}
?>