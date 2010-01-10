<?php //ob_start(); ?>
<html>
<head>
	<title>Cetak PDF</title>
</head>
<body onLoad="window.print()">
	
<h3 style="text-align: center;">Laporan Penialaian Pegawai <br> Pamella Supermarket Yogyakarta</h3>

        <br/><br/>
<?php   
include '../koneksi.php';
$sql_kriteria="SELECT id_kriteria,nama_kriteria FROM kriteria ORDER BY id_kriteria";
$hasil_kriteria=mysqli_query($db_link,$sql_kriteria);
$total_kriteria=mysqli_num_rows($hasil_kriteria);

$sql_penilaian="SELECT DISTINCT C.nama,B.id_jabatan,A.status FROM penilaian A
                INNER JOIN jabatan_pegawai B ON A.id_jabatan=B.id_jabatan
                INNER JOIN pegawai C ON B.id_pegawai=C.no_pegawai
                WHERE A.status=1
                ORDER BY C.nama,A.status DESC";
$hasil_penilaian=mysqli_query($db_link,$sql_penilaian);
        echo "<table align='center' border='1' cellpadding='0' cellspacing='0' >";

                echo "<tr>";
                    echo "<th rowspan='2'>NAMA PEGAWAI</th>";
                    echo "<th colspan='".$total_kriteria."'>KRITERIA</th>";
                    echo "<th rowspan='2'>BAGIAN</th>";
                    echo "<th rowspan='2'>JABATAN</th>";
                    echo "<th rowspan='2'>STATUS</th>";
                echo "</tr>";
                
                echo "<tr>";

        $kriteriaarray=array();
            while($data_kriteria=mysqli_fetch_assoc($hasil_kriteria)){
                $kriteriaarray[]=''.$data_kriteria['id_kriteria'].'';
                echo " <th width='50'>".$data_kriteria['nama_kriteria']."</th> ";
            }
        echo '</tr>
        </thead>
        <tbody> ';
        while ($data_penilaian=mysqli_fetch_assoc($hasil_penilaian)) {
            echo "<tr class='tablerow'>";
            echo "  
                <td>{$data_penilaian['nama']}</td>";
                $sql_jabatan="SELECT B.jabatan,C.bagian FROM penilaian A
                INNER JOIN jabatan_pegawai B ON A.id_jabatan=B.id_jabatan
                INNER JOIN bagian C ON B.id_bagian=C.id_bagian
                WHERE  B.id_jabatan='".$data_penilaian['id_jabatan']."'
                AND A.status=".$data_penilaian['status']."
                ORDER BY A.id_nilai ASC";
                $hasil_jabatan = mysqli_query($db_link,$sql_jabatan);
                if (!$hasil_jabatan){
                        echo mysqli_error($db_link);
                die("Gagal Query Data ");
                }
                $data_jabatan=mysqli_fetch_assoc($hasil_jabatan);

            $d=1;
            while ($d<=$total_kriteria){
                $sql="SELECT A.id_nilai,BB.nilai FROM penilaian A
                        INNER JOIN detail_penilaian BB ON A.id_nilai=BB.id_nilai
                         INNER JOIN detail_bobot CC ON BB.id_detailbobot=CC.id_detailbobot
                        INNER JOIN bobot_penilaian B ON CC.id_bobot=B.id_bobot
                        INNER JOIN jabatan_pegawai C ON A.id_jabatan=C.id_jabatan
                        WHERE CC.id_kriteria='".$kriteriaarray[$d-1]."'
                        AND C.id_jabatan='".$data_penilaian['id_jabatan']."'
                        AND A.status=".$data_penilaian['status']."
                        ORDER BY A.id_nilai ASC";
                $hasil = mysqli_query($db_link,$sql);
                if (!$hasil){
                        echo mysqli_error($db_link);
                die("Gagal Query Data ");
                }
                $cek=mysqli_num_rows($hasil);
                if($cek==0){
                    echo "<td></td>";
                    }
                else {
                    $data=mysqli_fetch_assoc($hasil);
                    echo "<td align='center'>".$data['nilai']."</td>";
                }
                $d++;
            }
         echo  "<td>".$data_jabatan['bagian']."</td>";
                echo  "<td>".$data_jabatan['jabatan']."</td>";
                echo  "<td>";
                if ( $data_penilaian['status']==1 )echo 'Aktif';
                else echo'Non Aktif';
               
        echo "</td>";
        
            echo "</tr>";
        }
    echo '</tbody></table>
    <br/>';

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