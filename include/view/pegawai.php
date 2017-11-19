<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Input Pegawai</title>
</head>
<!--tidak boleh kosong-->
<script language="JavaScript" type="text/javascript">
    function cek(){
    if(submit.pamella.value==""){
    alert("Pamella harus dipilih");
    submit.pamella.focus()
    return false
    }
    if(submit.tgl_masuk.value==""){
    alert("Tanggal Masuk harus dipilih");
    submit.tgl_masuk.focus()
    return false
    }
    if(submit.nama.value==""){
    alert("Nama tidak boleh kosong");
    pegawai.nama.focus()
    return false
    }
    if(submit.tempat_lahir.value==""){
    alert("Tempat Lahir Tidak boleh kosong");
    submit.tempat_lahir.focus()
    return false
    }
    if(submit.tanggal_lahir.value==""){
    alert("Tanggal  Lahir harus dipilih");
    submit.tanggal_lahir.focus()
    return false
    }
    if(submit.jekel.value==""){
    alert ("Jenis Kelamin harus dipilih");
    submit.jekel.focus()
    return false
    }
	if(submit.agama.value==""){
    alert ("Agama harus dipilih");
    submit.agama.focus()
    return false
    }
	if(submit.status_perkawinan.value==""){
    alert ("Status Perkawinan harus dipilih");
    submit.status_perkawinan.focus()
    return false
    }
	if(submit.no_telp.value==""){
    alert ("no_telp tidak boleh kosong");
    submit.no_telp.focus()
    return false
    }
	if(submit.alamat.value==""){
    alert ("alamat tidak boleh kosong");
    submit.alamat.focus()
    return false
    }
    return true
    }
    </script>

<script language="javascript">
    function hanyaAngka(e, decimal) {
    var key;
    var keychar;
     if (window.event) {
         key = window.event.keyCode;
     } else if (e) {
         key = e.which;
     } else return true;
  
    keychar = String.fromCharCode(key);
    if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
        return true;
    } else
    if ((("0123456789").indexOf(keychar) > -1)) {
        return true;
    } else
    if (decimal && (keychar == ".")) {
        return true;
    } else return false;
    }
   
    function huruf(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
            return false;
        return true;
    }
</script>
<body>
		<script>
 jQuery(document).ready(function(){
  jQuery("#formID").validationEngine();
 });
</script>

		<!--validasi alamat -->
			<script language=JavaScript>
				function check_length(my_form)
					{
					maxLen = 40; 
					if (my_form.alamat.value.length >= maxLen) {
					var msg = "Jumlah Karakter dibatasi maksimal 40";
					alert(msg);
					my_form.alamat.value = my_form.alamat.value.substring(0, maxLen);
					 }
					else{ 
					my_form.text_num.value = maxLen - my_form.alamat.value.length;
					}
					}
			</script>
			<!--validasi alamat -->
<form name="submit" action="pegawai_proses.php" method="post" onsubmit="return cek()">
	<center>
<h1> INPUT DATA PEGAWAI</h1>
<table align="center" border="0" cellpadding="3" cellspacing="3">
 <tr>
  <td> Nomor Pegawai </td>
  <td> : </td>
  <td>  <input  type="text" name="no_pegawai" size="10"/> </td>
  </tr>
  
   <tr>
  <td> Pamella </td>
   <td> : </td>
  <td> <select name="pamella">  
 			<option value="">- Pilih Pamella -</option>  
 			<option value="Pamella 1">Pamella 1</option>  
			<option value="Pamella 2">Pamella 2</option>  
 			<option value="Pamella 3">Pamella 3</option>  
			<option value="Pamella 4">Pamella 4</option>  
 			<option value="Pamella 5">Pamella 5</option>  
 		</select>   </td>
 </tr>
 
   <tr>
  <td> Tanggal Masuk </td>
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
 
 <tr height="30">
 <td> </td>
 </tr>
 
  <tr>
  <td> Nama Pegawai </td>
   <td> : </td>
  <td> <input  type="text" name="nama"  size="40" maxlength="35" onkeypress="return huruf(event)" />  </td>
 </tr>
 
  <tr>
  <td> Tempat Lahir </td>
   <td> : </td>
  <td><input type="text" name="tempat_lahir" size="25" maxlength="25" onkeypress="return huruf(event)" /></td>
 </tr>
 
   <tr>
  <td> Tanggal Lahir </td>
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
		$awal_tahun=((int)$tahun_sekarang)-35;
		$min_tahun=((int)$tahun_sekarang)-16;
		for ($i=$awal_tahun;$i<$min_tahun;$i++){
		echo"<option value=$i> $i </option>";
		}
	?>
</select>
</td>
 </tr>

<tr>
  <td> Jenis Kelamin </td>
   <td> : </td>
  <td> 
 <input type="radio" name="jekel" value="L">Laki laki 
 <input type="radio" name="jekel" value="P">Perempuan 
 </td>
 </tr>
 
 <tr>
  <td> Agama </td>
   <td> : </td>
  	<td>  <select name="agama">  
 			<option value="">- Pilih Agama -</option>  
 			<option value="Islam">Islam</option>  
			 <option value="Kristen">Kristen</option>  
 			<option value="Katolik">Katolik</option>  
			<option value="Hindu">Hindu</option>  
 			<option value="Budha">Budha</option>  
 		</select>   
	</td>
 </tr>
 <tr>
  <td> Status Perkawinan </td>
   <td> : </td>
  <td>
 <select name="status_perkawinan">  
 			<option value="">- Pilih status perkawinan -</option>  
 			<option value="Kawin">Kawin</option>  
			 <option value="Belum kawin">Belum kawin</option>  
 			<option value="Cerei hidup">Cerei hidup</option>  
			<option value="Cerei mati">Cerei mati</option>  
 		</select>      
</td>
 </tr>

<tr>
  <td> No. Telepon </td>
   <td> : </td> 
  <td> <input type="text" name="no_telp" size="15" maxlength="13" onkeypress="return hanyaAngka(event, false)" / >
</td>
 </tr>
 
  
 <tr>
  <td> Alamat </td>
   <td> : </td>
  <td> 
  <form name=my_form method=post>
<textarea onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); 
 name=alamat rows=4 cols=39 class="required" title=" Alamat harus diisi"></textarea> <br />
<input size=1 value=40 name=text_num> Sisa Karakter Inputan 
</form>
  </td>
 </tr>
 
 <tr>
  <td colspan="3" align="center">	<input type="submit" value="Simpan"><input type="reset" value="Reset"> </td>
  </tr>
</table>

</body>
</form>
</html>
