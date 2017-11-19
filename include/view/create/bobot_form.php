<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Input Nilai</title>
<!--tidak boleh kosong-->
<script language="JavaScript" type="text/javascript">
    function cek(){
	if(submit.id_kriteria.value==""){
    alert ("Nama Kriteria Harus dipilih");
    submit.id_kriteria.focus()
    return false
    }
	if(submit.id_bagian.value==""){
    alert ("Nama Bagian Harus dipilih");
    submit.id_bagian.focus()
    return false
    }
	if(submit.bobot.value==""){
    alert ("Nama Bagian Harus dipilih");
    submit.bobot.focus()
    return false
    }
    return true
    }
    </script>
<!--tidak boleh kosong-->

</head>
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
<form name="submit" action="bobot_proses.php" method="post" onsubmit="return cek()">
	<center>
<table align="center" border="0" cellpadding="3" cellspacing="3">
<tr>
<td colspan="3" align="center"> <h4>Input Bobot Kriteria</h4></td>
</tr>  

  <tr>
 <td> Nama Bagian </td>
  <td> : </td>
 <td><?php
	    $id_bagian= $_GET['id_bagian']; //get the nama value from form
		require_once("koneksi.php");
		$sql = "select * from bagian where id_bagian='$id_bagian'";
		$hasil = mysqli_query($db_link,$sql);
			$data = mysqli_fetch_array($hasil);
			$kode	= $data['id_bagian'];
			$bagian	= $data['bagian'];
			
			echo "<font> $bagian </font>";
			echo "<input type='hidden' name='id_bagian' value='$kode' readonly='readonly' />";
		?>
	</td>
 </tr>
 <tr>
 <td colspan="3"> Bobot Kriteria </td>
 </tr>
<tr>
	<td>
	<?php 
	include "koneksi.php";
	$query = "select * from kriteria";
		$data=mysqli_query($db_link,$query);
	while($d = mysqli_fetch_array($data)){
	?>
	<tr>
		<td><?php echo $d['nama_kriteria']; ?></td>
		<td>:</td>
		<td> 
		<input type="hidden" name="id_kriteria[]" value="<?php echo $d['id_kriteria']?>" />
		<input type="number" name="bobot[]"  max='10' min='1' onkeypress="return hanyaAngka(event, false)" />
		</td>
	</tr>
	<?php } ?>
	
	 <tr>
  <td colspan="3" align="center"><input type="submit" name="submit" value="Simpan"> 
  <input type='reset' value='Batal' name='reset' class='button'/>  </td>
  </tr>
 </table>
</body>
</html>
