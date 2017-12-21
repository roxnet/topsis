 

<div class="col-sm-11 col-xs-offset-2">  
 
	<h2 class="text-center">LAPORAN PENILAIAN PEGAWAI</h2> 
	<div class="panel-group" >
		<div class="panel panel-default" style="padding:10px" >
            <br/>
<?php   
include_once "../../../koneksi.php";
$sql_kriteria="SELECT id_kriteria,nama_kriteria FROM kriteria ORDER BY id_kriteria";
$hasil_kriteria=mysqli_query($db_link,$sql_kriteria);
$total_kriteria=mysqli_num_rows($hasil_kriteria);

$sql_penilaian="SELECT DISTINCT C.nama,B.id_jabatan FROM penilaian A
                INNER JOIN jabatan_pegawai B ON A.id_jabatan=B.id_jabatan
                INNER JOIN pegawai C ON B.id_pegawai=C.no_pegawai";
$hasil_penilaian=mysqli_query($db_link,$sql_penilaian);
        echo '<table class="table table-bordered table-hover text-center panel panel-primary" >
                    
                <thead class="panel-heading">
                <tr>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NO</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">NAMA PEGAWAI</th>
                    <th class="text-center" colspan="'.$total_kriteria.'">KRITERIA</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">BAGIAN</th>
                    <th class="text-center" rowspan="2" style="vertical-align: middle;">JABATAN</th>
                    
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

        while ($data_penilaian=mysqli_fetch_assoc($hasil_penilaian)) {
            echo "<tr>";
            echo "  
                <td>".$s."</td>
                <td>{$data_penilaian['nama']}</td>";
                $sql_jabatan="SELECT B.jabatan,C.bagian FROM penilaian A
                INNER JOIN jabatan_pegawai B ON A.id_jabatan=B.id_jabatan
                INNER JOIN bagian C ON B.id_bagian=C.id_bagian
                WHERE  B.id_jabatan='".$data_penilaian['id_jabatan']."'
                ORDER BY A.id_nilai ASC";
                $hasil_jabatan = mysqli_query($db_link,$sql_jabatan);
                if (!$hasil_jabatan){
                        echo mysqli_error($db_link);
                die("Gagal Query Data ");
                }
                $data_jabatan=mysqli_fetch_assoc($hasil_jabatan);

            $d=1;
            while ($d<=$total_kriteria){
                $sql="SELECT A.id_nilai,A.nilai FROM penilaian A
                        INNER JOIN bobot_penilaian B ON A.id_bobot=B.id_bobot
                        INNER JOIN jabatan_pegawai C ON A.id_jabatan=C.id_jabatan
                        WHERE B.id_kriteria='".$kriteriaarray[$d-1]."'
                        AND C.id_jabatan='".$data_penilaian['id_jabatan']."'
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
                    echo "<td>".$data['nilai']."</td>";
                }
                $d++;
            }
         echo  "
                <td>".$data_jabatan['bagian']."</td>
                <td>".$data_jabatan['jabatan']."</td>
                ";
        
            echo "</tr>";
        $s++;
        }
    echo '</tbody></table>
    <br/>

    ';

?>

		</div>
	</div>
    
  
</div>

<script src="../vendor/jquery/jquery.min.js"></script>

<script>
	 $(document).ready(function () {

        $(".detail").click(function () {
           		window.location.replace("index.php?navigasi=laporan_penilaian_pegawai&crud=detail");
          });
     
	 });
</script>