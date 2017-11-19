<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Input kriteria</title>
<!--tidak boleh kosong-->
<script language="JavaScript" type="text/javascript">
    function cek(){
   	if(submit.nama_kriteria.value==""){
    alert ("Nama kriteria Harus dipilih");
    submit.nama_kriteria.focus()
    return false
    }
	if(submit.atribut.value==""){
    alert ("Atribut Bagian Harus dipilih");
    submit.atribut.focus()
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

<?php
include 'koneksi.php';
$query = "SELECT max(id_kriteria) as maxKode FROM kriteria";
$hasil = mysqli_query($db_link,$query);
$data  = mysqli_fetch_array($hasil);
$kodeBarang = $data['maxKode'];
$noUrut = (int) substr($kodeBarang, 3, 3);
$noUrut++;
$char = "K-";
$newID = $char . sprintf("%04s", $noUrut);
?>

<form name="submit" action="kriteria_proses.php" method="post" onsubmit="return cek()" >
<center>
<h1>INPUT DATA KRITERIA</h1>
<table align="center" border="0" cellpadding="3" cellspacing="3">
<tr>
  <td> ID Kriteria </td>
  <td> : </td>
  <td> <input type="text" name="id_kriteria" disabled autocomplete="off" size="8" value="<?php echo $newID;?>"/>
  		<input type="hidden" name="id_kriteria" autocomplete="off" value="<?php echo $newID;?>"/>
  </tr>

  <tr>
  <td> Nama Kriteria </td>
   <td> : </td>
  <td>  <input  type="text" name="nama_kriteria"  size="45" maxlength="40" onkeypress="return huruf(event)" />  </td>

 </tr>
 
 <tr>
  <td> Atribut </td>
   <td> : </td>
  	<td>
	<select name="atribut">  
 			<option value="">- Pilih Atribut -</option>  
 			<option value="K">Keuntungan</option>  
			 <option value="B">Biaya</option>  
 		</select>   </td>
 </tr>
  
 <tr>
  <td colspan="3" align="center"><input type="submit" name="submit" value="Simpan"> 
  <input type='reset' value='Batal' name='reset' class='button'/>  </td>
  </tr>

</table>
</body>
</form>
</html>
