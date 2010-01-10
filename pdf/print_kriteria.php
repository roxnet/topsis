<?php ob_start(); ?>
<html>
<head>
	<title>Cetak PDF</title>
</head>
<body>
	
<h3 style="text-align: center;">Daftar Kriteria <br> Pamella Supermarket Yogyakarta</h3>

<table border="1" align="center">
<tr>
	<th>ID Kriteria</th>
	<th>Nama Kriteria</th>
	<th>Atribut</th>
</tr>
<?php
// Load file koneksi.php
include "../koneksi.php";
 
$query = "SELECT * FROM kriteria";
$sql = mysqli_query($db_link, $query);
$row = mysqli_num_rows($sql);
 
 
if($row > 0){ 

    while($data = mysqli_fetch_array($sql)){ 
        echo "<tr>";
        echo "<td>".$data['id_kriteria']."</td>";
        echo "<td>".$data['nama_kriteria']."</td>";
        echo "<td>";
			if ($data['atribut']=='K') {echo 'Keuntungan'; }
				ELSE echo 'Biaya';
		echo "</td>";
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
$html = ob_get_contents();
ob_end_clean();
        
require_once('html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('P','A4','en');
$pdf->WriteHTML($html);
$pdf->Output('Data Kriteria.pdf', 'D');
?>
