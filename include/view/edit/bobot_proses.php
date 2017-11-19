<?php 
include ("koneksi.php"); 

  $id_kriteria= $_POST['id_kriteria']; 
    $id_bagian = $_POST['id_bagian'];
  $bobot=$_POST['bobot'];
  $jumlahdata=count($bobot);
  
   for($x=0;$x<$jumlahdata;$x++)
    {
	 $sql = "insert into kriteria_bagian values ('$id_kriteria[$x]','$id_bagian','$bobot[$x]')"; 
	$hasil = mysqli_query($db_link,$sql); 
  if (!$hasil) {
	echo "Gagal Simpan Data Bobot Kriteria ";
  } else {
      echo '<script>alert("Data Kriteria Bagian Berhasil di Simpan")</script>';
    echo '<meta HTTP-EQUIV="REFRESH" content="0; url=bobot_tampil.php">';
	}
	 } 
	?>
