<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Biodata Pegawai</title>
</head>

<body>
<?php /*php pembuka tabel atas*/
  require_once("koneksi.php");
  	$no_pegawai = $_GET['no_pegawai'];
  $sql = "select * from pegawai p, riwayat_pegawai r  where p.no_pegawai=r.no_pegawai and p.no_pegawai='$no_pegawai'";
  	$hasil = mysqli_query($db_link,$sql);
	$tampil=mysqli_fetch_array($hasil);
	echo'<center>';
	echo '<table border="0" >
  <tr>
    <td colspan="3" align="center">BIODATA PEGAWAI </td>
  </tr> <tr>
    <td colspan="3" height="20"> </td>
  </tr>
  <tr>
    <td width="160">Nomor Pegawai </td>
    <td width="20">:</td>
	<td> '.$tampil['no_pegawai'].' </td>
  </tr>
  <tr>
    <td>Pamella</td>
    <td>:</td>
	<td>'.$tampil['pamella'].'</td>
  </tr>
  <tr>
    <td>Tanggal Masuk </td>
    <td>:</td>
	<td>'.date("d-m-Y",strtotime($tampil['tgl_masuk'])).'</td>
  </tr>
  <tr>
    <td>Status </td>
    <td>:</td>
	<td>'.$tampil['status'].'</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>Nama</td>
    <td>:</td>
	<td>'.$tampil['nama'].'</td>
  </tr>
  <tr>
    <td>Tempat Tanggal Lahir </td>
    <td>:</td>
	<td>'.$tampil['tempat_lahir'].' , '.date("d-m-Y",strtotime($tampil['tanggal_lahir'])).'</td>
  </tr>
  <tr>
    <td>Jenis Kelamin </td>
    <td>:</td>
	<td>'.$tampil['jekel'].'</td>
  </tr>
  <tr>
    <td>Agama</td>
    <td>:</td>
	<td>'.$tampil['agama'].'</td>
  </tr>
  <tr>
    <td>Status Perkawinan </td>
    <td>:</td>
	<td>'.$tampil['status_perkawinan'].'</td>
  </tr> <tr>
    <td>Nomor Telepon </td>
    <td>:</td>
	<td>'.$tampil['no_telp'].'</td>
  </tr> <tr>
    <td>Alamat </td>
    <td>:</td>
	<td>'.$tampil['alamat'].'</td>
  </tr>
</table> ';

?>
</body>
</html>
