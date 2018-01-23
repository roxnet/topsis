<?php //ob_start(); ?>
<html>
<head>
	<title>Pamella Supermarket</title>
</head>
<body>
	
<h3 style="text-align: center;">DAFTAR BAGIAN</h3>
<table border="1" align="center">
<tr>
	<th align="center">ID Bagian</th>
	<th align="center">Nama Bagian</th>
</tr>
<?php
// Load file koneksi.php
include "../koneksi.php";
 
$query = "SELECT * FROM bagian";
$sql = mysqli_query($db_link, $query);
$row = mysqli_num_rows($sql);
 
 
if($row > 0){ 

    while($data = mysqli_fetch_array($sql)){ 
        echo "<tr>";
        echo "<td align='center'>".$data['id_bagian']."</td>";
        echo "<td>".$data['bagian']."</td>";
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
$pdf->Output('cor.pdf', 'D');*/
?>
