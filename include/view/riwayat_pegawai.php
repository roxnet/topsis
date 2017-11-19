<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Input Riwayat Pegawai</title>

<!--tidak boleh kosong-->
<script language="JavaScript" type="text/javascript">
    function cek(){
   	if(submit.no_pegawai.value==""){
    alert ("Nomor Pegawai Harus dipilih");
    submit.no_pegawai.focus()
    return false
    }
	if(submit.id_bagian.value==""){
    alert ("Nama Bagian Harus dipilih");
    submit.id_bagian.focus()
    return false
    }
	if(submit.tmt.value==""){
    alert ("Tanggal mulai masuk harus dipilih");
    submit.tmt.focus()
    return false
    }
    return true
    }
    </script>
<!--tidak boleh kosong-->
</head>
<body>

<form name="submit" action="riwayat_proses.php" method="post" onsubmit="return cek()" >
<center>
<h1> INPUT DATA RIWAYAT PEGAWAI</h1>
<table align="center" border="0" cellpadding="3" cellspacing="3">
 <tr>
  <td> Nama Pegawai </td>
   <td> : </td>
  	<td> <?php
		echo "<select name='no_pegawai'>";
		echo"<option>- Pilih Pegawai -</option>";
		require_once("koneksi.php");
		$sql =("select* from pegawai where no_pegawai not in (select no_pegawai from riwayat_pegawai) ");
  		$hasil = mysqli_query($db_link,$sql);
			if (!$hasil){
			die("Gagal Query Data ");}
		while($muncul = mysqli_fetch_assoc($hasil)){
			echo "<option value='{$muncul['no_pegawai']}'>{$muncul['no_pegawai']} - {$muncul['nama']}</option>";
		}
		echo "</select>";
		?> 
	</td>
 </tr>
 
 <tr>
  <td> Nama Bagian </td>
   <td> : </td>
  	<td> <?php
		echo "<select name='id_bagian'>";
		echo"<option>- Pilih Bagian -</option>";
		require_once("koneksi.php");
		$hasil =("select * from bagian order by id_bagian asc");
		$hasil = mysqli_query($db_link,$hasil);
			if (!$hasil){
			die("Gagal Query Data ");}
		while($muncul = mysqli_fetch_assoc($hasil)){
			echo "<option value='{$muncul['id_bagian']}'>{$muncul['bagian']}</option>";
		}
		echo "</select>";
		?> 
	</td>
 </tr>
 
     <tr>
  <td> Tanggal Mulai Tugas</td>
   <td> : </td>
  <td>  <select name="tanggal">
<option value="">Tanggal</option>
<?php
for($i=1; $i<=31; $i++){
echo"<option value=$i> $i </option>";
}
?>
</select>
<select name="bulan">
<option value="">Bulan</option>
<?php
	$bulan=array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
	for ($i=1;$i<13;$i++){
echo"<option value=$i> $bulan[$i] </option>";
}
?>
</select>
<select name="tahun">
<option value="">Tahun</option>
	<?php
	echo $tgl_sekarang=getdate();
	echo $tahun_sekarang=$tgl_sekarang['year'];
		$awal_tahun=((int)$tahun_sekarang)-50;
		$min_tahun=((int)$tahun_sekarang)+1;
		for ($i=$awal_tahun;$i<$min_tahun;$i++){
		echo"<option value=$i> $i </option>";
		}
	?>
</select>
</td>
 </tr>

<tr>
  <td> Status Pegawai </td>
   <td> : </td>
  <td> 
 <input type="radio" name="status" value="Pegawai">Pegawai
 <input type="radio" name="status" value="Koordinator">Koordinator 
 </td>
 </tr>

  <tr>
  <td colspan="3" align="center"><input type="submit" name="submit" value="Simpan"> 
  <input type='reset' value='Batal' name='reset' class='button'/>  </td>
  </tr>
</table>


</body>
</center>
</form>
</html>
