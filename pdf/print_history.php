 <?php //ob_start(); ?>
<html>
<head>
	<title>Pamella Supermarket</title>
</head>
<body onLoad="window.print()">

	<h2 align="center">HISTORY PENILAIAN PEGAWAI TERBAIK</h2> 

      <br/>
<?php include "../koneksi.php";?>	  
<?php 
include_once "../../../koneksi.php";
$start=$_POST['start'];
$end=$_POST['end'];
$sql_rangking="SELECT * FROM usulan WHERE
     date_format(periode,'MM/YYYY')>=date_format($start, 'MM/YYYY') AND date_format(periode,'MM/YYYY')<=date_format($end, 'MM/YYYY')
 ORDER BY nilai DESC";
$hasil_rangking=mysqli_query($db_link,$sql_rangking);
        echo '<table class="table table-bordered table-hover text-center panel panel-primary" >
                    
                <thead class="panel-heading">
                <tr>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">RANGKING</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NO PEGAWAI</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NAMA PEGAWAI</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">PAMELLA</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NILAI</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">BAGIAN</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">JABATAN</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">PERIODE</th>
                </tr>
        </thead>
        <tbody> ';
        $s=1;
        $number=0;
        while ($data_rangking=mysqli_fetch_assoc($hasil_rangking)) {
            echo "<tr>";
            echo "  
                <td>".$s."</td>
                 <td>{$data_rangking['no_pegawai']}</td>
                <td>{$data_rangking['nama_pegawai']}</td>
                <td>{$data_rangking['nama_toko']}</td>
                <td>".$data_rangking['nilai']."</td>
                <td>{$data_rangking['bagian']}</td>
                <td>{$data_rangking['jabatan']}</td>
                <td>".date("d-m-Y", strtotime($data_rangking['periode']))."</td>";
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
$pdf->Output('Laporan Penilaian Pegawai.pdf', 'D'); */
?>

