<?php
  $id_kriteria= $_POST['id_kriteria']; 
  $nama_kriteria= $_POST['nama_kriteria'];
  $atribut		= $_POST['atribut'];  
 
  // kalo bisa sampe sini berarti datanya valid
  require_once("koneksi.php");
  $sql = "insert into kriteria ( id_kriteria, nama_kriteria, atribut)
 				values ('$id_kriteria','$nama_kriteria','$atribut') ";
  $hasil = mysqli_query($db_link,$sql); 
  if (!$hasil) {
	echo "Gagal Simpan Data Kriteria ";
  } else {
  echo '<script>alert("Data Keriteria Berhasil di Simpan")</script>';
    echo '<meta HTTP-EQUIV="REFRESH" content="0; url=kriteria.php">';
	}

  ?>	
