<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Perhitungan</title>
</head>

<body>
 <form name="SUBMIT" method="post" action="matrik2.php">
<center>
<h1>PILIH PERIODE MATRIK</h1>
<table border="0" width="250">
<tr height="30">
<td> Bulan </td>
<td>
<select name="month">
<option>- Pilih Bulan -</option>
<option value="01">Januari</option>
<option value="02">Februari</option>
<option value="03">Maret</option>
<option value="04">April</option>
<option value="05">Mei</option>
<option value="06">Juni</option>
<option value="07">Juli</option>
<option value="08">Agustus</option>
<option value="09">September</option>
<option value="10">Oktober</option>
<option value="12">November</option>
<option value="12">Desember</option>
</select>
<td> Tahun </td>
<th>
<select name="year"> 
<?php
$mulai= date('Y') - 50;
for($i = $mulai;$i<$mulai + 100;$i++){
    $sel = $i == date('Y') ? ' selected="selected"' : '';
    echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
}
?>
</select>
</th>
</tr>
<tr>
 <th colspan="5"> <input type="RESET"  value="Batal" >&nbsp; &nbsp;<input type="SUBMIT" name="SUBMIT"  value="Tampil" > </th>
</tr>

</table>
</center>
</body>
</html>
