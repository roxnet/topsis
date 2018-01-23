<?php //ob_start(); ?>
<html>
<head>
	<title>Pamella Supermarket</title>
</head>
<body>
	
<h3 style="text-align: center;">DAFTAR PEGAWAI</h3>

<table border="1" align="center">
<tr>
	<th>NO PEGAWAI</th>
	<th>NAMA PEGAWAI</th>
	<th>JENIS KELAMIN</th>
	<th>AGAMA</th>
	<th>STATUS PERKAWINAN</th>
	<th>TANGGAL MASUK</th>
</tr>
<?php
// Load file koneksi.php
include "../koneksi.php";
 
$query = "SELECT * FROM pegawai";
$sql = mysqli_query($db_link, $query);
$row = mysqli_num_rows($sql);
 
 
if($row > 0){ 

    while($data = mysqli_fetch_array($sql)){ 
        echo "<tr>";
     	echo "  <td>{$data['no_pegawai']}</td>";
        echo "<td>{$data['nama']}</td>";
		echo "<td>";
			if ($data['jekel']=='L') {echo 'Laki-laki'; }
				ELSE echo 'Perempuan';
		echo "</td>";
		echo "<td>{$data['agama']}</td>";
		echo "<td>{$data['status_perkawinan']}</td>";
		echo "<td>{$data['tgl_masuk']}</td>";
	    echo "</tr>";
    }
}else{
    echo "<tr><td colspan='4'>Data Bagian tidak ada</td></tr>";
}
?>
</table>

</body>
</html>
<?php
/*
$html = ob_get_contents();
ob_end_clean();
        
require_once('html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('P','A4','en');
$pdf->WriteHTML($html);
$pdf->Output('Data Penilaian.pdf', 'D'); */
?>
