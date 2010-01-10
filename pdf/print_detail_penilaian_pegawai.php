	<?php //ob_start(); ?>
<html>
<head>
	<title>Cetak PDF</title>
</head>
<body onLoad="window.print()">

<h2 align="center">DETAIL PENILAIAN PEGAWAI</h2> 
			<?php
			include_once "../koneksi.php";
			
       $id_jabatan=$_GET['id_jabatan'];
		$sql_data="SELECT A.no_pegawai, A.nama, B.jabatan, B.id_jabatan, C.nama_toko, D.tgl_penilaian, E.bagian
				FROM pegawai A, jabatan_pegawai B, toko C, penilaian D, bagian E
				WHERE A.no_pegawai=B.id_pegawai
				AND C.id_toko=B.id_toko
				AND B.id_jabatan=D.id_jabatan
				AND E.id_bagian=B.id_bagian
				AND B.id_jabatan='".$id_jabatan."'";
		$hasil_data=mysqli_query($db_link,$sql_data);
		$data=mysqli_fetch_assoc($hasil_data);
			?>
			<table  align="center">
				<tr>
					<td> No Pegawai</td>
					<td> : </td>
					<td><?php echo $data['no_pegawai'];?> </td>
             	</tr>
				<tr>
					<td> Nama Pegawai</td>
					<td> : </td>
					<td><?php echo $data['nama'];?> </td>
             	</tr>
				<tr>
					<td> Jabatan</td>
					<td> : </td>
					<td><?php echo $data['jabatan'];?> </td>
             	</tr>
				<tr>
					<td> Bagian</td>
					<td> : </td>
					<td><?php echo $data['bagian'];?> </td>
             	</tr>
				<tr>
					<td> Toko</td>
					<td> : </td>
					<td><?php echo $data['nama_toko'];?> </td>
             	</tr>
				<tr>
					<td> Tanggal Penilaian</td>
					<td> : </td>
					<td><?php echo $data['tgl_penilaian'];?> </td>
             	</tr>
				</table>
				<br />
<?php
$sql_kriteria="SELECT id_kriteria,nama_kriteria FROM kriteria ORDER BY id_kriteria";
$hasil_kriteria=mysqli_query($db_link,$sql_kriteria);

$id_jabatan=$_GET['id_jabatan'];
$sql_penilaian="SELECT B.id_jabatan, A.nilai FROM detail_penilaian A 
				INNER JOIN penilaian C ON A.id_nilai=C.id_nilai
				INNER JOIN jabatan_pegawai B ON C.id_jabatan=B.id_jabatan
				WHERE B.id_jabatan='".$id_jabatan."'";

				
$hasil_nilai=mysqli_query($db_link,$sql_penilaian);

        echo '<table  align="center" border="1"  cellpadding="0" cellspacing="0">
                    
                <thead class="panel-heading">
                <tr>
                    <th  width="50">NO</th>
                    <th>KRITERIA</th>
                    <th  width="80">NILAI</th>
					
                </tr>';
				 echo '  </thead>
				<tbody> ';
		$s=1;
        $kriteriaarray=array();
            while($data_kriteria=mysqli_fetch_assoc($hasil_kriteria)){
                echo "
                <tr>
					<td  align='center'>".$s++."</td>
					<td>".$data_kriteria['nama_kriteria']."</td>";
			            
				$data_nilai=mysqli_fetch_assoc($hasil_nilai);
					echo "<td  align='center'>".$data_nilai['nilai']."</td>";
					
				echo"</tr>";
            }
			
 echo "</tbody></table>";
	
?>
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
