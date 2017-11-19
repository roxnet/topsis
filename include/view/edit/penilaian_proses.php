<?php
  $id_hasil=$_POST['id_hasil'];
  $tgl_penilaian = date("Y-m-d");
  $no_pegawai=$_POST['no_pegawai'];

  // kalo bisa sampe sini berarti datanya valid
  require_once("koneksi.php");
	   $proses1 = "insert into hasil (id_hasil, tgl_penilaian, total_penilaian, no_pegawai)
 				values ('$id_hasil','$tgl_penilaian','','$no_pegawai') ";
  $hasil = mysqli_query($db_link,$proses1); 
  if (!$hasil) {
	echo "Gagal Simpan Data Hasil ";
  } 

  ?>	

<?php 
include ("koneksi.php"); 

  
  $id_hasil=$_POST['id_hasil'];
  $id_kriteria= $_POST['id_kriteria']; 
  $nilai=$_POST['nilai'];
  $jumlahdata=count($nilai);
  
   for($x=0;$x<$jumlahdata;$x++)
    {
	 $proses2 = "insert into penilaian values ('$id_hasil','$id_kriteria[$x]','$nilai[$x]')"; 
	$hasil = mysqli_query($db_link,$proses2); 
  if (!$hasil) {
	echo "Gagal Simpan Data Penilaian ";
  } else {
    echo '<script>alert("Data Penilaian Berhasil di Simpan")</script>';
    echo '<meta HTTP-EQUIV="REFRESH" content="0; url=penilaian.php">';
	}
	 } 
	?>
