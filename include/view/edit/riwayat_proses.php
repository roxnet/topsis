<?php
 
  $no_pegawai	= $_POST['no_pegawai'];
  $id_bagian	= $_POST['id_bagian'];
  $tmt			= $_POST['tahun'] . '-' . $_POST['bulan'] . '-' . $_POST['tanggal'];
  $status		= $_POST['status'];
  

  // kalo bisa sampe sini berarti datanya valid
  require_once("koneksi.php");
  $sql = "insert into riwayat_pegawai (no_pegawai, id_bagian, tmt, status)
 				values
					('$no_pegawai','$id_bagian','$tmt','$status') ";
  $hasil = mysqli_query($db_link,$sql); 
  if (!$hasil) {
	echo "Gagal Simpan Data riwayat pegawai ";
  } else {
        echo '<script>alert("Data Riwayat Pegawai Berhasil di Simpan")</script>';
    echo '<meta HTTP-EQUIV="REFRESH" content="0; url=riwayat_pegawai.php">';
	}

  ?>	
