<?php //ob_start(); ?>
<html>
<head>
	<title>Pamella Supermarket</title>
</head>
<body onLoad="window.print()">
   
    <?php 
	include "../koneksi.php";  
    $sql_kriteria="SELECT id_kriteria,nama_kriteria FROM kriteria ORDER BY id_kriteria";
    $hasil_kriteria=mysqli_query($db_link,$sql_kriteria);
    $total_kriteria=mysqli_num_rows($hasil_kriteria);
    $sql_bagian="SELECT B.id_bobot,B.id_bagian,A.bagian,B.jabatan FROM bagian A
                INNER JOIN bobot_penilaian B ON A.id_bagian=B.id_bagian
                ORDER BY B.status DESC";
    $hasil_bagian=mysqli_query($db_link,$sql_bagian);
    $total_bagian=mysqli_num_rows($hasil_bagian);

         '<table class="table table-bordered table-hover text-center panel panel-primary">
                    
                <thead class="panel-heading">
                <tr>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NO</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">BAGIAN</th>
                    <th class="text-center" colspan="'.$total_kriteria.'">KRITERIA</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">JABATAN</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">STATUS</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">AKSI</th>
                </tr>
                <tr>';

                $kriteriaarray=array();
                    while($data_kriteria=mysqli_fetch_assoc($hasil_kriteria)){
                        $kriteriaarray[]=''.$data_kriteria['id_kriteria'].'';
                         "
                        <th>".$data_kriteria['nama_kriteria']."</th>
                        ";
                    }
                 '</tr>
                </thead>
                <tbody> ';
        $s=1;

        while ($data_bagian=mysqli_fetch_assoc($hasil_bagian)) {
             "<tr class='tablerow'>";
             "  
                <td></td>
                <td>{$data_bagian['bagian']}</td>";
            $sql_jabatan="SELECT A.jabatan,A.status FROM bobot_penilaian A
                INNER JOIN bagian C ON A.id_bagian=C.id_bagian
                WHERE  C.id_bagian='".$data_bagian['id_bagian']."'
                AND A.jabatan='".$data_bagian['jabatan']."'
                AND A.id_bobot='".$data_bagian['id_bobot']."'
                ORDER BY A.id_bobot ASC";
                $hasil_jabatan = mysqli_query($db_link,$sql_jabatan);
                if (!$hasil_jabatan){
                         mysqli_error($db_link);
                die("Gagal Query Data A");
                }
                $data_jabatan=mysqli_fetch_assoc($hasil_jabatan);
            $d=1;
            while ($d<=$total_kriteria){
                $sql="SELECT D.id_bobot,D.bobot FROM bobot_penilaian A
                INNER JOIN bagian C ON A.id_bagian=C.id_bagian
                INNER JOIN detail_bobot D ON A.id_bobot=D.id_bobot
                INNER JOIN kriteria B ON D.id_kriteria=B.id_kriteria
                WHERE B.id_kriteria='".$kriteriaarray[$d-1]."' 
                AND C.id_bagian='".$data_bagian['id_bagian']."'
                AND A.jabatan='".$data_jabatan['jabatan']."'
                AND A.id_bobot=".$data_bagian['id_bobot']."
                ORDER BY A.id_bobot ASC";
                $hasil = mysqli_query($db_link,$sql);
                if (!$hasil){
                         mysqli_error($db_link);
                die("Gagal Query Data B");
                }
                $cek=mysqli_num_rows($hasil);
                if($cek==0){
                     "<td></td>";
                    }
                else {
                    $data=mysqli_fetch_assoc($hasil);
                     "<td>".$data['bobot']."</td>";
                }
                $d++;
            }
           "
                <td>".$data_jabatan['jabatan']."</td>
                 <td>";
               if ($data_jabatan['status']==1)  "Aktif"; else  "Non Aktif";
         "</td>";
        
             "</tr>";
        $s++;
        }
     "</tbody></table>";

?>
	


	<h2 align="center">DAFTAR AKUMULASI BOBOT</h2> 
            <br/>
    <?php   

    $sql_kriteria="SELECT id_kriteria,nama_kriteria FROM kriteria ORDER BY id_kriteria";
    $hasil_kriteria=mysqli_query($db_link,$sql_kriteria);
    $total_kriteria=mysqli_num_rows($hasil_kriteria);
     $sql_bagian="SELECT  B.id_bobot,B.id_bagian,A.bagian,B.jabatan FROM bagian A
                INNER JOIN bobot_penilaian B ON A.id_bagian=B.id_bagian
                ORDER BY B.status DESC";
    $hasil_bagian=mysqli_query($db_link,$sql_bagian);
    $total_bagian=mysqli_num_rows($hasil_bagian);

        echo '<table border="1" align="center">
                    
                <thead class="panel-heading">
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">BAGIAN</th>
                    <th colspan="'.$total_kriteria.'">KRITERIA</th>
                    <th rowspan="2">JABATAN</th>
                    <th rowspan="2">STATUS</th>
                </tr>
                <tr>';

                $kriteriaarray=array();
                    while($data_kriteria=mysqli_fetch_assoc($hasil_kriteria)){
                        $kriteriaarray[]=''.$data_kriteria['id_kriteria'].'';
                        echo "
                        <th>".$data_kriteria['nama_kriteria']."</th>
                        ";
                    }
                echo '</tr>
                </thead>
                <tbody> ';
        $s=1;

        while ($data_bagian=mysqli_fetch_assoc($hasil_bagian)) {
            echo "<tr>";
            echo "  
                <td>".$s."</td>
                <td>{$data_bagian['bagian']}</td>";
           $sql_jabatan="SELECT A.jabatan,A.status FROM bobot_penilaian A
                INNER JOIN bagian C ON A.id_bagian=C.id_bagian
                WHERE  C.id_bagian='".$data_bagian['id_bagian']."'
                AND jabatan='".$data_bagian['jabatan']."'
                AND A.id_bobot=".$data_bagian['id_bobot']."
                ORDER BY A.id_bobot ASC";
                $hasil_jabatan = mysqli_query($db_link,$sql_jabatan);
                if (!$hasil_jabatan){
                        echo mysqli_error($db_link);
                die("Gagal Query Data ");
                }
                $data_jabatan=mysqli_fetch_assoc($hasil_jabatan);
            $d=1;
            while ($d<=$total_kriteria){
              $sql="SELECT A.id_bobot,BB.akumulasi FROM bobot_penilaian A
                INNER JOIN detail_bobot BB on A.id_bobot=BB.id_bobot
                INNER JOIN kriteria B ON BB.id_kriteria=B.id_kriteria
                INNER JOIN bagian C ON A.id_bagian=C.id_bagian
                WHERE B.id_kriteria='".$kriteriaarray[$d-1]."'
                AND C.id_bagian='".$data_bagian['id_bagian']."'
                AND A.jabatan='".$data_jabatan['jabatan']."'
                AND A.id_bobot=".$data_bagian['id_bobot']."
                ORDER BY A.id_bobot ASC";
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
                    echo "<td>".$data['akumulasi']."</td>";
                }
                $d++;
            }
         echo  "
                <td>".$data_jabatan['jabatan']."</td>
                <td>";
               if ($data_jabatan['status']==1) echo "Aktif"; else echo "Non Aktif";
        echo "</td>
                ";
        
            echo "</tr>";
        $s++;
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