<?php
include('koneksi.php');
  $no_pegawai			= $_POST['no_pegawai'];
  $nama					= $_POST['nama'];
  $tempat_lahir			= $_POST['tempat_lahir'];
  $tanggal_lahir		= $_POST['tahun'] . '-' . $_POST['bulan'] . '-' . $_POST['tanggal'];
  $jekel				= $_POST['jekel'];
  $agama				= $_POST['agama'];
  $status_perkawinan	= $_POST['status_perkawinan'];
  $no_telp				= $_POST['no_telp'];
  $pamella				= $_POST['pamella'];
  $tgl_masuk			= $_POST['tahun'] . '-' . $_POST['bulan'] . '-' . $_POST['tanggal'];
  $alamat				= $_POST['alamat'];

  // kalo bisa sampe sini berarti datanya valid
  $sql = "insert into pegawai (no_pegawai, nama, tempat_lahir, tanggal_lahir, jekel, agama, status_perkawinan, no_telp, pamella, tgl_masuk, alamat)
 				values
					('$no_pegawai','$nama','$tempat_lahir','$tanggal_lahir','$jekel','$agama','$status_perkawinan','$no_telp','$pamella','$tgl_masuk','$alamat') ";
  	$hasil	= mysqli_query($db_link,$sql);

  if (!$hasil) {
	echo "Gagal Simpan Data Pegawai ";
  } else {
  echo '<script>alert("Data Pegawai Berhasil di Simpan")</script>';
    echo '<meta HTTP-EQUIV="REFRESH" content="0; url=pegawai.php">';
	}

  ?>