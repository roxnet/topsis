<?php ob_start(); ?>
<html>
<head>
	<title>Cetak PDF</title>
</head>
<body>
	
<h3 style="text-align: center;">Daftar Detail Pegawai <br> Pamella Supermarket Yogyakarta</h3>

<?php
// Load file koneksi.php
include "../koneksi.php";
$no_pegawai=$_GET['no_pegawai'];
$query = "SELECT * FROM pegawai where no_pegawai='$no_pegawai'";
$sql = mysqli_query($db_link, $query);
$row = mysqli_fetch_array($sql);
	?>
<table border="0" align="center">
	<tr>
	<td width="150">No Pegawai </td><td width="30">:</td><td><?php echo $row['no_pegawai'];?></td>
	</tr>
	<tr>
     <td>Nama Pegawai </td><td>:</td><td><?php echo $row['nama'];?></td>
	 </tr>
	<tr>
     <td>Tempat Lahir </td><td>:</td><td><?php echo $row['tempat_lahir'];?></td>
      </tr>
	<tr>
	  <td>Tanggal Lahir </td><td>:</td><td> <?php echo date("d-m-Y", strtotime($row['tanggal_lahir']));?></td>
       </tr>
	<tr>                     
      <td>Jenis Kelamin </td><td>:</td><td> <?php echo $row['jekel'];?> </td>
         </tr>
	<tr>                   
      <td>Agama </td><td>:</td><td><?php echo $row['agama'];?> </td>
	   </tr>
	<tr>
      <td>Status Perkawinan </td><td>:</td><td><?php echo $row['status_perkawinan'];?></td>
         </tr>
	<tr>          
	   <td>No Telepon </td><td>:</td><td><?php echo $row['no_telp'];?></td>
         </tr>
	<tr>           
		<td>Alamat </td><td>:</td><td><?php echo $row['alamat'];?></td>
		</tr>
	<tr>
		<td>Tanggal Masuk </td><td>:</td><td><?php echo date("d-m-Y", strtotime($row['tgl_masuk']));?></td>
		</tr>
		<tr>
		<td height="20" colspan="3"></td>
		</tr>
		<tr>
		<td colspan="3" align="right">Yogyakarta, <?php echo  date("d-M-Y"); ?></td>
		</tr><tr>
		<td></td><td></td><td align="center">Pegawai</td>
		</tr>
		<tr>
		<td height="40" colspan="3"></td>
		</tr>
		<tr>
		<td></td><td></td><td align="center">( &nbsp; &nbsp; <?php echo $row['nama'];?> &nbsp; &nbsp; )</td>
		</tr>
		</table>
                     
</body>
</html>
<?php 
$html = ob_get_contents();
ob_end_clean();
        
require_once('html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('P','A4','en');
$pdf->WriteHTML($html);
$pdf->Output('Detail Pegawai.pdf', 'D');
?>
