<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pegawai Tampil</title>
</head>

<body>
<center>
<h1><b>DAFTAR PEGAWAI MASTER</b></h1>
<table border="1" cellspacing="0"  align="center" cellspacing="0">
  <tr bgcolor="#00CC00">
    <th>&nbsp; Nomor Pegawai &nbsp; </th>
	<th>&nbsp; Pamella &nbsp; </th>
    <th>&nbsp; Nama Pegawai &nbsp; </th>
	<th> Aksi </th>
</tr>
 <tr> 
<?php /*php pembuka tabel atas*/
  include("koneksi.php");
  $sql = "select *from pegawai  order by no_pegawai";
	$hasil	= mysqli_query($db_link,$sql);
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
		."<td>{$data['pamella']}</td>"
		."<td>{$data['nama']}</td>"
		."<td align='center'><a href='detail_pegawai.php?no_pegawai={$data['no_pegawai']}'>&nbsp; Detail &nbsp;</td>";
	echo "</tr>";
}
echo '</table>';
?>

</body>
</html>
