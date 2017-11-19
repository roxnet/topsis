<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Riwayat Pegawai Tampil</title>
</head>

<body>
<center>
<h1><b>DAFTAR PEGAWAI</b></h1>
<table border="2" cellspacing="0"  align="center" cellspacing="0">
  <tr bgcolor="00CC00">
    <th>Nomor Pegawai</th>
    <th>Nama Pegawai</th>
	<th>Nama Bagian</th>
	<th>Tanggal Mulai Tugas</th>
	<th>Aksi</th>
</tr>
 <tr>
 
<?php /*php pembuka tabel atas*/
  require_once("koneksi.php");
  $sql = "select k.no_pegawai, k.tmt, p.nama, b.bagian
  				 from riwayat_pegawai k, pegawai p, bagian b
				 where p.no_pegawai=k.no_pegawai
				 and k.status='Pegawai'
				 and b.id_bagian=k.id_bagian order by no_pegawai";
				 
  	$hasil = mysqli_query($db_link,$sql);
	if (!$hasil){
	die("Gagal Query Data ");}
	
  $no=0;
  while ($data=mysqli_fetch_array($hasil)) {
    $no++;
	if ($no % 2 == 0){
		echo "<tr style='background-color:grey'>";
	}else {
		echo "<tr style='background-color:white'>";
	}

	echo "<td align='center'>{$data['no_pegawai']}</td>"
		."<td>{$data['nama']}</td>"
		."<td>{$data['bagian']}</td>"
		."<td>".date("d-m-Y",strtotime($data['tmt']))."</td>"
		."<td align='center'><a href='biodata_pegawai.php?no_pegawai={$data['no_pegawai']}'>&nbsp; Detail &nbsp;</a>
		<a href='riwayat_hapus.php?no_pegawai={$data['no_pegawai']}' 
		onclick='return confirm(\"Yakin menghapus Data Pegawai {$data['nama']}????\");'>Hapus &nbsp;</a></td>";
	echo "</tr>";
}
echo '</table>';
?>

</body>
</html>
