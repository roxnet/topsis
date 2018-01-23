	<?php /*ob_start(); */
$start	=$_GET['start'];
$end	=$_GET['end'];
?>
<html>
<head>
	<title>Pamella Supermarket</title>
</head>
<body onLoad="window.print()">

<h3 align="center">HISTORY USULAN PEGAWAI TERBAIK </h3> 
<h4 align="center"> Periode Bulan <?php echo $start ?> s/d Bulan<?php echo $end ?></h4>
<?php
include_once "../koneksi.php";
//$start='11/2017';
//$end='11/2017';
$sql_rangking="SELECT * FROM usulan WHERE
     date_format(periode,'MM/YYYY')>=date_format($start, 'MM/YYYY') AND date_format(periode,'MM/YYYY')<=date_format($end, 'MM/YYYY')
 ORDER BY nilai DESC";
 /**/
$hasil_rangking=mysqli_query($db_link,$sql_rangking);
        echo '<table border="1" align="center">
				<thead class="panel-heading">
                <tr align="center" height="35" >
                    <td>RANGKING</td>
                    <td>NO PEGAWAI</td>
                    <td>NAMA PEGAWAI</td>
                    <td>PAMELLA</td>
                    <td>NILAI</td>
                    <td>BAGIAN</td>
                    <td>JABATAN</td>
                    <td>PERIODE</td>
                </tr>
				</thead>
        <tbody> ';
        $s=1;
        $number=0;
        while ($data_rangking=mysqli_fetch_assoc($hasil_rangking)) {
            echo "<tr>";
            echo "  
                <td align='center'>".$s."</td>
                <td align='center'>{$data_rangking['no_pegawai']}</td>
                <td>&nbsp;&nbsp;{$data_rangking['nama_pegawai']}</td>
                <td>{$data_rangking['nama_toko']}</td>
                <td>".$data_rangking['nilai']."</td>
                <td>{$data_rangking['bagian']}</td>
                <td>{$data_rangking['jabatan']}</td>
                <td>".date('d-M-Y',strtotime($data_rangking['periode']))."</td>";
            echo "</tr>";
           
            $number=$s;
        $s++;
        }
?>
	 </tbody>
     </table>
</body>
</html>
<?php /*
$html = ob_get_contents();
ob_end_clean();
        
require_once('html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('P','A4','en');
$pdf->WriteHTML($html);
$pdf->Output('History.pdf', 'D'); */
?>
