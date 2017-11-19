  <?php 
include "koneksi.php";
$id_kriteria=$_GET['id_kriteria'];
$edit=("select * from kriteria where id_kriteria='$id_kriteria'");
$hasil = mysqli_query($db_link,$edit);
?>
<form action="kriteria_edit_proses.php" method="post">
<center>
<h1>Form Edit Data Bgian</h1>

<table border="1" cellpadding="0" cellspacing="0">
<?php
while($row=mysqli_fetch_array($hasil)){
?>
<input type="hidden" name="id_bagian" value="<?php echo $id_kriteria;?>"/>
<tr>
<td>Nama Bagian</td><td><input type="text" name="bagian" value="<?php echo $row['nama_kriteria'];?>" /></td>
</tr>
<tr>
<td>Atribut</td><td><input type="text" name="bagian" value="<?php echo $row['atribut'];?>" /></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="Simpan" name="simpan" /></td>
</tr>
<?php
}
?>
</table>
</form>
 