<?php //ob_start(); ?>
<html>
<head>
	<title>Pamella Supermarket</title>
</head>
<body>
	
<h3 style="text-align: center;">DAFTAR JABATAN PEGAWAI</h3>

<table border="1" align="center">
<tr>
	<th>No Pegawai</th>
	<th>Nama Pegawai</th>
	<th>Toko</th>
	<th>Bagian</th>
	<th>Jabatan</th>
	<th>Mulai Tugas</th>
</tr>
<?php
// Load file koneksi.php
include "../koneksi.php";
 
		$query = "SELECT A.id_jabatan,B.no_pegawai,B.nama,C.nama_toko,D.bagian,A.jabatan,A.tgl_jabat
                                    FROM jabatan_pegawai A
                                    INNER JOIN pegawai B ON A.id_pegawai=B.no_pegawai
                                    INNER JOIN toko C ON A.id_toko=C.id_toko
                                    INNER JOIN bagian D ON A.id_bagian=D.id_bagian 
                                    WHERE A.Status=1 ORDER BY B.no_pegawai";
		$sql = mysqli_query($db_link, $query);
		$row = mysqli_num_rows($sql);
 
			if($row > 0){ 
	    while($data = mysqli_fetch_array($sql)){ 
        echo "<tr>";
		echo "<td>".$data['no_pegawai']."</td>";
        echo "<td>".$data['nama']."</td>";
		echo "<td>".$data['nama_toko']."</td>";
		echo "<td>".$data['bagian']."</td>";
		echo "<td>";
		echo ucwords($data['jabatan']); 
		echo "</td>";
		echo "<td>".$data['tgl_jabat']."</td>";
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
$pdf->Output('Jabatan Pegawai.pdf', 'D');
*/
?>
