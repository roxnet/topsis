<?php //ob_start(); ?>
<html>
<head>
	<title>Pamella Supermarket</title>
</head>
<body onLoad="window.print()">
	
<h3 style="text-align: center;">DAFTAR PENILAIAN </h3>

<?php   
include '../koneksi.php';
$sql_kriteria="SELECT id_kriteria,nama_kriteria FROM kriteria ORDER BY id_kriteria";
$hasil_kriteria=mysqli_query($db_link,$sql_kriteria);
$total_kriteria=mysqli_num_rows($hasil_kriteria);


$sql_penilaian="SELECT DISTINCT A.id_nilai,C.nama,B.id_jabatan,A.status FROM penilaian A
                INNER JOIN jabatan_pegawai B ON A.id_jabatan=B.id_jabatan
                INNER JOIN pegawai C ON B.id_pegawai=C.no_pegawai
                ORDER BY C.nama asc, A.Status desc";
$hasil_penilaian=mysqli_query($db_link,$sql_penilaian);


echo '<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td rowspan="2">No</td>
    <td rowspan="2">Nama Pegawai </td>
    <td align="center" colspan="'.$total_kriteria.'"> Nama Kriteria</td>
    <td rowspan="2">Bagian</td>
    <td rowspan="2">Jabatan</td>
    <td rowspan="2">Status</td>
  </tr>
  <tr>';
  while($data_kriteria=mysqli_fetch_assoc($hasil_kriteria)){
                echo "<td width='50' align='center'>".$data_kriteria['nama_kriteria']."</td>";
            } 
			$s=1;
			while($data_penilaian=mysqli_fetch_assoc($hasil_penilaian)) {
            echo "<tr>";
            echo "<td>$s</td>";
            echo "<td>&nbsp;{$data_penilaian['nama']}</td>";
				
				$sql_jabatan="SELECT B.jabatan,C.bagian FROM penilaian A
                INNER JOIN jabatan_pegawai B ON A.id_jabatan=B.id_jabatan
                INNER JOIN bagian C ON B.id_bagian=C.id_bagian
                WHERE  B.id_jabatan='".$data_penilaian['id_jabatan']."'
                AND A.status='".$data_penilaian['status']."'
                ORDER BY A.id_nilai ASC";
                $hasil_jabatan = mysqli_query($db_link,$sql_jabatan);
				 $data_jabatan=mysqli_fetch_assoc($hasil_jabatan);
				 
				$sql="SELECT A.id_nilai,BB.nilai FROM penilaian A
                        INNER JOIN detail_penilaian BB ON A.id_nilai=BB.id_nilai
                        INNER JOIN detail_bobot CC ON BB.id_detailbobot=CC.id_detailbobot
                        INNER JOIN bobot_penilaian B ON CC.id_bobot=B.id_bobot
                        INNER JOIN jabatan_pegawai C ON A.id_jabatan=C.id_jabatan
                        WHERE  C.id_jabatan='".$data_penilaian['id_jabatan']."'
                        AND A.status='".$data_penilaian['status']."'
                        AND A.id_nilai='".$data_penilaian['id_nilai']."'
                        ORDER BY A.id_nilai ASC";
                $hasil = mysqli_query($db_link,$sql);
                
		
                    while ($data=mysqli_fetch_assoc($hasil)){
                    echo "<td align='center'>".$data['nilai']."</td>";
					}
					echo "<td>".$data_jabatan['jabatan']."</td>";
                	echo "<td>".$data_jabatan['bagian']."</td>";
                echo "<td>";
                if ($data_penilaian['status']==1) echo 'Aktif';
                else echo 'Non Aktif';
                echo "</td>";
				
					$s++;
				}
			
				?>
				
  </tr>
</table>
</body>
</html>
<?php /*
$html = ob_get_contents();
ob_end_clean();
        
require_once('html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('P','A4','en');
$pdf->WriteHTML($html);
$pdf->Output('Data Penilaian.pdf', 'D'); */
?>
